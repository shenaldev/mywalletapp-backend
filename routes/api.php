<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\IncomesController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\UserController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/email/send-verification', [EmailVerificationController::class, 'sendVerificationCode']);
Route::post('/email/verify', [EmailVerificationController::class, 'validateCode']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/check-token', [AuthController::class, 'checkToken']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/categories', [CategoriesController::class, 'index']);
    //User Routes
    Route::get('/user/register-year', [UserController::class, 'getRegisterYear']);
    //Payment Routes
    Route::post('/payments/add', [PaymentsController::class, 'store']);
    Route::get('/payments/{year}/{month}', [PaymentsController::class, 'getPayments']);
    //Income Routes
    Route::post('/incomes/add', [IncomesController::class, 'store']);
    Route::get('/incomes/{year}/{month}', [IncomesController::class, 'getIncomes']);
});
