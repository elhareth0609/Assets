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
    
    /**
     * Helper method to check permissions and handle response
     */
    private function checkPermissionAndRespond($permission) {
        $permissionCheck = $this->checkPermission($permission, true);
        if ($permissionCheck) {
            return $permissionCheck;
        }
        return null;
    }
    
    public function all() {
        if ($response = $this->checkPermissionAndRespond('locations.view')) {
            return $response;
        }
        return $this->success(LocationResource::collection($this->LocationService->allLocations()));
    }
    
    public function get($id) {
        if ($response = $this->checkPermissionAndRespond('locations.view')) {
            return $response;
        }
        return $this->success(new LocationResource($this->LocationService->getLocation($id)));
    }
    
    public function create(LocationRequest $request) {
        if ($response = $this->checkPermissionAndRespond('locations.create')) {
            return $response;
        }
        return $this->success(new LocationResource($this->LocationService->createLocation($request->validated())), 'تم الإنشاء بنجاح');
    }
    
    public function update(LocationRequest $request, $id) {
        if ($response = $this->checkPermissionAndRespond('locations.update')) {
            return $response;
        }
        return $this->success(new LocationResource($this->LocationService->updateLocation($id, $request->validated())), 'تم التحديث بنجاح');
    }
    
    public function delete($id) {
        if ($response = $this->checkPermissionAndRespond('locations.delete')) {
            return $response;
        }
        $this->LocationService->deleteLocation($id);
        return $this->success(null, 'تم الحذف بنجاح');
    }
}