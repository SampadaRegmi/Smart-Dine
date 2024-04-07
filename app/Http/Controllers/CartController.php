<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->get();
        return view('User.Layouts.cart', compact('carts'));
    }

    public function store(Request $request)
    {
        try {
            \Log::info('Request Data: ' . json_encode($request->all()));

            $menuId = $request->input('menu_id');

            if (!$menuId || !Menu::find($menuId)) {
                \Log::error('Invalid or missing Menu ID in the request.');
                return redirect()->back()->with('error', 'Invalid or missing Menu ID.');
            }

            $quantity = $request->input('quantity', 1);
            $price = $request->input('price');

            // Check if the item already exists in the cart
            $existingCartItem = Cart::where('user_id', auth()->id())->where('menu_id', $menuId)->first();

            if ($existingCartItem) {
                $existingCartItem->quantity += $quantity;
                $existingCartItem->sub_total += ($price * $quantity);

                // Calculate discount for existing item
                $existingSubtotal = $existingCartItem->sub_total;
                $discountRate = 0;
                if ($existingSubtotal > 100) {
                    $discountRate = 0.15; // 15% discount if subtotal > 100
                } elseif ($existingSubtotal > 50) {
                    $discountRate = 0.1; // 10% discount if subtotal > 50
                } elseif ($existingSubtotal > 20) {
                    $discountRate = 0.05; // 5% discount if subtotal > 20
                }
                $existingCartItem->discount = $existingSubtotal * $discountRate;

                // Calculate total after discount for existing item
                $existingCartItem->total = $existingSubtotal - $existingCartItem->discount;

                $existingCartItem->save();
            } else {
                // Calculate subtotal
                $subtotal = $price * $quantity;

                // Calculate discount
                $discountRate = 0;
                if ($subtotal > 100) {
                    $discountRate = 0.15; // 15% discount if subtotal > 100
                } elseif ($subtotal > 50) {
                    $discountRate = 0.1; // 10% discount if subtotal > 50
                } elseif ($subtotal > 20) {
                    $discountRate = 0.05; // 5% discount if subtotal > 20
                }
                $discount = $subtotal * $discountRate;

                // Calculate total after discount
                $total = $subtotal - $discount;

                // Save the cart item with calculated values
                $item = new Cart();
                $item->quantity = $quantity;
                $item->menu_id = $menuId;
                $item->user_id = auth()->id();
                $item->sub_total = $subtotal;
                $item->discount = $discount;
                $item->total = $total;
                $item->save();
            }

            return redirect()->back()->with('success', 'Item added to the cart');
        } catch (\Exception $e) {
            \Log::error('Error in addToCart: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error adding item to the cart.');
        }
    }

    public function destroy($id)
    {
        // Find the cart item by ID
        $cartItem = Cart::find($id);

        // Check if the cart item exists
        if ($cartItem) {
            // Delete the cart item
            $cartItem->delete();

            // Return a JSON response indicating success
            return response()->json(['status' => 200, 'message' => 'Cart item deleted successfully']);
        } else {
            // Return a JSON response indicating failure
            return response()->json(['status' => 400, 'error' => 'Cart item not found'], 404);
        }
    }
}
