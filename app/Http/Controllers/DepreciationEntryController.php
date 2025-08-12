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
