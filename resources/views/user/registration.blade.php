@extends('layouts.auth')
@section('title', 'Pendaftaran Anggota')

@section('content')
<div class="container d-flex flex-column">
    <div class="row h-100 p-3">
        <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">

                <div class="card">
                    <div class="card-body">
                        <div class="m-sm-4">
                            <div class="text-center">
                                <img src="{{ url('img/perbakin-logo.png') }}" width="140" height="35">
                                <br>
                                <p class="h4 mt-2" style="line-height: 2em;"><strong>PENDAFTARAN ANGGOTA <br> PERBAKIN
                                        KABUPATEN
                                        BANDUNG</strong>
                                </p>
                            </div>
                            @if (session('error'))
                            <div class="alert alert-danger text-center p-2 mt-4">
                                <small class="text-danger">{{ session('error') }}</small>
                            </div>
                            @endif
                            @if (session('success'))
                            <div class="alert alert-success text-center p-2 mt-4">
                                <small class="text-success">{{ session('success') }}</small>
                            </div>
                            @endif
                            <form action="{{ url('do_register') }}" method="post" autocomplete="off" id="regiserForm">
                                @csrf
                                <div class="form-group">
                                    <label>Masukan Nomor KTA</label>
                                    <input class="form-control form-control-lg" type="text" name="user_kta"
                                        id="user_kta" placeholder="0123/12/A/2022" />
                                    @if ($errors->has('user_kta'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Nomor KTA
                                            tidak boleh kosong</label>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Masukan Alamat Email</label>
                                    <input class="form-control form-control-lg" type="email" name="user_email"
                                        id="user_email" placeholder="anggota@gmail.com" />
                                    @if ($errors->has('user_email'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Email tidak
                                            boleh kosong</label>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Masukan Nomor HP / Telp.</label>
                                    <input class="form-control form-control-lg" type="text" name="user_phone"
                                        id="user_phone" placeholder="08123456789" maxlength="15" />
                                    @if ($errors->has('user_phone'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Nomor HP /
                                            Telp. tidak boleh kosong</label>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Masukan Password</label>
                                    <p><small>Password
                                            harus berisi kombinasi huruf kecil dan kapital (Aba), symbol (!@), angka
                                            dengan minimal 8 karakter</small></p>
                                    <input class="form-control form-control-lg " type="password" name="password"
                                        id="password" placeholder="********" minlength="8" />
                                    @if ($errors->has('password'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Password
                                            harus berisi kombinasi huruf kecil dan kapital (Aba), symbol (!@), angka
                                            dengan minimal 8 karakter</label>
                                    </span>
                                    @endif
                                    <div class="input-group-append mt-1">
                                        <span id="myeyesbutton" onclick="change()" class="input-group-text">
                                            Lihat <svg width="1em" height="1em" viewBox="0 0 16 16"
                                                class="bi bi-eye-fill" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                <path fill-rule="evenodd"
                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                            </svg>
                                        </span>
                                    </div>
                                    <p id="validate-status-success" class="text-success"></p>
                                    <p id="validate-status-error" class="text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <label>Konfirmasi Password </label>
                                    <input class="form-control form-control-lg " type="password"
                                        name="password_confirmation" id="password_confirmation"
                                        placeholder="********" />
                                    @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Password
                                            tidak sama</label>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit"
                                        class="btn btn-lg btn-primary form-control form-control-lg">Masuk</button>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-md-8">
                                    <a href="{{ url('/login') }}">Login?</a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ url('/') }}">Kembali ke home</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $("#regiserForm").validate({
        rules: {
            user_kta: "required",
            user_email: "required",
            user_phone: "required",
            password: "required",
        },
        messages: {
            user_kta: "Nomor KTA tidak boleh kosong",
            user_email: "Email tidak boleh kosong",
            user_phone: "Nomor HP / Telp. tidak boleh kosong",
            password: "Password minimal 8 karakter || Password tidak boleh kosong",
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


    // function for disable right right click 
    window.oncontextmenu = function () {
        return false;
    }

    // function for disable key shortcut
    $(window).on('keydown', function (event) {
        if (event.keyCode == 123) {
            return false; //Prevent from f12
        } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
            return false; //Prevent from ctrl+shift+i
        } else if (event.ctrlKey &&
            // event.keyCode === 67 ||
            // event.keyCode === 86 ||
            event.keyCode === 85 ||
            event.keyCode === 117) {
            return false;
            /*
            67  = c
            86  = v
            85  = u
            117 = f6
            */
        }
    });

    //show hide password
    function change() {
        var x = document.getElementById('password').type;
        if (x == 'password') {
            document.getElementById('password').type = 'text';

            document.getElementById('myeyesbutton').innerHTML = `Sembunyikan <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                        <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                                                        <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                                        </svg>`;
        } else {
            document.getElementById('password').type = 'password';

            document.getElementById('myeyesbutton').innerHTML = `Lihat <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                        <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                        </svg>`;
        }
    }

    $(document).ready(function () {
        $("#password_confirmation").keyup(validate);
    });

    $("#validate-status-success").hide();
    $("#validate-status-error").hide();

    function validate() {
        var password1 = $("#password").val();
        var password2 = $("#password_confirmation").val();

        if (password1 == password2) {
            $("#validate-status-success").show();
            $("#validate-status-error").hide();
            $("#validate-status-success").text("Good! Password sama");
        } else {
            $("#validate-status-success").hide();
            $("#validate-status-error").show();
            $("#validate-status-error").text("Opps! Password tidak sama");
        }

    }

</script>
@endsection
