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
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<!-- <div class="container-fluid"> -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<!-- basic table -->

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
                                    <a href="/">
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
                                <th>Nomor KTA</th>
                                <th>Masa Aktif KTA</th>
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
                                <td>{{ $user->user_kta }}</td>
                                <td>{{$user->user_active_date  }}</td>
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
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
<!-- </div> -->
<!-- ============================================================== -->
<!-- End Container fluid  -->

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
                                        placeholder="Masukan nama pengguna" value="{{ old('user_username') }}"
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
                                    <label class="form-label">Nomor KTA <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="user_kta" id="user_kta"
                                        placeholder="Masukan nama pengguna" value="{{ old('user_kta') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Masa Aktif KTA <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="user_active_date"
                                        id="user_active_date" value="{{ old('user_active_date') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3" id="user_status_form">
                                <div class="form-group">
                                    <label class="form-label">Status Anggota <span class="text-danger">*</span></label>
                                    <select class="form-control" name="user_status" id="user_status">
                                        <option value="">- Pilih Status -</option>
                                        <option value="{{ old('user_status') }}" selected="selected"></option>
                                        <option value="1" selected="selected">- Aktif -</option>
                                        <option value="0">- Tidak Aktif -</option>
                                    </select>
                                </div>
                            </div>
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
                                        <input type="text" class="form-control" name="user_password" id="user_password"
                                            placeholder="Masukan password baru" value="{{ old('user_password') }}">
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
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Group <span class="text-danger">*</span> </label>
                                    <select class="form-control" name="group_id" id="group_id">
                                        <option value="">- Pilih Group -</option>
                                        <option value="{{ old('group_id') }}" selected="selected"></option>
                                        @if(sizeof($groups) > 0)
                                        @foreach($groups as $group)
                                        <option value="{{ $group->group_id }}">{{ $group->group_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
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
                console.log(data);

                if (data.status == 1) {

                    $('#user_username').val(data.result.user_username);
                    $('#user_name').val(data.result.user_name);
                    $('#user_email').val(data.result.user_email);
                    $('#user_kta').val(data.result.user_kta);

                    $('#user_password_old').val(data.result.user_password);
                    $('#group_id').val(data.result.group_id);
                    $('#user_status').val(data.result.user_status);
                    $('#user_active_date').val(data.result.user_active_date);

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
            user_name: "required",
            user_email: "required",
            user_password: "required",
            group_id: "required",
        },
        messages: {
            user_name: "Nama user tidak boleh kosong",
            user_email: "Email user tidak boleh kosong",
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
                            console.log(data);
                            if (data.status == 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Update berhasil!',
                                    text: 'Status berhasil diupdate!',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                                location.reload();
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
                            location.reload();
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

</script>
@endsection
