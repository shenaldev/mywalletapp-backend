<?php

use App\Http\Controllers\API\V1\Auth\AuthController;
use App\Http\Controllers\API\V1\Auth\EmailVerificationController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\IncomesController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ReportController;
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

//PUBLIC COMMON ROUTES
Route::post("/remove-cookies", [AuthController::class, 'removeCookies']);

//GUEST ROUTES FOR AUTHENTICATION
Route::prefix("v1")->middleware("guest")->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    //EMAIL VARIFY
    Route::post('/email-verification', [EmailVerificationController::class, 'send']);
    Route::post('/email-verify', [EmailVerificationController::class, 'verify']);
});

//AUTHENTICATED ROUTES
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::get('/check-token', [AuthController::class, 'checkToken']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/categories', [CategoriesController::class, 'index']);

    //User Routes
    Route::get('/user/register-year', [UserController::class, 'getRegisterYear']);

    //Payment Routes
    Route::post('/payments/add', [PaymentsController::class, 'store']);
    Route::get('/payments/{year}/{month}', [PaymentsController::class, 'getPayments']);
    Route::delete('/payment/{id}', [PaymentsController::class, 'destroy']);
    Route::put('/payment/{id}', [PaymentsController::class, 'update']);

    //Income Routes
    Route::post('/incomes/add', [IncomesController::class, 'store']);
    Route::get('/incomes/{year}/{month}', [IncomesController::class, 'getIncomes']);
    Route::delete('/income/{id}', [IncomesController::class, 'destroy']);
    Route::put('/income/{id}', [IncomesController::class, 'update']);

    //REPORT ROUTE
    Route::get('/report/{year}', [ReportController::class, 'generate']);
});
