@extends('layouts.users.front')
@section('title',' محصولات')
@section('content')
    <div class="content-wrapper mt-4">
    <div dir="rtl">@include('layouts.message')</div>
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1"> محصولات </span>
            <a href="{{ route('user-products.create') }}" class="btn btn-outline-info btn-sm  float-left">افزون محصول</a>
        </div>
        <div class="card-body">
            <table class="table table-borderless text-center">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th> نام محصول(فارسی)</th>
                    <th>  تصویر اصلی</th>
                    <th>دسته بندی</th>
                    <th> قیمت</th>
                    <th> وضعیت</th>
                    <th> تخفیف به درصد (%)</th>
                    <th>باکس</th>
                    <th> ویرایش</th>
                    <th>حذف </th>
                </tr>
                </thead>
                <tbody>

               @foreach($products as $product)
                    <tr>
                        <td>#{{ $product->id }}</td>
                        <td>{{ $product->title_fa }}</td>
                        <td>
                            <img src="{{ asset('storage/'.$product->image1) }}" width="60" height="40" class="rounded shadow">
                        </td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ number_format($product->price) }}تومان</td>

                        <td>
                            @if($product->status==0)
                                <span class="small text-danger">عدم نمایش   </span>
                            @else
                                <span class="small text-success">نمایش  </span>
                            @endif
                        </td>
                        <td>
                            @if($product->takhfif ==0)
                                <span class="small text-primary">تخفیف ندارد  </span>
                            @else
                                <span class="small text-success">{{ round($product->parcent($product->price,$product->takhfif) ) }}   </span>
                            @endif
                        </td>
                           <td>
                               <a href="{{ route('user-collapses.index2',$product->slug) }}" class="btn-sm btn btn-secondary">باکس</a>
                           </td>

                        <td>
                            <a href="{{ route('user-products.edit',$product->title_fa) }}" class="btn btn-primary btn-sm">ویرایش</a>
                        </td>
                        <td>
                            <form action="{{ route('user-products.destroy',$product->title_fa) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">حذف</button>
                            </form>
                        </td>
                    </tr>
               @endforeach
                </tbody>
            </table>
        </div>
    </div><br>
    {{ $products->links() }}
    </div>
@endsection
