@extends('layouts.admin.front')
@section('title',' ویرایش  سفارش')
@section('content')
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1">
                    ویرایش سفارش
            </span>
        </div>
        <div class="card-body">
            <form action="{{ route('orders.update',$order->id) }}" method="post" >
                @csrf
                    @method('PUT')
                <div class="form-group mb-3">
                    <label for="1" class="mb-1">نام  محصول: </label>
                    <select name="product_id" id="1" class="form-control @error('product_id') is-invalid @enderror">
                        @foreach($products as $product)
                            <option value="{{ $product->id }}"
                                    @isset($order)
                                        @if($order->product_id == $product->id)
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
                    <label for="1" class="mb-1">نام  کاربر: </label>
                    <select name="user_id" id="1" class="form-control @error('user_id') is-invalid @enderror">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}"
                                    @isset($order)
                                        @if($order->user_id == $user->id)
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
                    <label for="1" class="mb-1 text-secondary">انتخاب رنگ   : </label>
                    @foreach($order->product->explode($order->product->colors) as $key=>$color)
                        <input type="radio" name="color" id="{{$key}}" value="{{$color}}" class="checkbox-form"
                        @if($order->color == $color)
                            checked
                            @endif
                        >
                        <label for="{{$key}}">
                            {{$color}}
                        </label>
                    @endforeach
                    <span class="text-secondary d-block small">رنگ فعلی: {{$order->color}}</span>
                </div>
                <div class="form-group mb-3">
                    <label for="1" class="mb-1">تعداد: </label>
                    <input type="text" id="1" class="form-control" value="{{ $order->quantity }}" name="quantity">
                    @error('quantity')
                    <span class="text-danger small d-block">{{ $message }}</span>
                    @enderror

                </div>
                <div class="form-group mt-2 mb-3">
                    <label for="3" class="mb-1">وضعیت نمایش  سفارش را انتخاب کنید:</label>
                    <select name="status" id="3" class="form-control @error('status') is-invalid @enderror">
                        @foreach($statuses as $key=>$status)
                            <option value="{{ $key }}" @if($key== $order->status) selected @endif>{{ $status }}</option>
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
