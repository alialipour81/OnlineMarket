@extends('layouts.basketbuy.front')
@section('title','سبدخرید')
@section('content_basketbuy')
    <div class="cart-page-title">
        <h1>سبد خرید</h1>
    </div>
    <div class="table-responsive checkout-content default">
        <table class="table">
            <tbody>
            @forelse($items as $item)
                <tr class="checkout-item">
                    <td>
                        <img src="{{ asset('storage/'.$item->attributes->image) }}" width="100" height="100" class="rounded">
                        <form action="{{ route('carts.remove') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <button class="checkout-btn-remove btn-outline-danger" type="submit"></button>
                        </form>
                    </td>
                    <td>
                        <h3 class="checkout-title">
                            {{ $item->name }}
                        </h3>
                    </td>
                    <td>
                        <form action="{{ route('carts.update') }}" method="post">
                            @csrf
                            <input type="number" name="quantity" value="{{$item->quantity}}">
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <button class="btn btn-primary btn-sm" title="ذخیره تعداد">
                                <i class="fa fa-arrow-up"></i>
                            </button>
                        </form>
                    </td>
                    <td>{{number_format($item->price)}} تومان</td>
                    <td>
                        <span class="text-danger d-block">جمع کل:</span>
                        <span>{{number_format($item->price*$item->quantity)}}تومان </span>
                    </td>
                </tr>
            @empty
                <div class="alert alert-danger rounded p1 shadow">سبد خرید خالی است</div>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($items->count())
        <form action="{{ route('carts.clear') }}" method="post">
            @csrf
            <button class="btn btn-danger rounded">
                پاک کردن همه محصولات
                <i class="fa fa-trash-o"></i>
            </button>
        </form>

    @endif
@endsection
