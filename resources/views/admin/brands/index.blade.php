@extends('layouts.admin.front')
@section('title','برند ها')
@section('content')
    <div dir="rtl">@include('layouts.message')</div>
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1"> برند ها</span>
            <a href="{{ route('brands.create') }}" class="btn btn-danger btn-sm  float-left">افزون برند</a>
        </div>
        <div class="card-body">
            <table class="table table-borderless text-center">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th> نام</th>
                    <th> تصویر</th>
                    <th> لینک</th>
                    <th> وضعیت</th>
                    <th> ویرایش</th>
                    <th>حذف </th>
                </tr>
                </thead>
                <tbody>

               @foreach($brands as $brand)
                    <tr>
                        <td>#{{ $brand->id }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>
                            <img src="{{ asset('storage/'.$brand->image) }}" width="60" height="40" class="rounded shadow">
                        </td>
                        <td>
                            <a title="{{ $brand->link }}" href="{{ $brand->link }}" class="small text-danger">مشاهده لینک</a>
                        </td>
                        <td>
                            @if($brand->status==0)
                                <span class="small text-danger">عدم تایید مجوز </span>
                            @else
                                <span class="small text-success">تایید مجوز </span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('brands.edit',$brand->id) }}" class="btn btn-primary btn-sm">ویرایش</a>
                        </td>
                        <td>
                            <form action="{{ route('brands.destroy',$brand->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-dark btn-sm">حذف</button>
                            </form>
                        </td>
                    </tr>
               @endforeach
                </tbody>
            </table>
        </div>
    </div><br>
    {{ $brands->links() }}

@endsection
