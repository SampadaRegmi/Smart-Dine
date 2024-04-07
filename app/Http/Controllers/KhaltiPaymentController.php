<?php

namespace App\Http\Controllers;

use App\Models\KhaltiPayment;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class KhaltiPaymentController extends Controller
{
    //
    public function initiatePayment(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        Session::put('orderId', $orderId);
        $user = auth()->user();

        $orderDetails = json_decode($order->order_details, true);
        $totalAmount = $order->total_amount * 100;


        $productDetails = collect($orderDetails)->map(function ($item) use ($order) {
            $menu = Menu::find($item['menu_id']);

            if ($menu) {
                return [
                    'identity' => $item['menu_id'],
                    'name' => $menu->name,
                    'total_price' => $order->total_amount * 100,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'] * 100,
                ];
            }

            return null;
        })->filter()->values()->toArray();
        // dd($productDetails);

        $payload = [
            'return_url' => route('khalti.payment.callback'),
            'website_url' => config('app.url'),
            'amount' => $totalAmount,
            'purchase_order_id' => 'order_' . uniqid(),
            'purchase_order_name' => 'Order from ' . $user->name,
            'customer_info' => [
                'name' => $user->name,
                'email' => $user->email,
            ],
            'product_details' => $productDetails,
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Key ' . config('services.khalti.secret_key'),
            'Content-Type' => 'application/json',
        ])->post(config('services.khalti.initiate_payment_url'), $payload);

        $responseData = $response->json();

        if (isset($responseData['payment_url'])) {
            return redirect($responseData['payment_url']);
        } else {
            return redirect()->back()->with('error', 'Failed to initiate payment');
        }
    }

    public function paymentCallback(Request $request)
    {
        $transactionId = $request->input('transaction_id');
        $amount = $request->input('amount');
        $status = $request->input('status');
        $orderId = Session::get('orderId');

        if ($status === 'Completed') {
            $order = Order::findOrFail($orderId);

            if ($order) {
                $order->payment_status = 'paid';
                $order->save();

                KhaltiPayment::create([
                    'order_id' => $order->id,
                    'transaction_id' => $transactionId,
                    'amount' => $amount / 100,
                    'status' => $status,
                ]);
                Session::forget('orderId');

                return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
            } else {
                return redirect()->route('orders.index')->with('error', 'Order not found.');
            }
        }

        return redirect()->route('orders.index')->with('error', 'Payment not completed.');
    }
}
