@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Notifications') }}</div>

                    <div class="card-body">
                        @if ($notifications->isEmpty())
                            <p>No notifications found.</p>
                        @else
                            <ul>
                                @foreach ($notifications as $notification)
                                    <li>
                                        <p>{{ $notification->data['message'] }}</p>
                                        <!-- Display order details -->
                                        <p>Order ID: {{ $notification->data['order_id'] }}</p>
                                        <p>Total Amount: {{ $notification->data['total_amount'] }}</p>
                                        <!-- Add other relevant order information here -->
                                    </li>
                                @endforeach
                            </ul>
                            <!-- Pagination links -->
                            {{ $notifications->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
