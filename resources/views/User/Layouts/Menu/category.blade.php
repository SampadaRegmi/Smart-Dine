@extends('User.Layouts.headerfooter')
@section('content')
    <style>
        .main-content {
            display: flex;
            justify-content: center;
        }

        .button-container {
            display: flex;
            flex-wrap: nowrap;
            gap: 10px;
        }

        .button-container .mt-3 {
            margin-top: 1rem;
        }

        .btn {
            margin: 3px;
            background-color: green;
            color: white; 
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
    <script>
        function addToCart(menuItemId) {
            // Get the form by ID
            var form = document.getElementById('addToCartForm_' + menuItemId);

            // Get the quantity input field value
            var quantityInput = form.querySelector('[name="quantity"]');
            var quantity = parseInt(quantityInput.value, 10);

            // Check if quantity is a valid number
            if (isNaN(quantity) || quantity < 1) {
                alert('Please enter a valid quantity.');
                return;
            }

            // Submit the form
            form.submit();
        }
    </script>
    <div class="main-content">
        <div class="button-container">
        <button type="button" class="btn btn-primary btn-block" onclick="location.href='{{ route('category') }}';">All</button>
            <button type="button" class="btn btn-primary btn-block" onclick="location.href='{{ url('/appetizers') }}';">Appetizers</button>
            <button type="button" class="btn btn-primary btn-block mt-3" onclick="location.href='/salads';">Salads</button>
            <button type="button" class="btn btn-primary btn-block mt-3" onclick="location.href='/entree';">Main Course</button>
            <button type="button" class="btn btn-primary btn-block" onclick="location.href='/drinks';">Drinks</button>
            <button type="button" class="btn btn-primary btn-block mt-3" onclick="location.href='/desserts';">Desserts</button>
        </div>
    </div>
    <div class="container-fluid mb-5">
        <div class="row justify-content-between px-5">
            @foreach($menuItems as $menuItem)
                <div class="col-sm-4 mt-4">
                    <div class="card border border-dark h-100">
                        <img src="{{ $menuItem->image }}" alt="" class="card-img-top align-items-center" style="width: 100%; height: 225px;">
                        <div class="card-body d-flex flex-column align-items-start">
                            <h5 class="fw-bold card-text rounded p-1" style='background-color:rgba(247, 81, 81, 0.419);'>{{ $menuItem->name }}</h5>
                            <p class="card-text"> Rs.{{ $menuItem->price }}</p>
                            <p class="card-text">{{ $menuItem->description }}</p>
                            <div class="mt-3">
                                <form action="{{ route('cart.store') }}" method="POST">
                                    <div class="product_details_cart_option">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="number" name="quantity" value="1" min="1" max="">
                                            </div>
                                        </div>
                                        @csrf
                                        <input type="hidden" name="menu_id" value="{{ $menuItem->id }}">
                                        <input type="hidden" name="price" value="{{ $menuItem->price }}">
                                        <button type="submit" class="btn btn-info">Add to cart</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
