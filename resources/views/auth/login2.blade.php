<!doctype html>
<html class="fixed" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- Basic -->
    <meta charset="UTF-8">

    <meta name="keywords" content="HTML5 Admin Template" />
    <meta name="description" content="Porto Admin - Responsive HTML5 Template">
    <meta name="author" content="okler.net">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{asset('template/vendor/bootstrap/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('template/vendor/animate/animate.compat.css')}}">
    <link rel="stylesheet" href="{{asset('template/vendor/font-awesome/css/all.min.css')}}" />
    <link rel="stylesheet" href="{{asset('template/vendor/boxicons/css/boxicons.min.css')}}" />
    <link rel="stylesheet" href="{{asset('template/vendor/magnific-popup/magnific-popup.css')}}" />
    <link rel="stylesheet" href="{{asset('template/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css')}}" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset('template/css/theme.css')}}" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="{{asset('template/css/skins/default.css')}}" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{asset('template/css/custom.css')}}">

    <!-- Head Libs -->
    <script src="{{asset('template/vendor/modernizr/modernizr.js')}}"></script>

</head>
<body>
<!-- start: page -->
<section class="body-sign">
    <div class="center-sign">

        <div class="panel card-sign">
            <div class="card-title-sign mt-3 text-end">
                <h2 class="title text-uppercase font-weight-bold m-0"><i class="bx bx-user-circle me-1 text-6 position-relative top-5"></i> Sign In</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="email">Username</label>
                        <div class="input-group">
                            <input name="email" type="email" id="email" class="form-control form-control-lg" value="{{old('email')}}" />
                            <span class="input-group-text">
										<i class="bx bx-user text-4"></i>
									</span>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger text-sm" />
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input name="password" type="password" id="password" class="form-control form-control-lg" />
                            <span class="input-group-text">
										<i class="bx bx-lock text-4"></i>
									</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary mt-2">Sign In</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <p class="text-center text-muted mt-3 mb-3">&copy; Copyright 2021. All Rights Reserved.</p>
    </div>
</section>
<!-- end: page -->

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

<!-- Theme Base, Components and Settings -->
<script src="{{asset('template/js/theme.js')}}"></script>

<!-- Theme Custom -->
<script src="{{asset('template/js/custom.js')}}"></script>

<!-- Theme Initialization Files -->
<script src="{{asset('template/js/theme.init.js')}}"></script>

</body>
</html>
