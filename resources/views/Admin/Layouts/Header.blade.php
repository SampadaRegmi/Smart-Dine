<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header with Logout</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .header-content {
            background-color: #333;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .header-menu {
            display: flex;
            align-items: center;
        }

        .user {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .bg-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-size: cover;
            margin-right: 10px;
        }

        #logoutIcon {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header>
        <div class="header-content">
            <label for="menu-toggle">
                <span class="las la-bars"></span>
            </label>

            <div class="header-menu">
                <div class="user" id="logoutUser">
                    <div class="bg-img" style="background-image: url(img/1.jpeg)"></div>

                    <span class="las la-power-off" id="logoutIcon"></span>
                    <span>Logout</span>
                </div>

                <a href="{{ route('home') }}" class="user" id="backToHome" style="color: white;">
                    <div class="bg-img" style="background-image: url(img/1.jpeg)"></div>
                    <span class="las la-power-off" id="back"></span>
                    <span>Back to Home</span>
                </a>

            </div>
        </div>
    </header>

    <!-- Include jQuery if not already included -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#logoutIcon').on('click', function () {
                // Perform an AJAX request to initiate the logout
                $.ajax({
                    url: '/logout', // Replace with the actual logout route
                    type: 'POST',
                    data: {_token: '{{ csrf_token() }}'},
                    success: function () {
                        // Redirect to the login page or perform other actions
                        window.location.href = '/login'; // Replace with the desired URL
                    },
                    error: function () {
                        alert('Error during logout'); // Handle error accordingly
                    }
                });
            });
        });
    </script>
</body>
</html>
