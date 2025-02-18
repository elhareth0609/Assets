<?php

use App\Http\Controllers\Api\AuthController;
// use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductController;
// use App\Http\Controllers\ProductController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\VersionController;
use App\Http\Middleware\BearerTokenMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;






Route::get('v1/status', [NotificationController::class, 'test'])->name('test');



Route::post('v1/login', [AuthController::class, 'authenticate'])->name('api.login');
Route::get('v1/version/get', [VersionController::class, 'get'])->name('api.version.get'); // for get verision of app
Route::get('v1/version/update', [VersionController::class, 'update'])->name('api.version.update'); // for get verision of app


Route::group(['middleware' => BearerTokenMiddleware::class], function () {
    Route::get('v1/logout', [AuthController::class, 'logout'])->name('api.logout');
    Route::get('v1/destroy', [AuthController::class, 'destroy'])->name('api.destroy');
    Route::get('v1/info', [AuthController::class, 'info'])->name('api.info');
    Route::post('v1/update', [AuthController::class, 'update'])->name('api.update');


    // orders


    // products
    Route::get('v1/products', [ProductController::class, 'all'])->name('api.products.all');



    // categorys
});
