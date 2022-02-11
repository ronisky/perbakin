@extends('layouts.home')
@section('title', 'Sponsorship Perbakin Kab. Bandung')

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

<!-- Start Sponsorship Area -->

<section id="sponsorship" class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-md-12 col-12">
                <div class="section-title">
                    <h3 class="wow zoomIn" data-wow-delay=".2s">Our Sponsorship</h3>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-12">
                @if(empty($sponsorships))
                <div class="row">
                </div>
                @else
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
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- End Sponsorship Area -->
@endsection
