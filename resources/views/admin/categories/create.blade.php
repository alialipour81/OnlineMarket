@extends('layouts.admin.front')
@section('title','ایجاد یا ویرایش دسته بندی')
@section('content')
    <div class="card card-default" dir="rtl">
        <div class="card-header d-flex justify-content-between">
            <span class="mt-1">
                @isset($category)
                    ویرایش دسته بندی
                @else
                    ایجاد دسته بندی
                @endisset
            </span>
        </div>
    <div class="card-body">
        <form action="{{ isset($category) ? route('categories.update',$category->id) : route('categories.store') }}" method="post">
            @csrf
            @isset($category)
                @method('PUT')
            @endisset
            <div class="form-group mb-3">
                <label for="1" class="mb-1">نام دسته بندی را وارد کنید:</label>
                <input type="text" id="1" class="form-control @error('name') is-invalid @enderror" placeholder="عنوان دسته بندی را وارد کنید" name="name" value="{{ isset($category) ? $category->name : old('name') }}">
                @error('name')
                <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="2" class="mb-1"> دسته بندی را انتخاب  کنید:</label>
                <select name="parent_id" class="form-control" id="2">
                    <option value="0" @isset($category) @if($category->parent_id == 0) selected @endif @endisset>دسته بندی اصلی</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" @isset($category) @if($category->parent_id == $cat->id) selected @endif @endisset>{{ $cat->name }}</option>
                          @if($cat->parents()->count())
                              @foreach($cat->parents as $parent)
                        <option value="{{ $parent->id }}" @isset($category) @if($category->parent_id == $parent->id) selected @endif @endisset>{{ $parent->name }}</option>
                              @endforeach
                          @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <button class="btn btn-danger btn-sm">
                    @isset($category)
                        ویرایش
                    @else
                        ایجاد
                    @endisset
                </button>
            </div>
        </form>
     @if(request()->url() != route('categories.create') && $category->parents()->count())
            <hr>
            <table class="table table-borderless text-center">
                <thead>
                <tr>
                    <th> نام دسته بندی </th>
                    <th> ویرایش</th>
                    <th>حذف </th>
                </tr>
                </thead>
                <tbody>
                @foreach($category->parents as $parent)
                    <tr>
                        <td>
                            <span class="text-success">{{ $parent->name }}</span>
                        </td>
                        <td>
                            <a href="{{ route('categories.edit',$parent->id) }}" class="btn btn-primary btn-sm">ویرایش</a>
                        </td>
                        <td>
                            <form action="{{ route('categories.destroy',$parent->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-dark btn-sm">حذف</button>
                            </form>
                        </td>
                    </tr>
                    @if($parent->parents()->count())
                        @foreach($parent->parents as $zirparent)
                            <tr>
                             <td>
                                 <span class="text-danger">{{ $zirparent->name }}</span>
                             </td>
                                <td>
                                    <a href="{{ route('categories.edit',$zirparent->id) }}" class="btn btn-primary btn-sm">ویرایش</a>
                                </td>
                                <td>
                                    <form action="{{ route('categories.destroy',$zirparent->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-dark btn-sm">حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
    </div>
@endsection
