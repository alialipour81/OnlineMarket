@extends('layouts.users.front')
@section('title','سفارش ها  ')
@section('content')
    <div class="content-wrapper mt-4">
    <div dir="rtl">@include('layouts.message')</div>
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1"> سفارش ها </span>
        </div>
        <div class="card-body">
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
                    <th> تخفیف</th>
                    <th>وضعیت</th>

                </tr>
                </thead>
                <tbody>

                 @foreach($orders as $key=>$order)
                    <tr title="{{ $order->created_at->diffForHumans() }}">
                        <td>#{{ $key }}</td>
                        <td>{{ $order->product->title_fa }}</td>
                        <td>
                            <img src="{{ asset('storage/'.$order->product->image1) }}" width="60" height="40" class="rounded shadow">
                        </td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ number_format($order->total) }}تومان</td>
                        <td>{{ $order->pay_number }}</td>
                        <td>{{ $order->color }}</td>
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
                    </tr>
                 @endforeach
                </tbody>
            </table>
        </div>
    </div><br>
    {{ $orders->links() }}
    </div>
@endsection
