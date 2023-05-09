@extends('layouts.users.front')
@section('title','پرو فایل شما')
@section('content')
    <div class="content-wrapper mt-4">
        <!-- Content Header (Page header) -->
         @include('layouts.message')
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{ Gravatar::get(auth()->user()->email) }}" alt="{{ auth()->user()->name }}">
                                </div>

                                <h3 class="profile-username text-center"> {{ auth()->user()->name }}</h3>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">درباره من</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fa fa-envelope mr-1"></i> ایمیل:</strong>
                                <p class="text-muted">
                                   {{ auth()->user()->email }}
                                </p>
                                <hr>

                                <strong><i class="fa fa-phone mr-1"></i> شماره تلفن:</strong>

                                <p class="text-muted"> 0{{ auth()->user()->phone }}</p>
                                <hr>
                                <strong><i class="fa fa-id-card mr-1"></i> کد ملی :</strong>

                                <p class="text-muted"> {{ auth()->user()->code_meli }}</p>



                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item "><a class="nav-link active" href="#activity" data-toggle="tab">({{$comments->count()}})نظرات</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">ویرایش</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        @foreach($comments as $comment)
                                        <div class="post clearfix">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm" src="{{   Gravatar::get(auth()->user()->email)}}" class="img-circle elevation-2" alt="{{ auth()->user()->name }}">
                                                <span class="username">
                          <a class="text-secondary"> {{ $comment->user->name }}
                              @if($comment->status ==0)
                                  <span class="text-danger small">(تایید نشده)</span>
                              @else
                                  <span class="text-success small">(تایید شده)</span>
                              @endif
                          </a>
                        </span>
                                                <span class="description">ارسال شده -{{$comment->created_at->diffForHumans()}}</span>
                                                <span class="d-black small ">برای محصول: <a class="small text-info" target="_blank"  href="{{ route('fronts.product',$comment->product->slug) }}">{{$comment->product->title_fa}}</a></span>
                                            </div>
                                            <!-- /.user-block -->
                                            <p>{{ $comment->content }}</p>

                                        </div>
                                            @if($comment->replies->count())
                                                @foreach($comment->replies as $reply)
                                                    <div class="post clearfix mr-lg-5">
                                                        <div class="user-block">
                                                            <img class="img-circle img-bordered-sm" src="{{   Gravatar::get($reply->user->email)}}" class="img-circle elevation-2" alt="{{ $reply->user->name }}">
                                                            <span class="username">
                          <a > {{$reply->user->name }}</a>
                        </span>
                                                        </div>
                                                        <!-- /.user-block -->
                                                        <p>{{ $reply->content }}</p>

                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach

                                    </div>

                                    <div class="tab-pane" id="settings">
                                        <form class="form-horizontal" action="{{ route('profile.update',auth()->user()->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="inputName" class="col-sm-2 control-label">نام:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="نام خود را وارد کنید" name="name" value="{{ auth()->user()->name }}">
                                                    @error('name')
                                                    <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail" class="col-sm-2 control-label">ایمیل:</label>

                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="inputEmail" placeholder="ایمیل خود را وارد کنید" name="email" value="{{ auth()->user()->email }}" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputName2" class="col-sm-2 control-label">کد ملی:</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control @error('code_meli') is-invalid @enderror" id="inputName2" placeholder="کد ملی خود را وارد کنید" name="code_meli" value="{{ auth()->user()->code_meli }}">
                                                    @error('code_meli')
                                                    <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputName2" class="col-sm-2 control-label"> شماره کارت:</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control @error('card') is-invalid @enderror" id="inputName2" placeholder="شماره کارت  خود را وارد کنید" name="card" value="{{ auth()->user()->card }}">
                                                    @error('card')
                                                    <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputName2" class="col-sm-4 control-label">  شماره تلفن یا موبایل:</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control @error('number_phone') is-invalid @enderror" id="inputName2" placeholder="شماره تلفن یا موبایل خود را وارد کنید" name="number_phone" value="{{ auth()->user()->phone}}">
                                                    @error('number_phone')
                                                    <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <span class="text-secondary is-invalid">فیلد  شماره تلفن یا موبایل را  ابتدا بدون صفر وارد کنید</span>

                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-success btn-sm shadow mt-2">ذخیره تغییرات</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
