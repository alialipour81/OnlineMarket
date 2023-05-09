<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Slider\CreateRequestSlider;
use App\Http\Requests\Admin\Slider\UpdateRequestSlider;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::orderBy('id','desc')->Paginate(15);
        return view('admin.sliders.index')
            ->with('sliders',$sliders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequestSlider $request)
    {
        $slider = Slider::create([
           'name'=>$request->name,
           'link'=>$request->link,
           'image'=>$request->image->store('sliders')
        ]);
        if(auth()->user()->role =="admin"){
            $slider->status =1;
            $slider->save();
        }
        session()->flash('success','اسلایدر با موفقیت ایجاد شد');
        return redirect(route('sliders.index'));
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
    public function edit(Slider $slider)
    {
        $statuses=[
            '0'=>'عدم نمایش',
            '1'=>' نمایش',
        ];
        return view('admin.sliders.create')
            ->with('slider',$slider)
            ->with('statuses',$statuses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestSlider $request, Slider $slider)
    {
        $slider->update([
           'name'=>$request->name,
            'link'=>$request->link,
           'status'=>$request->status,
        ]);
        if($request->hasFile('image')){
            $this->validate($request,[
               'image'=>['image','mimes:png,jpeg,jpg,gif','max:2000']
            ]);
            Storage::delete($slider->image);
            $slider->image = $request->image->store('sliders');
            $slider->save();
        }
        session()->flash('success','اسلایدر با موفقیت ویرایش شد');
        return redirect(route('sliders.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        Storage::delete($slider->image);
        $slider->delete();
        session()->flash('success','اسلایدر با موفقیت حذف شد');
        return redirect(route('sliders.index'));
    }
}
