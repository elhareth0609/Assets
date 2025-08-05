<?php

namespace App\Repositories;

use App\Interfaces\DepreciationEntryRepositoryInterface;
use App\Models\DepreciationEntry;

class DepreciationEntryRepository implements DepreciationEntryRepositoryInterface {
    private $DepreciationEntry;

    public function __construct(DepreciationEntry $DepreciationEntry) {
        $this->DepreciationEntry = $DepreciationEntry;
    }

    public function find($id) {
        return $this->DepreciationEntry->findOrFail($id);
    }

    public function create(array $data) {
        return $this->DepreciationEntry->create($data);
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
        return $this->DepreciationEntry->all();
    }

    public function actived() {
        return $this->DepreciationEntry->where('status', 'active')->get();
    }
}