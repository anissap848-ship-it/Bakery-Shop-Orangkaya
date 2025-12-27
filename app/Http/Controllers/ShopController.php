<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display shop page with all products
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        // Category filter
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Sort by price
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name':
                    $query->orderBy('name', 'asc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        // Get products with pagination
        $products = $query->paginate(9);

        // Get all categories for filter
        $categories = Product::select('category')
            ->distinct()
            ->pluck('category');

        return view('shop.index', compact('products', 'categories'));
    }

    /**
     * Display single product detail
     */
    public function show(Product $product)
    {
        // Get related products (same category, different product)
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('shop.show', compact('product', 'relatedProducts'));
    }

    /**
     * Display products by category
     */
    public function category($category)
    {
        $products = Product::where('category', $category)
            ->latest()
            ->paginate(9);

        $categories = Product::select('category')
            ->distinct()
            ->pluck('category');

        return view('shop.category', compact('products', 'category', 'categories'));
    }
}
