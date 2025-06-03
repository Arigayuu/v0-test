<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // User Statistics
        $stats = [
            'total_orders' => $user->orders()->count(),
            'pending_orders' => $user->orders()->where('status', 'pending')->count(),
            'completed_orders' => $user->orders()->where('status', 'completed')->count(),
            'total_spent' => $user->orders()->where('payment_status', 'paid')->sum('total_amount'),
            'cart_items' => $user->cartItems()->sum('quantity'),
            'reviews_written' => $user->reviews()->count(),
        ];

        // Recent Orders
        $recentOrders = $user->orders()
                            ->with(['items.product'])
                            ->latest()
                            ->take(5)
                            ->get();

        // Recent Reviews
        $recentReviews = $user->reviews()
                             ->with('product')
                             ->latest()
                             ->take(3)
                             ->get();

        // Monthly Spending (Last 6 months)
        $monthlySpending = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $spending = $user->orders()
                            ->whereMonth('created_at', $date->month)
                            ->whereYear('created_at', $date->year)
                            ->where('payment_status', 'paid')
                            ->sum('total_amount');
            $monthlySpending[$date->format('M Y')] = $spending;
        }

        return view('users.dashboard', compact('user', 'stats', 'recentOrders', 'recentReviews', 'monthlySpending'));
    }
}
