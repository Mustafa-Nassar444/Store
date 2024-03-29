<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::group(['prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localeViewPath' ]
], function() {
    Route::get('/', [\App\Http\Controllers\Front\HomeController::class, 'index'])->name('home');
    Route::get('product', [\App\Http\Controllers\Front\ProductController::class, 'index'])->name('product.index');
    Route::get('/product/{product:slug}', [\App\Http\Controllers\Front\ProductController::class, 'show'])->name('product.show');
    Route::resource('cart', \App\Http\Controllers\Front\CartController::class);
    Route::get('checkout', [\App\Http\Controllers\Front\CheckoutController::class, 'create'])->name('checkout');
    Route::post('checkout', [\App\Http\Controllers\Front\CheckoutController::class, 'store']);
    Route::get('/2fa', \App\Http\Controllers\Front\Auth\TwoFactorAuthenticationController::class);
    Route::post('currency', [\App\Http\Controllers\Front\CurrencyConverterController::class, 'store'])->name('currency.store');
});
//require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
