<?php

use App\Http\Controllers\Api\Technician\AuthController;
use App\Http\Controllers\Api\Technician\AssetController;
use App\Http\Controllers\Api\Technician\JobController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'technician', 'as' => 'technician.'], function () {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('send-forgot-password-link', [AuthController::class, 'forgotPasswordLink']);
    Route::post('confirm-passcode', [AuthController::class, 'confirmPasscode']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
    Route::get('countries', [AssetController::class, 'countries']);
    Route::get('testnotify', [AuthController::class, 'testnotify']);
});
    