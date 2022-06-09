@extends('layouts.app')
@section('title', 'Kategori Sponsorship')

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
                        <h3 class="h3">Kategori Sponsorship</h3>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb" class="float-right">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/dashboard">
                                        <i data-feather="home" width="16" height="16" class="me-2">
                                        </i></a>
                                </li>
                                <li class="breadcrumb-item"><a disabled>Sponsorship</a></li>
                                <li class="breadcrumb-item active"><a href="#">Kategori Sponsorship</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="addData">
                    <a href="javascript:void(0)" class="btn btn-success btnAdd">
                        <i data-feather="plus" width="16" height="16" class="me-2"></i>
                        Tambah Kategori Sponsorship
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped card-table table-hover text-nowrap table-data">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Kategori Sponsorship</th>
                                <th>Sponsor tampil (hari)</th>
                                <th>Deskripsi</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (sizeof($sponsorship_categories) == 0)
                            <tr>
                                <td colspan="3" align="center">Data kosong</td>
                            </tr>
                            @else
                            @foreach ($sponsorship_categories as $sponsorship_category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sponsorship_category->sponsorship_category_name }}</td>
                                <td>{{ $sponsorship_category->day_show }}</td>
                                <td>{{ $sponsorship_category->sponsorship_category_description }}</td>
                                <td>
                                    @if($sponsorship_category->sponsorship_category_id > 0)
                                    <a href="javascript:void(0)" class="btn btn-icon btnEdit btn-outline-warning"
                                        data-id="{{ $sponsorship_category->sponsorship_category_id }}"
                                        data-toggle="tooltip" data-placement="top" title="Ubah">
                                        <i data-feather="edit" width="16" height="16"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger btnDelete"
                                        data-url="{{ url('sponsorshipcategory/delete/'. $sponsorship_category->sponsorship_category_id) }}"
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
                <h5 class="modal-title">Tambah Kategori Sponsorship</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('sponsorshipcategory/store') }}" method="POST" id="addForm">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Nama Kategori Sponsorship<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="sponsorship_category_name"
                                        id="sponsorship_category_name" placeholder="Masukan kategori sponsorship"
                                        value="{{ old('sponsorship_category_name') }}">
                                    @if ($errors->has('sponsorship_category_name'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Nama kategori
                                            sponsor
                                            tidak
                                            boleh sama</label>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Waktu Tampil Sponsorship<span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="day_show" id="day_show"
                                        placeholder="Masukan jumlah hari tampil" value="{{ old('day_show') }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Deskripsi Kategori<span
                                            class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control" name="sponsorship_category_description"
                                        id="sponsorship_category_description" rows="4"
                                        placeholder="Masukan deskripsi">{{ old('sponsorship_category_description') }}</textarea>
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
        $('.addModal form').attr('action', "{{ url('sponsorshipcategory/store') }}");
        $('.addModal .modal-title').text('Tambah Kategori Sponsorship');
        $('.addModal').modal('show');
    });

    // check error
    @if(count($errors))
    $('.addModal').modal('show');
    @endif

    $('.btnEdit').click(function () {

        var id = $(this).attr('data-id');
        var url = "{{ url('sponsorshipcategory/getdata') }}";

        $('.addModal form').attr('action', "{{ url('sponsorshipcategory/update') }}" + '/' + id);

        $.ajax({
            type: 'GET',
            url: url + '/' + id,
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 1) {
                    $('#sponsorship_category_name').val(data.result.sponsorship_category_name);
                    $('#day_show').val(data.result.day_show);
                    $('#sponsorship_category_description').val(data.result
                        .sponsorship_category_description);
                    $('.addModal .modal-title').text('Ubah Kategori Sponsorship');
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

    $("#addForm").validate({
        rules: {
            sponsorship_category_name: "required",
            day_show: "required",
        },
        messages: {
            sponsorship_category_name: "Nama kategori sponsorship tidak boleh kosong",
            day_show: "Lama kategori tidak boleh kosong",
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
