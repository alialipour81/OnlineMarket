<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brand\CreateRequestBrand;
use App\Http\Requests\Admin\Brand\UpdateRequestBrand;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('id','desc')->Paginate(15);
        return view('admin.brands.index')
            ->with('brands',$brands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequestBrand $request)
    {
        $brand = Brand::create([
           'name'=>$request->name,
           'image'=>$request->image->store('brands'),
           'link'=>$request->link
        ]);
        if(auth()->user()->role =="admin"){
            $brand->status =1;
            $brand->save();
        }
        session()->flash('success','برند با موفقیت ایجاد شد');
        return redirect(route('brands.index'));
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
    public function edit(Brand $brand)
    {
        $statuses=[
          '0'=>'عدم تایید مجوز',
          '1'=>'تایید مجوز'
        ];
        return view('admin.brands.create')
            ->with('brand',$brand)
            ->with('statuses',$statuses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestBrand $request, Brand $brand)
    {
        $brand->update([
            'name'=>$request->name,
            'link'=>$request->link,
            'status'=>$request->status
        ]);
        if ($request->hasFile('image')){
            $this->validate($request,[
               'image'=>['max:2000','image','mimes:png,jpeg,jpg,gif']
            ]);
            Storage::delete($brand->image);
            $brand->image = $request->image->store('brands');
            $brand->save();
        }
        session()->flash('success','برند با موفقیت ویرایش شد');
        return redirect(route('brands.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        Storage::delete($brand->image);
        $brand->delete();
        session()->flash('success','برند با موفقیت حذف شد');
        return redirect(route('brands.index'));
    }
}
