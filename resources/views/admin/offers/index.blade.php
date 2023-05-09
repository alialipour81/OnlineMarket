@extends('layouts.admin.front')
@section('title','پیشنهادات لحظه ای  ')
@section('content')
    <div dir="rtl">@include('layouts.message')</div>
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1"> پیشنهادات لحظه ای </span>
            <a href="{{ route('offers.create') }}" class="btn btn-danger btn-sm  float-left">افزون محصول به پیشنهادات لحظه ای </a>
        </div>
        <div class="card-body">
            <table class="table table-borderless text-center">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th> محصول</th>
                    <th> وضعیت</th>
                    <th> ویرایش</th>
                    <th>حذف </th>
                </tr>
                </thead>
                <tbody>

                 @foreach($offers as $offer)
                    <tr>
                        <td>#{{ $offer->id }}</td>
                        <td>{{ $offer->product->title_fa }}</td>
                        <td>
                            @if($offer->status==0)
                                <span class="text-danger small">عدم نمایش</span>
                            @else
                            <span class="text-success small"> نمایش</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('offers.edit',$offer->id) }}" class="btn btn-primary btn-sm">ویرایش</a>
                        </td>
                        <td>
                            <form action="{{ route('offers.destroy',$offer->id) }}" method="post">
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
    {{ $offers->links() }}

@endsection
