@extends('layouts.users.front')
@section('title',' ایجاد یا ویرایش فروشگاه  ')
@section('content')
    <div class="content-wrapper mt-4">
        <div class="card card-default" dir="rtl">
            <div class="card-header d-flex justify-content-between">
            <span class="mt-1">
                @isset($market)
                    ویرایش فروشگاه
                @else
                    افزون فروشگاه
                @endisset
            </span>
            </div>
            <div class="card-body">
                <form action="{{ isset($market) ? route('markets.update',$market->id) : route('markets.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @isset($market)
                        @method('PUT')
                    @endisset
                    <div class="form-group mb-3">
                        <label for="1" class="mb-1">نام  : </label>
                        <input type="text" placeholder="نام فروشگاه خود را بنویسید" id="1" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($market) ? $market->name : old('name') }}" >
                        @error('name')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="1" class="mb-1">لوگو  : </label>
                        <input type="file" id="1" class="form-control @error('image') is-invalid @enderror" name="image"  >
                        @error('image')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                    @isset($market)
                        <div class="form-group my-3">
                            <img src="{{ asset('storage/'.$market->image) }}" class="rounded shadow" width="100%" height="100%">
                        </div>
                    @endisset
                    <div class="form-group mb-3">
                        <label for="description" class="mb-1">توضیحات  :</label>
                        <textarea name="description"  class="form-control @error('description') is-invalid @enderror" rows="6">{{ isset($market) ? $market->description : old('description') }}</textarea>
                        @error('description')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                        <script>
                            CKEDITOR.replace('description',{
                               language:'fa'
                            });
                        </script>
                    </div>


                    <div class="form-group mb-3">
                        <button class="btn btn-danger btn-sm">
                            @isset($market)
                                ویرایش
                            @else
                                افزون
                            @endisset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
