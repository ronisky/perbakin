@extends('layouts.home')
@section('title', 'Artikel Perbakin Kab. Bandung')

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

<section id="articles" class="pricing-table section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h3 class="wow zoomIn" data-wow-delay=".2s">Our Article</h3>
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">Artikel Perbakin</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s">Artikel-artikel yang dapat teman-teman baca.
                    </p>
                </div>
            </div>
        </div>
        @if(empty($articles))
        <div class="row">
        </div>
        @else
        <div class="row">
            @php
            $time_delay = 2;
            @endphp
            @foreach ($articles as $article)
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Single Table -->
                <div class="single-table wow fadeInUp" data-wow-delay=".2s">
                    <!-- Table Head -->
                    <div class="table-head">
                        <a href="{{ url('detailarticle/'. Crypt::encrypt($article->article_id)) }}" target="_blank">
                            <h4 class="title">{{ $article->article_title }}</h4>
                            <div class="button">
                                <img src="{{ url('storage/uploads/images/'. $article->image_thumbnail_path) }}"
                                    alt="{{ $article->article_title }} " width="130" height="130">
                            </div>
                        </a>
                        <p class="mt-2">{{ strip_tags($article->article_content) }}</p>
                    </div>

                    <!-- End Table Head -->
                    <!-- Start Table Content -->
                    <div class="table-content">
                        <!-- Table List -->
                        <ul class="table-list">
                            <li><i class="lni lni-checkmark-circle"></i> Penulis : {{ $article->article_author }}</li>
                            <li><i class="lni lni-checkmark-circle"></i> terbit : {{ $article->created_at }}</li>
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
            @endforeach
        </div>
        @endif
    </div>
</section>

@endsection
