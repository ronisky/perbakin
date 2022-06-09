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
                                    <a href="/dashboard">>
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
                                        target="blank" class="btn btn-icon btnPrint btn-outline-secondary"
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
                                        target="blank" class="btn btn-icon btnPrint btn-outline-secondary"
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
<!-- </div> -->
<!-- ============================================================== -->
<!-- End Container fluid  -->

<!-- Modal Add -->
<div class="modal addModal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah pengajuan surat rekomendasi</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('recomendationletter/store') }}" method="POST" id="addForm">
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
                                    <div class="col-md-12 input-option">
                                        <div class="form-group">
                                            <label class="form-label">Tempat Surat<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="letter_place"
                                                id="letter_place" placeholder="Masukan tempat surat">
                                        </div>
                                    </div>
                                    <div class="col-md-12 input-option">
                                        <div class="form-group">
                                            <label class="form-label">Tanggal Surat <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="letter_date" id="letter_date"
                                                placeholder="Masukan tanggal surat" value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 input-option">
                                    <div class="col-md-6 center ">
                                        <div class="card" style="width: 10rem;">
                                            <a target="blank"
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
                            <div class="col-md-12 mb-3 border-bottom border-dark input-option">
                                <span class=" font-weight-bold">Bagian 1 Pemohon</span>
                            </div>
                            <div class="col-md-6 mb-3 input-option input-pemohon">
                                <div class="form-group">
                                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="name" id="name"
                                        value="{{ $user->user_name }}" placeholder="Masukan nama">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 input-option input-pemohon">
                                <div class="form-group">
                                    <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="place_of_birth" id="place_of_birth"
                                        value="{{ $user->place_of_birth }}" placeholder="Masukan tempat lahir">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 input-option input-pemohon">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                                        value="{{ $user->date_of_birth }}" placeholder="Masukan tanggal lahir">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 input-option input-pemohon">
                                <div class="form-group">
                                    <label class="form-label">Pekerjaan / Jabatan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="occupation" id="occupation"
                                        value="{{ $user->occupation }}" placeholder="Masukan pekerjaan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 input-option input-pemohon">
                                <div class="form-group">
                                    <label class="form-label">Alamat<span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="address" id="address"
                                        value="{{ $user->user_address }}" placeholder="Masukan alamat">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 input-option input-pemohon">
                                <div class="form-group">
                                    <label class="form-label">Klub / Perkumpulan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="club" id="club"
                                        value="{{ $user->club_name }}" placeholder="Masukan klub / perkumupulan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 input-option input-pemohon">
                                <div class="form-group">
                                    <label class="form-label">Nomor KTA PB-Perbakin <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_kta" id="no_kta"
                                        placeholder="Masukan nomor KTA PB-Perbakin" value="{{ $user->user_kta }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 input-option input-pemohon">
                                <div class="form-group">
                                    <label class="form-label">Keanggotaan Cabang <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="membership" id="membership"
                                        value="{{ $user->user_club_cab }}" placeholder="Masukan keanggotaan cabang">
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 border-bottom border-dark input-option">
                                <span class=" font-weight-bold">Bagian 2 Keterangan</span>
                            </div>
                            <div class="col-md-6 mb-3 input-option input-firearm">
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
                            <div class="col-md-6 mb-3 input-option input-firearm">
                                <div class="form-group">
                                    <label class="form-label">Merek <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="merek" id="merek"
                                        placeholder="Masukan merek">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 input-option input-firearm">
                                <div class="form-group">
                                    <label class="form-label">Kaliber <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="kaliber" id="kaliber"
                                        placeholder="Masukan kaliber">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 input-option input-firearm">
                                <div class="form-group">
                                    <label class="form-label">Nomor Pebrik <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_pabrik" id="no_pabrik"
                                        placeholder="Masukan nomor pabrik">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 input-option input-firearm">
                                <div class="form-group">
                                    <label class="form-label">Nomor Buku Pas Senpi <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_buku_pas_senpi"
                                        id="no_buku_pas_senpi" placeholder="Masukan nomor buku pas senpi">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 input-option input-firearm">
                                <div class="form-group">
                                    <label class="form-label">Nama Pemilik <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="nama_pemilik" id="nama_pemilik"
                                        placeholder="Masukan nama pemilik">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 input-option input-firearm">
                                <div class="form-group">
                                    <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="jumlah" id="jumlah"
                                        placeholder="Masukan jumlah">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 input-option input-firearm">
                                <div class="form-group">
                                    <label class="form-label">Penyimpanan/ Gudang<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="penyimpanan" id="penyimpanan"
                                        placeholder="Masukan penyimpanan/ gudang">
                                </div>
                            </div>

                            <div class="col-md-12 mb-3 border-bottom border-dark input-option">
                                <span class=" font-weight-bold">Bagian 3 Persyaratan</span>
                            </div>

                            <div class="col-md-6 mb-3 input-option file-si-impor-senjata">
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
                            <div class="col-md-6 mb-3 input-option file-sba-penitipan-senpi">
                                <label class="col-sm-12 col-form-label">Pilih Surat Berita Acara Penitipan Senpi dari
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
                            <div class="col-md-6 mb-3 input-option file-surat-hibah-senpi">
                                <label class="col-sm-12 col-form-label">Pilih Surat Pernyataan Hibah Senpi</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_surat_hibah_senpi"
                                            id="file_surat_hibah_senpi" name="file_surat_hibah_senpi">
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
                            <div class="col-md-6 mb-3 input-option file-buku-pas-senpi">
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
                            <div class="col-md-6 mb-3 input-option file-foto-senjata">
                                <label class="col-sm-12 col-form-label">Pilih Foto Senjata</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_foto_senjata"
                                            id="file_foto_senjata" name="file_foto_senjata">
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
                            <div class="col-md-6 mb-3 input-option file-kta">
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
                            <div class="col-md-6 mb-3 input-option file-ktp">
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
                            <div class="col-md-6 mb-3 input-option file-sertif-menembak">
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
                            <div class="col-md-6 mb-3 input-option file-skck">
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
                            <div class="col-md-6 mb-3 input-option file-surat-sehat">
                                <label class="col-sm-12 col-form-label">Pilih Surat Sehat dari Dokter Polda</label>
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
                            <div class="col-md-6 mb-3 input-option file-tes-psikotes">
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
                            <div class="col-md-6 mb-3 input-option file-kk">
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
                            <div class="col-md-6 mb-3 input-option file-foto-23">
                                <label class="col-sm-12 col-form-label">Pilih Pas Foto 2x3 (Latar Merah)</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_foto_23" id="file_foto_23"
                                            name="file_foto_23">
                                        <label class="custom-file-label" for="file_foto_23" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_foto_23'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 input-option file-foto-34">
                                <label class="col-sm-12 col-form-label">Pilih Pas Foto 3x4 (Latar Merah) </label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_foto_34" id="file_foto_34"
                                            name="file_foto_34">
                                        <label class="custom-file-label" for="file_foto_34" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_foto_34'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 input-option file-foto-46">
                                <label class="col-sm-12 col-form-label">Pilih Pas Foto 4x6 (Latar Merah) </label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_foto_46" id="file_foto_46"
                                            name="file_foto_46">
                                        <label class="custom-file-label" for="file_foto_46" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_foto_46'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12 mb-3 border-bottom border-dark input-option">
                                <span class=" font-weight-bold">Bagian 4 Pemohon</span>
                            </div>

                            <div class="col-md-6 mb-3 input-option">
                                <div class="form-group">
                                    <label class="form-label">Pemohon<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="pemohon" id="pemohon"
                                        placeholder="Masukan pemohon">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer input-option">
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
    // on load view
    $('.download').hide();

    // set option persyaratan file
    $('#letter_category_id').change(function () {
        let letter = $('#letter_category_id').val();

        if (letter == 11 || letter == 12) {
            $('.input-option').hide();
            var urldownload = 'recomendationletter/downloadletter/' + letter;
            document.getElementById('downloadletter').innerHTML =
                "<a href='" + urldownload +
                "' class='btn btn-primary download'>Download file surat</i>";
        } else if (letter == 1) {
            $('.input-option').show();
            $('.input-pemohon').show();
            $('.input-firearm').show();
            // syarat
            $('.file-buku-pas-senpi').show();
            $('.file-kta').show();
            $('.file-ktp').show();
            $('.file-foto-46').show();

            // hide
            $('.file-sba-penitipan-senpi').hide();
            $('.file-si-impor-senjata').hide();
            $('.file-surat-hibah-senpi').hide();
            $('.file-foto-senjata').hide();
            $('.file-sertif-menembak').hide();
            $('.file-skck').hide();
            $('.file-surat-sehat').hide();
            $('.file-tes-psikotes').hide();
            $('.file-kk').hide();
            $('.file-foto-23').hide();
            $('.file-foto-34').hide();

        } else if (letter == 2) {
            $('.input-option').show();
            $('.input-pemohon').show();
            $('.input-firearm').show();
            // syarat
            $('.file-surat-hibah-senpi').show();
            $('.file-buku-pas-senpi').show();
            $('.file-foto-senjata').show();
            $('.file-kta').show();
            $('.file-ktp').show();
            $('.file-sertif-menembak').show();
            $('.file-skck').show();
            $('.file-surat-sehat').show();
            $('.file-tes-psikotes').show();
            $('.file-kk').show();
            $('.file-foto-23').show();
            $('.file-foto-34').show();
            $('.file-foto-46').show();

            // hide
            $('.file-sba-penitipan-senpi').hide();
            $('.file-si-impor-senjata').hide();

        } else if (letter == 4) {
            $('.input-option').show();
            $('.input-pemohon').show();
            $('.input-firearm').show();
            // syarat
            $('.file-sba-penitipan-senpi').show();
            $('.file-si-impor-senjata').show();
            $('.file-kta').show();
            $('.file-ktp').show();
            $('.file-sertif-menembak').show();
            $('.file-skck').show();
            $('.file-surat-sehat').show();
            $('.file-tes-psikotes').show();
            $('.file-kk').show();
            $('.file-foto-23').show();
            $('.file-foto-34').show();
            $('.file-foto-46').show();

            // hide
            $('.file-surat-hibah-senpi').hide();
            $('.file-buku-pas-senpi').hide();
            $('.file-foto-senjata').hide();

        } else if (letter == 5) {
            $('.input-option').show();
            $('.input-pemohon').show();
            $('.input-firearm').show();
            // syarat
            $('.file-kta').show();
            $('.file-buku-pas-senpi').show();

            // hide
            $('.file-sba-penitipan-senpi').hide();
            $('.file-si-impor-senjata').hide();
            $('.file-ktp').hide();
            $('.file-sertif-menembak').hide();
            $('.file-skck').hide();
            $('.file-surat-sehat').hide();
            $('.file-tes-psikotes').hide();
            $('.file-kk').hide();
            $('.file-foto-23').hide();
            $('.file-foto-34').hide();
            $('.file-foto-46').hide();
            $('.file-surat-hibah-senpi').hide();
            $('.file-foto-senjata').hide();

        } else if (letter == 10) {
            $('.input-option').show();
            $('.input-pemohon').show();
            $('.input-firearm').show();
            // syarat
            $('.file-buku-pas-senpi').show();
            $('.file-kta').show();
            $('.file-ktp').show()
            $('.file-foto-46').show();

            // hide
            $('.file-sba-penitipan-senpi').hide();
            $('.file-si-impor-senjata').hide();
            $('.file-surat-hibah-senpi').hide();
            $('.file-foto-senjata').hide();
            $('.file-sertif-menembak').hide();
            $('.file-skck').hide();
            $('.file-surat-sehat').hide();
            $('.file-tes-psikotes').hide();
            $('.file-kk').hide();
            $('.file-foto-23').hide();
            $('.file-foto-34').hide();

        } else {
            $('.download').hide();
            $('.input-option').hide();

            $('.input-pemohon').hide();
            $('.input-firearm').hide();
            // syarat
            $('.file-sba-penitipan-senpi').hide();
            $('.file-si-impor-senjata').hide();
            $('.file-surat-hibah-senpi').hide();
            $('.file-buku-pas-senpi').hide();
            $('.file-foto-senjata').hide();
            $('.file-kta').hide();
            $('.file-ktp').hide();
            $('.file-sertif-menembak').hide();
            $('.file-skck').hide();
            $('.file-surat-sehat').hide();
            $('.file-tes-psikotes').hide();
            $('.file-kk').hide();
            $('.file-foto-23').hide();
            $('.file-foto-34').hide();
            $('.file-foto-46').hide();
        }
    });
    $("#name").keyup(function () {
        let name = $("#name").val();
        $('#nama_pemilik').val(name);
        $('#pemohon').val(name);
    });

    // add data
    $('.btnAdd').click(function () {
        document.getElementById("addForm").reset();

        $('.download').hide();
        $('.input-option').hide();

        $('.input-pemohon').hide();
        $('.input-firearm').hide();
        // syarat
        $('.file-sba-penitipan-senpi').hide();
        $('.file-si-impor-senjata').hide();
        $('.file-surat-hibah-senpi').hide();
        $('.file-buku-pas-senpi').hide();
        $('.file-foto-senjata').hide();
        $('.file-kta').hide();
        $('.file-ktp').hide();
        $('.file-sertif-menembak').hide();
        $('.file-skck').hide();
        $('.file-surat-sehat').hide();
        $('.file-tes-psikotes').hide();
        $('.file-kk').hide();
        $('.file-foto-23').hide();
        $('.file-foto-34').hide();
        $('.file-foto-46').hide();


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
            letter_place: "required",
            letter_category_id: "required",
            letter_place: "required",
            letter_date: "required",
            name: "required",
            place_of_birth: "required",
            date_of_birth: "required",
            occupation: "required",
            address: "required",
            club: "required",
            no_kta: "required",
            membership: "required",
            firearm_category_id: "required",
            merek: "required",
            kaliber: "required",
            no_pabrik: "required",
            no_buku_pas_senpi: "required",
            nama_pemilik: "required",
            jumlah: "required",
            penyimpanan: "required",
            pemohon: "required",
        },
        messages: {
            letter_category_id: "Jenis surat rekomendasi harus dipilih",
            letter_place: "Alamat Surat tidak boleh kosong",
            letter_category_id: "Field tidak boleh kosong",
            letter_place: "Field tidak boleh kosong",
            letter_date: "Field tidak boleh kosong",
            name: "Field tidak boleh kosong",
            place_of_birth: "Field tidak boleh kosong",
            date_of_birth: "Field tidak boleh kosong",
            occupation: "Field tidak boleh kosong",
            address: "Field tidak boleh kosong",
            club: "Field tidak boleh kosong",
            no_kta: "Field tidak boleh kosong",
            membership: "Field tidak boleh kosong",
            firearm_category_id: "Field tidak boleh kosong",
            merek: "Field tidak boleh kosong",
            kaliber: "Field tidak boleh kosong",
            no_pabrik: "Field tidak boleh kosong",
            no_buku_pas_senpi: "Field tidak boleh kosong",
            nama_pemilik: "Field tidak boleh kosong",
            jumlah: "Field tidak boleh kosong",
            penyimpanan: "Field tidak boleh kosong",
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
