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
                                <img src="img/logo.png" width="220" height="200" />
                            </div>
                            @if (session('error'))
                            <div class="alert alert-danger text-center p-2 mt-4">
                                <small class="text-danger">{{ session('error') }}</small>
                            </div>
                            @endif
                            <form action="{{ url('do_login') }}" method="post" autocomplete="off" id="loginForm">
                                @csrf
                                <div class="form-group">
                                    <label>Username Pengguna</label>
                                    <input class="form-control form-control-lg" type="email" name="email" id="email"
                                        placeholder="Masukan Username Pengguna" />
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
                            <a href="{{ url('/') }}">Kembali ke home</a>
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
            email: "required",
            password: "required",
        },
        messages: {
            email: "Email tidak boleh kosong",
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

</script>
@endsection
