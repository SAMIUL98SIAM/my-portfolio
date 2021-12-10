<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Cart;
use Illuminate\Support\Facades\Session;
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
        if(!Session::has('cart'))
        {
            return view('frontend.layouts.master.cart') ;
        }

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);

        return view('frontend.layouts.master.cart',['products'=>$cart->items]);
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

    public function addToCart($id)
    {
        $product = Product::find($id);

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        Session::put('cart', $cart);
        //dd(Session::get('cart'));
        return back();
    }

    public function update_qty(Request $request,$id)
    {
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->updateQty($id, $request->quantity);
        Session::put('cart', $cart);
        return back();
    }

    public function remove_from_cart($id)
    {
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if(count($cart->items) > 0){
            Session::put('cart', $cart);
        }
        else{
            Session::forget('cart');
        }

        //dd(Session::get('cart'));
        return back();
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
