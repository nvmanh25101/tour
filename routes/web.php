<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TimeController;
use App\Http\Controllers\Admin\VoucherController;
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

            Route::group([
                'as' => 'vouchers.',
                'prefix' => 'vouchers',
            ], function () {
                Route::get('/', [VoucherController::class, 'index'])->name('index');
                Route::get('/api', [VoucherController::class, 'api'])->name('api');
                Route::get('/create', [VoucherController::class, 'create'])->name('create');
                Route::post('/', [VoucherController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [VoucherController::class, 'edit'])->name('edit');
                Route::put('/{id}', [VoucherController::class, 'update'])->name('update');
                Route::delete('/{id}', [VoucherController::class, 'destroy'])->name('destroy');
            });
        });

        Route::group([
            'as' => 'categories.',
            'prefix' => 'categories',
        ], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/api', [CategoryController::class, 'api'])->name('api');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/', [CategoryController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
            Route::put('/{id}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('destroy');
        });

        Route::group([
            'as' => 'services.',
            'prefix' => 'services',
        ], function () {
            Route::get('/', [ServiceController::class, 'index'])->name('index');
            Route::get('/api', [ServiceController::class, 'api'])->name('api');
            Route::get('/create', [ServiceController::class, 'create'])->name('create');
            Route::post('/', [ServiceController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ServiceController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ServiceController::class, 'update'])->name('update');
            Route::delete('/{id}', [ServiceController::class, 'destroy'])->name('destroy');
            Route::delete('/{id}/prices/{price_id}', [ServiceController::class, 'destroyPrice'])->name('destroyPrice');
        });

        Route::group([
            'as' => 'times.',
            'prefix' => 'times',
        ], function () {
            Route::get('/', [TimeController::class, 'index'])->name('index');
            Route::get('/create', [TimeController::class, 'create'])->name('create');
            Route::post('/', [TimeController::class, 'store'])->name('store');
            Route::put('/{id}', [TimeController::class, 'update'])->name('update');
            Route::delete('/{id}', [TimeController::class, 'destroy'])->name('destroy');
        });
    });
});

