@extends('layouts.admin.front')
@section('title','فروشگاه های کاربران ')
@section('content')
    <div dir="rtl">@include('layouts.message')</div>
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1">فروشگاه های کاربران</span>
        </div>
        <div class="card-body">
            <table class="table table-borderless text-center">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th> نام</th>
                    <th> تصویر</th>
                    <th> وضعیت</th>
                    <th> کاربر</th>
                    <th> ویرایش</th>
                    <th>حذف </th>
                </tr>
                </thead>
                <tbody>

               @foreach($markets as $market)
                    <tr>
                        <td>#{{ $market->id }}</td>
                        <td>{{ $market->name }}</td>
                        <td>
                            <img src="{{ asset('storage/'.$market->image) }}" width="60" height="40" class="rounded shadow">
                        </td>
                        <td>
                           @if($market->status ==0)
                               <span class="small text-primary"> نامشخص</span>
                            @elseif($market->status ==1)
                                <span class="small text-danger"> عدم تایید</span>
                            @else
                                <span class="small text-success"> تایید</span>
                            @endif
                        </td>
                        <td>{{ $market->user->name }}</td>
                        <td>
                            <a href="{{ route('users-markets.edit',$market->id) }}" class="btn btn-primary btn-sm">ویرایش</a>
                        </td>
                        <td>
                            <form action="{{ route('users-markets.destroy',$market->id) }}" method="post">
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
    {{ $markets->links() }}

@endsection
