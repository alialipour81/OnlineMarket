@extends('layouts.admin.front')
@section('title','نظرات ')
@section('content')
    <div dir="rtl">@include('layouts.message')</div>
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1"> نظرات ها</span>
        </div>
        <div class="card-body">
            <table class="table table-borderless text-center">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th> محصول</th>
                    <th> کاربر</th>
                    <th> متن نظر</th>
                    <th> وضعیت</th>
                    <th> پاسخ</th>
                    <th> ویرایش</th>
                    <th>حذف </th>
                </tr>
                </thead>
                <tbody>

                 @foreach($comments as $comment)
                    <tr>
                        <td>#{{ $comment->id }}</td>
                        <td>{{ $comment->product->title_fa }}</td>
                        <td>{{ $comment->user->name }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($comment->content,30) }}</td>
                        <td>
                            @if($comment->status==0)
                                <span class="text-danger small">عدم نمایش</span>
                            @else
                            <span class="text-success small"> نمایش</span>
                            @endif
                        </td>
                        <td>
                      @if($comment->child == null)
                                <a href="{{ route('comments.show',$comment->id) }}" class="btn btn-danger btn-sm">({{$comment->replies()->count()}})پاسخ</a>
                        @else
                            <span class="text-primary small"> پاسخ است</span>
                        @endif
                        </td>
                        <td>
                            <a href="{{ route('comments.edit',$comment->id) }}" class="btn btn-primary btn-sm">ویرایش</a>
                        </td>
                        <td>
                            <form action="{{ route('comments.destroy',$comment->id) }}" method="post">
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
    {{ $comments->links() }}

@endsection
