<!DOCTYPE html>
<html lang="en">

<head>
    <!-- head -->
    @include('Admin.Layouts.head')
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <!-- sidebar -->
    @include('Admin.Layouts.Sidebar')

    <div class="main-content">

        <!-- header -->

        @include('Admin.Layouts.Header')

        <main>

            <!-- breadcumb -->
            @include('Admin.Layouts.Breadcumb')

            <div class="page-content">
                @include('Admin.Layouts.message')
                <!-- Body contents -->
                @yield('main-content')

            </div>

        </main>

    </div>
</body>

</html>
