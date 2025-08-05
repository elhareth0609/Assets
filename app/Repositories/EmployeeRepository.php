<?php

namespace App\Repositories;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\Employee;

class EmployeeRepository implements EmployeeRepositoryInterface {
    private $Employee;

    public function __construct(Employee $Employee) {
        $this->Employee = $Employee;
    }

    public function find($id) {
        return $this->Employee->findOrFail($id);
    }

    public function create(array $data) {
        return $this->Employee->create($data);
    }

    public function update($id, array $data) {
        $model = $this->find($id);
        $model->update($data);
        return $model;
    }

    public function delete($id) {
        return $this->find($id)->delete();
    }

    public function all() {
        return $this->Employee->all();
    }

    public function actived() {
        return $this->Employee->where('status', 'active')->get();
    }
}