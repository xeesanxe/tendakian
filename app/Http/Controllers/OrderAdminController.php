<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $filters = [
            'status' => $request->get('status', 'all'),
            'search' => $request->get('search'),
            'date_from' => $request->get('date_from'),
            'date_to' => $request->get('date_to'),
        ];
        
        // Get filtered orders
        $orders = $this->orderService->searchOrders($filters)->paginate(20);
        
        // Get statistics
        $stats = $this->orderService->getOrderStatistics();
        
        return view('admin.orders.index', compact('orders', 'stats', 'filters'));
    }

    public function show($id)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function markPaid(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);
            $this->orderService->updateOrderStatus($order, 'paid');
            
            return redirect()->back()->with('success', 'Order marked as paid successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to mark order as paid: ' . $e->getMessage());
        }
    }

    public function cancel(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);
            $this->orderService->updateOrderStatus($order, 'cancelled');
            
            return redirect()->back()->with('success', 'Order cancelled successfully. Stock has been restored.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to cancel order: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:pending,paid,processing,shipped,delivered,cancelled'
        ]);

        try {
            $order = Order::findOrFail($id);
            $this->orderService->updateOrderStatus($order, $request->status);
            
            return redirect()->back()->with('success', "Order status updated to {$request->status} successfully.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update order status: ' . $e->getMessage());
        }
    }

    public function addNotes(Request $request, $id)
    {
        $request->validate([
            'notes' => 'required|string|max:1000'
        ]);

        $order = Order::findOrFail($id);
        $order->update(['notes' => $request->notes]);

        return redirect()->back()->with('success', 'Order notes updated successfully.');
    }
}
