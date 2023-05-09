<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdateRequestUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id','desc')->Paginate(20);
        return view('admin.users.index')
            ->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(User $user)
    {
        $statuses= [
          'user'=>'کاربر',
          'admin'=>'ادمین',
        ];
        return view('admin.users.edit')
            ->with('user',$user)
            ->with('statuses',$statuses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestUser $request, User $user)
    {
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'role'=>$request->role,
            'code_meli'=>$request->code_meli,
            'card'=>$request->card,
            'phone'=>$request->number_phone
        ]);
        if(!empty($request->newpassword)){
            $this->validate($request,[
               'newpassword'=>['min:8']
            ]);
            $user->password = Hash::make($request->newpassword);
            $user->save();
        }
        session()->flash('success','کاربر با موفقیت ویرایش شد');
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->comments()->detach();
        $user->products()->detach();
        $user->delete();
        session()->flash('success','کاربر با موفقیت حذف شد');
        return redirect(route('users.index'));
    }
}
