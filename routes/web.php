<?php

use App\Http\Controllers\FrontendController;
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

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/terms-conditions', [FrontendController::class, 'terms_conditions'])->name('terms-conditions');
Route::get('/privacy-policy', [FrontendController::class, 'privacy_policy'])->name('privacy-policy');
