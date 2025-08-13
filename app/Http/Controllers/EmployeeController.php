<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\App\EmployeeRequest;
use App\Http\Resources\Employee\App\EmployeeResource;
use App\Models\Employee;
use App\Models\Location;
use App\Services\EmployeeService;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
            $id  = trim($row[0] ?? ''); // معرف الموظف
            $fullName  = trim($row[1] ?? ''); // اسم الموظف
            $jobTitle  = trim($row[2] ?? ''); // المسمى الوظيفي
            $location  = trim($row[3] ?? ''); // الإدارة
            $email     = trim($row[4] ?? ''); // الايميل

            if (empty($fullName) || empty($email)) {
                continue; // skip invalid rows
            }

            // Create location if needed (if locations table exists)
            $locationModel = null;
            if (!empty($location)) {
                $locationModel = Location::firstOrCreate(['name' => $location]);
            }

            if (!empty($id)) {
                // Update existing or create with specific ID
                Employee::updateOrCreate(
                    ['id' => $id],
                    [
                        'location_id' => $locationModel?->id,
                        'full_name'   => $fullName,
                        'email'       => $email,
                        'job_title'   => $jobTitle,
                    ]
                );
            } else {
                // Just create a new employee without forcing the ID
                Employee::create([
                    'location_id' => $locationModel?->id,
                    'full_name'   => $fullName,
                    'email'       => $email,
                    'job_title'   => $jobTitle,
                ]);
            }

        }

        return $this->success(null, 'تم الاستيراد بنجاح');
    }

}
