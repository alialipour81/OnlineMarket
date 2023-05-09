@extends('layouts.admin.front')
@section('title','ایجاد یا ویرایش  پوستر')
@section('content')
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1">
                @isset($poster)
                    ویرایش پوستر
                @else
                    ایجاد پوستر
                @endisset
            </span>
        </div>
    <div class="card-body">
        <form action="{{ isset($poster) ? route('posters.update',$poster->id) : route('posters.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @isset($poster)
                @method('PUT')
            @endisset
            <div class="form-group mb-3">
                <label for="1" class="mb-1">نام  پوستر را وارد کنید:</label>
                <input type="text" id="1" class="form-control @error('name') is-invalid @enderror" placeholder="نام پوستر   را وارد کنید" name="name" value="{{ isset($poster) ? $poster->name : old('name') }}">
                @error('name')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="2" class="mb-1">تصویر  پوستر را انتخاب کنید:</label>
                <input type="file" id="2" class="form-control @error('image') is-invalid @enderror"  name="image" >
                @error('image')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            @isset($poster)
                <div class="mt-2 mb-2">
                    <img src="{{ asset('storage/'.$poster->image) }}" width="100%" height="100%" class="rounded shadow">
                </div>
            @endisset
            <div class="form-group mb-3">
                <label for="1" class="mb-1">لینک  پوستر را وارد کنید:</label>
                <input type="text" id="1" class="form-control @error('link') is-invalid @enderror" placeholder="لینک پوستر   را وارد کنید" name="link" value="{{ isset($poster) ? $poster->link : old('link') }}">
                @error('link')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <button class="btn btn-danger btn-sm">
                    @isset($poster)
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
