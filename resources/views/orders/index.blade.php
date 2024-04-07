@extends('User.Layouts.headerfooter')
@section('content')
<style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet" /><link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.css" rel="stylesheet" /><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"><link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" /><link rel="stylesheet" href="https://gensuiteqa.genalphacatalog.com/gensuite/css/ps/mdb.min.css?version=0707050300507050503" type='text/css' /><link rel="stylesheet" href="https://gensuiteqa.genalphacatalog.com/gensuite/css/ps/storefront.css?version=0707050300507050503" type='text/css' /><link rel="stylesheet" href="https://gensuiteqa.genalphacatalog.com/gensuite/css/ps/autocomplete.css?version=0707050300507050503" /><link rel="stylesheet" type="text/css" href="../css/ps/theme.css?version=0707050300507050503"><link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" /><link href="//cdn.datatables.net/plug-ins/1.10.19/integration/font-awesome/dataTables.fontAwesome.css" rel="stylesheet" type="text/css" /><link rel="stylesheet" type="text/css" href="https://gensuiteqa.genalphacatalog.com/gensuite/css/ps/orderhistory.css?version=0707050300507050503" />
</style>
<div class="container"> <!-- Add a container to wrap your content -->
    <div class="table-responsive pb-5">
        <table id="tbOrderHistory" class="table border ps-table w-100 mb-3">
            <thead>
                <tr>
                    <th class="font-weight-bold py-2 border-0">ID</th>
                    <th class="font-weight-bold py-2 border-0">Orders</th>
                    <th class="font-weight-bold py-2 border-0">Type</th>
                    <th class="font-weight-bold py-2 border-0">Sub Total</th>
                    <th class="font-weight-bold py-2 border-0">Discount</th>
                    <th class="font-weight-bold py-2 border-0">Total</th>
                    <th class="font-weight-bold py-2 border-0">Created</th>
                    <th class="font-weight-bold py-2 border-0">Review</th>
                    <th class="font-weight-bold py-2 border-0">Payment</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders->reverse() as $order) <!-- Use reverse() method here -->
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>
                        @foreach (json_decode($order->order_details) as $orderDetail)
                        @php
                        $menu = App\Models\Menu::find($orderDetail->menu_id);
                        @endphp
                        @if ($menu)
                        {{ $menu->name }} * {{ $orderDetail->quantity }}
                        @endif
                        <br>
                        @endforeach
                    </td>
                    <td>{{ $order->order_type }}</td>
                    <td>{{ $order->sub_total }}</td>
                    <td>{{ $order->discount }}</td>
                    <td>{{ $order->total_amount }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        @php
                        $reviewed = App\Models\Review::where('order_id', $order->id)->exists();
                        @endphp
                        @if ($reviewed)
                        Reviewed
                        @else
                        <a href="{{ route('order.review', $order->id) }}" class="btn btn-primary">Review</a>
                        @endif
                    </td>

                    <td>
                        @if ($order->payment_status == 'pending')
                        <form id="paymentForm{{$order->id}}" action="{{ route('khalti.payment', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Payment</button>
                        </form>
                        @else
                        Paid
                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div> <!-- Close the container -->

@endsection
