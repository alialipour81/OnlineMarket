<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Collapse\CreateRequestCollapse;
use App\Http\Requests\Admin\Collapse\UpdateRequestCollapse;
use App\Models\Collapse;
use App\Models\Comment;
use App\Models\Market;
use App\Models\Product;
use Illuminate\Http\Request;

class CollapsesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('MarketExistsCheck');
        $this->middleware('UserCollapses')->except('index2');
    }
    public function index()
    {

    }
    public function index2($slug)
    {
        $product = Product::where('slug',$slug)->first();
        session()->put('product_id_user',$product->id);
        session()->put('product_slug_user',$product->slug);
        $collapses = Collapse::where('product_id',$product->id)->orderBy('id','desc')->Paginate(16);
        $lastcomments= Comment::where('user_id',auth()->user()->id)->where('child',null)->orderBy('id','desc')->limit(5)->get();
        $countMarkets = Market::where('user_id',auth()->user()->id)->where('status',2)->get();
        return view('users.collapses.index',compact('collapses','product','lastcomments','countMarkets'));
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
        return view('users.collapses.create',compact('lastcomments','countMarkets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequestCollapse $request)
    {
        $collapse = Collapse::create([
            'product_id'=>session()->get('product_id_user'),
            'name'=>$request->name,
            'description'=>$request->description
        ]);
        session()->flash('success','باکس برای این محصول با موفقیت ایجادشد');
        return redirect(route('user-collapses.index2',session()->get('product_slug_user')));
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
        $collapse = Collapse::where('id',$id)->first();
        $lastcomments= Comment::where('user_id',auth()->user()->id)->where('child',null)->orderBy('id','desc')->limit(5)->get();
        $countMarkets = Market::where('user_id',auth()->user()->id)->where('status',2)->get();
        return view('users.collapses.create',compact('lastcomments','countMarkets','collapse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestCollapse $request, $id)
    {
        $collapse = Collapse::where('id',$id)->first();
        $collapse->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'status'=>0
        ]);
        session()->flash('success','باکس برای این محصول با موفقیت ویرایش شد');
        return redirect(route('user-collapses.index2',session()->get('product_slug_user')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collapse = Collapse::where('id',$id)->first();
        $collapse->delete();
        session()->flash('success','باکس برای این محصول با موفقیت حذف شد');
        return redirect(route('user-collapses.index2',session()->get('product_slug_user')));
    }
}
