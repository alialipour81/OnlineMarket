@extends('layouts.admin.front')
@section('title',' ارسال ایمیل  ')
@section('content')
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1">
                ارسال ایمیل
            </span>
        </div>
        <div class="card-body">
            <form action="{{ route('emails.send_email') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="1" class="mb-1"> عنوان  را وارد کنید:</label>
                    <input type="text" id="1" class="form-control @error('name') is-invalid @enderror" placeholder="عنوان ایمیل را وارد کنید" name="name" value="{{  old('name') }}">
                    @error('name')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="description1" class="mb-1">توضیحات  را وارد کنید:</label>
                    <textarea name="description" id="description2" class="form-control @error('description') is-invalid @enderror" rows="6">{{  old('description') }}</textarea>
                    @error('description')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                    <script>
                        CKEDITOR.replace('description2',{
                            language :"fa",
                            filebrowserUploadUrl: "{{ route('emails.upload_image',['_token'=>csrf_token()]) }}",
                            filebrowserUploadMethod:'form'

                        });
                    </script>
                </div>
                <div class="form-group mb-3">
                    @error('emails')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                    <h6 class="text-success">ایمیل ها به چه کسانی ارسال شود؟</h6>
                    @foreach($emails as $key=>$email)
                        <div>
                            <input type="checkbox" id="{{$key}}" name="emails[]" value="{{ $email->email }}" class="checkbox">
                            <label for="{{$key}}">{{$email->email}}</label>
                        </div>
                    @endforeach
                </div>

                <div class="form-group mb-3">
                    <button class="btn btn-danger btn-sm">
                      ارسال
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
