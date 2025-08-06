<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\App\EmployeeRequest;
use App\Http\Resources\Employee\App\EmployeeResource;
use App\Services\EmployeeService;
use App\Traits\ApiResponder;

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
}