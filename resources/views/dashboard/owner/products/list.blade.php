@extends('dashboard.main')

@push('styles')
    <style>
        /* Container & Filters */
        .shop-container {
            padding: 2rem;
        }

        .filter-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            padding: 1rem 1.5rem;
            margin-bottom: 20px;
        }

        .filter-card input,
        .filter-card select {
            border-radius: 10px;
        }

        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        /* Product Card */
        .product-card {
            background: linear-gradient(145deg, #ffffff, #f1f5f9);
            border-radius: 20px;
            padding: 1rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        /* Product Image */
        .product-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 1rem;
        }

        /* Product Info */
        .product-title {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 0.3rem;
        }

        .product-category {
            color: #6c757d;
            font-size: 0.85rem;
            margin-bottom: 0.3rem;
        }

        .product-price {
            font-weight: 700;
            font-size: 1rem;
            color: #28a745;
            margin-bottom: 0.5rem;
        }

        /* Buttons */
        .btn-view {
            border-radius: 50px;
            font-weight: 600;
            padding: 0.5rem 1rem;
            color: #fff;
            background: #2575fc;
            transition: all 0.3s;
        }

        .btn-view:hover {
            background: linear-gradient(135deg, #2575fc, #1a5edb);
            box-shadow: 0 8px 25px rgba(37, 117, 252, 0.3);
        }

        /* Stock Badge */
        .badge-stock {
            position: absolute;
            top: 15px;
            left: 15px;
            padding: 0.35rem 0.8rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 50px;
            color: #fff;
        }

        .in-stock {
            background-color: #28a745;
        }

        .out-stock {
            background-color: #dc3545;
        }
    </style>
@endpush

@section('content')
    <div class="container shop-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold"><i class="bx bx-package"></i> Product Listings</h2>
            <a href="{{ route('cart.index') }}" class="btn btn-success">
                <i class="bx bx-cart me-1"></i> My Cart</a>
        </div>

        <div class="filter-card mb-4">
            <form method="GET" action="{{ route('shop.index') }}" class="row g-3 align-items-center">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search products..."
                        value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="category" class="form-control">
                        <option value="">All Categories</option>
                        <option value="Food" {{ request('category') == 'Food' ? 'selected' : '' }}>Food</option>
                        <option value="Toys" {{ request('category') == 'Toys' ? 'selected' : '' }}>Toys</option>
                        <option value="Accessories" {{ request('category') == 'Accessories' ? 'selected' : '' }}>Accessories
                        </option>
                        <option value="Medicine" {{ request('category') == 'Medicine' ? 'selected' : '' }}>Medicine</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary"><i class="bx bx-search"></i> Filter</button>
                    <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>

        <div class="product-grid">
            @forelse($products as $product)
                <div class="product-card position-relative">
                    <span class="badge-stock {{ $product->stock_quantity > 0 ? 'in-stock' : 'out-stock' }}">
                        {{ $product->stock_quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                    </span>

                    <img src="{{ $product->pro_img ? asset('storage/' . $product->pro_img) : asset('dashboard/assets/img/avatars/dummy-1.jpeg') }}"
                        alt="{{ $product->name }}">

                    <div>
                        <h5 class="product-title">{{ $product->name }}</h5>
                        <p class="product-category">{{ $product->category }} | Shelter:
                            {{ $product->shelter->shelter_name ?? '-' }}</p>
                        <p class="product-price">${{ number_format($product->price, 2) }}</p>

                        <a href="{{ route('shop.show', $product->id) }}" class="btn btn-view mt-2 w-100">
                            <i class="bx bx-cart"></i> View & Add
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">No products available.</p>
            @endforelse
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
@endsection
