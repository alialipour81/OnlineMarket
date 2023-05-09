@extends('layouts.admin.front')
@section('title','ایجاد یا ویرایش  ایمیل')
@section('content')
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1">
                @isset($email)
                    ویرایش  ایمیل
                @else
                    ایجاد ایمیل
                @endisset
            </span>
        </div>
    <div class="card-body">
        <form action="{{ isset($email) ? route('emails.update',$email->id) : route('emails.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @isset($email)
                @method('PUT')
            @endisset
            <div class="form-group mb-3">
                <label for="2" class="mb-1">  ایمیل:</label>
                <input type="text" class="form-control" id="2" name="email" value="{{ isset($email) ? $email->email : old('email') }}">
                @error('email')
                <span class="text-danger small">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <button class="btn btn-danger btn-sm">
                    @isset($email)
                        ویرایش
                    @else
                        ایجاد
                    @endisset
                </button>
            </div>
        </form>
    </div>
    </div>
@endsection
