<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Permission;
use App\Models\Role;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as LaravelFile;
use Yajra\DataTables\Facades\DataTables;

class DataTabelController extends Controller {

    public function users(Request $request) {
        $users = User::all();
        if ($request->ajax()) {
            return DataTables::of($users)
            ->editColumn('id', function ($user) {
                return $user->id;
            })
            ->editColumn('fullname', function ($user) {
                return $user->fullname;
            })
            ->editColumn('email', function ($user) {
                return $user->email;
            })
            ->editColumn('phone', function ($user) {
                return $user->phone;
            })
            ->editColumn('created_at', function ($user) {
                return $user->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function ($user) use ($request){
                if ($request->has('trashed') && $request->trashed == 1) {
                    return '
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-warning" onclick="restoreCoupon(' . $user->id . ')"><i class="mdi mdi-backup-restore"></i></a>
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteCoupon(' . $user->id . ')"><i class="mdi mdi-delete-forever-outline"></i></a>
                    ';
                } else {
                    return '
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary" onclick="editCoupon(' . $user->id . ')"><i class="mdi mdi-pencil"></i></a>
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-success" onclick="printCoupon(' . $user->id . ')"><i class="mdi mdi-printer"></i></a>
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteCoupon(' . $user->id . ')"><i class="mdi mdi-trash-can"></i></a>
                    ';
                }            })
            ->make(true);
        }
        return view('content.users.list');
    }

    // public function datatabels(Request $request) {
    //     $query = Coupon::query();

    //     if ($request->has('trashed') && $request->trashed == 1) {
    //         $query->onlyTrashed();
    //     }

    //     if ($request->has('type') && $request->type != 'all') {
    //         if ($request->type == 'expired') {
    //             $query->where('expired_date', '<', now());
    //         } elseif ($request->type == 'active') {
    //             $query->where('status', 'active')->where('expired_date', '>=', now());
    //         } elseif ($request->type == 'inactive') {
    //             $query->where('status', 'inactive');
    //         }
    //     }

    //     $coupons = $query->get();

    //     $ids = $coupons->pluck('id');
    //     if($request->ajax()) {
    //         return DataTables::of($coupons)
    //         ->editColumn('id', function ($coupon) {
    //             return (string) $coupon->id;
    //         })
    //         ->editColumn('code', function ($coupon) {
    //             return $coupon->code;
    //         })
    //         ->editColumn('status', function ($coupon) {
    //             if ($coupon->status == 'active') {
    //                 return '<span class="badge bg-success-subtle border border-success-subtle text-success-emphasis rounded-pill">'. __('Active') .'</span>';
    //             } else {
    //                 return '<span class="badge bg-secondary-subtle border border-secondary-subtle text-secondary-emphasis rounded-pill">'. __('In Active') .'</span>';
    //             }
    //         })
    //         ->editColumn('discount', function ($coupon) {
    //             return $coupon->discount;
    //         })
    //         ->editColumn('max', function ($coupon) {
    //             return $coupon->max;
    //         })
    //         ->editColumn('expired_date', function ($coupon) {
    //             return $coupon->expired_date;
    //         })
    //         ->editColumn('created_at', function ($coupon) {
    //             return $coupon->created_at->format('Y-m-d');
    //         })
    //         ->addColumn('actions', function ($coupon) use ($request) {
    //             if ($request->has('trashed') && $request->trashed == 1) {
    //                 return '
    //                     <a href="javascript:void(0)" class="btn btn-icon btn-outline-warning" onclick="restoreCoupon(' . $coupon->id . ')"><i class="mdi mdi-backup-restore"></i></a>
    //                     <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteCoupon(' . $coupon->id . ')"><i class="mdi mdi-delete-forever-outline"></i></a>
    //                 ';
    //             } else {
    //                 return '
    //                     <a href="'. route('coupon',$coupon->id) .'" class="btn btn-icon btn-outline-primary"><i class="mdi mdi-pencil"></i></a>
    //                     <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary" onclick="editCoupon(' . $coupon->id . ')"><i class="mdi mdi-pencil"></i></a>
    //                     <a href="javascript:void(0)" class="btn btn-icon btn-outline-success" onclick="printCoupon(' . $coupon->id . ')"><i class="mdi mdi-printer"></i></a>
    //                     <a href="javascript:void(0)" class="btn btn-icon btn-outline-success" onclick="printPdfCoupon(' . $coupon->id . ')"><i class="mdi mdi-printer-outline"></i></a>
    //                     <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteCoupon(' . $coupon->id . ')"><i class="mdi mdi-trash-can"></i></a>
    //                 ';
    //             }
    //         })
    //         ->rawColumns(['status','actions'])
    //         ->with('ids', $ids)
    //         ->make(true);

    //         // ->toArray();

    //         // $data = $datatable['data'];

    //         // $ids = collect($data)->pluck('id');
    //         // $datatable['ids'] = $ids;

    //         // return response()->json($datatable);
    //     }
    //     return view('content.datatabels.index');
    // }

    public function categories(Request $request) {
        $query = Category::query();

        if ($request->has('trashed') && $request->trashed == 1) {
            $query->onlyTrashed();
        }

        if ($request->has('type') && $request->type != 'all') {
            if ($request->type == 'active') {
                $query->where('status', 'active');
            } elseif ($request->type == 'inactive') {
                $query->where('status', 'inactive');
            }
        }

        $categories = $query->get();

        $ids = $categories->pluck('id');
        if($request->ajax()) {
            return DataTables::of($categories)
            ->editColumn('id', function ($category) {
                return (string) $category->id;
            })
            ->editColumn('name', function ($category) {
                return $category->name;
            })
            ->editColumn('status', function ($category) {
                if ($category->status == 'active') {
                    return '<span class="badge bg-success-subtle border border-success-subtle text-success-emphasis rounded-pill">'. __('Active') .'</span>';
                } else {
                    return '<span class="badge bg-secondary-subtle border border-secondary-subtle text-secondary-emphasis rounded-pill">'. __('In Active') .'</span>';
                }
            })
            ->editColumn('created_at', function ($category) {
                return $category->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function ($category) use ($request) {
                if ($request->has('trashed') && $request->trashed == 1) {
                    return '
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-warning" onclick="restoreCategory(' . $category->id . ')"><i class="mdi mdi-backup-restore"></i></a>
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteCategory(' . $category->id . ')"><i class="mdi mdi-delete-forever-outline"></i></a>
                    ';
                } else {
                    return '
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary" onclick="editCategory(' . $category->id . ')"><i class="mdi mdi-pencil"></i></a>
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteCategory(' . $category->id . ')"><i class="mdi mdi-trash-can"></i></a>
                    ';
                }
            })
            ->rawColumns(['status','actions'])
            ->with('ids', $ids)
            ->make(true);
        }
        return view('content.categories.list');
    }

    public function sub_categories(Request $request) {
        $query = SubCategory::query();

        if ($request->has('trashed') && $request->trashed == 1) {
            $query->onlyTrashed();
        }

        if ($request->has('type') && $request->type != 'all') {
            if ($request->type == 'active') {
                $query->where('status', 'active');
            } elseif ($request->type == 'inactive') {
                $query->where('status', 'inactive');
            }
        }

        $sub_categories = $query->get();

        $ids = $sub_categories->pluck('id');
        if($request->ajax()) {
            return DataTables::of($sub_categories)
            ->editColumn('id', function ($sub_category) {
                return (string) $sub_category->id;
            })
            ->editColumn('name', function ($sub_category) {
                return $sub_category->name;
            })
            ->editColumn('category_id', function ($sub_category) {
                return $sub_category->category->name;
            })
            ->editColumn('status', function ($sub_category) {
                if ($sub_category->status == 'active') {
                    return '<span class="badge bg-success-subtle border border-success-subtle text-success-emphasis rounded-pill">'. __('Active') .'</span>';
                } else {
                    return '<span class="badge bg-secondary-subtle border border-secondary-subtle text-secondary-emphasis rounded-pill">'. __('In Active') .'</span>';
                }
            })
            ->editColumn('created_at', function ($sub_category) {
                return $sub_category->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function ($sub_category) use ($request) {
                if ($request->has('trashed') && $request->trashed == 1) {
                    return '
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-warning" onclick="restoreSubCategory(' . $sub_category->id . ')"><i class="mdi mdi-backup-restore"></i></a>
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteSubCategory(' . $sub_category->id . ')"><i class="mdi mdi-delete-forever-outline"></i></a>
                    ';
                } else {
                    return '
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary" onclick="editSubCategory(' . $sub_category->id . ')"><i class="mdi mdi-pencil"></i></a>
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger" onclick="deleteSubCategory(' . $sub_category->id . ')"><i class="mdi mdi-trash-can"></i></a>
                    ';
                }
            })
            ->rawColumns(['status','actions'])
            ->with('ids', $ids)
            ->make(true);
        }

        $categories = Category::all();

        return view('content.sub-categories.list')
        ->with('categories',$categories);

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
        // This method can be implemented similarly to the others, depending on your Asset model and requirements.
        // For now, we will return a view.
        return view('content.assets.list');
    }
}
