<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Discount\CreateRequestDiscount;
use App\Http\Requests\Admin\Discount\UpdateRequestDiscount;
use App\Models\Discount;
use App\Models\User;
use Illuminate\Http\Request;
use Hekmatinasser\Verta\Verta;

class DiscountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::orderBy('id','desc')->Paginate(15);
        return view('admin.discounts.index')
            ->with('discounts',$discounts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('id','desc')->get();
        return view('admin.discounts.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequestDiscount $request)
    {
        Discount::create([
            'name' => $request->name,
            'price' => $request->price,
            'user_id' => $request->user_id,
            'date' => $request->date,
        ]);
        session()->flash('success','تخفیف با موفقیت ایجاد شد');
        return redirect(route('discounts.index'));
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
    public function edit(Discount $discount)
    {
        $statuses =[
            '0'=>'غیرفعال',
            '1'=>'فعال',
        ];
        $users = User::orderBy('id','desc')->get();
        return view('admin.discounts.create',compact('users','discount','statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestDiscount $request, Discount $discount)
    {
        if(!empty(Discount::where('name',$request->name)->get()->toArray()) && $discount->name!= $request->name){
          $this->validate($request,[
             'name'=>['unique:discounts,name']
          ]);
        }else{
            $discount->update([
                'name' => $request->name,
                'price' => $request->price,
                'user_id' => $request->user_id,
                'date' => $request->date,
                'status'=>$request->status
            ]);
            session()->flash('success','تخفیف با موفقیت ویرایش شد');
            return redirect(route('discounts.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();
        session()->flash('success','تخفیف با موفقیت حذف شد');
        return redirect(route('discounts.index'));
    }

}
