<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function __construct()
    {
        // Check if carts table exists, if not, redirect with error
        if (!Schema::hasTable('carts')) {
            abort(503, 'Cart functionality is currently unavailable. Please run migrations.');
        }
    }

    public function index()
    {
        try {
            $cartItems = Auth::user()->cartItems()->with('product')->get();
            $total = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            return view('cart.index', compact('cartItems', 'total'));
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Cart functionality is currently unavailable. Please try again later.');
        }
    }

    public function add(Request $request, Product $product)
    {
        try {
            $request->validate([
                'quantity' => 'required|integer|min:1|max:' . $product->stock
            ]);

            $cartItem = Cart::where('user_id', Auth::id())
                           ->where('product_id', $product->id)
                           ->first();

            if ($cartItem) {
                $newQuantity = $cartItem->quantity + $request->quantity;
                if ($newQuantity > $product->stock) {
                    return back()->withErrors(['quantity' => 'Not enough stock available.']);
                }
                $cartItem->update(['quantity' => $newQuantity]);
            } else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'quantity' => $request->quantity
                ]);
            }

            return back()->with('success', 'Product added to cart successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to add product to cart. Please try again.']);
        }
    }

    public function update(Request $request, Cart $cart)
    {
        try {
            if ($cart->user_id !== Auth::id()) {
                abort(403);
            }

            $request->validate([
                'quantity' => 'required|integer|min:1|max:' . $cart->product->stock
            ]);

            $cart->update(['quantity' => $request->quantity]);

            return back()->with('success', 'Cart updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update cart. Please try again.']);
        }
    }

    public function remove(Cart $cart)
    {
        try {
            if ($cart->user_id !== Auth::id()) {
                abort(403);
            }

            $cart->delete();

            return back()->with('success', 'Item removed from cart!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to remove item from cart. Please try again.']);
        }
    }

    public function clear()
    {
        try {
            Auth::user()->cartItems()->delete();

            return back()->with('success', 'Cart cleared successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to clear cart. Please try again.']);
        }
    }

    public function checkout()
    {
        try {
            $cartItems = Auth::user()->cartItems()->with('product')->get();
            
            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.index')
                    ->with('error', 'Your cart is empty!');
            }

            $total = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            return view('cart.checkout', compact('cartItems', 'total'));
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Checkout functionality is currently unavailable. Please try again later.');
        }
    }
}
