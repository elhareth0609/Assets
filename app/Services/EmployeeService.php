<?php

namespace App\Services;

use App\Interfaces\EmployeeRepositoryInterface;

class EmployeeService {
    private $EmployeeRepository;

    public function __construct(EmployeeRepositoryInterface $EmployeeRepository) {
        $this->EmployeeRepository = $EmployeeRepository;
    }

    public function getEmployee($id) {
        return $this->EmployeeRepository->find($id);
    }

    public function allEmployees() {
        return $this->EmployeeRepository->all();
    }

    public function activedEmployees() {
        return $this->EmployeeRepository->actived();
    }

    public function createEmployee(array $data) {
        return $this->EmployeeRepository->create($data);
    }

    public function updateEmployee($id, array $data) {
        return $this->EmployeeRepository->update($id, $data);
    }

    public function deleteEmployee($id) {
        return $this->EmployeeRepository->delete($id);
    }
}