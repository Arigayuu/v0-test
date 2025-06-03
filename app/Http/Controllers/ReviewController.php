<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string'
        ]);

        $review = Review::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment']
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully');
    }

    public function destroy(Review $review)
    {
        if (auth()->user()->isAdmin() || auth()->id() === $review->user_id) {
            $review->delete();
            return redirect()->back()->with('success', 'Review deleted successfully');
        }
        
        return redirect()->back()->with('error', 'Unauthorized action');
    }
} 