<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return Auth::guard('sanctum')->user();
});
Route::apiResource('products',\App\Http\Controllers\Api\ProductController::class);
Route::post('auth/access-token',[\App\Http\Controllers\Api\AccessTokenController::class,'store'])->middleware('guest:sanctum');
Route::delete('auth/access-token/{token?}',[\App\Http\Controllers\Api\AccessTokenController::class,'destroy'])->middleware('auth:sanctum');
