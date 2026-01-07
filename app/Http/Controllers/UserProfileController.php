<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class UserProfileController extends Controller
{
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $orders = collect();
        if (Auth::check()) {
            $orders = Order::with('items.product')->where('user_id', Auth::id())->orderBy('created_at','desc')->get();
        }
        return view('profile', compact('cart','orders'));
    }
}
