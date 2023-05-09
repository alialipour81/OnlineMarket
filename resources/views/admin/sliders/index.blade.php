@extends('layouts.admin.front')
@section('title','اسلایدر ها')
@section('content')
    <div dir="rtl">@include('layouts.message')</div>
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1"> اسلایدر ها</span>
            <a href="{{ route('sliders.create') }}" class="btn btn-danger btn-sm  float-left">افزون اسلایدر</a>
        </div>
        <div class="card-body">
            <table class="table table-borderless text-center">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th> نام</th>
                    <th> تصویر</th>
                    <th>لینک</th>
                    <th> وضعیت </th>
                    <th> ویرایش</th>
                    <th>حذف </th>
                </tr>
                </thead>
                <tbody>

               @foreach($sliders as $slider)
                    <tr>
                        <td>#{{ $slider->id }}</td>
                        <td>{{ $slider->name }}</td>
                        <td>
                            <img src="{{ asset('storage/'.$slider->image) }}" width="60" height="40" class="rounded shadow">
                        </td>
                        <td>
                            <a title="{{ $slider->link }}" href="{{ $slider->link }}" class="small text-danger">مشاهده لینک</a>
                        </td>
                       <td>
                           @if($slider->status == 0)
                               <span class="small text-danger">عدم نمایش</span>
                           @else
                               <span class="small text-success"> نمایش</span>
                           @endif
                       </td>
                        <td>
                            <a href="{{ route('sliders.edit',$slider->id) }}" class="btn btn-primary btn-sm">ویرایش</a>
                        </td>
                        <td>
                            <form action="{{ route('sliders.destroy',$slider->id) }}" method="post">
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
    {{ $sliders->links() }}

@endsection
