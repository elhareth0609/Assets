<?php

namespace App\Http\Controllers;

use App\DataTables\AssetsDataTable;
use App\Models\Asset;
use App\Models\Category;
use App\Models\DepreciationEntry;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Permission;
use App\Models\Role;
use App\Models\SubCategory;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as LaravelFile;
use Yajra\DataTables\Facades\DataTables;

class DataTabelController extends Controller {

    public function users(Request $request) {
        $query = User::query()->select(['id', 'full_name', 'username', 'created_at']);

        // Handle search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                ->orWhere('username', 'like', "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->get();

        if ($request->ajax()) {
            return DataTables::of($users)
                ->addIndexColumn()
                ->editColumn('full_name', function ($user) {
                    return '<div class="flex items-center">
                        <div class="h-10 w-10 flex-shrink-0">
                            <div class="flex items-center justify-center w-10 h-10 ' . $user->avatar_background_class . ' ' . $user->avatar_text_color_class . ' rounded-full text-md font-bold focus:outline-none">
                            '. $user->avatar_initial .'
                            </div>
                        </div>
                        <div class="mr-4">
                            <div class="text-sm font-medium text-slate-900 dark:text-slate-100">' . $user->full_name . '</div>
                            <div class="text-sm text-slate-500 dark:text-slate-400">' . $user->username . '</div>
                        </div>
                    </div>';
                })
                // ->editColumn('email', function ($user) {
                //     return '<span class="text-slate-600 dark:text-slate-400 text-sm">' . $user->email . '</span>';
                // })
                ->editColumn('created_at', function ($user) {
                    return '<span class="text-slate-600 dark:text-slate-400 text-sm">' . date('d/m/Y', strtotime($user->created_at)) . '</span>';
                })
                ->addColumn('action', function($user){
                    $actions = '<div class="relative inline-block text-left">
                        <div>
                            <button type="button" class="actions-dropdown-btn inline-flex justify-center w-full rounded-md border border-slate-300 shadow-sm px-2 py-1 bg-white text-sm font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:bg-slate-800 dark:text-slate-300 dark:border-slate-600 dark:hover:bg-slate-700" id="options-menu-'.$user->id.'" aria-expanded="false" aria-haspopup="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                </svg>
                            </button>
                        </div>
                        <div class="actions-dropdown hidden absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50 dark:bg-slate-800 dark:ring-slate-700" role="menu" aria-orientation="vertical" aria-labelledby="options-menu-'.$user->id.'" tabindex="-1">
                            <div class="py-1" role="none">
                                <button type="button"
                                    data-id="'.$user->id.'"
                                    data-full_name="'.$user->full_name.'"
                                    data-username="'.$user->username.'"
                                    class="edit-user-btn block w-full text-right px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white" role="menuitem">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="inline ml-2">
                                        <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1"></path>
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3l8.385-8.415Z"></path>
                                        <path d="m16 5 3 3"></path>
                                    </svg>
                                    تعديل
                                </button>
                                <button type="button"
                                    class="delete-user-btn block w-full text-right px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white"
                                    data-id="'.$user->id.'"
                                    data-full_name="'.$user->full_name.'"
                                    data-url="'.route('users.delete', $user->id).'" role="menuitem">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="inline ml-2">
                                        <path d="M3 6h18"></path>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                        <line x1="10" x2="10" y1="11" y2="17"></line>
                                        <line x1="14" x2="14" y1="11" y2="17"></line>
                                    </svg>
                                    حذف
                                </button>
                            </div>
                        </div>
                    </div>';
                    return $actions;
                })
                ->rawColumns(['action', 'full_name', 'email', 'created_at'])
                ->make(true);
        }

        return view('content.users.list');
    }

