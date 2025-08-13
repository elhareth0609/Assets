<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\App\UserRequest;
use App\Http\Resources\User\App\UserResource;
use App\Services\UserService;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
        use ApiResponder;

    private $UserService;

    public function __construct(UserService $UserService) {
        if (Auth::user()->id != 1) {
            return redirect()->route('assets');
        }
        $this->UserService = $UserService;
    }

    public function all() {
        return $this->success(UserResource::collection($this->UserService->allUsers()));
    }

    public function get($id) {
        return $this->success(new UserResource($this->UserService->getUser($id)));
    }

    public function create(UserRequest $request) {
        return $this->success(new UserResource($this->UserService->createUser($request->validated())), 'تم الإنشاء بنجاح');
    }

    public function update(UserRequest $request, $id) {
        return $this->success(new UserResource($this->UserService->updateUser($id, $request->validated())), 'تم التحديث بنجاح');
    }

    public function delete($id) {
        if(!($id == 1)) {
            $this->UserService->deleteUser($id);
            return $this->success(null, 'تم الحذف بنجاح');
        }
        return $this->success(null, 'غير مصرح لك');
    }
}
