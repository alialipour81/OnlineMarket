<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Market\CreateRequestMarket;
use App\Http\Requests\Users\Market\UpdateRequestMarket;
use App\Models\Comment;
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
        $lastcomments= Comment::where('user_id',auth()->user()->id)->where('child',null)->orderBy('id','desc')->limit(5)->get();
        $markets = Market::where('user_id',auth()->user()->id)->orderBy('id','desc')->Paginate(15);
        $countMarkets = Market::where('user_id',auth()->user()->id)->where('status',2)->get();
        return view('users.markets.index')
            ->with('lastcomments',$lastcomments)
            ->with('countMarkets',$countMarkets)
            ->with('markets',$markets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lastcomments= Comment::where('user_id',auth()->user()->id)->where('child',null)->orderBy('id','desc')->limit(5)->get();
        $countMarkets = Market::where('user_id',auth()->user()->id)->where('status',2)->get();
        return view('users.markets.create')
            ->with('lastcomments',$lastcomments)
            ->with('countMarkets',$countMarkets);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequestMarket $request)
    {
        Market::create([
            'user_id'=>auth()->user()->id,
            'name'=>$request->name,
            'description'=>$request->description,
            'image'=>$request->image->store('ImagesMarketUser')
        ]);
        session()->flash('success','فروشگاه با موفقیت ثبت شد منتظر تایید از سوی مدیریت باشید');
        return redirect(route('markets.index'));
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
    public function edit($name)
    {
        $market = Market::where('name',$name)->first();
        $lastcomments= Comment::where('user_id',auth()->user()->id)->where('child',null)->orderBy('id','desc')->limit(5)->get();
        $countMarkets = Market::where('user_id',auth()->user()->id)->where('status',2)->get();
        return view('users.markets.create')
            ->with('lastcomments',$lastcomments)
            ->with('countMarkets',$countMarkets)
            ->with('market',$market);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestMarket $request, Market $market)
    {
        if(empty(Market::where('name',$request->name)->get()->toArray()) && $request->name != $market->name || $request->name == $market->name){
           $market->update([
               'name'=>$request->name,
               'description'=>$request->description,
               'status'=>0
           ]);
           if($request->hasFile('image')){
               $this->validate($request,[
                   'image'=>['image','mimes:png,jpeg,jpg','max:1000']
               ]);
               Storage::delete($market->image);
               $market->image = $request->image->store('ImagesMarketUser');
               $market->save();
           }
            session()->flash('success','فروشگاه با موفقیت ویرایش شد منتظر تایید از سوی مدیریت باشید');
            return redirect(route('markets.index'));


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
    public function destroy(Market $market)
    {
        Storage::delete($market->image);
        $market->delete();
        session()->flash('success','فروشگاه با موفقیت حذف شد');
        return redirect(route('markets.index'));
    }
}
