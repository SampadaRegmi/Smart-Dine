@extends('User.Layouts.headerfooter')
@section('content')
    <style>
        .main-content {
            display: flex;
            justify-content: center;
            margin: auto;
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
            background-color: green;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px; 
        }

        .btn-info{
            margin-top: 8px;
        }

        .star-rating {
            display: inline-block;
            font-size: 25px;
        }

        .star-rating .star {
            color: #ffc107;
            cursor: pointer;
        }

        .star-rating .star.selected {
            color: #ff9800;
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

            // Show alert after form submission
            alert('Product added to the cart successfully!');
        }
    </script>

    <div class="main-content">
        <div class="button-container">
            <button type="button" class="btn btn-primary btn-block mt-3" onclick="location.href='{{ route('category') }}';">All</button>
            <button type="button" class="btn btn-primary btn-block mt-3 " onclick="location.href='{{ url('/appetizers') }}';">Appetizers</button>
            <button type="button" class="btn btn-primary btn-block mt-3" onclick="location.href='/salads';">Salads</button>
            <button type="button" class="btn btn-primary btn-block mt-3" onclick="location.href='/entree';">Entree</button>
            <button type="button" class="btn btn-primary btn-block mt-3" onclick="location.href='/drinks';">Drinks</button>
            <button type="button" class="btn btn-primary btn-block mt-3" onclick="location.href='/desserts';">Desserts</button>
        </div>
    </div>

    <div class="container-fluid mb-5">
        <div class="row justify-content-between px-5">
            @php
                // Sort menu items based on average rating in descending order
                $sortedMenuItems = $menuItems->sortByDesc('averageRating');
            @endphp

            @if ($sortedMenuItems->isEmpty())
                <div class="col-12 text-center mt-5">
                    <h2>😢</h2>
                    <p>The page is empty.</p>
                </div>
            @else
                @foreach($sortedMenuItems as $menuItem)
                    {{-- Your menu item card --}}
                    <div class="col-sm-3 mt-4">
                        <div class="card border border-dark h-100">
                            <img src="{{ asset($menuItem->image) }}" alt="Menu Image" class="card-img-top align-items-center" style="width: 100%; height: 225px;">
                            <div class="card-body d-flex flex-column align-items-start">
                                <h5 class="fw-bold card-text rounded p-1" style="background-color:rgba(247, 81, 81, 0.419);">{{ $menuItem->name }}</h5>
                                <p class="card-text"> <b>Rs.{{ $menuItem->price }} </b></p>
                                <p class="card-text"><b>{{ $menuItem->description }} </b></p>
                                <p class="card-text"><b>{{ $menuItem->FoodCategory }}</b></p>
                                <!-- Star Ratings -->
                                <div class="star-rating" data-rating="{{ $menuItem->averageRating }}">
                                    @for($i = 5; $i >= 1; $i--)
                                        <span class="star {{ $i <= $menuItem->averageRating ? 'selected' : '' }}"></span>
                                    @endfor
                                </div>
                                <!-- Average Rating -->
                                <p class="card-text"> <b>Rating: {{ number_format($menuItem->averageRating, 1) }}/5 </b></p>
                                <!-- Read Reviews Button -->
                                <a href="{{ route('menu.reviews', ['menu' => $menuItem->id]) }}" style="color: maroon;">Reviews</a>
                                <div class="mt-3">
                                    <form action="{{ route('cart.store') }}" method="POST" id="addToCartForm_{{ $menuItem->id }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="quantity">Quantity:</label>
                                            <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1">
                                        </div>
                                        <input type="hidden" name="menu_id" value="{{ $menuItem->id }}">
                                        <input type="hidden" name="price" value="{{ $menuItem->price }}">
                                        <button type="button" class="btn btn-info" onclick="addToCart({{ $menuItem->id }})">Add to cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
