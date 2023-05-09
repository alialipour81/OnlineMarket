@extends('layouts.admin.front')
@section('title','تخفیف  ها')
@section('content')
    <div dir="rtl">@include('layouts.message')</div>
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1"> تخفیف  ها</span>
            <a href="{{ route('discounts.create') }}" class="btn btn-danger btn-sm  float-left">افزون  کد تخفیف </a>
        </div>
        <div class="card-body">
            <table class="table table-borderless text-center">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th> نام(کد تخفیف)</th>
                    <th> قیمت کسر</th>
                    <th> وضعیت</th>
                    <th> تاریخ اعتبار</th>
                    <th>  وضعیت استفاده</th>
                    <th>   کاربر</th>
                    <th> ویرایش</th>
                    <th>حذف </th>
                </tr>
                </thead>
                <tbody>

                 @foreach($discounts as $discount)
                    <tr>
                        <td>#{{ $discount->id }}</td>
                        <td>{{ $discount->name }}</td>
                        <td>{{ number_format($discount->price) }}تومان</td>
                        <td>
                            @if($discount->status==0)
                                <span class="text-danger small">غیرفعال </span>
                            @else
                            <span class="text-success small"> فعال</span>
                            @endif
                        </td>
                        <td>{{ verta($discount->date)->format('Y/m/d') }}</td>
                        <td>
                            @if($discount->use== 'true')
                                <span class="text-success small">استفاده شده </span>
                            @else
                                <span class="text-danger small"> استفاده نشده</span>
                            @endif
                        </td>
                        <td>{{ $discount->user->name }}</td>
                        <td>
                            <a href="{{ route('discounts.edit',$discount->id) }}" class="btn btn-primary btn-sm">ویرایش</a>
                        </td>
                        <td>
                            <form action="{{ route('discounts.destroy',$discount->id) }}" method="post">
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
    {{ $discounts->links() }}

@endsection
