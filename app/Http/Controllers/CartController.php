<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', auth()->id())->get();

        // Calculate the total amount
        $total = $this->calculateTotal($carts);

        return view('User.Layouts.cart', compact('carts', 'total'));
    }

    // ... (other methods)

    // Helper method to calculate total amount
    private function calculateTotal($carts)
    {
        $total = 0;

        foreach ($carts as $cart) {
            $total += $cart->price * $cart->quantity;
        }

        return $total;
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

            $item = new Cart();
            $item->quantity = $quantity;
            $item->menu_id = $menuId;
            $item->user_id = auth()->id();
            $item->price = $request->input('price');
            $item->image = $request->input('image');
            $item->save();

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

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Item removed from the cart successfully.');
        } else {
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Item not found in the cart.');
        }
    }
}
