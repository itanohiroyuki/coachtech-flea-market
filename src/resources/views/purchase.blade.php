@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection
@section('content')
    <div class="all-content">
        <div class="left-content">
            <div class="product-content">
                <img class="image" src="{{ asset('storage/' . $product->image) }}" alt="商品画像">
                <div class="product-description">
                    <h2 class="product-name">{{ $product->name }}</h2>
                    <p class="product-price">¥{{ number_format($product->price) }}</p>
                </div>
            </div>
            <div class="payment-content">
                <h3 class="payment-title">支払い方法</h3>
                <select class="payment-select" name="payment" id="payment-select">
                    <option disabled selected>選択してください</option>
                    @foreach ($payments as $payment)
                        <option value="{{ $payment->id }}" {{ old('payment_id') == $payment->id ? 'selected' : '' }}>
                            {{ $payment->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="shipping-address-content">
                <div class="shipping-address-top">
                    <h3 class="title">配送先</h3>
                    <form action="/purchase/address/{{ $product->id }}" method="GET">
                        <button class="address-edit-button">変更する</button>
                    </form>
                </div>
                <div class="address-group">
                    <p class="address">〒{{ $profile->postal_code }}</p>
                    <div class="address-p">
                        <p class="address">{{ $profile->city }}</p>
                        <p class="address">{{ $profile->building }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="right-content">
            <div class="info">
                <div class="info1">
                    <span class="label">商品代金</span>
                    <span class="value">¥{{ number_format($product->price) }}</span>
                </div>
                <div class="info2">
                    <span class="label">支払い方法</span>
                    <span class="value" id="selected-payment"></span>
                </div>
            </div>
            <form action="/purchase/{{ $product->id }}" method="POST">
                @csrf
                <button class="purchase-button" type="submit">購入する</button>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const select = document.getElementById('payment-select');
            const display = document.getElementById('selected-payment');

            select.addEventListener('change', () => {

                const selectedText = select.options[select.selectedIndex].text;

                display.textContent = selectedText;
            });
        });
    </script>
@endsection
