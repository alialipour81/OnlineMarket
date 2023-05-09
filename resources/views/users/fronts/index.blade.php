@extends('layouts.users.front')
@section('title','پنل کاربری شما')
@section('content')
    <div class="content-wrapper mt-4">
        <!-- Content Header (Page header) -->
          @include('layouts.message')
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-6 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $orders->count() }}</h3>

                                <p>سفارشات جدید</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('user-orders.index') }}" class="small-box-footer">اطلاعات بیشتر <i
                                    class="fa fa-arrow-circle-left"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $comments->count() }}</h3>

                                <p> کل نظرات شما</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-comment"></i>
                            </div>
                            <a href="{{ route('profile.index') }}" class="small-box-footer">اطلاعات بیشتر <i
                                    class="fa fa-arrow-circle-left"></i></a>
                        </div>
                    </div>

                    <!-- ./col -->
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-12 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->

                        <!-- /.card -->

                        <!-- DIRECT CHAT -->
                        <div class="card direct-chat direct-chat-primary">
                            <div class="card-header">
                                <h3 class="card-title">گفتگو</h3>

                                <div class="card-tools">
                                    <span data-toggle="tooltip" title="{{ $chats->count() }} پیام جدید" class="badge badge-primary">{{ $chats->count() }}</span>
                                    <button type="button" class="btn btn-tool" data-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-toggle="tooltip" title="5 پیام اخیر چت"
                                            data-widget="chat-pane-toggle">
                                        <i class="fa fa-comments"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-widget="remove"><i
                                            class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- Conversations are loaded here -->
                                <div class="direct-chat-messages">
                                    <!-- Message. Default to the left -->
                                    @foreach($chats as $chat)
                                    <div class="direct-chat-msg @if($chat->user->id == auth()->user()->id) right @endif ">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name @if($chat->user->id == auth()->user()->id) float-right @else float-left @endif"> {{ $chat->user->name }}</span>
                                            <span class="direct-chat-timestamp mx-2 @if($chat->user->id == auth()->user()->id) float-right @else float-left @endif">{{ $chat->created_at->diffForHumans() }}</span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                                        <img class="direct-chat-img" src="{{ Gravatar::get($chat->user->email) }}" alt="{{ $chat->user->name }}">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            @if($chat->user->id == auth()->user()->id)
                                                <form action="{{ route('chats.destroy',$chat->id) }}" method="post" class="float-left">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="border-0 btn-sm bg-danger">
                                                        <i class="fa fa-trash bg-danger "></i>
                                                    </button>
                                                </form>
                                            @endif
                                           {{ $chat->content }}
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    @endforeach



                                </div>
                                <!--/.direct-chat-messages-->

                                <!-- Contacts are loaded here -->
                                <div class="direct-chat-contacts">
                                    <ul class="contacts-list">
                                        @foreach($lastchats as $lastchat)
                                        <li>
                                            <a>
                                                <img class="contacts-list-img" src="{{ Gravatar::get($lastchat->user->email) }}" alt="{{ $lastchat->user->name }}">

                                                <div class="contacts-list-info">
                          <span class="contacts-list-name">
                          {{ $lastchat->user->name }}
                            <small class="contacts-list-date float-left">{{ $lastchat->created_at->diffForHumans() }}</small>
                          </span>
                                                    <span class="contacts-list-msg">{{ $lastchat->content }}</span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <!-- /.contacts-list -->
                                </div>
                                <!-- /.direct-chat-pane -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button class="btn-sm btn btn-secondary my-3" data-toggle="modal" data-target="#chats">ارسال پیام</button>
                                <div class="modal mt-5" id="chats">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                              <h6>پیام خود رابنویسید</h6>
                                                <button class="btn btn-default btn-sm" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('chats.store') }}" method="post">
                                                    @csrf
                                                    <textarea name="content"  rows="4" class="form-control @error('content') is-invalid @enderror" placeholder="پیام خود را بنویسید"></textarea>
                                                    @error('content')
                                                    <span class="text-danger small d-block">{{ $message }}</span>
                                                    @enderror
                                                    <button class=" btn btn-secondary btn-block  mt-2" type="submit">ارسال پیام</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-footer-->
                        </div>
                        <!--/.direct-chat -->

                        <!-- /.card -->
                    </section>

                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
