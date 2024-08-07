<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from zoyothemes.com/tapeli/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 16 Jul 2024 08:33:02 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/admin/assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('assets/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="{{ asset('assets/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    @yield('css')
</head>

<body>

    <!-- body start -->

    <body data-menu-color="light" data-sidebar="default">

        <!-- Begin page -->
        <div id="app-layout">


            @include('admins.blocks.header')

            @include('admins.blocks.sidebar')
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            @yield('content')

            @include('admins.blocks.footer')

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        <!-- Vendor -->

        <script src="{{ asset('assets/admin/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/admin/assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('assets/admin/assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('assets/admin/assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('assets/admin/assets/libs/feather-icons/feather.min.js') }}"></script>

        <!-- Apexcharts JS -->
        <script src="{{ asset('assets/admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- for basic area chart -->
        <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script> <!-- External link -->

        <!-- Widgets Init Js -->
        {{-- <script src="{{ asset('assets/admin/assets/js/pages/analytics-dashboard.init.js') }}"></script> --}}

        <!-- App js -->
        <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
        @yield('js')
    </body>

    <!-- Mirrored from zoyothemes.com/tapeli/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 16 Jul 2024 08:34:03 GMT -->

</html>
