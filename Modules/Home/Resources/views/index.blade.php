@extends('layouts.home')
@section('title', 'Home')

@section('content')

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
                                    <a href="#home" class="page-scroll active" aria-label="Toggle navigation">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#about" class="page-scroll" aria-label="Toggle navigation">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#gallery" class="page-scroll" aria-label="Toggle navigation">Gallery</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#clubes" class="page-scroll" aria-label="Toggle navigation">Clubes</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#pengurus" aria-label="Toggle navigation">Pengurus</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse"
                                        data-bs-target="#submenu-1-4" aria-controls="navbarSupportedContent"
                                        aria-expanded="false" aria-label="Toggle navigation">Blog</a>
                                    <ul class="sub-menu collapse" id="submenu-1-4">
                                        <li class="nav-item"><a href="javascript:void(0)">Blog Grid Sidebar</a>
                                        </li>
                                        <li class="nav-item"><a href="javascript:void(0)">Blog Single</a></li>
                                        <li class="nav-item"><a href="javascript:void(0)">Blog Single
                                                Sibebar</a></li>
                                    </ul>
                                </li> --}}
                                {{-- <li class="nav-item">
                                    <a href="#contact" aria-label="Toggle navigation">Contact</a>
                                </li> --}}
                            </ul>
                        </div> <!-- navbar collapse -->
                        <div class="button add-list-button">
                            <a href="{{ url('login') }}" class="btn">Login</a>
                        </div>
                    </nav>
                    <!-- End Navbar -->
                </div>
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</header>
<!-- End Header Area -->

<!-- Start Hero Area -->
<section id="home" class="hero-area">
    <div class="container">
        <div class="row align-items-center">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ url('https://www.rbgunclub.com/wp-content/uploads/2019/02/cropped-AIRGUN-PIX1-2.jpg') }}"
                            class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>First slide label</h5>
                            <p>Some representative placeholder content for the first slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ url('https://www.rbgunclub.com/wp-content/uploads/2019/02/cropped-AIRGUN-PIX1-2.jpg') }}"
                            class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Second slide label</h5>
                            <p>Some representative placeholder content for the second slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ url('https://www.rbgunclub.com/wp-content/uploads/2019/02/cropped-AIRGUN-PIX1-2.jpg') }}"
                            class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Third slide label</h5>
                            <p>Some representative placeholder content for the third slide.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            {{-- <div class="col-lg-5 col-md-12 col-12">
                <div class="hero-content">
                    <h1 class="wow fadeInLeft" data-wow-delay=".4s">Perbakin <br> Kabupaten Bandung</h1>
                    <p class="wow fadeInLeft" data-wow-delay=".6s">Mewujudkan Perbakin sebagai organisasi dengan tata
                        kelola yang profesional dan melahirkan atlit petembak yang berprestasi internasional secara
                        berkelanjutan dan mandiri.</p>
                    <div class="button wow fadeInLeft" data-wow-delay=".8s"> --}}
            {{-- <a href="https://www.youtube.com/watch?v=EbNNo3_Flg4" class="glightbox video-button"><span
                                class="video"><i class="lni lni-play"></i></span><span class="text">Lihat Kegiatan
                                Kami</span></a>
                    </div>
                </div> --}}
            {{-- </div> --}}
            {{-- <div class="col-lg-7 col-md-12 col-12"> --}}
            {{-- <div class="hero-image wow fadeInRight" data-wow-delay=".4s">
                    <img src="https://images.unsplash.com/photo-1620396270032-06cdac39833b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
                        alt="
                            #">
                </div> --}}
            {{-- </div> --}}
        </div>
    </div>
</section>
<!-- End Hero Area -->

