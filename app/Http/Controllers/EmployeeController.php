<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\App\EmployeeRequest;
use App\Http\Resources\Employee\App\EmployeeResource;
use App\Models\Employee;
use App\Models\Location;
use App\Services\EmployeeService;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class EmployeeController extends Controller {
    use ApiResponder;

    private $EmployeeService;

    public function __construct(EmployeeService $EmployeeService) {
        $this->EmployeeService = $EmployeeService;
    }

    public function all() {
        return $this->success(EmployeeResource::collection($this->EmployeeService->allEmployees()));
    }

    public function get($id) {
        return $this->success(new EmployeeResource($this->EmployeeService->getEmployee($id)));
    }

    public function create(EmployeeRequest $request) {
        return $this->success(new EmployeeResource($this->EmployeeService->createEmployee($request->validated())), 'تم الإنشاء بنجاح');
    }

    public function update(EmployeeRequest $request, $id) {
        return $this->success(new EmployeeResource($this->EmployeeService->updateEmployee($id, $request->validated())), 'تم التحديث بنجاح');
    }

    public function delete($id) {
        $this->EmployeeService->deleteEmployee($id);
        return $this->success(null, 'تم الحذف بنجاح');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls'
        ]);

        // Load the uploaded Excel file
        $spreadsheet = IOFactory::load($request->file('excel_file')->getPathName());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        // Assuming first row is header
        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // skip header

            // Columns: م | اسم الموظف | المسمى الوظيفي | الإدارة | الايميل
            $number  = $row[0]; // معرف الموظف
            $fullName  = trim($row[1] ?? ''); // اسم الموظف
            $jobTitle  = trim($row[2] ?? ''); // المسمى الوظيفي
            $location  = trim($row[3] ?? ''); // الإدارة
            $email     = trim($row[4] ?? ''); // الايميل

            if (empty($fullName) || empty($number) || empty($email)) {
                continue; // skip invalid rows
            }

            // Create location if needed (if locations table exists)
            $locationModel = null;
            if (!empty($location)) {
                $locationModel = Location::firstOrCreate(['name' => $location]);
            }

            $employee = Employee::where('number',$number)->first();
            if ($employee) {
                $employee->update([
                    'location_id' => $locationModel?->id,
                    'full_name'   => $fullName,
                    'email'       => $email,
                    'job_title'   => $jobTitle
                ]);
            } else {
                // Create new employee with specific ID
                Employee::create([
                    'number'      => $number,
                    'location_id' => $locationModel?->id,
                    'full_name'   => $fullName,
                    'email'       => $email,
                    'job_title'   => $jobTitle
                ]);
            }

        }

        return $this->success(null, 'تم الاستيراد بنجاح');
    }

    /**
     * Download import template
     */
    public function downloadTemplate(): BinaryFileResponse
    {
        // Create spreadsheet with headers only
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers (same as export)
        $headers = [
            'A1' => 'الرقم الوظيفي',
            'B1' => 'اسم الموظف',
            'C1' => 'الموسمى الوظيفي',
            'D1' => 'الإدارة',
            'E1' => 'البريد الإلكتروني',
        ];

        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        // Add sample row with instructions
        $sheet->setCellValue('A2', 'EMP-001');
        $sheet->setCellValue('B2', 'طارق القبسي');
        $sheet->setCellValue('C2', 'محاسب');
        $sheet->setCellValue('D2', 'مكتب المدير');
        $sheet->setCellValue('E2', 'example@gmail.com');

        // Style headers
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);

        // Auto-size columns
        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Create writer and return file
        $writer = new Xlsx($spreadsheet);
        $filename = 'employees_template.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $filename);
        $writer->save($temp_file);

        return response()->download($temp_file, $filename)->deleteFileAfterSend(true);
    }
}
