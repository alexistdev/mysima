<!doctype html>
<html class="modern fixed has-top-menu has-left-sidebar-half">
<head>
    <!-- Basic -->
    <meta charset="UTF-8">

    <title>{{$title}}</title>
    <meta name="keywords" content="Sistem Informasi Mahasiswa"/>
    <meta name="description" content="Sistem Informasi Mahasiswa v.1.0">
    <meta name="author" content="coderblue">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <x-admin.header-layout/>
    @stack('cssCustom')
</head>
<body>
<section class="body">
    <!-- Start : Navbar -->
    <x-admin.navbar-layout/>
    <!-- End : Navbar -->

    <div class="inner-wrapper">
        <!-- start: sidebar -->
        <x-admin.sidebar-layout />
        <!-- end: sidebar -->

        <!-- Start : Content -->
        {{$slot}}
        <!-- End : Content -->
    </div>
</section>

<!-- Vendor -->
<script src="{{asset('template/vendor/jquery/jquery.js')}}"></script>
<script src="{{asset('template/vendor/jquery-browser-mobile/jquery.browser.mobile.js')}}"></script>
<script src="{{asset('template/vendor/popper/umd/popper.min.js')}}"></script>
<script src="{{asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('template/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('template/vendor/common/common.js')}}"></script>
<script src="{{asset('template/vendor/nanoscroller/nanoscroller.js')}}"></script>
<script src="{{asset('template/vendor/magnific-popup/jquery.magnific-popup.js')}}"></script>
<script src="{{asset('template/vendor/jquery-placeholder/jquery.placeholder.js')}}"></script>


<!-- Theme Base, Components and Settings -->
<script src="{{asset('template/js/theme.js')}}"></script>

<!-- Theme Custom -->
<script src="{{asset('template/js/custom.js')}}"></script>

<!-- Theme Initialization Files -->
<script src="{{asset('template/js/theme.init.js')}}"></script>

<!-- Examples -->
<script src="{{asset('template/js/examples/examples.dashboard.js')}}"></script>
@stack('jsCustom')
</body>
</html>
