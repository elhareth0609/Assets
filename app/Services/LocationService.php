<?php

namespace App\Services;

use App\Interfaces\LocationRepositoryInterface;

class LocationService {
    private $LocationRepository;

    public function __construct(LocationRepositoryInterface $LocationRepository) {
        $this->LocationRepository = $LocationRepository;
    }

    public function getLocation($id) {
        return $this->LocationRepository->find($id);
    }

    public function allLocations() {
        return $this->LocationRepository->all();
    }

    public function activedLocations() {
        return $this->LocationRepository->actived();
    }

    public function createLocation(array $data) {
        return $this->LocationRepository->create($data);
    }

    public function updateLocation($id, array $data) {
        return $this->LocationRepository->update($id, $data);
    }

    public function deleteLocation($id) {
        return $this->LocationRepository->delete($id);
    }
}