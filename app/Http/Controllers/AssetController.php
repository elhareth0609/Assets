<?php

namespace App\Http\Controllers;

use App\Http\Requests\Asset\App\AssetRequest;
use App\Http\Resources\Asset\App\AssetResource;
use App\Models\Asset;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Type;
use App\Services\AssetService;
use App\Services\EmployeeService;
use App\Services\LocationService;
use App\Services\TypeService;
use App\Traits\ApiResponder;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AssetController extends Controller {
    use ApiResponder;

    private $AssetService;
    private $EmployeeService;
    private $LocationService;
    private $TypeService;

    public function __construct(AssetService $AssetService, EmployeeService $EmployeeService,LocationService $LocationService,TypeService $TypeService) {
        $this->AssetService = $AssetService;
        $this->EmployeeService = $EmployeeService;
        $this->LocationService = $LocationService;
        $this->TypeService = $TypeService;
    }

        public function index() {
        return view('content.assets');
    }

    public function create() {
        return view('content.assets.create')
            ->with('types', $this->TypeService->allTypes())
            ->with('locations', $this->LocationService->allLocations())
            ->with('employees', $this->EmployeeService->allEmployees());        
    }

    public function show($id) {
        return view('content.assets.show')
            ->with('asset', $this->AssetService->getAsset($id));
    }

    public function edit($id) {

        return view('content.assets.edit')
            ->with('asset', $this->AssetService->getAsset($id))
            ->with('types', $this->TypeService->allTypes())
            ->with('locations', $this->LocationService->allLocations())
            ->with('employees', $this->EmployeeService->allEmployees());
    }

    public function all() {
        return $this->success(AssetResource::collection($this->AssetService->allAssets()));
    }

    public function get($id) {
        return view('content.assets.index')
            ->with('asset', $this->AssetService->getAsset($id));

        // return $this->success(new AssetResource($this->AssetService->getAsset($id)));
    }

    public function store(AssetRequest $request) {
        return $this->success(new AssetResource($this->AssetService->createAsset($request->validated())), 'تم الإنشاء بنجاح');
    }

    public function update(AssetRequest $request, $id) {
        return $this->success(new AssetResource($this->AssetService->updateAsset($id, $request->validated())), 'تم التحديث بنجاح');
    }

    public function delete($id) {
        $this->AssetService->deleteAsset($id);
        return $this->success(null, 'تم الحذف بنجاح');
    }
    public function qr($id) {
        $url = route('assets.get', $id);
        return response(QrCode::size(160)
        ->color(0, 0, 0)
        ->backgroundColor(255, 255, 255)
        ->generate($url))
        ->header('Content-Type', 'image/svg+xml');
    }

    /**
     * Export assets to Excel
     */
    public function export(Request $request) {
        $assets = Asset::all();
        

        // Create spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'م');
        $sheet->setCellValue('B1', 'الاسم');
        $sheet->setCellValue('C1', 'الرقم');
        $sheet->setCellValue('D1', 'الرقم التسلسلي للشركة المصنعة');
        $sheet->setCellValue('E1', 'تاريخ الشراء');
        $sheet->setCellValue('F1', 'الحالة');
        $sheet->setCellValue('G1', 'النوع');
        $sheet->setCellValue('H1', 'الموظف');
        $sheet->setCellValue('I1', 'الإدارة');
        $sheet->setCellValue('J1', 'الملاحظات');

        // Style headers
        $sheet->getStyle('A1:J1')->getFont()->setBold(true);
        $sheet->getStyle('A1:J1')->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFCCCCCC');

        // Add data
        $row = 2;
        foreach ($assets as $index => $asset) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $asset->name);
            $sheet->setCellValue('C' . $row, $asset->number);
            $sheet->setCellValue('D' . $row, $asset->manufacturer_serial);
            $sheet->setCellValue('E' . $row, $asset->purchase_date ? Date::PHPToExcel($asset->purchase_date) : '');
            $sheet->setCellValue('F' . $row, $this->getStatusLabel($asset->status->value));
            $sheet->setCellValue('G' . $row, $asset->type ? $asset->type->name : '');
            $sheet->setCellValue('H' . $row, $asset->employee ? $asset->employee->name : '');
            $sheet->setCellValue('I' . $row, $asset->location ? $asset->location->name : '');
            $sheet->setCellValue('J' . $row, $asset->notes);
            $row++;
        }

        // Format date columns
        $sheet->getStyle('E2:E' . ($row-1))->getNumberFormat()->setFormatCode('dd/mm/yyyy');

        // Auto-size columns
        foreach (range('A', 'J') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Add borders
        $sheet->getStyle('A1:J' . ($row-1))->getBorders()->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        // Create writer and output
        $writer = new Xlsx($spreadsheet);
        $filename = 'assets_' . date('Y-m-d_H-i-s') . '.xlsx';
        
        // Set headers for file download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        // IMPORTANT: These lines were missing in your code!
        $writer->save('php://output');
        exit; // This prevents any additional output (like debugbar) from being sent
    }

    /**
     * Helper methods
     */
    private function getStatusLabel($status): string
    {
        $statusLabels = [
            'in_use' => 'قيد الاستخدام',
            'in_storage' => 'في المخزن',
            'maintenance' => 'تحت الصيانة',
            'damaged' => 'تالف'
        ];

        return $statusLabels[$status] ?? $status;
    }

        /**
     * Import assets from Excel file
     */
    public function import(Request $request): JsonResponse
    {
        try {
            // Validate the uploaded file
            $validator = Validator::make($request->all(), [
                'excel_file' => 'required|file|mimes:xlsx,xls|max:10240', // Max 10MB
            ]);
            
            if ($validator->fails()) {
                return $this->error('ملف غير صالح. يرجى رفع ملف Excel صالح.', 400);
            }

            $excel_file = $request->file('excel_file');
            
            // Load the spreadsheet
            $spreadsheet = IOFactory::load($excel_file->getPathname());
            $worksheet = $spreadsheet->getActiveSheet();
            $highestRow = $worksheet->getHighestRow();
            
            // Validate minimum rows (header + at least one data row)
            if ($highestRow < 2) {
                return $this->error('الملف فارغ أو لا يحتوي على بيانات صالحة.', 400);
            }

            $importedData = [];
            $errors = [];
            $successCount = 0;
            $skipCount = 0;
            
            // Start database transaction
            DB::beginTransaction();
            try {
                // Process each row (skip header row 1)
                for ($row = 2; $row <= $highestRow; $row++) {
                    // Skip if asset number is empty (likely empty row)
                    $assetNumber = $worksheet->getCell('C' . $row)->getCalculatedValue();
                    if (empty($assetNumber)) {
                        $skipCount++;
                        continue;
                    }
                    
                    try {
                        // Extract data from Excel row
                        $rowData = $this->extractRowData($worksheet, $row);
                        
                        // Validate the row data
                        $validationResult = $this->validateImportRow($rowData, $row);
                        if (!$validationResult['valid']) {
                            $errors[] = "الصف {$row}: " . implode(', ', $validationResult['errors']);
                            continue;
                        }
                        
                        // Check if asset already exists
                        $existingAsset = Asset::where('number', $rowData['number'])->first();
                        if ($existingAsset) {
                            // Update existing asset
                            $existingAsset->update($rowData);
                            $importedData[] = [
                                'row' => $row,
                                'asset_number' => $rowData['number'],
                                'action' => 'updated'
                            ];
                        } else {
                            // Create new asset
                            Asset::create($rowData);
                            $importedData[] = [
                                'row' => $row,
                                'asset_number' => $rowData['number'],
                                'action' => 'created'
                            ];
                        }
                        $successCount++;
                    } catch (\Exception $e) {
                        $errors[] = "الصف {$row}: خطأ في المعالجة - " . $e->getMessage();
                    }
                }
                
                // If there are critical errors, rollback
                if (!empty($errors) && $successCount === 0) {
                    DB::rollback();
                    return $this->error('فشل في استيراد البيانات: ' . implode(', ', $errors), 400);
                }
                
                // Commit transaction
                DB::commit();
                
                // Prepare response
                $message = "تم الاستيراد بنجاح. تم إنشاء/تحديث {$successCount} سجل";
                if ($skipCount > 0) {
                    $message .= "، تم تخطي {$skipCount} صف";
                }
                if (!empty($errors)) {
                    $message .= ". توجد أخطاء في بعض الصفوف.";
                }
                
                return $this->success([
                    'imported_count' => $successCount,
                    'skipped_count' => $skipCount,
                    'error_count' => count($errors),
                    'imported_data' => $importedData,
                    'errors' => $errors
                ], $message);
            } catch (\Exception $e) {
                DB::rollback();
                return $this->error('خطأ في استيراد البيانات: ' . $e->getMessage(), 500);
            }
        } catch (\Exception $e) {
            return $this->error('خطأ في قراءة الملف: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Extract data from Excel row
     */
    private function extractRowData($worksheet, $row): array
    {
        return [
            'name' => $worksheet->getCell('B' . $row)->getCalculatedValue(),
            'number' => $worksheet->getCell('C' . $row)->getCalculatedValue(),
            'manufacturer_serial' => $worksheet->getCell('D' . $row)->getCalculatedValue(),
            'purchase_date' => $this->parseExcelDate($worksheet->getCell('E' . $row)->getCalculatedValue()),
            'status' => $this->mapStatusValue($worksheet->getCell('F' . $row)->getCalculatedValue()),
            'type_id' => $this->getTypeIdByName($worksheet->getCell('G' . $row)->getCalculatedValue()),
            'employee_id' => $this->getEmployeeIdByName($worksheet->getCell('H' . $row)->getCalculatedValue()),
            'location_id' => $this->getLocationIdByName($worksheet->getCell('I' . $row)->getCalculatedValue()),
            'notes' => $worksheet->getCell('J' . $row)->getCalculatedValue(),
        ];
    }

    /**
     * Parse Excel date value
     */
    private function parseExcelDate($value)
    {
        if (empty($value)) {
            return null;
        }
        try {
            // If it's already a date object
            if ($value instanceof \DateTime) {
                return Carbon::instance($value)->format('Y-m-d');
            }
            // If it's an Excel date serial number
            if (is_numeric($value)) {
                $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value);
                return Carbon::instance($date)->format('Y-m-d');
            }
            // Try to parse as string date
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Map status label to internal value
     */
    private function mapStatusValue($statusLabel): ?string
    {
        if (empty($statusLabel)) {
            return null;
        }
        
        $statusMap = [
            'قيد الاستخدام' => 'in_use',
            'في المخزن' => 'in_storage',
            'تحت الصيانة' => 'maintenance',
            'تالف' => 'damaged'
        ];
        
        return $statusMap[$statusLabel] ?? null;
    }

    /**
     * Get type ID by name
     */
    private function getTypeIdByName($typeName): ?int
    {
        if (empty($typeName)) {
            return null;
        }
        
        $type = Type::where('name', $typeName)->first();
        if ($type) {
            return $type->id;
        } else {
            $newType = new Type();
            $newType->name = $typeName;
            $newType->save();
            return $newType->id;
        }       
    }

    /**
     * Get employee ID by name
     */
    private function getEmployeeIdByName($employeeName): ?int
    {
        if (empty($employeeName)) {
            return null;
        }
        
        $employee = Employee::where('full_name', $employeeName)->first();
        if ($employee) {
            return $employee->id;
        } else {
            $newEmployee = new Employee();
            $newEmployee->number = 0;
            $newEmployee->full_name = $employeeName;
            $newEmployee->save();
            return $newEmployee->id;
        }    
    }

    /**
     * Get location ID by name
     */
    private function getLocationIdByName($locationName): ?int
    {
        if (empty($locationName)) {
            return null;
        }
        
        $location = Location::where('name', $locationName)->first();
        if ($location) {
            return $location->id;
        } else {
            $newLocation = new Location();
            $newLocation->name = $locationName;
            $newLocation->save();
            return $newLocation->id;
        }
    }

    /**
     * Validate import row data
     */
    private function validateImportRow(array $data, int $rowNumber): array
    {
        $errors = [];
        
        // Required fields validation
        if (empty($data['name'])) {
            $errors[] = 'الاسم مطلوب';
        }
        if (empty($data['number'])) {
            $errors[] = 'الرقم مطلوب';
        }
        if (empty($data['status'])) {
            $errors[] = 'الحالة مطلوبة';
        }
        if (empty($data['type_id'])) {
            $errors[] = 'نوع الأصل غير موجود';
        }
        
        // Status validation
        if (!empty($data['status']) && !in_array($data['status'], ['in_use', 'in_storage', 'maintenance', 'damaged'])) {
            $errors[] = 'قيمة الحالة غير صالحة';
        }
        
        // Date validation
        if (!empty($data['purchase_date'])) {
            try {
                Carbon::parse($data['purchase_date']);
            } catch (\Exception $e) {
                $errors[] = 'تاريخ الشراء غير صالح';
            }
        }
        
        return [
            'valid' => empty($errors),
            'errors' => $errors
        ];
    }

    /**
     * Download import template
     */
    public function downloadTemplate(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        // Create spreadsheet with headers only
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Set headers (same as export)
        $headers = [
            'A1' => 'م',
            'B1' => 'الاسم',
            'C1' => 'الرقم',
            'D1' => 'الرقم التسلسلي للشركة المصنعة',
            'E1' => 'تاريخ الشراء',
            'F1' => 'الحالة',
            'G1' => 'النوع',
            'H1' => 'الموظف',
            'I1' => 'الإدارة',
            'J1' => 'الملاحظات'
        ];
        
        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }
        
        // Add sample row with instructions
        $sheet->setCellValue('A2', '1');
        $sheet->setCellValue('B2', 'حاسوب محمول');
        $sheet->setCellValue('C2', 'AST-001');
        $sheet->setCellValue('D2', 'SN123456789');
        $sheet->setCellValue('E2', '2024-01-15');
        $sheet->setCellValue('F2', 'قيد الاستخدام');
        $sheet->setCellValue('G2', 'أجهزة كمبيوتر');
        $sheet->setCellValue('H2', 'أحمد محمد');
        $sheet->setCellValue('I2', 'المقر الرئيسي');
        $sheet->setCellValue('J2', 'ملاحظات');
        
        // Style headers
        $sheet->getStyle('A1:J1')->getFont()->setBold(true);
        $sheet->getStyle('A1:J1')->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFCCCCCC');
        
        // Auto-size columns
        foreach (range('A', 'J') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        // Create writer and return file
        $writer = new Xlsx($spreadsheet);
        $filename = 'assets_template.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $filename);
        $writer->save($temp_file);
        
        return response()->download($temp_file, $filename)->deleteFileAfterSend(true);
    }

}
