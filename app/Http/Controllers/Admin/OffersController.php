<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Offer\CreateRequestOffer;
use App\Http\Requests\Admin\Offer\UpdateRequestOffer;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::orderBy('id','desc')->Paginate(20);
        return view('admin.offers.index',compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('status',1)->orderBy('id','desc')->get();
        return view('admin.offers.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequestOffer $request)
    {
        Offer::create([
            'product_id'=>$request->product_id
        ]);
        session()->flash('success','محصول با موفقیت به پیشنهادات لحظه ای اضافه شد');
        return redirect(route('offers.index'));
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
    public function edit(Offer $offer)
    {
        $products = Product::where('status',1)->orderBy('id','desc')->get();
        $statuses=[
          '0'=>'عدم نمایش',
          '1'=>'نمایش'
        ];
        return view('admin.offers.create',compact('products','offer','statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestOffer $request, Offer $offer)
    {
        $offer->update([
           'product_id'=>$request->product_id,
           'status'=>$request->status
        ]);
        session()->flash('success','محصول موردنظر با موفقیت  ویرایش شد');
        return redirect(route('offers.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();
        session()->flash('success',' محصول موردنظر با موفقیت  حذف شد');
        return redirect(route('offers.index'));
    }
}
