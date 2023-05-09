<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <title>@yield('title')</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome/css/font-awesome.min.css') }}"/>
    <!-- CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/now-ui-kit.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/plugins/owl.carousel.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/plugins/owl.theme.default.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet"/>
    @yield('link_css')
</head>

<body class="index-page sidebar-collapse">

<!-- responsive-header / navbar -->
<nav class="navbar direction-ltr fixed-top header-responsive">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="#pablo">
                <img src="{{ asset('assets/img/logo.png') }}" height="24px" alt="">
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                    data-target="#navigation" aria-controls="navigation-index" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
            <div class="search-nav default">
                <form action="{{ route('fronts.products') }}" method="get">
                    <input type="text" placeholder="جستجو ..." name="search" value="{{ request()->query('search') }}">
                    <button type="submit"><img src="{{ asset('assets/img/search.png') }}" alt=""></button>
                </form>
                <ul>
                    <li><a href="{{ route('register') }}"><i class="now-ui-icons users_single-02"></i></a></li>
                    @auth
                        <li><a href="#"><i class="now-ui-icons shopping_basket"></i></a></li>
                    @endauth
                </ul>
            </div>
        </div>

        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <div class="logo-nav-res default text-center">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('assets/img/logo.png') }}" height="36px" alt="">
                </a>
            </div>
            <ul class="navbar-nav default">
               @foreach($categories as $category)
                    <li class="@if($category->parents()->count()) sub-menu @endif">
                        <a  @if(!$category->parents()->count()) href="{{ route('fronts.category',$category->name) }}" @endif> {{ $category->name }}</a>
                        @if($category->parents()->count())
                            <ul>
                                @foreach($category->parents as $cat1)
                                <li class="@if($cat1->parents()->count()) sub-menu @endif">
                                    <a class="text-dark" href="{{ route('fronts.category',$cat1->name) }}">{{ $cat1->name }}</a>
                                  @if($cat1->parents()->count())
                                        <ul>
                                            @foreach($cat1->parents as $cat2)
                                             <li>
                                                 <a class="text-secondary link-inherit" href="{{ route('fronts.category',$cat2->name) }}">{{ $cat2->name }}</a>
                                             </li>
                                            @endforeach
                                        </ul>
                                   @endif
                                </li>
                                @endforeach
                            </ul
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
<!-- responsive-header -->

