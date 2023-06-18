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
        <x-admin.sidebar-layout :menu-utama="$menuUtama" :menu-kedua="$menuKedua"/>
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

<!-- Specific Page Vendor -->
<script src="{{asset('template/vendor/select2/js/select2.js')}}"></script>
<script src="{{asset('template/vendor/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/vendor/datatables/media/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('template/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('template/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('template/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js')}}"></script>
<script src="{{asset('template/vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js')}}"></script>
<script src="{{asset('template/vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js')}}"></script>
<script src="{{asset('template/vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js')}}"></script>

<!-- Theme Base, Components and Settings -->
<script src="{{asset('template/js/theme.js')}}"></script>

<!-- Theme Custom -->
<script src="{{asset('template/js/custom.js')}}"></script>

<!-- Theme Initialization Files -->
<script src="{{asset('template/js/theme.init.js')}}"></script>

<!-- Examples -->
<script src="{{asset('template/js/examples/examples.datatables.default.js')}}"></script>
<script src="{{asset('template/js/examples/examples.datatables.row.with.details.js')}}"></script>
<script src="{{asset('template/js/examples/examples.datatables.tabletools.js')}}"></script>
@stack('customJS')
</body>
</html>
