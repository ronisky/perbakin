@extends('layouts.app')
@section('title', 'Data FAQ')

@section('content')
<!-- Start Page Content -->
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
                        <h3 class="h3">Data FAQ</h3>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb" class="float-right">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i data-feather="home" width="16" height="16" class="me-2">
                                        </i></a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#">FAQ</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="addData">
                    <a href="javascript:void(0)" class="btn btn-success btnAdd">
                        <i data-feather="plus" width="16" height="16" class="me-2"></i>
                        Tambah FAQ
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped card-table table-hover text-nowrap table-data">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Pertanyaan</th>
                                <th>Jawaban</th>
                                <th>Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (sizeof($faqs) == 0)
                            <tr>
                                <td colspan="8" align="center">Data kosong</td>
                            </tr>
                            @else
                            @foreach ($faqs as $faq)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $faq->faq_name }}</td>
                                <td>{{ $faq->faq_question }}</td>
                                <td>{{ $faq->faq_description }}</td>
                                <td>
                                    <form id="formStatus">
                                        @csrf
                                        @php
                                        $status = $faq->faq_status;
                                        $checked = '';
                                        if($status == 1)
                                        $checked = 'checked';
                                        @endphp
                                        <label class="switch" for="checkboxindex{{$loop->iteration}}">
                                            <input class="checkstatus" id="checkboxindex{{$loop->iteration}}"
                                                type="checkbox" value="{{$faq->faq_status}}" name="class_status"
                                                data-id="{{$faq->faq_id}}" {{$checked}}>
                                            <div class="slider round"></div>
                                        </label>

                                    </form>
                                </td>
                                <td>
                                    @if($faq->faq_id > 0)
                                    <a href="javascript:void(0)" class="btn btn-icon btnDetail btn-outline-info"
                                        data-id="{{ $faq->faq_id }}" data-toggle="tooltip" data-placement="top"
                                        title="Detail">
                                        <i data-feather="eye" width="16" height="16"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btnEdit btn-outline-warning"
                                        data-id="{{ $faq->faq_id }}" data-toggle="tooltip" data-placement="top"
                                        title="Ubah">
                                        <i data-feather="edit" width="16" height="16"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger btnDelete"
                                        data-url="{{ url('faq/delete/'. $faq->faq_id) }}" data-toggle="tooltip"
                                        data-placement="top" title="Hapus">
                                        <i data-feather="trash-2" width="16" height="16"></i>
                                    </a>
                                    @endif
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
<!-- End Page Content -->

<!-- Modal Add -->
<div class="modal fade addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah FAQ</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('faq/store') }}" method="POST" id="addForm">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Pertanyaan<span class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control" name="faq_question" id="faq_question"
                                        rows="4"
                                        placeholder="Masukan deskripsi kategori artikel">{{ old('faq_question') }}</textarea>
                                    @if ($errors->has('faq_question'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pertanyaan
                                            tidak
                                            boleh sama</label>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Jawaban<span class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control" name="faq_description" rows="4"
                                        id="faq_description"
                                        placeholder="Masukan deskripsi kategori artikel">{{ old('faq_description') }}</textarea>
                                </div>
                                <div class="form-group option-field">
                                    <label class="form-label">Status FAQ <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control" name="faq_status" id="faq_status">
                                        <option value="">- Status FAQ -</option>
                                        <option value="{{ old('faq_status') }}" selected="selected"></option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
                <h5 class="modal-title">Detail FAQ</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="faqDetail" name="faqDetail">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 mb-3 row">
                                    <label for="faq_name" class="col-md-5 col-form-label">Nama</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control-plaintext faq_name"
                                            value="{{ old('faq_name') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 row">
                                    <label for="faq_email" class="col-md-5 col-form-label">Email</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control-plaintext faq_email"
                                            value="{{ old('faq_email') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 row">
                                    <label for="faq_phone" class="col-md-5 col-form-label">Telepon</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control-plaintext faq_phone"
                                            value="{{ old('faq_phone') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 row">
                                    <label for="faq_nik" class="col-md-5 col-form-label">NIK</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control-plaintext faq_nik"
                                            value="{{ old('faq_nik') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 row">
                                    <label for="faq_question" class="col-md-5 col-form-label">Pertanyaan</label>
                                    <div class="col-md-6">
                                        <textarea type="text" readonly rows="3"
                                            class="form-control-plaintext faq_question">{{ old('faq_question') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 row">
                                    <label for="faq_description" class="col-md-5 col-form-label">Deskripsi
                                        Jawaban</label>
                                    <div class="col-md-6">
                                        <textarea type="text" readonly rows="3"
                                            class="form-control-plaintext faq_description">{{ old('faq_description') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 row">
                                    <label for="faq_status" class="col-md-5 col-form-label">FAQ Status</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly class="form-control-plaintext faq_status"
                                            value="{{ old('faq_status') }}">
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
    $('.btnAdd').click(function () {
        document.getElementById("addForm").reset();
        $('.option-field').hide();
        $('.addModal form').attr('action', "{{ url('faq/store') }}");
        $('.addModal .modal-title').text('Tambah FAQ');
        $('.addModal').modal('show');
    });

    // check error
    @if(count($errors))
    $('.addModal').modal('show');
    @endif

    $('.btnEdit').click(function () {

        var id = $(this).attr('data-id');
        var url = "{{ url('faq/getdata') }}";
        $('.option-field').show();
        $('.addModal form').attr('action', "{{ url('faq/update') }}" + '/' + id);

        $.ajax({
            type: 'GET',
            url: url + '/' + id,
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 1) {
                    $('#faq_question').val(data.result.faq_question);
                    $('#faq_description').val(data.result
                        .faq_description);
                    $('#faq_status').val(data.result.faq_status);
                    $('.addModal .modal-title').text('Ubah FAQ');
                    $('.addModal').modal('show');
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert('Error : Gagal mengambil data');
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
    $('.btnDetail').click(function () {
        let id = $(this).attr('data-id');
        let url = "{{ url('faq/show') }}";

        $('.detailModal .modal-title').text('Detail Data FAQ');
        $('.detailModal').modal('show');

        $.ajax({
            type: 'GET',
            url: url + '/' + id,
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 1) {

                    $('.faq_name').val(': ' + data.result.faq_name);
                    $('.faq_email').val(': ' + data.result.faq_email);
                    $('.faq_phone').val(': ' + data.result.faq_phone);
                    $('.faq_nik').val(': ' + data.result.faq_nik);
                    $('.faq_question').val(': ' + data.result.faq_question);
                    $('.faq_description').val(': ' + data.result.faq_description);
                    if (data.result.faq_status == 1) {
                        $('.faq_status').val(': ' + 'Aktif');
                    } else {
                        $('.faq_status').val(': ' + 'Tidak Aktif');
                    }
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
    $("#addForm").validate({
        rules: {
            faq_question: "required",
            faq_description: "required",
        },
        messages: {
            faq_question: "Pertanyaan tidak boleh kosong",
            faq_description: "Deskripsi jawaban tidak boleh kosong"
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
        let url = "{{ url('faq/updatestatus') }}" + '/' + id;
        let value = this.checked ? 1 : 0;
        if (value == 1) {
            Swal.fire({
                title: 'Aktifkan?',
                text: "Apakah anda yakin ingin mengaktifkan status?",
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
                            faq_status: value,
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
                title: 'Nonaktifkan?',
                text: "Apakah anda yakin ingin menonaktifkan status?",
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
                            faq_status: value,
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

</script>
@endsection
