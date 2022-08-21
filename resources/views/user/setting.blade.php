@extends('layouts.app')
@section('title', 'Pengaturan Profil')

@section('content')



<div class="card">
    <div class="card-header">
        @if (session('successMessage'))

        <strong id="successMessage" hidden>{{ session('successMessage') }}</strong>

        @elseif(session('errorMessage'))

        <strong id="errorMessage" hidden>{{ session('errorMessage') }}</strong>

        @endif
        <div class="row">
            <div class="col-md-6">
                <h3 class="h3">Data Profil</h3>
            </div>
            <div class="col-md-6">
                <nav aria-label="breadcrumb" class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/dashboard">
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
                                        placeholder="Pilih image" value="{{Auth::user()->user_image}}"
                                        data-parsley-pattern="/(\.jpg|\.jpeg|\.png|\.bmp|\.gif)$/i"
                                        data-parsley-error-message="Masukkan Ekstensi jpg/jpeg/png/bmp/gif">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Nomor KTA <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="user_kta" id="user_kta"
                                            placeholder="Masukan nomor KTA" value="{{Auth::user()->user_kta}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Nama <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="user_name" id="user_name"
                                            placeholder="Masukan nama pengguna" value="{{Auth::user()->user_name}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Username <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="user_username"
                                            placeholder="Masukan username" value="{{Auth::user()->user_username}}"
                                            readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="user_email" id="user_email"
                                            placeholder="Masukan email pengguna" readonly
                                            value="{{Auth::user()->user_email}}">
                                        @if ($errors->has('user_email'))
                                        <span class="text-danger">
                                            <label id="basic-error" class="validation-error-label" for="basic">Email
                                                sudah digunakan</label>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control mb-2" name="user_password_old"
                                            id="user_password_old" placeholder="Masukan password pengguna" readonly
                                            value="{{Auth::user()->user_password}}">
                                        {{-- Collapse Update Password --}}
                                        <button type="button" class="btn btn-warning mb-2" id="password_collapse_edit"
                                            data-toggle="collapse" data-target="#toggle-collapse"
                                            id="btn-title-collapse">Update
                                            Password</button>
                                        <span class="form-label text-sm text-danger" id="hint_password"></span>
                                        <div id="toggle-collapse" class="collapse">
                                            <input type="password" class="form-control mb-2" name="user_password_check"
                                                id="user_password_check" placeholder="Masukan password lama">
                                            <div class="input-group">
                                                <input type="password" id="user_password" name="user_password"
                                                    class="form-control" placeholder="Masukan password baru">
                                                <div class="input-group-append">
                                                    <span id="myeyesbutton" onclick="change()" class="input-group-text">
                                                        <svg width="1em" height="1em" viewBox="0 0 16 16"
                                                            class="bi bi-eye-fill" fill="currentColor"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                            <path fill-rule="evenodd"
                                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group mt-2" id="password-generated">
                                                <label class="form-label">Password Length:</label>
                                                <input type="number" class="col-md-2" id="the_length_pass" size=3
                                                    maxlength="2" value="10">
                                                <button type="button" class="btn btn-light" id="generate_password"
                                                    title="Generate Password">Generate <i
                                                        class="fas fa-sync-alt ml-1"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" name="place_of_birth"
                                            id="place_of_birth" placeholder="Masukan tempat lahir"
                                            value="{{Auth::user()->place_of_birth}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Tanggal lahir</label>
                                        <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                                            placeholder="Masukan tanggal lahir" value="{{Auth::user()->date_of_birth}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Pekerjaan</label>
                                        <input type="text" class="form-control" name="occupation" id="occupation"
                                            placeholder="Masukan pekerjaan" value="{{Auth::user()->occupation}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Alamat</label>
                                        <textarea type="text" class="form-control" name="user_address" id="user_address"
                                            placeholder="Masukan alamat pengguna">{{Auth::user()->user_address}}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Club Anggota saat ini: <br>
                                            <input type="hidden" value="{{$getDetail->club_id}}" name="club_id">
                                            <b class="current-club-name">({{$getDetail->club_name != "" ? $getDetail->club_name : "Club belum dipilih"}})</b>
                                        </label>
                                        <br>
                                        <button type="button" class="btn btn-warning mb-2"
                                            data-toggle="collapse" data-target="#toggle-collapse-club"
                                            id="btn-title-collapse">Update club</button>
                                        <span class="form-label text-sm text-danger" id="hint_password"></span>
                                        <div id="toggle-collapse-club" class="collapse">
                                            <select class="form-control" name="club_id_update">
                                                <option value="">- Pilih Club -</option>
                                                @if(sizeof($clubs) > 0)
                                                @foreach($clubs as $club)
                                                <option value="{{ $club->club_id }}">{{$club->club_name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Anggkatan Anggota CLub </label>
                                        <input type="number" class="form-control" name="user_club_gen"
                                            id="user_club_gen" placeholder="Masukan angkatan anggota club"
                                            value="{{Auth::user()->user_club_gen}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Club Cabang</label>
                                        <input type="text" class="form-control" name="user_club_cab" id="user_club_cab"
                                            placeholder="Masukan cabang club" value="{{Auth::user()->user_club_cab}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success submit float-right"><i data-feather="edit" width="16"
                    height="16"></i>
                Update Data</button>
        </form>

    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">

    let current_club = $('.current-club-id').val();
    let options = document.getElementById("club_id").options;
    for (let i = 0; i < options.length; i++) {
        if (options[i].text == current_club) {
            options[i].selected = true;
            break;
        }
    }


    $('#generate_password').click(function () {

        let keylist = "123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!@#$%^&*"
        let temp = ''
        let length = $('#the_length_pass').val();


        for (i = 0; i < length; i++)
            temp += keylist.charAt(Math.floor(Math.random() * keylist.length))

        $('#user_password').val(temp);

    });


    //show hide password
    function change() {
        var x = document.getElementById('user_password').type;
        if (x == 'password') {
            document.getElementById('user_password').type = 'text';

            document.getElementById('myeyesbutton').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                        <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                                                        <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                                        </svg>`;
        } else {
            document.getElementById('user_password').type = 'password';

            document.getElementById('myeyesbutton').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                        <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                        </svg>`;
        }
    }
    // function for disable right right click
    // window.oncontextmenu = function () {
    //     return false;
    // }

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
