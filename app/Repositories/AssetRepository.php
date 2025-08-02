<?php

namespace App\Repositories;

use App\Interfaces\AssetRepositoryInterface;
use App\Models\Asset;

class AssetRepository implements AssetRepositoryInterface {
    private $Asset;

    public function __construct(Asset $Asset) {
        $this->Asset = $Asset;
    }

    public function find($id) {
        return $this->Asset->findOrFail($id);
    }

    public function create(array $data) {
        return $this->Asset->create($data);
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
        return $this->Asset->all();
    }

    public function actived() {
        return $this->Asset->where('status', 'active')->get();
    }
}