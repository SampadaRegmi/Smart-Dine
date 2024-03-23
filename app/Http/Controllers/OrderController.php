<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Menu;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


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
        try {
            // Get the cart items for the current user
            $carts = Cart::where('user_id', Auth::id())->get();

            // Check if the cart is empty
            if ($carts->isEmpty()) {
                return back()->with('error', 'Your cart is empty. Please add items to your cart.');
            }

            // Check if order type is selected
            if (!$request->filled('order_type')) {
                return back()->with('error', 'Please select an order type.');
            }

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

            // Remove the cart items
            foreach ($carts as $cart) {
                $cart->delete();
            }

            return redirect()->route('order.success', compact('order')); // Assuming 'order.success' route exists
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during order creation
            return back()->with('error', 'Failed to create order: ' . $e->getMessage());
        }
    }

    public function show($orderId)
    {
        try {
            // Retrieve the order along with its reviews
            $order = Order::with('reviews')->findOrFail($orderId);
            
            // Pass the order to the view
            return view('orders.show', compact('order'));
        } catch (\Exception $e) {
            // Handle the exception if the order is not found
            return back()->with('error', 'Failed to load order: ' . $e->getMessage());
        }
    }

    public function review($orderId)
    {
        try {
            // Fetch the order details
            $order = Order::findOrFail($orderId);
            
            // Fetch the menu associated with the order
            $menu = $order->menuItems; // Assuming you have a relationship set up between orders and menu items
            
            // Fetch the currently authenticated user
            $user = Auth::user();
            
            // Render the review page and pass the order details, menu, user, and orderId to the view
            return view('orders.review', compact('order', 'menu', 'user', 'orderId'));
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during fetching order for review
            return back()->with('error', 'Failed to load order for review: ' . $e->getMessage());
        }
    }

    public function submitReview(Request $request, $orderId)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Validate the request data
            $validatedData = $request->validate([
                'star' => 'required|integer|min:1|max:5',
                'comment' => 'required|string|max:255',
            ]);

            // Find the order associated with the given orderId
            $order = Order::findOrFail($orderId);

            // Decode the JSON data in the order_details column to access menu items
            $orderDetails = json_decode($order->order_details, true);

            // Check if order details exist and get the menu_id of the first item
            $menuId = isset($orderDetails[0]['menu_id']) ? $orderDetails[0]['menu_id'] : null;

            // Create a new Review instance
            $review = new Review();
            $review->rating = $validatedData['star'];
            $review->comment = $validatedData['comment'];
            $review->menu_id = $menuId;  // Use the menu_id of the first item
            $review->user_id = Auth::id();
            $review->order_id = $orderId; // Use the provided orderId

            // Save the review to the database
            $review->save();

            // Commit the transaction
            DB::commit();

            // Redirect the user to the order details page
            return redirect()->route('orders.show', ['orderId' => $orderId])->with('success', 'Review submitted successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction if an exception occurs
            DB::rollBack();

            // Log the error message
            Log::error('Failed to submit review: ' . $e->getMessage());

            // Redirect back with error message
            return back()->with('error', 'Failed to submit review: ' . $e->getMessage());
        }
    } 
        
}
