@extends('layouts.app')
@section('title', 'Jenis Senjata')

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
                        <h3 class="h3">Jenis Senjata</h3>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb" class="float-right">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i data-feather="home" width="16" height="16" class="me-2">
                                        </i></a>
                                </li>
                                <li class="breadcrumb-item"><a disabled>Master</a></li>
                                <li class="breadcrumb-item active"><a href="#">Jenis Senjata</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="addData">
                    <a href="javascript:void(0)" class="btn btn-success btnAdd">
                        <i data-feather="plus" width="16" height="16" class="me-2"></i>
                        Tambah Jenis Senjata
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped card-table table-hover text-nowrap table-data">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="80%">Nama Jeni Senjata</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (sizeof($firearm_categories) == 0)
                            <tr>
                                <td colspan="3" align="center">Data kosong</td>
                            </tr>
                            @else
                            @foreach ($firearm_categories as $firearm_category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $firearm_category->firearm_category_name }}</td>
                                <td>
                                    @if($firearm_category->firearm_category_id > 0)
                                    <a href="javascript:void(0)" class="btn btn-icon btnEdit btn-outline-warning"
                                        data-id="{{ $firearm_category->firearm_category_id }}" data-toggle="tooltip"
                                        data-placement="top" title="Ubah">
                                        <i data-feather="edit" width="16" height="16"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger btnDelete"
                                        data-url="{{ url('firearmcategory/delete/'. $firearm_category->firearm_category_id) }}"
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
<!-- End Page Content -->

<!-- Modal Add -->
<div class="modal fade addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jenis Senjata</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('firearmcategory/store') }}" method="POST" id="addForm">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Nama Jenis Senjata<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="firearm_category_name"
                                        id="firearm_category_name" placeholder="Masukan nama module"
                                        value="{{ old('firearm_category_name') }}">
                                    @if ($errors->has('firearm_category_name'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Nama jenis
                                            senjata tidak boleh sama</label>
                                    </span>
                                    @endif
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
        document.getElementById("addForm").reset();
        $('.addModal form').attr('action', "{{ url('firearmcategory/store') }}");
        $('.addModal .modal-title').text('Tambah Task');
        $('.addModal').modal('show');
    });

    // check error
    @if(count($errors))
    $('.addModal').modal('show');
    @endif

    $('.btnEdit').click(function () {

        var id = $(this).attr('data-id');
        var url = "{{ url('firearmcategory/getdata') }}";

        $('.addModal form').attr('action', "{{ url('firearmcategory/update') }}" + '/' + id);

        $.ajax({
            type: 'GET',
            url: url + '/' + id,
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 1) {
                    $('#firearm_category_name').val(data.result.firearm_category_name);
                    $('.addModal .modal-title').text('Ubah Jenis Senjata');
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
            firearm_category_name: "required",
        },
        messages: {
            firearm_category_name: "Nama jenis senjata tidak boleh kosong",
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
