<?php

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

Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index'])->name('frontend.layouts.home');
Route::get('/cart', [App\Http\Controllers\Frontend\FrontendController::class, 'cart'])->name('frontend.layouts.cart');
Route::get('/shop', [App\Http\Controllers\Frontend\FrontendController::class, 'shop'])->name('frontend.layouts.shop');
Route::get('/checkout', [App\Http\Controllers\Frontend\FrontendController::class, 'checkout'])->name('frontend.layouts.checkout');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';
