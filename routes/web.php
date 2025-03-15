<?php

use App\Http\Controllers\Technician\ResetPassword;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/run-storage-link', function () {
     App::useStoragePath(base_path('laravel_project/storage'));

    // Run the artisan command
    Artisan::call('storage:link');

    return 'Storage link created successfully!';
});


Route::get('login-chef/{id}', [App\Http\Controllers\IndexController::class, 'loginChef'])->name('login-chef');
Route::get('direct-chef-login/{token}', [App\Http\Controllers\IndexController::class, 'directChefLogin'])->name('direct-chef-login');

Route::get('login-franchise/{id}', [App\Http\Controllers\IndexController::class, 'loginFranchise'])->name('login-franchise');
Route::get('direct-franchise-login/{token}', [App\Http\Controllers\IndexController::class, 'directFranchiseLogin'])->name('direct-franchise-login');


Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');
Route::get('registration-type', [App\Http\Controllers\IndexController::class, 'registrationType'])->name('registration-type');
Route::get('login-type', [App\Http\Controllers\IndexController::class, 'loginType'])->name('login-type');

Route::get('contact', [ContactController::class, 'Contact'])->name('contact');
Route::post('contact/save', [ContactController::class, 'saveContact'])->name('contact.save');
Route::get('about-us', [AboutController::class, 'About'])->name('about-us');
Route::get('faq', [FaqController::class, 'Faq'])->name('faq');
Route::get('terms-and-conditions', [TermsAndConditionsController::class, 'index'])->name('terms-and-conditions');
Route::get('maintenance', [MaintenanceController::class, 'index'])->name('maintenance');
Route::get('faq/trader', [FaqController::class, 'FaqTrader'])->name('faq.trader');
Route::get('trades/{group}', [App\Http\Controllers\IndexController::class, 'getTradesByGroup'])->name('trades.group');
Route::get('pages', [PagesController::class, 'Pages'])->name('pages');
Route::get('pages/{slug}', [PagesController::class, 'page'])->name('page.show');


/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/leads/create', function () {
    return view('contact');
});

Route::post('contact/save', [App\Http\Controllers\ContactController::class, 'saveContact'])->name('contact.save');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/privacy-policy', function () {
    return view('privacyPolicy');
})->name('privacy-policy')->middleware('guest');


Route::get('technician/password/reset/{token}', [ResetPassword::class, 'showResetForm'])->name('technician.password.form');
Route::post('technician/password/update', [ResetPassword::class, 'updatePassword'])->name('technician.password.update');
