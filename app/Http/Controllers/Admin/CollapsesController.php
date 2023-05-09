<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Collapse\CreateRequestCollapse;
use App\Http\Requests\Admin\Collapse\UpdateRequestCollapse;
use App\Models\Collapse;
use App\Models\Product;
use Illuminate\Http\Request;

class CollapsesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function index2(Product $product)
    {
        session()->put('product_id',$product->id);
        $collapses = Collapse::where('product_id',$product->id)->orderBy('id','desc')->Paginate(15);
        return view('admin.collapses.index')
            ->with('product',$product)
            ->with('collapses',$collapses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.collapses.create');
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
             'product_id'=>session()->get('product_id'),
             'name'=>$request->name,
             'description'=>$request->description
         ]);
         if(auth()->user()->role == 'admin'){
             $collapse->status=1;
             $collapse->save();
         }
         session()->flash('success','باکس برای این محصول با موفقیت ایجادشد');
         return redirect(route('collapses.index2',session()->get('product_id')));
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
    public function edit(Collapse $collapse)
    {
        $statuses=[
          '0'=>'عدم نمایش',
          '1'=>'نمایش',
        ];
        return view('admin.collapses.create')
            ->with('statuses',$statuses)
            ->with('collapse',$collapse);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestCollapse $request, Collapse $collapse)
    {
        $collapse->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'status'=>$request->status
        ]);
        session()->flash('success','باکس برای این محصول با موفقیت ویرایش شد');
        return redirect(route('collapses.index2',session()->get('product_id')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collapse $collapse)
    {
        $collapse->delete();
        session()->flash('success','باکس  این محصول با موفقیت حذف شد');
        return redirect(route('collapses.index2',session()->get('product_id')));
    }

    public function upload(Request $request)
    {
     if($request->hasFile('upload')){
         $image=$request->file('upload')->store('boxCollapseProduct');
         $CKEditorFuncNum = $request->input('CKEditorFuncNum');
         $url=asset('storage/'.$image);
         $message="تصویر با موفقیت آپلود شد روی ok کلیک کنید و تنظیمات مورد نظر را اعمال کنید";
         $result = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$message')</script>";
         @header('Content-type: text/html; charset=utf-8');
         return $result;
     }

    }
}
