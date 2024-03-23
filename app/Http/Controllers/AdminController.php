<?php

namespace App\Http\Controllers;
use App\Models\Feedback;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Review;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $admin = Auth::User(); // Retrieve the authenticated admin user
        return view('Admin.Pages.Dashboard', compact('admin'));
    }

        public function sidebarData()
    {
        $admin = Auth::user(); // Retrieve the authenticated admin user

        return view('Admin.Layouts.Sidebar', compact('admin'));
    }

    public function adminLogout()
    {
        Auth::logout(); // Logout the admin
        return redirect()->route('login'); // Redirect to the standard login route
    }

    public function showFeedback()
    {
         $admin = Auth::user();
         $feedbacks = Feedback::all();

         return view('Admin.Pages.feedback', compact('feedbacks'));
    }

    public function userCart(Request $request)
    {
        // Retrieve all users
        $users = User::all();

        // Loop through each user to fetch their cart items
        $userCarts = [];

        foreach ($users as $user) {
            // Retrieve the carts associated with the user
            $carts = $user->carts()->get();

            // Initialize an array to store cart items for this user
            $cartItems = [];

            // Loop through each cart to retrieve its items
            foreach ($carts as $cart) {
                // Retrieve the cart items associated with this cart
                $items = $cart->items()->get();

                // Merge cart items into the array
                $cartItems = array_merge($cartItems, $items->toArray());
            }

            // Store user and their cart items
            $userCarts[$user->id] = [
                'user' => $user,
                'cartItems' => $cartItems,
            ];
        }

        return view('Admin.Pages.userCart', compact('carts'));
    }

    public function userOrders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get(); // Fetching orders for the authenticated user
        $menuId = 1; // Replace 1 with the actual menu ID you want to pass to the view
        
        return view('Admin.Pages.userOrders', compact('orders', 'menuId')); // Passing $orders and $menuId to the view
    }

    public function userRatings()
    {
        // Retrieve reviews along with their associated menu items
        $reviews = Review::with('menu')->get();
        
        return view('Admin.Pages.userRatings', compact('reviews'));
    }
    
}




