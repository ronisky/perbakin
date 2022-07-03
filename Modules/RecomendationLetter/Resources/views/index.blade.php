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
                                    <a href="/dashboard">
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
                <div class="addData mb-3">
                    <a href="javascript:void(0)" class="btn btn-success btnAdd">
                        <i data-feather="plus" width="16" height="16" class="me-2"></i>
                        Tambah Pengajuan Surat Rekomendasi
                    </a>
                    <a data-toggle="modal" href="#myModal" class="btn btn-primary">Launch modal</a>
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
                                <td>
                                    @php
                                    $status = $letter->letter_status;

                                    if($status == 1){
                                    $letter_status = 'Diajukan';
                                    $class = 'badge badge-primary';
                                    }elseif($status == 2){
                                    $letter_status = 'Diproses';
                                    $class = 'badge badge-warning';
                                    }elseif($status == 3){
                                    $letter_status = 'Diterima';
                                    $class = 'badge badge-success';
                                    }else {
                                    $letter_status = 'Ditolak';
                                    $class = 'badge badge-danger';
                                    }

                                    @endphp
                                    <span class="{{ $class }}">{{ $letter_status }}</span>
                                </td>
                                <td>
                                    @if($letter->letter_id > 0)
                                    @if (Auth::user()->group_id != 1 || Auth::user()->group_id != 2)
                                    <a href="{{ url('recomendationletter/printletter/'. $letter->letter_id) }}"
                                        target="_blank" class="btn btn-icon btnPrint btn-outline-secondary"
                                        data-id="{{ $letter->letter_id }}" data-toggle="tooltip" data-placement="top"
                                        title="Print">
                                        <i data-feather="printer" width="16" height="16"></i>
                                    </a>
                                    {{-- <a href="javascript:void(0)" class="btn btn-icon btnDetail btn-outline-info"
                                        data-id="{{ $letter->letter_id }}" data-toggle="tooltip" data-placement="top"
                                    title="Detail">
                                    <i data-feather="eye" width="16" height="16"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btnEdit btn-outline-warning"
                                        data-id="{{ $letter->letter_id }}" data-toggle="tooltip" data-placement="top"
                                        title="Ubah">
                                        <i data-feather="edit" width="16" height="16"></i>
                                    </a> --}}
                                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger btnDelete"
                                        data-url="{{ url('recomendationletter/delete/'. $letter->letter_id) }}"
                                        data-toggle="tooltip" data-placement="top" title="Hapus">
                                        <i data-feather="trash-2" width="16" height="16"></i>
                                    </a>
                                    @else
                                    <a href="{{ url('recomendationletter/printletter/'. $letter->letter_id) }}"
                                        target="_blank" class="btn btn-icon btnPrint btn-outline-secondary"
                                        data-id="{{ $letter->letter_id }}" data-toggle="tooltip" data-placement="top"
                                        title="Print">
                                        <i data-feather="printer" width="16" height="16"></i>
                                    </a>
                                    {{-- <a href="javascript:void(0)" class="btn btn-icon btnDetail btn-outline-info"
                                        data-id="{{ $letter->letter_id }}" data-toggle="tooltip" data-placement="top"
                                    title="Detail">
                                    <i data-feather="eye" width="16" height="16"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btnEdit btn-outline-warning"
                                        data-id="{{ $letter->letter_id }}" data-toggle="tooltip" data-placement="top"
                                        title="Ubah">
                                        <i data-feather="edit" width="16" height="16"></i>
                                    </a> --}}
                                    @endif
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

