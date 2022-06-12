@extends('layouts.app')
@section('title', 'Data Sponsorship')

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
                        <h3 class="h3">Data Sponsorship</h3>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb" class="float-right">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/dashboard">
                                        <i data-feather="home" width="16" height="16" class="me-2">
                                        </i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Data Sponsorship</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="addData">
                    <a href="javascript:void(0)" class="btn btn-success btnAdd">
                        <i data-feather="plus" width="16" height="16" class="me-2"></i>
                        Tambah Sponsorship
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped card-table table-hover text-nowrap table-data">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Type Sponsorship</th>
                                <th>Nama</th>
                                <th>type data</th>
                                <th>data</th>
                                <th width="10%">status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (sizeof($sponsorships) == 0)
                            <tr>
                                <td colspan="7" align="center">Data kosong</td>
                            </tr>
                            @else
                            @foreach ($sponsorships as $sponsorship)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sponsorship->sponsorship_category_name }}</td>
                                <td>{{ $sponsorship->sponsorship_name }}</td>
                                <td>{{ $sponsorship->sponsorship_type }}</td>
                                <td>
                                    @php
                                    $fileName = substr($sponsorship->sponsorship_resource_path, 0, 20);
                                    $extension = pathinfo($sponsorship->sponsorship_resource_path, PATHINFO_EXTENSION);
                                    $name = $fileName . '...' . $extension;
                                    @endphp
                                    @if (empty($extension))
                                    <a href="{{$sponsorship->sponsorship_resource_path}}"
                                        target="_blank">{{ $fileName }}</a>
                                    @else
                                    <a href="{{asset('storage/uploads/images')}}/{{$sponsorship->sponsorship_resource_path}}"
                                        target="_blank"><img width="50px"
                                            src="{{asset('storage/uploads/images')}}/{{$sponsorship->sponsorship_resource_path}}"
                                            alt="{{$sponsorship->sponsorship_resource_path}}"
                                            title="{{ $fileName }}"></a>
                                    @endif
                                </td>
                                <td>
                                    <form id="formStatus">
                                        @csrf
                                        @php
                                        $status = $sponsorship->sponsorship_status;
                                        $checked = '';
                                        if($status == 1)
                                        $checked = 'checked';
                                        @endphp
                                        <label class="switch" for="checkboxindex{{$loop->iteration}}">
                                            <input class="checkstatus" id="checkboxindex{{$loop->iteration}}"
                                                type="checkbox" value="{{$sponsorship->sponsorship_status}}"
                                                name="class_status" data-id="{{$sponsorship->sponsorship_id}}"
                                                {{$checked}}>
                                            <div class="slider round"></div>
                                        </label>

                                    </form>
                                </td>
                                <td>
                                    @if($sponsorship->sponsorship_id > 0)
                                    <a href="javascript:void(0)" class="btn btn-icon btnDetail btn-outline-info"
                                        data-id="{{ $sponsorship->sponsorship_id  }}" data-toggle="tooltip"
                                        data-placement="top" title="Detail">
                                        <i data-feather="eye" width="16" height="16"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btnEdit btn-outline-warning"
                                        data-id="{{ $sponsorship->sponsorship_id }}" data-toggle="tooltip"
                                        data-placement="top" title="Ubah">
                                        <i data-feather="edit" width="16" height="16"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger btnDelete"
                                        data-url="{{ url('sponsorship/delete/'. $sponsorship->sponsorship_id) }}"
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Sponsorship</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('sponsorship/store') }}" method="POST" id="addForm" enctype="multipart/form-data"
                data-parsley-validate>
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="sponsorship_category_id">Kategori Sponsorship<span
                                            class="text-danger">*</span>
                                    </label>
                                    <select class="form-control" name="sponsorship_category_id"
                                        id="sponsorship_category_id">
                                        <option value="" selected="selected">- Pilih Kategori -</option>
                                        @if(sizeof($sponsorship_categories) > 0)
                                        @foreach($sponsorship_categories as $sponsorship_category)
                                        <option value="{{ $sponsorship_category->sponsorship_category_id }}">
                                            {{ $sponsorship_category->sponsorship_category_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('college_npm'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Kategori
                                            tidak boleh sama</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Type Data <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control" name="sponsorship_type" id="sponsorship_type">
                                        <option value="" selected="selected">- Pilih Type Data -</option>
                                        <option value="photo">Photo</option>
                                        <option value="video">Video</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nama Sponsorship<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="sponsorship_name"
                                        id="sponsorship_name" placeholder="Masukan nama sponsorship"
                                        value="{{ old('sponsorship_name') }}">
                                    @if ($errors->has('sponsorship_name'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Nama tidak
                                            boleh sama</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Dari Tanggal<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="sponsorship_start_date"
                                        id="sponsorship_start_date" placeholder="Masukan nama sponsorship"
                                        value="{{ old('sponsorship_start_date') }}">
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Deskripsi Sponsorship<span
                                            class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control" name="sponsorship_description"
                                        id="sponsorship_description" rows="4" maxlength="100"
                                        placeholder="Masukan deskripsi singkat">{{ old('sponsorship_description') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3" id="sponsorship_status_chose">
                                <div class="form-group">
                                    <label class="form-label">Status Sponsorship <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control" name="sponsorship_status" id="sponsorship_status">
                                        <option value="">- Status Sponsorship -</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group change-image-chose">
                                    <input type="hidden" class="data-resource-file">
                                    <div id="resource-image"></div>
                                    </label>
                                    <select class="form-control" id="change-image-chose">
                                        <option value="">- Ubah Data -</option>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                                <div class="form-group change-image">
                                    <label class="form-label">Pilih Gambar - (max 5MB)<span
                                            class="text-danger">*</span></label>
                                    <input type="file" class="form-control sponsorship_resource_path"
                                        name="sponsorship_resource_path" id="sponsorship_resource_path"
                                        value="{{ old('sponsorship_resource_path') }}"
                                        data-parsley-pattern="/(\.jpg|\.jpeg|\.png|\.bmp|\.gif)$/i"
                                        data-parsley-error-message="Pilih gambar dengan ekstensi jpg/jpeg/png/bmp/gif"
                                        required>
                                </div>
                                <div class="form-group change-video">
                                    <label class="form-label">Masukan URL Video<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control sponsorship_resource_path"
                                        name="sponsorship_resource_path" id="sponsorship_resource_path"
                                        placeholder="https://www.youtube.com/embed/23o3ia8p0ZY"
                                        value="{{ old('sponsorship_resource_path') }}">
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
                <h5 class="modal-title">Detail Data Sponsorship</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6 mb-3 row">
                                <label for="sponsorship_name" class="col-md-5 col-form-label">Nama</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext sponsorship_name"
                                        value="{{ old('sponsorship_name') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 row">
                                <label for="sponsorship_category_name" class="col-md-5 col-form-label">Kategori
                                    Sponsorship</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext sponsorship_category_name"
                                        value="{{ old('sponsorship_category_name') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 row">
                                <label for="sponsorship_start_date" class="col-md-5 col-form-label">Mulai
                                    Tanggal</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext sponsorship_start_date"
                                        value="{{ old('sponsorship_start_date') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 row">
                                <label for="sponsorship_type" class="col-md-5 col-form-label">Tipe Data</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext sponsorship_type"
                                        value="{{ old('sponsorship_type') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 row">
                                <label for="sponsorship_end_date" class="col-md-5 col-form-label">Sampai Tanggal</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext sponsorship_end_date"
                                        value="{{ old('sponsorship_end_date') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 row">
                                <label for="sponsorship_status" class="col-md-5 col-form-label">Status</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext sponsorship_status"
                                        value="{{ old('sponsorship_status') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 row">
                                <label for="sponsorship_description" class="col-md-5 col-form-label">Deskripsi
                                    Jawaban</label>
                                <div class="col-md-6">
                                    <textarea type="text" readonly rows="3"
                                        class="form-control-plaintext sponsorship_description">{{ old('sponsorship_description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
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
    var arry = [
        [1, "Convention Hall", 10],
        [2, "Auditorium", 11],
        [3, "CenterHall", 10],
    ];
    var x = arry.sort(function (a, b) {
        return a[0] < b[0] ? 1 : -1;
    });

    console.log(x);
    var hasil = x.sort(function (c, d) {
        return c[2] > d[2] ? 1 : -1;
    })
    console.log(hasil);

    $('.change-image').hide();
    $('.change-video').hide();

    var support = (function () {
        if (!window.DOMParser) return false;
        var parser = new DOMParser();
        try {
            parser.parseFromString('x', 'text/html');
        } catch (err) {
            return false;
        }
        return true;
    })();

    var textToHTML = function (str) {

        // check for DOMParser support
        if (support) {
            var parser = new DOMParser();
            var doc = parser.parseFromString(str, 'text/html');
            return doc.body.innerHTML;
        }

        // Otherwise, create div and append HTML
        var dom = document.createElement('div');
        dom.innerHTML = str;
        return dom;

    };

    $('#change-image-chose').change(function () {
        let data = $('#change-image-chose').val();
        let typeData = $('.data-resource-file').val();

        // get first initial data
        let isYoutube = typeData.split(":")[0]
        if (data == 1) {
            if (isYoutube == 'https') {

                $('.change-image').hide();
                $('.change-video').show();
            } else {

                $('.change-image').show();
                $('.change-video').hide();
            }
        } else {

            $('.change-image').hide();
            $('.change-video').hide();
        }
    });

    $('#sponsorship_type').change(function () {
        let data = $('#sponsorship_type').val();
        if (data == "photo") {
            $('.change-image').show();
            $('.change-video').hide();
        } else {
            $('.change-video').show();
            $('.change-image').hide();
            $('#sponsorship_resource_path').prop('required', false);
        }
    });

    $('.btnAdd').click(function () {
        document.getElementById("addForm").reset();
        let data_images = "";
        data_images = ``
        document.getElementById("sponsorship_resource_path").innerHTML = textToHTML(data_images);
        $('#sponsorship_status_chose').hide();
        $('#change-image-chose').hide();
        $('.change-image').show();
        $('#resource-image').hide();
        // $('#sponsorship_resource_path').prop('required', true);
        $('.addModal form').attr('action', "{{ url('sponsorship/store') }}");
        $('.addModal .modal-title').text('Tambah Sponsor');
        $('.addModal').modal('show');
    });

    // check error
    @if(count($errors))
    $('.addModal').modal('show');
    @endif

    $('.btnEdit').click(function () {

        var id = $(this).attr('data-id');
        var url = "{{ url('sponsorship/getdata') }}";


        $('.change-image').hide();
        $('.change-video').hide();
        $('.change-image-chose').hide();
        $('#resource-image').hide();
        $('#sponsorship_resource_path').prop('required', false);
        $('.addModal form').attr('action', "{{ url('sponsorship/update') }}" + '/' + id);

        $('#sponsorship_status_chose').show();
        $('.addModal .modal-title').text('Ubah Sponsorship');
        $('.addModal').modal('show');
        $.ajax({
            type: 'GET',
            url: url + '/' + id,
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 1) {
                    $('#sponsorship_category_id').val(data.result.sponsorship_category_id);
                    $('#sponsorship_type').val(data.result.sponsorship_type);
                    $('#sponsorship_start_date').val(data.result.sponsorship_start_date);
                    $('#sponsorship_name').val(data.result.sponsorship_name);
                    $('#sponsorship_description').val(data.result.sponsorship_description);
                    $('#sponsorship_status').val(data.result.sponsorship_status);

                    let sponsorship_resource_path = data.result.sponsorship_resource_path;
                    const path = sponsorship_resource_path;
                    const [extension, ...nameParts] = path.split('.').reverse();
                    const dataName = sponsorship_resource_path.substr(0, 20) + '.' + extension;

                    // get first initial data
                    let isYoutube = sponsorship_resource_path.split(":")[0]
                    let data_images_path = "";
                    if (isYoutube == 'https') {
                        $('.change-image-chose').show();
                        $('#resource-image').show();
                        $('.data-resource-file').val(sponsorship_resource_path);
                        data_images_path =
                            `<a href="${sponsorship_resource_path}" target="_blank"><span>Link Video Sekarang = ${dataName}</span></a>`;
                        document.getElementById("resource-image").innerHTML = textToHTML(
                            data_images_path);
                    } else {
                        $('#resource-image').show();
                        $('.change-image-chose').show();
                        $('.data-resource-file').val(sponsorship_resource_path);
                        data_images_path =
                            `<a href="{{asset('storage/uploads/images')}}/${sponsorship_resource_path}" target="_blank"><span>Gambar sekarang = ${dataName}</span></a>`;
                        document.getElementById("resource-image").innerHTML = textToHTML(
                            data_images_path);
                    }
                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert('Error : Gagal mengambil data');
            }
        });

    });

    $('.btnDetail').click(function () {
        let id = $(this).attr('data-id');
        let url = "{{ url('sponsorship/show') }}";

        $.ajax({
            type: 'GET',
            url: url + '/' + id,
            dataType: 'JSON',
            success: function (data) {
                console.log(data);
                if (data.status == 1) {

                    $('.detailModal .modal-title').text('Detail Data Sponsorship');
                    $('.detailModal').modal('show');

                    $('.sponsorship_category_name').val(': ' + data.result
                        .sponsorship_category_name);
                    $('.sponsorship_type').val(': ' + data.result.sponsorship_type);
                    $('.sponsorship_start_date').val(': ' + data.result.sponsorship_start_date);
                    $('.sponsorship_end_date').val(': ' + data.result.sponsorship_end_date);
                    $('.sponsorship_name').val(': ' + data.result.sponsorship_name);
                    $('.sponsorship_description').val(': ' + data.result.sponsorship_description);
                    if (data.result.sponsorship_status == 1) {
                        $('.sponsorship_status').val(': ' + 'Aktif');
                    } else {
                        $('.sponsorship_status').val(': ' + 'Tidak Aktif');
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
            sponsorship_category_id: "required",
            sponsorship_type: "required",
            sponsorship_name: "required",
            sponsorship_start_date: "required",
            sponsorship_description: "required",
        },
        messages: {
            sponsorship_category_id: "Kategori sponsorship harus dipilih",
            sponsorship_type: "Type file sponsorship harus dipilih",
            sponsorship_name: "Nama sponsorship tidak boleh kosong",
            sponsorship_start_date: "Tanggal mulai harus dipilih",
            sponsorship_description: "Deskripsi singkat sponsor tidak boleh kosong",
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
        let url = "{{ url('sponsorship/updatestatus') }}" + '/' + id;
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
                            sponsorship_status: value,
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
                            sponsorship_status: value,
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
