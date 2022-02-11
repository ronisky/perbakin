@extends('layouts.home')
@section('title', 'Kontak Perbakin Kab. Bandung')

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

<section id="contact" class="features section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h3 class="wow zoomIn" data-wow-delay=".2s">Contact Us</h3>
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">Kontak dan Sosial Media Kami</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s">Anda bisa mengikuti sosial media kami, atau anda bisa
                        menghubungi kami jika diperlukan melalui email atau kontak yang tersedia</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2 text-center">
                    <a href="javascript:void(0)"><svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M22.9724 3.76343H2.97244C2.41689 3.76343 1.91689 3.98565 1.47244 4.43009C1.13911 4.76343 0.972443 5.20787 0.972443 5.76343V17.7634C0.972443 18.319 1.13911 18.819 1.47244 19.2634C1.91689 19.5968 2.41689 19.7634 2.97244 19.7634H22.9724C23.528 19.7634 23.9724 19.5968 24.3058 19.2634C24.7502 18.819 24.9724 18.319 24.9724 17.7634V5.76343C24.9724 5.20787 24.7502 4.76343 24.3058 4.43009C23.9724 3.98565 23.528 3.76343 22.9724 3.76343ZM20.6391 5.76343L13.3058 10.0968C13.1947 10.2079 12.9724 10.2079 12.6391 10.0968L5.30578 5.76343H20.6391ZM2.97244 17.7634V6.59676L11.4724 11.9301C11.9169 12.1523 12.4169 12.2634 12.9724 12.2634C13.528 12.2634 13.9724 12.1523 14.3058 11.9301L22.9724 6.59676V17.7634H2.97244Z"
                                fill="black" fill-opacity="0.88"></path>
                        </svg></a>
                    <p>Email</p>
                </div>
                <div class="col-md-2 text-center">
                    <a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a>
                    <p>Facebook</p>
                </div>
                <div class="col-md-2 text-center">
                    <a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a>
                    <p>Twitter</p>
                </div>
                <div class="col-md-2 text-center">
                    <a href="javascript:void(0)"><i class="lni lni-instagram"></i></a>
                    <p>Instagram</p>
                </div>
                <div class="col-md-2 text-center">
                    <a href="javascript:void(0)"><i class="lni lni-youtube"></i></a>
                    <p>Youtube</p>
                </div>

            </div>
        </div>
    </div>
    </div>
</section>

@endsection
