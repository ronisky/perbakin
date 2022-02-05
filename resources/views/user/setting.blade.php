@extends('layouts.app')
@section('title', 'Pengaturan Profil')

@section('content')



<div class="card">
    <div class="card-header">
        @if (session('message'))

        <strong id="msgId" hidden>{{ session('message') }}</strong>

        @endif
        <div class="row">
            <div class="col-md-6">
                <h3 class="h3">Data Profil</h3>
            </div>
            <div class="col-md-6">
                <nav aria-label="breadcrumb" class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home" width="16" height="16" class="me-2">
                                </i></a>
                        </li>
                        <li class="breadcrumb-item active"><a href="#">Profil</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card-body">

        <form action="{{ url('profile/update/') }}/{{Auth::user()->user_id}}" method="POST" id="addForm"
            enctype="multipart/form-data" data-parsley-validate>
            @csrf
            <div class="modal-body">
                <div class="form-body">

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="text-center">
                                @if(Auth::user()->user_image == NULL)
                                <img alt="profile" src="img/avatars/profile.jpg"
                                    class="rounded-circle img-responsive mt-2" width="200" height="200" />
                                @else
                                <img alt="profile"
                                    src="{{asset('storage/uploads/images')}}/{{Auth::user()->user_image}}"
                                    class="rounded-circle img-responsive mt-2" width="200" height="200" />
                                @endif

                                <div class="mt-2">
                                    <input type="file" class="form-control" name="user_image" id="user_image"
                                        placeholder="Masukan testimoni" value="{{ old('user_image') }}"
                                        data-parsley-pattern="/(\.jpg|\.jpeg|\.png|\.bmp|\.gif)$/i"
                                        data-parsley-error-message="Masukkan Ekstensi jpg/jpeg/png/bmp/gif">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-3">
                                <label class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="user_name" id="user_name"
                                    placeholder="Masukan nama pengguna"
                                    value="{{ old('user_name') }}{{Auth::user()->user_name}}">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="user_email" id="user_email"
                                    placeholder="Masukan email pengguna"
                                    value="{{ old('user_email') }}{{Auth::user()->user_email}}">
                                @if ($errors->has('user_email'))
                                <span class="text-danger">
                                    <label id="basic-error" class="validation-error-label" for="basic">Email
                                        sudah digunakan</label>
                                </span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control mb-2" name="user_password_old"
                                    id="user_password_old" placeholder="Masukan password pengguna" readonly
                                    value="{{ old('user_password_old') }}{{Auth::user()->user_password}}">
                                {{-- Collapse Update Password --}}
                                <button type="button" class="btn btn-warning mb-2" id="password_collapse_edit"
                                    data-toggle="collapse" data-target="#toggle-collapse" id="btn-title-collapse">Update
                                    Password</button>
                                <span class="form-label text-sm text-danger" id="hint_password"></span>
                                <div id="toggle-collapse" class="collapse">
                                    <input type="text" class="form-control" name="user_password" id="user_password"
                                        placeholder="Masukan password baru" value="{{ old('user_password') }}">
                                    <div class="form-group mt-2" id="password-generated">
                                        <label class="form-label">Password Length:</label>
                                        <input type="number" class="col-md-2" id="the_length_pass" size=3 maxlength="2"
                                            value="10">
                                        <button type="button" class="btn btn-light" id="generate_password"
                                            title="Generate Password">Generate <i
                                                class="fas fa-sync-alt ml-1"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success submit"><i data-feather="edit" width="16" height="16"></i>
                Simpan</button>
        </form>

    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $('#generate_password').click(function () {

        let keylist = "123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!@#$%^&*"
        let temp = ''
        let length = $('#the_length_pass').val();


        for (i = 0; i < length; i++)
            temp += keylist.charAt(Math.floor(Math.random() * keylist.length))

        $('#user_password').val(temp);

    });

    var notyf = new Notyf({
        duration: 5000,
        position: {
            x: 'right',
            y: 'top'
        }
    });
    var msg = $('#msgId').html()
    if (msg !== undefined) {
        notyf.success(msg)
    }

</script>
@endsection
