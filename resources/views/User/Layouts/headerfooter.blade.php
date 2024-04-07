<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Smart Dine </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/08377006cd.js" crossorigin="anonymous"></script>
    <link href="{{asset('home.css')}}" rel="stylesheet">

</head>

<body>
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto me-lg-0" style="text-decoration:none;">
                <h1 style="color: maroon">Smart Dine </h1>
            </a>
            <button class="navbar-toggle">
                <i class="bi bi-list"></i>
            </button>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('category') }}">Menu</a></li>
                    <li><a href="{{ route('cart.index') }}">Cart</a></li>
                    <li class="dropdown"><a href="#"><span>Profile</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            <li><a href="{{ route('user.editProfile') }}">Profile</a></li>
                            <li><a href="{{ route('orders.index') }}"> View Orders</a></li>
                            @if (Auth::user()->role == 'admin')
                            <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
                            @endif
                            <form class="logout-form" action="{{ route('logout') }}" method="POST" id="logoutForm">
                                @csrf
                                <div style="display: flex; justify-content: center;">
                                    <button type="submit" style="background-color: white; border: 1px solid black; padding: 6px 12px; cursor: pointer; color: black; border-radius: 3px; font-size: 14px;">Logout</button>
                                </div>
                            </form>
                        </ul>
                    </li>
                    <li>
                        <form id="searchForm" method="post" action="{{ route('menu.search') }}">
                            @csrf
                            <input type="text" name="keywords" id="keywords" placeholder="Search...">
                            <button type="submit" id="searchButton" onclick="return validateSearch()" style="background-color: maroon; border: 1px solid black; padding: 1.5px 10px; cursor: pointer; color: white; border-radius: 4px;">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav><!-- .navbar -->
        </div>
    </header>

    <div class="content">
        @yield('content')
    </div>
    <footer id="footer" class="footer">
        <div class="container">
            <div class="row gy-3">
                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-geo-alt icon"></i>
                    <div>
                        <h4>Address</h4>
                        <p>
                            Opposite to DDC <br>
                            Biratnagar 3, State-1 - Nepal<br>
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 footer-links d-flex">
                    <i class="bi bi-telephone icon"></i>
                    <div>
                        <h4>Reservations</h4>
                        <p>
                            <strong>Phone:</strong> 9800932581 <br>
                            <strong>Email:</strong> hiltonhotel101.com<br>
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links d-flex">
                    <i class="bi bi-clock icon"></i>
                    <div>
                        <h4>Opening Hours</h4>
                        <p>
                            <strong>Mon-Sat: 11 A:M</strong> -10PM<br>
                            Saturday: Closed
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Follow Us</h4>
                    <div class="social-links d-flex">
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>Smart Dine</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">Sampada Regmi</a>
            </div>
        </div>
    </footer>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const navbarToggle = document.querySelector('.navbar-toggle');
            const navbar = document.querySelector('.navbar');

            navbarToggle.addEventListener('click', function() {
                navbar.classList.toggle('show');
                // Toggle the show class on the ul element inside navbar
                const navbarList = navbar.querySelector('ul');
                navbarList.classList.toggle('show');
            });
        });


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


</body>

</html>
