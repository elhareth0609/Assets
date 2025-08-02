<?php

use Illuminate\Support\Facades\Route;


// hello
Route::get('hello', function () {
    return 'hello';
})->name('hello');

