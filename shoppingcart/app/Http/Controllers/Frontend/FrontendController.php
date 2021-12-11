<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Cart;
use App\Models\Order;
use App\Models\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        if(!Session::has('client'))
        {
            return view('frontend.layouts.master.login');
        }
        if(!Session::has('cart'))
        {
            return view('frontend.layouts.master.cart');
        }
        return view('frontend.layouts.master.checkout');
    }

    public function postcheckout(Request $request)
    {
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);

        $order  = new Order();
        $order->name = $request->name;
        $order->address = $request->address;
        $order->cart = serialize($cart);
        $order->save();

        Session::forget('cart');
        return redirect('/cart')->with('status','Your purchase has been successful accomplish !!!');
    }


    public function login()
    {
        return view('frontend.layouts.master.login');
    }

    public function logout()
    {
        Session::forget('client');
        return redirect('/shop');
    }

    public function access_account(Request $request)
    {
        $validatedData = $request->validate([
            'email'=>'required',
            'password'=>'required|min:4'
        ]);

        $client =  Client::where('email',$request->email)->first();
        if($client)
        {
            if(Hash::check($request->password,$client->password))
            {
                Session::put('client',$client);
                return redirect('/shop');
            }
            else
            {
                return back()->with('status','Bad email or password');
            }
        }
        else
        {
            return back()->with('status','Your do not have an accont with this email!!') ;
        }
    }

    public function signup()
    {
        return view('frontend.layouts.master.signup');
    }

    public function create_account(Request $request)
    {
        $validatedData = $request->validate([
            'email'=>'required|unique:clients,email',
            'password'=>'required|min:4'
        ]);

        $client = new Client();
        $client->email = $request->email ;
        $client->password = bcrypt($request->password);
        $client->save();

        return back()->with('status','Your account has successfully created!!') ;

    }
}
