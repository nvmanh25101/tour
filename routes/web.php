<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TimeController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Customer\AppointmentController;
use App\Http\Controllers\Customer\HomeController;
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
                'controller' => AdminController::class,
                'as' => 'employees.',
                'prefix' => 'employees',
            ], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/api', 'api')->name('api');
                Route::get('/resignation', 'resign')->name('resign');
                Route::get('/resignList', 'resignList')->name('resignList');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{id}/edit', 'edit')->name('edit');
                Route::put('/{id}', 'update')->name('update');
                Route::delete('/{id}', 'destroy')->name('destroy');
            });

            Route::group([
                'controller' => VoucherController::class,
                'as' => 'vouchers.',
                'prefix' => 'vouchers',
            ], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/api', 'api')->name('api');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{id}/edit', 'edit')->name('edit');
                Route::put('/{id}', 'update')->name('update');
                Route::delete('/{id}', 'destroy')->name('destroy');
            });
        });

        Route::group([
            'controller' => CategoryController::class,
            'as' => 'categories.',
            'prefix' => 'categories',
        ], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/api', 'api')->name('api');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        Route::group([
            'controller' => ServiceController::class,
            'as' => 'services.',
            'prefix' => 'services',
        ], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/api', 'api')->name('api');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::delete('/{id}/prices/{price_id}', 'destroyPrice')->name('destroyPrice');
        });

        Route::group([
            'controller' => TimeController::class,
            'as' => 'times.',
            'prefix' => 'times',
        ], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        Route::group([
            'controller' => ProductController::class,
            'as' => 'products.',
            'prefix' => 'products',
        ], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/api', 'api')->name('api');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        Route::group([
            'controller' => \App\Http\Controllers\Admin\AppointmentController::class,
            'as' => 'appointments.',
            'prefix' => 'appointments',
        ], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/api', 'api')->name('api');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });
    });
});

Route::group([
    'prefix' => '/',
    'as' => 'customers.',
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/services', [HomeController::class, 'services'])->name('services');
});

Route::group([
    'prefix' => 'reservation',
    'as' => 'reservation.',
], function () {
    Route::get('/', [AppointmentController::class, 'create'])->name('booking');
    Route::get('/get-services', [AppointmentController::class, 'getServices'])->name('getServices');
    Route::get('/get-prices', [AppointmentController::class, 'getPrices'])->name('getPrices');
    Route::get('/get-times', [AppointmentController::class, 'getTimes'])->name('getTimes');
    Route::post('/', [AppointmentController::class, 'store'])->name('store');
});
