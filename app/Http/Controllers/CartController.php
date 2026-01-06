<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // Tampilkan isi cart dari session
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        return view('cart', ['cart' => $cart]);
    }

    // Tambah item ke cart (session)
    public function add(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|string',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'qty' => 'sometimes|integer|min:1'
        ]);

        $qty = isset($data['qty']) ? (int)$data['qty'] : 1;

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$data['id']])) {
            $cart[$data['id']]['qty'] += $qty;
        } else {
            $cart[$data['id']] = [
                'id' => $data['id'],
                'name' => $data['name'],
                'price' => $data['price'],
                'qty' => $qty,
            ];
        }

        $request->session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Item ditambahkan ke keranjang.');
    }

    // Tambah item via GET (mis: dipanggil dari link href)
    public function addFromGet(Request $request)
    {
        $data = $request->only(['id', 'name', 'price', 'qty']);

        if (empty($data['id']) || empty($data['name']) || empty($data['price'])) {
            return redirect()->back()->with('error', 'Data produk tidak lengkap.');
        }

        $data['price'] = (float) $data['price'];
        $data['qty'] = isset($data['qty']) ? (int)$data['qty'] : 1;

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$data['id']])) {
            $cart[$data['id']]['qty'] += $data['qty'];
        } else {
            $cart[$data['id']] = [
                'id' => $data['id'],
                'name' => $data['name'],
                'price' => $data['price'],
                'qty' => $data['qty'],
            ];
        }

        $request->session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Item ditambahkan ke keranjang.');
    }

    // Hapus item dari cart berdasarkan id
    public function remove(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|string'
        ]);

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$data['id']])) {
            unset($cart[$data['id']]);
            $request->session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Item dihapus dari keranjang.');
        }

        return redirect()->back()->with('error', 'Item tidak ditemukan di keranjang.');
    }

    // Update quantity item di cart
    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|string',
            'qty' => 'required|integer|min:0'
        ]);

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$data['id']])) {
            if ($data['qty'] <= 0) {
                unset($cart[$data['id']]);
                $request->session()->put('cart', $cart);
                if ($request->wantsJson() || $request->ajax()) {
                    // recompute subtotal
                    $subtotal = 0;
                    foreach ($cart as $c) {
                        $subtotal += $c['price'] * $c['qty'];
                    }
                    return response()->json(['success' => true, 'removed' => true, 'id' => $data['id'], 'subtotal' => $subtotal]);
                }
                return redirect()->back()->with('success', 'Item dihapus dari keranjang.');
            } else {
                $cart[$data['id']]['qty'] = $data['qty'];
                $request->session()->put('cart', $cart);

                if ($request->wantsJson() || $request->ajax()) {
                    // compute line total and subtotal
                    $lineTotal = $cart[$data['id']]['price'] * $cart[$data['id']]['qty'];
                    $subtotal = 0;
                    foreach ($cart as $c) {
                        $subtotal += $c['price'] * $c['qty'];
                    }
                    return response()->json(['success' => true, 'id' => $data['id'], 'qty' => $cart[$data['id']]['qty'], 'lineTotal' => $lineTotal, 'subtotal' => $subtotal]);
                }

                return redirect()->back()->with('success', 'Keranjang diperbarui.');
            }
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => false, 'message' => 'Item tidak ditemukan di keranjang.'], 404);
        }

        return redirect()->back()->with('error', 'Item tidak ditemukan di keranjang.');
    }
}
