<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\CreateRequestProduct;
use App\Http\Requests\Admin\Product\UpdateRequestProduct;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Market;
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
    public function __construct()
    {
        $this->middleware('MarketExistsCheck');
    }
    public function index()
    {
        $products = Product::where('user_id',auth()->user()->id)->orderBy('id','desc')->Paginate(15);
        $lastcomments= Comment::where('user_id',auth()->user()->id)->where('child',null)->orderBy('id','desc')->limit(5)->get();
        $countMarkets = Market::where('user_id',auth()->user()->id)->where('status',2)->get();
        return view('users.products.index')
            ->with('products',$products)
            ->with('countMarkets',$countMarkets)
            ->with('lastcomments',$lastcomments);
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
        $lastcomments= Comment::where('user_id',auth()->user()->id)->where('child',null)->orderBy('id','desc')->limit(5)->get();
        $countMarkets = Market::where('user_id',auth()->user()->id)->where('status',2)->get();
        return view('users.products.create')
            ->with('categories',$categories)
            ->with('tags',$tags)
            ->with('brands',$brands)
            ->with('countMarkets',$countMarkets)
            ->with('lastcomments',$lastcomments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequestProduct $request)
    {
        if(empty($request->market_id)){
            $this->validate($request,[
                'market_id'=>['required','integer']
            ]);
        }
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
            'price'=>$request->input('price'),
            'forosh'=>$request->input('forosh'),
            'image1'=>$request->image1->store('user_products'),
            'image2'=>$request->image2->store('user_products'),
            'image3'=>$request->image3->store('user_products'),
            'image4'=>$request->image4->store('user_products'),
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
        if(!empty($request->market_id)){
            $product->markets()->attach($request->market_id);
        }
        $productBymarketid = $product->markets->toArray();
        $product->forosh = $productBymarketid[0]['id'];
        $product->save();

        session()->flash('success',' محصول با موفقیت ایجاد شد پس از تایید مدیریت در فروشگاه قرار میگیرد');
        return redirect(route('user-products.index'));
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
    public function edit($title_fa)
    {
        $product = Product::where('title_fa',$title_fa)->first();
        $categories = Category::where('parent_id','!=',0)->get();
        $brands = Brand::where('status',1)->get();
        $tags = Tag::all();
        $lastcomments= Comment::where('user_id',auth()->user()->id)->where('child',null)->orderBy('id','desc')->limit(5)->get();
        $countMarkets = Market::where('user_id',auth()->user()->id)->where('status',2)->get();
        return view('users.products.create')
            ->with('categories',$categories)
            ->with('tags',$tags)
            ->with('product',$product)
            ->with('brands',$brands)
            ->with('countMarkets',$countMarkets)
            ->with('lastcomments',$lastcomments);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestProduct $request, $title_fa)
    {
        if(empty($request->market_id)){
            $this->validate($request,[
                'market_id'=>['required','integer']
            ]);
        }
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
        $product = Product::where('title_fa',$title_fa)->first();
        $product->update([
            'brand_id'=>$request->input('brand_id'),
            'category_id'=>$request->input('category_id'),
            'slug'=>$this->slug($request),
            'title_fa'=>$request->input('title_fa'),
            'title_en'=>$request->input('title_en'),
            'colors'=>$request->input('colors'),
            'gr'=>$request->input('gr'),
            'price'=>$request->input('price'),
            'takhfif'=>$request->input('takhfif'),
            'description'=>$request->input('description'),
            'attributes'=>$request->input('attributes')  ,
            'status'=>0
        ]);


        if(!empty($request->tags)){
            $product->tags()->sync($request->tags);
        }
        if(!empty($request->market_id)){
            $product->markets()->sync($request->market_id);
        }
        $counter =1;
        while ($counter<5){
            $image='image'.$counter;
            if($request->hasFile($image)){
                $this->validate($request,[
                    $image=>['image','mimes:png,jpeg,jpg','max:1000']
                ]);
                Storage::delete($product->$image);
                $product->$image= $request->$image->store('user_products');
                $product->save();
            }
            $counter++;
        }

        $productBymarketid = $product->markets->toArray();
        $product->forosh = $productBymarketid[0]['name'];
        $product->save();

        session()->flash('success','محصول با موفقیت ویرایش شد');
        return redirect(route('user-products.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($title_fa)
    {
        $product = Product::where('title_fa',$title_fa)->first();
        $counter =1;
        while ($counter<5){
            $image='image'.$counter;
            Storage::delete($product->$image);
            $counter++;
        }
        $product->tags()->detach();
        $product->delete();
        session()->flash('success','محصول با موفقیت حذف شد');
        return redirect(route('user-products.index'));
    }
    public function slug($request)
    {
        $ex = explode(' ',$request->title_fa);
        return $slug= implode('-',$ex);
    }
}
