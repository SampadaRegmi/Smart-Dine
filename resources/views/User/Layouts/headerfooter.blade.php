<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <title>Smart Dine </title>
    <script>
        document.getElementById('profileDropdown').addEventListener('mouseover', function () {
            document.getElementById('profileDropdown').classList.add('hovered');
        });

        document.getElementById('profileDropdown').addEventListener('mouseout', function () {
            document.getElementById('profileDropdown').classList.remove('hovered');
        });

        document.getElementById('logoutForm').addEventListener('submit', function (event) {
            event.preventDefault();
            document.getElementById('logoutForm').submit();
        });
    </script>
    <style>
        body {
            margin: 80px 0 0;
            padding: 0;
            font-family: Arial, sans-serif;
            overflow: auto;
        }

        nav {
            background-color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%; 
            padding: 0 20px;
            position: fixed;
            top: 0;
            z-index: 1000;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 14px 16px;
            text-align: center;
        }

        nav a:hover {
            background-color: #555; /* Darken the background on hover */
            color: white;
        }

        .text-logo {
            color: white;
            max-width: 300px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #333;
            min-width: 140px;
            z-index: 1;
            border-radius: 4px; /* Optional: Add some border-radius for a softer look */
            top: 100%; /* Position the dropdown below the link */
            left: -40px; /* Adjust the left position to make it slightly visible */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); /* Optional: Add a box shadow for a subtle lift */
            padding: 10px; /* Add padding inside the dropdown */
        }

        .dropdown-content a {
            color: white;
            text-decoration: none;
            display: block;
            text-align: left;
            padding: 8px 0;
            margin-right: 20px;
        }

        .dropdown-content a:hover {
            background-color: #555; /* Darken the background on hover */
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-arrow {
            display: inline-block;
            margin-left: 5px;
            font-size: 10px; /* Adjust the size as needed */
        }

        /* Styling for the gray-colored box */
        .dropdown-box {
            background-color: #888; /* Gray color */
            padding: 10px; /* Add padding inside the box */

            border-radius: 4px; /* Optional: Add border-radius for a softer look */
        }

        /* Styling for the white-colored profile label */
        .dropdown-label {
            color: white;
            cursor: pointer;
        }

        footer {
            background-color: #b6b3b3;
            color: #fff;
            padding: 20px 0;
        }
        
        .container-2 {
            max-width: 960px;
            margin: 0 auto;
        }
        
        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        
        .col-md-4 {
            width: 33.33%;
            color: black;
        }
        
        h4 {
            font-size: 20px;
            margin-bottom: 20px;
        }
        
        ul {
            list-style: none;
            padding: 0;
        }
        
        li {
            margin-bottom: 10px;
        }

        a{
            color: black;
            text-decoration: none;
        }
        
        hr {
            border-top: 1px solid #fff;
            margin: 15px 0;
        }

        p{
            color: black;
            margin: 5px;
        }

        /* Responsive adjustments */
        @media only screen and (min-width: 768px) { /*Desktop*/
            .profile {
                width: 450px;
            }
        }

        @media only screen and (max-width: 768px) { /*Tablet*/
            .profile {
                width: 70%;
            }
        }

        @media only screen and (min-width: 320px) and (max-width: 520px) { /*Phone*/
            .profile {
                width: 90%;
            }
        }
    </style>
    <script>
        function validateSearch() {
            // Get the value of the keywords input
            var keywordsInput = document.getElementById('keywords');
            var keywordsValue = keywordsInput.value.trim();

            // Check if the search box is empty
            if (keywordsValue === '') {
                // Prevent form submission if the search box is empty
                alert('Please enter something in the search box');
                return false;
            }

            // Allow form submission if the search box is not empty
            return true;
        }
    </script>
</head>
<body>
    <header>
        <nav>
            <h1 class="text-logo">Smart Dine</h1>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('category') }}">Menu</a>
            <a href="{{ route('cart.index') }}">Cart</a>
            <form id="searchForm" method="post" action="{{ route('menu.search') }}">
                @csrf
                <input type="text" name="keywords" id="keywords">
                <button type="submit" id="searchButton" onclick="return validateSearch()">Search</button>
            </form>
            <div class="dropdown" id="profileDropdown">
                <span class="dropdown-label">Profile</span>
                <div class="dropdown-content">
                    <a href="{{ route('user.editProfile') }}">Edit Profile</a>
                    <li><a href="{{ route('orders.index') }}">Orders</a></li>
                    @if (Auth::user()->role == 'admin')
                        <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
                    @endif
                    <form class="logout-form" action="{{ route('logout') }}" method="POST" id="logoutForm">
                        @csrf
                        <button type="submit" style="background: none; border: none; cursor: pointer; color: white;">Logout</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <div class="content">
        @yield('content')
    </div>
    <footer>
    <div class="container-2">
          <div class="row">
            <div class="col-md-4">
              <h4>Location</h4>
              <p>Biratnagar-3, DDC</p>
            </div>
            <div class="col-md-4">
              <h4>Contact Us</h4>
              <p>Email: sampadaregmi90@gmail.com</p>
              <p>Phone: +977 9861906534</p>
            </div>
            <div class="col-md-4">
              <h4>Follow Us</h4>
              <ul>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Tiktok</a></li>
                <li><a href="#">Instagram</a></li>
              </ul>
            </div>
          </div>
          <hr>
          <p>&copy; 2024 Smart Dine. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
