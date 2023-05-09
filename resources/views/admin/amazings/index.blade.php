@extends('layouts.admin.front')
@section('title','شگفت انگیز ها')
@section('content')
    <div dir="rtl">@include('layouts.message')</div>
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1"> شگفت انگیز ها</span>
            <a href="{{ route('amazings.create') }}" class="btn btn-danger btn-sm  float-left">افزون محصول به شگفت انگیزها</a>
        </div>
        <div class="card-body">
            <table class="table table-borderless text-center">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th> محصول</th>
                    <th> وضعیت</th>
                    <th> تاریخ نمایش</th>
                    <th> ویرایش</th>
                    <th>حذف </th>
                </tr>
                </thead>
                <tbody>

                 @foreach($amazings as $amazing)
                    <tr>
                        <td>#{{ $amazing->id }}</td>
                        <td>{{ $amazing->product->title_fa }}</td>
                        <td>
                            @if($amazing->status==0)
                                <span class="text-danger small">عدم نمایش</span>
                            @else
                            <span class="text-success small"> نمایش</span>
                            @endif
                        </td>
                        <td>{{ verta($amazing->date)->format('Y/m/d') }}</td>
                        <td>
                            <a href="{{ route('amazings.edit',$amazing->id) }}" class="btn btn-primary btn-sm">ویرایش</a>
                        </td>
                        <td>
                            <form action="{{ route('amazings.destroy',$amazing->id) }}" method="post">
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
    {{ $amazings->links() }}

@endsection
