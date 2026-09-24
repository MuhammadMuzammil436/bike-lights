<?php

use App\Http\Controllers\AdminPanel\DashboardController;
use App\Http\Controllers\AdminPanel\LoginController;
use App\Http\Controllers\AdminPanel\ProductsController;
use App\Http\Controllers\AdminPanel\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/')
Route::prefix('adminpanel')->group(function () {
    Route::get('login', [LoginController::class, 'LoginPage'])->name('login.page');
    Route::post('login', [LoginController::class, 'LoginForm'])->name('login.form');
    Route::middleware(['AdminLogin'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'DashboardPage'])->name('admin.dashboard');
        Route::prefix('users')->group(function () {
            Route::controller(UserController::class)->group(function () {
                Route::get('/', 'Users')->name('users');
                Route::post('/add_user', 'AddUser')->name('admin.add.user');
            });
        });
        Route::prefix('products')->group(function () {
            Route::get('/', [ProductsController::class, 'ProductsList'])->name('products.list');
            Route::post('/add_product', [ProductsController::class, 'AddProduct'])->name('products.add');
        });
        Route::get('logout', [LoginController::class, 'LogOut'])->name('admin.logout');
    });
});
