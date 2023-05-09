@extends('layouts.admin.front')
@section('title','کاربران')
@section('content')
    <div dir="rtl">@include('layouts.message')</div>
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1"> کاربران  </span>
        </div>
        <div class="card-body">
            <table class="table table-borderless text-center">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th> نام</th>
                    <th> ایمیل</th>
                    <th> وضعیت ایمیل</th>
                    <th>  نقش کاربری</th>
                    <th> کدملی</th>
                    <th> ویرایش</th>
                    <th>حذف </th>
                </tr>
                </thead>
                <tbody>

                @foreach($users as $user)
                    <tr>
                        <td>#{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->email_verified_at == null)
                                <span class="text-danger small"> تایید نشده</span>
                            @else
                                <span class="text-success small">  تایید شده</span>
                            @endif
                        </td>
                        <td>
                            @if($user->role == 'user')
                                <span class="text-secondary small">کاربر </span>
                            @else
                                <span class="text-primary small"> ادمین</span>
                            @endif
                        </td>
                        <td>
                         {{ $user->code_meli }}
                        </td>
                        <td>
                            <a href="{{ route('users.edit',$user->id) }}" class="btn btn-primary btn-sm">ویرایش</a>
                        </td>
                        <td>
                            <form action="{{ route('users.destroy',$user->id) }}" method="post">
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
    {{ $users->links() }}

@endsection
