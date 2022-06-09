@extends('layouts.app')
@section('title', 'Daftar')

@section('nav')
<div class="row align-items-center">
    <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">
            Pengguna
        </div>
        <h2 class="page-title">
            Daftar Pengguna
        </h2>
    </div>
    <!-- Page title actions -->
    <div class="col-auto ms-auto d-print-none">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('') }}"><i data-feather="home"
                            class="breadcrumb-item-icon"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Pengguna</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header w-100">
                @if (session('successMessage'))
                <strong id="successMessage" hidden>{{ session('successMessage') }}</strong>
                @elseif(session('errorMessage'))
                <strong id="errorMessage" hidden>{{ session('errorMessage') }}</strong>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="h3">Daftar Pengguna</h3>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb" class="float-right">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/dashboard">
                                        <i data-feather="home" width="16" height="16" class="me-2">
                                        </i></a>
                                </li>
                                <li class="breadcrumb-item"><a disabled>Hak Akses</a></li>
                                <li class="breadcrumb-item active"><a href="#">Daftar Pengguna</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <a href="javascript:void(0)" class="btn btn-success btnAdd" data-toggle="collapse"
                    data-target="#toggle-collapse">
                    <i data-feather="plus" width="16" height="16" class="me-2"></i>
                    Tambah Daftar Pengguna
                </a>
                <div class="table-responsive">
                    <table class="table table-striped card-table table-hover text-nowrap table-data">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th width="10%">Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (sizeof($users) == 0)
                            <tr>
                                <td colspan="6" align="center">Data kosong</td>
                            </tr>
                            @else

                            @foreach ($users as $user)
                            <tr>
                                <td width="5%">{{ $loop->iteration }}</td>
                                <td>{{ $user->user_username }}</td>
                                <td>{{ $user->user_name }}</td>
                                <td>{{ $user->user_email }}</td>
                                <td>{{ $user->user_phone }}</td>
                                <td width="10%">
                                    <form id="formStatus">
                                        @csrf
                                        @php
                                        $status = $user->user_status;
                                        $checked = '';
                                        if($status == 1)
                                        $checked = 'checked';
                                        @endphp
                                        <label class="switch" for="checkboxindex{{$loop->iteration}}">
                                            <input class="checkstatus" id="checkboxindex{{$loop->iteration}}"
                                                type="checkbox" value="{{$user->user_status}}" name="class_status"
                                                data-id="{{$user->user_id}}" {{$checked}}>
                                            <div class="slider round"></div>
                                        </label>

                                    </form>
                                </td>
                                <td width="15%">
                                    <a href="javascript:void(0)" class="btn btn-icon btnDetail btn-outline-info"
                                        data-id="{{ $user->user_id }}" data-toggle="tooltip" data-placement="top"
                                        title="Detail">
                                        <i data-feather="eye" width="16" height="16"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btnEdit btn-outline-warning"
                                        data-id="{{ $user->user_id }}" data-toggle="tooltip" data-placement="top"
                                        title="Ubah">
                                        <i data-feather="edit" width="16" height="16"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger btnDelete"
                                        data-url="{{ url('users/delete/'.$user->user_id )}}" data-toggle="tooltip"
                                        data-placement="top" title="Hapus">
                                        <i data-feather="trash-2" width="16" height="16"></i>
                                    </a>
                                </td>

                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pengguna</h5>
                <button type="button" class="close cancel" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('users/store') }}" method="POST" id="addForm">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Username <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="user_username" id="user_username"
                                        placeholder="Masukan username" value="{{ old('user_username') }}"
                                        style="text-transform: uppercase;" maxlength="7">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="user_name" id="user_name"
                                        placeholder="Masukan nama pengguna" value="{{ old('user_name') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="user_email" id="user_email"
                                        placeholder="Masukan email pengguna" value="{{ old('user_email') }}">
                                    @if ($errors->has('user_email'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Email
                                            sudah digunakan</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Telepon / WA<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="user_phone" id="user_phone"
                                        maxlength="15" placeholder="Masukan no Telp. /WA pengguna"
                                        value="{{ old('user_phone') }}">
                                    @if ($errors->has('user_phone'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Nomor Telepon
                                            sudah digunakan</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="place_of_birth" id="place_of_birth"
                                        placeholder="Masukan tempat lahir" value="{{ old('place_of_birth') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tanggal lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                                        placeholder="Masukan tanggal lahir" value="{{ old('date_of_birth') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="occupation" id="occupation"
                                        placeholder="Masukan pekerjaan" value="{{ old('occupation') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Alamat <span class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control" name="user_address" id="user_address"
                                        placeholder="Masukan alamat pengguna">{{ old('user_address') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nomor KTA <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="user_kta" id="user_kta"
                                        placeholder="Masukan nomor KTA" value="{{ old('user_kta') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Masa Aktif KTA <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="user_active_date"
                                        id="user_active_date" placeholder="Masa aktif KTA"
                                        value="{{ old('user_active_date') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Club Anggota <span class="text-danger">*</span> </label>
                                    <select class="form-control" name="club_id" id="club_id">
                                        <option value="">- Pilih Club Anggota -</option>
                                        @if(sizeof($clubs) > 0)
                                        @foreach($clubs as $club)
                                        <option value="{{ $club->club_id }}">{{ $club->club_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Anggkatan Anggota CLub <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="user_club_gen" id="user_club_gen"
                                        placeholder="Masukan angkatan anggota club" value="{{ old('user_club_gen') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Club Cabang <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="user_club_cab" id="user_club_cab"
                                        placeholder="Masukan cabang club" value="Kab. Bandung">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3" id="user_status_form">
                                <div class="form-group">
                                    <label class="form-label">Status User <span class="text-danger">*</span></label>
                                    <select class="form-control" name="user_status" id="user_status">
                                        <option value="">- Pilih Status -</option>
                                        <option value="1" selected>- Aktif -</option>
                                        <option value="0">- Tidak Aktif -</option>
                                    </select>
                                </div>
                            </div>
                            @if (Auth::user()->user_id == 1 || Auth::user()->user_id == 4 )
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">User Group <span class="text-danger">*</span> </label>
                                    <select class="form-control" name="group_id" id="group_id">
                                        <option value="">- Pilih User Group -</option>
                                        @if(sizeof($groups) > 0)
                                        @foreach($groups as $group)
                                        <option value="{{ $group->group_id }}">{{ $group->group_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            @else
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">User Group <span class="text-danger">*</span> </label>
                                    <select class="form-control" name="group_id" id="group_id">
                                        <option value="5" selected>Anggota</option>
                                    </select>
                                </div>
                            </div>
                            @endif
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control mb-2" name="user_password_old"
                                        id="user_password_old" placeholder="Masukan password pengguna" readonly
                                        value="{{ old('user_password_old') }}">
                                    {{-- Collapse Update Password --}}
                                    <button type="button" class="btn btn-warning mb-2" id="password_collapse_edit"
                                        data-toggle="collapse" data-target="#toggle-collapse"
                                        id="btn-title-collapse">Update
                                        Password</button>
                                    <span class="form-label text-sm text-danger" id="hint_password"></span>
                                    <div id="toggle-collapse" class="collapse">
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
                                            <button type="button" class="btn btn-primary" id="generate_password"
                                                title="Generate Password">Buat Password <i
                                                    class="fas fa-sync-alt ml-1"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary cancel" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Add -->

<!-- Modal Detail -->
<div class=" modal detailModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail User</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="userDetail" name="userDetail">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 mb-3 row">
                                    <label for="user_username" class="col-md-5 col-form-label">Username</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control-plaintext user_username"
                                            value="{{ old('user_username') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 row">
                                    <label for="user_name" class="col-md-5 col-form-label">Nama User</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control-plaintext user_name"
                                            value="{{ old('user_name') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 row">
                                    <label for="user_email" class="col-md-5 col-form-label">Email User
                                        Kelas</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control-plaintext user_email"
                                            value="{{ old('user_email') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 row">
                                    <label for="user_phone" class="col-md-5 col-form-label">Telepon / WA</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control-plaintext user_phone"
                                            value="{{ old('user_phone') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 row">
                                    <label for="place_date_of_birth" class="col-md-5 col-form-label">Tempat, tanggal
                                        lahir</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control-plaintext place_date_of_birth"
                                            value="{{ old('place_date_of_birth') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 row">
                                    <label for="occupation" class="col-md-5 col-form-label">Pekerjaan</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control-plaintext occupation"
                                            value="{{ old('occupation') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 row">
                                    <label for="user_address" class="col-md-5 col-form-label">Alamat</label>
                                    <div class="col-md-6">
                                        <textarea type="text" readonly
                                            class="form-control-plaintext user_address">{{ old('user_address') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 row">
                                    <label for="user_kta" class="col-md-5 col-form-label">Nomor KTA</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control-plaintext user_kta"
                                            value="{{ old('user_kta') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 row">
                                    <label for="club_name" class="col-md-5 col-form-label">Club</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control-plaintext club_name"
                                            value="{{ old('club_name') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 row">
                                    <label for="user_club_gen" class="col-md-5 col-form-label">Angatan anggota
                                        club</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control-plaintext user_club_gen"
                                            value="{{ old('user_club_gen') }}">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3 row">
                                    <label for="user_club_cab" class="col-md-5 col-form-label">Cabang club</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control-plaintext user_club_cab"
                                            value="{{ old('user_club_cab') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 row">
                                    <label for="user_active_date" class="col-md-5 col-form-label">Masa Aktif KTA</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control-plaintext user_active_date"
                                            value="{{ old('user_active_date') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 row">
                                    <label for="user_status" class="col-md-5 col-form-label">Status User</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control-plaintext user_status"
                                            value="{{ old('user_status') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 row">
                                    <label for="group_name" class="col-md-5 col-form-label">User Group</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control-plaintext group_name"
                                            value="{{ old('group_name') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Detail -->

@endsection

@section('script')
<script type="text/javascript">
    var userUsername = document.querySelector('#user_username');

    userUsername.addEventListener('input', restrictAlfaNumber);

    function restrictAlfaNumber(e) {
        var newValue = this.value.replace(new RegExp(/[^a-zA-Z0-9]/gi), "");
        this.value = newValue;
    }

    $('.btnAdd').click(function () {
        document.getElementById("addForm").reset();
        $('.addModal form').attr('action', "{{ url('users/store') }}");

        document.getElementById('password_collapse_edit').style.display = 'block';
        $('#password_collapse_edit').text('Generate Password');
        document.getElementById('hint_password').style.display = 'none';
        document.getElementById('user_password_old').style.display = 'none';
        document.getElementById('user_status_form').style.display = 'none';
        $('.addModal .modal-title').text('Tambah Pengguna');
        $('.addModal').modal('show');

        document.getElementById('btn-title-collapse').value = "Generate Password";
    });

    // check error
    @if(count($errors))
    $('.addModal').modal('show');
    @endif

    $('.btnEdit').click(function () {

        var id = $(this).attr('data-id');
        var url = "{{ url('users/getdata') }}";

        // set display password input
        document.getElementById('user_password_old').style.display = 'block';
        document.getElementById('password_collapse_edit').style.display = 'block';
        document.getElementById('hint_password').style.display = 'block';
        document.getElementById('user_status_form').style.display = 'block';
        $('.addModal form').attr('action', "{{ url('users/update') }}" + '/' + id);

        $.ajax({
            type: 'GET',
            url: url + '/' + id,
            dataType: 'JSON',
            success: function (data) {


                if (data.status == 1) {
                    $('#user_username').val(data.result.user_username);
                    $('#user_name').val(data.result.user_name);
                    $('#user_email').val(data.result.user_email);
                    $('#user_phone').val(data.result.user_phone);
                    $('#place_of_birth').val(data.result.place_of_birth);
                    $('#date_of_birth').val(data.result.date_of_birth);
                    $('#occupation').val(data.result.occupation);
                    $('#user_address').val(data.result.user_address);
                    $('#user_kta').val(data.result.user_kta);
                    $('#user_active_date').val(data.result.user_active_date);
                    $('#club_id').val(data.result.club_id);
                    $('#user_club_gen').val(data.result.user_club_gen);
                    $('#user_club_cab').val(data.result.user_club_cab);

                    $('#user_password_old').val(data.result.user_password);
                    $('#group_id').val(data.result.group_id);
                    $('#user_status').val(data.result.user_status);

                    $('.addModal .modal-title').text('Ubah Pengguna');
                    $('.addModal').modal('show');

                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert('Error : Gagal mengambil data');
            }
        });

    });

    $('#generate_password').click(function () {

        let keylist = "123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!@#$%^&*"
        let temp = ''
        let length = $('#the_length_pass').val();


        for (i = 0; i < length; i++)
            temp += keylist.charAt(Math.floor(Math.random() * keylist.length))

        $('#user_password').val(temp);

    });


    $('.cancel').click(function () {
        // set clear value input password
        $('#user_password').val('');
    });
    $('.submit').click(function () {
        // set clear value input password
        $('.submit').button.disabled = true;
    });

    $("#addForm").validate({
        rules: {
            user_username: "required",
            user_name: "required",
            user_email: "required",
            user_phone: "required",
            place_of_birth: "required",
            date_of_birth: "required",
            occupation: "required",
            user_address: "required",
            user_kta: "required",
            user_active_date: "required",
            club_id: "required",
            user_club_gen: "required",
            user_club_cab: "required",
            user_password: "required",
            group_id: "required",
        },
        messages: {
            user_username: "Username tidak boleh kosong",
            user_name: "Nama user tidak boleh kosong",
            user_email: "Email user tidak boleh kosong",
            user_phone: "Telepon / WA user tidak boleh kosong",
            place_of_birth: "Masukan tempat lahir",
            date_of_birth: "Masukan tanggal lahir",
            occupation: "Masukan pekerjaan",
            user_address: "Masukan alamat",
            user_kta: "Masukan nomor KTA",
            user_active_date: "Masukan masa aktif KTA",
            club_id: "Pilih club",
            user_club_gen: "Masukan angkatan anggota club",
            user_club_cab: "Masukan club cabang",
            user_password: "Password user tidak boleh kosong",
            group_id: "Nama grup tidak boleh kosong",
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

    // update status
    $('.checkstatus').click(function () {
        let id = $(this).attr('data-id');
        let url = "{{ url('users/updatestatus') }}" + '/' + id;
        let value = this.checked ? 1 : 0;
        if (value == 1) {
            Swal.fire({
                title: 'Aktifkan User?',
                text: "Apakah anda yakin ingin mengaktifkan status user?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, aktifkan!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: 'POST',
                        data: {
                            user_status: value,
                            _token: '{{csrf_token()}}'
                        },
                        url: url,
                        success: function (data) {
                            if (data.status == 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Update berhasil!',
                                    text: 'Status berhasil diupdate!',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Update gagal!',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 4000
                                });
                                setTimeout(location.reload.bind(location), 4000);
                            }
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Update gagal!',
                                text: 'Status gagal diupdate!',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            location.reload();
                        }
                    })

                } else {
                    location.reload()
                }
            })
        } else {

            Swal.fire({
                title: 'Nonaktifkan User?',
                text: "Apakah anda yakin ingin menonaktifkan status user?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Nonaktifkan!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: 'POST',
                        data: {
                            user_status: value,
                            _token: '{{csrf_token()}}'
                        },
                        url: url,
                        success: function (data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Update berhasil!',
                                text: 'Status berhasil diupdate!',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Update gagal!',
                                text: 'Status gagal diupdate!',
                                showConfirmButton: false,
                                timer: 2000
                            })
                            location.reload();
                        }
                    })

                } else {
                    location.reload()
                }
            })
        }
    });

    $('.btnDetail').click(function () {
        let id = $(this).attr('data-id');
        let url = "{{ url('users/show') }}";

        $.ajax({
            type: 'GET',
            url: url + '/' + id,
            dataType: 'JSON',
            success: function (data) {
                console.log(data);
                if (data.status == 1) {
                    $('.user_username').val(': ' + data.result[0].user_username);
                    $('.user_name').val(': ' + data.result[0].user_name);
                    $('.user_email').val(': ' + data.result[0].user_email);
                    $('.user_phone').val(': ' + data.result[0].user_phone);
                    $('.place_date_of_birth').val(': ' + data.result[0].place_of_birth + ', ' + data
                        .result.date_of_birth_id);
                    $('.occupation').val(': ' + data.result[0].occupation);
                    $('.user_address').val(': ' + data.result[0].user_address);
                    $('.user_kta').val(': ' + data.result[0].user_kta);
                    $('.user_active_date').val(': ' + data.result[0].user_active_date);
                    $('.club_name').val(': ' + data.result[0].club_name);
                    $('.user_club_gen').val(': ' + data.result[0].user_club_gen);
                    $('.user_club_cab').val(': ' + data.result[0].user_club_cab);
                    $('.group_name').val(': ' + data.result[0].group_name);
                    if (data.result[0].user_status == 1) {
                        $('.user_status').val(': ' + 'Aktif');
                    } else {
                        $('.user_status').val(': ' + 'Tidak Aktif');
                    }


                    $('.detailModal .modal-title').text('Detail Data User');
                    $('.detailModal').modal('show');
                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                Swal.fire(
                    'Gagal!',
                    'Gagal mengambil data.',
                    'error'
                );
            }
        });
    });

    $('.btnDelete').click(function () {
        $('.btnDelete').attr('disabled', true)
        var url = $(this).attr('data-url');
        Swal.fire({
            title: 'Apakah anda yakin ingin menghapus data?',
            text: "Kamu tidak akan bisa mengembalikan data ini setelah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya. Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function (data) {
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Terhapus!',
                                'Data Berhasil Dihapus.',
                                'success'
                            ).then(() => {
                                location.reload()
                            })
                        }
                    },
                    error: function (XMLHttpRequest, textStatus,
                        errorThrown) {
                        Swal.fire(
                            'Gagal!',
                            'Gagal menghapus data.',
                            'error'
                        );
                    }
                });
            }
        })
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

</script>
@endsection
