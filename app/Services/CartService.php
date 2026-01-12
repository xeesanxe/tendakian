<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;

class CartService
{
    /**
     * Get cart from session
     */
    public function getCart(Request $request): array
    {
        return $request->session()->get('cart', []);
    }

    /**
     * Add item to cart with validation
     */
    public function addToCart(Request $request, array $data): array
    {
        $cart = $this->getCart($request);
        $productId = $data['id'];
        $qty = $data['qty'] ?? 1;

        // Validate product exists and is active
        $product = Product::where('id', $productId)
            ->where('is_active', true)
            ->first();

        if (!$product) {
            throw new \Exception('Product not found or inactive.');
        }

        // Check stock availability
        $currentCartQty = isset($cart[$productId]) ? $cart[$productId]['qty'] : 0;
        $totalQty = $currentCartQty + $qty;

        if ($totalQty > $product->stock) {
            throw new \Exception("Insufficient stock. Available: {$product->stock}, Requested: {$totalQty}");
        }

        // Add or update cart item
        if (isset($cart[$productId])) {
            $cart[$productId]['qty'] = $totalQty;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => $qty,
                'image' => $product->image,
                'sku' => $product->sku,
            ];
        }

        $request->session()->put('cart', $cart);
        return $cart;
    }

    /**
     * Update cart item quantity
     */
    public function updateCartItem(Request $request, string $productId, int $qty): array
    {
        $cart = $this->getCart($request);

        if (!isset($cart[$productId])) {
            throw new \Exception('Item not found in cart.');
        }

        $product = Product::find($productId);
        if (!$product || $qty > $product->stock) {
            throw new \Exception('Invalid quantity or insufficient stock.');
        }

        if ($qty <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId]['qty'] = $qty;
        }

        $request->session()->put('cart', $cart);
        return $cart;
    }

    /**
     * Remove item from cart
     */
    public function removeFromCart(Request $request, string $productId): array
    {
        $cart = $this->getCart($request);
        unset($cart[$productId]);
        $request->session()->put('cart', $cart);
        return $cart;
    }

    /**
     * Clear entire cart
     */
    public function clearCart(Request $request): void
    {
        $request->session()->forget('cart');
    }

    /**
     * Calculate cart totals
     */
    public function getCartTotals(array $cart): array
    {
        $subtotal = 0;
        $totalItems = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['qty'];
            $totalItems += $item['qty'];
        }

        $tax = $subtotal * 0.1; // 10% tax
        $total = $subtotal + $tax;

        return [
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'items_count' => $totalItems,
        ];
    }

    /**
     * Validate cart before checkout
     */
    public function validateCart(array $cart): array
    {
        $errors = [];
        $validatedCart = [];

        foreach ($cart as $item) {
            $product = Product::where('id', $item['id'])
                ->where('is_active', true)
                ->first();

            if (!$product) {
                $errors[] = "Product '{$item['name']}' is no longer available.";
                continue;
            }

            if ($product->stock < $item['qty']) {
                $errors[] = "Product '{$item['name']}' has insufficient stock. Available: {$product->stock}";
                continue;
            }

            // Update cart with current product data
            $validatedCart[$item['id']] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => $item['qty'],
                'image' => $product->image,
                'sku' => $product->sku,
            ];
        }

        return [
            'cart' => $validatedCart,
            'errors' => $errors,
            'is_valid' => empty($errors),
        ];
    }
}