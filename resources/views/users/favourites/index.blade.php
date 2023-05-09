@extends('layouts.front')
@section('title','علاقه مندی ها')
@section('content')
        <main class="profile-user-page default">
            <div class="container">
                <div class="row">
                    <div class="profile-page col-xl-12 col-lg-12 col-md-12 order-2">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-12">
                                    <h1 class="title-tab-content">
                                        علاقه مندی های شما
                                            <i class="fa fa-heart text-danger"></i>

                                    </h1>
                                </div>
                                <div class="content-section default">
                                    <div class="row">
                                        @forelse($favourites as $favourite)
                                            <div class="col-md-12 col-sm-12">
                                                <div class="profile-recent-fav-row">
                                                    <a href="{{ route('fronts.product',$favourite->product->slug) }}" class="profile-recent-fav-col profile-recent-fav-col-thumb">
                                                        <img src="{{ asset('storage/'.$favourite->product->image1) }}"></a>
                                                    <div class="profile-recent-fav-col profile-recent-fav-col-title">
                                                        <a href="{{ route('fronts.product',$favourite->product->slug) }}">
                                                            <h4 class="profile-recent-fav-name">
                                                                {{ $favourite->product->title_fa }}
                                                            </h4>
                                                        </a>
                                                        <div class="profile-recent-fav-price">
                                                            @if($favourite->product->takhfif==0)
                                                                {{ number_format($favourite->product->price) }}
                                                            @else
                                                                {{ number_format($favourite->product->newprice($favourite->product->price,$favourite->product->takhfif)) }}
                                                            @endif
                                                            تومان</div>
                                                    </div>
                                                    <div class="col-12 text-left mb-3">
                                                        <a class="view-favourite btn btn-primary" href="{{ route('fronts.product',$favourite->product->slug) }}">مشاهده محصول</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="alert alert-success pb-4 form-control rounded"> محصولی فعلا به علاقه مندی اضافه نشده است</div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>


@endsection
