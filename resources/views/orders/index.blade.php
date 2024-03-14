@extends('User.Layouts.headerfooter')

@section('content')

@foreach ($orders as $order)

    <h3>Order ID: {{ $order->id }}</h3>

    <p>Total Amount: {{ $order->total_amount }}</p>

    <p>Order Type: {{ $order->order_type }}</p>

    <p>Order Details:</p>

    <ul>

        @foreach ($order->menuItems as $detail)

            <li>Menu Name: {{ $detail->menu_name }}, Quantity: {{ $detail->pivot->quantity }}</li>

        @endforeach

    </ul>

@endforeach

@endsection
