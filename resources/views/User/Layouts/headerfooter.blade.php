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
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            overflow: hidden; /* Prevents unnecessary scrollbar */
        }

        nav {
            background-color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px; /* Add padding for better spacing */
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
</head>
<body>
    <header>
        <nav>
            <h1 class="text-logo">Smart Dine</h1>
                <a href="{{ route('home') }}">Home</a>
                <!-- In your blade file -->
                <a href="{{ route('user.menu.category') }}">Menu</a>
                <a href="{{ route('cart') }}">Cart</a>
                    <div class="dropdown" id="profileDropdown">
                        <span class="dropdown-label">Profile</span>
                        <div class="dropdown-content">
                            <a href="{{ route('user.editProfile') }}">Edit Profile</a>

                            <!-- Admin Panel link for admin users -->
                            @if (Auth::user()->role == 'admin')
                                <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
                            @endif

                            <!-- Logout form -->
                            <form class="logout-form" action="{{ route('logout') }}" method="POST" id="logoutForm">
                                @csrf
                                <button type="submit" style="background: none; border: none; cursor: pointer; color: white;">Logout</button>
                            </form>
                            <!-- End of Logout form -->
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</body>
</html>
