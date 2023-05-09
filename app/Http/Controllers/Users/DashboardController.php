<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Comment;
use App\Models\Market;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $lastcomments= Comment::where('user_id',auth()->user()->id)->where('child',null)->orderBy('id','desc')->limit(5)->get();
        $comments = Comment::where('user_id',auth()->user()->id)->get();
        $chats = Chat::where('status',1)->orderBy('id','desc')->get();
        $lastchats = Chat::where('status',1)->orderBy('id','desc')->limit(5)->get();
        $countMarkets = Market::where('user_id',auth()->user()->id)->where('status',2)->get();
        $orders = Order::where('user_id',auth()->user()->id)->get();
        return view('users.fronts.index')
            ->with('lastcomments',$lastcomments)
            ->with('chats',$chats)
            ->with('orders',$orders)
            ->with('comments',$comments)
            ->with('countMarkets',$countMarkets)
            ->with('lastchats',$lastchats);
    }
}
