@extends('layouts.users.front')
@section('title','ایجاد یا ویرایش باکس')
@section('content')
    <div class="content-wrapper mt-4">
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1">
                @isset($collapse)
                    ویرایش باکس
                @else
                    ایجاد باکس
                @endisset
            </span>
        </div>
    <div class="card-body">
        <form action="{{ isset($collapse) ? route('user-collapses.update',$collapse->id) : route('user-collapses.store') }}" method="post">
            @csrf
            @isset($collapse)
                @method('PUT')
            @endisset
            <div class="form-group mb-3">
                <label for="1" class="mb-1">نام باکس را وارد کنید:</label>
                <input type="text" id="1" class="form-control @error('name') is-invalid @enderror" placeholder="عنوان باکس را وارد کنید" name="name" value="{{ isset($collapse) ? $collapse->name : old('name') }}">
                @error('name')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="description1" class="mb-1">توضیحات محصول را وارد کنید:</label>
                <textarea name="description" id="description1" class="form-control @error('description') is-invalid @enderror" rows="6">{{ isset($collapse) ? $collapse->description : old('description') }}</textarea>
                @error('description')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
                <script>
                    CKEDITOR.replace('description1',{
                        language :"fa",
                        filebrowserUploadUrl: "{{ route('collapses.upload',['_token'=>csrf_token()]) }}",
                        filebrowserUploadMethod:'form'

                    });
                </script>
            </div>
            <div class="form-group mb-3">
                <button class="btn btn-danger btn-sm">
                    @isset($collapse)
                        ویرایش
                    @else
                        ایجاد
                    @endisset
                </button>
            </div>
        </form>
    </div>
    </div>
    </div>
@endsection
