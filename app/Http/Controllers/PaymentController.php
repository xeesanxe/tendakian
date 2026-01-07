<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class PaymentController extends Controller
{
    public function instructions($id)
    {
        $order = Order::findOrFail($id);
        return view('payment.instructions', compact('order'));
    }

    public function mockPay(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'paid';
        $order->save();
        return redirect('/thankyou')->with('success', 'Pembayaran berhasil (mock).');
    }
}
