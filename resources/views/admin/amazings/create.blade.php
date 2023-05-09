@extends('layouts.admin.front')
@section('title','ایجاد یا ویرایش ')
@section('content')
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1">
                @isset($amazing)
                    ویرایش
                @else
                    ایجاد
                @endisset
            </span>
        </div>
    <div class="card-body">
        <form action="{{ isset($amazing) ? route('amazings.update',$amazing->id) : route('amazings.store') }}" method="post">
            @csrf
            @isset($amazing)
                @method('PUT')
            @endisset
            <div class="form-group mb-3">
                <label for="1" class="mb-1"> محصول را انتخاب کنید:</label>
                <select name="product_id" id="1" class="form-control @error('product_id') is-invalid @enderror">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}"
                            @isset($amazing)
                                @if($amazing->product_id == $product->id)
                                selected
                                @endif
                            @endisset
                        >{{ $product->title_fa }}</option>
                    @endforeach
                </select>
                @error('product_id')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="1" class="mb-1"> تاریخ نمایش را انتخاب کنید:</label>
                <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ isset($amazing) ? $amazing->date : old('date') }}">
                @error('date')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            @isset($amazing)
                <div class="form-group mt-2 mb-3">
                    <label for="3" class="mb-1">وضعیت نمایش  محصول را انتخاب کنید:</label>
                    <select name="status" id="3" class="form-control">
                        @foreach($statuses as $key=>$status)
                            <option value="{{ $key }}" @if($key== $amazing->status) selected @endif>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            @endisset
            <div class="form-group mb-3">
                <button class="btn btn-danger btn-sm">
                    @isset($amazing)
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
