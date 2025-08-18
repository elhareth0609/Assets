<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            'assets' => 'الأصول',
            'employees' => 'الموظفين',
            'users' => 'المستخدمين',
            'locations' => 'المواقع',
            'types' => 'الأنواع',
            'depreciation-entries' => 'قيد الاستهلاك',
        ];

        $actions = [
            'create' => 'إنشاء',
            'view' => 'عرض',
            'update' => 'تعديل',
            'delete' => 'حذف',
        ];

        foreach ($modules as $module => $displayName) {
            foreach ($actions as $action => $actionName) {
                Permission::create([
                    'name' => "{$module}.{$action}",
                    'description' => "صلاحية {$actionName} {$displayName}",
                ]);
            }
        }

        // add all permissions to admin role

        $this->command->info('Permissions table seeded.');
    }
}
