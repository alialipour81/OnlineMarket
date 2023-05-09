@extends('layouts.admin.front')
@section('title','ایجاد یا ویرایش  برچسپ')
@section('content')
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1">
                @isset($tag)
                    ویرایش برچسپ
                @else
                    ایجاد برچسپ
                @endisset
            </span>
        </div>
    <div class="card-body">
        <form action="{{ isset($tag) ? route('tags.update',$tag->id) : route('tags.store') }}" method="post">
            @csrf
            @isset($tag)
                @method('PUT')
            @endisset
            <div class="form-group mb-3">
                <label for="1" class="mb-1">نام  برچسپ را وارد کنید:</label>
                <input type="text" id="1" class="form-control @error('name') is-invalid @enderror" placeholder="نام برچسپ   را وارد کنید" name="name" value="{{ isset($tag) ? $tag->name : old('name') }}">
                @error('name')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <button class="btn btn-danger btn-sm">
                    @isset($tag)
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
