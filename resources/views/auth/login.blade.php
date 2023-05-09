@extends('layouts.front')
@section('title','ورود به حساب کاربری')
@section('content')
<div class="wrapper default">
    <div class="container">
        <div class="row">
            <div class="main-content col-12 col-md-7 col-lg-5 mx-auto">
                <div class="account-box">

                    <div class="account-box-title text-right">ورود به آنلاین مارکت</div>
                    <div class="account-box-content">
                        <form class="form-account" action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-account-title">ایمیل:   </div>
                            <div class="form-account-row">
                                <label class="input-label"><i class="now-ui-icons users_single-02"></i></label>
                                <input class="input-field @error('email') is-invalid @enderror" type="email" placeholder="ایمیل    خود را وارد نمایید" name="email" value="{{ old('email') }}">
                                @error('email')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-account-title">رمز عبور:
                                <a href="{{route('password.request')}}" class="btn-link-border form-account-link">رمز
                                    عبور خود را فراموش
                                    کرده ام</a>
                            </div>
                            <div class="form-account-row">
                                <label class="input-label"><i
                                        class="now-ui-icons ui-1_lock-circle-open"></i></label>
                                <input class="input-field @error('password') is-invalid @enderror" type="password" name="password" placeholder="رمز عبور خود را وارد نمایید">
                                @error('password')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-account-agree">
                                <label class="checkbox-form checkbox-primary">
                                    <input type="checkbox" checked="checked" id="agree" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="checkbox-check"></span>
                                </label>
                                <label for="agree">مرا به خاطر داشته باش</label>
                            </div>
                            <div class="form-account-row form-account-submit">
                                <div class="parent-btn">
                                    <button class="dk-btn dk-btn-info">
                                        ورود به آنلاین مارکت
                                        <i class="fa fa-sign-in"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <a href="{{ route('googles.next') }}">
                            <div class="form-account-row form-account-submit">
                                <div class="parent-btn">
                                    <button class="dk-btn dk-btn-danger">
                                         ورود با گوگل
                                        <i class="fa fa-google"></i>
                                    </button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="account-box-footer">
                        <span>کاربر جدید هستید؟</span>
                        <a href="{{ route('register') }}" class="btn-link-border">ثبت‌نام در
                            آنلاین مارکت</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
