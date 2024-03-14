<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Retrieve all orders for the current user with menu items
        $orders = Order::with('menuItems')->where('user_id', Auth::id())->get();

        return view('orders.index', compact('orders'));
    }


    public function storeFromCart(Request $request)
    {
        // Get the cart items for the current user
        $carts = Cart::where('user_id', Auth::id())->get();

        // Calculate the total amount from the cart
        $totalAmount = 0;

        // Build order details array
        $orderDetails = [];

        foreach ($carts as $cart) {
            $totalAmount += $cart->price * $cart->quantity;

            $orderDetails[] = [
                'menu_id' => $cart->menu_id,
                'quantity' => $cart->quantity,
                'image' => $cart->image,
                'price' => $cart->price,
                ];
        }

        // Create the order
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_type' => $request->input('order_type'),
            'total_amount' => $totalAmount,
            'payment_status' => false,
            'order_details' => json_encode($orderDetails), // Store order details as JSON
        ]);

        // Remove the cart items after moving to order details
        foreach ($carts as $cart) {
            $cart->delete();
        }

        return redirect()->route('payment.index');

    }

}
