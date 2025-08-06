<?php

namespace App\Http\Controllers;

use App\Http\Requests\Asset\App\AssetRequest;
use App\Http\Resources\Asset\App\AssetResource;
use App\Services\AssetService;
use App\Services\EmployeeService;
use App\Services\LocationService;
use App\Services\TypeService;
use App\Traits\ApiResponder;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AssetController extends Controller {
    use ApiResponder;

    private $AssetService;
    private $EmployeeService;
    private $LocationService;
    private $TypeService;

    public function __construct(AssetService $AssetService, EmployeeService $EmployeeService,LocationService $LocationService,TypeService $TypeService) {
        $this->AssetService = $AssetService;
        $this->EmployeeService = $EmployeeService;
        $this->LocationService = $LocationService;
        $this->TypeService = $TypeService;
    }

        public function index() {
        return view('content.assets');
    }

    public function create() {
        return view('content.assets.create')
            ->with('types', $this->TypeService->allTypes())
            ->with('locations', $this->LocationService->allLocations())
            ->with('employees', $this->EmployeeService->allEmployees());        
    }

    public function show($id) {
        return view('content.assets.show')
            ->with('asset', $this->AssetService->getAsset($id));
    }

    public function edit($id) {

        return view('content.assets.edit')
            ->with('asset', $this->AssetService->getAsset($id))
            ->with('types', $this->TypeService->allTypes())
            ->with('locations', $this->LocationService->allLocations())
            ->with('employees', $this->EmployeeService->allEmployees());
    }

    public function all() {
        return $this->success(AssetResource::collection($this->AssetService->allAssets()));
    }

    public function get($id) {
        return view('content.assets.index')
            ->with('asset', $this->AssetService->getAsset($id));

        // return $this->success(new AssetResource($this->AssetService->getAsset($id)));
    }

    public function store(AssetRequest $request) {
        return $this->success(new AssetResource($this->AssetService->createAsset($request->validated())), 'تم الإنشاء بنجاح');
    }

    public function update(AssetRequest $request, $id) {
        return $this->success(new AssetResource($this->AssetService->updateAsset($id, $request->validated())), 'تم التحديث بنجاح');
    }

    public function delete($id) {
        $this->AssetService->deleteAsset($id);
        return $this->success(null, 'تم الحذف بنجاح');
    }
    public function qr($id) {
        $url = route('assets.get', $id);
        return response(QrCode::size(160)
        ->color(0, 0, 0)
        ->backgroundColor(255, 255, 255)
        ->generate($url))
        ->header('Content-Type', 'image/svg+xml');
    }

    // public function export(Request $request)
    // {
    //     $query = Asset::query();

    //     if ($request->filled('assetType')) {
    //         $query->where('asset_type', $request->assetType);
    //     }

    //     if ($request->filled('status')) {
    //         $query->where('status', $request->status);
    //     }

    //     if ($request->filled('search')) {
    //         $search = $request->search;
    //         $query->where(function($q) use ($search) {
    //             $q->where('asset_name', 'like', "%{$search}%")
    //             ->orWhere('asset_number', 'like', "%{$search}%")
    //             ->orWhere('assigned_to', 'like', "%{$search}%");
    //         });
    //     }

    //     $assets = $query->get();

    //     // Use Laravel Excel or similar package to export
    //     return Excel::download(new AssetsExport($assets), 'assets.csv');
    // }

}
