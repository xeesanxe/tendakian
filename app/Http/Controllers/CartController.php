<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    // Tampilkan isi cart dari session
    public function index(Request $request)
    {
        $cart = $this->cartService->getCart($request);
        $totals = $this->cartService->getCartTotals($cart);
        
        return view('cart', compact('cart', 'totals'));
    }

    // Tambah item ke cart (session) dengan validation
    public function add(AddToCartRequest $request)
    {
        try {
            $this->cartService->addToCart($request, $request->validated());
            return redirect()->back()->with('success', 'Item berhasil ditambahkan ke keranjang.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // Tambah item via GET (mis: dipanggil dari link href)
    public function addFromGet(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer|exists:products,id',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'qty' => 'sometimes|integer|min:1|max:10'
        ]);

        try {
            $this->cartService->addToCart($request, $data);
            return redirect()->back()->with('success', 'Item berhasil ditambahkan ke keranjang.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // Update quantity item di cart
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|string',
            'qty' => 'required|integer|min:0|max:10'
        ]);

        try {
            $this->cartService->updateCartItem($request, $request->id, $request->qty);
            
            // Handle AJAX requests
            if ($request->wantsJson() || $request->ajax()) {
                $cart = $this->cartService->getCart($request);
                $totals = $this->cartService->getCartTotals($cart);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Keranjang berhasil diperbarui.',
                    'cart' => $cart,
                    'totals' => $totals
                ]);
            }
            
            return redirect()->back()->with('success', 'Keranjang berhasil diperbarui.');
        } catch (\Exception $e) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 400);
            }
            
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // Hapus item dari cart
    public function remove(Request $request)
    {
        $request->validate([
            'id' => 'required|string'
        ]);

        try {
            $this->cartService->removeFromCart($request, $request->id);
            
            // Handle AJAX requests
            if ($request->wantsJson() || $request->ajax()) {
                $cart = $this->cartService->getCart($request);
                $totals = $this->cartService->getCartTotals($cart);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Item berhasil dihapus dari keranjang.',
                    'cart' => $cart,
                    'totals' => $totals
                ]);
            }
            
            return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
        } catch (\Exception $e) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 400);
            }
            
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // Clear seluruh cart
    public function clear(Request $request)
    {
        $this->cartService->clearCart($request);
        
        // Handle AJAX requests
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Keranjang berhasil dikosongkan.'
            ]);
        }
        
        return redirect()->back()->with('success', 'Keranjang berhasil dikosongkan.');
    }
}
