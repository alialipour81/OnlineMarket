<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Profile\UpdateRequestProfile;
use App\Models\Comment;


use App\Models\Market;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $comments = Comment::where('user_id',auth()->user()->id)->orderBy('id','desc')->get();
        $lastcomments= Comment::where('user_id',auth()->user()->id)->where('child',null)->orderBy('id','desc')->limit(5)->get();
        $countMarkets = Market::where('user_id',auth()->user()->id)->where('status',2)->get();
        return view('users.profile.index')
            ->with('comments',$comments)
            ->with('countMarkets',$countMarkets)
            ->with('lastcomments',$lastcomments);
    }

    public function update(UpdateRequestProfile $request,User $user)
    {
       $user->update([
          'name'=>$request->name,
          'code_meli'=>$request->code_meli,
          'card'=>$request->card,
           'phone'=>$request->number_phone
       ]);
       session()->flash('success','پروفایل شما با موفقیت بروزرسانی شد');
       return redirect(route('profile.index'));
    }
}
