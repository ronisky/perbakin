<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>
        @if (View::hasSection('title'))
        @yield('title') -
        @endif
        Perbakin Kabupaten Bandung
    </title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('img/logo_perbakin.png') }}" />

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ url('homeassets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ url('homeassets/css/LineIcons.2.0.css') }}" />
    <link rel="stylesheet" href="{{ url('homeassets/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ url('homeassets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ url('homeassets/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ url('homeassets/css/main.css') }}" />

</head>

<body>

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->

    {{-- main content --}}
    <main class="content">
        @yield('content')
    </main>

    <!-- Start Footer Area -->
    <footer class="footer">
        <!-- Start Footer Top -->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer f-about">
                            <div class="logo">
                                <a href="{{ url('home') }}">
                                    <img src="{{ url('img/perbakin-logo-white.png') }}" alt="#">
                                </a>
                            </div>
                            <p>Mewujudkan Perbakin sebagai organisasi dengan tata kelola yang profesional dan melahirkan
                                atlit petembak yang berprestasi internasional secara berkelanjutan dan mandiri.</p>
                            <ul class="social">
                                <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-instagram"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-linkedin-original"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-youtube"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-pinterest"></i></a></li>
                            </ul>
                            <p class="copyright-text">Designed and Developed with &#10084; by <a href="#" rel="nofollow"
                                    target="_blank">Pesantech ID</a>
                            </p>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Footer Top -->
    </footer>
    <!--/ End Footer Area -->

    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="{{url('homeassets/js/bootstrap.min.js')}}"></script>
    <script src="{{url('homeassets/js/wow.min.js')}}"></script>
    <script src="{{url('homeassets/js/tiny-slider.js')}}"></script>
    <script src="{{url('homeassets/js/glightbox.min.js')}}"></script>
    <script src="{{url('homeassets/js/count-up.min.js')}}"></script>
    <script src="{{url('homeassets/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        //====== counter up 
        var cu = new counterUp({
            start: 0,
            duration: 2000,
            intvalues: true,
            interval: 100,
            append: " ",
        });
        cu.start();

    </script>

    {{-- notification show --}}
    <script>
        var notyfSuccess = new Notyf({
            duration: 5000,
            position: {
                x: 'right',
                y: 'top'
            }
        });
        var notyfError = new Notyf({
            duration: 0,
            dismissible: true,
            position: {
                x: 'right',
                y: 'top'
            }
        });
        var msgSuccess = $('#successMessage').html()
        if (msgSuccess !== undefined) {
            notyfSuccess.success(msgSuccess)
        }
        var msgError = $('#errorMessage').html()
        if (msgError !== undefined) {
            notyfError.error(msgError)
        }

    </script>
</body>

</html>
