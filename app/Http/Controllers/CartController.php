<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Menu; 
class CartController extends Controller
{   
 
    public function cart(){

        return view('User.Layouts.cart');
    }

    public function addToCart(Request $request, $id)
    {
        $menuItem = Menu::find($id);
    
        if (!$menuItem) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    
        $cart = $request->session()->get('cart', []);
    
        if (array_key_exists($id, $cart)) {
            // If the item is already in the cart, increase the quantity
            $cart[$id]['quantity']++;
        } else {
            // If the item is not in the cart, add it
            $cart[$id] = [
                'id' => $id,
                'name' => $menuItem->name,
                'price' => $menuItem->price,
                'quantity' => 1,
                'image' => $menuItem->image,
                // Add other item details as needed
            ];
        }
    
        $request->session()->put('cart', $cart);
    
        return response()->json(['success' => 'Product added to cart']);
    }
    

    public function showCart(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $total = $this->calculateTotal($cart);

        return view('User.Layouts.cart')->with(['cart' => $cart, 'total' => $total]);
    }

    private function calculateTotal($cart)
    {
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }
}
