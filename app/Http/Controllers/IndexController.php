<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Comment\CreateRequestComment;
use App\Http\Requests\Admin\Comment\ReplyRequestComment;
use App\Http\Requests\Users\Discount\CheckRequestDiscount;
use App\Models\Amazing;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Discount;
use App\Models\Favourite;
use App\Models\Market;
use App\Models\Offer;
use App\Models\Poster;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
class IndexController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id',0)->get();
        $posters = Poster::all();
        $sliders = Slider::where('status',1)->orderBy('id','desc')->get();
        $products = Product::where('status',1)->orderBy('id','desc')->limit(7)->get();
        $randoms = Product::inRandomOrder()->where('status',1)->limit(7)->get();
        $brands = Brand::where('status',1)->orderBy('id','desc')->limit(5)->get();
        $amazings = Amazing::where('status',1)->where('date',Carbon::today())->orderBy('id','desc')->get();
        $offers = Offer::where('status',1)->orderBy('id','desc')->get();
        $items = \Cart::getContent();
       return view('fronts.index')
           ->with('categories',$categories)
           ->with('sliders',$sliders)
           ->with('products',$products)
           ->with('randoms',$randoms)
           ->with('brands',$brands)
           ->with('offers',$offers)
           ->with('amazings',$amazings)
           ->with('posters',$posters)
           ->with('items',$items);
    }

    public function product($slug)
    {
        $product = Product::where('slug',$slug)->first();
        $categories = Category::where('parent_id',0)->get();
        if(!empty(auth()->user()->id))
            $favourite = Favourite::where('user_id',auth()->user()->id)->where('product_id',$product->id)->first();
        else
            $favourite =null;


        $shareComponent = \Share::page(
             route('fronts.product',$product->slug),
            $product->title_fa.'در فروشگاه آنلاین مارکت مشاهده کنید',
        )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp()
            ->reddit();

        $items = \Cart::getContent();
        return view('fronts.product')
            ->with('categories',$categories)
            ->with('product',$product)
            ->with('favourite',$favourite)
            ->with('shareComponent',$shareComponent)
            ->with('items',$items);
    }

    public function comment(CreateRequestComment $request)
    {
         $comment = Comment::create([
             'product_id'=>$request->product_id,
             'user_id'=>auth()->user()->id,
             'content'=>$request->content,
         ]);
         if(auth()->user()->role =='admin'){
             $comment->status = 1;
             $comment->save();
         }
         session()->flash('success','نظر شما با موفقیت ثبت شد منتظر تایید از سوی مدیریت باشید');
         return back();
    }

    public function reply(ReplyRequestComment $request,Comment $comment)
    {
         Comment::create([
            'product_id'=>$comment->product_id,
            'user_id'=>auth()->user()->id,
            'content'=>$request->content,
            'child'=>$comment->id,
             'status'=>1
        ]);
        if(auth()->user()->role =='admin'){
            $comment->status=1;
            $comment->save();
        }
        session()->flash('success','پاسخ با موفقیت ثبت شد');
        return redirect(route('comments.index'));
    }

    public function category($name)
    {
        $category = Category::where('name',$name)->first();
        $categories = Category::where('parent_id',0)->get();
        $items = \Cart::getContent();
        return view('fronts.category')
            ->with('categories',$categories)
            ->with('category',$category)
            ->with('items',$items);
    }

    public function products()
    {
        $categories = Category::where('parent_id',0)->get();
        $products = Product::searched()->where('status',1)->orderBy('id','desc')->Paginate(16);
        $items = \Cart::getContent();
        return view('fronts.products')
            ->with('categories',$categories)
            ->with('products',$products)
            ->with('items',$items);
    }

    public function tag($name)
    {
        $categories = Category::where('parent_id',0)->get();
        $tag = Tag::where('name',$name)->first();
        $items = \Cart::getContent();
        return view('fronts.tag')
            ->with('categories',$categories)
            ->with('tag',$tag)
            ->with('items',$items);
    }

    public function cart()
    {

        $categories = Category::where('parent_id',0)->get();
        $items = \Cart::getContent();
        return view('fronts.cart')
            ->with('categories',$categories)
            ->with('items',$items);

    }

    public function checkDiscount(CheckRequestDiscount $request)
    {
        $discount = Discount::where('name',$request->code)->where('user_id',auth()->user()->id)->first();
        if($discount && $discount->status==1){
      if(Carbon::today()->format('Y-m-d') >= $discount->date){
          if($discount->use == 'true'){
              session()->flash('error',' این کد تخفیف  قبلا استفاده شده است');
          }else{
              session()->put('discount',$discount->price);
              session()->flash('success','تخفیف با موفقیت اعمال شد');
              $discount->use = 'true';
              $discount->save();
          }
      }else{
          session()->flash('error',' این کد تخفیف منقضی شده است');
      }
        }else{
            session()->flash('error',' کد تخفیف نامعتبر است');
        }
        return redirect(route('carts.continue'));
    }

    public function market($name)
    {
        $categories = Category::where('parent_id',0)->get();
        $items = \Cart::getContent();
        $market = Market::where('name',$name)->first();
        if(empty($market)){
            $market = Product::where('forosh',$name)->first();
            $products = Product::searched()->where('forosh',$name)->Paginate(16);
        }else{
            $products = Product::searched()->where('forosh',$market->name)->Paginate(16);
        }


        if(array_key_exists('name',$market->toArray()))
           $name = $market->name;
        else
            $name = $market->forosh;

        return view('fronts.market',compact('categories','name','items','products'));

    }
}
