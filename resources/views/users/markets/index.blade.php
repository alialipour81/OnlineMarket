@extends('layouts.users.front')
@section('title','ثبت فروشگاه')
@section('content')
    <div class="content-wrapper mt-4">
        @include('layouts.message')
        <a href="{{ route('markets.create') }}" class="btn btn-success btn-sm small mr-3 mb-2 mt-1">ساخت فروشگاه جدید <i class="fa fa-plus"></i></a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">ردیف</th>
                <th scope="col">نام</th>
                <th scope="col">تصویر</th>
                <th scope="col">توضحیات</th>
                <th scope="col">کاربر</th>
                <th scope="col">وضعیت</th>
                <th scope="col">ویرایش</th>
                <th scope="col">حذف</th>
            </tr>
            </thead>
            <tbody>
            @foreach($markets as $market)
            <tr>
                <th>#{{$market->id}}</th>
                <td>{{ $market->name }}</td>
                <td>
                    <img src="{{ asset('storage/'.$market->image) }}" class="shadow rounded" width="60" height="40">
                </td>
                <td>{{ \Illuminate\Support\Str::limit(strip_tags($market->description),150) }}</td>
                <td>{{ $market->user->name }}</td>
                <td>
                    @if($market->status == 0)
                        <span class="small text-primary">در حال بررسی</span>
                    @elseif($market->status == 1)
                        <span class="small text-danger">تایید نشده</span>
                    @else
                        <span class="small text-success">تایید شده</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('markets.edit',$market->name) }}" class="btn btn-primary btn-sm">ویرایش</a>
                </td>
                <td>
                    <form action="{{ route('markets.destroy',$market->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
        {{ $markets->links() }}
    </div>

@endsection
