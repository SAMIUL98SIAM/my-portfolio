<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.layouts.master.home');
    }

    public function cart()
    {
        return view('frontend.layouts.master.cart');
    }

    public function shop()
    {
        return view('frontend.layouts.master.shop');
    }

    public function checkout()
    {
        return view('frontend.layouts.master.checkout');
    }

}