    public function languages(Request $request) {
        $languages = [];
        foreach (config('language') as $locale => $language) {
            $languages[] = $locale;
        }

        if ($request->ajax()) {
            $words = [];

            foreach ($languages as $lang) {
                $jsonPath = resource_path("lang/{$lang}.json");

                if (LaravelFile::exists($jsonPath)) {
                    $translations = json_decode(LaravelFile::get($jsonPath), true);

                    foreach ($translations as $key => $translation) {
                        $words[$key][$lang] = $translation;
                    }
                }
            }

            $words = collect($words)->map(function ($translations, $word) use ($languages) {
                $row = ['word' => $word];
                foreach ($languages as $lang) {
                    $row[$lang] = $translations[$lang] ?? __('Not available');
                }
                return $row;
            });

            $id = 0;
            return DataTables::of($words)
            ->addColumn('id', function ($word) use (&$id) {
                return (string) ++$id;
            })
            ->addColumn('word', function ($word){
                return $word['word'];
            })
            ->addColumn('actions', function ($word) {
                    return '
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary" onclick="editLanguage(\'' . addslashes($word['word']) . '\')"><i class="mdi mdi-pencil"></i></a>
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteLanguage(\'' . addslashes($word['word']) . '\')"><i class="mdi mdi-trash-can"></i></a>
                    ';
            })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('content.languages.index')
            ->with('languages', $languages);
    }

    public function roles(Request $request) {
        $roles = Role::all();

        if ($request->ajax()) {
            return DataTables::of($roles)
            ->editColumn('id', function ($role) {
                return $role->id;
            })
            ->editColumn('name', function ($role) {
                return $role->name;
            })
            ->editColumn('guard_name', function ($role) {
                return $role->guard_name;
            })
            ->editColumn('created_at', function ($role) {
                return $role->created_at->format('Y-m-d H:i:s');
            })
            ->addColumn('actions', function ($role) {
                return '
                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary" onclick="editRole(' . $role->id . ')"><i class="mdi mdi-pencil"></i></a>
                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteRole(' . $role->id . ')"><i class="mdi mdi-trash-can"></i></a>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('content.roles.index');
    }

    public function permissions(Request $request) {
        $permissions = Permission::all();

        if ($request->ajax()) {
            return DataTables::of($permissions)
            ->editColumn('id', function ($permission) {
                return $permission->id;
            })
            ->editColumn('name', function ($permission) {
                return $permission->name;
            })
            ->editColumn('guard_name', function ($permission) {
                return $permission->guard_name;
            })
            ->editColumn('created_at', function ($permission) {
                return $permission->created_at->format('Y-m-d H:i:s');
            })
            ->addColumn('actions', function ($permission) {
                return '
                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary" onclick="editPermission(' . $permission->id . ')"><i class="mdi mdi-pencil"></i></a>
                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deletePermission(' . $permission->id . ')"><i class="mdi mdi-trash-can"></i></a>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('content.permissions.index');
    }

    public function assets(Request $request) {
        $query = Asset::query();

        // Handle filters
        if ($request->has('type_id') && $request->type_id != '') {
            $query->where('type_id', $request->type_id);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $assets = $query->orderBy('created_at', 'desc')->get();
        $ids = $assets->pluck('id');

        if ($request->ajax()) {
            return DataTables::of($assets)
                ->addIndexColumn()
                ->editColumn('purchase_date', function ($asset) {
                    return $asset->purchase_date ?
                        '<span class="text-slate-600 dark:text-slate-400 text-sm">'.date('d/m/Y', strtotime($asset->purchase_date)).'</span>' :
                        '<span class="text-slate-400 dark:text-slate-500 text-sm">-</span>';
                })
                ->editColumn('status', function ($asset) {
                    $statusConfig = [
                        'in_use' => ['label' => 'قيد الاستخدام', 'class' => 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400'],
                        'in_storage' => ['label' => 'في المستودع', 'class' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400'],
                        'maintenance' => ['label' => 'في الصيانة', 'class' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400'],
                        'damaged' => ['label' => 'تالف', 'class' => 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400']
                    ];
                    $config = $statusConfig[$asset->status->value] ?? ['label' => $asset->status->value, 'class' => 'bg-slate-100 text-slate-800 dark:bg-slate-900/20 dark:text-slate-400'];
                    return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium '.$config['class'].'">'.$config['label'].'</span>';
                })
                ->editColumn('name', function ($asset) {
                    return '<strong class="text-slate-900 dark:text-slate-300">'.$asset->name.'</strong>';
                })
                ->editColumn('number', function ($asset) {
                    return '<span class="font-mono bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-slate-300 px-2 py-1 rounded text-sm">'.$asset->number.'</span>';
                })
                ->editColumn('employee_id', function ($asset) {
                    return '<span class="text-slate-900 dark:text-slate-300">'.$asset->employee? $asset->employee->full_name : 'غير مخصص' .'</span>';
                })
                ->addColumn('action', function($asset){
                    $actions = '<div class="relative inline-block text-left">
                        <div>
                            <button type="button" class="actions-dropdown-btn inline-flex justify-center w-full rounded-md border border-slate-300 shadow-sm px-2 py-1 bg-white text-sm font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:bg-slate-800 dark:text-slate-300 dark:border-slate-600 dark:hover:bg-slate-700" id="options-menu-'.$asset->id.'" aria-expanded="false" aria-haspopup="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                </svg>
                            </button>
                        </div>
                        <div class="actions-dropdown hidden absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50 dark:bg-slate-800 dark:ring-slate-700" role="menu" aria-orientation="vertical" aria-labelledby="options-menu-'.$asset->id.'" tabindex="-1">
                            <div class="py-1" role="none">
                                <a href="'.route('assets.show', $asset->id).'"
                                    class="edit-asset-btn block w-full text-right px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white" role="menuitem">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="inline ml-2">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    عرض
                                </a>
                                <a href="'.route('assets.edit', $asset->id).'"
                                    class="edit-asset-btn block w-full text-right px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white" role="menuitem">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="inline ml-2">
                                        <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1"></path>
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3l8.385-8.415Z"></path>
                                        <path d="m16 5 3 3"></path>
                                    </svg>
                                    تعديل
                                </a>
                                <button type="button"
                                    class="delete-asset-btn block w-full text-right px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white"
                                    data-id="'.$asset->id.'"
                                    data-name="'.$asset->name.'"
                                    data-url="'.route('assets.delete', $asset->id).'" role="menuitem">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="inline ml-2">
                                        <path d="M3 6h18"></path>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                        <line x1="10" x2="10" y1="11" y2="17"></line>
                                        <line x1="14" x2="14" y1="11" y2="17"></line>
                                    </svg>
                                    حذف
                                </button>
                                <button type="button"
                                    data-id="'.$asset->id.'"
                                    data-name="'.$asset->name.'"
                                    data-number="'.$asset->number.'"
                                    class="qr-btn block w-full text-right px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="inline ml-2">
                                        <rect width="5" height="5" x="3" y="3" rx="1"></rect>
                                        <rect width="5" height="5" x="16" y="3" rx="1"></rect>
                                        <rect width="5" height="5" x="3" y="16" rx="1"></rect>
                                        <path d="M21 16h-3a2 2 0 0 0-2 2v3"></path>
                                        <path d="M21 21v.01"></path>
                                        <path d="M12 7v3a2 2 0 0 1-2 2H7"></path>
                                        <path d="M3 12h.01"></path>
                                        <path d="M12 3h.01"></path>
                                        <path d="M12 16v.01"></path>
                                        <path d="M16 12h1"></path>
                                        <path d="M21 12v.01"></path>
                                        <path d="M12 21v-1"></path>
                                    </svg>
                                    باركود
                                </button>

                            </div>
                        </div>
                    </div>';
                    return $actions;
                })
                ->rawColumns(['action', 'status', 'name', 'number', 'purchase_date', 'employee_id'])
                ->with('ids', $ids)
                ->make(true);
        }

        // Calculate statistics
        $in_use = Asset::where('status','in_use')->count();
        $damaged = Asset::where('status','damaged')->count();
        $maintenance = Asset::where('status','maintenance')->count();
        $total = Asset::count();

        $data = new \StdClass();
        $data->damaged = $damaged;
        $data->total = $total;
        $data->maintenance = $maintenance;
        $data->in_use = $in_use;

        $types = Type::all();
        return view('content.assets.list')
        ->with('data', $data)
        ->with('types', $types);
    }

    public function types(Request $request) {
        $query = Type::query()->select(['id', 'name', 'created_at']);

        if ($request->ajax()) {
            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('name', function ($type) {
                    return '<strong class="text-slate-900 dark:text-slate-300">'.$type->name.'</strong>';
                })
                ->addColumn('asset_count', function ($type) {
                    return $type->assets->count();
                })
                ->addColumn('action', function($type){
                    $actions = '<div class="relative inline-block text-left">
                        <div>
                            <button type="button" class="actions-dropdown-btn inline-flex justify-center w-full rounded-md border border-slate-300 shadow-sm px-2 py-1 bg-white text-sm font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:bg-slate-800 dark:text-slate-300 dark:border-slate-600 dark:hover:bg-slate-700" id="options-menu-'.$type->id.'" aria-expanded="false" aria-haspopup="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                </svg>
                            </button>
                        </div>
                        <div class="actions-dropdown hidden absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50 dark:bg-slate-800 dark:ring-slate-700" role="menu" aria-orientation="vertical" aria-labelledby="options-menu-'.$type->id.'" tabindex="-1">
                            <div class="py-1" role="none">
                                <button type="button"
                                    data-id="'.$type->id.'"
                                    data-name="'.$type->name.'"
                                    class="edit-type-btn block w-full text-right px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white" role="menuitem">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="inline ml-2">
                                        <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1"></path>
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3l8.385-8.415Z"></path>
                                        <path d="m16 5 3 3"></path>
                                    </svg>
                                    تعديل
                                </button>
                                <button type="button"
                                    class="delete-type-btn block w-full text-right px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white"
                                    data-id="'.$type->id.'"
                                    data-name="'.$type->name.'"
                                    data-url="'.route('types.delete', $type->id).'" role="menuitem">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="inline ml-2">
                                        <path d="M3 6h18"></path>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                        <line x1="10" x2="10" y1="11" y2="17"></line>
                                        <line x1="14" x2="14" y1="11" y2="17"></line>
                                    </svg>
                                    حذف
                                </button>
                            </div>
                        </div>
                    </div>';
                    return $actions;
                })
                ->rawColumns(['action', 'name'])
                ->make(true);
        }

        return view('content.types.list');
    }

    public function locations(Request  $request) {
        $query = Location::query();

        if ($request->ajax()) {
            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('name', function ($location) {
                    return '<strong class="text-slate-900 dark:text-slate-300">'.$location->name.'</strong>';
                })
                ->addColumn('action', function($location){
                    $actions = '<div class="relative inline-block text-left">
                        <div>
                            <button type="button" class="actions-dropdown-btn inline-flex justify-center w-full rounded-md border border-slate-300 shadow-sm px-2 py-1 bg-white text-sm font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:bg-slate-800 dark:text-slate-300 dark:border-slate-600 dark:hover:bg-slate-700" id="options-menu-'.$location->id.'" aria-expanded="false" aria-haspopup="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                </svg>
                            </button>
                        </div>
                        <div class="actions-dropdown hidden absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50 dark:bg-slate-800 dark:ring-slate-700" role="menu" aria-orientation="vertical" aria-labelledby="options-menu-'.$location->id.'" tabindex="-1">
                            <div class="py-1" role="none">
                                <button type="button"
                                    data-id="'.$location->id.'"
                                    data-name="'.$location->name.'"
                                    class="edit-location-btn block w-full text-right px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white" role="menuitem">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="inline ml-2">
                                        <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1"></path>
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3l8.385-8.415Z"></path>
                                        <path d="m16 5 3 3"></path>
                                    </svg>
                                    تعديل
                                </button>
                                <button type="button"
                                    class="delete-location-btn block w-full text-right px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white"
                                    data-id="'.$location->id.'"
                                    data-full_name="'.$location->name.'"
                                    data-url="'.route('locations.delete', $location->id).'" role="menuitem">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="inline ml-2">
                                        <path d="M3 6h18"></path>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                        <line x1="10" x2="10" y1="11" y2="17"></line>
                                        <line x1="14" x2="14" y1="11" y2="17"></line>
                                    </svg>
                                    حذف
                                </button>
                            </div>
                        </div>
                    </div>';
                    return $actions;
                })
                ->rawColumns(['action', 'name'])
                ->make(true);
        }

        return view('content.locations.list');
    }

    public function employees(Request  $request) {
        $query = Employee::query();

        // Handle filters
        if ($request->has('location_id') && $request->location_id != '') {
            $query->where('location_id', $request->location_id);
        }

        if ($request->ajax()) {
            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('full_name', function ($employee) {
                    return '<strong class="text-slate-900 dark:text-slate-300">'. $employee->full_name .'</strong>';
                })
                ->editColumn('location_id', function ($employee) {
                    return '<strong class="text-slate-900 dark:text-slate-300">'. ($employee->location->name ?? 'غير مخصص') .'</strong>';
                })
                ->editColumn('job_title', function ($employee) {
                    return '<strong class="text-slate-900 dark:text-slate-300">'. $employee->job_title ?? '-' .'</strong>';
                })
                ->editColumn('email', function ($employee) {
                    return '<strong class="text-slate-900 dark:text-slate-300">'. $employee->email ?? '-' .'</strong>';
                })
                ->addColumn('action', function($employee){
                    $actions = '<div class="relative inline-block text-left">
                        <div>
                            <button type="button" class="actions-dropdown-btn inline-flex justify-center w-full rounded-md border border-slate-300 shadow-sm px-2 py-1 bg-white text-sm font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:bg-slate-800 dark:text-slate-300 dark:border-slate-600 dark:hover:bg-slate-700" id="options-menu-'.$employee->id.'" aria-expanded="false" aria-haspopup="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                </svg>
                            </button>
                        </div>
                        <div class="actions-dropdown hidden absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50 dark:bg-slate-800 dark:ring-slate-700" role="menu" aria-orientation="vertical" aria-labelledby="options-menu-'.$employee->id.'" tabindex="-1">
                            <div class="py-1" role="none">
                                <button type="button"
                                    data-id="'.$employee->id.'"
                                    data-full_name="'.$employee->full_name.'"
                                    data-job_title="'.$employee->job_title.'"
                                    data-email="'.$employee->email.'"
                                    data-location_id="'.$employee->location_id.'"
                                    class="edit-employee-btn block w-full text-right px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white" role="menuitem">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="inline ml-2">
                                        <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1"></path>
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3l8.385-8.415Z"></path>
                                        <path d="m16 5 3 3"></path>
                                    </svg>
                                    تعديل
                                </button>
                                <button type="button"
                                    class="delete-employee-btn block w-full text-right px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-white"
                                    data-id="'.$employee->id.'"
                                    data-full_name="'.$employee->full_name.'"
                                    data-url="'.route('employees.delete', $employee->id).'" role="menuitem">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="inline ml-2">
                                        <path d="M3 6h18"></path>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                        <line x1="10" x2="10" y1="11" y2="17"></line>
                                        <line x1="14" x2="14" y1="11" y2="17"></line>
                                    </svg>
                                    حذف
                                </button>
                            </div>
                        </div>
                    </div>';
                    return $actions;
                })
                ->rawColumns(['action', 'job_title', 'email', 'full_name', 'location_id'])
                ->make(true);
        }

        $locations = Location::all();

        return view('content.employees.list')
        ->with('locations',$locations);
    }

    public function depreciationEntries(Request $request) {
        $query = DepreciationEntry::with('asset')->select('*');

        // Handle year filter
        $selectedYear = $request->get('year', date('Y'));
        if ($selectedYear) {
            $query->whereYear('depreciation_year', $selectedYear);
        }

        // Handle asset filter
        if ($request->has('asset_id') && $request->asset_id != '') {
            $query->where('asset_id', $request->asset_id);
        }

        $entries = $query->orderBy('entry_number', 'asc')->get();

        if ($request->ajax()) {
            return DataTables::of($entries)
                ->addIndexColumn()
                ->editColumn('entry_number', function ($entry) {
                    return '<span class="font-mono text-slate-800 dark:text-slate-300">'.$entry->entry_number.'</span>';
                })
                ->editColumn('date', function ($entry) {
                    return $entry->date ?
                        '<span class="text-slate-600 dark:text-slate-400 text-sm">'.date('d/m/Y', strtotime($entry->date)).'</span>' :
                        '<span class="text-slate-400 dark:text-slate-500 text-sm">-</span>';
                })
                ->editColumn('description', function ($entry) {
                    return '<span class="text-slate-800 dark:text-slate-300">'.$entry->description.'</span>';
                })
                ->editColumn('depreciation_rate', function ($entry) {
                    return '<span class="font-mono text-slate-800 dark:text-slate-300">'.number_format($entry->depreciation_rate, 2).'%</span>';
                })
                ->editColumn('depreciation_start_date', function ($entry) {
                    return $entry->depreciation_start_date ?
                        '<span class="text-slate-600 dark:text-slate-400 text-sm">'.date('d/m/Y', strtotime($entry->depreciation_start_date)).'</span>' :
                        '<span class="text-slate-400 dark:text-slate-500 text-sm">-</span>';
                })
                ->editColumn('depreciation_year', function ($entry) {
                    return '<span class="font-mono text-slate-800 dark:text-slate-300">'.date('d/m/Y', strtotime($entry->depreciation_year)).'</span>';
                })
                ->editColumn('days_count', function ($entry) {
                    return '<span class="font-mono text-slate-800 dark:text-slate-300">'.$entry->days_count.'</span>';
                })
                ->editColumn('purchase_cost', function ($entry) {
                    return '<span class="font-mono text-slate-800 dark:text-slate-300">'.number_format($entry->purchase_cost, 2).'</span>';
                })
                ->editColumn('additions', function ($entry) {
                    return '<span class="font-mono text-slate-800 dark:text-slate-300">'.number_format($entry->additions, 2).'</span>';
                })
                ->editColumn('exclusions', function ($entry) {
                    return '<span class="font-mono text-slate-800 dark:text-slate-300">'.number_format($entry->exclusions, 2).'</span>';
                })
                ->editColumn('asset_cost_at_end', function ($entry) {
                    return '<span class="font-mono text-slate-800 dark:text-slate-300 font-semibold">'.number_format($entry->asset_cost_at_end, 2).'</span>';
                })
                ->editColumn('accumulated_depreciation_at_start', function ($entry) {
                    return '<span class="font-mono text-slate-800 dark:text-slate-300">'.number_format($entry->accumulated_depreciation_at_start, 2).'</span>';
                })
                ->editColumn('current_year_depreciation', function ($entry) {
                    return '<span class="font-mono text-slate-800 dark:text-slate-300">'.number_format($entry->current_year_depreciation, 2).'</span>';
                })
                ->editColumn('excluded_depreciation', function ($entry) {
                    return '<span class="font-mono text-slate-800 dark:text-slate-300">'.number_format($entry->excluded_depreciation, 2).'</span>';
                })
                ->editColumn('accumulated_depreciation_at_end', function ($entry) {
                    return '<span class="font-mono text-slate-800 dark:text-slate-300 font-semibold">'.number_format($entry->accumulated_depreciation_at_end, 2).'</span>';
                })
                ->editColumn('net_book_value', function ($entry) {
                    return '<span class="font-mono text-slate-800 dark:text-slate-300 font-semibold">'.number_format($entry->net_book_value, 2).'</span>';
                })
                ->editColumn('classification', function ($entry) {
                    return '<span class="text-slate-600 dark:text-slate-400">'.$entry->classification.'</span>';
                })
                ->addColumn('action', function($entry){
                    $actions = '<div class="relative group inline-block">
                        <button type="button"
                            data-id="'.$entry->id.'"
                            class="edit-entry-btn inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent h-8 px-3 text-sm text-orange-600 hover:text-orange-700 hover:bg-orange-50 dark:text-orange-400 dark:hover:bg-orange-900/20">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-edit w-4 h-4">
                                    <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1"></path>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3l8.385-8.415Z"></path>
                                    <path d="m16 5 3 3"></path>
                                </svg>
                        </button>
                        <div class="absolute z-10 whitespace-nowrap px-2 py-1 text-xs text-white bg-black rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bottom-full mb-1 left-1/2 transform -translate-x-1/2">تعديل</div>
                    </div>';
                    $actions .= '<div class="relative group inline-block">
                        <button type="button"
                            class="delete-entry-btn inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent h-8 px-3 text-sm text-red-600 hover:text-red-700 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20"
                            data-id="'.$entry->id.'"
                            data-url="'.route('depreciation-entries.delete', $entry->id).'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2 w-4 h-4">
                                <path d="M3 6h18"></path>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                <line x1="10" x2="10" y1="11" y2="17"></line>
                                <line x1="14" x2="14" y1="11" y2="17"></line>
                                </svg>
                            </button>
                        <div class="absolute z-10 whitespace-nowrap px-2 py-1 text-xs text-white bg-black rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bottom-full mb-1 left-1/2 transform -translate-x-1/2">حذف</div>
                    </div>';
                    return '<div class="flex ltr:justify-end rtl:justify-start gap-1">'.$actions.'</div>';
                })
                ->rawColumns(['action', 'entry_number', 'date', 'description', 'depreciation_rate', 'depreciation_start_date', 'depreciation_year', 'days_count', 'purchase_cost', 'additions', 'exclusions', 'asset_cost_at_end', 'accumulated_depreciation_at_start', 'current_year_depreciation', 'excluded_depreciation', 'accumulated_depreciation_at_end', 'net_book_value', 'classification'])
                ->make(true);
        }

        // Calculate totals
        $totals = new \StdClass();
        $totals->purchase_cost = $entries->sum('purchase_cost');
        $totals->additions = $entries->sum('additions');
        $totals->exclusions = $entries->sum('exclusions');
        $totals->asset_cost_at_end = $entries->sum('asset_cost_at_end');
        $totals->accumulated_depreciation_at_start = $entries->sum('accumulated_depreciation_at_start');
        $totals->current_year_depreciation = $entries->sum('current_year_depreciation');
        $totals->excluded_depreciation = $entries->sum('excluded_depreciation');
        $totals->accumulated_depreciation_at_end = $entries->sum('accumulated_depreciation_at_end');
        $totals->net_book_value = $entries->sum('net_book_value');

        $assets = Asset::all();
        $years = range(2000, date('Y') + 1);
        rsort($years);

        return view('content.depreciation-entries.list')
            ->with('totals', $totals)
            ->with('assets', $assets)
            ->with('years', $years)
            ->with('selectedYear', $selectedYear);
    }
}
