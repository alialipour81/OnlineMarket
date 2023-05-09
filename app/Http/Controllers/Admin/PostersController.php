<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Poster\CreateRequestPoster;
use App\Http\Requests\Admin\Poster\UpdateRequestPoster;
use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posters = Poster::orderBy('id','desc')->Paginate(15);
        return view('admin.posters.index')
            ->with('posters',$posters);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequestPoster $request)
    {
        Poster::create([
           'name'=>$request->name,
            'image'=>$request->image->store('posters'),
            'link'=>$request->link
        ]);
        session()->flash('success','پوستر با موفقیت ایجاد شد');
        return redirect(route('posters.index'));
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
    public function edit(Poster $poster)
    {
        return view('admin.posters.create')
            ->with('poster',$poster);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestPoster $request, Poster $poster)
    {
        if($request->hasFile('image')){
            $this->validate($request,[
               'image'=>['image','mimes:png,jpeg,jpg,gif','max:2000']
            ]);
            Storage::delete($poster->image);
            $poster->image = $request->image->store('posters');
            $poster->save();
        }
        $poster->update([
            'name'=>$request->name,
            'link'=>$request->link
        ]);
        session()->flash('success','پوستر با موفقیت ویرایش شد');
        return redirect(route('posters.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poster $poster)
    {
        Storage::delete($poster->image);
        $poster->delete();
        session()->flash('success','پوستر با موفقیت حذف شد');
        return redirect(route('posters.index'));
    }
}
