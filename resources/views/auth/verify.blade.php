@extends('layouts.front')
@section('title','تایید ایمیل ')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 mr-5 mt-4">
            <div class="card">
                <div class="card-header">تایید ایمیل </div>

                <div class="card-body shadow">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            لینک تایید با موفقیت ارسال شد
                        </div>
                    @endif

                        {{auth()->user()->name}} عزیز برای دسترسی به پنل خود ابتدا لازم است ایمیل ثبت شده خودتان را تایید کنید
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-success p-1 mt-2 p-0 m-0 align-baseline d-block">ارسال لینک تایید ایمیل</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
