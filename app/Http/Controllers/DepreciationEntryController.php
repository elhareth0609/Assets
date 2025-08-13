<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepreciationEntry\App\EditDepreciationEntryRequest;
use App\Http\Requests\DepreciationEntry\App\StoreDepreciationEntryRequest;
use App\Http\Resources\DepreciationEntry\App\DepreciationEntryResource;
use App\Models\DepreciationEntry;
use App\Services\DepreciationEntryService;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Exception;

class DepreciationEntryController extends Controller {
    use ApiResponder;

    private $DepreciationEntryService;

    public function __construct(DepreciationEntryService $DepreciationEntryService) {
        $this->DepreciationEntryService = $DepreciationEntryService;
    }

    public function all() {
        return $this->success(DepreciationEntryResource::collection($this->DepreciationEntryService->allDepreciationEntrys()));
    }

    public function get($id) {
        return $this->success(new DepreciationEntryResource($this->DepreciationEntryService->getDepreciationEntry($id)));
    }

    public function create(StoreDepreciationEntryRequest $request) {
        return $this->success(new DepreciationEntryResource($this->DepreciationEntryService->createDepreciationEntry($request->validated())), 'تم الإنشاء بنجاح');
    }

    public function update(EditDepreciationEntryRequest $request, $id) {
        return $this->success(new DepreciationEntryResource($this->DepreciationEntryService->updateDepreciationEntry($id, $request->validated())), 'تم التحديث بنجاح');
    }

    public function delete($id) {
        $this->DepreciationEntryService->deleteDepreciationEntry($id);
        return $this->success(null, 'تم الحذف بنجاح');
    }

