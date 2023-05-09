@extends('layouts.admin.front')
@section('title','  ویرایش  کاربر')
@section('content')
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1">
                    ویرایش کاربر
            </span>
        </div>
        <div class="card-body">
            <form action="{{  route('users.update',$user->id)  }}" method="post" >
                @csrf
                    @method('PUT')
                <div class="form-group mb-3">
                    <label for="1" class="mb-1">نام  کاربر را وارد کنید:</label>
                    <input type="text" id="1" class="form-control @error('name') is-invalid @enderror" placeholder="نام کاربر   را وارد کنید" name="name" value="{{  $user->name }}">
                    @error('name')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="1" class="mb-1">ایمیل  کاربر را وارد کنید:</label>
                    <input type="email" id="1"  class="form-control @error('email') is-invalid @enderror" placeholder=" ایمیل کاربر  را وارد کنید" name="email" value="{{ $user->email  }}">
                    @error('email')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="3" class="mb-1">نقش  کاربری را انتخاب کنید:</label>
                    <select name="role" id="3" class="form-control @error('role') is-invalid @enderror">
                        @foreach($statuses as $key=>$status)
                            <option value="{{ $key }}" @if($key== $user->role) selected @endif>{{ $status }}</option>
                        @endforeach
                    </select>
                    @error('role')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputName2" class="col-sm-4 control-label">  شماره تلفن یا موبایل:</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('number_phone') is-invalid @enderror" id="inputName2" placeholder="شماره تلفن یا موبایل خود را وارد کنید" name="number_phone" value="{{ $user->phone}}">
                        @error('number_phone')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <span class="text-secondary is-invalid">فیلد  شماره تلفن یا موبایل را  ابتدا بدون صفر وارد کنید</span>
                <div class="form-group">
                    <label for="inputName2" class="col-sm-2 control-label">کد ملی:</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('code_meli') is-invalid @enderror" id="inputName2" placeholder="کد ملی خود را وارد کنید" name="code_meli" value="{{ $user->code_meli }}">
                        @error('code_meli')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName2" class="col-sm-2 control-label"> شماره کارت:</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('card') is-invalid @enderror" id="inputName2" placeholder="شماره کارت  خود را وارد کنید" name="card" value="{{ $user->card }}">
                        @error('card')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName2" class="col-sm-2 control-label"> تعیین رمز جدید :</label>

                    <div class="col-sm-10">
                        <input type="password" class="form-control @error('newpassword') is-invalid @enderror" id="inputName2" placeholder=" رمز جدید را وارد کنید" name="newpassword" >
                        @error('newpassword')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-3 mt-2">
                    <button class="btn btn-danger btn-sm">
                            ویرایش
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
