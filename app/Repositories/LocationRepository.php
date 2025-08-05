<?php

namespace App\Repositories;

use App\Interfaces\LocationRepositoryInterface;
use App\Models\Location;

class LocationRepository implements LocationRepositoryInterface {
    private $Location;

    public function __construct(Location $Location) {
        $this->Location = $Location;
    }

    public function find($id) {
        return $this->Location->findOrFail($id);
    }

    public function create(array $data) {
        return $this->Location->create($data);
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
        return $this->Location->all();
    }

    public function actived() {
        return $this->Location->where('status', 'active')->get();
    }
}