<!-- Start About Area -->
<section id="about" class="features section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h3 class="wow zoomIn" data-wow-delay=".2s">About Us</h3>
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">Apa itu perbakin?
                    </h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s">Perbakin adalah akronim atau kependekan dari Persatuan
                        Berburu dan Menembak Seluruh Indonesia</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <!-- Start Single Feature -->
                <div class="single-feature wow fadeInUp" data-wow-delay=".2s">
                    <img src="{{ url('img/visi.png') }}" alt="visi" width="300" height="150" />
                    <h3 class="mt-3">Visi Perbakin</h3>
                    <p>Mewujudkan Perbakin sebagai organisasi dengan tata kelola yang profesional dan melahirkan atlit
                        petembak yang berprestasi internasional secara berkelanjutan dan mandiri.</p>
                </div>
                <!-- End Single Feature -->
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <!-- Start Single Feature -->
                <div class="single-feature wow fadeInUp" data-wow-delay=".4s">
                    <img src="{{ url('img/misi.png') }}" alt="misi" width="300" height="150" />
                    <h3 class="mt-3">Misi Perbakin</h3>
                    <p>Meletakan platform organisasi perbakin di pusat dan di daerah. Menjadikan perbakin sebagai
                        organisasi yang memiliki tata kelola yang baik dan profesional. Mewujudkan perbakin sebagai
                        gudang prestasi dengan mencetak atlit petembak sebanyak banyaknya dengan sasaran pada tahun 2014
                        tercetak untuk event air sekurang kurangnya 24 petembak air nasional ( 4 event 2 team ).
                        Menciptakan kompetisi yang teratur dan berkelanjutan dengan bertumpu pada potensi daerah.
                        Sosialisasi olahraga menembak untuk meningkatkan minat disekolah dan perguruan tinggi.</p>
                </div>
                <!-- End Single Feature -->
            </div>
        </div>
    </div>
</section>
<!-- End About Area -->

<!-- Start Gallery Area -->
<section id="gallery" class="features section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h3 class="wow zoomIn" data-wow-delay=".2s">Gallery</h3>
                    <p class="wow fadeInUp" data-wow-delay=".4s">Gallery kegiatan-kegiatan yang kami lakukan bersama</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Feature -->
                <div class="single-feature wow fadeInUp" data-wow-delay=".2s">
                    <img src="https://images.unsplash.com/photo-1620396270032-06cdac39833b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
                        alt="#" width="300" height="200">
                    <h3>Nama Kegiatan</h3>
                    <p>Deskripsi singkat kegiatan yang dilakukan</p>
                </div>
                <!-- End Single Feature -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Feature -->
                <div class="single-feature wow fadeInUp" data-wow-delay=".4s">
                    <img src="https://images.unsplash.com/photo-1620396270032-06cdac39833b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
                        alt="#" width="300" height="200">
                    <h3>Nama Kegiatan 2</h3>
                    <p>Deskripsi singkat kegiatan yang dilakukan</p>
                </div>
                <!-- End Single Feature -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Feature -->
                <div class="single-feature wow fadeInUp" data-wow-delay=".6s">
                    <img src="https://images.unsplash.com/photo-1620396270032-06cdac39833b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
                        alt="#" width="300" height="200">
                    <h3>Nama Kegiatan 3</h3>
                    <p>Deskripsi singkat kegiatan yang dilakukan</p>
                </div>
                <!-- End Single Feature -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Feature -->
                <div class="single-feature wow fadeInUp" data-wow-delay=".2s">
                    <img src="https://images.unsplash.com/photo-1620396270032-06cdac39833b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
                        alt="#" width="300" height="200">
                    <h3>Nama Kegiatan 4</h3>
                    <p>Deskripsi singkat kegiatan yang dilakukan</p>
                </div>
                <!-- End Single Feature -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Feature -->
                <div class="single-feature wow fadeInUp" data-wow-delay=".4s">
                    <img src="https://images.unsplash.com/photo-1620396270032-06cdac39833b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
                        alt="#" width="300" height="200">
                    <h3>Nama Kegiatan 5</h3>
                    <p>Deskripsi singkat kegiatan yang dilakukan</p>
                </div>
                <!-- End Single Feature -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Feature -->
                <div class="single-feature wow fadeInUp" data-wow-delay=".6s">
                    <img src="https://images.unsplash.com/photo-1620396270032-06cdac39833b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
                        alt="#" width="300" height="200">
                    <h3>Nama Kegiatan 6</h3>
                    <p>Deskripsi singkat kegiatan yang dilakukan</p>
                </div>
                <!-- End Single Feature -->
            </div>
        </div>
    </div>
</section>
<!-- End Gallery Area -->

