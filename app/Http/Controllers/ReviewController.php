<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'You must be logged in to leave a review.');
        }

        // Check if user has already reviewed this product
        $existingReview = Review::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($existingReview) {
            return back()->withErrors(['review' => 'You have already reviewed this product.']);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000'
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment']
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }

    public function update(Request $request, Review $review)
    {
        // Check if user owns the review or is admin
        if (Auth::id() !== $review->user_id && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000'
        ]);

        $review->update($validated);

        return back()->with('success', 'Review updated successfully!');
    }

    public function destroy(Review $review)
    {
        // Check if user owns the review or is admin
        if (Auth::id() !== $review->user_id && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        $review->delete();
        
        return back()->with('success', 'Review deleted successfully!');
    }
}
