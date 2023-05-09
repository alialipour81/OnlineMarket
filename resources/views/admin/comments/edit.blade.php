@extends('layouts.admin.front')
@section('title',' ویرایش  نظر')
@section('content')
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1">
                    ویرایش نظر
            </span>
        </div>
        <div class="card-body">
            <form action="{{ route('comments.update',$comment->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                    @method('PUT')
                <div class="form-group mb-3">
                    <label for="1" class="mb-1">نام  محصول: </label>
                    <input type="text" id="1" class="form-control" value="{{ $comment->product->title_fa }}" disabled>

                </div>
                <div class="form-group mb-3">
                    <label for="1" class="mb-1">نام  نظردهنده: </label>
                    <input type="text" id="1" class="form-control" value="{{ $comment->user->name }}" disabled>

                </div>
                <div class="form-group mb-3">
                    <label for="description" class="mb-1">متن نظر:</label>
                    <textarea name="content"  class="form-control @error('content') is-invalid @enderror" rows="6">{{ $comment->content  }}</textarea>
                    @error('content')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mt-2 mb-3">
                    <label for="3" class="mb-1">وضعیت نمایش  نظر را انتخاب کنید:</label>
                    <select name="status" id="3" class="form-control @error('status') is-invalid @enderror">
                        @foreach($statuses as $key=>$status)
                            <option value="{{ $key }}" @if($key== $comment->status) selected @endif>{{ $status }}</option>
                        @endforeach
                    </select>
                    @error('status')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <button class="btn btn-danger btn-sm">
                        ویرایش
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
