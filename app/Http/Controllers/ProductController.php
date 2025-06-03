<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        // Price range filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        // Brand filter
        if ($request->filled('brand')) {
            $query->where('brand', $request->input('brand'));
        }

        // Stock filter
        if ($request->filled('in_stock')) {
            $query->where('stock', '>', 0);
        }

        // Sorting
        $sortBy = $request->input('sort', 'latest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12);
        
        // Get filter options
        $categories = Product::distinct()->pluck('category');
        $brands = Product::whereNotNull('brand')->distinct()->pluck('brand');
        $priceRange = [
            'min' => Product::min('price'),
            'max' => Product::max('price')
        ];

        return view('products.index', compact('products', 'categories', 'brands', 'priceRange'));
    }

    public function show(Product $product)
    {
        $product->load(['reviews.user']);
        
        // Get related products
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();
            
        // Calculate average rating
        $averageRating = $product->reviews()->avg('rating');
        $totalReviews = $product->reviews()->count();

        return view('products.show', compact('product', 'relatedProducts', 'averageRating', 'totalReviews'));
    }
}
