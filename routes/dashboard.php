<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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


Route::group(['middleware'=>'auth','prefix'=>'dashboard','namespace'=>'\App\Http\Controllers\Dashboard'],function (){
    Route::get('/', [DashboardController::class,'index'])->name('dashboard');
    Route::resource('/categories',CategoryController::class);
});

/*require __DIR__.'/auth.php';*/
