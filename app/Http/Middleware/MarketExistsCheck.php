<?php

namespace App\Http\Middleware;

use App\Models\Market;
use Closure;
use Illuminate\Http\Request;

class MarketExistsCheck
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
        $countMarkets = Market::where('user_id',auth()->user()->id)->where('status',2)->get();
        if(!$countMarkets->count()){
            session()->flash('error','برای دسترسی به این بخش باید حداقل یک فروشگاه شما تایید شود');
            return redirect(route('dashboard.index'));
        }
        return $next($request);
    }
}
