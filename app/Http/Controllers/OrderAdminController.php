<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderAdminController extends Controller
{
    public function index()
    {
        // Order berdasarkan created_at descending (terbaru di atas)
        $orders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function markPaid(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'paid';
        $order->save();
        return redirect()->back()->with('success', 'Order marked as paid.');
    }

    public function cancel(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'cancelled';
        $order->save();
        return redirect()->back()->with('success', 'Order cancelled.');
    }
}
