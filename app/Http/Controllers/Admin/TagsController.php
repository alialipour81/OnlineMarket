<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\CreateRequestTag;
use App\Http\Requests\Admin\Tag\UpdateRequestTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags= Tag::orderBy('id','desc')->Paginate(15);
        return view('admin.tags.index')
            ->with('tags',$tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequestTag $request)
    {
        Tag::create([
           'name'=>$request->name
        ]);
        session()->flash('success','برچسپ با موفقیت ایجاد شد');
        return redirect(route('tags.index'));
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
    public function edit(Tag $tag)
    {
        return view('admin.tags.create')
            ->with('tag',$tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestTag $request, Tag $tag)
    {
        if(!empty(Tag::where('name',$request->name)->get()->toArray()) && $request->name != $tag->name){
            $this->validate($request,[
                'name'=>['unique:tags,name']
            ]);
        }
        $tag->update([
           'name'=>$request->name
        ]);
        session()->flash('success','برچسپ با موفقیت ویرایش شد');
        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
         $tag->delete();
        session()->flash('success','برچسپ با موفقیت حذف شد');
        return redirect(route('tags.index'));
    }
}
