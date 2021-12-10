<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $data['sliders'] = Slider::where('status',1)->get();
        $data['products'] = Product::where('status',1)->get();
        return view('frontend.layouts.master.home',$data);
    }

    public function cart()
    {
        return view('frontend.layouts.master.cart');
    }

    public function shop()
    {
        $data['categories'] = Category::all();
        $data['products'] = Product::where('status',1)->get();
        return view('frontend.layouts.master.shop',$data);
    }

    public function view_product_by_category($category_name)
    {
        $data['products'] = Product::where('product_category',$category_name)->where('status',1)->get();
        $data['categories'] = Category::all();
        return view('frontend.layouts.master.shop',$data);
    }

    public function checkout()
    {
        return view('frontend.layouts.master.checkout');
    }

    public function login()
    {
        return view('frontend.layouts.master.login');
    }

    public function signup()
    {
        return view('frontend.layouts.master.signup');
    }
}
