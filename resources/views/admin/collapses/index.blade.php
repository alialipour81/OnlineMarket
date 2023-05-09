@extends('layouts.admin.front')
@section('title','باکس ها')
@section('content')
    <div dir="rtl">@include('layouts.message')</div>
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1"> باکس ها({{$product->title_fa}})</span>
            <a href="{{ route('collapses.create') }}" class="btn btn-danger btn-sm  float-left">افزون باکس</a>
        </div>
        <div class="card-body">
            <table class="table table-borderless text-center">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th> نام  </th>
                    <th>توضیحات</th>
                    <th> وضعیت</th>
                    <th> ویرایش</th>
                    <th>حذف </th>
                </tr>
                </thead>
                <tbody>

                @foreach($collapses as $collapse)
                    <tr>
                        <td>#{{ $collapse->id }}</td>
                        <td>{{ $collapse->name }}</td>
                        <td>
                            {!! \Illuminate\Support\Str::limit(strip_tags($collapse->description),80)  !!}
                        </td>
                        <td>
                            @if($collapse->status==0)
                                <span class="small text-danger">عدم نمایش   </span>
                            @else
                                <span class="small text-success">نمایش  </span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('collapses.edit',$collapse->id) }}" class="btn btn-primary btn-sm">ویرایش</a>
                        </td>
                        <td>
                            <form action="{{ route('collapses.destroy',$collapse->id) }}" method="post">
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
    {{ $collapses->links() }}

@endsection
