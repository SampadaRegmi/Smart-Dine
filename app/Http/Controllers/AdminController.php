<?php

namespace App\Http\Controllers;

use App\Mail\OrderReadyNotification;
use App\Models\Feedback;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Review;
use App\Models\Menu;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class AdminController extends Controller
{
    public function dashboard()
    {
        $reports = Report::latest()->get();
        return view('Admin.Pages.Dashboard', compact('reports'));
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
        $cart = Cart::all();

        return view('Admin.Pages.userCart', compact('cart'));
    }


    public function userOrders()
    {
        $orders = Order::all();
        return view('Admin.Pages.userOrders', compact('orders'));
    }

    public function userRatings()
    {
        // Retrieve reviews along with their associated menu items
        $reviews = Review::with('menu')->get();

        return view('Admin.Pages.userRatings', compact('reviews'));
    }
    public function sendNotification(Request $request, $orderId)
    {
        $order = Order::find($orderId);
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }
        $user = $order->user;

        $orderDetails = json_decode($order->order_details);
        $data = [
            'user' => $user,
            'order' => $order,
            'orderDetails' => $orderDetails,
        ];
        Mail::to($user->email)->send(new OrderReadyNotification($data));

        return redirect()->back()->with('success', 'Notification email sent successfully.');
    }
}
