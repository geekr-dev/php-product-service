<?php

use App\Http\Controllers\ProductController;
use App\Services\RedisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('redis', function () {
    $redis = new RedisService();
    dd($redis);
});

Route::apiResource('products', ProductController::class);
