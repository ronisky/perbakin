@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<style>
    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 1000;
        display: none;
        float: left;
        min-width: 160px;
        padding: 5px 0;
        margin: 2px 0 0;
        font-size: 14px;
        text-align: left;
        list-style: none;
        background-color: #fff;
        /* here */
        -webkit-background-clip: padding-box;
        background-clip: padding-box;
        border: 1px solid #ccc;
        border: 1px solid rgba(0, 0, 0, .15);
        border-radius: 4px;
        -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
        box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
    }

    #mydiv>.btn-default {
        background: transparent;
    }

    .bg-proposal {
        background: #D7D0F6;
    }

    .bg-terbuka {
        background: #C8E8FF;
    }

    .bg-skripsi {
        background: #E0FFE3;
    }

    .bg-yudisium {
        background: #FFEBB0;
    }

    .bg-kp {
        background: #FFDCDB;
    }

    .bg-kelas {
        background: #CED4DA;
    }

    .bg-surat {
        background: #F2F4F8;
    }

    .btn-lihat {
        background: #FFC53B;
        text-align: center;
        color: black;
    }

    .card-box {
        min-height: 160px;
    }
</style>

<div class="container-fluid p-0">

    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3>Dashboard</h3>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-3 col-md-2 col-sm-6 ">
            <div class="card flex">
                <div class="card-body py-4 card-box">
                    <div class="media">
                        <div class="media-body">
                            <h1 class="mb-3">{{$totalUser}}</h1>
                            <div>
                                <p class="mb-0">Jumlah Anggota Aktif</p>
                            </div>
                        </div>
                        <div class="d-inline-block ml-2">
                            <div class="stat bg-proposal">
                                <svg width="18" height="22" viewBox="0 0 18 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.125 1H3.41667C2.90834 1 2.42082 1.20193 2.06138 1.56138C1.70193 1.92082 1.5 2.40834 1.5 2.91667V18.25C1.5 18.7583 1.70193 19.2458 2.06138 19.6053C2.42082 19.9647 2.90834 20.1667 3.41667 20.1667H14.9167C15.425 20.1667 15.9125 19.9647 16.272 19.6053C16.6314 19.2458 16.8333 18.7583 16.8333 18.25V7.70833L10.125 1Z"
                                        stroke="black" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M10.125 1V7.70833H16.8333" stroke="black" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-2 col-sm-6 ">
            <div class="card flex">
                <div class="card-body py-4 card-box">
                    <div class="media">
                        <div class="media-body">
                            <h1 class="mb-3">{{$totalClub}}</h1>
                            <div>
                                <p class="mb-0">Jumlah Klub</p>
                            </div>
                        </div>
                        <div class="d-inline-block ml-2">
                            <div class="stat bg-skripsi">
                                <svg width="18" height="22" viewBox="0 0 18 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1 18.5C1 17.837 1.26339 17.2011 1.73223 16.7322C2.20107 16.2634 2.83696 16 3.5 16H17"
                                        stroke="black" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M3.5 1H17V21H3.5C2.83696 21 2.20107 20.7366 1.73223 20.2678C1.26339 19.7989 1 19.163 1 18.5V3.5C1 2.83696 1.26339 2.20107 1.73223 1.73223C2.20107 1.26339 2.83696 1 3.5 1V1Z"
                                        stroke="black" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-2 col-sm-6 ">
            <div class="card flex">
                <div class="card-body py-4 card-box">
                    <div class="media">
                        <div class="media-body">
                            <h1 class="mb-3">{{$totalSponsor}}</h1>
                            <div>
                                <p class="mb-0">Jumlah Sponsor</p>
                            </div>
                        </div>
                        <div class="d-inline-block ml-2">
                            <div class="stat bg-yudisium">
                                <svg width="18" height="22" viewBox="0 0 18 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1 18.5C1 17.837 1.26339 17.2011 1.73223 16.7322C2.20107 16.2634 2.83696 16 3.5 16H17"
                                        stroke="black" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M3.5 1H17V21H3.5C2.83696 21 2.20107 20.7366 1.73223 20.2678C1.26339 19.7989 1 19.163 1 18.5V3.5C1 2.83696 1.26339 2.20107 1.73223 1.73223C2.20107 1.26339 2.83696 1 3.5 1V1Z"
                                        stroke="black" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-2 col-sm-6 ">
            <div class="card flex">
                <div class="card-body py-4 card-box">
                    <div class="media">
                        <div class="media-body">
                            <h1 class="mb-3">{{$totalArticle}}</h1>
                            <div>
                                <p class="mb-0">Jumlah Artikel Dipublikasi</p>
                            </div>
                        </div>
                        <div class="d-inline-block ml-2">
                            <div class="stat bg-kp">
                                <svg width="18" height="22" viewBox="0 0 18 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1 18.5C1 17.837 1.26339 17.2011 1.73223 16.7322C2.20107 16.2634 2.83696 16 3.5 16H17"
                                        stroke="black" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M3.5 1H17V21H3.5C2.83696 21 2.20107 20.7366 1.73223 20.2678C1.26339 19.7989 1 19.163 1 18.5V3.5C1 2.83696 1.26339 2.20107 1.73223 1.73223C2.20107 1.26339 2.83696 1 3.5 1V1Z"
                                        stroke="black" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class=" col-lg-8 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h2>Data Pengajuan Surat</h2>
                    <div class="row">
                        <div class="col-md-8 col-lg-5 mt-5 mr-5">
                            <div class="chart chart-sm">
                                <canvas id="chartjs-doughnut"></canvas>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-5 mt-5 ml-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="inline">
                                        <span class="mr-1 badge badge-pill badge-primary">-</span>Surat Baru
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <p class="inline"><span class="mr-1 badge badge-pill badge-warning">-</span>Suat
                                        Perlu
                                        Diproses
                                    </p>
                                </div>
                                <div class=" col-md-12">
                                    <p class="inline"><span class="mr-1 badge badge-pill badge-success">-</span>Surat
                                        Disetujui
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <p class="inline"><span class="mr-1 badge badge-pill badge-danger">-</span>Surat
                                        Ditolak
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" col-lg-4">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="media">
                        <div class="media-body">
                            <h1 class="mb-3">{{$letterProcess}}</h1>
                            <div>
                                <p class="mb-2">Pengajuan Surat yang Perlu Diproses</p>
                            </div>
                            <a href="{{ url('letter') }}" class="btn btn-lihat" role="button"
                                style="color : black"><b>LIHAT LEBIH</b></a>
                        </div>
                        <div class="d-inline-block ml-2">
                            <div class="stat bg-surat">
                                <svg width="27" height="22" viewBox="0 0 27 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.5 1H23.5C24.875 1 26 2.125 26 3.5V18.5C26 19.875 24.875 21 23.5 21H3.5C2.125 21 1 19.875 1 18.5V3.5C1 2.125 2.125 1 3.5 1Z"
                                        stroke="#292929" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M26 3.5L13.5 12.25L1 3.5" stroke="#292929" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="media">
                        <div class="media-body">
                            <h1 class="mb-3">{{$letterSuccess}}</h1>
                            <div>
                                <p class="mb-2">Pengajuan Surat yang sudah disetujui</p>
                            </div>
                            <a href="{{ url('letter') }}" class="btn btn-lihat" role="button"
                                style="color : black"><b>LIHAT LEBIH</b></a>
                        </div>
                        <div class="d-inline-block ml-2">
                            <div class="stat bg-surat">
                                <svg width="27" height="22" viewBox="0 0 27 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.5 1H23.5C24.875 1 26 2.125 26 3.5V18.5C26 19.875 24.875 21 23.5 21H3.5C2.125 21 1 19.875 1 18.5V3.5C1 2.125 2.125 1 3.5 1Z"
                                        stroke="#292929" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M26 3.5L13.5 12.25L1 3.5" stroke="#292929" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
			// Doughnut chart
			new Chart(document.getElementById("chartjs-doughnut"), {
				type: "doughnut",
				data: {
					labels: ["Suarat Baru", "Surat Disetujui", "Surat Ditolak", "Suat Perlu Diproses"],
					datasets: [{
						data: [260, 125, 54, 146],
						backgroundColor: [
							window.theme.primary,
							window.theme.success,
							window.theme.danger,
							window.theme.warning
						],
						borderColor: "transparent"
					}]
				},
				options: {
					maintainAspectRatio: false,
					cutoutPercentage: 65,
					legend: {
						display: false
					}
				}
			});
	});
</script>