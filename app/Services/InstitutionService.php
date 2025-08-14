<?php

namespace App\Services;

use App\Interfaces\InstitutionRepositoryInterface;

class InstitutionService {
    private $InstitutionRepository;

    public function __construct(InstitutionRepositoryInterface $InstitutionRepository) {
        $this->InstitutionRepository = $InstitutionRepository;
    }

    public function getInstitution($id) {
        return $this->InstitutionRepository->find($id);
    }

    public function allInstitutions() {
        return $this->InstitutionRepository->all();
    }

    public function activedInstitutions() {
        return $this->InstitutionRepository->actived();
    }

    public function createInstitution(array $data) {
        return $this->InstitutionRepository->create($data);
    }

    public function updateInstitution($id, array $data) {
        return $this->InstitutionRepository->update($id, $data);
    }

    public function deleteInstitution($id) {
        return $this->InstitutionRepository->delete($id);
    }
}