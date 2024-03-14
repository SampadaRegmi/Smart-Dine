<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderItem;

class PaymentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Retrieve the latest order for the user
        $latestOrder = Order::where('user_id', $user->id)->latest()->first();

        // Check if there is a latest order
        if ($latestOrder) {
            $total = $latestOrder->total_amount;
        } else {
            $total = 0; // Set a default value if no order is found
        }

        return view('User.Layouts.Payment', compact('total'));
    }

    public function verifyPayment(Request $request)
    {
        $token = $request->token;
        $args = http_build_query(array(
        'token' => $token,
        'amount'  => 1000
        ));

        $url = "https://khalti.com/api/v2/payment/verify/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $secretKey = config('app.khalti_secret_key');

        $headers = ['Authorization: Key test_secret_key_f59e8b7d18b4499ca40f68195a846e9b'];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $response;
    }

    public function storePayment(Request $request)
    {
        $orderId = $request->input('order_id'); 

        // Validate that the order_id is present and numeric
        if (!$orderId || !is_numeric($orderId)) {
            return redirect()->route('orders.index')->with('error', 'Invalid order ID!');
        }

        $order = Order::find($orderId);

        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Order not found!');
        }

        $order->payment_status = true;
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order successful!');
    }
}
