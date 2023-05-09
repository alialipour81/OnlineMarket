@extends('layouts.front')
@section('title','فروشگاه اینترنتی آنلاین مارکت')
@section('content')
    <main class="main default">
        <div class="container">
            <!-- banner -->
            <div class="row banner-ads">
                <div class="col-12">
                    <section class="banner">
                        <a href="{{ $posters[1]->link }}">
                            <img src=" {{ asset('storage/'.$posters[1]->image) }}" alt="">
                        </a>
                    </section>
                </div>
            </div>
            <!-- banner -->
            <div class="row">
                <aside class="sidebar col-12 col-lg-3 order-2 order-lg-1">
                    <div class="sidebar-inner default">
                        <div class="widget-banner widget card">
                            <a href="{{ $posters[0]->link }}" target="_top">
                                <img class="img-fluid" src="{{ asset('storage/'.$posters[0]->image) }}" alt="">
                            </a>
                        </div>
                        <div class="widget-services widget card">
                            <div class="row">
                                <div class="feature-item col-12">
                                    <a  target="_blank">
                                        <img src="{{ asset('assets/img/svg/return-policy.svg') }}">
                                    </a>
                                    <p>ضمانت برگشت</p>
                                </div>
                                <div class="feature-item col-6">
                                    <a  target="_blank">
                                        <img src="{{ asset('assets/img/svg/payment-terms.svg') }}">
                                    </a>
                                    <p>پرداخت درمحل</p>
                                </div>
                                <div class="feature-item col-6">
                                    <a  target="_blank">
                                        <img src="{{ asset('assets/img/svg/delivery.svg') }}">
                                    </a>
                                    <p>تحویل اکسپرس</p>
                                </div>
                                <div class="feature-item col-6">
                                    <a  target="_blank">
                                        <img src="{{ asset('assets/img/svg/origin-guarantee.svg') }}">
                                    </a>
                                    <p>تضمین بهترین قیمت</p>
                                </div>
                                <div class="feature-item col-6">
                                    <a target="_blank">
                                        <img src="{{ asset('assets/img/svg/contact-us.svg') }}">
                                    </a>
                                    <p>پشتیبانی 24 ساعته</p>
                                </div>
                            </div>
                        </div>
                        <div class="widget-suggestion widget card">
                            <header class="card-header">
                                <h3 class="card-title">پیشنهاد لحظه ای</h3>
                            </header>
                            <div id="progressBar">
                                <div class="slide-progress"></div>
                            </div>
                            <div id="suggestion-slider" class="owl-carousel owl-theme">
                                @foreach($offers as $offer)
                                <div class="item">
                                    <a href="{{ route('fronts.product',$offer->product->slug) }}">
                                        <img src="{{ asset('storage/'.$offer->product->image1) }}" class="w-100" alt="">
                                    </a>
                                    <h3 class="product-title">
                                        <a href="{{ route('fronts.product',$offer->product->slug) }}"> {{ $offer->product->title_fa }} </a>
                                    </h3>
                                    <div class="price">
                                        @if($offer->product->takhfif != 0)
                                            <del><span class="amount">{{ number_format($offer->product->price) }}<span>تومان</span></span></del>
                                        @endif
                                            @if($offer->product->takhfif == 0)
                                                <span class="amount">{{ number_format($offer->product->price) }}<span>تومان</span></span>
                                            @else
                                                {{ number_format($offer->product->newprice($offer->product->price,$offer->product->takhfif)) }}تومان
                                            @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="widget-banner widget card">
                            <a href="{{ $posters[2]->link }}" target="_blank">
                                <img class="img-fluid" src="{{ asset('storage/'.$posters[2]->image) }}" alt="">
                            </a>
                        </div>
                        <div class="widget-banner widget card">
                            <a href="{{ $posters[3]->link }}" target="_blank">
                                <img class="img-fluid" src="{{ asset('storage/'.$posters[3]->image) }}" alt="">
                            </a>
                        </div>
                        <div class="widget-banner widget card">
                            <a href="{{ $posters[4]->link }}" target="_top">
                                <img class="img-fluid" src="{{ asset('storage/'.$posters[4]->image) }}" alt="">
                            </a>
                        </div>
                        <div class="widget-banner widget card">
                            <a href="{{ $posters[5]->link }}" target="_blank">
                                <img class="img-fluid" src="{{ asset('storage/'.$posters[5]->image) }}" alt="">
                            </a>
                        </div>
                        <div class="widget-banner widget card">
                            <a href="{{ $posters[6]->link }}" target="_blank">
                                <img class="img-fluid"
                                     src="{{ asset('storage/'.$posters[6]->image) }}"
                                     alt="">
                            </a>
                        </div>
                        <div class="widget-banner widget card">
                            <a href="{{ $posters[7]->link }}" target="_blank">
                                <img class="img-fluid" src="{{ asset('storage/'.$posters[7]->image) }}" alt="">
                            </a>
                        </div>
                    </div>
                </aside>

                <div class="col-12 col-lg-9 order-1 order-lg-2">
                    @if($sliders->count())
                    <section id="main-slider" class="carousel slide carousel-fade card" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach($sliders as $slider)
                            <li data-target="#main-slider" data-slide-to="0" class=" @if($loop->first) active @endif"></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @foreach($sliders as $slider)
                            <div class="carousel-item @if($loop->first) active @endif">
                                <a class="d-block" href="{{ $slider->link }}">
                                    <img src="{{ asset('storage/'.$slider->image) }}" class="d-block w-100" alt="">
                                </a>
                            </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#main-slider" role="button" data-slide="prev">
                            <i class="now-ui-icons arrows-1_minimal-right"></i>
                        </a>
                        <a class="carousel-control-next" href="#main-slider" data-slide="next">
                            <i class="now-ui-icons arrows-1_minimal-left"></i>
                        </a>
                    </section>
                    @endif
                        @if($amazings->count())
                    <section id="amazing-slider" class="carousel slide carousel-fade card" data-ride="carousel">
                        <div class="row m-0">
                            <ol class="carousel-indicators pr-0 d-flex flex-column col-lg-3">
                                @foreach($amazings as $key=>$amazing)
                                    @if($amazing->product->status == 1)
                                <li class="@if($loop->first) active @endif" data-target="#amazing-slider" data-slide-to="{{ $key }}">
                                    <span>{{ $amazing->product->title_fa }}</span>
                                </li>
                                    @endif
                                @endforeach

                                <li class="view-all">
                                    <a class="btn btn-primary btn-block text-light hvr-sweep-to-left">
                                        <i class="fa fa-arrow-left"></i>لیست محصولات شگفت انگیز
                                    </a>
                                </li>
                            </ol>
                            <div class="carousel-inner p-0 col-12 col-lg-9" id="amazings">
                                <img class="amazing-title" src="{{ asset('assets/img/amazing-slider/amazing-title-01.png') }}" >
                                @foreach($amazings as $key=>$amazing)
                                    @if($amazing->product->status == 1)
                                <div class="carousel-item @if($loop->first) active @endif" id="{{ $key }}">
                                    <div class="row m-0">
                                        <div class="right-col col-5 d-flex align-items-center">
                                            <a class="w-100 text-center" href="{{ route('fronts.product',$amazing->product->slug) }}">
                                                <img src="{{ asset('storage/'.$amazing->product->image1) }}" class="img-fluid" alt="">
                                            </a>
                                        </div>
                                        <div class="left-col col-7">
                                            <div class="price">
                                                @if($amazing->product->takhfif !=0)
                                                    <del><span class="amount">{{ number_format($amazing->product->price) }}<span>تومان</span></span></del>
                                                @endif
                                                @if($amazing->product->takhfif == 0)
                                                    <ins><span>{{ number_format($amazing->product->price) }}<span>تومان</span></span></ins>
                                                @else
                                                    <ins><span>{{ number_format($amazing->product->newprice($amazing->product->price,$amazing->product->takhfif)) }}<span>تومان</span></span></ins>
                                                @endif

                                                    @if($amazing->product->takhfif != 0)
                                                <span class="discount-percent">
                                                    @if($amazing->product->takhfif==0)
                                                        0
                                                    @else
                                                        {{ round($amazing->product->parcent($amazing->product->price,$amazing->product->takhfif)) }}
                                                    @endif
                                                    % تخفیف
                                                </span>
                                                    @endif

                                            </div>
                                            <h2 class="product-title">
                                                <a href="{{ route('fronts.product',$amazing->product->slug) }}"> {{ $amazing->product->title_fa }} </a>
                                            </h2>
                                            <ul class="list-group">
                                                @foreach($amazing->explode($amazing->product->attributes) as $attribute)
                                                <li class="list-group-item">{{ $attribute }}</li>
                                                @endforeach
                                            </ul>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                    </section>
                        @endif
                    <div class="row banner-ads">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6 col-lg-3">
                                    <div class="widget-banner card">
                                        <a href="{{ $posters[8]->link }}" target="_blank">
                                            <img class="img-fluid" src="{{ asset('storage/'.$posters[8]->image) }}" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <div class="widget-banner card">
                                        <a href="{{ $posters[9]->link }}" target="_top">
                                            <img class="img-fluid" src="{{ asset('storage/'.$posters[9]->image) }}" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <div class="widget-banner card">
                                        <a href="{{ $posters[10]->link }}" target="_top">
                                            <img class="img-fluid" src="{{ asset('storage/'.$posters[10]->image) }}" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <div class="widget-banner card">
                                        <a href="{{ $posters[11]->link }}" target="_top">
                                            <img class="img-fluid" src="{{ asset('storage/'.$posters[11]->image) }}" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="widget widget-product card">
                                <header class="card-header">
                                    <h3 class="card-title">
                                        <span>   محصولات جدید</span>
                                    </h3>
                                    <a href="{{ route('fronts.products') }}" class="view-all">مشاهده همه</a>
                                </header>
                                <div class="product-carousel owl-carousel owl-theme">
                                    @foreach($products as $product)
                                    <div class="item h-100">
                                        <a href="{{ route('fronts.product',$product->slug) }}">
                                            <img src="{{ asset('storage/'.$product->image1) }}" class="img-fluid" alt="">
                                        </a>
                                        <h2 class="post-title">
                                            <a href="{{ route('fronts.product',$product->slug) }}">{{ $product->title_fa }}</a>
                                        </h2>
                                        <div class="price">


                                                <div class="text-center">
                                                    @if($product->takhfif == 0)
                                                    <ins><span>{{ number_format($product->price) }}<span>تومان</span></span></ins>
                                                    @else
                                                        <ins><span>{{ number_format($product->newprice($product->price,$product->takhfif)) }}<span>تومان</span></span></ins>
                                                    @endif
                                                </div>
                                                 @if($product->takhfif != 0)
                                                <div class="text-center">

                                                    <del><span>{{ number_format($product->price)}}<span>تومان</span></span></del>
                                                </div>
                                                 @endif



                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row banner-ads">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="widget-banner card">
                                        <a href="{{ $posters[12]->link }}" target="_blank">
                                            <img class="img-fluid" src="{{ asset('storage/'.$posters[12]->image) }}" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="widget-banner card">
                                        <a href="{{ $posters[13]->link }}" target="_top">
                                            <img class="img-fluid" src="{{ asset('storage/'.$posters[13]->image) }}" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="widget widget-product card">
                                <header class="card-header">
                                    <h3 class="card-title">
                                        <span>محصولات تصادفی  </span>
                                    </h3>
                                    <a href="{{ route('fronts.products') }}" class="view-all">مشاهده همه</a>
                                </header>
                                <div class="product-carousel owl-carousel owl-theme">
                                        @foreach($randoms as $random)
                                        <div class="item h-100">
                                            <a href="{{ route('fronts.product',$random->slug) }}">
                                                <img src="{{ asset('storage/'.$random->image1) }}" class="img-fluid" alt="">
                                            </a>
                                            <h2 class="post-title">
                                                <a href="{{ route('fronts.product',$random->slug) }}">{{ $random->title_fa }}</a>
                                            </h2>
                                            <div class="price">


                                                <div class="text-center">
                                                    @if($random->takhfif == 0)
                                                        <ins><span>{{ number_format($random->price) }}<span>تومان</span></span></ins>
                                                    @else
                                                        <ins><span>{{ number_format($random->newprice($random->price,$random->takhfif)) }}<span>تومان</span></span></ins>
                                                    @endif
                                                </div>
                                                @if($random->takhfif != 0)
                                                    <div class="text-center">

                                                        <del><span>{{ number_format($random->price)}}<span>تومان</span></span></del>
                                                    </div>
                                                @endif



                                            </div>
                                        </div>
                                        @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row banner-ads">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="widget widget-banner card">
                                        <a href="{{ $posters[14]->link }}" target="_blank">
                                            <img class="img-fluid" src="{{ asset('storage/'.$posters[14]->image) }}" alt="" width="100%">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="brand-slider card">
                        <header class="card-header">
                            <h3 class="card-title"><span>برندهای ویژه</span></h3>
                        </header>
                        <div class="owl-carousel">
                            @foreach($brands as $brand)
                            <div class="item">
                                <a href="{{ $brand->link }}">
                                    <img src="{{ asset('storage/'.$brand->image) }}">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
