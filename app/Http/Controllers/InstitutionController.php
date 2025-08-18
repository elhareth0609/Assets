<?php
namespace App\Http\Controllers;
use App\Http\Requests\Institution\InstitutionRequest;
use App\Http\Resources\Institution\InstitutionResource;
use App\Services\InstitutionService;
use App\Services\UserService;
use App\Traits\ApiResponder;
use Illuminate\Support\Facades\DB;
class InstitutionController extends Controller
{
    use ApiResponder;
    private $InstitutionService;
    private $UserService;
    
    public function __construct(InstitutionService $InstitutionService, UserService $UserService)
    {
        $this->InstitutionService = $InstitutionService;
        $this->UserService = $UserService;
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
    
    public function all()
    {
        if ($response = $this->checkPermissionAndRespond('institutions.view')) {
            return $response;
        }
        return $this->success(InstitutionResource::collection(
            $this->InstitutionService->allInstitutions()
        ));
    }
    
    public function get($id)
    {
        if ($response = $this->checkPermissionAndRespond('institutions.view')) {
            return $response;
        }
        return $this->success(new InstitutionResource(
            $this->InstitutionService->getInstitution($id)
        ));
    }
    
    public function create(InstitutionRequest $request)
    {
        if ($response = $this->checkPermissionAndRespond('institutions.create')) {
            return $response;
        }
        
        $validated = $request->validated();
        return DB::transaction(function () use ($validated) {
            $user = $this->UserService->createUser($validated);
            $institution = $this->InstitutionService->createInstitution(array_merge(
                $validated,
                ['user_id' => $user->id]
            ));
            return $this->success(new InstitutionResource($institution), __('Created Successfully.'));
        });
    }
    
    public function update(InstitutionRequest $request, $id)
    {
        if ($response = $this->checkPermissionAndRespond('institutions.update')) {
            return $response;
        }
        
        return $this->success(
            new InstitutionResource(
                $this->InstitutionService->updateInstitution($id, $request->validated())
            ),
            __('Updated Successfully.')
        );
    }
    
    public function delete($id)
    {
        if ($response = $this->checkPermissionAndRespond('institutions.delete')) {
            return $response;
        }
        
        $this->InstitutionService->deleteInstitution($id);
        return $this->success(null, __('Deleted Successfully.'));
    }
}