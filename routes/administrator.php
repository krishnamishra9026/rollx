<?php

use App\Http\Controllers\Admin\Auth\ChangePasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\MyAccountController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\WalletController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductPriceController;
use App\Http\Controllers\Admin\WarehouseItemController;
use App\Http\Controllers\Admin\WarehouseInventoryController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\FranchiseController;
use App\Http\Controllers\Admin\SaleReportController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\ChefController;
use App\Http\Controllers\Admin\UserManagement\AdminController;
use App\Http\Controllers\Admin\UserManagement\SuperadminController;
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

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

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


    /*
    |--------------------------------------------------------------------------
    | Dashboard Route
    |--------------------------------------------------------------------------
    */

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/flow-chart', [DashboardController::class, 'appFlow'])->name('app.flow');
    Route::get('support', [DashboardController::class, 'help'])->name('support');
    Route::post('support/bulk-delete', [DashboardController::class, 'bulkDelete'])->name('support.bulk-delete');
    Route::patch('fcm-token', [DashboardController::class, 'updateToken'])->name('fcmToken');
    Route::post('send-notification',[DashboardController::class,'notification'])->name('notification');

     /*
    |--------------------------------------------------------------------------
    | Customer / Company Route
    |--------------------------------------------------------------------------
    */


     /*
    |--------------------------------------------------------------------------
    | Categories Route
    |--------------------------------------------------------------------------
    */

    Route::resource('wallet', WalletController::class);

    Route::resource('chefs', ChefController::class);
       Route::post('chefs/reset-password', [FranchiseController::class, 'resetPassword'])->name('chefs.reset-password');
    Route::post('chefs/bulk-delete', [FranchiseController::class, 'bulkDelete'])->name('chefs.bulk-delete');


    Route::resource('transactions', TransactionController::class);
    Route::resource('sales', SaleController::class);
        
    Route::resource('sales', SaleController::class);

    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
        Route::resource('sales', SaleController::class);
    });


    Route::group(['prefix' => 'sale', 'as' => 'sale.'], function () {
        Route::resource('reports', SaleReportController::class);
    });
    
    Route::resource('categories', CategoryController::class);
    Route::post('categories/get-subcategories', [CategoryController::class, 'getSubcategories'])->name('categories.get-subcategories');
    Route::post('categories/get-parts', [CategoryController::class, 'getPartsByCategory'])->name('categories.get-parts');

     /*
    |--------------------------------------------------------------------------
    | Parts Route
    |--------------------------------------------------------------------------
    */

    Route::resource('products', ProductController::class);
    Route::resource('product-prices', ProductPriceController::class);
    Route::post('product-prices/update-price', [ProductPriceController::class, 'updatePrice'])->name('product-prices.update.price');

    Route::delete('products/{id}/delete-image', [ProductController::class, 'deleteImage'])->name('products.delete-image');
    Route::delete('products/{id}/delete-document', [ProductController::class, 'deleteDocument'])->name('products.delete-document');
    Route::post('products/update-quantity', [ProductController::class, 'updateQuantity'])->name('products.update.quantity');


    Route::resource('warehouse-items', WarehouseItemController::class);
    Route::delete('warehouse-items/{id}/delete-image', [WarehouseItemController::class, 'deleteImage'])->name('warehouse-items.delete-image');
    Route::delete('warehouse-items/{id}/delete-document', [WarehouseItemController::class, 'deleteDocument'])->name('warehouse-items.delete-document');
    Route::post('warehouse-items/update-quantity', [WarehouseItemController::class, 'updateQuantity'])->name('warehouse-items.update.quantity');

    Route::resource('warehouse-inventory', WarehouseInventoryController::class);
    Route::delete('warehouse-inventory/{id}/delete-image', [WarehouseInventoryController::class, 'deleteImage'])->name('warehouse-inventory.delete-image');
    Route::delete('warehouse-inventory/{id}/delete-document', [WarehouseInventoryController::class, 'deleteDocument'])->name('warehouse-inventory.delete-document');
    Route::post('warehouse-inventory/update-quantity', [WarehouseInventoryController::class, 'updateQuantity'])->name('warehouse-inventory.update.quantity');


     /*
    |--------------------------------------------------------------------------
    | Order Route
    |--------------------------------------------------------------------------
    */

    Route::resource('orders', OrderController::class);
    Route::get('orders/{id}/equipment-info', [OrderController::class, 'equipmentInfo'])->name('orders.equipment-info');
    Route::put('orders/{id}/equipment-info', [OrderController::class, 'saveEquipmentInfo'])->name('orders.save-equipment-info');
    Route::delete('orders/{id}/equipment-part', [OrderController::class, 'deleteEquipmentPart'])->name('orders.delete-equipment-part');
    Route::get('orders/{id}/add-parts', [OrderController::class, 'createPart'])->name('orders.createPart');
    Route::post('orders/get-categories', [OrderController::class, 'getSubcategories'])->name('orders.get-categories');
    Route::post('orders/add-part', [OrderController::class, 'addPart'])->name('orders.add-part');
    Route::put('orders/{id}/add-history', [OrderController::class, 'addHistory'])->name('orders.add-history');
    Route::put('orders/{id}/generate-purchase-order', [OrderController::class, 'generatePurchaseOrder'])->name('orders.generate-purchase-order');
    Route::get('orders/{id}/clone', [OrderController::class, 'clone'])->name('orders.clone');
    Route::delete('orders/{id}/delete-image', [OrderController::class, 'deleteImage'])->name('orders.delete-image');
    Route::delete('orders/{id}/delete-document', [OrderController::class, 'deleteDocument'])->name('orders.delete-document');
    Route::post('orders/change-status', [OrderController::class, 'changeStatus'])->name('orders.change-status');

   
    /*
    |--------------------------------------------------------------------------
    | Suppliers Route
    |--------------------------------------------------------------------------
    */

    Route::resource('franchises', FranchiseController::class);


    Route::post('franchises/reset-password', [FranchiseController::class, 'resetPassword'])->name('franchises.reset-password');
    Route::post('franchises/bulk-delete', [FranchiseController::class, 'bulkDelete'])->name('franchises.bulk-delete');

    
    Route::get('leads/assign-leads', [LeadController::class, 'assignLeads'])->name('leads.assign-leads');
    Route::post('leads/assign-leads/save', [LeadController::class, 'assignLeadsSave'])->name('leads.assign-leads-save');
    Route::resource('leads', LeadController::class);
    Route::get('leads/convert/{id}', [LeadController::class, 'convert'])->name('leads.convert');
    Route::post('leads/update-date', [LeadController::class, 'updateDate'])->name('leads.update-date');
    Route::post('leads/change-status', [LeadController::class, 'updateStatus'])->name('leads.change-status');
    Route::post('leads/assign-admin', [LeadController::class, 'assignAdmin'])->name('leads.assign-admin');

    Route::post('leads/reset-password', [FranchiseController::class, 'resetPassword'])->name('leads.reset-password');
    Route::post('leads/bulk-delete', [FranchiseController::class, 'bulkDelete'])->name('leads.bulk-delete');

    /*
    |--------------------------------------------------------------------------
    | Job Type Route
    |--------------------------------------------------------------------------
    */


        /*
    |--------------------------------------------------------------------------
    | User Management Route
    |--------------------------------------------------------------------------
    */

    Route::resource('users', UserController::class);
    Route::get('users/change-status/{id}', [UserController::class, 'changeStatus'])->name('users.change-status');
    Route::post('users/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
    Route::post('users/bulk-delete', [UserController::class, 'bulkDelete'])->name('users.bulk-delete');

    /*
    |--------------------------------------------------------------------------
    | Role Controller Route
    |--------------------------------------------------------------------------
    */
    Route::resource('roles', RoleController::class);
    Route::post('roles/bulk-delete', [RoleController::class, 'bulkDelete'])->name('roles.bulk-delete');


    
    Route::resource('user-management/admins', AdminController::class, [
        'names' => [
            'index'         => 'admins.index',
            'create'        => 'admins.create',
            'update'        => 'admins.update',
            'edit'          => 'admins.edit',
            'store'         => 'admins.store',
            'show'          => 'admins.show',
            'destroy'       => 'admins.destroy',
        ]
    ]);

    Route::get('user-management/admins/change-status/{id}', [AdminController::class, 'changeStatus'])->name('admins.change-status');
    Route::post('user-management/admins/reset-password', [AdminController::class, 'resetPassword'])->name('admins.reset-password');
    Route::post('user-management/admins/bulk-delete', [AdminController::class, 'bulkDelete'])->name('admins.bulk-delete');

    /*
    |--------------------------------------------------------------------------
    | Superadmins Route
    |--------------------------------------------------------------------------
    */
    Route::resource('user-management/superadmins', SuperadminController::class, [
        'names' => [
            'index'         => 'superadmins.index',
            'create'        => 'superadmins.create',
            'update'        => 'superadmins.update',
            'edit'          => 'superadmins.edit',
            'store'         => 'superadmins.store',
            'show'          => 'superadmins.show',
            'destroy'       => 'superadmins.destroy',
        ]
    ]);

    Route::get('user-management/superadmins/change-status/{id}', [SuperadminController::class, 'changeStatus'])->name('superadmins.change-status');
    Route::post('user-management/superadmins/reset-password', [SuperadminController::class, 'resetPassword'])->name('superadmins.reset-password');
    Route::post('user-management/superadmins/bulk-delete', [SuperadminController::class, 'bulkDelete'])->name('superadmins.bulk-delete');


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

    Route::post('settings/company-details', [CompanyController::class, 'companyDetails'])->name('company-details');

});
