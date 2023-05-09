@extends('layouts.front')
@section('title','ثبت نام')
@section('content')


<div class="wrapper default">
    <div class="container">
        <div class="row">
            <div class="main-content col-12 col-md-7 col-lg-5 mx-auto">
                <div class="account-box">
                    <div class="account-box-title">ثبت‌نام در آنلاین مارکت</div>

                    <div class="account-box-content">
                        <form class="form-account" method="POST" @if(session()->has('emailWithGoogle')) action="{{ route('googles.register') }}" @else action="{{ route('register') }}" @endif>
                            @csrf
                            <div class="form-account-title"> نام ونام خانوادگی :  </div>
                            <div class="form-account-row">
                                <label class="input-label"><i class="now-ui-icons users_single-02"></i></label>
                                <input class="input-field @error('name') is-invalid @enderror" type="text" placeholder=" نام ونام خانوادگی    خود را وارد نمایید" name="name" value="{{ old('name') }}">
                                @error('name')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            @if(!session()->has('emailWithGoogle'))
                            <div class="form-account-title">   ایمیل :  </div>
                            <div class="form-account-row">
                                <label class="input-label"><i class="now-ui-icons ui-1_email-85"></i></label>
                                <input class="input-field @error('email') is-invalid @enderror" type="email" placeholder="ایمیل  خود را وارد نمایید" name="email" value="{{ old('email') }}">
                                @error('email')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            @endif
                            <div class="form-account-title">کلمه عبور:</div>
                            <div class="form-account-row">
                                <label class="input-label"><i
                                        class="now-ui-icons ui-1_lock-circle-open"></i></label>
                                <input class="input-field @error('password') is-invalid @enderror" type="password" placeholder="کلمه عبور خود را وارد نمایید" name="password">
                                @error('password')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-account-title">تکرار کلمه عبور:</div>
                            <div class="form-account-row">
                                <label class="input-label"><i
                                        class="now-ui-icons ui-1_lock-circle-open"></i></label>
                                <input class="input-field" type="password" placeholder="تکرار کلمه عبور خود را وارد نمایید" name="password_confirmation">
                            </div>

                            <div class="form-account-row form-account-submit">
                                <div class="parent-btn">
                                    <button class="dk-btn dk-btn-info">
                                        ثبت نام در آنلاین مارکت
                                        <i class="now-ui-icons users_circle-08"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="account-box-footer">
                        <span>قبلا در آنلاین مارکت ثبت‌نام کرده‌اید؟</span>
                        <a href="{{ route('login') }}" class="btn-link-border">وارد شوید</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
