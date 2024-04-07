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
use App\Events\NewOrderPlaced;
use App\Events\OrderCreated;

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
        $carts = Cart::where('user_id', Auth::id())->get();
        $sub_total = 0;
        $discount = 0;
        $totalAmount = 0;
        $orderDetails = [];

        foreach ($carts as $cart) {
            $sub_total += $cart->sub_total;
            $discount += $cart->discount;
            $totalAmount += $cart->total;

            $orderDetails[] = [
                'menu_id' => $cart->menu_id,
                'quantity' => $cart->quantity,
                'image' => $cart->menu->image,
                'price' => $cart->menu->price,
            ];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_type' => $request->input('order_type'),
            'sub_total' => $sub_total,
            'discount' => $discount,
            'total_amount' => $totalAmount,
            'payment_status' => false,
            'order_details' => json_encode($orderDetails),
        ]);
        event(new OrderCreated($order));

        // Delete the carts after the order is created
        $carts->each->delete();

        return redirect()->route('order.success', compact('order'));
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
            $order = Order::findOrFail($orderId);
            $menu = $order->menuItems;
            $user = Auth::user();

            return view('orders.review', compact('order', 'menu', 'user', 'orderId'));
        } catch (\Exception $e) {
            return redirect()->route('orders.index')->with('error', 'Failed to load order for review: ' . $e->getMessage());
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

            // Iterate over each item in the order and create a review for each item
            foreach ($orderDetails as $item) {
                // Create a new Review instance
                $review = new Review();
                $review->rating = $validatedData['star'];
                $review->comment = $validatedData['comment'];
                $review->menu_id = $item['menu_id']; // Use the menu_id of the current item
                $review->user_id = Auth::id();
                $review->order_id = $orderId; // Use the provided orderId

                // Save the review to the database
                $review->save();
            }

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


    public function updatePaymentStatus(Request $request, $orderId)
    {
        $order = Order::find($orderId);
        if ($order) {
            // Process payment logic here
            $order->payment_status = 'paid';
            $order->save();

            // Other logic...

            return redirect()->back()->with('success', 'Payment processed successfully.');
        } else {
            return redirect()->back()->with('error', 'Order not found.');
        }
    }

    public function notifications()
    {
        $notifications = auth()->user()->notifications()->paginate(10); // Paginate notifications

        return view('Admin.Pages.notifications', compact('notifications'));
    }
}