<!-- Start Achievement Area -->
<section class="our-achievement section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-md-12 col-12">
                <div class="title">
                    <h2>Berbagai penghargaan telah kami dapatkan</h2>
                    <p>Kami bersama terus melakukan dan mengikuti kegiatan-kegiatan juga perlombaan yang dilakukan.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="single-achievement wow fadeInUp" data-wow-delay=".2s">
                            <h3 class="counter"><span id="secondo1" class="countup" cup-end="100">100</span>Kali</h3>
                            <p>Juara Nasional</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="single-achievement wow fadeInUp" data-wow-delay=".4s">
                            <h3 class="counter"><span id="secondo2" class="countup" cup-end="120">120</span>Kali</h3>
                            <p>Juara Daerah</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="single-achievement wow fadeInUp" data-wow-delay=".6s">
                            <h3 class="counter"><span id="secondo3" class="countup" cup-end="125">1000</span>k+</h3>
                            <p>Anggota Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Achievement Area -->

<!-- Start Clubes Table Area -->
<section id="clubes" class="pricing-table section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h3 class="wow zoomIn" data-wow-delay=".2s">Our Clubes</h3>
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">Klub Perbakin</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s">Mari bergabung barsama kami di klub yang anda sukai.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Single Table -->
                <div class="single-table wow fadeInUp" data-wow-delay=".2s">
                    <!-- Table Head -->
                    <div class="table-head">
                        <h4 class="title">Clube Satu</h4>
                        <p>Deskripsi singkat klub satu</p>
                        <div class="button">
                            <img src="{{ url('img/logo.png') }}" alt="#" width="130" height="130">
                        </div>
                    </div>
                    <!-- End Table Head -->
                    <!-- Start Table Content -->
                    <div class="table-content">
                        <h4 class="middle-title">Kontak yang bisa dihubungi</h4>
                        <!-- Table List -->
                        <ul class="table-list">
                            <li><i class="lni lni-checkmark-circle"></i> Website : www.clubesatu.com.</li>
                            <li><i class="lni lni-checkmark-circle"></i> Whatsapp : +62856789123</li>
                            <li><i class="lni lni-checkmark-circle"></i> Instagram : @clubesatu.</li>
                        </ul>
                        <!-- End Table List -->
                    </div>
                    <!-- End Table Content -->
                </div>
                <!-- End Single Table-->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Single Table -->
                <div class="single-table wow fadeInUp" data-wow-delay=".4s">
                    <!-- Table Head -->
                    <div class="table-head">
                        <h4 class="title">Clube dua</h4>
                        <p>Deskripsi singkat klub dua</p>
                        <div class="button">
                            <img src="{{ url('img/logo.png') }}" alt="#" width="130" height="130">
                        </div>
                    </div>
                    <!-- End Table Head -->
                    <!-- Start Table Content -->
                    <div class="table-content">
                        <h4 class="middle-title">Kontak yang bisa dihubungi</h4>
                        <!-- Table List -->
                        <ul class="table-list">
                            <li><i class="lni lni-checkmark-circle"></i> Website : www.clubedua.com.</li>
                            <li><i class="lni lni-checkmark-circle"></i> Whatsapp : +62856789123</li>
                            <li><i class="lni lni-checkmark-circle"></i> Instagram : @clubedua.</li>
                        </ul>
                        <!-- End Table List -->
                    </div>
                    <!-- End Table Content -->
                </div>
                <!-- End Single Table-->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Single Table -->
                <div class="single-table wow fadeInUp" data-wow-delay=".6s">
                    <!-- Table Head -->
                    <div class="table-head">
                        <h4 class="title">Clube tiga</h4>
                        <p>Deskripsi singkat klub tiga</p>
                        <div class="button">
                            <img src="{{ url('img/logo.png') }}" alt="#" width="130" height="130">
                        </div>
                    </div>
                    <!-- End Table Head -->
                    <!-- Start Table Content -->
                    <div class="table-content">
                        <h4 class="middle-title">Kontak yang bisa dihubungi</h4>
                        <!-- Table List -->
                        <ul class="table-list">
                            <li><i class="lni lni-checkmark-circle"></i> Website : www.clubetiga.com.</li>
                            <li><i class="lni lni-checkmark-circle"></i> Whatsapp : +62856789123</li>
                            <li><i class="lni lni-checkmark-circle"></i> Instagram : @clubetiga.</li>
                        </ul>
                        <!-- End Table List -->
                    </div>
                    <!-- End Table Content -->
                </div>
                <!-- End Single Table-->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Single Table -->
                <div class="single-table wow fadeInUp" data-wow-delay=".8s">
                    <!-- Table Head -->
                    <div class="table-head">
                        <h4 class="title">Clube empat</h4>
                        <p>Deskripsi singkat klub empat</p>
                        <div class="button">
                            <img src="{{ url('img/logo.png') }}" alt="#" width="130" height="130">
                        </div>
                    </div>
                    <!-- End Table Head -->
                    <!-- Start Table Content -->
                    <div class="table-content">
                        <h4 class="middle-title">Kontak yang bisa dihubungi</h4>
                        <!-- Table List -->
                        <ul class="table-list">
                            <li><i class="lni lni-checkmark-circle"></i> Website : www.clubeempat.com.</li>
                            <li><i class="lni lni-checkmark-circle"></i> Whatsapp : +62856789123</li>
                            <li><i class="lni lni-checkmark-circle"></i> Instagram : @clubeempat.</li>
                        </ul>
                        <!-- End Table List -->
                    </div>
                    <!-- End Table Content -->
                </div>
                <!-- End Single Table-->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Single Table -->
                <div class="single-table wow fadeInUp" data-wow-delay=".10s">
                    <!-- Table Head -->
                    <div class="table-head">
                        <h4 class="title">Clube lima</h4>
                        <p>Deskripsi singkat klub lima</p>
                        <div class="button">
                            <img src="{{ url('img/logo.png') }}" alt="#" width="130" height="130">
                        </div>
                    </div>
                    <!-- End Table Head -->
                    <!-- Start Table Content -->
                    <div class="table-content">
                        <h4 class="middle-title">Kontak yang bisa dihubungi</h4>
                        <!-- Table List -->
                        <ul class="table-list">
                            <li><i class="lni lni-checkmark-circle"></i> Website : www.clubelima.com.</li>
                            <li><i class="lni lni-checkmark-circle"></i> Whatsapp : +62856789123</li>
                            <li><i class="lni lni-checkmark-circle"></i> Instagram : @clubelima.</li>
                        </ul>
                        <!-- End Table List -->
                    </div>
                    <!-- End Table Content -->
                </div>
                <!-- End Single Table-->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Single Table -->
                <div class="single-table wow fadeInUp" data-wow-delay=".12s">
                    <!-- Table Head -->
                    <div class="table-head">
                        <h4 class="title">Clube lima</h4>
                        <p>Deskripsi singkat klub lima</p>
                        <div class="button">
                            <img src="{{ url('img/logo.png') }}" alt="#" width="130" height="130">
                        </div>
                    </div>
                    <!-- End Table Head -->
                    <!-- Start Table Content -->
                    <div class="table-content">
                        <h4 class="middle-title">Kontak yang bisa dihubungi</h4>
                        <!-- Table List -->
                        <ul class="table-list">
                            <li><i class="lni lni-checkmark-circle"></i> Website : www.clubelima.com.</li>
                            <li><i class="lni lni-checkmark-circle"></i> Whatsapp : +62856789123</li>
                            <li><i class="lni lni-checkmark-circle"></i> Instagram : @clubelima.</li>
                        </ul>
                        <!-- End Table List -->
                    </div>
                    <!-- End Table Content -->
                </div>
                <!-- End Single Table-->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Single Table -->
                <div class="single-table wow fadeInUp" data-wow-delay=".14s">
                    <!-- Table Head -->
                    <div class="table-head">
                        <h4 class="title">Clube lima</h4>
                        <p>Deskripsi singkat klub lima</p>
                        <div class="button">
                            <img src="{{ url('img/logo.png') }}" alt="#" width="130" height="130">
                        </div>
                    </div>
                    <!-- End Table Head -->
                    <!-- Start Table Content -->
                    <div class="table-content">
                        <h4 class="middle-title">Kontak yang bisa dihubungi</h4>
                        <!-- Table List -->
                        <ul class="table-list">
                            <li><i class="lni lni-checkmark-circle"></i> Website : www.clubelima.com.</li>
                            <li><i class="lni lni-checkmark-circle"></i> Whatsapp : +62856789123</li>
                            <li><i class="lni lni-checkmark-circle"></i> Instagram : @clubelima.</li>
                        </ul>
                        <!-- End Table List -->
                    </div>
                    <!-- End Table Content -->
                </div>
                <!-- End Single Table-->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Single Table -->
                <div class="single-table wow fadeInUp" data-wow-delay=".16s">
                    <!-- Table Head -->
                    <div class="table-head">
                        <h4 class="title">Clube lima</h4>
                        <p>Deskripsi singkat klub lima</p>
                        <div class="button">
                            <img src="{{ url('img/logo.png') }}" alt="#" width="130" height="130">
                        </div>
                    </div>
                    <!-- End Table Head -->
                    <!-- Start Table Content -->
                    <div class="table-content">
                        <h4 class="middle-title">Kontak yang bisa dihubungi</h4>
                        <!-- Table List -->
                        <ul class="table-list">
                            <li><i class="lni lni-checkmark-circle"></i> Website : www.clubelima.com.</li>
                            <li><i class="lni lni-checkmark-circle"></i> Whatsapp : +62856789123</li>
                            <li><i class="lni lni-checkmark-circle"></i> Instagram : @clubelima.</li>
                        </ul>
                        <!-- End Table List -->
                    </div>
                    <!-- End Table Content -->
                </div>
                <!-- End Single Table-->
            </div>
        </div>
    </div>
