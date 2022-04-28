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

            Route::middleware('permission:edit-user')->group(function () {
                Route::get('/edit/{user}', 'UserController@edit')->name('edit');
                Route::patch('/update/{user}', 'UserController@update')->name('update');
            });

            Route::middleware('permission:delete-user')->group(function () {
                Route::delete('destroy/{user}', 'UserController@destroy')->name('destroy');
                Route::post('restore/{user}', 'UserController@restore')->name('restore');
            });
        });
    });
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
