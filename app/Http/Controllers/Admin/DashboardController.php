<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Basic Statistics
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_amount');

        // Monthly Statistics
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        
        $monthlyUsers = User::whereMonth('created_at', $currentMonth)
                           ->whereYear('created_at', $currentYear)
                           ->count();
        
        $monthlyOrders = Order::whereMonth('created_at', $currentMonth)
                             ->whereYear('created_at', $currentYear)
                             ->count();
        
        $monthlyRevenue = Order::whereMonth('created_at', $currentMonth)
                              ->whereYear('created_at', $currentYear)
                              ->where('payment_status', 'paid')
                              ->sum('total_amount');

        // Recent Activities
        $recentOrders = Order::with(['user', 'items.product'])
                            ->latest()
                            ->take(5)
                            ->get();

        $recentUsers = User::latest()
                          ->take(5)
                          ->get();

        $recentReviews = Review::with(['user', 'product'])
                              ->latest()
                              ->take(5)
                              ->get();

        // Low Stock Products
        $lowStockProducts = Product::where('stock', '<=', 10)
                                  ->orderBy('stock', 'asc')
                                  ->take(5)
                                  ->get();

        // Order Status Distribution
        $orderStatuses = Order::selectRaw('status, COUNT(*) as count')
                             ->groupBy('status')
                             ->pluck('count', 'status')
                             ->toArray();

        // Monthly Revenue Chart Data (Last 6 months)
        $monthlyRevenueData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $revenue = Order::whereMonth('created_at', $date->month)
                           ->whereYear('created_at', $date->year)
                           ->where('payment_status', 'paid')
                           ->sum('total_amount');
            $monthlyRevenueData[$date->format('M Y')] = $revenue;
        }

        return view('admin.dashboard', compact(
            'totalUsers', 'totalProducts', 'totalOrders', 'totalRevenue',
            'monthlyUsers', 'monthlyOrders', 'monthlyRevenue',
            'recentOrders', 'recentUsers', 'recentReviews',
            'lowStockProducts', 'orderStatuses', 'monthlyRevenueData'
        ));
    }

    public function statistics()
    {
        // Detailed statistics page
        $stats = [
            'users' => [
                'total' => User::count(),
                'admins' => User::where('role', 'admin')->count(),
                'regular' => User::where('role', 'user')->count(),
                'this_month' => User::whereMonth('created_at', Carbon::now()->month)->count(),
            ],
            'products' => [
                'total' => Product::count(),
                'by_category' => Product::selectRaw('category, COUNT(*) as count')
                                       ->groupBy('category')
                                       ->pluck('count', 'category'),
                'low_stock' => Product::where('stock', '<=', 10)->count(),
                'out_of_stock' => Product::where('stock', 0)->count(),
            ],
            'orders' => [
                'total' => Order::count(),
                'pending' => Order::where('status', 'pending')->count(),
                'completed' => Order::where('status', 'completed')->count(),
                'cancelled' => Order::where('status', 'cancelled')->count(),
                'this_month' => Order::whereMonth('created_at', Carbon::now()->month)->count(),
            ],
            'revenue' => [
                'total' => Order::where('payment_status', 'paid')->sum('total_amount'),
                'this_month' => Order::whereMonth('created_at', Carbon::now()->month)
                                    ->where('payment_status', 'paid')
                                    ->sum('total_amount'),
                'average_order' => Order::where('payment_status', 'paid')->avg('total_amount'),
            ]
        ];

        return view('admin.statistics', compact('stats'));
    }
}
