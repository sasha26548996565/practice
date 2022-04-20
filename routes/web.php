<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers')->middleware('verified')->group(function () {
    Route::namespace('Blog')->name('blog.')->group(function () {
        Route::get('/', IndexController::class)->name('index');
    });

    Route::namespace('Admin')->name('admin.')->prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/', IndexController::class)->name('index');

        Route::name('user.')->prefix('user')->group(function () {
            Route::get('/', 'UserController@index')->name('index');

            Route::middleware('permission:create-user')->group(function () {
                Route::get('/create', 'UserController@create')->name('create');
                Route::post('/store', 'UserController@store')->name('store');
            });
        });
    });
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
