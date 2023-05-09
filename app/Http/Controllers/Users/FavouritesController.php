<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Favourite\CreateRequestFavourite;
use App\Models\Category;
use App\Models\Favourite;
use Illuminate\Http\Request;

class FavouritesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $favourites = Favourite::where('user_id',auth()->user()->id)->orderBy('id','desc')->get();
        $categories = Category::where('parent_id',0)->get();
        $items = \Cart::getContent();
        return view('users.favourites.index',compact('favourites','categories','items'));
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
    public function store(CreateRequestFavourite $request)
    {
            Favourite::create([
                'product_id'=>$request->product_id,
                'user_id'=>auth()->user()->id
            ]);
            session()->flash('success','محصول با موفقیت به علاقه مندی ها اضافه شد');
        return back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favourite $favourite)
    {
        $favourite->delete();
        session()->flash('success','محصول با موفقیت از علاقه مندی ها حذف شد');
        return back();
    }
}
