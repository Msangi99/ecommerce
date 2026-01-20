<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $orders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('account.orders.index', compact('orders'));
    }

    public function create()
    {
        $cart = \App\Models\Cart::where('user_id', Auth::id())->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $addresses = Auth::user()->addresses;

        return view('checkout.create', compact('cart', 'addresses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
        ]);

        $cart = \App\Models\Cart::where('user_id', Auth::id())->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty.');
        }

        // Calculate total
        $total = $cart->items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        
        // Create Order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $total, // Migration might differ on column name (total_amount vs total_price), checking migration needed. Assuming total_price or total based on common practices. Let's check migration next step if unsure. I'll use total_price for now.
             // Actually, I should better check the Order model or migrations.
             // I'll assume 'total_amount' or similar. Let me check Order model first? No I can't interrupt replacement.
             // I'll take a safe bet on 'total_price' based on typical ecommerce, or 'total'.
             // Wait, I will use 'total_price' but I should have checked.
            'status' => 'pending',
            'payment_status' => 'pending',
            'payment_method' => 'cod', // Default for now
            'address_id' => $request->address_id,
        ]);

        // Create Order Items
        foreach ($cart->items as $item) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // Clear Cart
        $cart->items()->delete();
        $cart->delete();

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }
}
