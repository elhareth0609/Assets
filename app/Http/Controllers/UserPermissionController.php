<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponder;

class UserPermissionController extends Controller
{
    use ApiResponder;

    /**
     * 更新用户权限
     */
    public function update(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $permissions = $request->input('permissions', []);

        $user->syncPermissions($permissions);

        return $this->success(null, 'تم تحديث صلاحيات المستخدم بنجاح');
    }

// public function getUserPermissions($userId)
// {
//     $user = User::findOrFail($userId);
//     $permissions = Permission::all()->groupBy('module');
//     $userPermissions = $user->permissions->pluck('id')->toArray();

//     $modules = [
//         'assets' => 'الأصول',
//         'employees' => 'الموظفين',
//         'users' => 'المستخدمين',
//         'locations' => 'المواقع',
//         'types' => 'الأنواع',
//         'depreciation-entries' => 'قيد الاستهلاك',
//     ];

//     $actions = [
//         'create' => 'إنشاء',
//         'view' => 'عرض',
//         'update' => 'تعديل',
//         'delete' => 'حذف',
//     ];

//     $html = '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">';

//     foreach ($modules as $module => $displayName) {
//         $html .= '<div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg border border-gray-700 hover:border-gray-600 transition-all duration-300">';
//         $html .= '<div class="p-4">';
//         $html .= '<div class="flex items-center justify-between">';
//         $html .= '<div class="flex items-center space-x-3">';

//         // Add module icon
//         $icon = '';
//         switch($module) {
//             case 'assets':
//                 $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package"><path d="m7.5 4.27 9 5.15"></path><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path><path d="m3.3 7 8.7 5 8.7-5"></path><path d="M12 22V12"></path></svg>';
//                 break;
//             case 'employees':
//                 $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="m22 21-3-3m0 0a5 5 0 1 0-7-7 5 5 0 0 0 7 7z"></path></svg>';
//                 break;
//             case 'users':
//                 $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>';
//                 break;
//             case 'locations':
//                 $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path><circle cx="12" cy="10" r="3"></circle></svg>';
//                 break;
//             case 'types':
//                 $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tag"><path d="M12 2H2v10l9.29 9.29a1 1 0 0 0 1.42 0l6.58-6.58a1 1 0 0 0 0-1.42L12 2Z"></path><circle cx="7" cy="7" r="2"></circle></svg>';
//                 break;
//             case 'depreciation-entries':
//                 $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" x2="8" y1="13" y2="13"></line><line x1="16" x2="8" y1="17" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>';
//                 break;
//             default:
//                 $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
//         }

//         $html .= '<div class="p-2 rounded-md" style="background-color: rgba(119, 123, 179, 0.125);">' . $icon . '</div>';
//         $html .= '<div><h3 class="text-lg font-medium text-white">' . $displayName . '</h3></div>';
//         $html .= '</div>';
//         $html .= '</div>';
//         $html .= '<div class="mt-4 grid grid-cols-2 gap-3 transition-all duration-300 max-h-96 opacity-100">';

//         foreach ($actions as $action => $actionName) {
//             $permissionName = "{$module}.{$action}";
//             $permission = Permission::where('name', $permissionName)->first();

//             if ($permission) {
//                 $isChecked = in_array($permission->id, $userPermissions);
//                 $html .= '<div class="flex justify-between items-center col-1">';
//                 $html .= '<span class="text-sm text-gray-400">' . $actionName . '</span>';
//                 $html .= '<label class="relative inline-flex items-center cursor-pointer">';
//                 $html .= '<input type="checkbox" name="permissions[]" value="' . $permission->id . '" class="sr-only peer permission-checkbox" ' . ($isChecked ? 'checked' : '') . ' data-user-id="' . $user->id . '" data-permission-id="' . $permission->id . '">';
//                 $html .= "<div class='w-11 h-6 bg-gray-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[\"\"] after:absolute after:top-[4px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-600'></div>";
//                 $html .= '</label>';
//                 $html .= '</div>';
//             }
//         }

//         $html .= '</div>';
//         $html .= '</div>';
//         $html .= '</div>';
//     }

//     $html .= '</div>';

//     return response()->json([
//         'html' => $html,
//         'user_id' => $user->id,
//         'user_name' => $user->full_name
//     ]);
// }

// public function togglePermission(Request $request)
// {
//     $userId = $request->input('user_id');
//     $permissionId = $request->input('permission_id');
//     $state = $request->input('state', false);

//     $user = User::findOrFail($userId);
//     $permission = Permission::findOrFail($permissionId);

//     if ($state) {
//         $user->givePermissionTo($permission);
//     } else {
//         $user->revokePermissionTo($permission);
//     }

//     return response()->json([
//         'success' => true,
//         'message' => $state ? 'تمت إضافة الصلاحية بنجاح' : 'تمت إزالة الصلاحية بنجاح'
//     ]);
// }
}
