@extends('layouts.admin.front')
@section('title','لیست افراد خواهان ایمیل')
@section('content')
    <div dir="rtl">@include('layouts.message')</div>
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1"> لیست افراد خواهان ایمیل </span>
            <a href="{{ route('emails.page_sendemail') }}" class="btn btn-outline-warning btn-sm  float-left">ارسال ایمیل</a>
            <a href="{{ route('emails.create') }}" class="btn btn-danger btn-sm  float-left">افزون</a>
        </div>
        <div class="card-body">
            <table class="table table-borderless text-center">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>نام</th>
                    <th> ایمیل</th>
                    <th> ویرایش</th>
                    <th>حذف </th>
                </tr>
                </thead>
                <tbody>

               @foreach($emails as $email)
                    <tr>
                        <td>#{{ $email->id }}</td>
                        <td>
                            @if($user=\App\Models\User::where('email',$email->email)->first())
                                <span class="text-success">{{ $user->name }}</span>
                            @else
                                <span>نامشخص</span>
                            @endif
                        </td>
                        <td>{{ $email->email }}</td>
                        <td>
                            <a href="{{ route('emails.edit',$email->id) }}" class="btn btn-primary btn-sm">ویرایش</a>
                        </td>
                        <td>
                            <form action="{{ route('emails.destroy',$email->id) }}" method="post">
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
    {{ $emails->links() }}

@endsection
