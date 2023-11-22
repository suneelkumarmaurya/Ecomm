<?php

use Illuminate\Support\Facades\Route;
use Modules\Billing\Http\Controllers\Api\StripeController;
use Modules\Billing\Http\Controllers\Api\WishlistController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('wishlist', WishlistController::class)->only('index', 'store', 'destroy');
Route::post('stripe', [StripeController::class, 'stripe']);

