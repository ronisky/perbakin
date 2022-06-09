@extends('layouts.app')
@section('title', 'Data Klub')

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
                        <h3 class="h3">Data Klub</h3>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb" class="float-right">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/dashboard">
                                        <i data-feather="home" width="16" height="16" class="me-2">
                                        </i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Data Klub</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="addData">
                    <a href="javascript:void(0)" class="btn btn-success btnAdd">
                        <i data-feather="plus" width="16" height="16" class="me-2"></i>
                        Tambah Klub
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped card-table table-hover text-nowrap table-data">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Klub</th>
                                <th>Telepon</th>
                                <th>Deskripsi</th>
                                <th>Logo</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (sizeof($clubs) == 0)
                            <tr>
                                <td colspan="6" align="center">Data kosong</td>
                            </tr>
                            @else
                            @foreach ($clubs as $club)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $club->club_name }}</td>
                                <td>{{ $club->club_phone }}</td>
                                <td title="{{ $club->club_description }}">
                                    @php
                                    $dataDes = substr($club->club_description, 0, 30);
                                    $des = $dataDes . "...";
                                    @endphp
                                    {{ $des }}
                                </td>
                                <td title="{{ $club->club_logo_path }}">
                                    @php
                                    $fileName = substr($club->club_logo_path, 0, 20);
                                    $extension = pathinfo($club->club_logo_path, PATHINFO_EXTENSION);
                                    $name = $fileName . '...' . $extension;
                                    @endphp
                                    <a href="{{asset('storage/uploads/images')}}/{{$club->club_logo_path}}"
                                        target="blank"><img width="50px"
                                            src="{{asset('storage/uploads/images')}}/{{$club->club_logo_path}}"
                                            alt="{{$club->club_logo_path}}"></a>
                                </td>
                                <td>
                                    @if($club->club_id > 0)
                                    <a href="javascript:void(0)" class="btn btn-icon btnEdit btn-outline-warning"
                                        data-id="{{ $club->club_id }}" data-toggle="tooltip" data-placement="top"
                                        title="Ubah">
                                        <i data-feather="edit" width="16" height="16"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger btnDelete"
                                        data-url="{{ url('club/delete/'. $club->club_id) }}" data-toggle="tooltip"
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Club</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('club/store') }}" method="POST" id="addForm" enctype="multipart/form-data"
                data-parsley-validate>
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nama Club<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="club_name" id="club_name"
                                        placeholder="Masukan nama klub" value="{{ old('club_name') }}">
                                    @if ($errors->has('club_name'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Nama club
                                            tidak
                                            boleh sama</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nomor Telepon<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="club_phone" id="club_phone"
                                        placeholder="Masukan telepon klub (0823..)" value="{{ old('club_phone') }}"
                                        maxlength="15">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Alamat Email<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="club_email" id="club_email"
                                        placeholder="Masukan alamat email klub" value="{{ old('club_email') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nomor Website</label>
                                    <input type="text" class="form-control" name="club_website" id="club_website"
                                        placeholder="Masukan link website klub" value="{{ old('club_website') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nomor Whatsapp</label>
                                    <input type="number" class="form-control" name="club_whatsapp" id="club_whatsapp"
                                        placeholder="Masukan nomor whatsapp klub (0823..)"
                                        value="{{ old('club_whatsapp') }}" maxlength="15">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Instagram</label>
                                    <input type="text" class="form-control" name="club_instagram" id="club_instagram"
                                        placeholder="Masukan link instagram klub" value="{{ old('club_instagram') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Facebook</label>
                                    <input type="text" class="form-control" name="club_facebook" id="club_facebook"
                                        placeholder="Masukan link facebook klub" value="{{ old('club_facebook') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Twitter</label>
                                    <input type="text" class="form-control" name="club_twitter" id="club_twitter"
                                        placeholder="Masukan link twitter klub" value="{{ old('club_twitter') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Youtube</label>
                                    <input type="text" class="form-control" name="club_youtube" id="club_youtube"
                                        placeholder="Masukan link youtube channel klub"
                                        value="{{ old('club_youtube') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3" id="club-status">
                                <div class="form-group">
                                    <label class="form-label">Status Klub <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control" name="club_status" id="club_status">
                                        <option value="">- Pilih Group -</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 club-logo">
                                <div class="form-group">
                                    <div id="logo-images"></div>
                                    </label>
                                    <select class="form-control" id="change-logo-chose">
                                        <option value="">- Ubah Logo -</option>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                                <div class="form-group change-logo">
                                    <label class="form-label">Pilih Logo<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="club_logo_path" id="club_logo_path"
                                        value="{{ old('club_logo_path') }}"
                                        data-parsley-pattern="/(\.jpg|\.jpeg|\.png|\.bmp)$/i"
                                        data-parsley-error-message="Pilih logo dengan ekstensi jpg/jpeg/png/bmp"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Deskripsi Singakt tentang klub<span
                                            class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control" name="club_description"
                                        id="club_description" rows="4" maxlength="100"
                                        placeholder="Masukan deskripsi tentang klub">{{ old('club_description') }}</textarea>
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

    function phone() {
        $('#club_phone').keyup(function () {
            let data = $('#club_phone').val();
            $('#club_whatsapp').val(data);
        })
    }

    $('#change-logo-chose').change(function () {
        let data = $('#change-logo-chose').val();
        if (data == 1) {
            $('.change-logo').show();
        } else {
            $('.change-logo').hide();
        }
    })

    $('.btnAdd').click(function () {
        phone();
        document.getElementById("addForm").reset();
        let data_images = "";
        data_images = ``
        document.getElementById("club_logo_path").innerHTML = textToHTML(data_images);
        $('#club-status').hide();
        $('#change-logo-chose').hide();
        $('.change-logo').show();
        $('#logo-images').hide();
        $('#club_logo_path').prop('required', true);
        $('.addModal form').attr('action', "{{ url('club/store') }}");
        $('.addModal .modal-title').text('Tambah Club');
        $('.addModal').modal('show');
    });

    // check error
    @if(count($errors))
    $('.addModal').modal('show');
    @endif

    $('.btnEdit').click(function () {

        var id = $(this).attr('data-id');
        var url = "{{ url('club/getdata') }}";

        $('.change-logo').hide();
        $('#change-logo-chose').show();
        $('#logo-images').show();
        $('#club_logo_path').prop('required', false);
        $('.addModal form').attr('action', "{{ url('club/update') }}" + '/' + id);

        $.ajax({
            type: 'GET',
            url: url + '/' + id,
            dataType: 'JSON',
            success: function (data) {

                if (data.status == 1) {
                    $('#club_name').val(data.result.club_name);
                    $('#club_description').val(data.result.club_description);
                    $('#club_phone').val(data.result.club_phone);
                    $('#club_email').val(data.result.club_email);
                    $('#club_website').val(data.result.club_website);
                    $('#club_whatsapp').val(data.result.club_whatsapp);
                    $('#club_instagram').val(data.result.club_instagram);
                    $('#club_facebook').val(data.result.club_facebook);
                    $('#club_twitter').val(data.result.club_twitter);
                    $('#club_youtube').val(data.result.club_youtube);
                    $('#club_status').val(data.result.club_status);

                    let club_logo_path = data.result.club_logo_path;
                    const path = club_logo_path;
                    const [extension, ...nameParts] = path.split('.').reverse();
                    const dataName = club_logo_path.substr(0, 20) + '.' + extension;
                    let data_images_path = "";
                    data_images_path =
                        `<a href="{{asset('storage/uploads/images')}}/${club_logo_path}" target="blank" class="club_logo_path"><span>Logo sekarang = ${dataName}</span></a>`
                    document.getElementById("logo-images").innerHTML = textToHTML(
                        data_images_path);

                    $('#club-status').show();
                    $('.addModal .modal-title').text('Ubah Club');
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
            club_name: "required",
            club_phone: "required",
            club_email: "required",
            club_description: "required",
        },
        messages: {
            club_name: "Nama klub tidak boleh kosong",
            club_phone: "Telepon klub tidak boleh kosong",
            club_email: "Alamat email klub tidak boleh kosong",
            club_description: "Deskripsi klub tidak boleh kosong",
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
