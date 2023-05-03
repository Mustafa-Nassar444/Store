<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
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
/*Route::get('/dashboard', [\App\Http\Controllers\Dashboard\DashboardController::class,'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');*/

/*Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});*/
Route::group(['middleware'=>['auth:admin'],'prefix'=>'admin/dashboard','namespace'=>'\App\Http\Controllers\Dashboard'],function (){
    Route::get('/profile',[ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile',[ProfileController::class,'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [DashboardController::class,'index'])->name('dashboard');
    Route::get('categories/trashed',[CategoryController::class,'getTrashed'])->name('categories.trashed');
    Route::put('categories/restore/{category}',[CategoryController::class,'restore'])->name('categories.restore');
    Route::delete('categories/forceDelete/{category}',[CategoryController::class,'force'])->name('categories.forceDelete');
    Route::resource('/categories',CategoryController::class);
    Route::resource('/products',ProductController::class);
});

/*Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});*/
//require __DIR__.'/auth.php';
