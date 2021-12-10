<?php

namespace App\Http\Controllers\Admin\Slider;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['allData'] = Slider::all();
        return view('admin.slider.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Slider();
        $data->description1 = $request->description1;
        $data->description2 = $request->description2;
        if($request->file('image')){
            $file = $request->file('image');
            //@unlink(public_path('upload/logo_image'.$logo->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/slider_image'),$filename);
            $data->image = $filename;
        }
        $data->status = '0';
        $data->save();
        return redirect()->route('sliders.view')->with('status','Slider has saved successfully');
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
        $data['editData'] = Slider::find($id);
        return view('admin.slider.edit',$data);
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
        $editData = Slider::find($id);
        $editData->description1 = $request->description1;
        $editData->description2 = $request->description2;
        if($request->file('image')){
            $file = $request->file('image');
            //@unlink(public_path('upload/logo_image'.$logo->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/slider_image'),$filename);
            $editData->image = $filename;
        }
        $editData->save();
        return redirect()->route('sliders.view')->with('status','Slider has updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Slider::find($id);
        if(file_exists('/school/public/upload/slider_image/'.$data->image) AND !empty($data->image))
        {
            unlink('/school/public/upload/slider_image/'.$data->image);
        }
        $data->delete();
        return redirect()->route('sliders.view')->with('error','Delete these slider');
    }


    public function activate($id)
    {
        $data = Slider::find($id);
        $data->status = 1;
        $data->update();
        return redirect()->route('sliders.view')->with('status','Slider has been activated');
    }
    public function unactivate($id)
    {
        $data = Slider::find($id);
        $data->status = 0;
        $data->update();
        return redirect()->route('sliders.view')->with('error','Slider has been unactivated');
    }
}
