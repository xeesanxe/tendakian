<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderService
{
    /**
     * Create order from cart data
     */
    public function createOrder(array $orderData, array $cart): Order
    {
        return DB::transaction(function () use ($orderData, $cart) {
            // Generate unique order number
            $orderNumber = $this->generateOrderNumber();

            // Calculate totals
            $cartService = new CartService();
            $totals = $cartService->getCartTotals($cart);

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => $orderNumber,
                'status' => 'pending',
                'total' => $totals['total'],
                'customer_name' => $orderData['name'],
                'customer_email' => $orderData['email'],
                'customer_phone' => $orderData['phone'] ?? null,
                'shipping_address' => $orderData['address'] ?? null,
                'payment_method' => $orderData['payment_method'] ?? 'manual',
                'rental_start' => $orderData['rental_start'] ?? null,
                'rental_end' => $orderData['rental_end'] ?? null,
                'notes' => $orderData['notes'] ?? null,
            ]);

            // Create order items and update stock
            foreach ($cart as $item) {
                $product = Product::find($item['id']);
                
                if (!$product || $product->stock < $item['qty']) {
                    throw new \Exception("Insufficient stock for product: {$item['name']}");
                }

                // Create order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['qty'],
                    'price' => $product->price,
                    'total' => $product->price * $item['qty'],
                ]);

                // Update product stock
                $product->decrement('stock', $item['qty']);
            }

            return $order;
        });
    }

    /**
     * Generate unique order number
     */
    private function generateOrderNumber(): string
    {
        do {
            $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(6));
        } while (Order::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }

    /**
     * Update order status
     */
    public function updateOrderStatus(Order $order, string $status): Order
    {
        $validStatuses = ['pending', 'paid', 'processing', 'shipped', 'delivered', 'cancelled'];
        
        if (!in_array($status, $validStatuses)) {
            throw new \Exception("Invalid order status: {$status}");
        }

        $order->update([
            'status' => $status,
            'paid_at' => $status === 'paid' ? now() : $order->paid_at,
        ]);

        // If order is cancelled, restore stock
        if ($status === 'cancelled' && $order->status !== 'cancelled') {
            $this->restoreStock($order);
        }

        return $order->fresh();
    }

    /**
     * Restore product stock when order is cancelled
     */
    private function restoreStock(Order $order): void
    {
        foreach ($order->items as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $product->increment('stock', $item->quantity);
            }
        }
    }

    /**
     * Get order statistics
     */
    public function getOrderStatistics(): array
    {
        return [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'paid_orders' => Order::where('status', 'paid')->count(),
            'cancelled_orders' => Order::where('status', 'cancelled')->count(),
            'total_revenue' => Order::whereIn('status', ['paid', 'processing', 'shipped', 'delivered'])->sum('total'),
            'today_orders' => Order::whereDate('created_at', today())->count(),
            'this_month_revenue' => Order::whereIn('status', ['paid', 'processing', 'shipped', 'delivered'])
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('total'),
        ];
    }

    /**
     * Search orders with filters
     */
    public function searchOrders(array $filters = [])
    {
        $query = Order::with(['user', 'items.product']);

        // Filter by status
        if (!empty($filters['status']) && $filters['status'] !== 'all') {
            $query->where('status', $filters['status']);
        }

        // Search by order number or customer name/email
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by date range
        if (!empty($filters['date_from'])) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }

        return $query->orderBy('created_at', 'desc');
    }
}