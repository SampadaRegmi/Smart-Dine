@extends('User.Layouts.headerfooter')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <section class="h-100 gradient-custom">
        <div class="container py-5">
            <div class="row d-flex justify-content-center my-4">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Cart - {{ $carts->count() }} items</h5>
                        </div>
                        <div class="card-body">
                            <!-- Cart items loop -->
                            @foreach ($carts as $key => $cart)
                                <div class="row align-items-center">
                                    <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                        <!-- Image -->
                                        <div class="bg-image hover-overlay hover-zoom ripple rounded"
                                            data-mdb-ripple-color="light">
                                            <img src="{{ $cart->menu->image }}" class="w-100"
                                                alt="{{ $cart->menu->name }}" />
                                            <a href="#!">
                                                <div class="mask"
                                                    style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                            </a>
                                        </div>
                                        <!-- Image -->
                                    </div>

                                    <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                        <!-- Data -->
                                        <p><strong>{{ $cart->menu->name }}</strong></p>
                                        <p>Price: Rs.{{ $cart->price }}</p>
                                        <p>Quantity: {{ $cart->quantity }}</p>
                                        <!-- Data -->
                                    </div>

                                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                        <!-- Subtotal -->
                                        <p class="text-start text-md-center">
                                            <strong>Subtotal: Rs.{{ $cart->price * $cart->quantity }}</strong>
                                        </p>
                                        <!-- Subtotal -->
                                    </div>

                                    <!-- Delete button -->
                                    <div class="col-lg-12 mt-3">
                                        <button type="button" class="btn btn-danger delete-btn"
                                            onclick="deleteCartItem({{ $cart->id }})"
                                            style="padding: 0.2rem 0.4rem; font-size: 0.8rem; border-radius: 5%;">
                                            <i class="fas fa-times" style="color: white;"></i> <!-- Cross icon -->
                                            Delete
                                        </button>
                                    </div>
                                    <!-- Delete button -->

                                    <!-- Delete button -->
                                </div>
                                <!-- Single item -->
                                @if (!$loop->last)
                                    <hr class="my-4" />
                                @endif
                            @endforeach
                            <!-- Cart items loop -->

                            <hr class="my-4" />

                            <!-- Summary -->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <p><strong>Total amount</strong></p>

                                    <p class="text-end"><strong>Rs.{{ $total }}</strong></p>
                                </div>
                            </div>
                            <!-- Summary -->

                            <!-- Order type selection -->
                            <!-- Order type selection -->
                            <form id="checkoutForm" action="{{ route('orders.storeFromCart') }}" method="POST">
                                @csrf
                                <select id="orderType" name="order_type" class="form-select mb-3" required>
                                    <option value="" disabled selected>Select Order Type</option>
                                    <option value="take_away">Take Away</option>
                                    <option value="dine_in">Dine In</option>
                                </select>
                                <button type="button" class="btn btn-primary btn-lg btn-block" onclick="placeOrder()">Place Order</button>
                                <p id="error-message" style="color: red; display: none;"></p> <!-- Error message container -->
                            </form>
                            <!-- Order type selection -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
        $(document).ready(function() {
            window.placeOrder = function() {
                // Check if order type is selected
                var orderType = $('#orderType').val();

                if (orderType === "") {
                    $('#error-message').text('Please select an order type.').show();
                    return false; // Do not submit the form
                } else {
                    $('#error-message').hide();
                    $('#checkoutForm').submit();
                }
            };
        });
    </script>
    <script>
        function deleteCartItem(id) {
        console.log('Attempting to delete cart item with ID:', id);
        
        $.ajax({
            url: '/cart/' + id,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log('Cart item deleted successfully');
                // Handle UI updates if needed
            },
            error: function(xhr, status, error) {
                console.error('Failed to delete cart item:', xhr.status);
                // Handle error appropriately
            }
        });
    }
    </script>
@endsection
