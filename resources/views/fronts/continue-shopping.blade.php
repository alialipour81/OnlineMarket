@extends('layouts.basketbuy.front')
@section('title','سبدخرید -پرداخت نهایی')
@section('content_basketbuy')


        <section class="page-content default">

            <div class="headline">
                <span>خلاصه سفارش</span>
            </div>
            <div class="checkout-order-summary">
                <div class="accordion checkout-order-summary-item" id="accordionExample">
                    <div class="card">
                        <div class="card-header checkout-order-summary-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="false"
                                        aria-controls="collapseOne">
                                    <div class="checkout-order-summary-row">
                                        <div
                                            class="checkout-order-summary-col checkout-order-summary-col-post-time">
                                            تعداد کالا
                                            <span class="fs-sm">({{$items->count()}} کالا)</span>
                                        </div>
                                        <div
                                            class="checkout-order-summary-col checkout-order-summary-col-how-to-send">
                                            <span class="dl-none-sm">نحوه ارسال</span>
                                            <span class="dl-none-sm">
                                                پست پیشتاز

                                                              </span>
                                        </div>
                                        <div
                                            class="checkout-order-summary-col checkout-order-summary-col-how-to-send">
                                            <span>ارسال از</span>
                                            <span class="fs-sm">
                                                                3 روز کاری
                                                            </span>
                                        </div>
                                        <div
                                            class="checkout-order-summary-col checkout-order-summary-col-shipping-cost">
                                            <span>هزینه ارسال</span>
                                            <span class="fs-sm">
                                                @if(session()->has('discount'))
                                                   @if((\Cart::getTotal()-session()->get('discount')) >= 2000000)
                                                    رایگان
                                                    @else
                                                        {{ number_format(20000) }}
                                                        تومان
                                                    @endif
                                                @else
                                                        @if(\Cart::getTotal() >= 2000000)
                                                            رایگان
                                                    @else
                                                        {{ number_format(20000) }}
                                                        تومان
                                                    @endif
                                                @endif

                                                            </span>
                                        </div>
                                    </div>
                                    <i class="now-ui-icons arrows-1_minimal-down icon-down"></i>
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                             data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="box">
                                    <div class="row">
                                        @foreach($items as $item)
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                            <div class="product-box-container">
                                                <div class="product-box product-box-compact">
                                                    <a href="{{ route('fronts.product',$item->attributes->slug) }}" class="product-box-img">
                                                        <img src="{{ asset('storage/'.$item->attributes->image) }}">
                                                    </a>
                                                    <div class="product-box-title">
                                                       {{ $item->name }}<br>
                                                        <span class="small text-danger">تعداد:{{$item->quantity}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-12">
                    <div class="checkout-price-options">
                        <div class="checkout-price-options-form">
                            <section class="checkout-price-options-container">
                                <div class="checkout-price-options-header">
                                    <span>استفاده از کد تخفیف آنلاین مارکت</span>
                                </div>
                                <div class="checkout-price-options-content">
                                    <p class="checkout-price-options-description">
                                        با ثبت کد تخفیف، مبلغ کد تخفیف از “مبلغ قابل پرداخت” کسر می‌شود.
                                    </p>
                                    <form action="{{ route('index.checkDiscount') }}" method="post">
                                    <div class="checkout-price-options-row">
                                            @csrf
                                            <div class="checkout-price-options-form-field">
                                                <label class="ui-input">
                                                    <input class="ui-input-field @error('code') is-invalid @enderror"  name="code" type="text" placeholder="مثلا 837A2CS">
                                                    @error('code')
                                                    <span class="text-danger small">{{$message}}</span>
                                                    @enderror
                                                </label>
                                            </div>
                                            <div class="checkout-price-options-form-button ">
                                                <button type="submit" class="btn-primary">
                                                    ثبت کد تخفیف
                                                </button>
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection
