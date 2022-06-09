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
                        <h3 class="h3">Daftar Surat Rekomendasi</h3>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb" class="float-right">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/dashboard">
                                        <i data-feather="home" width="16" height="16" class="me-2">
                                        </i></a>
                                </li>
                                <li class="breadcrumb-item"><a disabled>Rekomendasi</a></li>
                                <li class="breadcrumb-item active"><a href="#">Surat Rekomendasi</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- <div class="addData mb-3">
                    <a href="javascript:void(0)" class="btn btn-success btnAdd">
                        <i data-feather="plus" width="16" height="16" class="me-2"></i>
                        Tambah Pengajuan Surat Rekomendasi
                    </a>
                </div> --}}
                <div class="table-responsive">
                    <table class="table table-striped card-table table-hover text-nowrap table-data">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Klub</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                @php
                                if (Auth::user()->group_id == 1 || Auth::user()->group_id == 4) {
                                echo '<th>Admin</th>';
                                echo '<th>Sekum</th>';
                                echo '<th>Ketua</th>';
                                }elseif (Auth::user()->group_id == 2){
                                echo '<th>Admin</th>';
                                }elseif(Auth::user()->group_id == 3){
                                echo '<th>Admin</th>';
                                echo '<th>Sekum</th>';
                                }
                                @endphp
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
                                    $letter_status = 'Pengajuan Baru';
                                    $class = 'badge badge-success';
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
                                @php
                                if (Auth::user()->group_id == 1) {
                                echo '<td>';
                                    echo '<select class="form-control" id="letter_approval_admin"
                                        name="letter_status_approval_admin" data-id="'.$letter->letter_id.'"
                                        data-user="admin">
                                        <option value="" selected>Update Status</option>
                                        <option data-value="1" value="1">Terima</option>
                                        <option data-value="2" value="2">Tolak</option>
                                    </select>';
                                    echo '</td>';
                                echo '<td>';
                                    echo '<select class="form-control" id="letter_approval_sekum"
                                        name="letter_status_approval_sekum" data-id="'.$letter->letter_id.'"
                                        data-user="sekum">
                                        <option value="" selected>Update Status</option>
                                        <option value="1">Terima</option>
                                        <option value="2">Tolak</option>
                                    </select>';
                                    echo '</td>';
                                echo '<td>';
                                    echo '<select class="form-control" id="letter_approval_ketua"
                                        name="letter_status_approval_ketua" data-id="'.$letter->letter_id.'"
                                        data-user="ketua">
                                        <option value="" selected>Update Status</option>
                                        <option value="1">Terima</option>
                                        <option value="2">Tolak</option>
                                    </select>';
                                    echo '</td>';
                                }elseif(Auth::user()->group_id == 4){
                                echo '<td>';
                                    $status = $letter->admin_status;

                                    if($status == 1){
                                    $admin_status = 'Pengajuan Baru';
                                    $class = 'badge badge-success';
                                    }elseif($status == 2){
                                    $admin_status = 'Diproses';
                                    $class = 'badge badge-warning';
                                    }elseif($status == 3){
                                    $admin_status = 'Diterima';
                                    $class = 'badge badge-success';
                                    }else {
                                    $admin_status = 'Ditolak';
                                    $class = 'badge badge-danger';
                                    }
                                    echo '<span class="'. $class .'">'. $admin_status .'</span>';
                                    echo '</td>';
                                echo '<td>';
                                    $status = $letter->sekum_status;
                                    if($status == 1){
                                    $sekum_status = 'Pengajuan Baru';
                                    $class = 'badge badge-success';
                                    }elseif($status == 2){
                                    $sekum_status = 'Diproses';
                                    $class = 'badge badge-warning';
                                    }elseif($status == 3){
                                    $sekum_status = 'Diterima';
                                    $class = 'badge badge-success';
                                    }else {
                                    $sekum_status = 'Ditolak';
                                    $class = 'badge badge-danger';
                                    }
                                    echo '<span class="'. $class .'">'. $sekum_status .'</span>';
                                    echo '</td>';
                                echo '<td>';
                                    echo '<select class="form-control" id="letter_approval_ketua"
                                        name="letter_status_approval_ketua" data-id="'.$letter->letter_id.'"
                                        data-user="ketua">
                                        <option value="" selected>Update Status</option>
                                        <option value="1">Terima</option>
                                        <option value="2">Tolak</option>
                                    </select>';
                                    echo '</td>';
                                }elseif (Auth::user()->group_id == 2){
                                echo '<td>';
                                    echo '<select class="form-control" id="letter_approval_admin"
                                        name="letter_status_approval_admin" data-id="'.$letter->letter_id.'"
                                        data-user="admin">
                                        <option value="" selected>Update Status</option>
                                        <option value="1">Terima</option>
                                        <option value="2">Tolak</option>
                                    </select>';
                                    echo '</td>';
                                }elseif(Auth::user()->group_id == 3){
                                echo '<td>';
                                    $status = $letter->admin_status;

                                    if($status == 1){
                                    $admin_status = 'Pengajuan Baru';
                                    $class = 'badge badge-success';
                                    }elseif($status == 2){
                                    $admin_status = 'Diproses';
                                    $class = 'badge badge-warning';
                                    }elseif($status == 3){
                                    $admin_status = 'Diterima';
                                    $class = 'badge badge-success';
                                    }else {
                                    $admin_status = 'Ditolak';
                                    $class = 'badge badge-danger';
                                    }
                                    echo '<span class="'. $class .'">'. $admin_status .'</span>';
                                    echo '</td>';
                                echo '<td>';
                                    echo '<select class="form-control" id="letter_approval_sekum"
                                        name="letter_status_approval_sekum" data-id="'.$letter->letter_id.'"
                                        data-user="sekum">
                                        <option value="" selected>Update Status</option>
                                        <option value="1">Terima</option>
                                        <option value="2">Tolak</option>
                                    </select>';
                                    echo '</td>';
                                }
                                @endphp

                                <td>
                                    @if($letter->letter_id > 0)
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
                                    </a> --}}
                                    {{-- <a href="javascript:void(0)" class="btn btn-icon btnEdit btn-outline-warning"
                                        data-id="{{ $letter->letter_id }}" data-toggle="tooltip" data-placement="top"
                                    title="Ubah">
                                    <i data-feather="edit" width="16" height="16"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger btnDelete"
                                        data-url="{{ url('recomendationletterapproval/delete/'. $letter->letter_id) }}"
                                        data-toggle="tooltip" data-placement="top" title="Hapus">
                                        <i data-feather="trash-2" width="16" height="16"></i>
                                    </a> --}}
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
            <form action="{{ url('recomendationletterapproval/store') }}" method="POST" id="addForm">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Jenis Surat Rekomendasi</label>
                                    <select class="form-control" name="letter_category_id" id="letter_category_id">
                                        <option value="">- Pilih Jenis Surat Rekomendasi -</option>
                                        @if(sizeof($letter_categories) > 0)
                                        @foreach($letter_categories as $letter_category)
                                        <option value="{{ $letter_category->letter_category_id }}">
                                            {{ $letter_category->letter_category_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tempat Surat<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="letter_place" id="letter_place"
                                        placeholder="Masukan tempat surat">
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 1 Pemohon</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="name" id="name"
                                        placeholder="Masukan nama">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="place_of_birth" id="place_of_birth"
                                        placeholder="Masukan tempat lahir">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                                        placeholder="Masukan tanggal lahir">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Pekerjaan / Jabatan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="occupation" id="occupation"
                                        placeholder="Masukan pekerjaan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Alamat<span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="address" id="address"
                                        placeholder="Masukan alamat">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Klub / Perkumpulan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="club" id="club"
                                        placeholder="Masukan klub / perkumupulan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nomor KTA PB-Perbakin <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_kta" id="no_kta"
                                        placeholder="Masukan nomor KTA PB-Perbakin" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Keanggotaan Cabang <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="membership" id="membership"
                                        placeholder="Masukan keanggotaan cabang">
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 2 Keterangan</span>
                            </div>
                            <div class="col-md-6 mb-3">
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
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Merek <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="merek" id="merek"
                                        placeholder="Masukan merek">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Kaliber <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="kaliber" id="kaliber"
                                        placeholder="Masukan kaliber">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nomor Pebrik <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_pabrik" id="no_pabrik"
                                        placeholder="Masukan nomor pabrik">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nomor Buku Pas Senpi <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_buku_pas_senpi"
                                        id="no_buku_pas_senpi" placeholder="Masukan nomor buku pas senpi">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nama Pemilik <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="nama_pemilik" id="nama_pemilik"
                                        placeholder="Masukan nama pemilik">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="jumlah" id="jumlah"
                                        placeholder="Masukan jumlah">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Penyimpanan / Gudang<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="penyimpanan" id="penyimpanan"
                                        placeholder="Masukan penyimpanan / gudang">
                                </div>
                            </div>

                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 3 Persyaratan</span>
                            </div>

                            <div class="col-md-6 mb-3 option-2">
                                <label class="col-sm-12 col-form-label">Pilih Surat Pernyataan Hibah Senpi</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_surat_pernyataan"
                                            id="file_surat_pernyataan" name="file_surat_pernyataan">
                                        <label class="custom-file-label" for="file_surat_pernyataan"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_surat_pernyataan'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 option-1">
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
                            <div class="col-md-6 mb-3 option-2">
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
                            <div class="col-md-6 mb-3 option-1">
                                <label class="col-sm-12 col-form-label">Pilih KTA Perbakin</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_kta_perbakin"
                                            id="file_kta_perbakin" name="file_kta_perbakin">
                                        <label class="custom-file-label" for="file_kta_perbakin"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_kta_perbakin'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (jpg/jpeg/png) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 option-1">
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
                            <div class="col-md-6 mb-3 option-2">
                                <label class="col-sm-12 col-form-label">Pilih Sertifikat Lulus Penataran Menembak
                                    Perbakin Bid Berburu / Reaksi </label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_sertifikat"
                                            id="file_sertifikat" name="file_sertifikat">
                                        <label class="custom-file-label" for="file_sertifikat" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_sertifikat'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 option-2">
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
                            <div class="col-md-6 mb-3 option-2">
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
                            <div class="col-md-6 mb-3 option-2">
                                <label class="col-sm-12 col-form-label">Pilih Hasil lulus Tes Psikotes dari
                                    Kepolisian/Polda</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_hasil_psikotes"
                                            id="file_hasil_psikotes" name="file_hasil_psikotes">
                                        <label class="custom-file-label" for="file_hasil_psikotes"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_hasil_psikotes'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 option-2">
                                <label class="col-sm-12 col-form-label">Pilih Kartu Keluarga</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_kartu_keluarga"
                                            id="file_kartu_keluarga" name="file_kartu_keluarga">
                                        <label class="custom-file-label" for="file_kartu_keluarga"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_kartu_keluarga'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 option-2">
                                <label class="col-sm-12 col-form-label">Pilih Pas Foto (Latar Merah)</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_pas_foto_23"
                                            id="file_pas_foto_23" name="file_pas_foto_23">
                                        <label class="custom-file-label" for="file_pas_foto_23" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_pas_foto_23'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 option-2">
                                <label class="col-sm-12 col-form-label">Pilih Pas Foto 3x4 (Latar Merah) </label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_pas_foto_34"
                                            id="file_pas_foto_34" name="file_pas_foto_34">
                                        <label class="custom-file-label" for="file_pas_foto_34" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_pas_foto_34'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 option-1">
                                <label class="col-sm-12 col-form-label">Pilih Pas Foto 4x6 (Latar Merah) </label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_pas_foto_46"
                                            id="file_pas_foto_46" name="file_pas_foto_46">
                                        <label class="custom-file-label" for="file_pas_foto_46" data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_pas_foto_46'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf/doc/docx) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 4 Pemohon</span>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Pemohon<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="pemohon" id="pemohon"
                                        placeholder="Masukan pemohon">
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

{{-- Reject Letter Modal --}}
<div class="modal fade rejectLetter" id="rejectLetter" tabindex="-1" role="dialog" aria-labelledby="rejectLetterLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectLetterLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('recomendationletterapproval/updatestatus') }}" method="POST"
                    id="rejectLetterForm">
                    <fieldset class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="hidden" id="letter-id">
                                <input type="hidden" id="data-user">
                                <input type="hidden" id="data-status-code">
                                <legend class="col-form-label col-sm-5 pt-0"><strong>Pilih Catatan Penolakan</strong>
                                </legend>
                                <div class="form-check">
                                    <input class="form-check-input rejectCheckbox" name="checkedData" type="checkbox"
                                        value="Kelengkapan persyaratan surat permohonan" id="reject-note-1">
                                    <label class="form-check-label" for="reject-note-1">
                                        Kelengkapan persyaratan surat permohonan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input rejectCheckbox" name="checkedData" type="checkbox"
                                        value="Kelengkapan identitas pemohon surat" id="reject-note-2">
                                    <label class="form-check-label" for="reject-note-2">
                                        Kelengkapan identitas pemohon surat
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group">
                        <label for="reject-note-other">Catatan penolakan lain</label>
                        <textarea class="form-control" id="reject-note-other" rows="3"
                            placeholder="Masukan catatan lain"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="rejectLetterFormSubmit">Tolak Pengajuan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- End Reject Letter Modal --}}

@endsection

@section('script')
<script type="text/javascript">
    // set option persyaratan file
    $('#letter_category_id').change(function () {
        let letter = $('#letter_category_id').val();
        if (letter == 1) {
            $('.option-1').show();
        } else {
            $('.option-1').show();
            $('.option-2').show();
        }
    });
    $("#name").keyup(function () {
        let name = $("#name").val();
        $('#nama_pemilik').val(name);
        $('#pemohon').val(name);
    });

    $('#letter_approval_admin').change(function () {
        let id = $(this).attr('data-id');
        let user = $(this).attr('data-user');
        let status = $('#letter_approval_admin').val();
        let url = "{{ url('recomendationletterapproval/updatestatus') }}" + '/' + id;
        if (status == 1) {
            Swal.fire({
                title: 'Ubah Status?',
                text: "Apakah anda yakin ingin mengubah status surat?",
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
                            status: user,
                            status_code: status,
                            _token: '{{csrf_token()}}'
                        },
                        url: url,
                        success: function (data) {
                            console.log(data);
                            if (data.status == 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Update berhasil!',
                                    text: data.messages,
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Update gagal!',
                                    text: data.messages,
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                                location.reload();
                            }
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
        } else if (status == 2) {
            $('#letter-id').val(id);
            $('#data-user').val(user);
            $('#data-status-code').val(status);
            $('.rejectLetter .modal-title').text('Tolak Pengajuan Surat Rekomendasi');
            $('.rejectLetter').modal('show');
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Update gagal!',
                text: 'Status gagal diupdate!',
                showConfirmButton: false,
                timer: 2000
            })
            location.reload();
        }
    });

    $('#letter_approval_sekum').change(function () {
        let id = $(this).attr('data-id');
        let user = $(this).attr('data-user');
        let status = $('#letter_approval_sekum').val();
        let url = "{{ url('recomendationletterapproval/updatestatus') }}" + '/' + id;
        if (status == 1) {
            Swal.fire({
                title: 'Ubah Status?',
                text: "Apakah anda yakin ingin mengubah status surat?",
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
                            status: user,
                            status_code: status,
                            _token: '{{csrf_token()}}'
                        },
                        url: url,
                        success: function (data) {

                            if (data.status == 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Update berhasil!',
                                    text: data.messages,
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Update gagal!',
                                    text: data.messages,
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                                location.reload();
                            }
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
        } else if (status == 2) {
            $('#letter-id').val(id);
            $('#data-user').val(user);
            $('#data-status-code').val(status);
            $('.rejectLetter .modal-title').text('Tolak Pengajuan Surat Rekomendasi');
            $('.rejectLetter').modal('show');
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Update gagal!',
                text: 'Status gagal diupdate!',
                showConfirmButton: false,
                timer: 2000
            })
            location.reload();
        }
    });

    $('#letter_approval_ketua').change(function () {
        let id = $(this).attr('data-id');
        let user = $(this).attr('data-user');
        let status = $('#letter_approval_ketua').val();
        let url = "{{ url('recomendationletterapproval/updatestatus') }}" + '/' + id;
        if (status == 1) {
            Swal.fire({
                title: 'Ubah Status?',
                text: "Apakah anda yakin ingin mengubah status surat?",
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
                            status: user,
                            status_code: status,
                            _token: '{{csrf_token()}}'
                        },
                        url: url,
                        success: function (data) {

                            if (data.status == 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Update berhasil!',
                                    text: data.messages,
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Update gagal!',
                                    text: data.messages,
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                                location.reload();
                            }
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
        } else if (status == 2) {
            $('#letter-id').val(id);
            $('#data-user').val(user);
            $('#data-status-code').val(status);
            $('.rejectLetter .modal-title').text('Tolak Pengajuan Surat Rekomendasi');
            $('.rejectLetter').modal('show');
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Update gagal!',
                text: 'Status gagal diupdate!',
                showConfirmButton: false,
                timer: 2000
            })
            location.reload();
        }
    });

    $("#rejectLetterFormSubmit").click(function () {

        let id = $('#letter-id').val();
        let user = $('#data-user').val();
        let status = $('#data-status-code').val();
        let url = "{{ url('recomendationletterapproval/updatestatus') }}" + '/' + id;
        let otherNote = $('#reject-note-other').val();

        let checkboxes = document.querySelectorAll('input[name="checkedData"]:checked');
        let checkNote = [];
        checkboxes.forEach((checkbox) => {
            checkNote.push(checkbox.value);
        });

        if (checkNote.length == 0 && otherNote == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Tambahkan Catatan',
                text: 'Pilih atau Tambahkan catatan penolakan!',
            });
        } else {
            $.ajax({
                type: 'POST',
                data: {
                    status: user,
                    status_code: status,
                    checkbox: checkNote,
                    other_note: otherNote,
                    _token: '{{csrf_token()}}'
                },
                url: url,
                success: function (data) {
                    if (data.status == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Update berhasil!',
                            text: data.messages,
                            showConfirmButton: false,
                            timer: 2000
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Update gagal!',
                            text: data.messages,
                            showConfirmButton: false,
                            timer: 2000
                        })
                        location.reload();
                    }
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
            });
        }
    });

    // add data 
    $('.btnAdd').click(function () {

        $('.option-1').hide();
        $('.option-2').hide();
        document.getElementById("addForm").reset();
        $('.addModal form').attr('action', "{{ url('recomendationletterapproval/store') }}");
        $('.addModal .modal-title').text('Tambah pengajuan surat rekomendasi');
        $('.addModal').modal('show');
    });

    // check error
    @if(count($errors))
    $('.addModal').modal('show');
    @endif

    $('.btnEdit').click(function () {

        var id = $(this).attr('data-id');
        var url = "{{ url('recomendationletterapproval/getdata') }}";

        $('.addModal form').attr('action', "{{ url('recomendationletterapproval/update') }}" + '/' + id);

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
        },
        messages: {
            letter_category_id: "Jenis surat rekomendasi harus dipilih",
            letter_place: "Alamat Surat tidak boleh kosong",
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
