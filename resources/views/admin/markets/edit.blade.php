@extends('layouts.admin.front')
@section('title',' ویرایش  فروشگاه')
@section('content')
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1">
                    ویرایش فروشگاه

            </span>
        </div>
    <div class="card-body">
        <form action="{{ route('users-markets.update',$market->id) }}" method="post" enctype="multipart/form-data">
            @csrf
                @method('PUT')
            <div class="form-group mb-3">
                <label for="1" class="mb-1">نام  فروشگاه را وارد کنید:</label>
                <input type="text" id="1" class="form-control @error('name') is-invalid @enderror" placeholder="نام فروشگاه   را وارد کنید" name="name" value="{{  $market->name  }}">
                @error('name')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="2" class="mb-1">تصویر  فروشگاه را انتخاب کنید:</label>
                <input type="file" id="2" class="form-control @error('image') is-invalid @enderror"  name="image" >
                @error('image')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

                <div class="mt-2 mb-2">
                    <img src="{{ asset('storage/'.$market->image) }}" width="100%" height="100%" class="rounded shadow">
                </div>

            <div class="form-group mb-3">
                <label for="description" class="mb-1">توضیحات  :</label>
                <textarea name="description"  class="form-control @error('description') is-invalid @enderror" rows="6">{{ $market->description }}</textarea>
                @error('description')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
                <script>
                    CKEDITOR.replace('description',{
                        language:'fa'
                    });
                </script>
            </div>
            <div class="form-group mt-2 mb-3">
                <label for="3" class="mb-1">وضعیت   فروشگاه را انتخاب کنید:</label>
                <select name="status" id="3" class="form-control">
                    @foreach($statuses as $key=>$status)
                        <option value="{{ $key }}" @if($key== $market->status) selected @endif>{{ $status }}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group mb-3">
                <button class="btn btn-danger btn-sm">
                        ویرایش
                </button>
            </div>
        </form>
    </div>
    </div>
@endsection
