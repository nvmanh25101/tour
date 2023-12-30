<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'admin.',
    'prefix' => 'admin'
], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'processLogin'])->name('processLogin');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::group([
        'middleware' => 'checkAdminLogin'
    ], function () {
        Route::get('/', function () {
            return view('admin.layouts.master');
        })->name('dashboard');
        Route::group([
            'middleware' => 'isSuperAdmin'
        ], function () {
            Route::group([
                'as' => 'employees.',
                'prefix' => 'employees',
            ], function () {
                Route::get('/', [AdminController::class, 'index'])->name('index');
                Route::get('/api', [AdminController::class, 'api'])->name('api');
                Route::get('/resignation', [AdminController::class, 'resign'])->name('resign');
                Route::get('/resignList', [AdminController::class, 'resignList'])->name('resignList');
                Route::get('/create', [AdminController::class, 'create'])->name('create');
                Route::post('/', [AdminController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit');
                Route::put('/{id}', [AdminController::class, 'update'])->name('update');
                Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy');
            });
        });
    });
});

