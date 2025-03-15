<?php

use App\Http\Controllers\Technician\ResetPassword;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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

Route::get('/run-config', function () {
     
     Storage::disk('public')->put('test.txt', 'This is a test');

     Artisan::call('cache:clear');
     Artisan::call('route:clear');
     Artisan::call('config:clear');
     Artisan::call('view:clear');
     Artisan::call('optimize:clear');
     //Artisan::call('storage:link');
     Artisan::call('optimize:clear');

      return 'Storage link created successfully!';
});

Route::get('/run-storage-link', function () {
     
     echo $target = base_path('storage/app/public'); // Target folder
    echo $link =  str_replace('/laravel_project/', '/', base_path('storage')); // Symlink path

    // Check if target directory exists
    if (!File::exists($target)) {
        return 'Error: Target directory does not exist at ' . $target;
    }

    // Delete existing symlink if it exists
    if (File::exists($link)) {
        File::delete($link);
    }

    // Create symlink
    if (symlink($target, $link)) {
        return 'Storage link created successfully!';
        Artisan::call('optimize:clear');

    } else {
        return 'Error: Failed to create symlink!';
    }

});


Route::get('login-chef/{id}', [IndexController::class, 'loginChef'])->name('login-chef');
Route::get('direct-chef-login/{token}', [IndexController::class, 'directChefLogin'])->name('direct-chef-login');

Route::get('login-franchise/{id}', [IndexController::class, 'loginFranchise'])->name('login-franchise');
Route::get('direct-franchise-login/{token}', [IndexController::class, 'directFranchiseLogin'])->name('direct-franchise-login');


Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('registration-type', [IndexController::class, 'registrationType'])->name('registration-type');
Route::get('login-type', [IndexController::class, 'loginType'])->name('login-type');

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
