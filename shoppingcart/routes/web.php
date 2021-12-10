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
Route::get('/shop/view_product_by_category/{category_name}', [App\Http\Controllers\Frontend\FrontendController::class, 'view_product_by_category'])->name('view_product_by_category');

Route::get('/shop/addToCart/{id}', [App\Http\Controllers\Frontend\FrontendController::class, 'addToCart'])->name('addToCart');
Route::post('/shop/update_qty/{id}', [App\Http\Controllers\Frontend\FrontendController::class, 'update_qty'])->name('update_qty');
Route::get('/shop/remove_from_cart/{id}', [App\Http\Controllers\Frontend\FrontendController::class, 'remove_from_cart'])->name('remove_from_cart');




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
    Route::post('/store',[App\Http\Controllers\Admin\Slider\SliderController::class,'store'])->name('sliders.store');
    Route::get('/edit/{id}',[App\Http\Controllers\Admin\Slider\SliderController::class,'edit'])->name('sliders.edit');
    Route::post('/update/{id}',[App\Http\Controllers\Admin\Slider\SliderController::class,'update'])->name('sliders.update');
    Route::get('/destroy/{id}',[App\Http\Controllers\Admin\Slider\SliderController::class,'destroy'])->name('sliders.destroy');
    Route::get('/activate/{id}',[App\Http\Controllers\Admin\Slider\SliderController::class,'activate'])->name('sliders.activate');
    Route::get('/unactivate/{id}',[App\Http\Controllers\Admin\Slider\SliderController::class,'unactivate'])->name('sliders.unactivate');
});
/*Slider*/

/*Product*/
Route::prefix('products')->group(function(){
    Route::get('/view',[App\Http\Controllers\Admin\Product\ProductController::class,'index'])->name('products.view');
    Route::get('/create',[App\Http\Controllers\Admin\Product\ProductController::class,'create'])->name('products.create');
    Route::post('/store',[App\Http\Controllers\Admin\Product\ProductController::class,'store'])->name('products.store');
    Route::get('/edit/{id}',[App\Http\Controllers\Admin\Product\ProductController::class,'edit'])->name('products.edit');
    Route::post('/update/{id}',[App\Http\Controllers\Admin\Product\ProductController::class,'update'])->name('products.update');
    Route::get('/destroy/{id}',[App\Http\Controllers\Admin\Product\ProductController::class,'destroy'])->name('products.destroy');
    Route::get('/activate/{id}',[App\Http\Controllers\Admin\Product\ProductController::class,'activate'])->name('products.activate');
    Route::get('/unactivate/{id}',[App\Http\Controllers\Admin\Product\ProductController::class,'unactivate'])->name('products.unactivate');
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
