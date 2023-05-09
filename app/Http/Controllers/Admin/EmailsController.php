<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Email\CreateRequestEmail;
use App\Http\Requests\Admin\Email\SendRequestEmail;
use App\Http\Requests\Admin\Email\UpdateRequestEmail;
use App\Mail\SendEmail;
use App\Models\Email;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','admin','verified'])->except('store');
    }
    public function index()
    {
        $emails = Email::orderBy('id','desc')->Paginate(20);
        return view('admin.emails.index')
            ->with('emails',$emails);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.emails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequestEmail $request)
    {
        Email::create([
            'email'=>$request->email
        ]);
        if(auth()->check()){
            if(auth()->user()->role == 'admin'){
                session()->flash('success','کاربر با موفقیت اضافه شد');
                return redirect(route('emails.index'));
            }else{
                session()->flash('success','اخبار ورویداد فروشگاه از این به بعد از طریق ایمیل به شما اطلاع رسانی خواهد شد');
                return redirect(route('index'));
            }
        }else{
            session()->flash('success','اخبار ورویداد فروشگاه از این به بعد از طریق ایمیل به شما اطلاع رسانی خواهد شد');
            return redirect(route('index'));
        }
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
    public function edit(Email $email)
    {
        return view('admin.emails.create',compact('email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Email $email)
    {
        if(!empty(Email::where('email',$email->email)->get()->toArray()) && $email->email != $request->email){
            $this->validate($request,[
               'email'=>['email','unique:emails,email']
            ]);
        }
        $email->update([
           'email'=>$request->email
        ]);
        session()->flash('success','کاربر با موفقیت ویرایش شد');
        return redirect(route('emails.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        $email->delete();
        session()->flash('success','کاربر با موفقیت حذف شد');
        return redirect(route('emails.index'));
    }

    public function page_sendemail()
    {
        $emails = Email::orderBy('id','desc')->get();
       return view('admin.emails.sendemail')
           ->with('emails',$emails);
    }

    public function send_email(SendRequestEmail $request)
    {
        foreach ($request->emails as $email){
            Mail::to($email)->send(new SendEmail($request->name,$request->description));
        }
        session()->flash('success','ایمیل با موفقیت به کاربران ارسال شد');
        return redirect(route('emails.index'));
    }

    public function upload_image(Request $request)
    {
        if($request->hasFile('upload')){
            $image=$request->file('upload')->store('emails');
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url=asset('storage/'.$image);
            $message="تصویر با موفقیت آپلود شد روی ok کلیک کنید و تنظیمات مورد نظر را اعمال کنید";
            $result = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$message')</script>";
            @header('Content-type: text/html; charset=utf-8');
            return $result;
        }
    }

}
