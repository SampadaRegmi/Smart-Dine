<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Cart</title>
</head>
    <style>
        .success-message {
            background-color: #4CAF50; /* Green background color */
            color: white; /* White text color */
            padding: 15px; /* Padding */
            text-align: center; /* Center text horizontally */
            margin-bottom: 20px; /* Margin bottom to separate from other elements */
        }

        /* Adjusted width for the table columns */
        table {
            width: 100%;
        }

        table th, table td {
            text-align: left;
            padding: 8px;
        }

        table th:nth-child(1) {
            width: 30%; /* Adjusted width for the "Image" column */
        }

        table th:nth-child(2),
        table td:nth-child(2),
        table th:nth-child(3),
        table td:nth-child(3),
        table th:nth-child(4),
        table td:nth-child(4) {
            width: 15%; /* Adjusted width for the "Price", "Quantity", and "Sub Total" columns */
        }

        table th:nth-child(5),
        table td:nth-child(5) {
            width: 10%; /* Adjusted width for the last empty column */
        }
    </style>
    <body>
        @include('User.Layouts.headerfooter')
        <div class="container">
            <div class="row">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Sub Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @if(session('cart'))
                            @foreach(session('cart') as $id => $menuItem)
                                <tr>
                                    <td>
                                        @if(isset($menuItem['image']))
                                            <img src="{{ $menuItem['image'] }}" alt="{{ $menuItem['name'] }}" style="max-width: 50px; max-height: 50px;">
                                        @endif
                                        {{ $menuItem['name'] }}
                                    </td>
                                    <td>{{ $menuItem['price'] }}</td>
                                    <td>{{ $menuItem['quantity'] }}</td>
                                    <td>{{ $menuItem['price'] * $menuItem['quantity'] }}</td>
                                    <td>
                                        <!-- You can add a remove button or any other actions here -->
                                    </td>
                                </tr>
                                @php $total += $menuItem['price'] * $menuItem['quantity']; @endphp
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div>Total: {{ $total }}
                <!-- Order Now Button -->
                <button class="btn btn-success">Order Now</button>
            </div>
            <br>
            <div>
                <button class="btn btn-primary" onclick="window.location='{{ route('user.menu.category') }}'">Back to Menu</button>
            </div>
        </div>
    </body>

    <!-- ... (previous HTML code) ... -->

    <script>
    // Function to handle "Add to Cart" button click
    function addToCart(id, title, price) {
        let cart = JSON.parse(localStorage.getItem("cart")) || {}; // Load or initialize the cart from local storage

        if (id in cart) {
            cart[id].quantity++;
        } else {
            let cartItem = {
                title: title,
                price: price,
                quantity: 1
            };
            cart[id] = cartItem;
        }

        // Update the cart in local storage
        localStorage.setItem('cart', JSON.stringify(cart));

        // You can choose to update the cart display on the page dynamically or on a page refresh
        updateCartDisplay();
    }

    // Function to update the cart display on the page (you need to implement this)
    function updateCartDisplay() {
        // Implement the code to update the cart display as needed
        // This can include updating the total, showing the added items, etc.
    }

    // Example HTML button for "Add to Cart"
    <button onclick="addToCart('item_id', 'Item Title', 19.99)">Add to Cart</button>

    </script>

    <!-- ... (remaining HTML code) ... -->

</html>

