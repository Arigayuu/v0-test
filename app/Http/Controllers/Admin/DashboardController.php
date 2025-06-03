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
        $recentOrders = Order::with(['user'])
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
        // Detailed statistics
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalRegularUsers = User::where('role', 'user')->count();
        $newUsersThisMonth = User::whereMonth('created_at', Carbon::now()->month)->count();
        
        $totalProducts = Product::count();
        $productsByCategory = Product::selectRaw('category, COUNT(*) as count')
                                    ->groupBy('category')
                                    ->pluck('count', 'category')
                                    ->toArray();
        $lowStockCount = Product::where('stock', '<=', 10)->count();
        $outOfStockCount = Product::where('stock', 0)->count();
        
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();
        $ordersThisMonth = Order::whereMonth('created_at', Carbon::now()->month)->count();
        
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_amount');
        $revenueThisMonth = Order::whereMonth('created_at', Carbon::now()->month)
                                ->where('payment_status', 'paid')
                                ->sum('total_amount');
        $averageOrderValue = Order::where('payment_status', 'paid')->avg('total_amount') ?? 0;
        
        // Recent data for statistics page
        $recentOrders = Order::with('user')
                            ->latest()
                            ->take(10)
                            ->get();
                            
        $recentReviews = Review::with(['user', 'product'])
                              ->latest()
                              ->take(10)
                              ->get();
                              
        // Monthly order counts for the last 6 months
        $monthlyCounts = [];
        $monthlyRevenues = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $month = $date->format('M Y');
            
            $count = Order::whereMonth('created_at', $date->month)
                         ->whereYear('created_at', $date->year)
                         ->count();
                         
            $revenue = Order::whereMonth('created_at', $date->month)
                          ->whereYear('created_at', $date->year)
                          ->where('payment_status', 'paid')
                          ->sum('total_amount');
                          
            $monthlyCounts[$month] = $count;
            $monthlyRevenues[$month] = $revenue;
        }

        return view('admin.statistics', compact(
            'totalUsers', 'totalAdmins', 'totalRegularUsers', 'newUsersThisMonth',
            'totalProducts', 'productsByCategory', 'lowStockCount', 'outOfStockCount',
            'totalOrders', 'pendingOrders', 'completedOrders', 'cancelledOrders', 'ordersThisMonth',
            'totalRevenue', 'revenueThisMonth', 'averageOrderValue',
            'recentOrders', 'recentReviews',
            'monthlyCounts', 'monthlyRevenues'
        ));
    }
}
