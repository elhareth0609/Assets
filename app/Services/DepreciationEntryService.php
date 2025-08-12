<?php

namespace App\Services;

use App\Interfaces\DepreciationEntryRepositoryInterface;

class DepreciationEntryService {
    private $DepreciationEntryRepository;

    public function __construct(DepreciationEntryRepositoryInterface $DepreciationEntryRepository) {
        $this->DepreciationEntryRepository = $DepreciationEntryRepository;
    }

    public function getDepreciationEntry($id) {
        return $this->DepreciationEntryRepository->find($id);
    }

    public function allDepreciationEntrys() {
        return $this->DepreciationEntryRepository->all();
    }

    public function activedDepreciationEntrys() {
        return $this->DepreciationEntryRepository->actived();
    }

    public function createDepreciationEntry(array $data) {
        return $this->DepreciationEntryRepository->create($data);
    }

    public function updateDepreciationEntry($id, array $data) {
        return $this->DepreciationEntryRepository->update($id, $data);
    }

    public function deleteDepreciationEntry($id) {
        return $this->DepreciationEntryRepository->delete($id);
    }
}
