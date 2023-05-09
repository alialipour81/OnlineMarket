@extends('layouts.admin.front')
@section('title','برچسپ ها')
@section('content')
    <div dir="rtl">@include('layouts.message')</div>
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1"> برچسپ ها</span>
            <a href="{{ route('tags.create') }}" class="btn btn-danger btn-sm  float-left">افزون برچسپ</a>
        </div>
        <div class="card-body">
            <table class="table table-borderless text-center">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th> نام</th>
                    <th> ویرایش</th>
                    <th>حذف </th>
                </tr>
                </thead>
                <tbody>

               @foreach($tags as $tag)
                    <tr>
                        <td>#{{ $tag->id }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>
                            <a href="{{ route('tags.edit',$tag->id) }}" class="btn btn-primary btn-sm">ویرایش</a>
                        </td>
                        <td>
                            <form action="{{ route('tags.destroy',$tag->id) }}" method="post">
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
    {{ $tags->links() }}

@endsection
