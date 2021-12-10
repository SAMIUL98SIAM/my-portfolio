<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['allData'] = Product::all();
        return view('admin.product.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$data['categories'] = Category::all()->pluck('category_name');
        $data['categories'] = Category::all();
        return view('admin.product.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Product();
        $data->product_name = $request->product_name;
        $data->product_price = $request->product_price;
        $data->product_category = $request->product_category;
        if($request->file('image')){
            $file = $request->file('image');
            //@unlink(public_path('upload/logo_image'.$logo->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/product_image'),$filename);
            $data->image = $filename;
        }
        $data->status = '0';
        $data->save();
        return redirect()->route('products.view')->with('status','Product has saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['editData'] = Product::find($id);
        $data['categories'] = Category::all();
        return view('admin.product.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $editData = Product::find($id);
        $editData->product_name = $request->product_name;
        $editData->product_price = $request->product_price;
        $editData->product_category = $request->product_category;
        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/product_image'.$editData->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/product_image'),$filename);
            $editData->image = $filename;
        }

        $editData->save();
        return redirect()->route('products.view')->with('status','Product has updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::find($id);
        if(file_exists('/school/public/upload/product_image/'.$data->image) AND !empty($data->image))
        {
            unlink('/school/public/upload/product_image/'.$data->image);
        }
        $data->delete();
        return redirect()->route('products.view')->with('error','Delete these product');
    }
}
