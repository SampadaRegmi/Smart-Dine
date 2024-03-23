@extends('Admin.Layouts.Master')

@section('main-content')
<div class="col-12">
    <div class="table-container">
        <table class="table table-striped table-inverse">
            <thead class="thead-inverse">
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>User Phone</th>
                    <th>Order Type</th>
                    <th>Total Amount</th>
                    <th>Payment Status</th>
                    <th>Order Details</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @php
                    // Reverse the order of $orders array
                    $orders = $orders->reverse();
                @endphp
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->user->phone }}</td>
                    <td>{{ $order->order_type }}</td>
                    <td>{{ $order->total_amount }}</td>
                    <td>{{ $order->payment_status }}</td>
                    <td>
                        <ul>
                            @foreach (json_decode($order->order_details) as $orderDetail)
                                @php
                                    $menu = \App\Models\Menu::find($orderDetail->menu_id);
                                @endphp
                                @if ($menu)
                                    <li>
                                        {{ $menu->name }},
                                        Price: Rs.{{ $menu->price }},
                                        Quantity: {{ $orderDetail->quantity }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $order->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table-container {
        overflow-y: auto;
    }
</style>
@endpush
