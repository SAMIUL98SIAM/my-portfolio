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
Route::get('/login', [App\Http\Controllers\Frontend\FrontendController::class, 'login'])->name('frontend.layouts.login');
Route::get('/signup', [App\Http\Controllers\Frontend\FrontendController::class, 'signup'])->name('frontend.layouts.signup');


Route::get('/admin/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('dashboard');

/*Category*/
Route::prefix('categories')->group(function(){
    Route::get('/view',[App\Http\Controllers\Admin\Category\CategoryController::class,'index'])->name('categories.view');
    Route::get('/create',[App\Http\Controllers\Admin\Category\CategoryController::class,'create'])->name('categories.create');
    Route::post('/store',[App\Http\Controllers\Admin\Category\CategoryController::class,'store'])->name('categories.store');
    Route::put('/update/{id}',[App\Http\Controllers\Admin\Category\CategoryController::class,'update'])->name('categories.update');
    Route::get('/destroy/{id}',[App\Http\Controllers\Admin\Category\CategoryController::class,'destroy'])->name('categories.destroy');
});
/*Category*/

/*Slider*/
Route::prefix('sliders')->group(function(){
    Route::get('/view',[App\Http\Controllers\Admin\Slider\SliderController::class,'index'])->name('sliders.view');
    Route::get('/create',[App\Http\Controllers\Admin\Slider\SliderController::class,'create'])->name('sliders.create');
});
/*Slider*/

/*Product*/
Route::prefix('products')->group(function(){
    Route::get('/view',[App\Http\Controllers\Admin\Product\ProductController::class,'index'])->name('products.view');
    Route::get('/create',[App\Http\Controllers\Admin\Product\ProductController::class,'create'])->name('products.create');
    Route::post('/store',[App\Http\Controllers\Admin\Product\ProductController::class,'store'])->name('products.store');
    Route::get('/edit/{id}',[App\Http\Controllers\Admin\Product\ProductController::class,'edit'])->name('products.edit');
    Route::post('/update/{id}',[App\Http\Controllers\Admin\Product\ProductController::class,'update'])->name('products.update');
    Route::get('/destroy/{id}',[App\Http\Controllers\Admin\Product\ProductController::class,'destroy'])->name('categories.destroy');
});
/*Product*/

/*Order*/
Route::prefix('orders')->group(function(){
    Route::get('/view',[App\Http\Controllers\Admin\Order\OrderController::class,'index'])->name('orders.view');
});
/*Order*/




// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';
