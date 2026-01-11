<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Get statistics
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'paid')->sum('total');
        $totalProducts = Product::active()->count();
        $totalCustomers = User::where('is_admin', false)->count();
        
        // Get order status counts
        $pendingOrders = Order::where('status', 'pending')->count();
        $paidOrders = Order::where('status', 'paid')->count();
        
        // Get low stock products (stock <= 5)
        $lowStockProducts = Product::active()->where('stock', '<=', 5)->count();
        
        // Get recent orders (last 10)
        $recentOrders = Order::orderBy('created_at', 'desc')->take(10)->get();
        
        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue', 
            'totalProducts',
            'totalCustomers',
            'pendingOrders',
            'paidOrders',
            'lowStockProducts',
            'recentOrders'
        ));
    }
}