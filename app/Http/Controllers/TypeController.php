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

    public function all() {
        return $this->success(TypeResource::collection($this->TypeService->allTypes()));
    }

    public function get($id) {
        return $this->success(new TypeResource($this->TypeService->getType($id)));
    }

    public function create(TypeRequest $request) {
        return $this->success(new TypeResource($this->TypeService->createType($request->validated())), __('Created Successfully.'));
    }

    public function update(TypeRequest $request, $id) {
        return $this->success(new TypeResource($this->TypeService->updateType($id, $request->validated())), __('Updated Successfully.'));
    }

    public function delete($id) {
        $this->TypeService->deleteType($id);
        return $this->success(null, __('Deleted Successfully.'));
    }
}