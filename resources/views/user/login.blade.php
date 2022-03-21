@extends('layouts.auth')
@section('title', 'Login')

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
                                <p class="h4" style="line-height: 2em;"><strong>PERBAKIN KABUPATEN
                                        BANDUNG</strong>
                                </p>
                            </div>
                            <div class="text-center">
                                <img src="img/logo_perbakin.png" width="220" height="200" />
                            </div>
                            @if (session('error'))
                            <div class="alert alert-danger text-center p-2 mt-4">
                                <small class="text-danger">{{ session('error') }}</small>
                            </div>
                            @endif
                            <form action="{{ url('do_login') }}" method="post" autocomplete="off" id="loginForm">
                                @csrf
                                <div class="form-group">
                                    <label>Masukan Username</label>
                                    <input class="form-control form-control-lg" type="text" name="user_username"
                                        id="user_username" placeholder="Maksimal 7 karakter" maxlength="7" />
                                    <span class="text-warning text-small">Masukan tanpa "/" dan tahun, No KTA
                                        0123/12/B/2023 masukan 012312B </span>
                                </div>
                                <div class="form-group">
                                    <label>Kata Sandi</label>
                                    <input class="form-control form-control-lg " type="password" name="password"
                                        id="password" placeholder="********" />
                                </div>
                                <div class="form-group">
                                    <button type="submit"
                                        class="btn btn-lg btn-primary form-control form-control-lg">Masuk</button>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ url('/') }}">Kembali ke home</a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ url('/register') }}">Sudah punya KTA? Daftar disini</a>
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
    $("#loginForm").validate({
        rules: {
            user_username: "required",
            password: "required",
        },
        messages: {
            user_username: "Nomor KTA tidak boleh kosong",
            password: "Password tidak boleh kosong",
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

</script>
@endsection
