@extends('layouts.admin.front')
@section('title','ایجاد یا ویرایش ')
@section('content')
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1">
                @isset($discount)
                    ویرایش
                @else
                    ایجاد
                @endisset
            </span>
        </div>
    <div class="card-body">
        <form action="{{ isset($discount) ? route('discounts.update',$discount->id) : route('discounts.store') }}" method="post">
            @csrf
            @isset($discount)
                @method('PUT')
            @endisset
            <div class="form-group mb-3">
                <label for="1" class="mb-1">نام(کد تخفیف) را واردکنید :</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($discount) ? $discount->name : old('name') }}">
                @error('name')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="1" class="mb-1"> کاربر را انتخاب کنید:</label>
                <select name="user_id" id="1" class="form-control @error('user_id') is-invalid @enderror">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}"
                            @isset($discount)
                                @if($discount->user_id == $user->id)
                                selected
                                @endif
                            @endisset
                        >{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="1" class="mb-1"> قیمتی که با این کد کم میشود ?(به تومان) </label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ isset($discount) ? $discount->price : old('price') }}">
                @error('price')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="1" class="mb-1"> تاریخ اعتبار تخفیف را انتخاب کنید:</label>
                <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ isset($discount) ? $discount->date : old('date') }}">
                @error('date')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            @isset($discount)
                <div class="form-group mt-2 mb-3">
                    <label for="3" class="mb-1">وضعیت نمایش  تخفیف را انتخاب کنید:</label>
                    <select name="status" id="3" class="form-control">
                        @foreach($statuses as $key=>$status)
                            <option value="{{ $key }}" @if($key== $discount->status) selected @endif>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            @endisset
            <div class="form-group mb-3">
                <button class="btn btn-danger btn-sm">
                    @isset($discount)
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
