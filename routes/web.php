<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\User\StoreController;
use App\Http\Controllers\V1\User\OrderController;
use App\Http\Controllers\V1\User\IncomeController;
use App\Http\Controllers\V1\User\ProductController;
use App\Http\Controllers\V1\User\GroupController;
use App\Http\Controllers\V1\User\UserController;

use App\Http\Controllers\V1\Admin\AdminStoreController;
use App\Http\Controllers\V1\Admin\AdminOrderController;
use App\Http\Controllers\V1\Admin\AdminIncomeController;
use App\Http\Controllers\V1\Admin\AdminProductController;
use App\Http\Controllers\V1\Admin\AdminGroupController;
use App\Http\Controllers\V1\Admin\AdminUserController;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login.index');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
});

Route::prefix('admin')->middleware(['auth', 'role:superadmin|owner|member'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/order/upload', [OrderController::class, 'upload'])->name('order.upload');
    Route::post('/order/import', [OrderController::class, 'import'])->name('order.import');
    Route::get('/income/upload', [IncomeController::class, 'upload'])->name('income.upload');
    Route::post('/income/import', [IncomeController::class, 'import'])->name('income.import');

    Route::resource('store', StoreController::class);
    Route::resource('order', OrderController::class);
    Route::resource('income', IncomeController::class);
    Route::resource('product', ProductController::class);
    Route::resource('group', GroupController::class);
    Route::resource('user', UserController::class);
});

Route::prefix('admin')->middleware(['auth', 'role:superadmin'])->group(function () {
    Route::resource('master-store', AdminStoreController::class);
    Route::resource('master-order', AdminOrderController::class);
    Route::resource('master-income', AdminIncomeController::class);
    Route::resource('master-product', AdminProductController::class);
    Route::resource('master-group', AdminGroupController::class);
    Route::resource('master-user', AdminUserController::class);
});
