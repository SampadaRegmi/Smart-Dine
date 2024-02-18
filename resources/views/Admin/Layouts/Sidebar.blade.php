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
            </ul>
        </div>
    </div>
</div>