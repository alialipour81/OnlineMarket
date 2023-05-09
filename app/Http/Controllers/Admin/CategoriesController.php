<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CreateRequestCategory;
use App\Http\Requests\Admin\Category\UpdateRequestCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('parent_id',0)->orderBy('id','desc')->Paginate(15);
        return view('admin.categories.index')
            ->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id',0)->orderBy('id','desc')->get();
        return view('admin.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequestCategory $request)
    {
        Category::create([
           'name'=>$request->name,
           'parent_id'=>$request->parent_id
        ]);
        session()->flash('success','دسته بندی با موفقیت ایجاد شد');
        return redirect(route('categories.index'));
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
    public function edit(Category $category)
    {
        $categories = Category::where('parent_id',0)->orderBy('id','desc')->get();
        return view('admin.categories.create',compact('categories','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestCategory $request, Category $category)
    {
        if(!empty(Category::where('name',$request->name)->get()->toArray()) && $request->name != $category->name){
            $this->validate($request,[
                'name'=>['unique:categories,name']
            ]);
        }
        $category->update([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id
        ]);
        session()->flash('success','دسته بندی با موفقیت ویرایش شد');
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->parents()->count()){
            session()->flash('error','این دسته بندی اصلی است برای حذف این دسته بندی ابتدا زیر دسته بندی هایش را حذف کنید');
        }else{
            $category->delete();
            session()->flash('success','دسته بندی با موفقیت حذف شد');
        }
        return redirect(route('categories.index'));
    }
}
