<?php

use App\Http\Controllers\Admin\Auth\ChangePasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\MyAccountController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CloneOrderController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CustomerCompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EquipmentController;
use App\Http\Controllers\Admin\InventoryEquipmentController;
use App\Http\Controllers\Admin\JobCalendarController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\JobTypeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\WalletController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PurchaseOrderController;
use App\Http\Controllers\Admin\FranchiseController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\TechnicianController;
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

    Route::resource('customers', CustomerCompanyController::class);
    Route::post('customers/bulk-delete', [CustomerCompanyController::class, 'bulkDelete'])->name('customers.bulk-delete');
    Route::post('customers/get-addresses', [CustomerCompanyController::class, 'getAddresses'])->name('customers.get-addresses');

     /*
    |--------------------------------------------------------------------------
    | Categories Route
    |--------------------------------------------------------------------------
    */

    Route::resource('wallet', WalletController::class);
    
    Route::resource('categories', CategoryController::class);
    Route::post('categories/get-subcategories', [CategoryController::class, 'getSubcategories'])->name('categories.get-subcategories');
    Route::post('categories/get-parts', [CategoryController::class, 'getPartsByCategory'])->name('categories.get-parts');

     /*
    |--------------------------------------------------------------------------
    | Parts Route
    |--------------------------------------------------------------------------
    */

    Route::resource('products', ProductController::class);
    Route::delete('products/{id}/delete-image', [ProductController::class, 'deleteImage'])->name('products.delete-image');
    Route::delete('products/{id}/delete-document', [ProductController::class, 'deleteDocument'])->name('products.delete-document');

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
    | Purchase Order Route
    |--------------------------------------------------------------------------
    */

    Route::resource('purchase-orders', PurchaseOrderController::class);

    Route::get('purchase-orders/{id}/equipment-info', [PurchaseOrderController::class, 'equipmentInfo'])->name('purchase-orders.equipment-info');
    Route::put('purchase-/{id}/equipment-info', [PurchaseOrderController::class, 'saveEquipmentInfo'])->name('purchase-orders.save-equipment-info');
    Route::delete('purchase-orders/{id}/equipment-part', [PurchaseOrderController::class, 'deleteEquipmentPart'])->name('purchase-orders.delete-equipment-part');
    Route::get('purchase-orders/{id}/add-parts', [PurchaseOrderController::class, 'createPart'])->name('purchase-orders.createPart');
    Route::post('purchase-orders/get-categories', [PurchaseOrderController::class, 'getSubcategories'])->name('purchase-orders.get-categories');
    Route::post('purchase-orders/add-part', [PurchaseOrderController::class, 'addPart'])->name('purchase-orders.add-part');
    Route::get('purchase-orders/{id}/clone', [PurchaseOrderController::class, 'clone'])->name('purchase-orders.clone');
    Route::put('purchase-orders/{id}/add-history', [PurchaseOrderController::class, 'addHistory'])->name('purchase-orders.add-history');
    Route::delete('purchase-orders/{id}/delete-image', [PurchaseOrderController::class, 'deleteImage'])->name('purchase-orders.delete-image');
    Route::delete('purchase-orders/{id}/delete-document', [PurchaseOrderController::class, 'deleteDocument'])->name('purchase-orders.delete-document');
    Route::post('purchase-orders/change-status', [PurchaseOrderController::class, 'changeStatus'])->name('purchase-orders.change-status');
    /*
    |--------------------------------------------------------------------------
    | Equipment Route
    |--------------------------------------------------------------------------
    */

    Route::resource('equipments', EquipmentController::class);
    Route::get('equipment/export', [EquipmentController::class,'exports'])->name('equipments.exports');

    Route::post('address/get-equipments', [EquipmentController::class, 'getEquipmentsByAddress'])->name('address.get-equipments');

    Route::post('address/get-part-details', [EquipmentController::class, 'getPartDetails'])->name('equipments.get-part-details');

     /*
    |--------------------------------------------------------------------------
    | Job Route
    |--------------------------------------------------------------------------
    */

    Route::resource('jobs', JobController::class);
    Route::get('jobs/epod/{id}', [JobController::class, 'epod'])->name('jobs.epod');

    //Download Hotel images
    Route::get('jobs/downloads/{id}', [JobController::class, 'downloadImages'])->name('download.epod');

    Route::get('jobs/{id}/parts-replacement', [JobController::class, 'partReplacement'])->name('jobs.parts-replacement');
    Route::put('jobs/{id}/parts-replacement-info', [JobController::class, 'savePartReplacement'])->name('jobs.save-parts-replacement');
    Route::get('jobs/{id}/delete-equipment-part', [JobController::class, 'deleteEquipmentPart'])->name('jobs.delete-equipment-part');
    Route::delete('jobs/{id}/delete-image', [JobController::class, 'deleteImage'])->name('jobs.delete-image');
    Route::resource('job-calendar', JobCalendarController::class);

    /*
    |--------------------------------------------------------------------------
    | Technicians Route
    |--------------------------------------------------------------------------
    */

    Route::resource('technicians', TechnicianController::class);

    Route::post('technicians/reset-password', [TechnicianController::class, 'resetPassword'])->name('technicians.reset-password');
    Route::post('technicians/bulk-delete', [TechnicianController::class, 'bulkDelete'])->name('technicians.bulk-delete');

    /*
    |--------------------------------------------------------------------------
    | Suppliers Route
    |--------------------------------------------------------------------------
    */

    Route::resource('franchises', FranchiseController::class);


    Route::post('franchises/reset-password', [FranchiseController::class, 'resetPassword'])->name('franchises.reset-password');
    Route::post('franchises/bulk-delete', [FranchiseController::class, 'bulkDelete'])->name('franchises.bulk-delete');

    
    Route::resource('leads', LeadController::class);
    Route::get('leads/convert/{id}', [LeadController::class, 'convert'])->name('leads.convert');
    Route::post('leads/update-date', [LeadController::class, 'updateDate'])->name('leads.update-date');
    Route::post('leads/change-status', [LeadController::class, 'updateStatus'])->name('leads.change-status');

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


    Route::resource('job-types', JobTypeController::class);
    Route::post('job-types/bulk-delete', [JobTypeController::class, 'bulkDelete'])->name('job-types.bulk-delete');

    Route::resource('inventory/equipments', InventoryEquipmentController::class, [
        'names' => [
            'index'         => 'inventory-equipment.index',
            'create'        => 'inventory-equipment.create',
            'update'        => 'inventory-equipment.update',
            'edit'          => 'inventory-equipment.edit',
            'store'         => 'inventory-equipment.store',
            'show'          => 'inventory-equipment.show',
            'destroy'       => 'inventory-equipment.destroy',
        ]
    ]);

    Route::delete('inventory/equipments/{id}/part', [InventoryEquipmentController::class, 'deleteEquipmentPart'])->name('inventory-equipment.delete-part');
    Route::get('inventory/equipments/{id}/add-parts', [InventoryEquipmentController::class, 'createPart'])->name('inventory-equipment.createPart');
    Route::post('inventory-equipments/add-part', [InventoryEquipmentController::class, 'addPart'])->name('inventory-equipment.add-part');
    Route::post('inventory-equipments/get-serials', [InventoryEquipmentController::class, 'getSerials'])->name('inventory-equipment.get-serials');
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
