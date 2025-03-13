<?php

use App\Http\Controllers\Franchise\Auth\ChangePasswordController;
use App\Http\Controllers\Franchise\Auth\ForgotPasswordController;
use App\Http\Controllers\Franchise\Auth\LoginController;
use App\Http\Controllers\Franchise\Auth\MyAccountController;
use App\Http\Controllers\Franchise\Auth\ResetPasswordController;
use App\Http\Controllers\Franchise\DashboardController;
use App\Http\Controllers\Franchise\ProductController;
use App\Http\Controllers\Franchise\OrderController;
use App\Http\Controllers\Franchise\NotificationController;
use App\Http\Controllers\Franchise\SaleReportController;
use App\Http\Controllers\Franchise\SaleController;
use App\Http\Controllers\Franchise\SettingController;
use App\Http\Controllers\Franchise\ChefController;
use App\Http\Controllers\Franchise\WalletController;
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

Route::group(['prefix' => 'franchise', 'as' => 'franchise.'], function () {

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


    Route::resource('wallet', WalletController::class);

    Route::get('orders/export', [OrderController::class, 'export'])->name('orders.export');


    
    Route::resource('orders', OrderController::class);
    Route::post('orders/save', [OrderController::class, 'save'])->name('orders.save');

    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

    
    Route::resource('chefs', ChefController::class);

    Route::post('chefs/reset-password', [TechnicianController::class, 'resetPassword'])->name('chefs.reset-password');
    Route::post('chefs/bulk-delete', [TechnicianController::class, 'bulkDelete'])->name('chefs.bulk-delete');

    Route::get('sales/export', [SaleController::class, 'export'])->name('sales.export');
    Route::resource('sales', SaleController::class);


    Route::get('sales/save', [SaleController::class, 'save'])->name('sales.save');

    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
        Route::resource('sales', SaleController::class);
        Route::post('sales/save', [SaleController::class, 'saveOld'])->name('sales.save');
    });

    Route::group(['prefix' => 'sale', 'as' => 'sale.'], function () {
        Route::get('reports/export', [SaleReportController::class, 'export'])->name('reports.export');
        Route::resource('reports', SaleReportController::class);
    });

    Route::put('orders/{id}/add-history', [OrderController::class, 'addHistory'])->name('orders.add-history');

    Route::post('orders/change-status', [OrderController::class, 'changeStatus'])->name('orders.change-status');



    Route::resource('products', ProductController::class);

    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.list');

    Route::get('notifications-fetch', function () {
        return view('franchise.includes.notifications-list');
    })->name('notifications.fetch');


    Route::get('stocks', [ProductController::class, 'stocks'])->name('stocks');

    Route::delete('products/{id}/delete-image', [ProductController::class, 'deleteImage'])->name('products.delete-image');
    Route::delete('products/{id}/delete-document', [ProductController::class, 'deleteDocument'])->name('products.delete-document');


   /*
    |--------------------------------------------------------------------------
    | Settings > My Account Route
    |--------------------------------------------------------------------------
    */
    Route::resource('my-account', MyAccountController::class);

    /*
    |--------------------------------------------------------------------------
    | Settings > Change Password Route
    |--------------------------------------------------------------------------
    */
    Route::get('change-password', [ChangePasswordController::class, 'changePasswordForm'])->name('password.form');

    Route::post('change-password', [ChangePasswordController::class, 'changePassword'])->name('change-password');

    Route::get('settings/company-details', [CompanyController::class, 'companyDetailsForm'])->name('company-details.form');

    Route::get('settings/products-plate', [SettingController::class, 'productPlateSetting'])->name('settings.products-plate');
    
    Route::post('settings/products-plate', [SettingController::class, 'productPlateSettingSave'])->name('settings.products-plate.save');

    Route::post('settings/company-details', [CompanyController::class, 'companyDetails'])->name('company-details');

});
