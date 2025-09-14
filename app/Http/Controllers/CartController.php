<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Show cart page
    // Show cart page
    public function index()
    {
        $order = Order::with('items.product')
            ->where('owner_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        return view('dashboard.owner.products.cart', compact('order'));
    }

    // Add product to cart
    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = (int) $request->quantity;

        // Find or create an open order for this user
        $order = Order::firstOrCreate([
            'owner_id' => Auth::id(),
            'status' => 'pending',
        ]);

        // Check if product already in cart
        $item = $order->items()->where('product_id', $product->id)->first();

        if ($item) {
            // Calculate new quantity
            $newQuantity = $item->quantity + $quantity;

            // Validate against stock
            if ($newQuantity > $product->stock_quantity) {
                return redirect()->back()->with('error', 'You cannot add more than available stock.');
            }

            // Update item
            $item->quantity = $newQuantity;
            $item->save();
        } else {
            // Validate first add against stock
            if ($quantity > $product->stock_quantity) {
                return redirect()->back()->with('error', 'You cannot add more than available stock.');
            }

            // Create item
            $order->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price_each' => $product->price,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart.');
    }

    // Remove item from cart
    public function remove(OrderItem $orderItem)
    {
        $order = $orderItem->order;
        $orderItem->delete();

        if ($order->items()->count() > 0) {
            $order->total_amount = $order->items->sum(fn($item) => $item->quantity * $item->price_each);
            $order->save();
        } else {
            $order->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    // Checkout
    public function checkout()
    {
        $order = Order::with('items.product')
            ->where('owner_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        if (!$order || $order->items->isEmpty()) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty.');
        }

        foreach ($order->items as $item) {
            $product = $item->product;

            if ($item->quantity > $product->stock_quantity) {
                return redirect()->route('cart.index')
                    ->with('error', $product->name . ' does not have enough stock.');
            }

            // Reduce stock
            $product->stock_quantity -= $item->quantity;
            $product->save();
        }

        // Remove cart items so the user sees an empty cart
        $order->items()->delete();

        return redirect()->route('shop.index')->with('success', 'Order placed successfully! Wait for shelter confirmation.');
    }
}
