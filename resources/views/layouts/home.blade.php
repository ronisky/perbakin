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
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

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

    <!-- Start Header Area -->
    <header class="header navbar-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="nav-inner">
                        <!-- Start Navbar -->
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <img src="{{ url('img/perbakin-logo-white.png') }}" alt="Logo">
                            </a>
                            <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <a href="{{ url('/') }}" aria-label="Toggle navigation">Home</a>
                                        {{-- <a href="#home" class="page-scroll active"
                                            aria-label="Toggle navigation">Home</a> --}}
                                    </li>
                                    {{-- <li class="nav-item">
                                    <a href="#about" class="page-scroll" aria-label="Toggle navigation">About Us</a>
                                </li> --}}
                                    <li class="nav-item">
                                        <a href="{{ url('gallery') }}" aria-label="Toggle navigation">Gallery</a>
                                        {{-- <a href="#gallery" class="page-scroll"
                                            aria-label="Toggle navigation">Gallery</a> --}}
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('clube') }}" aria-label="Toggle navigation">Clubes</a>
                                        {{-- <a href="#clubes" class="page-scroll" aria-label="Toggle navigation">Clubes</a> --}}
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('articles') }}" aria-label="Toggle navigation">Articles</a>
                                        {{-- <a href="#articles" class="page-scroll"
                                            aria-label="Toggle navigation">Article</a> --}}
                                    </li>
                                    <li class="nav-item">
                                        <a class="dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse"
                                            data-bs-target="#submenu-1-4" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation">More</a>
                                        <ul class="sub-menu collapse" id="submenu-1-4">
                                            <li class="nav-item">
                                                <a href="{{ url('about-us') }}" aria-label="Toggle navigation">Tentang
                                                    Kami</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ url('management') }}"
                                                    aria-label="Toggle navigation">Pengurus</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ url('history') }}"
                                                    aria-label="Toggle navigation">Sejarah</a>
                                            </li>
                                            <li class="nav-item"><a href="{{ url('sponsorships') }}">Sponsorship</a>
                                            </li>
                                            <li class=" nav-item"><a href="{{ url('contact') }}">Contact</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div> <!-- navbar collapse -->
                            <div class="button add-list-button">
                                <a href="{{ url('login') }}" class="btn">Login</a>
                            </div>
                        </nav>
                        <!-- End Navbar -->
                        <div class="container-fluid mobile-logo">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ url('img/logo_koni.png') }}" target="_blank">
                                        <img class="mx-2 mb-2" style="width:auto; height: 60px;"
                                            src="{{ url('img/logo_koni.png') }}" alt="Logo Koni">
                                    </a>
                                    <a href="{{ url('img/logo_perbakin.png') }}" target="_blank">
                                        <img class="mx-2 mb-2" style="width:auto; height: 60px;"
                                            src="{{ url('img/logo_perbakin.png') }}" alt="Logo Perbakin">
                                    </a>
                                    <a href="{{ url('img/logo_kab_bandung.png') }}" target="_blank">
                                        <img class="mx-2 mb-2" style=" width:auto; height: 60px;"
                                            src="{{ url('img/logo_kab_bandung.png') }}" alt="Logo Kab. Bandung">
                                    </a>
                                </div>
                                <div class="col-md-4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </header>
    <!-- End Header Area -->

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
                    {{-- <div class="col-lg-8 col-md-8 col-12">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-12">
                                <!-- Single Widget -->
                                <div class="single-footer f-link">
                                    <h3>Solutions</h3>
                                    <ul>
                                        <li><a href="javascript:void(0)">Marketing</a></li>
                                        <li><a href="javascript:void(0)">Analytics</a></li>
                                        <li><a href="javascript:void(0)">Commerce</a></li>
                                        <li><a href="javascript:void(0)">Insights</a></li>
                                        <li><a href="javascript:void(0)">Promotion</a></li>
                                    </ul>
                                </div>
                                <!-- End Single Widget -->
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <!-- Single Widget -->
                                <div class="single-footer f-link">
                                    <h3>Support</h3>
                                    <ul>
                                        <li><a href="javascript:void(0)">Pricing</a></li>
                                        <li><a href="javascript:void(0)">Documentation</a></li>
                                        <li><a href="javascript:void(0)">Guides</a></li>
                                        <li><a href="javascript:void(0)">API Status</a></li>
                                        <li><a href="javascript:void(0)">Live Support</a></li>
                                    </ul>
                                </div>
                                <!-- End Single Widget -->
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <!-- Single Widget -->
                                <div class="single-footer f-link">
                                    <h3>Company</h3>
                                    <ul>
                                        <li><a href="javascript:void(0)">About Us</a></li>
                                        <li><a href="javascript:void(0)">Our Blog</a></li>
                                        <li><a href="javascript:void(0)">Jobs</a></li>
                                        <li><a href="javascript:void(0)">Press</a></li>
                                        <li><a href="javascript:void(0)">Contact Us</a></li>
                                    </ul>
                                </div>
                                <!-- End Single Widget -->
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <!-- Single Widget -->
                                <div class="single-footer f-link">
                                    <h3>Legal</h3>
                                    <ul>
                                        <li><a href="javascript:void(0)">Terms & Conditions</a></li>
                                        <li><a href="javascript:void(0)">Privacy Policy</a></li>
                                        <li><a href="javascript:void(0)">Catering Services</a></li>
                                        <li><a href="javascript:void(0)">Customer Relations</a></li>
                                        <li><a href="javascript:void(0)">Innovation</a></li>
                                    </ul>
                                </div>
                                <!-- End Single Widget -->
                            </div>
                        </div>
                    </div> --}}
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
</body>

</html>
