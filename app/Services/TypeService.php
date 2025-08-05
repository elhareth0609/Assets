<?php

namespace App\Services;

use App\Interfaces\TypeRepositoryInterface;

class TypeService {
    private $TypeRepository;

    public function __construct(TypeRepositoryInterface $TypeRepository) {
        $this->TypeRepository = $TypeRepository;
    }

    public function getType($id) {
        return $this->TypeRepository->find($id);
    }

    public function allTypes() {
        return $this->TypeRepository->all();
    }

    public function activedTypes() {
        return $this->TypeRepository->actived();
    }

    public function createType(array $data) {
        return $this->TypeRepository->create($data);
    }

    public function updateType($id, array $data) {
        return $this->TypeRepository->update($id, $data);
    }

    public function deleteType($id) {
        return $this->TypeRepository->delete($id);
    }
}