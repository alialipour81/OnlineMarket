<?php

namespace App\Http\Middleware;

use App\Models\Product;
use Closure;
use Illuminate\Http\Request;

class userCollapses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       if(session()->has('product_id_user')){
           $product = Product::where('id',session()->get('product_id_user'))->first();
           if($product->status == 0){
               session()->flash('error','برای دسترسی به تنظیمات باکس های این محصول ابتدا نیاز است محصول تایید شود');
               return redirect(route('user-collapses.index2',session()->get('product_slug_user')));
           }
       }
        return $next($request);
    }
}
