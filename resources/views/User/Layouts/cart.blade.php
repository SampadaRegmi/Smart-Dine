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
                        @foreach ($carts as $key => $cart)
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                                    <img src="{{ $cart->menu->image }}" class="w-100" alt="{{ $cart->menu->name }}" />
                                    <a href="#!">
                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                <p><strong>{{ $cart->menu->name }}</strong></p>
                                <p>Price: Rs.{{ $cart->menu->price }}</p>
                                <p>Quantity: {{ $cart->quantity }}</p>
                            </div>

                            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                <p class="text-start text-md-center">
                                    <strong>Subtotal: Rs.{{ $cart->sub_total }}</strong>
                                </p>
                            </div>

                            <div class="col-lg-12 mt-3">
                                <button type="button" class="btn btn-danger remove-item" data-item-id="{{ $cart->id }}" style="padding: 0.2rem 0.4rem; font-size: 0.8rem; border-radius: 5%;">
                                    <i class="fas fa-times" style="color: white;"></i>
                                </button>
                            </div>
                        </div>
                        <br>
                        @if (!$loop->last)
                        <hr class="my-4" />
                        @endif
                        @endforeach
                        <div class="card mb-4">
                            <div class="card-body">
                                <p><strong>Subtotal</strong></p>
                                <p class="text-end">Rs.{{ $carts->sum('sub_total') }}</p>
                                <p><strong>Discount</strong></p>
                                <p class="text-end">Rs.{{ $carts->sum('discount') }}</p>
                                <p><strong>Total amount</strong></p>
                                <p class="text-end">Rs.{{ $carts->sum('total') }}</p>
                            </div>
                        </div>


                        <form id="checkoutForm" action="{{ route('orders.storeFromCart') }}" method="POST">
                            @csrf
                            <select id="orderType" name="order_type" class="form-select mb-3" required>
                                <option value="take_away">Take Away</option>
                                <option value="dine_in" selected>Dine In</option>
                            </select>
                            <button type="button" class="btn btn-primary btn-lg btn-block" onclick="placeOrder()">Place Order</button>
                            <p id="error-message" style="color: red; display: none;"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.remove-item').click(function() {
            var $removeBtn = $(this);
            var itemId = $removeBtn.closest('button').data('item-id');
            $.ajax({
                url: "{{ route('cart.delete', ':id') }}".replace(':id', itemId),
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    console.log(res);
                    if (res.status === 300) {
                        window.location.replace('/login');
                    } else if (res.status === 200) {
                        alert('Cart deleted Successfully');
                        $removeBtn.closest('.row').remove();
                    } else if (res.status === 400) {
                        alert('Error');
                    }
                },
                error: function(err) {
                    console.log(err);
                    alert('An error occurred');
                }
            });
        });

        $('#checkoutForm').submit(function(e) {
            var orderType = $('#orderType').val();
            if (orderType === "") {
                $('#error-message').text('Please select an order type.').show();
                e.preventDefault(); // Prevent form submission
            } else {
                $('#error-message').hide();
            }

            var cartCount = {{ $carts->count() }};
            if (cartCount === 0) {
                $('#error-message').text('Your cart is empty.').show();
                e.preventDefault(); // Prevent form submission
            }
        });

        // Directly call placeOrder function within the click event handler
        $('#checkoutButton').click(function() {
            var orderType = $('#orderType').val();
            if (orderType === "") {
                $('#error-message').text('Please select an order type.').show();
            } else {
                placeOrder();
            }
        });
    });

    function placeOrder() {
        $('#checkoutForm').submit();
    }
</script>
@endsection
