@extends('dashboard.main')

@push('styles')
    <style>
        /* Container */
        .product-detail {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            background: linear-gradient(145deg, #f0f4ff, #e6f0ff);
            padding: 2rem;
            border-radius: 25px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        /* Image */
        .product-img {
            max-width: 450px;
            width: 100%;
            border-radius: 20px;
            object-fit: cover;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }

        .product-img:hover {
            transform: scale(1.05);
        }

        /* Product Info */
        .product-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-title {
            font-size: 2rem;
            font-weight: 900;
            color: #222;
            margin-bottom: 0.5rem;
        }

        .product-category,
        .product-shelter {
            font-size: 0.95rem;
            color: #555;
            margin-bottom: 0.3rem;
        }

        .product-price {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2575fc;
            margin-bottom: 1rem;
        }

        .product-description {
            font-size: 1rem;
            color: #444;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        /* Stock status */
        .stock-status {
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        .in-stock {
            color: #2ecc71;
        }

        .out-stock {
            color: #dc3545;
        }

        /* Quantity selector */
        .quantity-selector {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .quantity-selector button {
            width: 45px;
            height: 45px;
            border: none;
            background-color: #ddd;
            font-size: 1.3rem;
            cursor: pointer;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .quantity-selector button:hover {
            background-color: #2575fc;
            color: #fff;
        }

        .quantity-selector input {
            width: 75px;
            text-align: center;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 6px;
        }

        /* Add to cart button */
        .btn-cart {
            border-radius: 50px;
            font-weight: 700;
            padding: 0.7rem 2rem;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            background: #2575fc;
            color: #fff;
            border: none;
        }

        .btn-cart:hover {
            background: linear-gradient(135deg, #1a5edb, #2575fc);
            box-shadow: 0 10px 25px rgba(37, 117, 252, 0.4);
        }

        .btn-back {
            margin-bottom: 2rem;
            border-radius: 50px;
            padding: 0.6rem 1.8rem;
            font-weight: 600;
            background: #2575fc;
            color: #fff;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: #1a5edb;
        }

        /* Responsive */
        @media(max-width: 992px) {
            .product-detail {
                flex-direction: column;
                align-items: center;
            }

            .product-img {
                max-width: 100%;
            }

            .product-info {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <a href="{{ route('shop.index') }}" class="btn btn-back"><i class="bx bx-left-arrow-alt"></i> Back to Shop</a>

        <div class="product-detail">
            {{-- Product Image --}}
            <img src="{{ $product->pro_img ? asset('storage/' . $product->pro_img) : asset('dashboard/assets/img/avatars/dummy-1.jpeg') }}"
                alt="{{ $product->name }}" class="product-img">

            {{-- Product Info --}}
            <div class="product-info">
                <div>
                    <h2 class="product-title">{{ $product->name }}</h2>
                    <p class="product-category">Category: {{ $product->category }}</p>
                    <p class="product-shelter">Shelter: {{ $product->shelter->shelter_name ?? '-' }}</p>
                    <p class="product-price">${{ number_format($product->price, 2) }}</p>
                    <p class="product-description">{{ $product->description }}</p>

                    {{-- Stock --}}
                    <p class="stock-status {{ $product->stock_quantity > 0 ? 'in-stock' : 'out-stock' }}">
                        @if ($product->stock_quantity > 0)
                            In Stock ({{ $product->stock_quantity }} left)
                        @else
                            Out of Stock
                        @endif
                    </p>
                </div>

                @if ($product->stock_quantity > 0)
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <div class="quantity-selector">
                            <button type="button" onclick="decreaseQuantity()">-</button>
                            <input type="number" name="quantity" id="quantity" value="1" min="1"
                                max="{{ $product->stock_quantity }}">
                            <button type="button" onclick="increaseQuantity()">+</button>
                        </div>

                        <button type="submit" class="btn btn-cart">
                            <i class="bx bx-cart"></i> Add to Cart
                        </button>
                    </form>
                @else
                    <button class="btn btn-cart" disabled>Out of Stock</button>
                @endif
            </div>
        </div>
    </div>

    <script>
        const quantityInput = document.getElementById('quantity');

        function increaseQuantity() {
            let current = parseInt(quantityInput.value);
            let max = parseInt(quantityInput.max);
            if (current < max) quantityInput.value = current + 1;
        }

        function decreaseQuantity() {
            let current = parseInt(quantityInput.value);
            if (current > 1) quantityInput.value = current - 1;
        }
    </script>
@endsection
