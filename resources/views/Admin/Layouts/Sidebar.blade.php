<div class="sidebar">
    <div class="side-header">
        <h3>Smart<span>Dine</span></h3>
    </div>

    <div class="profile">
        <!-- Displaying Admin's Name if $admin is set -->
        @if(isset($admin))
            <h4>Welcome {{ $admin->name }}</h4>
        @else
            <h4>Welcome</h4> <!-- Default message if $admin is not set -->
        @endif
        <small>Admin</small>
    </div>
        <div class="side-menu">
            <ul>
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="{{ Route::current()->getName() == 'admin.dashboard' ? 'active' : '' }}">
                        <span class="las la-home"></span>
                        <small>Dashboard</small>
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.index') }}"
                        class="{{ Route::current()->getName() == 'user.index' ? 'active' : '' }}">
                        <span class="las la-users"></span>
                        <small>Users</small>
                    </a>
                </li>
                <li>
                    <a href="{{ route('menu.index') }}">
                        <span class="las la-book"></span>
                        <small>Menu</small>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.pages.userOrders') }}">
                        <span class="las la-pizza-slice"></span>
                        <small>Orders</small>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.pages.userCart') }}">
                        <span class="las la-shopping-cart"></span>
                        <small>Cart</small>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.pages.feedback') }}">
                        <span class="las la-glasses"></span>
                        <small>See Feedbacks</small>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.pages.userRatings') }}">
                        <span class="las la-star"></span>
                        <small>Ratings</small>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
