<?php use App\Helpers\DataHelper; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
    <meta name="author" content="Bootlab">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if (View::hasSection('title'))
        @yield('title') -
        @endif
        Perbakin Kabupaten Bandung
    </title>

    <link rel="canonical" href="https://appstack.bootlab.io/dashboard-default.html" />
    <link rel="shortcut icon" href="{{ url('img/logo.png') }}">
    <link rel="stylesheet" href="{{ url('css/style-custom.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link class="stylesheet" href="{{ url('css/light.css') }}" rel="stylesheet">
    <link class="stylesheet" href="{{ url('css/signature.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">

    {{-- select2 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

</head>

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand">
                    <img src="{{ url('img/perbakin-logo.png') }}" width="140" height="35">
                </a>
                {{-- sidebar --}}
                <ul class="sidebar-nav">
                    @include('components.menu')
                </ul>
            </div>
        </nav>
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <a href="/" target="blank" class="btn btn-outline-secondary mr-4">Home Website</a>
                <br>

                {{-- <form class="d-none d-sm-inline-block">
                    <div class="input-group input-group-navbar">
                        <input type="text" class="form-control" placeholder="Cari…" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn" type="button">
                                <i class="align-middle" data-feather="search"></i>
                            </button>
                        </div>
                    </div>
                </form> --}}

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                data-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-toggle="dropdown">
                                {{-- <img src="{{ url('img/avatars/avatar.jpg') }}"
                                class="avatar img-fluid rounded-circle mr-1" alt="{{ $user->user_name }}" /> <span
                                    class="text-dark">{{ $user->user_name }}</span> --}}
                                <img src="{{ url('img/avatars/avatar.jpg') }}"
                                    class="avatar img-fluid rounded-circle mr-1"
                                    alt="{!! DataHelper::getUserLogin()->user_name !!}" /> <span class="text-dark">{!!
                                    DataHelper::getUserLogin()->user_name !!}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="pages-profile.html"><i class="align-middle mr-1"
                                        data-feather="user">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                    </i> Ubah Password
                                </a>
                                <a class="dropdown-item" href="#"><i class="align-middle mr-2 mb-1"
                                        data-feather="unlock">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-unlock">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0 1 9.9-1"></path>
                                        </svg>
                                    </i>Edit Data</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-log-out">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    Keluar
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            {{-- main content --}}
            <main class="content">
                @yield('content')
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-12 text-center">
                            <p class="mb-0">
                                &copy; 2021 Perbakin <b>.</b> By #</a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src={{ url('js/app.js') }}></script>
    <script src={{ url('js/signature.js') }}></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- select2 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

    <!-- include summernote css/js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        // document.addEventListener("DOMContentLoaded", function () {
        //     // Bar chart
        //     new Chart(document.getElementById("chartjs-dashboard-bar"), {
        //         type: "bar",
        //         data: {
        //             labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct",
        //                 "Nov", "Dec"
        //             ],
        //             datasets: [{
        //                 label: "Last year",
        //                 backgroundColor: window.theme.primary,
        //                 borderColor: window.theme.primary,
        //                 hoverBackgroundColor: window.theme.primary,
        //                 hoverBorderColor: window.theme.primary,
        //                 data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
        //                 barPercentage: .325,
        //                 categoryPercentage: .5
        //             }, {
        //                 label: "This year",
        //                 backgroundColor: window.theme["primary-light"],
        //                 borderColor: window.theme["primary-light"],
        //                 hoverBackgroundColor: window.theme["primary-light"],
        //                 hoverBorderColor: window.theme["primary-light"],
        //                 data: [69, 66, 24, 48, 52, 51, 44, 53, 62, 79, 51, 68],
        //                 barPercentage: .325,
        //                 categoryPercentage: .5
        //             }]
        //         },
        //         options: {
        //             maintainAspectRatio: false,
        //             cornerRadius: 15,
        //             legend: {
        //                 display: false
        //             },
        //             scales: {
        //                 yAxes: [{
        //                     gridLines: {
        //                         display: false
        //                     },
        //                     stacked: false,
        //                     ticks: {
        //                         stepSize: 20
        //                     },
        //                     stacked: true,
        //                 }],
        //                 xAxes: [{
        //                     stacked: false,
        //                     gridLines: {
        //                         color: "transparent"
        //                     },
        //                     stacked: true,
        //                 }]
        //             }
        //         }
        //     });
        // });

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            $("#datetimepicker-dashboard").datetimepicker({
                inline: true,
                sideBySide: false,
                format: "L"
            });
        });

    </script>
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Pie chart
            new Chart(document.getElementById("chartjs-dashboard-pie"), {
                type: "pie",
                data: {
                    labels: ["Direct", "Affiliate", "E-mail", "Other"],
                    datasets: [{
                        data: [2602, 1253, 541, 1465],
                        backgroundColor: [
                            window.theme.primary,
                            window.theme.warning,
                            window.theme.danger,
                            "#E8EAED"
                        ],
                        borderWidth: 5,
                        borderColor: window.theme.white
                    }]
                },
                options: {
                    responsive: !window.MSInputMethodContext,
                    maintainAspectRatio: false,
                    cutoutPercentage: 70,
                    legend: {
                        display: false
                    }
                }
            });
        });

    </script> --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            $(".table-data").DataTable({
                pageLength: 10,
                lengthChange: false,
                bFilter: true,
                autoWidth: true
            });
        });

    </script>

    {{-- notification show --}}
    <script>
        var notyfSuccess = new Notyf({
            duration: 5000,
            position: {
                x: 'right',
                y: 'top'
            }
        });
        var notyfError = new Notyf({
            duration: 0,
            dismissible: true,
            position: {
                x: 'right',
                y: 'top'
            }
        });
        var msgSuccess = $('#successMessage').html()
        if (msgSuccess !== undefined) {
            notyfSuccess.success(msgSuccess)
        }
        var msgError = $('#errorMessage').html()
        if (msgError !== undefined) {
            notyfError.error(msgError)
        }

    </script>

    <script>
        // summernote 
        $(document).ready(function () {
            $('.summernote').summernote();

        });

        // choose file
        $('.custom-file-input').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

    </script>




    @yield('script')

</body>

</html>
