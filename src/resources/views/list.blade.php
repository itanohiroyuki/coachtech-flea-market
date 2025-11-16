@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/list.css') }}">
@endsection

@section('content')
    <div class="all-contents">
        <div class="products-list">
            <div class="products-list__inner">
                <a class="best {{ $tab === 'best' ? 'active' : '' }}" href="{{ url('/') }}">おすすめ</a>
                <a class="mylist {{ $tab === 'mylist' ? 'active' : '' }}" href="{{ url('/?tab=mylist') }}">マイリスト</a>
            </div>
        </div>

        <div class="product-contents">
            @if ($products->isEmpty())
                <p class="no-products">
                    {{ $tab === 'mylist' ? '' : '' }}
                </p>
            @else
                @foreach ($products as $product)
                    <div class="product-content">
                        <a href="/item/{{ $product->id }}" class="product-link">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="商品画像" class="product-image" />
                            @if ($product->status === 'sold')
                                <span class="sold-label">SOLD</span>
                            @endif
                            <div class="detail-content">
                                <p class="product-name">{{ $product->name }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
