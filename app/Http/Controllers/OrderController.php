<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->get();
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = \App\Models\Order::with('translators')->findOrFail($id);

        // Общая сумма по заказу (через pivot)
        $total = $order->translators->sum(function($translator) {
            return $translator->pivot->price;
        });

        return view('orders.show', compact('order', 'total'));
    }
}
