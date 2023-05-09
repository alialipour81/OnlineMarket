@extends('layouts.admin.front')
@section('title','پاسخ به نظر')
@section('content')
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1">پاسخ به نظر{{$comment->user->name}}</span>
        </div>
        <div class="card-body">
            <form action="{{ route('index.reply',$comment->id) }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="description" class="mb-1"> متن نظر:</label>
                    <textarea  class="form-control" rows="6" disabled>{{ $comment->content }}</textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="description" class="mb-1">پاسخ به نظر:</label>
                    <textarea name="content"  class="form-control @error('content') is-invalid @enderror" rows="6">{{ old('content') }}</textarea>
                    @error('content')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <button class="btn btn-success btn-sm">
                        پاسخ
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
