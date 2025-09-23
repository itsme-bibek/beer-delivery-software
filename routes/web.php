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
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\Admin\LlboVerificationController as AdminLlboController;
use App\Http\Controllers\User\LlboVerificationController as UserLlboController;
use App\Http\Controllers\Admin\MarketingBannerController as AdminMarketingController;
use App\Http\Controllers\MarketingBannerController;

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

// Marketing Banner API Routes
Route::get('/api/banners/active', [MarketingBannerController::class, 'getActiveBanners'])->name('api.banners.active');
Route::get('/api/banner/current', [MarketingBannerController::class, 'getBannerForUser'])->name('api.banner.current');

/*
|--------------------------------------------------------------------------
| User Routes (Protected by auth middleware)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', \App\Http\Middleware\EnsureLlboVerified::class])->prefix('user')->group(function () {
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
	
	// User Profile
	Route::get('/profile', [UserProfileController::class, 'index'])->name('user.profile');
	Route::put('/profile', [UserProfileController::class, 'update'])->name('user.profile.update');
	Route::put('/profile/password', [UserProfileController::class, 'updatePassword'])->name('user.profile.password');
	
	// LLBO Verification
	Route::get('/llbo-verification', [UserLlboController::class, 'index'])->name('user.llbo-verification.index');
	Route::get('/llbo-verification/create', [UserLlboController::class, 'create'])->name('user.llbo-verification.create');
	Route::post('/llbo-verification', [UserLlboController::class, 'store'])->name('user.llbo-verification.store');
	Route::put('/llbo-verification', [UserLlboController::class, 'update'])->name('user.llbo-verification.update');
	Route::get('/llbo-verification/download', [UserLlboController::class, 'downloadDocument'])->name('user.llbo-verification.download');
});

// Waiting page (must be outside middleware to allow redirect)
Route::middleware(['auth'])->get('/user/waiting-verification', function() {
    return view('frontend.users.llbo-verification.waiting');
})->name('user.waiting-verification');

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
	
	// LLBO Verification Management
	Route::get('/llbo-verifications', [AdminLlboController::class, 'index'])->name('llbo-verifications.index');
	Route::get('/llbo-verifications/expiring', [AdminLlboController::class, 'expiringSoon'])->name('llbo-verifications.expiring');
	Route::get('/llbo-verifications/{llboVerification}', [AdminLlboController::class, 'show'])->name('llbo-verifications.show');
	Route::post('/llbo-verifications/{llboVerification}/verify', [AdminLlboController::class, 'verify'])->name('llbo-verifications.verify');
	Route::post('/llbo-verifications/{llboVerification}/reminder', [AdminLlboController::class, 'sendReminder'])->name('llbo-verifications.reminder');
	Route::post('/llbo-verifications/bulk-action', [AdminLlboController::class, 'bulkAction'])->name('llbo-verifications.bulk-action');
	// LLBO admin download document
	Route::get('/llbo-verifications/{llboVerification}/download', [AdminLlboController::class, 'download'])->name('llbo-verifications.download');
	
	// Marketing Banner Management
	Route::get('/marketing-banners', [AdminMarketingController::class, 'index'])->name('marketing-banners.index');
	Route::get('/marketing-banners/create', [AdminMarketingController::class, 'create'])->name('marketing-banners.create');
	Route::post('/marketing-banners', [AdminMarketingController::class, 'store'])->name('marketing-banners.store');
	Route::get('/marketing-banners/{marketingBanner}', [AdminMarketingController::class, 'show'])->name('marketing-banners.show');
	Route::get('/marketing-banners/{marketingBanner}/edit', [AdminMarketingController::class, 'edit'])->name('marketing-banners.edit');
	Route::put('/marketing-banners/{marketingBanner}', [AdminMarketingController::class, 'update'])->name('marketing-banners.update');
	Route::delete('/marketing-banners/{marketingBanner}', [AdminMarketingController::class, 'destroy'])->name('marketing-banners.destroy');
	Route::post('/marketing-banners/{marketingBanner}/toggle', [AdminMarketingController::class, 'toggleStatus'])->name('marketing-banners.toggle');
	Route::post('/marketing-banners/reorder', [AdminMarketingController::class, 'reorder'])->name('marketing-banners.reorder');
});
