@extends('layouts.admin.front')
@section('title','دسته بندی ها')
@section('content')
    <div dir="rtl">@include('layouts.message')</div>
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1"> دسته بندی ها</span>
            <a href="{{ route('categories.create') }}" class="btn btn-danger btn-sm  float-left">افزون دسته بندی</a>
        </div>
        <div class="card-body">
            <div>
                رنگ سبز=  <span class="text-success">زیر دسته بندی اصلی</span><br>
                رنگ قرمز= <span class="text-danger">زیر دسته بندی(زیر دسته بندی اصلی)</span>
            </div>
            <table class="table table-borderless text-center">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th> نام(دسته بندی اصلی)</th>
                    <th> وضعیت</th>
                    <th> ویرایش</th>
                    <th>حذف </th>
                </tr>
                </thead>
                <tbody>

                 @foreach($categories as $category)
                    <tr>
                        <td>#{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>

                      @if($category->parents()->count())
                                @foreach($category->parents as $parent)
                                    <span class="d-block text-success" title=" زیر دسته بندی اصلی">{{ $parent->name }}</span>
                                    @foreach($parent->parents as $parent2)
                                        <span class="d-block text-danger small" title="زیر دسته بندی">{{ $parent2->name }}</span>
                                    @endforeach
                                @endforeach
                            @else
                          <span class="d-block text-secondary">بدون زیر دسته بندی</span>
                            @endif

                        </td>
                        <td>
                            <a href="{{ route('categories.edit',$category->id) }}" class="btn btn-primary btn-sm">ویرایش</a>
                        </td>
                        <td>
                            <form action="{{ route('categories.destroy',$category->id) }}" method="post">
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
    {{ $categories->links() }}

@endsection
