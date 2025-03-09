<?php

use App\Http\Controllers\Chef\Auth\ChangePasswordController;
use App\Http\Controllers\Chef\Auth\ForgotPasswordController;
use App\Http\Controllers\Chef\Auth\LoginController;
use App\Http\Controllers\Chef\Auth\MyAccountController;
use App\Http\Controllers\Chef\Auth\ResetPasswordController;
use App\Http\Controllers\Chef\DashboardController;
use App\Http\Controllers\Chef\ProductController;
use App\Http\Controllers\Chef\NotificationController;
use App\Http\Controllers\Chef\OrderController;
use App\Http\Controllers\Chef\SaleController;
use App\Http\Controllers\Chef\PurchaseOrderController;
use App\Http\Controllers\Chef\WalletController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'chef', 'as' => 'chef.'], function () {

    /*
    |--------------------------------------------------------------------------
    | Authentication Routes | LOGIN | REGISTER
    |--------------------------------------------------------------------------
    */

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.submit');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/update', [ResetPasswordController::class, 'reset'])->name('password.update');

    Route::get('notifications/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.mark-all-read');
    Route::get('notifications/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
    Route::resource('notifications', NotificationController::class);


    /*
    |--------------------------------------------------------------------------
    | Dashboard Route
    |--------------------------------------------------------------------------
    */

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::patch('fcm-token', [DashboardController::class, 'updateToken'])->name('fcmToken');
    Route::post('send-notification',[DashboardController::class,'notification'])->name('notification');

        /*
    |--------------------------------------------------------------------------
    | Purchase Order Route
    |--------------------------------------------------------------------------
    */

    Route::resource('purchase-orders', PurchaseOrderController::class);

    Route::resource('wallet', WalletController::class);

    Route::get('orders/export', [OrderController::class, 'export'])->name('orders.export');
    
    Route::resource('orders', OrderController::class);

    Route::get('sales/save', [SaleController::class, 'save'])->name('sales.save');

    Route::get('sales/export', [SaleController::class, 'export'])->name('sales.export');

    Route::resource('sales', SaleController::class);

    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
        Route::resource('sales', SaleController::class);
        Route::post('sales/save', [SaleController::class, 'saveOld'])->name('sales.save');
    });

    Route::put('orders/{id}/add-history', [OrderController::class, 'addHistory'])->name('orders.add-history');

    Route::post('orders/change-status', [OrderController::class, 'changeStatus'])->name('orders.change-status');



    Route::resource('products', ProductController::class);
    Route::delete('products/{id}/delete-image', [ProductController::class, 'deleteImage'])->name('products.delete-image');
    Route::delete('products/{id}/delete-document', [ProductController::class, 'deleteDocument'])->name('products.delete-document');


    Route::put('purchase-orders/{id}/add-history', [PurchaseOrderController::class, 'addHistory'])->name('purchase-orders.add-history');
    Route::post('purchase-orders/change-status', [PurchaseOrderController::class, 'changeStatus'])->name('purchase-orders.change-status');

    /*
    |--------------------------------------------------------------------------
    | Settings > My Account Route
    |--------------------------------------------------------------------------
    */
    Route::resource('my-account', MyAccountController::class);

    Route::get('notifications', function () {
        $user = Auth::guard('chef')->user();
        return view('chef.includes.notifications-list', ['notifications' => $user->unreadNotifications]);
    })->name('notifications.fetch');

    /*
    |--------------------------------------------------------------------------
    | Settings > Change Password Route
    |--------------------------------------------------------------------------
    */
    Route::get('change-password', [ChangePasswordController::class, 'changePasswordForm'])->name('password.form');

    Route::post('change-password', [ChangePasswordController::class, 'changePassword'])->name('change-password');

    Route::get('settings/company-details', [CompanyController::class, 'companyDetailsForm'])->name('company-details.form');

    Route::post('settings/company-details', [CompanyController::class, 'companyDetails'])->name('company-details');

});
