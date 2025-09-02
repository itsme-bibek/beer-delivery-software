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
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\MessageController;

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
	// Reorder
	Route::post('/reorder/{groupCode}', [OrderController::class, 'reorder'])->name('orders.reorder');
	// Get beer stock
	Route::get('/beer-stock/{beer}', [OrderController::class, 'getBeerStock'])->name('beer.stock');
	// Analytics
	Route::get('/analytics/order-status', [AnalyticsController::class, 'getOrderStatusAnalytics'])->name('analytics.order-status');
	Route::get('/analytics/monthly-trends', [AnalyticsController::class, 'getMonthlyTrends'])->name('analytics.monthly-trends');
	Route::get('/analytics/beer-popularity', [AnalyticsController::class, 'getBeerPopularity'])->name('analytics.beer-popularity');
	// Delete Order Group
	Route::delete('/orders/group/{groupCode}', [OrderController::class, 'deleteOrderGroup'])->name('orders.group.delete');
	// Bulk Delete Orders
	Route::delete('/orders/bulk-delete', [OrderController::class, 'bulkDeleteOrders'])->name('orders.bulk-delete');
	// Message Admin
	Route::post('/message-admin', [MessageController::class, 'sendMessage'])->name('message.admin');
	// User Messages
	Route::get('/messages', [MessageController::class, 'index'])->name('user.messages.index');
	Route::get('/messages/{message}', [MessageController::class, 'show'])->name('user.messages.show');
	Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('user.messages.destroy');
	Route::delete('/messages/bulk-delete', [MessageController::class, 'bulkDelete'])->name('user.messages.bulk-delete');
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
	// Cancel Order Group
	Route::post('/orders/group/{groupCode}/cancel', [AdminOrderController::class, 'cancelOrderGroup'])->name('orders.group.cancel');
	// Delete Order Group
	Route::delete('/orders/group/{groupCode}', [AdminOrderController::class, 'deleteOrderGroup'])->name('orders.group.delete');
	// Bulk Delete Orders
	Route::delete('/orders/bulk-delete', [AdminOrderController::class, 'bulkDeleteOrders'])->name('orders.bulk-delete');
	// Admin Analytics
	Route::get('/analytics/admin', [AnalyticsController::class, 'getAdminAnalytics'])->name('analytics.admin');
	
	// Messages Management
	Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
	Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
	Route::post('/messages/{message}/reply', [MessageController::class, 'reply'])->name('messages.reply');
	Route::put('/messages/{message}/read', [MessageController::class, 'markAsRead'])->name('messages.read');
	Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
	Route::delete('/messages/bulk-delete', [MessageController::class, 'bulkDelete'])->name('messages.bulk-delete');
	
	// User Management
	Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
	Route::get('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');
	Route::put('/users/{user}/role', [App\Http\Controllers\Admin\UserController::class, 'updateRole'])->name('users.update-role');
	Route::delete('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
	Route::delete('/users/bulk-delete', [App\Http\Controllers\Admin\UserController::class, 'bulkDelete'])->name('users.bulk-delete');
});
