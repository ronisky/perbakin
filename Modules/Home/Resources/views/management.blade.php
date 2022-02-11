@extends('layouts.home')
@section('title', 'Pengurus Perbakin Kab. Bandung')

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
