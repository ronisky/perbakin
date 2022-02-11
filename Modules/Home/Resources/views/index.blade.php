@extends('layouts.home')
@section('title', 'Home')

@section('content')

<!-- Start Hero Area -->
<section id="home" class="hero-area">
    <div class="container-fluid">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                {{-- @php
                $slide = 0;
                @endphp
                @foreach ($banners as $banner)
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $slide }}"
                class="active" aria-current="true" aria-label="{{ $banner->banner_title }}"></button>
                @php
                $slide += 1;
                @endphp
                @endforeach --}}
            </div>
            <div class="carousel-inner">
                {{-- @foreach ($banners as $banner)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <img src="{{ url('storage/uploads/images/'. $banner->banner_image_path) }}" class="d-block w-100"
                    alt="{{ $banner->banner_title }}">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="text-light">{{ $banner->banner_title }}</h5>
                    <p>{{ $banner->banner_description }}</p>
                </div>
            </div>
            @endforeach --}}

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

    {{-- <div class="row align-items-center">

            <div class="col-lg-5 col-md-12 col-12">
                <div class="hero-content">
                    <h1 class="wow fadeInLeft" data-wow-delay=".4s">Perbakin <br> Kabupaten Bandung</h1>
                    <p class="wow fadeInLeft" data-wow-delay=".6s">Mewujudkan Perbakin sebagai organisasi dengan tata
                        kelola yang profesional dan melahirkan atlit petembak yang berprestasi internasional secara
                        berkelanjutan dan mandiri.</p>
                    <div class="button wow fadeInLeft" data-wow-delay=".8s">
                        <a href="https://www.youtube.com/watch?v=EbNNo3_Flg4" class="glightbox video-button"><span
                                class="video"><i class="lni lni-play"></i></span><span class="text">Lihat Kegiatan
                                Kami</span></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-12 col-12">
                <div class="hero-image wow fadeInRight" data-wow-delay=".4s">
                    <img src="https://images.unsplash.com/photo-1620396270032-06cdac39833b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
                        alt="
                            #">
                </div>
            </div>
        </div> --}}
    </div>
</section>

<!-- End Hero Area -->

<!-- Start Sponsorship Area -->

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-md-12 col-12">
                <div class="section-title">
                    <h3 class="wow zoomIn" data-wow-delay=".2s">Our Sponsorship</h3>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-12">
                <div class="row">
                    @php
                    $time = 2;
                    @endphp
                    @foreach ($sponsorships as $sponsorship)
                    <div class="col-lg-4 col-md-4 col-12 my-1">
                        @php
                        $resource_data = str_contains($sponsorship->sponsorship_resource_path,
                        'https://www.youtube.com/');
                        @endphp
                        @if(str_contains($sponsorship->sponsorship_resource_path, 'https://www.youtube.com/'))
                        <div class="single-achievement wow fadeInUp" data-wow-delay=".{{$time}}s">
                            <iframe width="350" height="190" src="{{ $sponsorship->sponsorship_resource_path }}"
                                allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true">
                            </iframe>
                        </div>
                        @else
                        <a href="{{ url('storage/uploads/images/'. $sponsorship->sponsorship_resource_path) }}"
                            target="_blank">
                            <img width="350" height="190"
                                src="{{ url('storage/uploads/images/'. $sponsorship->sponsorship_resource_path) }}"
                                alt="{{ $sponsorship->sponsorship_resource_path }}">
                        </a>
                        @endif
                    </div>
                    @php
                    $time += 2;
                    @endphp
                    @endforeach

                    {{-- <div class="col-lg-4 col-md-4 col-12 my-1">
                        <img width="350" height="190" src="{{ url('/img/files/banner.jpg') }}" alt="Responsive image">
                </div>
                <div class="col-lg-4 col-md-4 col-12 my-1">
                    <div class="single-achievement wow fadeInUp" data-wow-delay=".4s">
                        <iframe width="350" height="190" src="https://www.youtube.com/embed/23o3ia8p0ZY"
                            allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true">
                        </iframe>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12 my-1">
                    <div class="single-achievement wow fadeInUp" data-wow-delay=".6s">
                        <iframe width="350" height="190" src="https://www.youtube.com/embed/23o3ia8p0ZY?controls=0">
                        </iframe>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    </div>
</section>
<!-- End Sponsorship Area -->

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
        @if (empty($visimisi))
        <div class="row">
        </div>
        @else
        <div class="row">
            @php
            $time = 2;
            @endphp
            {{-- @foreach ($visimisi as $data)
            <div class="col-lg-6 col-md-6 col-12">
                <!-- Start Single Feature -->
                <div class="single-feature wow fadeInUp" data-wow-delay=".{{$time}}s">
            <img src="{{ url('storage/uploads/images/'. $data->image_path) }}" alt="{{ $data->title }}" width="300"
                height="150" />
            <h3 class="mt-3">{{ $data->title }}</h3>
            <p>{{ $data->description }}</p>
        </div>
        <!-- End Single Feature -->
    </div>
    @php
    $time += 2;
    @endphp
    @endforeach --}}
    </div>
    @endif
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
            @php
            $time_delay = 2;
            @endphp
            {{-- @foreach ($galleries as $gallery)
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Feature -->
                <div class="single-feature wow fadeInUp" data-wow-delay=".{{ $time_delay }}s">
            <img src="{{ url('storage/uploads/images/'. $gallery->gallery_image_path) }}"
                alt="{{ $gallery->gallery_title }}" width="300" height="200">
            <h3 class="mt-2">{{ $gallery->gallery_title }}</h3>
            <p>{{ $gallery->gallery_description }}</p>
        </div>
        <!-- End Single Feature -->
    </div>
    @php
    $time_delay += 2;
    @endphp
    @endforeach --}}

    {{-- <div class="col-lg-4 col-md-6 col-12">
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
            </div> --}}
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
            @php
            $time_delay = 2;
            @endphp
            {{-- @foreach ($clubes as $club)
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Single Table -->
                <div class="single-table wow fadeInUp" data-wow-delay=".2s">
                    <!-- Table Head -->
                    <div class="table-head">
                        <h4 class="title">{{ $club->club_name }}</h4>
            <div class="button">
                <img src="{{ url('storage/uploads/images/'. $club->club_logo_path) }}" alt="{{ $club->club_name }} "
                    width="130" height="130">
            </div>
            <p class="mt-2">{{ $club->club_description }}</p>
        </div>

        <!-- End Table Head -->
        <!-- Start Table Content -->
        <div class="table-content">
            <h4 class="middle-title">Kontak yang bisa dihubungi</h4>
            <!-- Table List -->
            <ul class="table-list">
                <li><i class="lni lni-checkmark-circle"></i> Website : {{ $club->club_website }}</li>
                <li><i class="lni lni-checkmark-circle"></i> Whatsapp : {{ $club->club_whatsapp }}</li>
                <li><i class="lni lni-checkmark-circle"></i> Instagram : {{ $club->club_instagram }}</li>
            </ul>
            <!-- End Table List -->
        </div>
        <!-- End Table Content -->
    </div>
    <!-- End Single Table-->
    </div>
    @php
    $time_delay += 2;
    @endphp
    @endforeach --}}
    {{-- <div class="col-lg-3 col-md-6 col-12">
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
    </div> --}}
    </div>
    </div>
</section>
<!--/ End Clubes Table Area -->

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
                    <img class="mobile-logo" style="position: absolute; top:0; right:0; height: 100%;"
                        src="{{ url('img/files/ketua.png') }}" alt="Logo">
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
