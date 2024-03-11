<?php

use App\Http\Controllers\API\V1\Auth\AuthController;
use App\Http\Controllers\API\V1\Auth\EmailVerificationController;
use App\Http\Controllers\API\V1\Admin\CategoriesController;
use App\Http\Controllers\API\V1\Common\PaymentMethodsController;
use App\Http\Controllers\API\V1\User\CategoriesController as UserCategoriesController;
use App\Http\Controllers\API\V1\User\GetPaymentsController;
use App\Http\Controllers\API\V1\User\IncomesController;
use App\Http\Controllers\API\V1\User\PaymentsController;
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
    Route::get('/payment-methods', [PaymentMethodsController::class, 'index']);

    //USER ROUTES
    Route::prefix('user')->group(function () {
        //User Category Routes
        Route::get('/categories', [UserCategoriesController::class, 'index']);
        Route::post('/categories', [UserCategoriesController::class, 'store']);
        Route::put('/categories/{id}', [UserCategoriesController::class, 'update']);
        Route::delete('/categories/{id}', [UserCategoriesController::class, 'destroy']);

        //User Routes
        Route::get('/register-year', [UserController::class, 'getRegisterYear']);

        //Payment Routes
        Route::get('/payments/{id}', [GetPaymentsController::class, 'getPayment']);
        Route::get('/payments/{year}/{month}', [GetPaymentsController::class, 'getPayments']);
        Route::post('/payments', [PaymentsController::class, 'store']);
        Route::put('/payments/{id}', [PaymentsController::class, 'update']);
        Route::delete('/payments/{id}', [PaymentsController::class, 'destroy']);

        //Income Routes
        Route::get('/incomes/{id}', [IncomesController::class, 'getIncomeNote']);
        Route::get('/incomes/{year}/{month}', [IncomesController::class, 'index']);
        Route::post('/incomes', [IncomesController::class, 'store']);
        Route::put('/incomes/{id}', [IncomesController::class, 'update']);
        Route::delete('/incomes/{id}', [IncomesController::class, 'destroy']);
    });

    //REPORT ROUTE
    Route::get('/report/{year}', [ReportController::class, 'generate']);

    /**
     * ADMIN DASHBOARD ROUTES
     */
    Route::prefix('admin')->middleware('admin')->group(function () {
        //CATEGORY ROUTES
        Route::get('/categories', [CategoriesController::class, 'index']);
        Route::post('/categories', [CategoriesController::class, 'store']);
        Route::put('/categories/{id}', [CategoriesController::class, 'update']);
        Route::delete('/categories/{id}', [CategoriesController::class, 'destroy']);
    });
});
