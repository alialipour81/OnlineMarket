@extends('layouts.admin.front')
@section('title','پوستر ها')
@section('content')
    <div dir="rtl">@include('layouts.message')</div>
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1"> پوستر ها</span>
            <a href="{{ route('posters.create') }}" class="btn btn-danger btn-sm  float-left">افزون پوستر</a>
        </div>
        <div class="card-body">
            <table class="table table-borderless text-center">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th> نام</th>
                    <th> تصویر</th>
                    <th> لینک</th>
                    <th> ویرایش</th>
                    <th>حذف </th>
                </tr>
                </thead>
                <tbody>

               @foreach($posters as $poster)
                    <tr>
                        <td>#{{ $poster->id }}</td>
                        <td>{{ $poster->name }}</td>
                        <td>
                            <img src="{{ asset('storage/'.$poster->image) }}" width="60" height="40" class="rounded shadow">
                        </td>
                        <td>
                            <a title="{{ $poster->link }}" href="{{ $poster->link }}" class="small text-danger">مشاهده لینک</a>
                        </td>
                        <td>
                            <a href="{{ route('posters.edit',$poster->id) }}" class="btn btn-primary btn-sm">ویرایش</a>
                        </td>
                        <td>
                            <form action="{{ route('posters.destroy',$poster->id) }}" method="post">
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
    {{ $posters->links() }}

@endsection