</section>
<!--/ End Clubes Table Area -->

<!-- Start Call To Action Area -->
<section class="section call-action">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                <div class="cta-content">
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">Bersama Perbakin <br> Kita Maju Bersama
                    </h2>
                    <p class="wow fadeInUp" data-wow-delay=".4s">Bersama kita wujudkan persatuan dan keamanan</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Call To Action Area -->

<!-- Start Pengurus Area -->
<section id="pengurus" class="features section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h3 class="wow zoomIn" data-wow-delay=".2s">Pengurus Cabang Perbakin</h3>
                    <h4 class="wow fadeInUp" data-wow-delay=".4s">Susunan Personalia Pengurus Cabang Perbakin Kabupaten
                        Bandung <br> Masa Bakti 2021-2025</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <!-- Start Single Feature -->
                <div class="single-feature wow fadeInUp" data-wow-delay=".2s">
                    <h3>I PELINDUNG</h3>
                    <p>
                        1. Pangprov PERBAKIN Jawa Barat <br>
                        2. Bupati Kabupaten Bandung<br>
                        3. Dankopaskhas AU<br>
                        4. Danpusdiklat Paskhas<br>
                        5. Kaporlresta Bandung<br>
                        6. Dandim 0624 Kabupaten Bandung<br>
                        7. Dansecata Pangalengan<br>
                        8. Dandenma Korpaskhas<br>
                        9. Danyon Lanud 330 Kostrad Cicalengka<br>
                        10. Danyon Zipur 3/TW Pangalengan<br>
                        11. Kadispora Kabupaten Bandung<br>
                        12. Ka. BKSDA Kabupaten Bandung
                    </p>
                </div>
                <!-- End Single Feature -->
            </div>
            <div class="col-lg-6 col-md-6">
                <!-- Start Single Feature -->
                <div class="single-feature wow fadeInUp" data-wow-delay=".4s">
                    <h3>II PEMBINA</h3>
                    <p>
                        KONI Kabupaten Bandung
                    </p>
                    <br>
                    <h3>III PENASIHAT</h3>
                    <p>
                        1. H. Dadang Moh Naser, S.H., S.Ip., M.Ip. <br>
                        2. H. Asep Romaya<br>
                        3. H. Uu Saepudin<br>
                        4. H. Mamat Sumpena/EMTE<br>
                        5. H. Adam Djakarsih<br>
                        6. Yusup Arsana Natabradja
                    </p>
                </div>
                <!-- End Single Feature -->
            </div>

        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <!-- Start Single Feature -->
                <div class="single-feature wow fadeInUp" data-wow-delay=".8s">
                    <h3>IV SUSUNAN PENGURUS</h3>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" width="25%"></th>
                                <th scope="col" width="1%"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Ketua Umum</th>
                                <td>:</td>
                                <td>Rudiyanto Dahlan, S.T., M.I.Pol</td>
                            </tr>
                            <tr>
                                <th>Wakil Ketua Umum / Ketua Harian</th>
                                <td>:</td>
                                <td>Agus Supartono</td>
                            </tr>
                            <tr>
                                <th>Sekertaris Umum</th>
                                <td>:</td>
                                <td>Drs. Agus A. Sujana</td>
                            </tr>
                            <tr>
                                <th>Komisi Perijinan dan Rekomendasi</th>
                                <td>:</td>
                                <td>Hudansah Murdanitas, A.Md</td>
                            </tr>
                            <tr>
                                <th>Komisi Sarpras</th>
                                <td>:</td>
                                <td>I Dewa Nyoman</td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>:</td>
                                <td>Faizi Prayogi</td>
                            </tr>
                            <tr>
                                <th>Komisi Dokumentasi dan IT</th>
                                <td>:</td>
                                <td>Firdaus R Fadhlil</td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>:</td>
                                <td>Ara Dwi Sagara</td>
                            </tr>
                            <tr>
                                <th>Staf Kesekertariatan</th>
                                <td>:</td>
                                <td>Missuwaryono</td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>:</td>
                                <td>Erik Hermansyah</td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>:</td>
                                <td>Kamelia Megasari</td>
                            </tr>
                            <tr>
                                <th>Bendahara Umum</th>
                                <td>:</td>
                                <td>Dikky Darmawan, S.Sos.</td>
                            </tr>
                            <tr>
                                <th>Wakil Bendahara</th>
                                <td>:</td>
                                <td>Dian Cahyani</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <!-- Start Single Feature -->
                <div class="single-feature wow fadeInUp" data-wow-delay=".10s">
                    <h6>BIDANG ORGANISASI</h6>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" width="25%"></th>
                                <th scope="col" width="1%"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Ketua</th>
                                <td>:</td>
                                <td>Doni Siswoyo</td>
                            </tr>
                            <tr>
                                <th>Anggota</th>
                                <td>:</td>
                                <td>Ruslan Gunawan, M.Pd.</td>
                            </tr>
                        </tbody>
                    </table>
                    <h6>PEMBINAAN DAN PRESTASI</h6>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col" width="1%"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Agus Hindar Ruswanto, S.STP., M.Si.</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Drs. H. Moch. Iwan Djajakusumah, M.Si.</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <h6>BIDANG HUMAS</h6>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" width="25%"></th>
                                <th scope="col" width="1%"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Ketua</th>
                                <td>:</td>
                                <td>Thomas</td>
                            </tr>
                            <tr>
                                <th>Anggota</th>
                                <td>:</td>
                                <td>Muhammad A'la Al Maududi</td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>:</td>
                                <td>Setia Tedy Narwan</td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>:</td>
                                <td>Doni Saputra</td>
                            </tr>
                        </tbody>
                    </table>
                    <h6>BIDANG HUKUM DAN ETIKA</h6>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" width="25%"></th>
                                <th scope="col" width="1%"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Ketua</th>
                                <td>:</td>
                                <td>Rizal Sitompul, S.Pd.</td>
                            </tr>
                            <tr>
                                <th>Anggota</th>
                                <td>:</td>
                                <td>Rudi Hartono</td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>:</td>
                                <td>Ade Karsa</td>
                            </tr>
                        </tbody>
                    </table>
                    <h6>BIDANG TEMBAK SASARAN</h6>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" width="25%"></th>
                                <th scope="col" width="1%"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Ketua</th>
                                <td>:</td>
                                <td>Donny Surya Danu Kusuma, A.Md.</td>
                            </tr>
                            <tr>
                                <th>Wakil Ketua</th>
                                <td>:</td>
                                <td>Joko Prawoto</td>
                            </tr>
                            <tr>
                                <th>Anggota</th>
                                <td>:</td>
                                <td>Armadi</td>
                            </tr>
                            <tr>
                                <th>Anggota</th>
                                <td>:</td>
                                <td>Untung Gunadarma</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <!-- Start Single Feature -->
                <div class="single-feature wow fadeInUp" data-wow-delay=".12s">
                    <h6>BIDANG BERBURU</h6>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" width="25%"></th>
                                <th scope="col" width="1%"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Ketua</th>
                                <td>:</td>
                                <td>Ir. Andi Ahmad Rahmatullah</td>
                            </tr>
                            <tr>
                                <th>Wakil Ketua</th>
                                <td>:</td>
                                <td>Arif Budiman</td>
                            </tr>
                            <tr>
                                <th>Anggota</th>
                                <td>:</td>
                                <td>Dadang Iriandani</td>
                            </tr>
                            <tr>
                                <th>Anggota</th>
                                <td>:</td>
                                <td>Hermanto</td>
                            </tr>
                        </tbody>
                    </table>
                    <h6>Komisi Metal Silhouette dan Benchrest</h6>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" width="25%"></th>
                                <th scope="col" width="1%"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Ketua</th>
                                <td>:</td>
                                <td>Tatang Taryana</td>
                            </tr>
                            <tr>
                                <th>Anggota</th>
                                <td>:</td>
                                <td>Dany Kurniawan</td>
                            </tr>
                            <tr>
                                <th>Anggota</th>
                                <td>:</td>
                                <td>Iwan Kurniawan</td>
                            </tr>
                        </tbody>
                    </table>
                    <h6>BIDANG TEMBAK REAKSI</h6>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" width="25%"></th>
                                <th scope="col" width="1%"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Ketua</th>
                                <td>:</td>
                                <td>Obur Abdul Gopur</td>
                            </tr>
                            <tr>
                                <th>Wakil Ketua</th>
                                <td>:</td>
                                <td>H. Teddy Firmansyah</td>
                            </tr>
                            <tr>
                                <th>Anggota</th>
                                <td>:</td>
                                <td>Marcell Yoshua</td>
                            </tr>
                        </tbody>
                    </table>
                    <h6>Komisi AAIPSC</h6>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" width="25%"></th>
                                <th scope="col" width="1%"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Jalil Farhan</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Sandi Widjaja</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <!-- Start Single Feature -->
                <div class="single-feature wow fadeInUp" data-wow-delay=".14s">
                    <h6>BIDANG DANA DAN USAHA</h6>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" width="25%"></th>
                                <th scope="col" width="1%"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Ketua</th>
                                <td>:</td>
                                <td>Rudi Kusmayadi, B.E., M.Si</td>
                            </tr>
                            <tr>
                                <th>Anggota</th>
                                <td>:</td>
                                <td>Khoirul Anam</td>
                            </tr>
                            <tr>
                                <th>Anggota</th>
                                <td>:</td>
                                <td>Muhammad Iqbal</td>
                            </tr>
                        </tbody>
                    </table>
                    <h6>BIDANG KEPELATIHAN</h6>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" width="25%"></th>
                                <th scope="col" width="1%"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Ketua</th>
                                <td>:</td>
                                <td>Sugeng Handoko</td>
                            </tr>
                            <tr>
                                <th>Wakil Ketua</th>
                                <td>:</td>
                                <td>Winarko</td>
                            </tr>
                            <tr>
                                <th>Anggota</th>
                                <td>:</td>
                                <td>Eko Suhendra</td>
                            </tr>
                            <tr>
                                <th>Anggota</th>
                                <td>:</td>
                                <td>Dede Wahyu</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <!-- Start Single Feature -->
                <div class="single-feature wow fadeInUp" data-wow-delay=".16s">
                    <h6>BIDANG PERWASITAN</h6>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" width="25%"></th>
                                <th scope="col" width="1%"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Ketua</th>
                                <td>:</td>
                                <td>Sodikin</td>
                            </tr>
                            <tr>
                                <th>Anggota</th>
                                <td>:</td>
                                <td>Sudarno</td>
                            </tr>
                        </tbody>
                    </table>
                    <h6>Komisi Dokumentasi dan IT</h6>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col" width="1%"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Firdaus R Fadhlil</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Ara Dwi Sagara</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Pengurus Area -->
@endsection
