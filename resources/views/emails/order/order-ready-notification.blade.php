<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        h1 {
            font-size: 24px;
            margin-top: 0;
        }

        p {
            margin: 10px 0;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total-row td {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Order Ready Notification</h1>
        <p>Hello,</p>
        <p>Your order is ready for pickup. Below are the details:</p>

        <ul>
            <li><strong>User:</strong> {{ $order->user->name }}</li>
            <li><strong>Order ID:</strong> {{ $order->id }}</li>
            <li><strong>Total Amount:</strong> Rs. {{ $order->total_amount }}</li>
            <li><strong>Order Type:</strong> {{ $order->order_type }}</li>
        </ul>

        <h2>Order Details:</h2>
        @if (!empty($order->order_details))
        <table>
            <thead>
                <tr>
                    <th>Menu Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach (json_decode($order->order_details) as $orderDetail)
                @php
                $menu = App\Models\Menu::find($orderDetail->menu_id);
                @endphp
                <tr>
                    <td>{{ $menu->name }}</td>
                    <td>{{ $orderDetail->quantity ?? 'N/A' }}</td>
                    <td>Rs. {{ $orderDetail->price ?? 'N/A' }}</td>
                </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="2">Total Amount</td>
                    <td>Rs. {{ $order->total_amount }}</td>
                </tr>
            </tbody>
        </table>
        @else
        <p>No order details available</p>
        @endif

        <p>Thanks,</p>
        <p>{{ config('app.name') }}</p>
    </div>
</body>

</html>
