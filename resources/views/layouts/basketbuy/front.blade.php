@extends('layouts.front')
@section('content')
    @php
        if(\Cart::getTotal() !=null){
              if(session()->has('discount')){
                  if((\Cart::getTotal()-session()->get('discount')) >= 2000000){
                        $final_price =\Cart::getTotal();
                        $status_send= 'رایگان';
                  }else{
                      $final_price =\Cart::getTotal() +20000;
                   $status_send= '20,000تومان';
                  }
              }else{
                  if(\Cart::getTotal() >= 2000000){
              $final_price =\Cart::getTotal();
              $status_send= 'رایگان';
          }else{
                 $final_price =\Cart::getTotal()+20000;
                   $status_send= '20,000تومان';
          }
              }
        }else{
              $status_send= '0';
            $final_price='0';
        }
    @endphp
    <main class="cart-page default">
        <div class="container">
            <div class="row">
                <div class="cart-page-content col-xl-9 col-lg-8 col-md-12 order-1">
                  @yield('content_basketbuy')
                </div>
                <aside class="cart-page-aside col-xl-3 col-lg-4 col-md-6 center-section order-2">
                    <div class="checkout-aside">
                        <div class="checkout-summary">
                            <div class="checkout-summary-main">
                                <ul class="checkout-summary-summary">
                                    <li><span>مبلغ کل ({{$items->count()}} کالا)</span><span>{{number_format(\Cart::getTotal())}} تومان</span></li>
                                    <li>
                                        <span>هزینه ارسال</span>
                                        <span>{{ $status_send }}<span class="wiki wiki-holder"></span>
                                    </li>
                                </ul>
                                <div class="checkout-summary-devider">
                                    <div></div>
                                </div>
                                <div class="checkout-summary-content">
                                    <div class="checkout-summary-price-title">مبلغ قابل پرداخت:</div>
                                    <div class="checkout-summary-price-value text-success">
                                        <span class="checkout-summary-price-value-amount text-success">
                                            @if(session()->has('discount'))
                                                {{ number_format($total=$final_price-session()->get('discount')) }}
                                            @else
                                                {{ number_format($total=$final_price) }}
                                            @endif
                                            @php session()->put('total',$total) @endphp
                                        </span>تومان
                                    </div>
                                    @if(request()->url() == route('carts.continue'))
                                        <div class="parent-btn">
                                        <form action="{{ route('carts.request_zarinpal') }}" method="post">
                                            @csrf
                                            <button class="dk-btn dk-btn-success" type="submit">
                                                <i class="now-ui-icons shopping_basket"></i>
                                                خرید وپرداخت نهایی
                                            </button>
                                        </form>
                                        </div>
                                    @else
                                        <a  @if($items->count())  href="{{ route('carts.continue') }}" @endif class="selenium-next-step-shipping">
                                            <div class="parent-btn">
                                                <button class="dk-btn dk-btn-success">
                                                    @if($items->count())
                                                        @if(request()->url() == route('carts.continue'))
                                                            خرید وپرداخت نهایی
                                                        @else
                                                            ادامه فرآیند خرید
                                                        @endif
                                                    @else
                                                        سبدخرید خالیست
                                                    @endif
                                                    <i class="now-ui-icons shopping_basket"></i>
                                                </button>
                                            </div>
                                        </a>
                                    @endif

                                    <div>
                                            <span>
                                        ارسال محصول بعد از پرداخت شما انجام خواهدشد باتشکر
                                            </span>
                                        <span class="wiki wiki-holder"><span class="wiki-sign"></span>
                                                <div class="wiki-container is-right">
                                                    <div class="wiki-arrow"></div>
                                                    <p class="wiki-text">
                                                        محصولات موجود در سبد خرید شما تنها در صورت ثبت و پرداخت سفارش
                                                        برای شما رزرو
                                                        می‌شوند. در
                                                        صورت عدم ثبت سفارش، دیجی کالا هیچگونه مسئولیتی در قبال تغییر
                                                        قیمت یا موجودی
                                                        این کالاها
                                                        ندارد.
                                                    </p>
                                                </div>
                                            </span>
                                        @if(session()->has('discount'))
                                            <span class="text-success fa fa-ticket d-block">تخفیف برای شما فعال میباشد</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="checkout-feature-aside">
                            <ul>
                                <li class="checkout-feature-aside-item checkout-feature-aside-item-guarantee">
                                    هفت روز
                                    ضمانت تعویض
                                </li>
                                <li class="checkout-feature-aside-item checkout-feature-aside-item-cash">
                                    پرداخت در محل با
                                    کارت بانکی
                                </li>
                                <li class="checkout-feature-aside-item checkout-feature-aside-item-express">
                                    تحویل اکسپرس
                                </li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>

@endsection
