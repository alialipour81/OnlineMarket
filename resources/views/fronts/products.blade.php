@extends('layouts.front')
@section('title','همه محصولات')
@section('content')
    <main class="search-page default">
        <div class="container">
            <div class="row">
                <aside class="sidebar-page col-12 col-sm-12 col-md-4 col-lg-3 order-1">
                    <div class="box">
                        <div class="box-header">
                            جستجو در نتایج:</div>
                        <div class="box-content">
                            <div class="ui-input ui-input--quick-search">
                                <form action="{{ route('fronts.products') }}" method="get">
                                    <input type="text" class="ui-input-field ui-input-field--cleanable" placeholder="نام محصول   مورد نظر را بنویسید…" name="search" value="{{ request()->query('search') }}">
                                    <span class="ui-input-cleaner"></span>
                                    <button class="btn-sm btn btn-success mt-2 small">جستجو</button>
                                </form>
                            </div>
                        </div>
                    </div>


                </aside>
                <div class="col-12 col-sm-12 col-md-8 col-lg-9 order-2">
                    <div class="breadcrumb-section default">
                        <ul class="breadcrumb-list">
                            <li>
                                <a href="{{ route('index') }}">
                                    <span>فروشگاه اینترنتی دیجی کالا</span>
                                </a>
                            </li>
                           @if(request()->query('search') != null)
                                <li><span>جستجوی {{request()->query('search')}}</span></li>
                            @endif
                        </ul>
                    </div>
                    <div class="listing default">
                        <div class="listing-counter"> تعداد کالا :{{ $products->count() }}</div>

                        <div class="tab-content default text-center">
                            <div class="tab-pane active" id="related" role="tabpanel" aria-expanded="true">
                                <div class="container no-padding-right">
                                    <ul class="row listing-items">
                                        @foreach($products as $product)
                                        <li class="col-xl-3 col-lg-4 col-md-6 col-12 no-padding">
                                            <div class="product-box">
                                                <div
                                                    class="product-seller-details product-seller-details-item-grid">
                                                        <span class="product-main-seller"><span
                                                                @php
                                                                    if($product->markets->count()){
                                                                      $productBymarketid = $product->markets->toArray();
                                                                      $forosh = $productBymarketid[0]['name'];
                                                                                     }
                                                                @endphp
                                                                class="product-seller-details-label">فروشنده:
                                                            </span>
                                                            @if(is_numeric($product->forosh))
                                                                {{ $forosh }}
                                                            @else
                                                                {{ $product->forosh }}
                                                            @endif
                                                            </span>
                                                    <span class="product-seller-details-badge-container"></span>
                                                </div>
                                                <a class="product-box-img" href="{{ route('fronts.product',$product->slug) }}">
                                                    <img src="{{ asset('storage/'.$product->image1) }}" alt="">
                                                </a>
                                                <div class="product-box-content">
                                                    <div class="product-box-content-row">
                                                        <div class="product-box-title">
                                                            <a href="{{ route('fronts.product',$product->slug) }}">
                                                               {{ $product->title_fa }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="product-box-row product-box-row-price">
                                                        <div class="price">
                                                            <div class="price-value">
                                                                <div class="price-value-wrapper">

                                                                    @if($product->takhfif ==0)
                                                                        {{ number_format($product->price) }}
                                                                    @else
                                                                        {{ number_format($product->takhfif) }}
                                                                    @endif
                                                                        <span class="price-currency">
                                                                       تومان
                                                                   </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="pager default text-center">
                         {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
