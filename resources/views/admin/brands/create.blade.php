@extends('layouts.admin.front')
@section('title','ایجاد یا ویرایش  برند')
@section('content')
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1">
                @isset($brand)
                    ویرایش برند
                @else
                    ایجاد برند
                @endisset
            </span>
        </div>
    <div class="card-body">
        <form action="{{ isset($brand) ? route('brands.update',$brand->id) : route('brands.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @isset($brand)
                @method('PUT')
            @endisset
            <div class="form-group mb-3">
                <label for="1" class="mb-1">نام  برند را وارد کنید:</label>
                <input type="text" id="1" class="form-control @error('name') is-invalid @enderror" placeholder="نام برند   را وارد کنید" name="name" value="{{ isset($brand) ? $brand->name : old('name') }}">
                @error('name')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="2" class="mb-1">تصویر  برند را انتخاب کنید:</label>
                <input type="file" id="2" class="form-control @error('image') is-invalid @enderror"  name="image" >
                @error('image')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            @isset($brand)
                <div class="mt-2 mb-2">
                    <img src="{{ asset('storage/'.$brand->image) }}" width="100%" height="100%" class="rounded shadow">
                </div>
                <div class="form-group mt-2 mb-3">
                    <label for="3" class="mb-1">وضعیت نمایش  برند را انتخاب کنید:</label>
                    <select name="status" id="3" class="form-control">
                        @foreach($statuses as $key=>$status)
                            <option value="{{ $key }}" @if($key== $brand->status) selected @endif>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            @endisset
            <div class="form-group mb-3">
                <label for="1" class="mb-1">لینک  برند را وارد کنید:</label>
                <input type="text" id="1" class="form-control @error('link') is-invalid @enderror" placeholder="لینک برند   را وارد کنید" name="link" value="{{ isset($brand) ? $brand->link : old('link') }}">
                @error('link')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <button class="btn btn-danger btn-sm">
                    @isset($brand)
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
