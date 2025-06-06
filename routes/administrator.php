<?php

use App\Http\Controllers\Admin\Auth\ChangePasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\MyAccountController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SaleProductFranchiseReportController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\WalletController;
use App\Http\Controllers\Admin\ProductUnitController;
use App\Http\Controllers\Admin\LoginLogController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductPriceController;
use App\Http\Controllers\Admin\WarehouseItemController;
use App\Http\Controllers\Admin\ProductFranchiseSaleReportController;
use App\Http\Controllers\Admin\WarehouseInventoryController;
use App\Http\Controllers\Admin\ProductFranchiseController;
use App\Http\Controllers\Admin\ProductSaleReportController;
use App\Http\Controllers\Admin\FranchiseSaleReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\OrderSaleController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\FranchiseProductSaleReportController;
use App\Http\Controllers\Admin\ProductQuantityController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\FranchiseController;
use App\Http\Controllers\Admin\SaleReportController;
use App\Http\Controllers\Admin\WalletRequestController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\ChefController;
use App\Http\Controllers\Admin\UserManagement\AdminController;
use App\Http\Controllers\Admin\UserManagement\SuperadminController;
use App\Http\Controllers\Admin\ProductAssignmentController;
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

     Route::get('intend-login/{id}',[DashboardController::class,'adminIntendLogin'])->name('intend-login');

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

    Route::resource('inquiries', InquiryController::class);
    
    Route::resource('wallet', WalletController::class);
    Route::resource('wallet-requests', WalletRequestController::class);

    Route::resource('chefs', ChefController::class);
       Route::post('chefs/reset-password', [FranchiseController::class, 'resetPassword'])->name('chefs.reset-password');
    Route::post('chefs/bulk-delete', [FranchiseController::class, 'bulkDelete'])->name('chefs.bulk-delete');


    Route::resource('transactions', TransactionController::class);
    Route::get('sales/export', [SaleController::class, 'export'])->name('sales.export');
    Route::resource('sales', SaleController::class);

    
    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
        Route::resource('sales', SaleController::class);

        Route::group(['prefix' => 'sale', 'as' => 'sale.'], function () {
            Route::resource('reports', OrderSaleController::class);
        });

    });


    Route::group(['prefix' => 'sale', 'as' => 'sale.'], function () {
        Route::get('reports/export', [SaleReportController::class, 'export'])->name('reports.export');
        Route::resource('reports', SaleReportController::class);
    });

    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('quantity', [ProductController::class, 'productQuantity'])->name('quantity');

        Route::group(['prefix' => 'sale', 'as' => 'sale.'], function () {
            Route::resource('reports', ProductSaleReportController::class);
        });

        Route::group(['prefix' => 'franchise', 'as' => 'franchise.'], function () {

            Route::group(['prefix' => 'sale', 'as' => 'sale.'], function () {
                Route::resource('reports', ProductFranchiseSaleReportController::class);
            });

            Route::group(['prefix' => 'sales', 'as' => 'sales.'], function () {
                Route::resource('reports', SaleProductFranchiseReportController::class);
            });

        });
    });

    Route::group(['prefix' => 'franchise', 'as' => 'franchise.'], function () {

        Route::group(['prefix' => 'product', 'as' => 'product.'], function () {

            Route::group(['prefix' => 'sale', 'as' => 'sale.'], function () {
                Route::resource('reports', FranchiseProductSaleReportController::class);
            });

        });

        Route::group(['prefix' => 'sale', 'as' => 'sale.'], function () {
            Route::resource('reports', FranchiseSaleReportController::class);
        });
    });
    
    Route::resource('categories', CategoryController::class);
    Route::post('categories/get-subcategories', [CategoryController::class, 'getSubcategories'])->name('categories.get-subcategories');
    Route::post('categories/get-parts', [CategoryController::class, 'getPartsByCategory'])->name('categories.get-parts');

     /*
    |--------------------------------------------------------------------------
    | Parts Route
    |--------------------------------------------------------------------------
    */

    Route::get('notifications/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.mark-all-read');
    Route::get('notifications/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
    Route::resource('notifications', NotificationController::class);

    Route::get('products/export', [ProductController::class, 'export'])->name('products.export');

    Route::post('products/import', [ProductController::class, 'import'])->name('products.import');
    Route::get('products/download-sample', [ProductController::class, 'downloadSampleCsv'])->name('products.download.sample.csv');

    Route::resource('products', ProductController::class);

    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::post('assign', [ProductAssignmentController::class, 'assign'])->name('assign');
        Route::get('assignments/{product}', [ProductAssignmentController::class, 'history'])->name('assignments.history');
        Route::get('assignments/create/{product}', [ProductAssignmentController::class, 'create'])->name('assignments.create');
        Route::get('assignments/{assignment}/edit', [ProductAssignmentController::class, 'edit'])->name('assignments.edit');
        Route::put('assignments/{assignment}', [ProductAssignmentController::class, 'update'])->name('assignments.update');
    });

    Route::resource('product-quantities', ProductQuantityController::class);

    Route::resource('product-prices', ProductPriceController::class);
    Route::post('product-prices/update-price', [ProductPriceController::class, 'updatePrice'])->name('product-prices.update.price');

    Route::resource('product-franchises', ProductFranchiseController::class);

    Route::delete('products/{id}/delete-image', [ProductController::class, 'deleteImage'])->name('products.delete-image');
    Route::delete('products/{id}/delete-document', [ProductController::class, 'deleteDocument'])->name('products.delete-document');
    Route::post('products/update-quantity', [ProductController::class, 'updateQuantity'])->name('products.update.quantity');
    Route::get('products/change-status/{id}', [ProductController::class, 'changeStatus'])->name('products.change-status');


    Route::resource('warehouse-items', WarehouseItemController::class);
    Route::delete('warehouse-items/{id}/delete-image', [WarehouseItemController::class, 'deleteImage'])->name('warehouse-items.delete-image');
    Route::delete('warehouse-items/{id}/delete-document', [WarehouseItemController::class, 'deleteDocument'])->name('warehouse-items.delete-document');
    Route::post('warehouse-items/update-quantity', [WarehouseItemController::class, 'updateQuantity'])->name('warehouse-items.update.quantity');

    Route::post('warehouse-inventory/add', [WarehouseInventoryController::class, 'add'])->name('warehouse-inventory.add');

    Route::resource('warehouse-inventory', WarehouseInventoryController::class);
    Route::delete('warehouse-inventory/{id}/delete-image', [WarehouseInventoryController::class, 'deleteImage'])->name('warehouse-inventory.delete-image');
    Route::delete('warehouse-inventory/{id}/delete-document', [WarehouseInventoryController::class, 'deleteDocument'])->name('warehouse-inventory.delete-document');
    Route::post('warehouse-inventory/update-quantity', [WarehouseInventoryController::class, 'updateQuantity'])->name('warehouse-inventory.update.quantity');


     /*
    |--------------------------------------------------------------------------
    | Order Route
    |--------------------------------------------------------------------------
    */

    Route::get('orders/export', [OrderController::class, 'export'])->name('orders.export');

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


    Route::post('/leads/import', [LeadController::class, 'import'])->name('leads.import');
    Route::get('/leads/export', [LeadController::class, 'export'])->name('leads.export');

    Route::get('/leads/download/sample-csv', [LeadController::class, 'downloadSampleCSV'])->name('leads.download.sample.csv');
    
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

    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.list');

    Route::get('notifications-fetch', function () {
        return view('admin.includes.notifications-list');
    })->name('notifications.fetch');

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

    Route::resource('blogs', BlogController::class);
    Route::resource('login-logs', LoginLogController::class);

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


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth:administrator']], function () {
    Route::get('product-unit', [ProductUnitController::class, 'edit'])->name('product-unit.edit');
    Route::post('product-unit', [ProductUnitController::class, 'store'])->name('product-unit.store');
    Route::put('product-unit/{id}', [ProductUnitController::class, 'update'])->name('product-unit.update');
    Route::delete('product-unit/{id}', [ProductUnitController::class, 'destroy'])->name('product-unit.destroy');
});