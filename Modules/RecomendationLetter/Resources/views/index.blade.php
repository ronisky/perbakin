@extends('layouts.app')
@section('title', 'Surat Rekomendasi')

@section('nav')
<div class="row align-items-center">
    <!-- Page title actions -->
    <div class="col-auto ms-auto d-print-none">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('') }}"><i data-feather="home"
                            class="breadcrumb-item-icon"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Hak Akses</a></li>
                <li class="breadcrumb-item active" aria-current="page">Menu</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
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
                        <h3 class="h3">Surat Rekomendasi</h3>
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
                                <li class="breadcrumb-item active"><a href="#">Menu</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="addData">
                    <a href="javascript:void(0)" class="btn btn-success btnAdd">
                        <i data-feather="plus" width="16" height="16" class="me-2"></i>
                        Tambah Menu
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped card-table table-hover text-nowrap table-data">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">Nama Pengaju</th>
                                <th width="15%">Klub asal</th>
                                <th width="20%">Tanggal pengajuan</th>
                                <th width="10%">Status Pengajuan</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (sizeof($letters) == 0)
                            <tr>
                                <td colspan="6" align="center">Data kosong</td>
                            </tr>
                            @else
                            @foreach ($letters as $letter)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $letter->name }}</td>
                                <td>{{ $letter->club }}</td>
                                <td>{{ $letter->created_at }}</td>
                                <td>{{ $letter->letter_status }}</td>
                                <td>
                                    @if($letter->letter_id > 0)
                                    <a href="javascript:void(0)" class="btn btn-icon btnEdit btn-outline-warning"
                                        data-id="{{ $letter->letter_id }}" data-toggle="tooltip" data-placement="top"
                                        title="Ubah">
                                        <i data-feather="edit" width="16" height="16"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger btnDelete"
                                        data-url="{{ url('recomendationletter/delete/'. $letter->letter_id) }}"
                                        data-toggle="tooltip" data-placement="top" title="Hapus">
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

<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
<!-- </div> -->
<!-- ============================================================== -->
<!-- End Container fluid  -->

<!-- Modal Add -->
<div class="modal addModal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Menu</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('sysmenu/store') }}" method="POST" id="addForm">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="menu_name" id="menu_name"
                                        placeholder="Masukan nama menu">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Modul </label>
                                    <select class="form-control" name="module_id" id="module_id">
                                        <option value="">- Pilih Modul -</option>
                                        {{-- @if(sizeof($modules) > 0)
                                        @foreach($modules as $module)
                                        <option value="{{ $module->module_id }}">{{ $module->module_name }}</option>
                                        @endforeach
                                        @endif --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">URL <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="menu_url" id="menu_url"
                                        placeholder="Masukan alamat URL">
                                    <small>Untuk menu parent diisi: javascript:void(0)</small>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Sub menu ? <span class="text-danger">*</span></label>
                                    <select name="menu_is_sub" id="menu_is_sub" class="form-control">
                                        <option value="0">Bukan</option>
                                        <option value="1">Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Ikon</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="menu_icon" id="menu_icon"
                                            placeholder="Masukan kode ikon">
                                        <div class="input-group-append">
                                            <a href="https://feathericons.com/" class="btn btn-outline-info"
                                                target="blank">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Menu Parent</label>
                                    <select class="form-control" name="menu_parent_id" id="menu_parent_id"
                                        disabled="disabled">
                                        <option value="">- Pilih Menu -</option>
                                        {{-- @if(sizeof($parents) > 0)
                                        @foreach($parents as $parent)
                                        <option value="{{ $parent->menu_id }}">{{ $parent->menu_name }}</option>
                                        @endforeach
                                        @endif --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Posisi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="menu_position" id="menu_position"
                                        placeholder="Masukan posisi">
                                    <small>Semakin kecil, semakin atas (0)</small>
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
@endsection

@section('script')
<script type="text/javascript">
    $('.btnAdd').click(function () {
        $('#module_id').val('');
        $('#task_name').val('');
        $('.addModal form').attr('action', "{{ url('lettercategory/store') }}");
        $('.addModal .modal-title').text('Tambah Task');
        $('.addModal').modal('show');
    });

    // check error
    @if(count($errors))
    $('.addModal').modal('show');
    @endif

    $('.btnEdit').click(function () {

        var id = $(this).attr('data-id');
        var url = "{{ url('lettercategory/getdata') }}";

        $('.addModal form').attr('action', "{{ url('lettercategory/update') }}" + '/' + id);

        $.ajax({
            type: 'GET',
            url: url + '/' + id,
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 1) {

                    $('#letter_category_name').val(data.result.letter_category_name);
                    $('.addModal .modal-title').text('Ubah Surat Rekomendasi');
                    $('.addModal').modal('show');

                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert('Error : Gagal mengambil data');
            }
        });

    });

    $("#addForm").validate({
        rules: {
            letter_category_name: "required",
        },
        messages: {
            letter_category_name: "Nama surat rekomendasi tidak boleh kosong",
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
