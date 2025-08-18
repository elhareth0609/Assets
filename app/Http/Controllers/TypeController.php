<?php
namespace App\Http\Controllers;
use App\Http\Requests\Type\App\TypeRequest;
use App\Http\Resources\Type\App\TypeResource;
use App\Services\TypeService;
use App\Traits\ApiResponder;
class TypeController extends Controller {
    use ApiResponder;
    private $TypeService;
    
    public function __construct(TypeService $TypeService) {
        $this->TypeService = $TypeService;
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
        if ($response = $this->checkPermissionAndRespond('types.view')) {
            return $response;
        }
        return $this->success(TypeResource::collection($this->TypeService->allTypes()));
    }
    
    public function get($id) {
        if ($response = $this->checkPermissionAndRespond('types.view')) {
            return $response;
        }
        return $this->success(new TypeResource($this->TypeService->getType($id)));
    }
    
    public function create(TypeRequest $request) {
        if ($response = $this->checkPermissionAndRespond('types.create')) {
            return $response;
        }
        return $this->success(new TypeResource($this->TypeService->createType($request->validated())), 'تم الإنشاء بنجاح');
    }
    
    public function update(TypeRequest $request, $id) {
        if ($response = $this->checkPermissionAndRespond('types.update')) {
            return $response;
        }
        return $this->success(new TypeResource($this->TypeService->updateType($id, $request->validated())), 'تم التحديث بنجاح');
    }
    
    public function delete($id) {
        if ($response = $this->checkPermissionAndRespond('types.delete')) {
            return $response;
        }
        $this->TypeService->deleteType($id);
        return $this->success(null, 'تم الحذف بنجاح');
    }
}