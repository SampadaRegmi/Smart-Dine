<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use App\Models\CheckoutProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable',
            'email' => 'nullable',
            'phone' => 'nullable',
            'payment_method' => 'required', // Ensure payment method is required
        ]);

        $checkout = Checkout::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_method == 'reward' ? 'paid' : 'pending',
        ]);

        $totalPrice = 0;
        $carts = Auth::user()->carts()->with('menu')->get(); // Eager load the 'menu' relationship
        foreach ($carts as $cart) {
            if ($cart->menu) {
                $menuItem = $cart->menu;
                $totalPrice += $menuItem->price* $cart->quantity;;
                
                // Create a checkout product record
                CheckoutProduct::create([
                    'checkout_id' => $checkout->id,
                    'menu_id' => $menuItem->id,
                    'quantity' => $cart->quantity,
                    // Add any other fields as needed
                ]);
            } else {
                Log::warning("Menu item not found for cart ID: {$cart->id}");
            }
        }

        $checkout->update([
            'to_pay' => $totalPrice
        ]);

        if ($request->payment_method != 'khalti') {
            return redirect(route('payment.index'));
        } else {
            return redirect(route('user.checkout'));
        }
    }

    public function show()
    {
        // You can load any necessary data here and return the checkout view
        return view('User.Layouts.checkout');
    }
}
