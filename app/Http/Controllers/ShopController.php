<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('shelter');

        // Search
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%")
                ->orWhere('category', 'like', "%{$request->search}%");
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $products = $query->orderBy('id', 'desc')->paginate(12);

        return view('dashboard.owner.products.list', compact('products'));
    }

    // Product detail page
    public function show(Product $product)
    {
        return view('dashboard.owner.products.show', compact('product'));
    }
}
