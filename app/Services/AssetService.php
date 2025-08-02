<?php

namespace App\Services;

use App\Interfaces\AssetRepositoryInterface;

class AssetService {
    private $AssetRepository;

    public function __construct(AssetRepositoryInterface $AssetRepository) {
        $this->AssetRepository = $AssetRepository;
    }

    public function getAsset($id) {
        return $this->AssetRepository->find($id);
    }

    public function allAssets() {
        return $this->AssetRepository->all();
    }

    public function activedAssets() {
        return $this->AssetRepository->actived();
    }

    public function createAsset(array $data) {
        return $this->AssetRepository->create($data);
    }

    public function updateAsset($id, array $data) {
        return $this->AssetRepository->update($id, $data);
    }

    public function deleteAsset($id) {
        return $this->AssetRepository->delete($id);
    }
}