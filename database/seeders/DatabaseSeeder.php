<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::statement("INSERT INTO `users` (`id`, `username`, `full_name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (1, 'admin', 'admin', 'admin@gmail.com', NULL, '\$2y\$12\$91inUhz7mO71MiPP0WcLy.HiOmXUV6LnXYgzlZVdMMiV8stzpW5KS', 'v1GUzjpcz5yJK4bOIKCQflXGPzgvM9zTbYn3ukIRf15Gbo8EFkUUgCraP5VW', '2025-08-01 08:50:16', '2025-08-03 19:24:07');");
        
        DB::statement("INSERT INTO `types` (`id`, `name`, `created_at`, `updated_at`) VALUES (1, 'أجهزة لابتوب', '2025-08-01 08:21:57', '2025-08-01 08:21:58');");
        DB::statement("INSERT INTO `types` (`id`, `name`, `created_at`, `updated_at`) VALUES (2, 'أثاث مكتبي', '2025-08-01 08:21:57', '2025-08-01 08:21:58');");
        DB::statement("INSERT INTO `locations` (`id`, `name`, `created_at`, `updated_at`) VALUES (1, 'مكتب المدير', '2025-08-01 08:21:57', '2025-08-01 08:21:58');");
        DB::statement("INSERT INTO `employees` (`id`, `full_name`, `created_at`, `updated_at`) VALUES (1, 'أحمد محمد علي', '2025-08-01 08:21:57', '2025-08-01 08:21:58');");

        DB::statement("INSERT INTO `assets` (`id`, `name`, `number`, `purchase_date`, `status`, `notes`, `type_id`, `employee_id`, `location_id`, `created_at`, `updated_at`) VALUES (1, 'لابتوب Dell Latitude 5420', 'AS-001', '2025-01-11', 'in_storage', 'تم تسليمه للموظف مع شاحن وحقيبة. البطارية بحالة ممتازة.', 1, 1, 1, '2025-08-01 08:21:57', '2025-08-01 08:21:58');");
        DB::statement("INSERT INTO `assets` (`id`, `name`, `number`, `purchase_date`, `status`, `notes`, `type_id`, `employee_id`, `location_id`, `created_at`, `updated_at`) VALUES (2, 'طاولة مكتب خشبية	', 'AS-002', '2025-08-01', 'damaged', 'تم تسليمه للموظف بحالة ممتازة.', 2, 1, 1, '2025-08-01 08:26:43', '2025-08-01 08:26:43');");
        DB::statement("INSERT INTO `assets` (`id`, `name`, `number`, `purchase_date`, `status`, `notes`, `type_id`, `employee_id`, `location_id`, `created_at`, `updated_at`) VALUES (3, 'طابعة HP LaserJet', 'AS-003', '2025-08-01', 'maintenance', 'تم تسليمه للموظف بحالة ممتازة.', 1, 1, 1, '2025-08-01 09:00:43', '2025-08-01 09:00:42');");


        DB::statement("INSERT INTO `depreciation_entries` (`id`, `asset_id`, `entry_number`, `date`, `description`, `depreciation_rate`, `depreciation_start_date`, `depreciation_year`, `days_count`, `purchase_cost`, `additions`, `exclusions`, `asset_cost_at_end`, `accumulated_depreciation_at_start`, `current_year_depreciation`, `excluded_depreciation`, `accumulated_depreciation_at_end`, `net_book_value`, `classification`, `created_at`, `updated_at`) VALUES (1, 1, '10', '2025-08-05', '10', 10.00, '2025-08-05', 2025, 10, 100.00, 10.00, 10.00, 10.00, 10.00, 10.00, 10.00, 10.00, 10.00, '10', '2025-08-05 21:53:45', '2025-08-05 22:35:33');");
    }
}
