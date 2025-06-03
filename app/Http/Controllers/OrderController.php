<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders;
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipping_address' => 'required',
            'payment_method' => 'required',
            'items' => 'required|array'
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'shipping_address' => $validated['shipping_address'],
            'payment_method' => $validated['payment_method'],
            'total_amount' => 0,
            'status' => 'pending',
            'payment_status' => 'pending'
        ]);

        $total = 0;
        foreach ($validated['items'] as $item) {
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
            $total += $item['price'] * $item['quantity'];
        }

        $order->update(['total_amount' => $total]);
        return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed'
        ]);

        $order->update($validated);
        return redirect()->back()->with('success', 'Order status updated successfully');
    }

    public function updatePaymentStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:pending,paid'
        ]);

        $order->update($validated);
        return redirect()->back()->with('success', 'Payment status updated successfully');
    }
}