<!-- Modal Add -->
<div class="modal addModal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah pengajuan surat rekomendasi</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('recomendationletter/store') }}" method="POST" id="addForm"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Jenis Surat Rekomendasi</label>
                                            <select class="form-control" name="letter_category_id"
                                                id="letter_category_id">
                                                <option value="">- Pilih Jenis Surat Rekomendasi -</option>
                                                @if(sizeof($letter_categories) > 0)
                                                @foreach($letter_categories as $key => $letter_category)
                                                <option value="{{ $letter_category->letter_category_id }}">
                                                    {{($key + 1).". " .$letter_category->letter_category_name }}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 header-letter">
                                        <div class="form-group">
                                            <label class="form-label">Tempat Surat<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control header-letter" name="letter_place"
                                                id="letter_place" placeholder="Masukan tempat surat" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 header-letter">
                                        <div class="form-group">
                                            <label class="form-label">Tanggal Surat <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control header-letter" name="letter_date"
                                                id="letter_date" placeholder="Masukan tanggal surat"
                                                value="{{ date('Y-m-d') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 sample-letter">
                                    <div class="col-md-6 center ">
                                        <div class="card" style="width: 10rem;">
                                            <a target="_blank"
                                                href="{{ url('assets/img/letters/sample_letters/sample_6.jpg') }}"
                                                class="text text-sm-center">
                                                <img class="card-img-top"
                                                    src="assets/img/letters/sample_letters/sample_6.jpg" height="auto"
                                                    alt="Card image cap">
                                                Lihat contoh surat</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-4" id="downloadletter"></div>
                            </div>

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark section-title">
                                <span class=" font-weight-bold">Bagian 1 Pemohon</span>
                            </div>
                            {{-- ================================================================================= --}}

                            {{-- letter1 b1l1--}}
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="name" id="name"
                                        value="{{ $user->user_name }}" placeholder="Masukan nama" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="place_of_birth" id="place_of_birth"
                                        value="{{ $user->place_of_birth }}" placeholder="Masukan tempat lahir" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                                        value="{{ $user->date_of_birth }}" placeholder="Masukan tanggal lahir" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Pekerjaan / Jabatan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="occupation" id="occupation"
                                        value="{{ $user->occupation }}" placeholder="Masukan pekerjaan" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Alamat<span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="address" id="address"
                                        value="{{ $user->user_address }}" placeholder="Masukan alamat" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Klub / Perkumpulan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="club" id="club"
                                        value="{{ $user->club_name }}" placeholder="Masukan klub / perkumupulan"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Nomor KTA PB-Perbakin <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_kta" id="no_kta"
                                        placeholder="Masukan nomor KTA PB-Perbakin" value="{{ $user->user_kta }}"
                                        readonly required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Keanggotaan Cabang <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="membership" id="membership"
                                        value="{{ $user->user_club_cab }}" placeholder="Masukan keanggotaan cabang"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Pindah / Mutasi dari <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="mutasi_dari" id="mutasi_dari"
                                        placeholder="Masasukan mutasi dari" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Cabang Klub Tujuan<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="l9_cabang" id="l9_cabang"
                                        placeholder="Masasukan mutasi tujuan" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Alasan Pindah/ Mutasi<span
                                            class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control" name="mutasi_alasan" id="mutasi_alasan"
                                        rows="5" placeholder="Alasan mutasi"
                                        required>{{ old('mutasi_alasan') }}agar lebih dekat dengan tempat tinggal, memudahkan dalam mengkoordinir Izin angkut Senjata dan mengikuti Program Kerja Perbakin Kab. Bandung Th.2021 -2022.</textarea>
                                </div>
                            </div>
                            {{-- end letter1 b1l1 --}}
                            {{-- letter2 b1l2--}}
                            <div class="col-md-6 mb-3 letter2">
                                <div class="form-group">
                                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="name" id="name"
                                        value="{{ $user->user_name }}" placeholder="Masukan nama">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <div class="form-group">
                                    <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="place_of_birth" id="place_of_birth"
                                        value="{{ $user->place_of_birth }}" placeholder="Masukan tempat lahir">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                                        value="{{ $user->date_of_birth }}" placeholder="Masukan tanggal lahir">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <div class="form-group">
                                    <label class="form-label">Pekerjaan / Jabatan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="occupation" id="occupation"
                                        value="{{ $user->occupation }}" placeholder="Masukan pekerjaan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <div class="form-group">
                                    <label class="form-label">Alamat<span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="address" id="address"
                                        value="{{ $user->user_address }}" placeholder="Masukan alamat">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <div class="form-group">
                                    <label class="form-label">Klub / Perkumpulan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="club" id="club"
                                        value="{{ $user->club_name }}" placeholder="Masukan klub / perkumupulan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <div class="form-group">
                                    <label class="form-label">Nomor KTA PB-Perbakin <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_kta" id="no_kta"
                                        placeholder="Masukan nomor KTA PB-Perbakin" value="{{ $user->user_kta }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <div class="form-group">
                                    <label class="form-label">Keanggotaan Cabang <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="membership" id="membership"
                                        value="{{ $user->user_club_cab }}" placeholder="Masukan keanggotaan cabang">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <div class="form-group">
                                    <label class="form-label">Alasan / untuk kepentingan<span
                                            class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control" name="mutasi_alasan" id="mutasi_alasan"
                                        rows="5" placeholder="Kepentinan ..."
                                        required>{{ old('mutasi_alasan') }}kepentingan  Olahraga Menembak Berburu.</textarea>
                                </div>
                            </div>
                            {{-- end letter2 b1l2--}}

                            {{-- letter3 b1l3 --}}
                            <div class="col-md-12 mb-3 border-bottom border-gray letter3">
                                <span class="font-weight-medium italic">Disebut Pihak I Pemberi Hibah</span>
                            </div>
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">Nama Pemberi Hibah <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="name" id="name" value=""
                                        placeholder="Masukan nama">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="place_of_birth" id="place_of_birth"
                                        value="" placeholder="Masukan tempat lahir">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                                        value="" placeholder="Masukan tanggal lahir">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">Pekerjaan / Jabatan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="occupation" id="occupation" value=""
                                        placeholder="Masukan pekerjaan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">Alamat<span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="user_address" id="user_address"
                                        value="" placeholder="Masukan alamat">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">No KTP <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_ktp" id="no_ktp" value=""
                                        placeholder="Masukan klub / perkumupulan">
                                </div>
                            </div>
                            {{-- end letter3 b1l3 --}}

                            {{-- letter4 b1l4 --}}
                            <div class="col-md-6 mb-3 letter4">
                                <div class="form-group">
                                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="name" id="name"
                                        value="{{ $user->user_name }}" placeholder="Masukan nama">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <div class="form-group">
                                    <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="place_of_birth" id="place_of_birth"
                                        value="{{ $user->place_of_birth }}" placeholder="Masukan tempat lahir">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                                        value="{{ $user->date_of_birth }}" placeholder="Masukan tanggal lahir">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <div class="form-group">
                                    <label class="form-label">Pekerjaan / Jabatan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="occupation" id="occupation"
                                        value="{{ $user->occupation }}" placeholder="Masukan pekerjaan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <div class="form-group">
                                    <label class="form-label">Alamat<span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="address" id="address"
                                        value="{{ $user->user_address }}" placeholder="Masukan alamat">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <div class="form-group">
                                    <label class="form-label">Klub / Perkumpulan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="club" id="club"
                                        value="{{ $user->club_name }}" placeholder="Masukan klub / perkumupulan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <div class="form-group">
                                    <label class="form-label">Nomor KTA PB-Perbakin <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_kta" id="no_kta"
                                        placeholder="Masukan nomor KTA PB-Perbakin" value="{{ $user->user_kta }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <div class="form-group">
                                    <label class="form-label">Keanggotaan Cabang <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="membership" id="membership"
                                        value="{{ $user->user_club_cab }}" placeholder="Masukan keanggotaan cabang">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <div class="form-group">
                                    <label class="form-label">Alasan Kepemilikan<span
                                            class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control" name="mutasi_alasan" id="mutasi_alasan"
                                        rows="5" placeholder="Alasan mutasi"
                                        required>{{ old('mutasi_alasan') }}Kepentingan  Olahraga Menembak Berburu/reaksi.</textarea>
                                </div>
                            </div>
                            {{-- end letter4 b1l4 --}}
                            {{-- letter5 b1l5 --}}
                            <div class="col-md-6 mb-3 letter5">
                                <div class="form-group">
                                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="name" id="name"
                                        value="{{ $user->user_name }}" placeholder="Masukan nama">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter5">
                                <div class="form-group">
                                    <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="place_of_birth" id="place_of_birth"
                                        value="{{ $user->place_of_birth }}" placeholder="Masukan tempat lahir">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter5">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                                        value="{{ $user->date_of_birth }}" placeholder="Masukan tanggal lahir">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter5">
                                <div class="form-group">
                                    <label class="form-label">Pekerjaan / Jabatan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="occupation" id="occupation"
                                        value="{{ $user->occupation }}" placeholder="Masukan pekerjaan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter5">
                                <div class="form-group">
                                    <label class="form-label">Alamat<span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="address" id="address"
                                        value="{{ $user->user_address }}" placeholder="Masukan alamat">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter5">
                                <div class="form-group">
                                    <label class="form-label">Klub / Perkumpulan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="club" id="club"
                                        value="{{ $user->club_name }}" placeholder="Masukan klub / perkumupulan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter5">
                                <div class="form-group">
                                    <label class="form-label">Nomor KTA PB-Perbakin <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_kta" id="no_kta"
                                        placeholder="Masukan nomor KTA PB-Perbakin" value="{{ $user->user_kta }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter5">
                                <div class="form-group">
                                    <label class="form-label">Keanggotaan Cabang <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="membership" id="membership"
                                        value="{{ $user->user_club_cab }}" placeholder="Masukan keanggotaan cabang">
                                </div>
                            </div>
                            {{-- end letter5 b1l5 --}}

                            {{-- letter6 b1l6 --}}
                            <div class="col-md-6 mb-3 letter6">
                                <div class="form-group">
                                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="name" id="name"
                                        value="{{ $user->user_name }}" placeholder="Masukan nama">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter6">
                                <div class="form-group">
                                    <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="place_of_birth" id="place_of_birth"
                                        value="{{ $user->place_of_birth }}" placeholder="Masukan tempat lahir">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter6">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                                        value="{{ $user->date_of_birth }}" placeholder="Masukan tanggal lahir">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter6">
                                <div class="form-group">
                                    <label class="form-label">Pekerjaan / Jabatan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="occupation" id="occupation"
                                        value="{{ $user->occupation }}" placeholder="Masukan pekerjaan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter6">
                                <div class="form-group">
                                    <label class="form-label">Alamat<span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="address" id="address"
                                        value="{{ $user->user_address }}" placeholder="Masukan alamat">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter6">
                                <div class="form-group">
                                    <label class="form-label">Klub / Perkumpulan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="club" id="club"
                                        value="{{ $user->club_name }}" placeholder="Masukan klub / perkumupulan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter6">
                                <div class="form-group">
                                    <label class="form-label">Nomor KTA PB-Perbakin <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_kta" id="no_kta"
                                        placeholder="Masukan nomor KTA PB-Perbakin" value="{{ $user->user_kta }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter6">
                                <div class="form-group">
                                    <label class="form-label">Keanggotaan Cabang <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="membership" id="membership"
                                        value="{{ $user->user_club_cab }}" placeholder="Masukan keanggotaan cabang">
                                </div>
                            </div>
                            {{-- end letter6 b1l6 --}}

                            {{-- letter7 b1l7 --}}
                            <div class="col-md-6 mb-3 letter7">
                                <div class="form-group">
                                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="name" id="name"
                                        value="{{ $user->user_name }}" placeholder="Masukan nama">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter7">
                                <div class="form-group">
                                    <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="place_of_birth" id="place_of_birth"
                                        value="{{ $user->place_of_birth }}" placeholder="Masukan tempat lahir">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter7">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                                        value="{{ $user->date_of_birth }}" placeholder="Masukan tanggal lahir">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter7">
                                <div class="form-group">
                                    <label class="form-label">Pekerjaan / Jabatan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="occupation" id="occupation"
                                        value="{{ $user->occupation }}" placeholder="Masukan pekerjaan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter7">
                                <div class="form-group">
                                    <label class="form-label">Alamat<span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="address" id="address"
                                        value="{{ $user->user_address }}" placeholder="Masukan alamat">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter7">
                                <div class="form-group">
                                    <label class="form-label">Klub / Perkumpulan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="club" id="club"
                                        value="{{ $user->club_name }}" placeholder="Masukan klub / perkumupulan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter7">
                                <div class="form-group">
                                    <label class="form-label">Nomor KTA PB-Perbakin <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_kta" id="no_kta"
                                        placeholder="Masukan nomor KTA PB-Perbakin" value="{{ $user->user_kta }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter7">
                                <div class="form-group">
                                    <label class="form-label">Keanggotaan Cabang <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="membership" id="membership"
                                        value="{{ $user->user_club_cab }}" placeholder="Masukan keanggotaan cabang">
                                </div>
                            </div>
                            {{-- end letter7 b1l7 --}}

                            {{-- letter8 b1l8 --}}
                            <div class="col-md-12 mb-3 letter8">
                                <div class="form-group">
                                    <label class="form-label">Dasar AD/ART<span class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control" name="dasar_adart" id="dasar_adart"
                                        rows="5" placeholder="Masukan Dasar AD/ART"
                                        required>AD/ART Perbakin Tahun 2019 BAB IV Keanggotaan Bagian Kesatu Keanggotaan  Pasal 9 ,ART BAB II Pasal 4 dan 5  dan ART Lampiran VIII halaman 48 Susunan Organisasi Klub Menembak.</textarea>
                                </div>
                            </div>
                            {{-- end letter8 b1l8 --}}

                            {{-- letter9 b1l9 --}}
                            <div class="col-md-6 mb-3 letter9">
                                <div class="form-group">
                                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="name" id="name"
                                        value="{{ $user->user_name }}" placeholder="Masukan nama">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter9">
                                <div class="form-group">
                                    <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="place_of_birth" id="place_of_birth"
                                        value="{{ $user->place_of_birth }}" placeholder="Masukan tempat lahir">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter9">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                                        value="{{ $user->date_of_birth }}" placeholder="Masukan tanggal lahir">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter9">
                                <div class="form-group">
                                    <label class="form-label">Pekerjaan / Jabatan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="occupation" id="occupation"
                                        value="{{ $user->occupation }}" placeholder="Masukan pekerjaan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter9">
                                <div class="form-group">
                                    <label class="form-label">Alamat<span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="address" id="address"
                                        value="{{ $user->user_address }}" placeholder="Masukan alamat">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter9">
                                <div class="form-group">
                                    <label class="form-label">Klub / Perkumpulan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="club" id="club"
                                        value="{{ $user->club_name }}" placeholder="Masukan klub / perkumupulan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter9">
                                <div class="form-group">
                                    <label class="form-label">Nomor KTA PB-Perbakin <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_kta" id="no_kta"
                                        placeholder="Masukan nomor KTA PB-Perbakin" value="{{ $user->user_kta }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter9">
                                <div class="form-group">
                                    <label class="form-label">Keanggotaan Cabang <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="membership" id="membership"
                                        value="{{ $user->user_club_cab }}" placeholder="Masukan keanggotaan cabang">
                                </div>
                            </div>
                            {{-- end letter9 b1l9 --}}

                            {{-- letter10 b1l10 --}}
                            <div class="col-md-6 mb-3 letter10">
                                <div class="form-group">
                                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="name" id="name"
                                        value="{{ $user->user_name }}" placeholder="Masukan nama">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter10">
                                <div class="form-group">
                                    <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="place_of_birth" id="place_of_birth"
                                        value="{{ $user->place_of_birth }}" placeholder="Masukan tempat lahir">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter10">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                                        value="{{ $user->date_of_birth }}" placeholder="Masukan tanggal lahir">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter10">
                                <div class="form-group">
                                    <label class="form-label">Pekerjaan / Jabatan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="occupation" id="occupation"
                                        value="{{ $user->occupation }}" placeholder="Masukan pekerjaan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter10">
                                <div class="form-group">
                                    <label class="form-label">Alamat<span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="address" id="address"
                                        value="{{ $user->user_address }}" placeholder="Masukan alamat">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter10">
                                <div class="form-group">
                                    <label class="form-label">Klub / Perkumpulan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="club" id="club"
                                        value="{{ $user->club_name }}" placeholder="Masukan klub / perkumupulan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter10">
                                <div class="form-group">
                                    <label class="form-label">Nomor KTA PB-Perbakin <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_kta" id="no_kta"
                                        placeholder="Masukan nomor KTA PB-Perbakin" value="{{ $user->user_kta }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter10">
                                <div class="form-group">
                                    <label class="form-label">Keanggotaan Cabang <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="membership" id="membership"
                                        value="{{ $user->user_club_cab }}" placeholder="Masukan keanggotaan cabang">
                                </div>
                            </div>
                            {{-- end letter10 b1l10 --}}

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark section-title">
                                <span class=" font-weight-bold">Bagian 2 Keterangan</span>
                            </div>
                            {{-- ================================================================================= --}}

                            {{-- letter1 b2l1 --}}
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Jenis Senjata</label>
                                    <select class="form-control" name="firearm_category_id1" id="firearm_category_id1">
                                        <option value="">- Pilih Jenis Senjata -</option>
                                        @if(sizeof($firearm_categories) > 0)
                                        @foreach($firearm_categories as $key => $firearm_category)
                                        <option value="{{ $firearm_category->firearm_category_id }}">
                                            {{($key + 1).". " .$firearm_category->firearm_category_name }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Jenis Senjata</label>
                                    <select class="form-control letter1" name="firearm_category_id"
                                        id="firearm_category_id" required>
                                        <option value="">- Pilih Jenis Senjata -</option>
                                        @if(sizeof($firearm_categories) > 0)
                                        @foreach($firearm_categories as $firearm_category)
                                        <option value="{{ $firearm_category->firearm_category_id }}">
                                            {{ $firearm_category->firearm_category_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Merek <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control letter1" name="merek" id="merek"
                                        placeholder="Masukan merek" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Kaliber <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control letter1" name="kaliber" id="kaliber"
                                        placeholder="Masukan kaliber" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Nomor Pebrik <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control letter1" name="no_pabrik" id="no_pabrik"
                                        placeholder="Masukan nomor pabrik" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Nomor Buku Pas Senpi <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control letter1" name="no_buku_pas_senpi"
                                        id="no_buku_pas_senpi" placeholder="Masukan nomor buku pas senpi" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Nama Pemilik <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control letter1" name="nama_pemilik"
                                        id="nama_pemilik" placeholder="Masukan nama pemilik" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control letter1" name="jumlah" id="jumlah"
                                        placeholder="Masukan jumlah" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Penyimpanan/ Gudang<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control letter1" name="penyimpanan" id="penyimpanan"
                                        placeholder="Masukan penyimpanan/ gudang" required>
                                </div>
                            </div>
                            {{-- end letter1 b2l1 --}}

                            {{-- letter2 b2l2 --}}
                            <div class="col-md-6 mb-3 letter2">
                                <div class="form-group">
                                    <label class="form-label">Jenis Senjata</label>
                                    <select class="form-control" name="firearm_category_id" id="firearm_category_id">
                                        <option value="">- Pilih Jenis Senjata -</option>
                                        @if(sizeof($firearm_categories) > 0)
                                        @foreach($firearm_categories as $firearm_category)
                                        <option value="{{ $firearm_category->firearm_category_id }}">
                                            {{ $firearm_category->firearm_category_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <div class="form-group">
                                    <label class="form-label">Merek <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="merek" id="merek"
                                        placeholder="Masukan merek">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <div class="form-group">
                                    <label class="form-label">Kaliber <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="kaliber" id="kaliber"
                                        placeholder="Masukan kaliber">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <div class="form-group">
                                    <label class="form-label">Nomor Pebrik <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_pabrik" id="no_pabrik"
                                        placeholder="Masukan nomor pabrik">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <div class="form-group">
                                    <label class="form-label">Nomor Buku Pas Senpi <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_buku_pas_senpi"
                                        id="no_buku_pas_senpi" placeholder="Masukan nomor buku pas senpi">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <div class="form-group">
                                    <label class="form-label">Nama Pemilik <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="nama_pemilik" id="nama_pemilik"
                                        placeholder="Masukan nama pemilik">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <div class="form-group">
                                    <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="jumlah" id="jumlah"
                                        placeholder="Masukan jumlah">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <div class="form-group">
                                    <label class="form-label">Penyimpanan/ Gudang<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="penyimpanan" id="penyimpanan"
                                        placeholder="Masukan penyimpanan/ gudang">
                                </div>
                            </div>
                            {{-- end letter2 b2l2 --}}

                            {{-- letter3 b2l3 --}}
                            <div class="col-md-12 mb-3 border-bottom border-gray letter3">
                                <span class="font-weight-medium italic">Disebut Pihak II Penerima Hibah</span>
                            </div>
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">Nama Penerima Hibah <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="name2" id="name2" value=""
                                        placeholder="Masukan nama">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">Pekerjaan / Jabatan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="occupation2" id="occupation2"
                                        value="" placeholder="Masukan pekerjaan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">Alamat<span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="user_address2" id="user_address2"
                                        value="" placeholder="Masukan alamat">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">No KTP <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_ktp2" id="no_ktp2" value=""
                                        placeholder="Masukan klub / perkumupulan">
                                </div>
                            </div>
                            {{-- end letter3 b2l3 --}}
                            {{-- letter4 b2l4 --}}
                            <div class="col-md-6 mb-3 letter4">
                                <div class="form-group">
                                    <label class="form-label">Jenis Senjata</label>
                                    <select class="form-control" name="firearm_category_id" id="firearm_category_id">
                                        <option value="">- Pilih Jenis Senjata -</option>
                                        @if(sizeof($firearm_categories) > 0)
                                        @foreach($firearm_categories as $firearm_category)
                                        <option value="{{ $firearm_category->firearm_category_id }}">
                                            {{ $firearm_category->firearm_category_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <div class="form-group">
                                    <label class="form-label">Merek <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="merek" id="merek"
                                        placeholder="Masukan merek">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <div class="form-group">
                                    <label class="form-label">Kaliber <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="kaliber" id="kaliber"
                                        placeholder="Masukan kaliber">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <div class="form-group">
                                    <label class="form-label">Nomor Pebrik <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_pabrik" id="no_pabrik"
                                        placeholder="Masukan nomor pabrik">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <div class="form-group">
                                    <label class="form-label">Nomor Buku Pas Senpi <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_buku_pas_senpi"
                                        id="no_buku_pas_senpi" placeholder="Masukan nomor buku pas senpi">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <div class="form-group">
                                    <label class="form-label">Nomor SI Impor <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_si_impor" id="no_si_impor"
                                        placeholder="Masukan nomor SI Impor">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <div class="form-group">
                                    <label class="form-label">BAP Senjata Api <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="bap_senpi" id="bap_senpi"
                                        placeholder="Masukan BAP senpi">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <div class="form-group">
                                    <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="jumlah" id="jumlah"
                                        placeholder="Masukan jumlah">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <div class="form-group">
                                    <label class="form-label">Penyimpanan/ Gudang<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="penyimpanan" id="penyimpanan"
                                        placeholder="Masukan penyimpanan/ gudang">
                                </div>
                            </div>
                            {{-- end letter4 b2l4 --}}

                            {{-- letter5 b2l5 --}}
                            <div class="col-md-6 mb-3 letter5">
                                <div class="form-group">
                                    <label class="form-label">Dari Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="waktu_mulai" id="waktu_mulai" value=""
                                        placeholder="Masukan tanggal mulai">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter5">
                                <div class="form-group">
                                    <label class="form-label">Sampai Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="waktu_selesai" id="waktu_selesai"
                                        value="" placeholder="Masukan tanggal selesai">
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 letter5">
                                <div class="form-group">
                                    <label class="form-label">Dalam rangka acara/ kegiatan<span
                                            class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control" name="dalam_event" id="dalam_event"
                                        rows="5" placeholder="Berikan keterangan dalam rangka acara/ kegiatan ..."
                                        required>Latihan rutin dan dalam rangka menghadapi PON 2020 Papua</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter5">
                                <div class="form-group">
                                    <label class="form-label">Lokasi pelaksanaan 1 <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="lokasi1" id="lokasi1"
                                        placeholder="Masukan lokasi pelaksanaan 1">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter5">
                                <div class="form-group">
                                    <label class="form-label">Jumlah anggota rombongan <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="jumlah_anggota" id="jumlah_anggota"
                                        placeholder="Masukan jumlah angggota rombongan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter5">
                                <span class="text-sm-center text-warning">Kosongkan bila tidak ada</span>
                                <div class="form-group">
                                    <label class="form-label">Lokasi pelaksanaan 2 </label>
                                    <input type="string" class="form-control" name="lokasi2" id="lokasi2"
                                        placeholder="Masukan lokasi pelaksanaan 2">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Lokasi pelaksanaan 3</label>
                                    <input type="string" class="form-control" name="lokasi3" id="lokasi3"
                                        placeholder="Masukan lokasi pelaksanaan 3">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Lokasi pelaksanaan 4</label>
                                    <input type="string" class="form-control" name="lokasi4" id="lokasi4"
                                        placeholder="Masukan lokasi pelaksanaan 4">
                                </div>
                            </div>
                            {{-- end letter5 b2l5 --}}

                            {{-- letter6 b2l6 --}}
                            <div class="col-md-6 mb-3 letter6">
                                <div class="form-group">
                                    <label class="form-label">Dalam rangka acara/ kegiatan? <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="dalam_event" id="dalam_event"
                                        placeholder="Masukan nama acara/ kegiatan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter6">
                                <div class="form-group">
                                    <label class="form-label">Alamat daerah lokasi pelaksanaan<span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="lokasi1" id="lokasi1"
                                        placeholder="Masukan lokasi pelaksanaan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter6">
                                <div class="form-group">
                                    <label class="form-label">Dari Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="waktu_mulai" id="waktu_mulai" value=""
                                        placeholder="Masukan tanggal mulai">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter6">
                                <div class="form-group">
                                    <label class="form-label">Sampai Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="waktu_selesai" id="waktu_selesai"
                                        value="" placeholder="Masukan tanggal selesai">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter6">
                                <div class="form-group">
                                    <label class="form-label">Jumlah anggota rombongan <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="jumlah_anggota" id="jumlah_anggota"
                                        placeholder="Masukan jumlah angggota rombongan">
                                </div>
                            </div>
                            {{-- end letter6 b2l6 --}}

                            {{-- letter7 b2l7 --}}
                            <div class="col-md-12 mb-3 letter7">
                                <div class="form-group">
                                    <label class="form-label">Masa Bakti Tahun <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="dalam_event" id="dalam_event"
                                        placeholder="Masa bakti / tahun">
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 letter7">
                                <div class="form-group">
                                    <label class="form-label">Alasan Pengunduran diri<span
                                            class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control" name="l7_alasan_pengunduran"
                                        id="l7_alasan_pengunduran" rows="5"
                                        placeholder="Berikan alasan Pengunduran diri"
                                        required>{{ old('l7_alasan_pengunduran') }}</textarea>
                                </div>
                            </div>
                            {{-- end letter7 b2l7--}}

                            {{-- letter8 b2l8--}}
                            <div class="col-md-12 mb-3 letter8">
                                <div class="form-group">
                                    <label class="form-label">Sehubungan dasar tersebut diatas, diajukan permohonan
                                        pengesahan/pendirian Klub Menembak di wilayah Kabupaten Bandung</label>
                                </div>
                            </div>
                            {{-- end letter8 b2l8--}}

                            {{-- letter9 b2l9 --}}
                            <div class="col-md-6 mb-3 letter9">
                                <div class="form-group">
                                    <label class="form-label">Pindah / Mutasi Dari Klub <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="mutasi_dari" id="mutasi_dari"
                                        placeholder="Masukan klub asal">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter9">
                                <div class="form-group">
                                    <label class="form-label">Pindah / Mutasi Menuju Klub <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="mutasi_menuju" id="mutasi_menuju"
                                        placeholder="Masasukan klub tujuan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter9">
                                <div class="form-group">
                                    <label class="form-label">Cabang Klub Tujuan<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="l9_cabang" id="l9_cabang"
                                        placeholder="Masasukan klub tujuan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter9">
                                <div class="form-group">
                                    <label class="form-label">Alasan Pindah/ Mutasi<span
                                            class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control" name="mutasi_alasan" id="mutasi_alasan"
                                        rows="5" placeholder="Dikarenakan ..."
                                        required>{{ old('mutasi_alasan') }}</textarea>
                                </div>
                            </div>
                            {{-- end letter9 b2l9 --}}

                            {{-- letter10 b2l10 --}}
                            <div class="col-md-6 mb-3 letter10">
                                <div class="form-group">
                                    <label class="form-label">Jenis Senjata</label>
                                    <select class="form-control" name="firearm_category_id" id="firearm_category_id">
                                        <option value="">- Pilih Jenis Senjata -</option>
                                        @if(sizeof($firearm_categories) > 0)
                                        @foreach($firearm_categories as $firearm_category)
                                        <option value="{{ $firearm_category->firearm_category_id }}">
                                            {{ $firearm_category->firearm_category_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter10">
                                <div class="form-group">
                                    <label class="form-label">Merek <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="merek" id="merek"
                                        placeholder="Masukan merek">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter10">
                                <div class="form-group">
                                    <label class="form-label">Kaliber <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="kaliber" id="kaliber"
                                        placeholder="Masukan kaliber">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter10">
                                <div class="form-group">
                                    <label class="form-label">Nomor Buku Pas Senpi <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_buku_pas_senpi"
                                        id="no_buku_pas_senpi" placeholder="Masukan nomor buku pas senpi">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter10">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Dikeluarkan <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tanggal_dikeluarkan"
                                        id="tanggal_dikeluarkan" placeholder="Tanggal dikeluarkan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter10">
                                <div class="form-group">
                                    <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="jumlah" id="jumlah"
                                        placeholder="Masukan jumlah">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter10">
                                <div class="form-group">
                                    <label class="form-label">Nama Pemilik Buku Pas<span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="nama_pemilik" id="nama_pemilik"
                                        placeholder="Masukan nama pemilik">
                                </div>
                            </div>
                            {{-- end letter10 b2l10 --}}

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark section-title">
                                <span class=" font-weight-bold">Bagian 3 Persyaratan</span>
                            </div>
                            {{-- ================================================================================= --}}

                            {{-- letter1 b3l1 --}}
                            <div class="col-md-6 mb-3 letter1">
                                <label class="col-sm-12 col-form-label">Pilih Buku Pas Senpi</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_buku_pas_senpi"
                                            id="file_buku_pas_senpi" name="file_buku_pas_senpi" required>
                                        <label class="custom-file-label" for="file_buku_pas_senpi"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_buku_pas_senpi'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <label class="col-sm-12 col-form-label">Pilih KTA Perbakin</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_kta" id="file_kta"
                                            name="file_kta" required>
                                        <label class="custom-file-label" for="file_kta" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_kta'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (jpg/jpeg/png) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <label class="col-sm-12 col-form-label">Pilih KTP</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_ktp" id="file_ktp"
                                            name="file_ktp" required>
                                        <label class="custom-file-label" for="file_ktp" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_ktp'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (jpg/jpeg/png) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <label class="col-sm-12 col-form-label">Pilih File Foto 4x6 (latar merah)</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_foto_4x6" id="file_foto_4x6"
                                            name="file_foto_4x6" required>
                                        <label class="custom-file-label" for="file_foto_4x6" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_foto_4x6'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{-- end letter1 b3l1 --}}

                            {{-- letter2 b3l2 --}}
                            <div class="col-md-6 mb-3 letter2">
                                <label class="col-sm-12 col-form-label">Pilih Surat Pernyataan Hibah Senpi</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_surat_hibah_senpi"
                                            id="file_surat_hibah_senpi" name="file_surat_hibah_senpi" required>
                                        <label class="custom-file-label" for="file_surat_hibah_senpi"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_surat_hibah_senpi'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <label class="col-sm-12 col-form-label">Pilih Buku Pas Senpi</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_buku_pas_senpi"
                                            id="file_buku_pas_senpi" name="file_buku_pas_senpi" required>
                                        <label class="custom-file-label" for="file_buku_pas_senpi"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_buku_pas_senpi'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <label class="col-sm-12 col-form-label">Pilih Foto Senjata</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_foto_senjata"
                                            id="file_foto_senjata" name="file_foto_senjata" required>
                                        <label class="custom-file-label" for="file_foto_senjata"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_foto_senjata'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (jpg/jpeg/png) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <label class="col-sm-12 col-form-label">Pilih KTA Perbakin</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_kta" id="file_kta"
                                            name="file_kta">
                                        <label class="custom-file-label" for="file_kta" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_kta'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (jpg/jpeg/png) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <label class="col-sm-12 col-form-label">Pilih KTP</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_ktp" id="file_ktp"
                                            name="file_ktp">
                                        <label class="custom-file-label" for="file_ktp" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_ktp'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (jpg/jpeg/png) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <label class="col-sm-12 col-form-label">Pilih Sertifikat Lulus Penataran Menembak
                                    Perbakin Bid Berburu / Reaksi </label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_sertif_menembak"
                                            id="file_sertif_menembak" name="file_sertif_menembak">
                                        <label class="custom-file-label" for="file_sertif_menembak"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_sertif_menembak'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <label class="col-sm-12 col-form-label">Pilih SKCK</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_skck" id="file_skck"
                                            name="file_skck">
                                        <label class="custom-file-label" for="file_skck" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_skck'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <label class="col-sm-12 col-form-label">Pilih Surat Keterangan Sehat dari Dokter
                                    Polda</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_surat_sehat"
                                            id="file_surat_sehat" name="file_surat_sehat">
                                        <label class="custom-file-label" for="file_surat_sehat" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_surat_sehat'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <label class="col-sm-12 col-form-label">Pilih Hasil lulus Tes Psikotes dari
                                    Kepolisian/Polda</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_tes_psikotes"
                                            id="file_tes_psikotes" name="file_tes_psikotes">
                                        <label class="custom-file-label" for="file_tes_psikotes"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_tes_psikotes'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <label class="col-sm-12 col-form-label">Pilih Kartu Keluarga</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_kk" id="file_kk"
                                            name="file_kk">
                                        <label class="custom-file-label" for="file_kk" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_kk'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <label class="col-sm-12 col-form-label">Pilih File Foto 4x6 (latar merah)</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_foto_4x6" id="file_foto_4x6"
                                            name="file_foto_4x6">
                                        <label class="custom-file-label" for="file_foto_4x6" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_foto_4x6'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{-- end letter2 b3l2 --}}

                            {{-- letter3 b3l3 --}}
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">Jenis Senjata</label>
                                    <select class="form-control" name="firearm_category_id" id="firearm_category_id">
                                        <option value="">- Pilih Jenis Senjata -</option>
                                        @if(sizeof($firearm_categories) > 0)
                                        @foreach($firearm_categories as $firearm_category)
                                        <option value="{{ $firearm_category->firearm_category_id }}">
                                            {{ $firearm_category->firearm_category_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">Merek <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="merek" id="merek"
                                        placeholder="Masukan merek">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">Kaliber <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="kaliber" id="kaliber"
                                        placeholder="Masukan kaliber">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">Nomor Pebrik <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_pabrik" id="no_pabrik"
                                        placeholder="Masukan nomor pabrik">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">Nomor Buku Pas Senpi <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_buku_pas_senpi"
                                        id="no_buku_pas_senpi" placeholder="Masukan nomor buku pas senpi">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Dikeluarkan <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tanggal_dikeluarkan"
                                        id="tanggal_dikeluarkan" placeholder="Tanggal dikeluarkan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="jumlah" id="jumlah"
                                        placeholder="Masukan jumlah">
                                </div>
                            </div>
                            {{-- end letter3 b3l3 --}}
                            {{-- letter4 b3l4 --}}
                            <div class="col-md-6 mb-3 letter4">
                                <label class="col-sm-12 col-form-label">Pilih Surat Izin Impor Senjata</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_si_impor_senjata"
                                            id="file_si_impor_senjata" name="file_si_impor_senjata">
                                        <label class="custom-file-label" for="file_si_impor_senjata"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_si_impor_senjata'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <label class="col-sm-12 col-form-label">Pilih Surat Berita Acara Penitipan Senpi
                                    dari
                                    Bid Yanmas Mabes Polri</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_sba_penitipan_senpi"
                                            id="file_sba_penitipan_senpi" name="file_sba_penitipan_senpi">
                                        <label class="custom-file-label" for="file_sba_penitipan_senpi"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_sba_penitipan_senpi'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <label class="col-sm-12 col-form-label">Pilih KTA Perbakin</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_kta" id="file_kta"
                                            name="file_kta">
                                        <label class="custom-file-label" for="file_kta" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_kta'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (jpg/jpeg/png) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <label class="col-sm-12 col-form-label">Pilih KTP</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_ktp" id="file_ktp"
                                            name="file_ktp">
                                        <label class="custom-file-label" for="file_ktp" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_ktp'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (jpg/jpeg/png) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <label class="col-sm-12 col-form-label">Pilih Sertifikat Lulus Penataran Menembak
                                    Perbakin Bid Berburu / Reaksi </label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_sertif_menembak"
                                            id="file_sertif_menembak" name="file_sertif_menembak">
                                        <label class="custom-file-label" for="file_sertif_menembak"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_sertif_menembak'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <label class="col-sm-12 col-form-label">Pilih SKCK</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_skck" id="file_skck"
                                            name="file_skck">
                                        <label class="custom-file-label" for="file_skck" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_skck'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <label class="col-sm-12 col-form-label">Pilih Surat Keterangan Sehat dari Dokter
                                    Polda</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_surat_sehat"
                                            id="file_surat_sehat" name="file_surat_sehat">
                                        <label class="custom-file-label" for="file_surat_sehat" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_surat_sehat'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <label class="col-sm-12 col-form-label">Pilih Hasil lulus Tes Psikotes dari
                                    Kepolisian/Polda</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_tes_psikotes"
                                            id="file_tes_psikotes" name="file_tes_psikotes">
                                        <label class="custom-file-label" for="file_tes_psikotes"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_tes_psikotes'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <label class="col-sm-12 col-form-label">Pilih Kartu Keluarga</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_kk" id="file_kk"
                                            name="file_kk">
                                        <label class="custom-file-label" for="file_kk" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_kk'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <label class="col-sm-12 col-form-label">Pilih File Foto 4x6 (latar merah)</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_foto_4x6" id="file_foto_4x6"
                                            name="file_foto_4x6">
                                        <label class="custom-file-label" for="file_foto_4x6" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_foto_4x6'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{-- end letter4 b3l4 --}}

                            {{-- letter5 b3l5 --}}
                            <div class="col-md-6 mb-3 letter5">
                                <label class="col-sm-12 col-form-label">Pilih lampiran surat izin penggunaan sarana/
                                    lokasi</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input l5_lampiran1" id="l5_lampiran1"
                                            name="l5_lampiran1">
                                        <label class="custom-file-label" for="l5_lampiran1" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('l5_lampiran1'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter5">
                                <label class="col-sm-12 col-form-label">Pilih Nama Anggota rombongan dan Senjata Api
                                    yang digunakan</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input nama_anggota_senjata_digunakan"
                                            id="nama_anggota_senjata_digunakan" name="nama_anggota_senjata_digunakan">
                                        <label class="custom-file-label" for="nama_anggota_senjata_digunakan"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('nama_anggota_senjata_digunakan'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter5">
                                <label class="col-sm-12 col-form-label">Pilih KTA Perbakin</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_kta" id="file_kta"
                                            name="file_kta">
                                        <label class="custom-file-label" for="file_kta" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_kta'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (jpg/jpeg/png) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter5">
                                <label class="col-sm-12 col-form-label">Pilih Buku Pas Senpi</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_buku_pas_senpi"
                                            id="file_buku_pas_senpi" name="file_buku_pas_senpi">
                                        <label class="custom-file-label" for="file_buku_pas_senpi"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_buku_pas_senpi'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{-- end letter5 b3l5 --}}

                            {{-- letter6 b3l6 --}}
                            <div class="col-md-6 mb-3 letter6">
                                <label class="col-sm-12 col-form-label">Pilih Surat Rekomendasi dari Pengcab Perbakin
                                    Kab.Bandung </label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input surat_rekomendasi_pengcab"
                                            id="surat_rekomendasi_pengcab" name="surat_rekomendasi_pengcab">
                                        <label class="custom-file-label" for="surat_rekomendasi_pengcab"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('surat_rekomendasi_pengcab'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter6">
                                <label class="col-sm-12 col-form-label">Pilih Nama Anggota rombongan dan Senjata Api
                                    yang digunakan</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input nama_anggota_senjata_digunakan"
                                            id="nama_anggota_senjata_digunakan" name="nama_anggota_senjata_digunakan">
                                        <label class="custom-file-label" for="nama_anggota_senjata_digunakan"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('nama_anggota_senjata_digunakan'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter6">
                                <label class="col-sm-12 col-form-label">Pilih KTA Perbakin</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_kta" id="file_kta"
                                            name="file_kta">
                                        <label class="custom-file-label" for="file_kta" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_kta'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (jpg/jpeg/png) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter6">
                                <label class="col-sm-12 col-form-label">Pilih Buku Pas Senpi</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_buku_pas_senpi"
                                            id="file_buku_pas_senpi" name="file_buku_pas_senpi">
                                        <label class="custom-file-label" for="file_buku_pas_senpi"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_buku_pas_senpi'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter6">
                                <label class="col-sm-12 col-form-label">Pilih Surat Undangan Berburu , dari Kepala Desa
                                    / Camat lokasi Berburu </label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input l6_undangan_berburu"
                                            id="l6_undangan_berburu" name="l6_undangan_berburu">
                                        <label class="custom-file-label" for="l6_undangan_berburu"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('l6_undangan_berburu'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter6">
                                <label class="col-sm-12 col-form-label">Pilih Surat Keterangan Sehat dari Dokter</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_surat_sehat"
                                            id="file_surat_sehat" name="file_surat_sehat">
                                        <label class="custom-file-label" for="file_surat_sehat" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_surat_sehat'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{-- end letter6 b3l6--}}
                            {{-- letter7 b3l7 --}}
                            <div class="col-md-6 mb-3 letter7">
                                <div class="form-group">
                                    <label class="form-label">Tembusan Ketua Club <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="tembusan1" id="tembusan1"
                                        placeholder="Masa bakti / tahun" value="Ketua Club {{ $user->club_name }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter7">
                                <div class="form-group">
                                    <label class="form-label">Tembusan Ketua Umum Pengprov Perbakin Jabar <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="tembusan2" id="tembusan2"
                                        placeholder="Masa bakti / tahun" value="Ketum Pengprov Perbakin Jabar">
                                </div>
                            </div>
                            {{-- end letter7 b3l7--}}
                            {{-- letter8 b3l8 --}}
                            <div class="col-md-6 mb-3 letter8">
                                <label class="col-sm-12 col-form-label">File berisi KTA 4(empat) orang anggota yang
                                    sudah memiliki KTA Perbakin dari PB</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input l8_kta_anggota_baru"
                                            id="l8_kta_anggota_baru" name="l8_kta_anggota_baru">
                                        <label class="custom-file-label" for="l8_kta_anggota_baru"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('l8_kta_anggota_baru'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter8">
                                <label class="col-sm-12 col-form-label">Pilih KTP</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_ktp" id="file_ktp"
                                            name="file_ktp">
                                        <label class="custom-file-label" for="file_ktp" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_ktp'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (jpg/jpeg/png) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter8">
                                <label class="col-sm-12 col-form-label">AD/ART Klub/Perkumpulan Menembak yang berisi
                                    Nama lambang Klub, Logo Klub/Arti, Visi Misi Klub</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input l8_adart" id="l8_adart"
                                            name="l8_adart">
                                        <label class="custom-file-label" for="l8_adart" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('l8_adart'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter8">
                                <label class="col-sm-12 col-form-label">Struktur Organisasi Pengurus Klub </label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input l8_struktur_organisasi"
                                            id="l8_struktur_organisasi" name="l8_struktur_organisasi">
                                        <label class="custom-file-label" for="l8_struktur_organisasi"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('l8_struktur_organisasi'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter8">
                                <label class="col-sm-12 col-form-label">Daftar Nama para Pengurus Klub </label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input l8_nama_para_pengurus"
                                            id="l8_nama_para_pengurus" name="l8_nama_para_pengurus">
                                        <label class="custom-file-label" for="l8_nama_para_pengurus"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('l8_nama_para_pengurus'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter8">
                                <label class="col-sm-12 col-form-label">Pas Poto Pengurus Klub latar merah (3x4, 4x6)
                                </label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input l8_pas_foto_pengurus"
                                            id="l8_pas_foto_pengurus" name="l8_pas_foto_pengurus">
                                        <label class="custom-file-label" for="l8_pas_foto_pengurus"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('l8_pas_foto_pengurus'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter8">
                                <label class="col-sm-12 col-form-label">Data anggota Klub minimal 20 Orang</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input l8_data_anggota_club"
                                            id="l8_data_anggota_club" name="l8_data_anggota_club">
                                        <label class="custom-file-label" for="l8_data_anggota_club"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('l8_data_anggota_club'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter8">
                                <label class="col-sm-12 col-form-label">Surat Keterangan Domisili Sekretariat Klub
                                </label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input l8_surat_keterangan_domisili"
                                            id="l8_surat_keterangan_domisili" name="l8_surat_keterangan_domisili">
                                        <label class="custom-file-label" for="l8_surat_keterangan_domisili"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('l8_surat_keterangan_domisili'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter8">
                                <label class="col-sm-12 col-form-label">Pilih SKCK Ketua</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_skck" id="file_skck"
                                            name="file_skck">
                                        <label class="custom-file-label" for="file_skck" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_skck'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter8">
                                <label class="col-sm-12 col-form-label">Bukti Transfer Biaya Administrasi </label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input biaya_administrasi"
                                            id="biaya_administrasi" name="biaya_administrasi">
                                        <label class="custom-file-label" for="biaya_administrasi"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('biaya_administrasi'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{-- end letter8 b3l8 --}}

                            {{-- letter9 b3l9 --}}
                            <div class="col-md-6 mb-3 letter9">
                                <label class="col-sm-12 col-form-label">Pilih KTP</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_ktp" id="file_ktp"
                                            name="file_ktp">
                                        <label class="custom-file-label" for="file_ktp" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_ktp'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (jpg/jpeg/png) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter9">
                                <label class="col-sm-12 col-form-label">Pilih KTA Klub</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_kta_club" id="file_kta_club"
                                            name="file_kta_club">
                                        <label class="custom-file-label" for="file_kta_club" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_kta_club'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (jpg/jpeg/png) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter9">
                                <label class="col-sm-12 col-form-label">Pilih Surat Rekomendasi dari Klub Menembak
                                </label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input surat_rekomendasi_club"
                                            id="surat_rekomendasi_club" name="surat_rekomendasi_club">
                                        <label class="custom-file-label" for="surat_rekomendasi_club"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('surat_rekomendasi_club'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter9">
                                <label class="col-sm-12 col-form-label">Pilih KTA Perbakin</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_kta" id="file_kta"
                                            name="file_kta">
                                        <label class="custom-file-label" for="file_kta" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_kta'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (jpg/jpeg/png) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter9">
                                <label class="col-sm-12 col-form-label">Pilih File Foto 4x6</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_foto_4x6" id="file_foto_4x6"
                                            name="file_foto_4x6">
                                        <label class="custom-file-label" for="file_foto_4x6" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_foto_4x6'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{-- end letter9 b3l9 --}}

                            {{-- letter10 b3l10 --}}
                            <div class="col-md-6 mb-3 letter10">
                                <label class="col-sm-12 col-form-label">Pilih KTA Klub</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_kta_club" id="file_kta_club"
                                            name="file_kta_club">
                                        <label class="custom-file-label" for="file_kta_club" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_kta_club'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (jpg/jpeg/png) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter10">
                                <label class="col-sm-12 col-form-label">Pilih KTP</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_ktp" id="file_ktp"
                                            name="file_ktp">
                                        <label class="custom-file-label" for="file_ktp" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_ktp'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (jpg/jpeg/png) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter10">
                                <label class="col-sm-12 col-form-label">Pilih Buku Pas Senpi</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_buku_pas_senpi"
                                            id="file_buku_pas_senpi" name="file_buku_pas_senpi">
                                        <label class="custom-file-label" for="file_buku_pas_senpi"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_buku_pas_senpi'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter10">
                                <label class="col-sm-12 col-form-label">Pilih File Foto 4x6</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_foto_4x6" id="file_foto_4x6"
                                            name="file_foto_4x6">
                                        <label class="custom-file-label" for="file_foto_4x6" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_foto_4x6'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{-- end letter10 b3l10 --}}

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark section-title">
                                <span class=" font-weight-bold">Bagian 4 Pemohon</span>
                            </div>
                            {{-- ================================================================================= --}}
                            {{-- letter1 b4l1 --}}
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Pemohon<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="pemohon" id="pemohon"
                                        placeholder="Masukan pemohon">
                                </div>
                            </div>
                            {{-- end letter1 b4l1 --}}

                            {{-- letter2 b4l2 --}}
                            <div class="col-md-6 mb-3 letter2">
                                <div class="form-group">
                                    <label class="form-label">Pemohon<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="pemohon" id="pemohon"
                                        placeholder="Masukan pemohon">
                                </div>
                            </div>
                            {{-- end letter2 b4l2 --}}

                            {{-- letter3 b4l3 --}}
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">Penerima Hibah Pihak II<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="pemohon_pihak_2" id="pemohon_pihak_2"
                                        placeholder="Masukan pemohon pihak 2">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">Pemberi Hibah/ Menghibahkan/ Pihak I<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="pemohon" id="pemohon"
                                        placeholder="Masukan pemohon">
                                </div>
                            </div>
                            {{-- end letter3 b4l3 --}}

                            {{-- letter4 b4l4 --}}
                            <div class="col-md-6 mb-3 letter4">
                                <div class="form-group">
                                    <label class="form-label">Pemohon<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="pemohon" id="pemohon"
                                        placeholder="Masukan pemohon">
                                </div>
                            </div>
                            {{-- end letter4 b4l4 --}}

                            {{-- letter5 b4l5 --}}
                            <div class="col-md-6 mb-3 letter5">
                                <div class="form-group">
                                    <label class="form-label">Pemohon<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="pemohon" id="pemohon"
                                        placeholder="Masukan pemohon">
                                </div>
                            </div>
                            {{-- end letter5 b4l5 --}}

                            {{-- letter6 b4l6 --}}
                            <div class="col-md-6 mb-3 letter6">
                                <div class="form-group">
                                    <label class="form-label">Pemohon<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="pemohon" id="pemohon"
                                        placeholder="Masukan pemohon">
                                </div>
                            </div>
                            {{-- end letter6 b4l6 --}}

                            {{-- letter7 b4l7 --}}
                            <div class="col-md-6 mb-3 letter7">
                                <div class="form-group">
                                    <label class="form-label">Pemohon<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="pemohon" id="pemohon"
                                        placeholder="Masukan pemohon">
                                </div>
                            </div>
                            {{-- end letter7 b4l7 --}}
                            {{-- letter8 b4l8 --}}
                            <div class="col-md-6 mb-3 letter8">
                                <div class="form-group">
                                    <label class="form-label">Pemohon<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="pemohon" id="pemohon"
                                        placeholder="Masukan pemohon">
                                </div>
                            </div>
                            {{-- end letter8 b4l8 --}}

                            {{-- letter9 b4l9 --}}
                            <div class="col-md-6 mb-3 letter9">
                                <div class="form-group">
                                    <label class="form-label">Pemohon<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="pemohon" id="pemohon"
                                        placeholder="Masukan pemohon">
                                </div>
                            </div>
                            {{-- end letter9 b4l9 --}}

                            {{-- letter10 b4l10 --}}
                            <div class="col-md-6 mb-3 letter10">
                                <div class="form-group">
                                    <label class="form-label">Pemohon<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="pemohon" id="pemohon"
                                        placeholder="Masukan pemohon">
                                </div>
                            </div>
                            {{-- end letter10 b4l10 --}}

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Add -->

@endsection

@section('script')
<script type="text/javascript">
    // on load view
    $('.download').hide();

    // set option persyaratan file
    $('#letter_category_id').change(function () {
        let letter = $('#letter_category_id').val();
        switch (letter) {
            case "1":
                // $('.letter1').show();
                // $('.header-letter').show();
                // $('.sample-letter').show();
                // $('.section-title').show();

                // $('#downloadletter').hide();
                // $('.letter2').hide();
                // $('.letter3').hide();
                // $('.letter4').hide();
                // $('.letter5').hide();
                // $('.letter6').hide();
                // $('.letter7').hide();
                // $('.letter8').hide();
                // $('.letter9').hide();
                // $('.letter10').hide();
                $('.letter1').show();
                $('.header-letter').show();
                $('.sample-letter').show();
                $('.section-title').show();
                document.querySelectorAll("#downloadletter").forEach(el => el.remove());
                // $('#downloadletter').hide();
                $('.letter2').hide();
                $('.letter3').hide();
                $('.letter4').hide();
                $('.letter5').hide();
                $('.letter6').hide();
                $('.letter7').hide();
                $('.letter8').hide();
                $('.letter9').hide();
                $('.letter10').hide();
                $('.btn-submit').show();

                break;
            case "2":
                $('.letter2').show();
                $('.header-letter').show();
                $('.sample-letter').show();
                $('.section-title').show();

                $('#downloadletter').hide();
                $('.letter1').hide();
                $('.letter3').hide();
                $('.letter4').hide();
                $('.letter5').hide();
                $('.letter6').hide();
                $('.letter7').hide();
                $('.letter8').hide();
                $('.letter9').hide();
                $('.letter10').hide();
                $('.btn-submit').show();
                break;

            case "3":
                $('.letter3').show();
                $('.sample-letter').show();
                $('.section-title').show();

                $('#downloadletter').hide();
                $('.header-letter').hide();
                $('.letter1').hide();
                $('.letter2').hide();
                $('.letter4').hide();
                $('.letter5').hide();
                $('.letter6').hide();
                $('.letter7').hide();
                $('.letter8').hide();
                $('.letter9').hide();
                $('.letter10').hide();
                $('.btn-submit').show();
                break;

            case "4":
                $('.letter4').show();
                $('.sample-letter').show();
                $('.header-letter').show();
                $('.section-title').show();

                $('#downloadletter').hide();
                $('.letter1').hide();
                $('.letter2').hide();
                $('.letter3').hide();
                $('.letter5').hide();
                $('.letter6').hide();
                $('.letter7').hide();
                $('.letter8').hide();
                $('.letter9').hide();
                $('.letter10').hide();
                $('.btn-submit').show();
                break;

            case "5":
                $('.letter5').show();
                $('.sample-letter').show();
                $('.header-letter').show();
                $('.section-title').show();

                $('#downloadletter').hide();
                $('.letter1').hide();
                $('.letter2').hide();
                $('.letter3').hide();
                $('.letter4').hide();
                $('.letter6').hide();
                $('.letter7').hide();
                $('.letter8').hide();
                $('.letter9').hide();
                $('.letter10').hide();
                $('.btn-submit').show();
                break;
            case "6":
                $('.letter6').show();
                $('.sample-letter').show();
                $('.header-letter').show();
                $('.section-title').show();

                $('#downloadletter').hide();
                $('.letter1').hide();
                $('.letter2').hide();
                $('.letter3').hide();
                $('.letter4').hide();
                $('.letter5').hide();
                $('.letter7').hide();
                $('.letter8').hide();
                $('.letter9').hide();
                $('.letter10').hide();
                $('.btn-submit').show();
                break;
            case "7":
                $('.letter7').show();
                $('.sample-letter').show();
                $('.header-letter').show();
                $('.section-title').show();

                $('#downloadletter').hide();
                $('.letter1').hide();
                $('.letter2').hide();
                $('.letter3').hide();
                $('.letter4').hide();
                $('.letter5').hide();
                $('.letter6').hide();
                $('.letter8').hide();
                $('.letter9').hide();
                $('.letter10').hide();
                $('.btn-submit').show();
                break;

            case "8":
                $('.letter8').show();
                $('.sample-letter').show();
                $('.header-letter').show();
                $('.section-title').show();

                $('#downloadletter').hide();
                $('.letter1').hide();
                $('.letter2').hide();
                $('.letter3').hide();
                $('.letter4').hide();
                $('.letter5').hide();
                $('.letter6').hide();
                $('.letter7').hide();
                $('.letter9').hide();
                $('.letter10').hide();
                $('.btn-submit').show();
                break;

            case "9":
                $('.letter9').show();
                $('.sample-letter').show();
                $('.header-letter').show();
                $('.section-title').show();

                $('#downloadletter').hide();
                $('.letter1').hide();
                $('.letter2').hide();
                $('.letter3').hide();
                $('.letter4').hide();
                $('.letter5').hide();
                $('.letter6').hide();
                $('.letter7').hide();
                $('.letter8').hide();
                $('.letter10').hide();
                $('.btn-submit').show();
                break;

            case "10":
                $('.letter10').show();
                $('.sample-letter').show();
                $('.header-letter').show();
                $('.section-title').show();

                $('#downloadletter').hide();
                $('.letter1').hide();
                $('.letter2').hide();
                $('.letter3').hide();
                $('.letter4').hide();
                $('.letter5').hide();
                $('.letter6').hide();
                $('.letter7').hide();
                $('.letter8').hide();
                $('.letter9').hide();
                $('.btn-submit').show();
                break;

            case "11":
                $('#downloadletter').show();
                $('.btn-submit').hide();
                $('.section-title').hide();
                $('.sample-letter').hide();
                $('.header-letter').hide();
                $('.letter1').hide();
                $('.letter2').hide();
                $('.letter3').hide();
                $('.letter4').hide();
                $('.letter5').hide();
                $('.letter6').hide();
                $('.letter7').hide();
                $('.letter8').hide();
                $('.letter9').hide();
                $('.letter10').hide();

                var urldownload = 'recomendationletter/downloadletter/' + letter;
                document.getElementById('downloadletter').innerHTML =
                    "<a href='" + urldownload +
                    "' class='btn btn-primary download'>Download file surat</i>";
                break;
            case "12":
                $('#downloadletter').show();
                $('.btn-submit').hide();
                $('.section-title').hide();
                $('.sample-letter').hide();
                $('.header-letter').hide();
                $('.letter1').hide();
                $('.letter2').hide();
                $('.letter3').hide();
                $('.letter4').hide();
                $('.letter5').hide();
                $('.letter6').hide();
                $('.letter7').hide();
                $('.letter8').hide();
                $('.letter9').hide();
                $('.letter10').hide();
                var urldownload = 'recomendationletter/downloadletter/' + letter;
                document.getElementById('downloadletter').innerHTML =
                    "<a href='" + urldownload +
                    "' class='btn btn-primary download'>Download file surat</i>";
                break;

            default:
                $('.section-title').hide();
                $('.sample-letter').hide();
                $('.header-letter').hide();
                $('#downloadletter').hide();
                $('.letter1').hide();
                $('.letter2').hide();
                $('.letter3').hide();
                $('.letter4').hide();
                $('.letter5').hide();
                $('.letter6').hide();
                $('.letter7').hide();
                $('.letter8').hide();
                $('.letter9').hide();
                $('.letter10').hide();
                break;
        }

    });
    $("#name").keyup(function () {
        let name = $("#name").val();
        $('#nama_pemilik').val(name);
        $('#pemohon').val(name);
    });

    $("#name2").keyup(function () {
        let name2 = $("#name2").val();
        $('#pemohon_pihak_2').val(name2);
    });

    // add data
    $('.btnAdd').click(function () {
        document.getElementById("addForm").reset();

        $('.section-title').hide();
        $('.sample-letter').hide();
        $('.header-letter').hide();
        $('.letter1').hide();
        $('.letter2').hide();
        $('.letter3').hide();
        $('.letter4').hide();
        $('.letter5').hide();
        $('.letter6').hide();
        $('.letter7').hide();
        $('.letter8').hide();
        $('.letter9').hide();
        $('.letter10').hide();

        $('.addModal form').attr('action', "{{ url('recomendationletter/store') }}");
        $('.addModal .modal-title').text('Tambah pengajuan surat rekomendasi');
        $('.addModal').modal('show');
    });

    // check error
    @if(count($errors))
    $('.addModal').modal('show');
    @endif

    $('.btnEdit').click(function () {

        var id = $(this).attr('data-id');
        var url = "{{ url('recomendationletter/getdata') }}";

        $('.addModal form').attr('action', "{{ url('recomendationletter/update') }}" + '/' + id);

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
            letter_category_id: "required",
            // letter_place: "required",
            // letter_category_id: "required",
            // letter_place: "required",
            // letter_date: "required",
            // name: "required",
            // place_of_birth: "required",
            // date_of_birth: "required",
            // occupation: "required",
            // address: "required",
            // club: "required",
            // no_kta: "required",
            // membership: "required",
            // firearm_category_id: "required",
            // merek: "required",
            // kaliber: "required",
            // no_pabrik: "required",
            // no_buku_pas_senpi: "required",
            // nama_pemilik: "required",
            // jumlah: "required",
            // penyimpanan: "required",
            pemohon: "required",
        },
        messages: {
            letter_category_id: "Jenis surat rekomendasi harus dipilih",
            // letter_place: "Alamat Surat tidak boleh kosong",
            // letter_category_id: "Field tidak boleh kosong",
            // letter_place: "Field tidak boleh kosong",
            // letter_date: "Field tidak boleh kosong",
            // name: "Field tidak boleh kosong",
            // place_of_birth: "Field tidak boleh kosong",
            // date_of_birth: "Field tidak boleh kosong",
            // occupation: "Field tidak boleh kosong",
            // address: "Field tidak boleh kosong",
            // club: "Field tidak boleh kosong",
            // no_kta: "Field tidak boleh kosong",
            // membership: "Field tidak boleh kosong",
            // firearm_category_id: "Field tidak boleh kosong",
            // merek: "Field tidak boleh kosong",
            // kaliber: "Field tidak boleh kosong",
            // no_pabrik: "Field tidak boleh kosong",
            // no_buku_pas_senpi: "Field tidak boleh kosong",
            // nama_pemilik: "Field tidak boleh kosong",
            // jumlah: "Field tidak boleh kosong",
            // penyimpanan: "Field tidak boleh kosong",
            pemohon: "Field tidak boleh kosong",
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
