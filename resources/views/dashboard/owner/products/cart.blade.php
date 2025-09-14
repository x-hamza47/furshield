@extends('dashboard.main')

@push('styles')
<style>
/* Container */
.cart-container {
    background: #f0f4ff;
    padding: 2rem;
    border-radius: 25px;
}

/* Cart Item */
.cart-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.2rem 1rem;
    border-radius: 20px;
    background: linear-gradient(145deg, #ffffff, #e6f0ff);
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.cart-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.cart-item img {
    width: 90px;
    height: 90px;
    object-fit: cover;
    border-radius: 15px;
}

/* Cart Item Info */
.cart-item-info {
    flex: 1;
    margin-left: 1.2rem;
}

.cart-item-info h5 {
    font-weight: 700;
    font-size: 1.1rem;
    margin-bottom: 0.3rem;
}

.cart-item-info p {
    margin-bottom: 0.25rem;
    color: #555;
}

/* Remove button */
.cart-item form button {
    border-radius: 50px;
    padding: 0.5rem 1.2rem;
    font-weight: 600;
    border: none;
    background: #dc3545;
    color: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
}

.cart-item form button:hover {
    background: linear-gradient(135deg, #c82333, #dc3545);
    box-shadow: 0 8px 20px rgba(220,53,69,0.3);
}

/* Grand Total */
.cart-total {
    text-align: right;
    margin-top: 2.5rem;
}

.cart-total h4 {
    font-size: 1.6rem;
    font-weight: 700;
    color: #2575fc;
}

/* Checkout button */
.btn-checkout {
    border-radius: 50px;
    font-weight: 700;
    padding: 0.8rem 2rem;
    background: #2575fc;
    color: #fff;
    font-size: 1rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-checkout:hover {
    background: linear-gradient(135deg, #1a5edb, #2575fc);
    box-shadow: 0 10px 25px rgba(37,117,252,0.4);
}

/* Empty cart */
.empty-cart {
    text-align: center;
    font-size: 1.3rem;
    color: #555;
    margin-top: 3rem;
}

/* Responsive */
@media(max-width: 768px) {
    .cart-item { flex-direction: column; align-items: flex-start; }
    .cart-item img { margin-bottom: 1rem; }
    .cart-item-info { margin-left: 0; margin-bottom: 0.5rem; }
}
</style>
@endpush

@section('content')
<div class="container cart-container">
    <h2 class="mb-4 text-primary fw-bold"><i class="bx bx-cart"></i> My Cart</h2>

    @if($order && $order->items->count() > 0)
        @php $grandTotal = 0; @endphp
        @foreach($order->items as $item)
            @php $total = $item->quantity * $item->price_each; $grandTotal += $total; @endphp
            <div class="cart-item mb-3">
                <img src="{{ $item->product->pro_img ? asset('storage/'.$item->product->pro_img) : asset('dashboard/assets/img/avatars/dummy-1.jpeg') }}" 
                     alt="{{ $item->product->name }}">
                <div class="cart-item-info">
                    <h5>{{ $item->product->name }}</h5>
                    <p>Price: ${{ number_format($item->price_each,2) }}</p>
                    <p>Quantity: {{ $item->quantity }}</p>
                    <p class="fw-bold">Total: ${{ number_format($total,2) }}</p>
                </div>
                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                    @csrf
                    <button type="submit">Remove</button>
                </form>
            </div>
        @endforeach

        <div class="cart-total">
            <h4>Grand Total: ${{ number_format($grandTotal,2) }}</h4>
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-checkout mt-3">
                    <i class="bx bx-check-circle"></i> Place Order
                </button>
            </form>
        </div>
    @else
        <p class="empty-cart">Your cart is empty.</p>
    @endif
</div>
@endsection
