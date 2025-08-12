<?php

namespace App\Http\Controllers;

use App\Http\Requests\Asset\App\AssetRequest;
use App\Http\Resources\Asset\App\AssetResource;
use App\Models\Asset;
use App\Services\AssetService;
use App\Services\EmployeeService;
use App\Services\LocationService;
use App\Services\TypeService;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
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
        $sheet->setCellValue('H1', 'الموظف المسؤول');
        $sheet->setCellValue('I1', 'الموقع');
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

}
