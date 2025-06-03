<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()
                     ->with(['orderItems.product'])
                     ->latest()
                     ->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Ensure user can only view their own orders
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to order.');
        }
        
        $order->load(['orderItems.product', 'user']);
        return view('orders.show', compact('order'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipping_address' => 'required|string|max:500',
            'payment_method' => 'required|string|in:credit_card,bank_transfer,e_wallet',
            'source' => 'required|string|in:cart,direct',
            'product_id' => 'required_if:source,direct|exists:products,id',
            'quantity' => 'required_if:source,direct|integer|min:1',
        ]);

        DB::beginTransaction();
        
        try {
            $total = 0;
            $orderItems = [];

            if ($validated['source'] === 'cart') {
                // Order from cart
                $cartItems = Auth::user()->cartItems()->with('product')->get();
                
                if ($cartItems->isEmpty()) {
                    return back()->withErrors(['cart' => 'Your cart is empty.']);
                }

                foreach ($cartItems as $cartItem) {
                    $product = $cartItem->product;
                    
                    if ($product->stock < $cartItem->quantity) {
                        return back()->withErrors([
                            'stock' => "Insufficient stock for product: {$product->name}. Available: {$product->stock}"
                        ]);
                    }
                    
                    $itemTotal = $product->price * $cartItem->quantity;
                    $total += $itemTotal;
                    
                    $orderItems[] = [
                        'product_id' => $product->id,
                        'quantity' => $cartItem->quantity,
                        'price' => $product->price,
                    ];
                }
            } else {
                // Direct order
                $product = Product::findOrFail($validated['product_id']);
                
                if ($product->stock < $validated['quantity']) {
                    return back()->withErrors([
                        'quantity' => "Insufficient stock for product: {$product->name}. Available: {$product->stock}"
                    ])->withInput();
                }
                
                $total = $product->price * $validated['quantity'];
                $orderItems[] = [
                    'product_id' => $product->id,
                    'quantity' => $validated['quantity'],
                    'price' => $product->price,
                ];
            }

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'shipping_address' => $validated['shipping_address'],
                'payment_method' => $validated['payment_method'],
                'total_amount' => $total,
                'status' => 'pending',
                'payment_status' => 'pending'
            ]);

            // Create order items and update stock
            foreach ($orderItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);

                // Update product stock
                Product::where('id', $item['product_id'])
                    ->decrement('stock', $item['quantity']);
            }

            // Clear cart if order from cart
            if ($validated['source'] === 'cart') {
                Auth::user()->cartItems()->delete();
            }

            DB::commit();
            
            return redirect()->route('orders.show', $order)
                ->with('success', 'Order placed successfully!');
                
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Failed to place order. Please try again.']);
        }
    }

    public function cancel(Order $order)
    {
        // Ensure user can only cancel their own orders
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to order.');
        }

        if ($order->status !== 'pending') {
            return back()->withErrors(['error' => 'Only pending orders can be cancelled.']);
        }

        DB::beginTransaction();
        
        try {
            // Restore product stock
            foreach ($order->items as $item) {
                Product::where('id', $item->product_id)
                    ->increment('stock', $item->quantity);
            }

            $order->update(['status' => 'cancelled']);
            
            DB::commit();
            
            return back()->with('success', 'Order cancelled successfully.');
            
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Failed to cancel order. Please try again.']);
        }
    }
}
