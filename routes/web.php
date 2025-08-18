<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataTabelController;
use App\Http\Controllers\DepreciationEntryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPermissionController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;







    Route::get('/', [HomeController::class, 'home'])->name('home');

    Route::get('/redirect', [HomeController::class, 'redirect'])->name('redirect');
    Route::get('/assets/{id}', [AssetController::class, 'get'])->name('assets.get');

    Route::group(['middleware' => ['guest']], function () {
        Route::get('auth/login', [AuthController::class, 'login'])->name('auth.login');
        Route::get('auth/register', [AuthController::class, 'register'])->name('auth.register');
        Route::get('auth/forgot-password', [AuthController::class, 'forgot_password'])->name('auth.forgot-password');
        Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login.action');
        Route::post('auth/register', [AuthController::class, 'register'])->name('auth.register.action');
        Route::post('auth/forgot-password', [AuthController::class, 'forgot_password'])->name('auth.forgot-password.action');
    });

    Route::group(['middleware' => ['auth']], function () {

        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

        Route::get('users', [DataTabelController::class, 'users'])->name('users');
        Route::get('categories', [DataTabelController::class, 'categories'])->name('categories');
        Route::get('sub-categories', [DataTabelController::class, 'sub_categories'])->name('sub-categories');
        Route::get('languages', [DataTabelController::class, 'languages'])->name('languages');
        Route::get('assets-list', [DataTabelController::class, 'assets'])->name('assets');
        Route::get('types', [DataTabelController::class, 'types'])->name('types');
        Route::get('locations', [DataTabelController::class, 'locations'])->name('locations');
        Route::get('employees', [DataTabelController::class, 'employees'])->name('employees');
        Route::get('depreciation-entries', [DataTabelController::class, 'depreciationEntries'])->name('depreciation-entries');




        Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
        Route::get('auth/destroy', [AuthController::class, 'destroy'])->name('auth.destroy');

        // Assets
        // Dashboard
        Route::get('/assets-list/create', [AssetController::class, 'create'])->name('assets.create');
        Route::post('/assets-list/store', [AssetController::class, 'store'])->name('assets.store');
        Route::delete('/assets-list/{id}', [AssetController::class, 'delete'])->name('assets.delete');
        Route::get('/assets-list/{id}/edit', [AssetController::class, 'edit'])->name('assets.edit');
        Route::put('/assets-list/{id}/update', [AssetController::class, 'update'])->name('assets.update');
        Route::get('/assets-list/{id}/show', [AssetController::class, 'show'])->name('assets.show');
        Route::get('/assets-list/{id}/qr', [AssetController::class, 'qr'])->name('assets.qr');
        // Route::get('/assets/{id}/generate', [AssetController::class, 'generate'])->name('assets.generate');
        Route::get('/assets-list/export', [AssetController::class, 'export'])->name('assets.export');
        Route::post('/assets-list/import', [AssetController::class, 'import'])->name('assets.import');
        Route::get('/assets-list/import-template', [AssetController::class, 'downloadTemplate'])->name('assets.import-template');

        // Types
        // Dashboard
        Route::get('/types/{id}', [TypeController::class, 'get'])->name('types.get');
        Route::post('/types/create', [TypeController::class, 'create'])->name('types.create');
        Route::delete('/types/{id}', [TypeController::class, 'delete'])->name('types.delete');
        Route::put('/types/{id}', [TypeController::class, 'update'])->name('types.update');

        // Locations
        // Dashboard
        Route::get('/locations/{id}', [LocationController::class, 'get'])->name('locations.get');
        Route::post('/locations/create', [LocationController::class, 'create'])->name('locations.create');
        Route::delete('/locations/{id}', [LocationController::class, 'delete'])->name('locations.delete');
        Route::put('/locations/{id}', [LocationController::class, 'update'])->name('locations.update');

        // Depreciation Entries
        // Dashboard
        Route::get('/depreciation-entries/{id}/get', [DepreciationEntryController::class, 'get'])->name('depreciation-entries.get');
        Route::post('/depreciation-entries/create', [DepreciationEntryController::class, 'create'])->name('depreciation-entries.create');
        Route::delete('/depreciation-entries/{id}', [DepreciationEntryController::class, 'delete'])->name('depreciation-entries.delete');
        Route::put('/depreciation-entries/{id}', [DepreciationEntryController::class, 'update'])->name('depreciation-entries.update');
        Route::get('/depreciation-entries/export', [DepreciationEntryController::class, 'export'])->name('depreciation-entries.export');
        Route::post('/depreciation-entries/import', [DepreciationEntryController::class, 'import'])->name('depreciation-entries.import');
        Route::get('/depreciation-entries/import-template', [DepreciationEntryController::class, 'downloadTemplate'])->name('depreciation-entries.import-template');

        // Employees
        // Dashboard
        Route::get('/employees/{id}/get', [EmployeeController::class, 'get'])->name('employees.get');
        Route::post('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
        Route::delete('/employees/{id}', [EmployeeController::class, 'delete'])->name('employees.delete');
        Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
        Route::post('/employees/import', [EmployeeController::class, 'import'])->name('employees.import');
        Route::get('/employees/import-template', [EmployeeController::class, 'downloadTemplate'])->name('employees.import-template');

        // Users
        // Dashboard
        Route::get('/users/{id}', [UserController::class, 'get'])->name('users.get');
        Route::post('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::delete('/users/{id}', [UserController::class, 'delete'])->name('users.delete');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

        // User Permissions
        // Route::get('/users/{userId}/permissions', [UserPermissionController::class, 'edit'])->name('users.permissions.edit');
        Route::put('/users/{userId}/permissions', [UserPermissionController::class, 'update'])->name('users.permissions.update');
        // Route::get('/users/{userId}/permissions/get', [UserPermissionController::class, 'getUserPermissions']);
        // Route::post('/users/permissions/toggle', [UserPermissionController::class, 'togglePermission']);

        Route::post('/language', [LanguageController::class, 'create'])->name('language.create');
        Route::get('/language/{word}', [LanguageController::class, 'get'])->name('language.get');
        Route::put('/language/{word}', [LanguageController::class, 'update'])->name('language.update');
        Route::delete('/language/{word}', [LanguageController::class, 'destroy'])->name('language.destroy');

        Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

        Route::get('pages/terms-of-use', [SettingController::class, 'get_terms_of_use'])->name('services.terms-of-use');
        Route::get('pages/about-us', [SettingController::class, 'get_about_us'])->name('services.about-us');
        Route::get('pages/privacy-and-policy', [SettingController::class, 'get_privacy_and_policy'])->name('services.privacy-and-policy');

        Route::get('settings/website', [SettingController::class, 'get_website'])->name('settings.website.get');
        Route::get('settings/account', [SettingController::class, 'get_account'])->name('settings.account.get');

        Route::post('settings/account/update', [SettingController::class, 'update_account'])->name('settings.account.update');
        Route::post('settings/account/password', [SettingController::class, 'update_password'])->name('settings.account.password');

        Route::post('settings/account/upload/image', [SettingController::class, 'upload_image'])->name('settings.account.uploadImage');

        Route::post('/terms-of-use/update', [SettingController::class, 'update_terms_of_use'])->name('terms_of_use.update');
        Route::post('/about-us/update', [SettingController::class, 'update_about_us'])->name('about_us.update');
        Route::post('/privacy-and-policy/update', [SettingController::class, 'update_privacy_and_policy'])->name('privacy_and_policy.update');

        Route::get('/change-language/{locale}', [LanguageController::class, 'change'])->name('change.language');

    });

    Route::get('/ddd', function () {
        Artisan::call('optimize');
        return 'ok';
    });
