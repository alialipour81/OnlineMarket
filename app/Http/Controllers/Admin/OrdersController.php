<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\UpdateRequestOrder;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::searchorder()->orderBy('id','desc')->Paginate(20);
        return view('admin.orders.index')
            ->with('orders',$orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Order $order)
    {
        $users = User::orderBy('id','desc')->get();
        $products = Product::where('status',1)->orderBy('id','desc')->get();
        $statuses=[
          '0'=>'در حال بررسی',
          '1'=>'آماده سازی برای ارسال',
          '2'=>'ارسال شده',
        ];
        return view('admin.orders.edit')
            ->with('users',$users)
            ->with('statuses',$statuses)
            ->with('products',$products)
            ->with('order',$order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestOrder $request, Order $order)
    {
        $order->update([
           'product_id'=>$request->product_id,
           'user_id'=>$request->user_id,
            'color'=>$request->color,
            'status'=>$request->status,
            'quantity'=>$request->quantity
        ]);

        session()->flash('success','سفارش با موفقیت ویرایش شد');
        return redirect(route('orders.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        session()->flash('success','سفارش با موفقیت حذف شد');
        return redirect(route('orders.index'));
    }
}
