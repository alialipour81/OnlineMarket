@extends('layouts.front')
@section('title',$product->title_fa)
@section('content')
    <main class="single-product default">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav>
                        <ul class="breadcrumb">
                            <li>
                                <a href="{{ route('index') }}"><span>فروشگاه اینترنتی  آنلاین مارکت</span></a>
                            </li>
                            <li>
                                <a href="{{ route('fronts.category',$product->category->name) }}"><span> {{ $product->category->name }}</span></a>
                            </li>
                            <li>
                                <a><span>{{ $product->title_fa }}</span></a>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <article class="product">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="product-gallery default">
                                    <img class="zoom-img" id="img-product-zoom" src="{{ asset('storage/'.$product->image1) }}" data-zoom-image="assets/img/product/13351544.jpg" width="411" />

                                    <div id="gallery_01f" style="width:500px;float:left;">
                                        <ul class="gallery-items">
                                            <li>
                                                <a  href="{{ asset('storage/'.$product->image1) }}" class="elevatezoom-gallery active" data-update="" data-image="{{ asset('storage/'.$product->image1) }}" data-zoom-image="{{ asset('storage/'.$product->image1) }}">
                                                    <img src="{{ asset('storage/'.$product->image1) }}" width="100" /></a>
                                            </li>
                                            <li>
                                                <a href="{{ asset('storage/'.$product->image2) }}" class="elevatezoom-gallery" data-image="{{ asset('storage/'.$product->image2) }}" data-zoom-image="{{ asset('storage/'.$product->image2) }}"><img src="{{ asset('storage/'.$product->image2) }}" width="100" /></a>
                                            </li>
                                            <li>
                                                <a href="{{ asset('storage/'.$product->image3) }}" class="elevatezoom-gallery" data-image="{{ asset('storage/'.$product->image3) }}" data-zoom-image="{{ asset('storage/'.$product->image3) }}">
                                                    <img src="{{ asset('storage/'.$product->image3) }}" width="100" />
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ asset('storage/'.$product->image4) }}" class="elevatezoom-gallery" data-image="{{ asset('storage/'.$product->image4) }}" data-zoom-image="{{ asset('storage/'.$product->image4) }}" class="slide-content"><img src="{{ asset('storage/'.$product->image4) }}" height="68" /></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <ul class="gallery-options">
                                    @auth
                                        <li>
                                            <form action="@if($favourite!= null) {{ route('favourites.destroy',$favourite->id) }} @else {{ route('favourites.store') }} @endif" method="post">
                                                @csrf
                                                @if($favourite!= null)
                                                    @method('DELETE')
                                                @endif
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button class="add-favorites" type="submit"><i class="fa fa-heart @if($favourite!= null) text-danger @endif"></i></button>
                                                @if($favourite != null)
                                                    <span class="tooltip-option"> حذف از علاقه مندی ها</span>
                                                @else
                                                    <span class="tooltip-option">افزودن به علاقمندی</span>
                                                @endif
                                            </form>
                                            @error('product_id')
                                            <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </li>
                                    @endauth
                                    <li>
                                        <button data-toggle="modal" data-target="#myModal"><i class="fa fa-share-alt"></i></button>
                                        <span class="tooltip-option">اشتراک گذاری</span>
                                    </li>
                                </ul>
                                <!-- Modal Core -->
                                <div class="modal-share modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">اشتراک گذاری</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-share">
                                                    <div class="form-share-title">اشتراک گذاری در شبکه های اجتماعی</div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <ul class="btn-group-share">
                                                                <div class="container mt-4">
                                                                    {!! $shareComponent !!}
                                                                </div>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Core -->
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="product-title default">
                                    <h1>
                                       {{ $product->title_fa }}
                                        <span>{{ $product->title_en }}</span>
                                    </h1>
                                </div>
                                <div class="product-directory default">
                                    <ul>
                                        <li>
                                            <span>برند</span> :
                                            <span class="product-brand-title">{{ $product->brand->name }}</span>
                                        </li>
                                        <li>
                                            <span>دسته‌بندی</span> :
                                            <a href="{{ route('fronts.category',$product->category->name) }}" class="btn-link-border">
                                             {{ $product->category->name }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <form action="{{ route('carts.add') }}" method="post">
                                    @csrf
                                <div class="product-variants default">
                                    <span>انتخاب رنگ: </span>
                                    <div>
                                        @foreach($product->explode($product->colors) as $key=>$color)
                                        <input type="radio" name="colors" id="{{ $key }}" value="{{ $color }}" class="checkbox-form">
                                        <label for="{{ $key }}">
                                            {{ $color }}
                                        </label>
                                        @endforeach
                                    </div>
                                    @error('colors')
                                    <span class="text-danger small">{{ $message }}</span>
                                    @enderror


                                </div>
                                <div class="product-guarantee default">
                                    <i class="fa fa-check-circle"></i>
                                    <p class="product-guarantee-text"> گارانتی  {{ $product->gr }}</p>
                                </div>
                                <div class="product-delivery-seller default">
                                    @php
                                        if($product->markets->count()){
                                          $productBymarketid = $product->markets->toArray();
                                          $forosh = $productBymarketid[0]['name'];
                                            }
                                        if(is_numeric($product->forosh)){
                                            $f =$forosh;
                                        }else{
                                            $f = $product->forosh;
                                        }
                                    @endphp
                                    <p>
                                        <i class="now-ui-icons shopping_shop"></i>
                                        <span>فروشنده:‌</span>
                                      <a href="{{ route('index.market',$f) }}" class="btn-link-border">
                                        {{ $f }}
                                      </a>
                                    </p>
                                </div>
                                <div class="price-product defualt">
                                    <div class="price-value">
                                        <span>
                                            @if($product->takhfif==0)
                                            {{ number_format($product->price) }}
                                            @else
                                                {{ number_format($product->newprice($product->price,$product->takhfif)) }}
                                            @endif
                                        </span>
                                        <span class="price-currency">تومان</span>
                                    </div>
                                    @if($product->takhfif != 0)
                                        <div class="price-discount" data-title="تخفیف">
                                            <span>
                                                    @if($product->takhfif==0)
                                                    0
                                                @else
                                                    {{ round($product->parcent($product->price,$product->takhfif)) }}
                                                @endif
                                            </span>
                                            <span>%</span>
                                        </div>
                                    @endif
                                </div>
                                    @auth
                                <div class="product-add default">
                                    <div class="parent-btn">

                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <input type="hidden" name="title_fa" value="{{ $product->title_fa }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="price"
                                            @if($product->takhfif==0)
                                                value="{{ $product->price }}"
                                                @else
                                                value="{{$product->newprice($product->price,$product->takhfif)}}"
                                                @endif
                                            >
                                        <input type="hidden" name="image" value="{{ $product->image1 }}">
                                        <input type="hidden" name="gr" value="{{ $product->gr }}">
                                        <input type="hidden" name="forosh" value="{{ $product->forosh }}">
                                        <input type="hidden" name="slug" value="{{ $product->slug }}">
                                           <button class="dk-btn dk-btn-info"> افزودن به سبد خرید
                                               <i class="now-ui-icons shopping_cart-simple"></i>
                                           </button>

                                        </form>
                                    </div>
                                </div>
                    @endauth
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 center-breakpoint">
                                <div class="product-params default">
                                    <ul data-title="ویژگی‌های محصول">
                                        @foreach($product->explode($product->attributes) as $attribute)
                                        <li>
                                            <span>{{ $attribute }} </span>

                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="col-12 default no-padding">
                        <div class="product-tabs default">
                            <div class="box-tabs default">
                                <ul class="nav" role="tablist">
                                    <li class="box-tabs-tab">
                                        <a class="active" data-toggle="tab" href="#desc" role="tab" aria-expanded="true">
                                            <i class="now-ui-icons objects_umbrella-13"></i> نقد و بررسی
                                        </a>
                                    </li>
                                    <li class="box-tabs-tab">
                                        <a data-toggle="tab" href="#comments" role="tab" aria-expanded="false">
                                            <i class="now-ui-icons shopping_shop"></i> نظرات کاربران
                                        </a>
                                    </li>
                                </ul>
                                <div class="card-body default">
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="desc" role="tabpanel" aria-expanded="true">
                                            <article>
                                                <h2 class="param-title">
                                                    نقد و بررسی تخصصی
                                                    <span>{{ $product->title_fa }}</span>
                                                </h2>
                                                <div class="parent-expert default ">
                                                    <div class="content-expert" >
                                                        <p>
                                                       {!! $product->description !!}
                                                        </p>
                                                    </div>
                                                    <div class="sum-more">
                                                            <span class="show-more btn-link-border">
                                                                نمایش بیشتر
                                                            </span>
                                                        <span class="show-less btn-link-border">
                                                                بستن
                                                            </span>
                                                    </div>
                                                    <div class="shadow-box"></div>
                                                </div>

                                                <div class="accordion default" id="accordionExample">
                                                    @foreach($product->callapses as $key=>$callapse)
                                                    <div class="card">
                                                        <div class="card-header" id="headingOne">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-link @if($key!=0) collapsed @endif" type="button" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                                                                    {{ $callapse->name }}
                                                                </button>
                                                            </h5>
                                                        </div>

                                                        <div id="collapse{{ $key }}" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                                <p>
                                                                {!! $callapse->description !!}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>

                                            </article>
                                        </div>
                                        <div class="tab-pane" id="comments" role="tabpanel" aria-expanded="false">
                                            <article>
                                                <h2 class="param-title">
                                                    نظرات کاربران
                                                </h2>
                                               @auth
                                                    <article>
                                                        <h2 class="param-title">
                                                            <span>نظر خود را در مورد محصول مطرح نمایید</span>
                                                        </h2>
                                                        <form action="{{ route('index.comment') }}" method="post" class="comment">
                                                            @csrf
                                                            @error('content')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                            @enderror
                                                            <textarea class="form-control @error('content') is-invalid @enderror" placeholder="نظر خود را اینجا بنویسید" rows="5" name="content"></textarea>
                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                            @error('product_id')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                            @enderror
                                                            <button class="btn btn-success">ارسال نظر</button>
                                                        </form>
                                                    </article>
                                                @endauth
                                                <div class="comments-area default">
                                                    <ol class="comment-list">
                                                        @foreach($product->comments as $comment)
                                                        <li>
                                                            <div class="comment-body">
                                                                <div class="comment-author">
                                                                    <img alt="" src="{{   Gravatar::get($comment->user->email)}}" class="avatar"><cite class="fn">{{ $comment->user->name }}</cite>
                                                                    <span class="says">گفت:</span> </div>

                                                                <div class="commentmetadata"><a href="#">{{ $comment->created_at->diffForHumans() }}</a></div>

                                                                <p>{{ $comment->content }}</p>

{{--                                                                <div class="reply"><a class="comment-reply-link" href="#">پاسخ</a></div>--}}
                                                            </div>
                                                        </li>
                                                        @if($comment->replies()->count())
                                                            @foreach($comment->replies as $reply)
                                                                @if($reply->child!= null && $reply->status==1)
                                                            <li class="mr-5">
                                                                <div class="comment-body">
                                                                    <div class="comment-author">
                                                                        <img alt="" src="{{   Gravatar::get($reply->user->email)}}" class="avatar">
                                                                         <span class="says">پاسخ به {{$comment->user->name}}:</span> </div>

                                                                    <div class="commentmetadata"><a href="#">{{ $reply->created_at->diffForHumans() }}</a></div>

                                                                    <p>{{ $reply->content }}</p>

                                                                    {{--                                                                <div class="reply"><a class="comment-reply-link" href="#">پاسخ</a></div>--}}
                                                                </div>
                                                            </li>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </ol>
                                                </div>

                                            </article>
                                        </div>
                                        @if($product->tags()->count())
                                        <div class="mt-2 mb-2">
                                            <span class="d-block mb-2 fa fa-tags text-bold">برچسپ ها:</span>
                                            @foreach($product->tags as $tag)
                                                <a href="{{ route('fronts.tag',$tag->name) }}" class="btn-sm btn btn-danger shadow">#{{ $tag->name }}</a>
                                            @endforeach
                                        </div>
                                        @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('link_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <style>
        div#social-links ul li {
            display: inline-block;
        }
        div#social-links ul li a {
            margin: 1px;
            font-size: 40px;
            transition: all 0.2s;
        }
        div#social-links ul li a:hover{
            color:blue;
        }
    </style>
@endsection
