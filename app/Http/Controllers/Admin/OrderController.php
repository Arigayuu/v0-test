<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'orderItems.product'])
            ->latest()
            ->paginate(10);
            
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'orderItems.product']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,completed,cancelled'
        ]);

        $oldStatus = $order->status;
        $order->update($validated);

        // If order is completed, automatically mark payment as paid
        if ($validated['status'] === 'completed' && $order->payment_status === 'pending') {
            $order->update(['payment_status' => 'paid']);
        }

        return redirect()->route('admin.orders.show', $order)
            ->with('success', "Order status updated from '{$oldStatus}' to '{$validated['status']}'.");
    }

    public function updatePaymentStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:pending,paid,failed,refunded'
        ]);

        $oldPaymentStatus = $order->payment_status;
        $order->update($validated);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', "Payment status updated from '{$oldPaymentStatus}' to '{$validated['payment_status']}'.");
    }
}
