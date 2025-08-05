<?php

namespace App\Repositories;

use App\Interfaces\TypeRepositoryInterface;
use App\Models\Type;

class TypeRepository implements TypeRepositoryInterface {
    private $Type;

    public function __construct(Type $Type) {
        $this->Type = $Type;
    }

    public function find($id) {
        return $this->Type->findOrFail($id);
    }

    public function create(array $data) {
        return $this->Type->create($data);
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
        return $this->Type->all();
    }

    public function actived() {
        return $this->Type->where('status', 'active')->get();
    }
}