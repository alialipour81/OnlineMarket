@extends('layouts.admin.front')
@section('title','ایجاد یا ویرایش  اسلایدر')
@section('content')
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1">
                @isset($slider)
                    ویرایش اسلایدر
                @else
                    ایجاد اسلایدر
                @endisset
            </span>
        </div>
    <div class="card-body">
        <form action="{{ isset($slider) ? route('sliders.update',$slider->id) : route('sliders.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @isset($slider)
                @method('PUT')
            @endisset
            <div class="form-group mb-3">
                <label for="1" class="mb-1">نام  اسلایدر را وارد کنید:</label>
                <input type="text" id="1" class="form-control @error('name') is-invalid @enderror" placeholder="نام اسلایدر   را وارد کنید" name="name" value="{{ isset($slider) ? $slider->name : old('name') }}">
                @error('name')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="2" class="mb-1">تصویر  اسلایدر را انتخاب کنید:</label>
                <input type="file" id="2" class="form-control @error('image') is-invalid @enderror"  name="image" >
                @error('image')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="1" class="mb-1">لینک  اسلایدر را وارد کنید:</label>
                <input type="text" id="1" class="form-control @error('link') is-invalid @enderror" placeholder="لینک اسلایدر   را وارد کنید" name="link" value="{{ isset($slider) ? $slider->link : old('link') }}">
                @error('link')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            @isset($slider)
                <div class="mt-2 mb-2">
                    <img src="{{ asset('storage/'.$slider->image) }}" width="100%" height="100%" class="rounded shadow">
                </div>
                <div class="form-group mt-2 mb-3">
                    <label for="3" class="mb-1">وضعیت نمایش  اسلایدر را انتخاب کنید:</label>
                    <select name="status" id="3" class="form-control">
                        @foreach($statuses as $key=>$status)
                            <option value="{{ $key }}" @if($key== $slider->status) selected @endif>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            @endisset
            <div class="form-group mb-3">
                <button class="btn btn-danger btn-sm">
                    @isset($slider)
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
