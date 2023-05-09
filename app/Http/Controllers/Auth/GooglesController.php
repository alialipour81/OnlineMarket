<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Google\CreateRequestGoogle;
use App\Mail\welcome;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class GooglesController extends Controller
{
    public function next()
    {
      return  Socialite::driver('google')->redirect();
    }

    public function handle()
    {
        $info_user = Socialite::driver('google')->user();
        $user = User::where('email',$info_user->getEmail())->first();

        if($user){
            Auth::loginUsingId($user->id);
            session()->flash('success','ورود شما موفقیت آمیز بود');
           return redirect(route('index'));
        }else{
            session()->put('emailWithGoogle',$info_user->getEmail());
            return redirect(route('register'));
        }
    }

    public function register(CreateRequestGoogle $request)
    {
           $user = User::create([
              'name'=>$request->name,
              'email'=>session()->get('emailWithGoogle'),
              'email_verified_at'=>now(),
              'password'=>Hash::make($request->password)
           ]);
           Auth::loginUsingId($user->id);
           Mail::to(session()->get('emailWithGoogle'))->send(new welcome($request->name,'خوش امد گویی'));
           session()->forget('emailWithGoogle');
           session()->flash('success','ثبت نام شما با موفقیت انجام شد');
           return redirect(route('index'));

    }
}
