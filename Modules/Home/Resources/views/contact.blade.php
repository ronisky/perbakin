@extends('layouts.home')
@section('title', 'Kontak Perbakin Kab. Bandung')

@section('content')

@if (session('successMessage'))
<strong id="successMessage" hidden>{{ session('successMessage') }}</strong>
@elseif(session('errorMessage'))
<strong id="errorMessage" hidden>{{ session('errorMessage') }}</strong>
@endif
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
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">Pertanyaan yang sering ditanyakan</h2>
                </div>
            </div>

            <div class="accordion" id="accordionExample">
                @foreach ($faqs as $faq)
                @php
                $no = 0;
                @endphp
                <div class="card row mb-2">
                    <div class="card-header" id="heading{{ $no }}">
                        <h4 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                data-target="#collapse{{ $no }}" aria-expanded="false"
                                aria-controls="collapse{{ $no }}">
                                {{ $faq->faq_question }}?
                            </button>
                        </h4>
                    </div>

                    <div id="collapse{{ $no }}" class="collapse show" aria-labelledby="heading{{ $no }}"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            {{ strip_tags($faq->faq_description) }}
                        </div>
                    </div>
                </div>
                @php
                $no++
                @endphp
                @endforeach
            </div>

            <div class="col-md-12">
                <h3 class="center">Ajukan pertanyaan?</h3>
                <form action="{{ url('faq/store') }}" method="POST" id="addFaqForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label">Nama Lengkap<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="faq_name" id="faq_name"
                                            placeholder="Masukan nama lengkap" value="{{ old('faq_name') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label">Alamat Email<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="faq_email" id="faq_email"
                                            placeholder="Masukan alamat email" value="{{ old('faq_email') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label">Nomor Hp / Telp.<span
                                                class="text-danger">*</span></label>
                                        <input type="number" maxlength="15" class="form-control" name="faq_phone"
                                            id="faq_phone" placeholder="Masukan no Hp / Telp."
                                            value="{{ old('faq_phone') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label">Masukan Nomor Induk Kependudukan<span
                                                class="text-danger">*</span></label>
                                        <input type="text" maxlength="16" onkeypress='validate()' class="form-control"
                                            name="faq_nik" id="faq_nik" placeholder="Masukan NIK Anda"
                                            value="{{ old('faq_nik') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label">Masukan Pertanyaan<span
                                                class="text-danger">*</span></label>
                                        <textarea type="text" class="form-control" name="faq_question" id="faq_question"
                                            rows="4" maxlength="100" required
                                            placeholder="Masukan pertanyaan anda">{{ old('faq_question') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>

            <div class="row">
                <p class="wow fadeInUp mt-5 mb-3" data-wow-delay=".6s">Anda bisa mengikuti sosial media kami, atau anda
                    bisa
                    menghubungi kami jika diperlukan melalui email atau kontak yang tersedia</p>
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

@section('script')
<script type="text/javascript">
    function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
            // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault) theEvent.preventDefault();
        }
    }

    $("#addFaqForm").validate({
        rules: {
            faq_name: "required",
            faq_email: "required",
            faq_phone: "required",
            faq_nik: "required",
            faq_question: "required",
        },
        messages: {
            faq_name: "Nama tidak boleh kosong",
            faq_email: "Email tidak boleh kosong",
            faq_phone: "Nomor Hp / Telp. tidak boleh kosong",
            faq_nik: "NIK tidak boleh kosong",
            faq_question: "Pertanyaan tidak boleh kosong",
        },
        errorElement: "em",
        errorClass: "invalid-feedback",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            $(element).parents('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
        }
    });

</script>
@endsection