    /**
     * Import depreciation entries from Excel file
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
                    // Skip if entry_number is empty (likely total row or empty row)
                    $entryNumber = $worksheet->getCell('B' . $row)->getCalculatedValue();
                    if (empty($entryNumber) || $entryNumber === 'الإجمالي') {
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

                        // Check if entry already exists
                        $existingEntry = DepreciationEntry::where('entry_number', $rowData['entry_number'])->first();

                        if ($existingEntry) {
                            // Update existing entry
                            $existingEntry->update($rowData);
                            $importedData[] = [
                                'row' => $row,
                                'entry_number' => $rowData['entry_number'],
                                'action' => 'updated'
                            ];
                        } else {
                            // Create new entry
                            DepreciationEntry::create($rowData);
                            $importedData[] = [
                                'row' => $row,
                                'entry_number' => $rowData['entry_number'],
                                'action' => 'created'
                            ];
                        }

                        $successCount++;

                    } catch (Exception $e) {
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

            } catch (Exception $e) {
                DB::rollback();
                return $this->error('خطأ في استيراد البيانات: ' . $e->getMessage(), 500);
            }

        } catch (Exception $e) {
            return $this->error('خطأ في قراءة الملف: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Extract data from Excel row
     */
    private function extractRowData($worksheet, $row): array
    {
        return [
            'entry_number' => $worksheet->getCell('B' . $row)->getCalculatedValue(),
            'date' => $this->parseExcelDate($worksheet->getCell('C' . $row)->getCalculatedValue()),
            'description' => $worksheet->getCell('D' . $row)->getCalculatedValue(),
            'depreciation_rate' => (float) $worksheet->getCell('E' . $row)->getCalculatedValue(),
            'depreciation_start_date' => $this->parseExcelDate($worksheet->getCell('F' . $row)->getCalculatedValue()),
            'depreciation_year' => $this->parseExcelDate($worksheet->getCell('G' . $row)->getCalculatedValue()),
            'purchase_cost' => (float) $worksheet->getCell('I' . $row)->getCalculatedValue(),
            'additions' => (float) $worksheet->getCell('J' . $row)->getCalculatedValue(),
            'exclusions' => (float) $worksheet->getCell('K' . $row)->getCalculatedValue(),
            'accumulated_depreciation_at_start' => (float) $worksheet->getCell('M' . $row)->getCalculatedValue(),
            'excluded_depreciation' => (float) $worksheet->getCell('O' . $row)->getCalculatedValue(),
            'classification' => $worksheet->getCell('R' . $row)->getCalculatedValue(),
            // You might need to handle asset_id separately based on your business logic
            // For now, setting it to null - you may want to match by asset name/number
            'asset_id' => null,
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

        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Validate import row data
     */
    private function validateImportRow(array $data, int $rowNumber): array
    {
        $errors = [];

        // Required fields validation
        if (empty($data['entry_number'])) {
            $errors[] = 'رقم القيد مطلوب';
        }

        if (empty($data['description'])) {
            $errors[] = 'الوصف مطلوب';
        }

        // Numeric validations
        if (!is_numeric($data['depreciation_rate']) || $data['depreciation_rate'] < 0 || $data['depreciation_rate'] > 100) {
            $errors[] = 'نسبة الاهلاك يجب أن تكون بين 0 و 100';
        }

        if (!is_numeric($data['purchase_cost']) || $data['purchase_cost'] < 0) {
            $errors[] = 'تكلفة الشراء يجب أن تكون رقم موجب';
        }

        // Date validations
        if ($data['depreciation_start_date'] && $data['depreciation_year']) {
            try {
                $startDate = Carbon::parse($data['depreciation_start_date']);
                $yearDate = Carbon::parse($data['depreciation_year']);

                if ($yearDate->lt($startDate)) {
                    $errors[] = 'سنة احتساب الاهلاك يجب أن تكون بعد بداية الاهلاك';
                }
            } catch (Exception $e) {
                $errors[] = 'تواريخ غير صالحة';
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
            'B1' => 'رقم القيد',
            'C1' => 'التاريخ',
            'D1' => 'الوصف',
            'E1' => 'نسبة الاهلاك',
            'F1' => 'بداية الاهلاك',
            'G1' => 'سنة احتساب الاهلاك',
            'H1' => 'عدد الأيام',
            'I1' => 'تكلفة الشراء',
            'J1' => 'الإضافات',
            'K1' => 'الاستبعادات',
            'L1' => 'تكلفة الأصل في',
            'M1' => 'مجمع الاهلاك في',
            'N1' => 'اهلاك السنة',
            'O1' => 'الاهلاك المستبعد',
            'P1' => 'مجمع الاهلاك في',
            'Q1' => 'صافي القيمة الدفترية',
            'R1' => 'التصنيف'
        ];

        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        // Add sample row with instructions
        $sheet->setCellValue('A2', '1');
        $sheet->setCellValue('B2', 'DEP-001');
        $sheet->setCellValue('C2', '2024-01-01');
        $sheet->setCellValue('D2', 'مثال على قيد الاهلاك');
        $sheet->setCellValue('E2', '10');
        $sheet->setCellValue('F2', '2024-01-01');
        $sheet->setCellValue('G2', '2024-12-31');
        $sheet->setCellValue('I2', '100000');
        $sheet->setCellValue('J2', '0');
        $sheet->setCellValue('K2', '0');
        $sheet->setCellValue('M2', '0');
        $sheet->setCellValue('O2', '0');
        $sheet->setCellValue('R2', 'معدات');

        // Style headers
        $sheet->getStyle('A1:R1')->getFont()->setBold(true);

        // Auto-size columns
        foreach (range('A', 'R') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Create writer and return file
        $writer = new Xlsx($spreadsheet);
        $filename = 'depreciation_entries_template.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $filename);
        $writer->save($temp_file);

        return response()->download($temp_file, $filename)->deleteFileAfterSend(true);
    }

    public function export(Request $request) {
        $query = DepreciationEntry::with('asset');
        // Apply filters
        if ($request->has('year') && $request->year != '') {
            $query->whereYear('depreciation_year', $request->year);
        }
        if ($request->has('asset_id') && $request->asset_id != '') {
            $query->where('asset_id', $request->asset_id);
        }
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('entry_number', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('classification', 'like', "%{$search}%")
                ->orWhereHas('asset', function($assetQuery) use ($search) {
                    $assetQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('number', 'like', "%{$search}%");
                });
            });
        }
        $entries = $query->orderBy('entry_number', 'asc')->get();

        // Create spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'م');
        $sheet->setCellValue('B1', 'رقم القيد');
        $sheet->setCellValue('C1', 'التاريخ');
        $sheet->setCellValue('D1', 'الوصف');
        $sheet->setCellValue('E1', 'نسبة الاهلاك');
        $sheet->setCellValue('F1', 'بداية الاهلاك');
        $sheet->setCellValue('G1', 'سنة احتساب الاهلاك');
        $sheet->setCellValue('H1', 'عدد الأيام');
        $sheet->setCellValue('I1', 'تكلفة الشراء');
        $sheet->setCellValue('J1', 'الإضافات');
        $sheet->setCellValue('K1', 'الاستبعادات');
        $sheet->setCellValue('L1', 'تكلفة الأصل في');
        $sheet->setCellValue('M1', 'مجمع الاهلاك في');
        $sheet->setCellValue('N1', 'اهلاك السنة');
        $sheet->setCellValue('O1', 'الاهلاك المستبعد');
        $sheet->setCellValue('P1', 'مجمع الاهلاك في');
        $sheet->setCellValue('Q1', 'صافي القيمة الدفترية');
        $sheet->setCellValue('R1', 'التصنيف');

        // Add data
        $row = 2;
        foreach ($entries as $entry) {
            $sheet->setCellValue('A' . $row, $row - 1);
            $sheet->setCellValue('B' . $row, $entry->entry_number);
            $sheet->setCellValue('C' . $row, $entry->date ? Date::PHPToExcel($entry->date) : '');
            $sheet->setCellValue('D' . $row, $entry->description);
            $sheet->setCellValue('E' . $row, $entry->depreciation_rate);
            $sheet->setCellValue('F' . $row, $entry->depreciation_start_date ? Date::PHPToExcel($entry->depreciation_start_date) : '');
            $sheet->setCellValue('G' . $row, $entry->depreciation_year ? Date::PHPToExcel($entry->depreciation_year) : '');
            // $sheet->setCellValue('G' . $row, $entry->depreciation_year);

            // Days Count Formula
            $daysCountFormula = '=G' . $row . '-F' . $row;
            $sheet->setCellValue('H' . $row, $daysCountFormula);

            $sheet->setCellValue('I' . $row, $entry->purchase_cost);
            $sheet->setCellValue('J' . $row, $entry->additions);
            $sheet->setCellValue('K' . $row, $entry->exclusions);

            // Asset Cost at End Formula
            $assetCostFormula = '=I' . $row . '+J' . $row . '+K' . $row;
            $sheet->setCellValue('L' . $row, $assetCostFormula);

            $sheet->setCellValue('M' . $row, $entry->accumulated_depreciation_at_start);

            // Current Year Depreciation Formula
            $depreciationFormula = '=L' . $row . '*E' . $row . '/365*H' . $row;

            $sheet->setCellValue('N' . $row, $depreciationFormula);

            $sheet->setCellValue('O' . $row, $entry->excluded_depreciation);

            // Accumulated Depreciation at End Formula
            $accumulatedFormula = '=M' . $row . '+N' . $row . '+O' . $row;
            $sheet->setCellValue('P' . $row, $accumulatedFormula);

            // Net Book Value Formula
            $netBookValueFormula = '=L' . $row . '-P' . $row;
            $sheet->setCellValue('Q' . $row, $netBookValueFormula);

            $sheet->setCellValue('R' . $row, $entry->classification);
            $row++;
        }

        // Add totals row
        $sheet->setCellValue('A' . $row, 'الإجمالي');

        // Totals formulas
        $sheet->setCellValue('I' . $row, '=SUM(I2:I' . ($row-1) . ')');
        $sheet->setCellValue('J' . $row, '=SUM(J2:J' . ($row-1) . ')');
        $sheet->setCellValue('K' . $row, '=SUM(K2:K' . ($row-1) . ')');
        $sheet->setCellValue('L' . $row, '=SUM(L2:L' . ($row-1) . ')');
        $sheet->setCellValue('M' . $row, '=SUM(M2:M' . ($row-1) . ')');
        $sheet->setCellValue('N' . $row, '=SUM(N2:N' . ($row-1) . ')');
        $sheet->setCellValue('O' . $row, '=SUM(O2:O' . ($row-1) . ')');
        $sheet->setCellValue('P' . $row, '=SUM(P2:P' . ($row-1) . ')');
        $sheet->setCellValue('Q' . $row, '=SUM(Q2:Q' . ($row-1) . ')');

        // Style the totals row
        $sheet->getStyle('A' . $row . ':R' . $row)->getFont()->setBold(true);

        // Format date columns
        $sheet->getStyle('C2:C' . ($row-1))->getNumberFormat()->setFormatCode('dd/mm/yyyy');
        $sheet->getStyle('F2:F' . ($row-1))->getNumberFormat()->setFormatCode('dd/mm/yyyy');
        $sheet->getStyle('G2:G' . ($row-1))->getNumberFormat()->setFormatCode('dd/mm/yyyy');

        // Format numeric columns
        $sheet->getStyle('E2:E' . $row)->getNumberFormat()->setFormatCode('#,##0.00');
        $sheet->getStyle('H2:H' . $row)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle('I2:Q' . $row)->getNumberFormat()->setFormatCode('#,##0.00');

        // Auto-size columns
        foreach (range('A', 'R') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Create writer and output
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="depreciation_entries.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

}
