<?php

namespace App\Repositories;

use App\Interfaces\InstitutionRepositoryInterface;
use App\Models\Institution;

class InstitutionRepository implements InstitutionRepositoryInterface {
    private $Institution;

    public function __construct(Institution $Institution) {
        $this->Institution = $Institution;
    }

    public function find($id) {
        return $this->Institution->findOrFail($id);
    }

    public function create(array $data) {
        return $this->Institution->create($data);
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
        return $this->Institution->all();
    }

    public function actived() {
        return $this->Institution->where('status', 'active')->get();
    }
}