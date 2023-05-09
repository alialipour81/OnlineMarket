<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\CreateRequestProduct;
use App\Http\Requests\Admin\Product\UpdateRequestProduct;
use App\Models\Amazing;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id','desc')->Paginate(15);
        return view('admin.products.index')
            ->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id','!=',0)->get();
        $brands = Brand::where('status',1)->get();
        $tags = Tag::all();
        return view('admin.products.create')
            ->with('categories',$categories)
            ->with('tags',$tags)
            ->with('brands',$brands);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequestProduct $request)
    {
        if(!empty($request->takhfif)){
            $this->validate($request,[
                'takhfif'=>['integer'],
            ]);
        }
        if(!empty($request->tags)){
            $this->validate($request,[
                'tags'=>['required']
            ]);
        }

       $product= Product::create([
            'brand_id'=>$request->input('brand_id'),
            'category_id'=>$request->input('category_id'),
            'user_id'=>auth()->user()->id,
            'slug'=>$this->slug($request),
            'title_fa'=>$request->input('title_fa'),
            'title_en'=>$request->input('title_en'),
            'colors'=>$request->input('colors'),
            'gr'=>$request->input('gr'),
            'forosh'=>$request->input('forosh'),
            'price'=>$request->input('price'),
            'image1'=>$request->image1->store('products'),
            'image2'=>$request->image2->store('products'),
            'image3'=>$request->image3->store('products'),
            'image4'=>$request->image4->store('products'),
            'description'=>$request->input('description'),
            'attributes'=>$request->input('attributes')  ,
        ]);
        if(!empty($request->takhfif)){
            $product->takhfif = $request->takhfif;
            $product->save();
        }
        if(!empty($request->tags)){
            $product->tags()->attach($request->tags);
        }
        if(auth()->user()->role == 'admin'){
            $product->status =1;
            $product->save();
        }
        session()->flash('success','محصول با موفقیت ایجاد شد');
        return redirect(route('products.index'));
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
    public function edit(Product $product)
    {
        $categories = Category::where('parent_id','!=',0)->get();
        $brands = Brand::where('status',1)->get();
        $tags = Tag::all();
        $statuses = [
          '0'=>'عدم نمایش',
          '1'=>'نمایش',
        ];
        return view('admin.products.create')
            ->with('categories',$categories)
            ->with('tags',$tags)
            ->with('product',$product)
            ->with('statuses',$statuses)
            ->with('brands',$brands);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestProduct $request, Product $product)
    {
        $product->update([
            'brand_id'=>$request->input('brand_id'),
            'category_id'=>$request->input('category_id'),
            'slug'=>$this->slug($request),
            'title_fa'=>$request->input('title_fa'),
            'title_en'=>$request->input('title_en'),
            'colors'=>$request->input('colors'),
            'gr'=>$request->input('gr'),
            'forosh'=>$request->input('forosh'),
            'price'=>$request->input('price'),
            'takhfif'=>$request->input('takhfif'),
            'description'=>$request->input('description'),
            'attributes'=>$request->input('attributes')  ,
            'status'=>$request->status
        ]);
        if(!empty($request->tags)){
            $product->tags()->sync($request->tags);
        }
        $counter =1;
        while ($counter<5){
            $image='image'.$counter;
            if($request->hasFile($image)){
                $this->validate($request,[
                    $image=>['image','mimes:png,jpeg,jpg','max:1000']
                ]);
                Storage::delete($product->$image);
                $product->$image= $request->$image->store('products');
                $product->save();
            }
            $counter++;
        }
        session()->flash('success','محصول با موفقیت ویرایش شد');
        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $counter =1;
        while ($counter<5){
            $image='image'.$counter;
                Storage::delete($product->$image);
                $counter++;
        }
        $product->tags()->detach();
        $product->delete();
        session()->flash('success','محصول با موفقیت حذف شد');
        return redirect(route('products.index'));

    }

    public function slug($request)
    {
        $ex = explode(' ',$request->title_fa);
        return $slug= implode('-',$ex);
    }
}
