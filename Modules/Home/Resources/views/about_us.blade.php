@extends('layouts.home')
@section('title', 'Tentang Perbakin Kab. Bandung')

@section('content')

<!-- Start Hero Area -->
<section id="home" class="hero-area">
    <div class="container-fluid">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            @if(empty($banners))
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" class="active"
                    aria-current="true" aria-label="example"></button>

            </div>
            <div class="carousel-inner">
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ url('img/files/banner.jpg') }}" class="d-block w-100" alt="Banner">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="text-light">Banner</h5>
                        <p></p>
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
            @else
            <div class="carousel-indicators">
                @php
                $slide = 0;
                @endphp
                @foreach ($banners as $banner)
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $slide }}"
                    class="active" aria-current="true" aria-label="{{ $banner->banner_title }}"></button>
                @php
                $slide += 1;
                @endphp
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach ($banners as $banner)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ url('storage/uploads/images/'. $banner->banner_image_path) }}" class="d-block w-100"
                        alt="{{ $banner->banner_title }}">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="text-light">{{ $banner->banner_title }}</h5>
                        <p>{{ $banner->banner_description }}</p>
                    </div>
                </div>
                @endforeach

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
            @endif
        </div>
    </div>
</section>
<!-- End Hero Area -->

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
            @foreach ($visimisi as $data)
            <div class="col-lg-6 col-md-6 col-12">
                <!-- Start Single Feature -->
                <div class="single-feature wow fadeInUp" data-wow-delay=".{{$time}}s">
                    <img src="{{ url('storage/uploads/images/'. $data->image_path) }}" alt="{{ $data->title }}"
                        width="300" height="150" />
                    <h3 class="mt-3">{{ $data->title }}</h3>
                    <p>{{ $data->description }}</p>
                </div>
                <!-- End Single Feature -->
            </div>
            @php
            $time += 2;
            @endphp
            @endforeach
        </div>
        @endif
    </div>
</section>

@endsection
