@extends('User.Layouts.headerfooter')
@section('content')
    <section style="height: 100vh;" class="  bg-danger d-flex justify-content-center">
        <div class="card bg-transparent m-auto" style="width:50%">
            <div class="card-body text-center">
                <h1 class="card-title text-light">Checkout now</h1>
                <div>
                    <form id="myForm" action="{{ route('checkout.store') }}" method="post">
                        @csrf
                        {{-- for checkout --}}
                        <div class="form-group">
                            <label for="name"></label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="phone"></label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                placeholder="Enter phone number">
                        </div>
                        <div class="form-group">
                            <label for="payment_method"></label>
                            <select name="payment_method" class="form-control" id="payment_method">
                                <option value="khalti">Pay with khalti</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="orderType"></label>
                            <select id="orderType" name="order_type" class="form-select mb-3" required>
                                    <option value="" disabled selected>Select Order Type</option>
                                    <option value="take_away">Take Away</option>
                                    <option value="dine_in">Dine In</option>
                            </select>
                        </div>
                        <button id="actionButton">Submit Form</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#myForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Form submission was successful
                    // Redirect to the payment page
                    window.location.href = '{{ route('payment.payment', ['menu_id' => ':menu_id', 'checkout_id' => ':checkout_id']) }}'
                        .replace(':menu_id', response.menu_id)
                        .replace(':checkout_id', response.checkout_id);
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('Form submission failed:', error);
                    // You can display an error message to the user or handle the error in some other way
                }
            });
        });
    </script>
@endsection
