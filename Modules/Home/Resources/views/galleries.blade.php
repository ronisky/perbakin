@extends('layouts.home')
@section('title', 'Gallery Perbakin Kab. Bandung')

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
        @if(empty($galleries))
        <div class="row">
        </div>
        @else
        <div class="row">
            @php
            $time_delay = 2;
            @endphp
            @foreach ($galleries as $gallery)
            <div class="col-lg-4 col-md-6 col-12">
                <div class="single-feature wow fadeInUp" data-wow-delay=".{{ $time_delay }}s">
                    <a href="{{ url('detailimage/'. Crypt::encrypt($gallery->gallery_id)) }}" target="_blank">
                        <img src="{{ url('storage/uploads/images/'. $gallery->gallery_image_path) }}"
                            alt="{{ $gallery->gallery_title }}" width="300" height="200">
                        <h3 class="mt-2">{{ $gallery->gallery_title }}</h3>
                    </a>
                    <p>{{ $gallery->gallery_description }}</p>
                </div>
            </div>
            @php
            $time_delay += 2;
            @endphp
            @endforeach
        </div>
        @endif
    </div>
</section>

@endsection
