<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepreciationEntry\App\EditDepreciationEntryRequest;
use App\Http\Requests\DepreciationEntry\App\StoreDepreciationEntryRequest;
use App\Http\Resources\DepreciationEntry\App\DepreciationEntryResource;
use App\Models\DepreciationEntry;
use App\Services\DepreciationEntryService;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

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
        return $this->success(new DepreciationEntryResource($this->DepreciationEntryService->createDepreciationEntry($request->validated())), __('Created Successfully.'));
    }

    public function update(EditDepreciationEntryRequest $request, $id) {
        return $this->success(new DepreciationEntryResource($this->DepreciationEntryService->updateDepreciationEntry($id, $request->validated())), __('Updated Successfully.'));
    }

    public function delete($id) {
        $this->DepreciationEntryService->deleteDepreciationEntry($id);
        return $this->success(null, __('Deleted Successfully.'));
    }

    public function export(Request $request)
    {
        $query = DepreciationEntry::with('asset');

        // Apply filters
        if ($request->has('year') && $request->year != '') {
            $query->where('depreciation_year', $request->year);
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
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
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
            $sheet->setCellValue('C' . $row, $entry->date ? date('d/m/Y', strtotime($entry->date)) : '');
            $sheet->setCellValue('D' . $row, $entry->description);
            $sheet->setCellValue('E' . $row, $entry->depreciation_rate);
            $sheet->setCellValue('F' . $row, $entry->depreciation_start_date ? date('d/m/Y', strtotime($entry->depreciation_start_date)) : '');
            $sheet->setCellValue('G' . $row, $entry->depreciation_year);
            $sheet->setCellValue('H' . $row, $entry->days_count);
            $sheet->setCellValue('I' . $row, $entry->purchase_cost);
            $sheet->setCellValue('J' . $row, $entry->additions);
            $sheet->setCellValue('K' . $row, $entry->exclusions);
            $sheet->setCellValue('L' . $row, $entry->asset_cost_at_end);
            $sheet->setCellValue('M' . $row, $entry->accumulated_depreciation_at_start);
            $sheet->setCellValue('N' . $row, $entry->current_year_depreciation);
            $sheet->setCellValue('O' . $row, $entry->excluded_depreciation);
            $sheet->setCellValue('P' . $row, $entry->accumulated_depreciation_at_end);
            $sheet->setCellValue('Q' . $row, $entry->net_book_value);
            $sheet->setCellValue('R' . $row, $entry->classification);

            $row++;
        }

        // Add totals row
        $sheet->setCellValue('A' . $row, 'الإجمالي');
        $sheet->setCellValue('I' . $row, $entries->sum('purchase_cost'));
        $sheet->setCellValue('J' . $row, $entries->sum('additions'));
        $sheet->setCellValue('K' . $row, $entries->sum('exclusions'));
        $sheet->setCellValue('L' . $row, $entries->sum('asset_cost_at_end'));
        $sheet->setCellValue('M' . $row, $entries->sum('accumulated_depreciation_at_start'));
        $sheet->setCellValue('N' . $row, $entries->sum('current_year_depreciation'));
        $sheet->setCellValue('O' . $row, $entries->sum('excluded_depreciation'));
        $sheet->setCellValue('P' . $row, $entries->sum('accumulated_depreciation_at_end'));
        $sheet->setCellValue('Q' . $row, $entries->sum('net_book_value'));

        // Style the totals row
        $sheet->getStyle('A' . $row . ':R' . $row)->getFont()->setBold(true);

        // Create writer and output
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="depreciation_entries.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
