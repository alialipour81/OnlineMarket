@extends('layouts.admin.front')
@section('title','سفارش ها  ')
@section('content')
    <div dir="rtl">@include('layouts.message')</div>
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1"> سفارش ها </span>
        </div>
        <div class="card-body">
            <div class="mb-2 col-md-12">
                <form action="{{ route('orders.index') }}" method="get" class="search">
                    <input type="text" class="form-control col-md-10" name="search_order" value="{{ request()->query('search_order') }}" placeholder="کد سفارش را جستجو کنید...">
                    <button class="btn btn-outline-secondary btn-sm mt-2 fa fa-search col-md-2">جستجو</button>
                </form>
            </div>
            <table class="table table-borderless text-center">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th> نام </th>
                    <th> تصویر</th>
                    <th> تعداد</th>
                    <th> مبلغ پرداختی</th>
                    <th>کد سفارش</th>
                    <th> رنگ</th>
                    <th> کاربر</th>
                    <th> تخفیف</th>
                    <th>وضعیت</th>
                    <th> ویرایش</th>
                    <th>حذف </th>
                </tr>
                </thead>
                <tbody>

                 @foreach($orders as $order)
                    <tr title="{{ $order->created_at->diffForHumans() }}">
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->product->title_fa }}</td>
                        <td>
                            <img src="{{ asset('storage/'.$order->product->image1) }}" width="60" height="40" class="rounded shadow">
                        </td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ number_format($order->total) }}تومان</td>
                        <td>{{ $order->pay_number }}</td>
                        <td>{{ $order->color }}</td>
                        <td>{{ $order->user->name }}</td>
                         <td>
                             @if($order->discount ==0)
                                 <span class="text-primary small">ندارد</span>
                             @else
                                 <span class="text-success small">{{ number_format($order->discount) }}</span>

                             @endif
                         </td>
                        <td>
                            @if($order->status ==0)
                                <span class="text-primary small"> در حال بررسی</span>
                            @elseif($order->status ==1)
                                <span class="text-warning small">آماده سازی برای ارسال</span>
                            @else
                                <span class="text-success small"> ارسال شده  </span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('orders.edit',$order->id) }}" class="btn btn-primary btn-sm">ویرایش</a>
                        </td>
                        <td>
                            <form action="{{ route('orders.destroy',$order->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-dark btn-sm">حذف</button>
                            </form>
                        </td>
                    </tr>
                 @endforeach
                </tbody>
            </table>
        </div>
    </div><br>
    {{ $orders->links() }}

@endsection
