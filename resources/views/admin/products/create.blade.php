@extends('layouts.admin.front')
@section('title','ایجاد یا ویرایش  محصول')
@section('content')
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1">
                @isset($product)
                    ویرایش محصول
                @else
                    ایجاد محصول
                @endisset
            </span>
        </div>
    <div class="card-body">
        <form action="{{ isset($product) ? route('products.update',$product->id) : route('products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @isset($product)
                @method('PUT')
            @endisset
            <div class="form-group mb-3">
                <label for="1" class="mb-1">برند محصول را انتخاب کنید:</label>
                <select name="brand_id" id="1" class="form-control @error('brand_id') is-invalid @enderror">
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}"  @isset($product) @if($product->brand_id == $brand->id) selected @endif @endisset>{{ $brand->name }}</option>
                        @endforeach
                </select>
                @error('brand_id')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="1" class="mb-1">دسته بندی محصول را انتخاب کنید:</label>
                <select name="category_id" id="1" class="form-control @error('category_id') is-invalid @enderror">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"  @isset($product) @if($product->category_id == $category->id) selected @endif @endisset>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="1" class="mb-1"> برچسپ محصول را انتخاب کنید:</label>
                <select name="tags[]" id="1" class="form-control @error('tags') is-invalid @enderror" multiple>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}"
                                @isset($product)
                            @foreach($product->tags_product() as $tag_id)
                                 @if($tag_id == $tag->id)
                                 selected
                                 @endif
                            @endforeach
                                @endisset
                        >{{ $tag->name }}</option>
                    @endforeach
                </select>
                @error('tags')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>



            <div class="form-group mb-3">
                <label for="1" class="mb-1">نام  محصول(به فارسی) را وارد کنید:</label>
                <input type="text" id="1" class="form-control @error('title_fa') is-invalid @enderror" placeholder="نام محصول   را  به فارسی وارد کنید" name="title_fa" value="{{ isset($product) ? $product->title_fa : old('title_fa') }}">
                @error('title_fa')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="2" class="mb-1">نام  محصول(به انگلیسی) را وارد کنید:</label>
                <input type="text" id="2" class="form-control @error('title_en') is-invalid @enderror" placeholder="نام محصول   را به انگلیسی وارد کنید" name="title_en" value="{{ isset($product) ? $product->title_en : old('title_en') }}">
                @error('title_en')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="2" class="mb-1">تصویر اصلی محصول را انتخاب کنید:</label>
                <input type="file" id="2" class="form-control @error('image1') is-invalid @enderror"  name="image1" >
                @error('image1')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="2" class="mb-1">تصویر دوم محصول را انتخاب کنید:</label>
                <input type="file" id="2" class="form-control @error('image2') is-invalid @enderror"  name="image2" >
                @error('image2')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="2" class="mb-1">تصویر سوم محصول را انتخاب کنید:</label>
                <input type="file" id="2" class="form-control @error('image3') is-invalid @enderror"  name="image3" >
                @error('image3')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="2" class="mb-1">تصویر چهارم محصول را انتخاب کنید:</label>
                <input type="file" id="2" class="form-control @error('image4') is-invalid @enderror"  name="image4" >
                @error('image4')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            @isset($product)
                <div class="mt-4 mb-5 col-md-12 d-flex gap-xl-1">
                    <div class="col-md-3 d-flex flex-column">
                        <img src="{{ asset('storage/'.$product->image1) }}" width="100%" height="100%" class="rounded shadow ">
                        <span class="text-danger">عکس اصلی</span>
                    </div>
                    <div class="col-md-3 flex-column-reverse">
                        <img src="{{ asset('storage/'.$product->image2) }}" width="100%" height="100%" class="rounded shadow">
                        <span class="text-danger">عکس دوم</span>
                    </div>
                    <div class="col-md-3 flex-column-reverse">
                        <img src="{{ asset('storage/'.$product->image3) }}" width="100%" height="100%" class="rounded shadow">
                        <span class="text-danger">عکس سوم</span>
                    </div>
                    <div class="col-md-3 flex-column-reverse">
                        <img src="{{ asset('storage/'.$product->image4) }}" width="100%" height="100%" class="rounded shadow">
                        <span class="text-danger">عکس چهارم</span>
                    </div>

                </div>
            @endisset
            <div class="form-group mb-3">
                <label for="1" class="mb-1">رنگ های محصول را انتخاب کنید:(<span class="text-success">با - رنگ ها را از هم جدا کنید</span>)</label>
                <textarea name="colors" id="1" class="form-control @error('colors') is-invalid @enderror" rows="3">{{ isset($product) ? $product->colors : old('colors') }}</textarea>
                @error('colors')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="1" class="mb-1">نام گارانتی محصول را وارد کنید:</label>
                <input type="text" id="1" class="form-control @error('gr') is-invalid @enderror" placeholder="نام گارانتی محصول را وارد کنید" name="gr" value="{{ isset($product) ? $product->gr : old('gr') }}">
                @error('gr')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            @php
            if($product->markets->count()){
                         $productBymarketid = $product->markets->toArray();
                $forosh = $productBymarketid[0]['name'];
            }
            @endphp
            <div class="form-group mb-3">
                <label for="1" class="mb-1">نام فروشنده محصول را وارد کنید:</label>
                <input type="text" id="1" class="form-control @error('forosh') is-invalid @enderror" placeholder="نام فروشنده محصول را وارد کنید" name="forosh"
                     @if(is_numeric($product->forosh))
                         value="{{ $forosh }}"
                     @else
                           value="{{ $product->forosh }}"
                     @endif
                >
                @error('forosh')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="1" class="mb-1"> قیمت محصول را وارد کنید:</label>
                <input type="text" id="1" class="form-control @error('price') is-invalid @enderror" placeholder="قیمت محصول را وارد کنید" name="price" value="{{ isset($product) ? $product->price : old('price') }}">
                @error('price')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="1" class="mb-1"> تخفیف(قیمت جدید) برای این محصول  وارد کنید(<span class="text-success">درصورت نیاز</span>):</label>
                <input type="text" id="1" class="form-control @error('takhfif') is-invalid @enderror" placeholder=" قیمت جدید محصول را وارد کنید" name="takhfif" value="{{ isset($product) ? $product->takhfif : old('takhfif') }}">
                @error('takhfif')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="description" class="mb-1">توضیحات محصول را وارد کنید:</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="6">{{ isset($product) ? $product->description : old('description') }}</textarea>
                @error('description')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
                <script>
                    CKEDITOR.replace('description',{
                       language :"fa"
                    });
                </script>
            </div>
            <div class="form-group mb-3">
                <label for="1" class="mb-1">ویژگی های محصول را وارد کنید:(<span class="text-success">با - ویژگی ها را از هم جدا کنید</span>)</label>
                <textarea name="attributes" id="1" class="form-control @error('attributes') is-invalid @enderror" rows="3">{{ isset($product) ? $product->attributes : old('attributes') }}</textarea>
                @error('attributes')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            @isset($product)
                <div class="form-group mt-2 mb-3">
                    <label for="3" class="mb-1">وضعیت نمایش  محصول را انتخاب کنید:</label>
                    <select name="status" id="3" class="form-control">
                        @foreach($statuses as $key=>$status)
                            <option value="{{ $key }}" @if($key== $product->status) selected @endif>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            @endisset
            <div class="form-group mb-3">
                <button class="btn btn-danger btn-sm">
                    @isset($product)
                        ویرایش
                    @else
                        ایجاد
                    @endisset
                </button>
            </div>
        </form>
    </div>
    </div>
@endsection