<div class="wrapper default">

    <!-- header -->
    <header class="main-header default">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-4 col-5">
                    <div class="logo-area default">
                        <a href="{{ route('index') }}">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="" >
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5 col-sm-8 col-7">
                    <div class="search-area default">
                        <form action="{{ route('fronts.products') }}" method="get" class="search">
                            <input type="text" placeholder="نام کالا  مورد نظر خود را جستجو کنید…" name="search" value="{{ request()->query('search') }}">
                            <button type="submit"><img src="{{ asset('assets/img/search.png') }}" alt=""></button>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="user-login dropdown">

                        <a href="#" class="btn btn-neutral dropdown-toggle" data-toggle="dropdown"
                           id="navbarDropdownMenuLink1">
                            @auth
                                       {{ auth()->user()->name }}
                            @else
                                ورود / ثبت نام
                            @endauth
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                            @auth
                                @if(auth()->user()->role == 'admin')
                                    <div class="dropdown-item">
                                        <a class="btn btn-danger text-light" href="{{ route('categories.index') }}">ورود به پنل ادمین</a>
                                    </div>
                                @else
                                    <div class="dropdown-item">
                                        <a class="btn btn-warning text-light" href="{{ route('dashboard.index') }}"> ورود به داشبورد </a>
                                    </div>
                                @endif
                                    <form action="{{ route('logout') }}" method="post" class="dropdown-item">
                                        @csrf
                                        <button class=" btn btn-dark">خروج</button>
                                    </form>
                            @else
                                <div class="dropdown-item">
                                    <a class="btn btn-info" href="{{ route('login') }}">ورود به آنلاین مارکت </a>
                                </div>
                                <div class="dropdown-item font-weight-bold">
                                    <span>کاربر جدید هستید؟</span> <a class="register" href="{{ route('register') }}">ثبت‌نام</a>
                                </div>

                            @endauth
                        </ul>

                    </div>
                    <div class="cart dropdown">
                        <a href="" class="btn dropdown-toggle" data-toggle="dropdown" id="navbarDropdownMenuLink1">
                            <i class="now-ui-icons shopping_cart-simple"></i>
                            سبد خرید
                        </a>
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
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                            <div class="basket-header">
                                <div class="basket-total">
                                    <span>مبلغ کل خرید:</span>

                                    <span>
                                        @if($items->count())
                                            @if(session()->has('discount'))
                                                {{ number_format($final_price-session()->get('discount')) }}
                                            @else
                                                {{ number_format($final_price) }}
                                            @endif
                                        @else
                                            0
                                        @endif

                                    </span>
                                    <span> تومان</span>
                                </div>
                                <a href="{{ route('fronts.cart') }}" class="basket-link">
                                    <span>مشاهده سبد خرید</span>
                                    <div class="basket-arrow"></div>
                                </a>
                            </div>
                            <ul class="basket-list">
                                @forelse($items as $item)
                                <li>
                                    <a href="{{ route('fronts.product',$item->attributes->slug) }}" class="basket-item">
                                        <form action="{{ route('carts.remove') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button class="checkout-btn-remove btn-outline-danger" type="submit"></button>
                                        </form>
                                        <div class="basket-item-content">
                                            <div class="basket-item-image">
                                                <img alt="" src="{{ asset('storage/'.$item->attributes->image) }}">
                                            </div>
                                            <div class="basket-item-details">
                                                <div class="basket-item-title">{{ $item->name }}
                                                </div>
                                                <div class="basket-item-params">
                                                    <div class="basket-item-props">
                                                        <span> {{$item->quantity}} عدد</span>
                                                        <span>رنگ {{$item->attributes->colors}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                @empty
                                    <span class="text-secondary mb-2">فعلا محصولی در سبد خرید شما موجود نیست</span>
                                @endforelse$
                            </ul>
                            @auth
                              @if(\Cart::getTotal() == null)
                                    <a class="basket-submit bg-warning"> محصولی موجود نیست    </a>
                                @else
                                    <a href="" class="basket-submit bg-success">  ادامه فرآیند خرید  <i class="fa fa-shopping-basket"></i> </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="bg-info basket-submit">  ورود به حساب کاربری  </a>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <nav class="main-menu">
            <div class="container">
                <ul class="list float-right">
                    @foreach($categories as $category)
                    <li class="list-item list-item-has-children mega-menu mega-menu-col-5">
                        <a class="nav-link" @if(!$category->parents->count()) href="{{ route('fronts.category',$category->name) }}" @endif> {{ $category->name }}</a>
                        @if($category->parents->count())
                        <ul class="sub-menu nav">
                          @foreach($category->parents as $cat1)
                            <li class="list-item list-item-has-children">
                                <i class="now-ui-icons arrows-1_minimal-left text-danger"></i><a class="nav-link text-danger" href="{{ route('fronts.category',$cat1->name) }}">{{ $cat1->name }}</a>
                                @if($cat1->parents->count())
                                <ul class="sub-menu nav">
                                    @foreach($cat1->parents as $cat2)
                                    <li class="list-item">
                                        <a class="nav-link" href="{{ route('fronts.category',$cat2->name) }}">{{ $cat2->name }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    @endforeach


                </ul>
            </div>
        </nav>
    </header>
    <!-- header -->

    @include('layouts.message')
    @yield('content')


    <footer class="main-footer default">
        <div class="back-to-top">
            <a href="#"><span class="icon"><i class="now-ui-icons arrows-1_minimal-up"></i></span> <span>بازگشت به
                        بالا</span></a>
        </div>
        <div class="container">
            <div class="footer-services">
                <div class="row">
                    <div class="service-item col">
                        <a href="#" target="_blank">
                            <img src="assets/img/svg/delivery.svg">
                        </a>
                        <p>تحویل اکسپرس</p>
                    </div>
                    <div class="service-item col">
                        <a href="#" target="_blank">
                            <img src="assets/img/svg/contact-us.svg">
                        </a>
                        <p>پشتیبانی 24 ساعته</p>
                    </div>
                    <div class="service-item col">
                        <a href="#" target="_blank">
                            <img src="assets/img/svg/payment-terms.svg">
                        </a>
                        <p>پرداخت درمحل</p>
                    </div>
                    <div class="service-item col">
                        <a href="#" target="_blank">
                            <img src="assets/img/svg/return-policy.svg">
                        </a>
                        <p>۷ روز ضمانت بازگشت</p>
                    </div>
                    <div class="service-item col">
                        <a href="#" target="_blank">
                            <img src="assets/img/svg/origin-guarantee.svg">
                        </a>
                        <p>ضمانت اصل بودن کالا</p>
                    </div>
                </div>
            </div>
            <div class="footer-widgets">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="widget-menu widget card">
                            <header class="card-header">
                                <h3 class="card-title">راهنمای خرید از آنلاین مارکت</h3>
                            </header>
                            <ul class="footer-menu">
                                <li>
                                    <a href="#">نحوه ثبت سفارش</a>
                                </li>
                                <li>
                                    <a href="#">رویه ارسال سفارش</a>
                                </li>
                                <li>
                                    <a href="#">شیوه‌های پرداخت</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="widget-menu widget card">
                            <header class="card-header">
                                <h3 class="card-title">خدمات مشتریان</h3>
                            </header>
                            <ul class="footer-menu">
                                <li>
                                    <a href="#">پاسخ به پرسش‌های متداول</a>
                                </li>
                                <li>
                                    <a href="#">رویه‌های بازگرداندن کالا</a>
                                </li>
                                <li>
                                    <a href="#">شرایط استفاده</a>
                                </li>
                                <li>
                                    <a href="#">حریم خصوصی</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="widget-menu widget card">
                            <header class="card-header">
                                <h3 class="card-title">با آنلاین مارکت</h3>
                            </header>
                            <ul class="footer-menu">
                                <li>
                                    <a href="#">فروش در آنلاین مارکت</a>
                                </li>
                                <li>
                                    <a href="#">همکاری با سازمان‌ها</a>
                                </li>
                                <li>
                                    <a href="#">فرصت‌های شغلی</a>
                                </li>
                                <li>
                                    <a href="#">تماس با آنلاین مارکت</a>
                                </li>
                                <li>
                                    <a href="#">درباره آنلاین مارکت</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="newsletter">
                            <p>از تخفیف‌ها و جدیدترین‌های فروشگاه باخبر شوید:</p>
                            <form action="{{ route('emails.store') }}" method="post">
                                @csrf
                                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="آدرس ایمیل خود را وارد کنید..." name="email">
                                <input type="submit" class="btn btn-primary" value="ارسال">
                            </form>
                            @error('email')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="socials">
                            <p>ما را در شبکه های اجتماعی دنبال کنید.</p>
                            <div class="footer-social">
                                <a  target="_blank"><i class="fa fa-instagram"></i>اینستاگرام آنلاین مارکت</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="info">
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <span>هفت روز هفته ، 24 ساعت شبانه‌روز پاسخگوی شما هستیم.</span>
                    </div>
                    <div class="col-12 col-lg-2">شماره تماس: 021-123456789</div>
                    <div class="col-12 col-lg-2">آدرس ایمیل:<a href="#">{{ env('mail_from_address') }}</a></div>
                    <div class="col-12 col-lg-4 text-center">
                        <a target="_blank"><img src="{{ asset('assets/img/bazzar.png') }}" width="159" height="48"
                                                         alt=""></a>
                        <a  target="_blank"><img src="{{ asset('assets/img/sibapp.png') }}" width="159" height="48"
                                                         alt=""></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="description">
            <div class="container">
                <div class="row">
                    <div class="site-description col-12 col-lg-7">
                        <h1 class="site-title">فروشگاه اینترنتی آنلاین مارکت، بررسی، انتخاب و خرید آنلاین</h1>
                        <p>
                            آنلاین مارکت به عنوان یکی از قدیمی‌ترین فروشگاه های اینترنتی با بیش از یک دهه تجربه، با
                            پایبندی به سه اصل کلیدی، پرداخت در
                            محل، 7 روز ضمانت بازگشت کالا و تضمین اصل‌بودن کالا، موفق شده تا همگام با فروشگاه‌های
                            معتبر جهان، به بزرگ‌ترین فروشگاه
                            اینترنتی ایران تبدیل شود. به محض ورود به آنلاین مارکت با یک سایت پر از کالا رو به رو
                            می‌شوید! هر آنچه که نیاز دارید و به
                            ذهن شما خطور می‌کند در اینجا پیدا خواهید کرد.
                        </p>
                    </div>
                    <div class="symbol col-12 col-lg-5">
                        <a  target="_blank"><img src="{{ asset('assets/img/symbol-01.png') }}" alt=""></a >
                        <a  target="_blank"><img src="{{ asset('assets/img/symbol-02.png') }}" alt=""></a>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <ul class="footer-partners default">
                                <li class="col-md-3 col-sm-6">
                                    <a ><img src="{{ asset('assets/img/footer/1.svg') }}" alt=""></a>
                                </li>
                                <li class="col-md-3 col-sm-6">
                                    <a ><img src="{{ asset('assets/img/footer/2.svg') }}" alt=""></a>
                                </li>
                                <li class="col-md-3 col-sm-6">
                                    <a ><img src="{{ asset('assets/img/footer/3.svg') }}" alt=""></a>
                                </li>
                                <li class="col-md-3 col-sm-6">
                                    <a ><img src="{{ asset('assets/img/footer/4.svg') }}" alt=""></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <p>
                    استفاده از مطالب فروشگاه اینترنتی آنلاین مارکت فقط برای مقاصد غیرتجاری و با ذکر منبع بلامانع است.
                    کلیه حقوق این سایت متعلق
                    به شرکت نوآوران فن آوازه (فروشگاه آنلاین آنلاین مارکت) می‌باشد.
                </p>
            </div>
        </div>
    </footer>
</div>
</body>
<!--   Core JS Files   -->
<script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/core/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{ asset('assets/js/plugins/bootstrap-switch.js') }}"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{ asset('assets/js/plugins/nouislider.min.js') }}" type="text/javascript"></script>
<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src="{{ asset('assets/js/plugins/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<!-- Share Library etc -->
<script src="{{ asset('assets/js/plugins/jquery.sharrre.js') }}" type="text/javascript"></script>
<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets/js/now-ui-kit.js') }}" type="text/javascript"></script>
<!--  CountDown -->
<script src="{{ asset('assets/js/plugins/countdown.min.js') }}" type="text/javascript"></script>
<!--  Plugin for Sliders -->
<script src="{{ asset('assets/js/plugins/owl.carousel.min.js') }}" type="text/javascript"></script>
<!--  Jquery easing -->
<script src="{{ asset('assets/js/plugins/jquery.easing.1.3.min.js') }}" type="text/javascript"></script>
<!-- Main Js -->
<script src="{{ asset('assets/js/main.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/js/plugins/jquery.ez-plus.js') }}" type="text/javascript"></script>
</html>
