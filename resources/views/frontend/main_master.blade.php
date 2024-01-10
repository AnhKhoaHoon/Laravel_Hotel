<!doctype html>
<html lang="zxx">

<head>
    @include('frontend.body.head')
</head>

<body>

    <!-- PreLoader Start -->
    <div class="preloader">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="sk-cube-area">
                    <div class="sk-cube1 sk-cube"></div>
                    <div class="sk-cube2 sk-cube"></div>
                    <div class="sk-cube4 sk-cube"></div>
                    <div class="sk-cube3 sk-cube"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- PreLoader End -->

    <!-- Top Header Start -->
    @include('frontend.body.header')
    <!-- Top Header End -->

    <!-- Start Navbar Area -->
    @include('frontend.body.navbar')
    <!-- End Navbar Area -->

    @yield('main')

    <!-- Footer Area -->
    @include('frontend.body.footer')
    <!-- Footer Area End -->

    @include('frontend.body.foot')


</body>

</html>
