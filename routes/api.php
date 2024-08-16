<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\FundProfileController;
use App\Http\Controllers\Api\DashboardController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('chart/get', [DashboardController::class, 'chartDataGet']);

 // auth route
Route::post('user-register', [AuthController::class, 'register']);
    Route::post('user-login', [AuthController::class, 'login']);
    // Route::get('mail-verify/{email}', [AuthController::class, 'mailVerify']);
    // Route::get('single-user/{uu_id}', [AuthController::class, 'getuser']);
    // Route::post('otp-verify', [AuthController::class, 'checkOtp']);
    // Route::get('otp-delete/{uu_id}', [AuthController::class, 'deleteOtp']);
    // Route::post('profile-update', [AuthController::class, 'profileUpdate']);


    // Protected company routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/fund-profiles', [FundProfileController::class, 'store']);
    Route::get('/fund-profiles', [FundProfileController::class, 'index']);
    Route::get('/general-partners', [FundProfileController::class, 'getGeneralPartners']);
    Route::get('/limited-partners', [FundProfileController::class, 'getLimitedPartners']);
    // Add other protected routes
});

// Admin routes
Route::post('/admin/signup', [AdminController::class, 'signup']);
Route::post('/admin/login', [AdminController::class, 'login']);

// Protected admin routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin/companies', [AdminController::class, 'getCompanies']);
    // Add other protected admin routes
});