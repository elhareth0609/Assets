<?php

namespace App\Http\Controllers;

use App\Http\Requests\Location\App\LocationRequest;
use App\Http\Resources\Location\App\LocationResource;
use App\Services\LocationService;
use App\Traits\ApiResponder;

class LocationController extends Controller {
    use ApiResponder;

    private $LocationService;

    public function __construct(LocationService $LocationService) {
        $this->LocationService = $LocationService;
    }

    public function all() {
        return $this->success(LocationResource::collection($this->LocationService->allLocations()));
    }

    public function get($id) {
        return $this->success(new LocationResource($this->LocationService->getLocation($id)));
    }

    public function create(LocationRequest $request) {
        return $this->success(new LocationResource($this->LocationService->createLocation($request->validated())), 'تم الإنشاء بنجاح');
    }

    public function update(LocationRequest $request, $id) {
        return $this->success(new LocationResource($this->LocationService->updateLocation($id, $request->validated())), 'تم التحديث بنجاح');
    }

    public function delete($id) {
        $this->LocationService->deleteLocation($id);
        return $this->success(null, 'تم الحذف بنجاح');
    }
}