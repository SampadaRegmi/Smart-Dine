@extends('User.Layouts.headerfooter')
@section('content')
    <section style="height: 100vh;" class="bg-danger d-flex justify-content-center">
        <div class="card bg-transparent m-auto" style="width:50%">
            <div class="card-body text-center">
                <h1 class="card-title text-light">This is my cart</h1>
                <div>
                    <form id="checkoutForm" action="{{ route('orders.storeFromCart') }}" method="POST">

                        @csrf
                        <table class="table" id="cartTable">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Sub Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach ($carts as $key => $cart)
                                    <tr>
                                        <th>{{ $key + 1 }}</th>
                                        <td>
                                            {{ $cart->menu->name }}
                                            <br>
                                            <img src="{{ $cart->menu->image }}" alt="Item Image" style="width: 50px; height: 50px;">
                                        </td>
                                        <td>Rs.{{ $cart->price }}</td>
                                        <td>{{ $cart->quantity }}</td>
                                        <td>Rs.{{ $cart->price * $cart->quantity }}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger delete-btn" onclick="deleteCartItem(this)">Delete</button>
                                            <input type="hidden" name="menu_id[]" value="{{ $cart->menu->id }}">
                                        </td>
                                    </tr>
                                    @php $total += $cart->price * $cart->quantity; @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            <p>Total: Rs.{{ $total }}</p>
                            <select id="orderType" name="order_type" class="form-select mb-3" required>
                                <option value="" disabled selected>Select Order Type</option>
                                <option value="take_away">Take Away</option>
                                <option value="dine_in">Dine In</option>
                            </select>
                            <button type="submit" onclick="placeOrder()">Place Order</button>
                            <p id="error-message" style="color: red; display: none;">Please select an order type.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                function deleteCartItem(button) {
                    $(button).closest('tr').remove();
                }

                window.placeOrder = function() {
                    // Check if there are items in the cart
                    var cartItems = $('#cartTable tbody tr').length;

                    if (cartItems === 0) {
                        $('#error-message').text('Please add items to the cart before placing an order.').show();
                        return false; // Do not submit the form
                    }

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
    </section>
@endsection