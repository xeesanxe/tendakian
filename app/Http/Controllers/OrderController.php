<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Keranjang kosong.');
        }

        $request->validate([
            // accept new form fields `name`/`email` or legacy `c_fname`/`c_lname`/`c_email_address`
            'name' => 'required_without_all:c_fname,c_lname|string',
            'c_fname' => 'required_without:name|string',
            'c_lname' => 'required_without:name|string',
            'email' => 'required_without:c_email_address|email',
            'c_email_address' => 'required_without:email|email',
            'rental_start' => 'nullable|date',
            'rental_end' => 'nullable|date|after_or_equal:rental_start',
            'payment_method' => 'nullable|string|in:manual,mock',
        ]);

        // derive shipping/address/notes from available fields
        $shipping = $request->input('c_address', $request->input('address', $request->input('notes', '')));
        $rentalStart = $request->input('rental_start');
        $rentalEnd = $request->input('rental_end');

        // normalize name/email for potential use
        $name = $request->input('name');
        if (empty($name)) {
            $name = trim($request->input('c_fname', '') . ' ' . $request->input('c_lname', ''));
        }
        $email = $request->input('email', $request->input('c_email_address'));

        DB::beginTransaction();
        try {
            $total = 0;
            foreach ($cart as $c) {
                $total += $c['price'] * $c['qty'];
            }

            $paymentMethod = $request->input('payment_method', 'manual');

            $order = Order::create([
                'user_id' => null,
                'order_number' => strtoupper(uniqid('ORD-')),
                'status' => ($paymentMethod === 'mock') ? 'paid' : 'pending',
                'total' => $total,
                'shipping_address' => $shipping,
                'rental_start' => $rentalStart,
                'rental_end' => $rentalEnd,
            ]);

            foreach ($cart as $c) {
                // try to find product by id; if not numeric, skip
                $product = Product::find($c['id']);
                $productId = $product ? $product->id : null;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $c['qty'],
                    'price' => $c['price'],
                    'total' => $c['price'] * $c['qty'],
                ]);

                if ($product) {
                    // reduce stock if possible
                    $product->decrement('stock', $c['qty']);
                }
            }

            DB::commit();
            $request->session()->forget('cart');

            if ($paymentMethod === 'manual') {
                return redirect()->route('payment.instructions', ['id' => $order->id])->with('success', 'Order dibuat. Silakan lanjutkan pembayaran.');
            }

            // mock payment already marked as paid
            return redirect('/thankyou')->with('success', 'Order berhasil dibuat dan dibayar (mock).');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat order: '.$e->getMessage());
        }
    }
}
