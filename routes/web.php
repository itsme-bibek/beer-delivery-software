<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Home\Homecontroller;
use App\Http\Controllers\Admin\BeerController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\UserOrderController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [Homecontroller::class, 'adminhome'])->name('home');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showSignin'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| User Routes (Protected by auth middleware)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('user')->group(function () {
	// Dashboard
	Route::get('/dashboard', [Homecontroller::class, 'userhome'])->name('user-home');

	// Orders
	Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
	Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
	Route::post('/orders/bulk', [OrderController::class, 'bulkStore'])->name('orders.bulk');
	Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
	Route::get('/buybeer', [UserOrderController::class, 'buybeer'])->name('buybeer');

	// My Orders
	Route::get('/my-orders', [UserOrderController::class, 'index'])->name('my-orders');

	// Invoice Download
	Route::get('/invoice/{groupCode}', [OrderController::class, 'downloadInvoice'])->name('invoice.download');
	// Invoice Print
	Route::get('/invoice/print/{groupCode}', [OrderController::class, 'printInvoice'])->name('invoice.print');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected by auth & admin middleware)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
	// Dashboard
	Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

	// Beer Menu Management
	Route::get('/menu', [MenuController::class, 'menu'])->name('menu');
	Route::post('/add-beer', [BeerController::class, 'store'])->name('beer.store');
	Route::delete('/beer-delete/{beer}', [BeerController::class, 'destroy'])->name('beer.destroy');
	Route::get('/menu/edit/{beer}', [BeerController::class, 'edit'])->name('menu.edit');
	Route::put('/menu/update/{beer}', [BeerController::class, 'update'])->name('beer.update');

	// Order Management
	Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
	Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
	Route::put('/orders/{order}', [AdminOrderController::class, 'update'])->name('orders.update');
	Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');

	// Group Order Status Update
	Route::put('/orders/group/{groupCode}/status', [AdminOrderController::class, 'updateGroupStatus'])->name('orders.group.status');
});
