<?php

namespace App\Http\Controllers;

use App\Http\Requests\Asset\App\AssetRequest;
use App\Http\Resources\Asset\App\AssetResource;
use App\Services\AssetService;
use App\Traits\ApiResponder;

class AssetController extends Controller {
    use ApiResponder;

    private $AssetService;

    public function __construct(AssetService $AssetService) {
        $this->AssetService = $AssetService;
    }

        public function index() {
        return view('content.assets');
    }

    public function create() {
        return view('content.assets.create');
    }

    public function show($id) {
        return view('content.assets.show')
            ->with('asset', $this->AssetService->getAsset($id));
    }

    public function edit($id) {
        return view('content.assets.edit')
            ->with('asset', $this->AssetService->getAsset($id));
    }

    public function all() {
        return $this->success(AssetResource::collection($this->AssetService->allAssets()));
    }

    public function get($id) {
        return $this->success(new AssetResource($this->AssetService->getAsset($id)));
    }

    public function store(AssetRequest $request) {
        return $this->success(new AssetResource($this->AssetService->createAsset($request->validated())), __('Created Successfully.'));
    }

    public function update(AssetRequest $request, $id) {
        return $this->success(new AssetResource($this->AssetService->updateAsset($id, $request->validated())), __('Updated Successfully.'));
    }

    public function delete($id) {
        $this->AssetService->deleteAsset($id);
        return $this->success(null, __('Deleted Successfully.'));
    }
}
