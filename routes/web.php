<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DataTabelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


    Route::get('/', [HomeController::class, 'home'])->name('home');

    Route::get('/redirect', [HomeController::class, 'redirect'])->name('redirect');

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



        Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
        Route::get('auth/destroy', [AuthController::class, 'destroy'])->name('auth.destroy');

        // Assets
        // Dashboard
        Route::get('/assets/create', [AssetController::class, 'create'])->name('assets.create');
        Route::post('/assets/store', [AssetController::class, 'store'])->name('assets.store');
        Route::delete('/assets/{id}', [AssetController::class, 'delete'])->name('assets.delete');
        Route::get('/assets/{id}/edit', [AssetController::class, 'edit'])->name('assets.edit');
        Route::put('/assets/{id}/update', [AssetController::class, 'update'])->name('assets.update');
        Route::get('/assets/{id}/show', [AssetController::class, 'show'])->name('assets.show');
        // Route::get('/assets/{id}/generate', [AssetController::class, 'generate'])->name('assets.generate');


        // Catgories
        // Dashboard
        Route::get('/category/{id}', [CategoryController::class, 'get'])->name('category');
        Route::post('/category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::delete('/category/{id}', [CategoryController::class, 'delete'])->name('category.delete');
        Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/category/{id}/restore', [CategoryController::class, 'restore'])->name('category.restore');
        Route::get('view/category/{id}', [CategoryController::class, 'view'])->name('category.view');

        Route::get('/categories/all', [CategoryController::class, 'all'])->name('categories.all');

        // Sub Catgories
        // Dashboard
        Route::get('/sub-category/{id}', [SubCategoryController::class, 'get'])->name('sub-category');
        Route::post('/sub-category/create', [SubCategoryController::class, 'create'])->name('sub-category.create');
        Route::delete('/sub-category/{id}', [SubCategoryController::class, 'delete'])->name('sub-category.delete');
        Route::put('/sub-category/{id}', [SubCategoryController::class, 'update'])->name('sub-category.update');
        Route::get('/sub-category/{id}/restore', [SubCategoryController::class, 'restore'])->name('sub-category.restore');

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

        Route::post('settings/account/upload/image', [SettingController::class, 'upload_image'])->name('settings.account.uploadImage');

        Route::post('/terms-of-use/update', [SettingController::class, 'update_terms_of_use'])->name('terms_of_use.update');
        Route::post('/about-us/update', [SettingController::class, 'update_about_us'])->name('about_us.update');
        Route::post('/privacy-and-policy/update', [SettingController::class, 'update_privacy_and_policy'])->name('privacy_and_policy.update');

        Route::get('/change-language/{locale}', [LanguageController::class, 'change'])->name('change.language');

    });

    Route::get('/ddd', function () {
        // Clear cache
        Artisan::call('optimize');
        // back to past page
        return 'ok';
    });
