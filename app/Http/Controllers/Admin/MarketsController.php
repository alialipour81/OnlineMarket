<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Market\UpdateRequestMarket;
use App\Models\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MarketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $markets = Market::orderBy('id','desc')->Paginate(20);
        return view('admin.markets.index')
            ->with('markets',$markets);
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
    public function edit($id)
    {
        $market = Market::where('id',$id)->first();
        $statuses =[
          '0'=>'نامشخص',
          '1'=>'عدم تایید',
          '2'=>' تایید',
        ];
        return view('admin.markets.edit')
            ->with('market',$market)
            ->with('statuses',$statuses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestMarket $request, $id)
    {
        $market = Market::where('id',$id)->first();
        if(empty(Market::where('name',$request->name)->get()->toArray()) && $request->name != $market->name || $request->name == $market->name){
            $market->update([
                'name'=>$request->name,
                'description'=>$request->description,
                'status'=>$request->status
            ]);
            if($request->hasFile('image')){
                $this->validate($request,[
                    'image'=>['image','mimes:png,jpeg,jpg','max:1000']
                ]);
                Storage::delete($market->image);
                $market->image = $request->image->store('ImagesMarketUser');
                $market->save();
            }
            session()->flash('success','فروشگاه با موفقیت ویرایش شد');
            return redirect(route('users-markets.index'));


        }else{
            $this->validate($request,[
                'name'=>['unique:markets,name']
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $market = Market::where('id',$id)->first();
       foreach ($market->products as $product){
           $counter =1;
           while ($counter<5){
               $image='image'.$counter;
               Storage::delete($product->$image);
               $counter++;
           }
           if($product->tags()->count()){
               $product->tags()->detach();
           }
           if($product->markets()->count()){
               $product->markets()->detach();
           }
           $product->delete();
           $counter=1;
       }
        $market->delete();
        Storage::delete($market->image);
        session()->flash('success','فروشگاه با موفقیت حذف شد');
        return redirect(route('users-markets.index'));
    }
}
