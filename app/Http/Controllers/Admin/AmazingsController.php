<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Amazing\CreateRequestAmazing;
use App\Http\Requests\Admin\Amazing\UpdateRequestAmazing;
use App\Models\Amazing;
use App\Models\Product;
use Illuminate\Http\Request;
use Hekmatinasser\Verta\Verta;
class AmazingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $amazings = Amazing::orderBy('id','desc')->Paginate(15);
        return view('admin.amazings.index',['amazings'=>$amazings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('status',1)->orderBy('id','desc')->get();
        return view('admin.amazings.create')
            ->with('products',$products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequestAmazing $request)
    {
          Amazing::create([
              'product_id'=>$request->product_id,
              'status'=>1,
              'date'=>$request->date
          ]);
          session()->flash('success','محصول با موفقیت اضافه شد');
          return redirect(route('amazings.index'));

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
    public function edit(Amazing $amazing)
    {
        $products = Product::where('status',1)->orderBy('id','desc')->get();
        $statuses =[
          '0'=>'عدم نمایش',
          '1'=>'نمایش',
        ];
        return view('admin.amazings.create')
            ->with('products',$products)
            ->with('statuses',$statuses)
            ->with('amazing',$amazing);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestAmazing $request, Amazing $amazing)
    {
        $amazing->update([
            'product_id'=>$request->product_id,
            'status'=>$request->status,
            'date'=>$request->date
        ]);
        session()->flash('success','محصول با موفقیت ویرایش شد');
        return redirect(route('amazings.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Amazing $amazing)
    {
        $amazing->delete();
        session()->flash('success','محصول با موفقیت حذف شد');
        return redirect(route('amazings.index'));
    }
}
