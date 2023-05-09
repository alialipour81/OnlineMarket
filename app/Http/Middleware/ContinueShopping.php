<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContinueShopping
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
        $items = \Cart::getContent();
        if(!$items->count()){
            return redirect(route('fronts.cart'));
        }
        return $next($request);
    }
}
