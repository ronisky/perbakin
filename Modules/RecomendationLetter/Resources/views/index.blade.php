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
                </div>
                <div class="table-responsive">
                    <table class="table table-striped card-table table-hover text-nowrap table-data">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Pengaju</th>
                                <th>Klub asal</th>
                                <th>Tanggal pengajuan</th>
                                <th>Kategori Surat</th>
                                <th>Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (sizeof($letters) == 0)
                            <tr>
                                <td colspan="7" align="center">Data kosong</td>
                            </tr>
                            @else
                            @foreach ($letters as $letter)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $letter->name }}</td>
                                <td title="{{ $letter->club}}">
                                    @php
                                    $clubName = substr( $letter->club, 0, 10);
                                    @endphp
                                    {{ $clubName }}
                                </td>
                                <td>{{ $letter->created_at }}</td>
                                <td title="{{ $letter->letter_category_name}}">
                                    @php
                                    $categoryName = substr( $letter->letter_category_name, 0, 15);
                                    @endphp
                                    {{ $letter->letter_category_id }} - {{$categoryName}}
                                </td>
                                <td>
                                    <span class="{{ $letter->style_class }}">{{ $letter->approval_status }}</span>
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
                                    <a href="javascript:void(0)" class="btn btn-icon btnDetail btn-outline-info"
                                        data-id="{{ $letter->letter_id }}" data-toggle="tooltip" data-placement="top"
                                        title="Detail">
                                        <i data-feather="eye" width="16" height="16"></i>
                                    </a>
                                    {{-- <a href="javascript:void(0)" class="btn btn-icon btnEdit btn-outline-warning"
                                        data-id="{{ $letter->letter_id }}" data-toggle="tooltip" data-placement="top"
                                    title="Ubah">
                                    <i data-feather="edit" width="16" height="16"></i>
                                    </a> --}}
                                    {{-- <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger btnDelete"
                                        data-url="{{ url('recomendationletter/delete/'. $letter->letter_id) }}"
                                    data-toggle="tooltip" data-placement="top" title="Hapus">
                                    <i data-feather="trash-2" width="16" height="16"></i>
                                    </a> --}}
                                    @else
                                    <a href="{{ url('recomendationletter/printletter/'. $letter->letter_id) }}"
                                        target="_blank" class="btn btn-icon btnPrint btn-outline-secondary"
                                        data-id="{{ $letter->letter_id }}" data-toggle="tooltip" data-placement="top"
                                        title="Print">
                                        <i data-feather="printer" width="16" height="16"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btnDetail btn-outline-info"
                                        data-id="{{ $letter->letter_id }}" data-toggle="tooltip" data-placement="top"
                                        title="Detail">
                                        <i data-feather="eye" width="16" height="16"></i>
                                    </a>
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
            <div class="modal-body">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Jenis Surat Rekomendasi</label>
                                    <select class="form-control" name="letter_category_id" id="letter_category_id">
                                        <option value="">- Pilih Jenis Surat Rekomendasi -</option>
                                        @if(sizeof($letter_categories) > 0)
                                        @foreach($letter_categories as $key => $letter_category)
                                        <option value="{{ $letter_category->letter_category_id }}"
                                            data-tag="{{$letter_category->letter_category_name}}">
                                            {{($key + 1).". " .$letter_category->letter_category_name }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4" id="downloadletter"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Add -->

{{-- Start Letter 1 --}}
<div class="modal addModalLetter1 fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah pengajuan surat rekomendasi</h5>
                <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('recomendationletter/store') }}" method="POST" id="addFormLetter1"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-body container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Tempat Surat<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="letter_place" id="letter_place"
                                            placeholder="Masukan tempat surat">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Surat <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="letter_date" id="letter_date"
                                            placeholder="Masukan tanggal surat" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 center">
                                <div class="card sample-letter" style="width: 10rem;">
                                    <a target="_blank" href="{{asset('storage/uploads/sample_letters/sample_6.jpg')}}"
                                        class="text text-sm-center">
                                        <img class="card-img-top"
                                            src="{{asset('storage/uploads/sample_letters/sample_6.jpg')}}" height="auto"
                                            alt="">
                                        Lihat contoh surat</a>
                                </div>
                            </div>

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 1 Pemohon</span>
                            </div>
                            {{-- ================================================================================= --}}
                            <input type="hidden" class="letter_category_id" name="letter_category_id" value="1"
                                id="letter_category_id">
                            {{-- letter1 b1l1--}}
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control name" name="name" id="name"
                                        value="{{ $user->user_name }}" placeholder="Masukan nama">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="place_of_birth" id="place_of_birth"
                                        value="{{ $user->place_of_birth }}" placeholder="Masukan tempat lahir">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                                        value="{{ $user->date_of_birth }}" placeholder="Masukan tanggal lahir">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Pekerjaan / Jabatan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="occupation" id="occupation"
                                        value="{{ $user->occupation }}" placeholder="Masukan pekerjaan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Alamat<span class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="address" id="address"
                                        value="{{ $user->user_address }}" placeholder="Masukan alamat">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Klub / Perkumpulan <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="club" id="club"
                                        value="{{ $user->club_name }}" placeholder="Masukan klub / perkumupulan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Nomor KTA PB-Perbakin <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="no_kta" id="no_kta"
                                        placeholder="Masukan nomor KTA PB-Perbakin" value="{{ $user->user_kta }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Keanggotaan Cabang <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" name="membership" id="membership"
                                        value="{{ $user->user_club_cab }}" placeholder="Masukan keanggotaan cabang">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Pindah / Mutasi dari <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="mutasi_dari" id="mutasi_dari"
                                        placeholder="Masasukan mutasi dari">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Cabang Klub Tujuan<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="l9_cabang" id="l9_cabang"
                                        placeholder="Masasukan mutasi tujuan">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Alasan Pindah/ Mutasi<span
                                            class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control" name="mutasi_alasan" id="mutasi_alasan"
                                        rows="5"
                                        placeholder="Alasan mutasi">{{ old('mutasi_alasan') }}agar lebih dekat dengan tempat tinggal, memudahkan dalam mengkoordinir Izin angkut Senjata dan mengikuti Program Kerja Perbakin Kab. Bandung Th.2021 -2022.</textarea>
                                </div>
                            </div>
                            {{-- end letter1 b1l1 --}}

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 2 Keterangan</span>
                            </div>
                            {{-- ================================================================================= --}}

                            {{-- letter1 b2l1 --}}
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Jenis Senjata</label>
                                    <select class="form-control letter1" name="firearm_category_id"
                                        id="firearm_category_id">
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
                                        placeholder="Masukan merek">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Kaliber <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control letter1" name="kaliber" id="kaliber"
                                        placeholder="Masukan kaliber">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Nomor Pebrik <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control letter1" name="no_pabrik" id="no_pabrik"
                                        placeholder="Masukan nomor pabrik">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Nomor Buku Pas Senpi <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control letter1" name="no_buku_pas_senpi"
                                        id="no_buku_pas_senpi" placeholder="Masukan nomor buku pas senpi">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Nama Pemilik <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control nama_pemilik" name="nama_pemilik"
                                        id="nama_pemilik" placeholder="Masukan nama pemilik">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control letter1" name="jumlah" id="jumlah"
                                        placeholder="Masukan jumlah">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Penyimpanan/ Gudang<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control letter1" name="penyimpanan" id="penyimpanan"
                                        placeholder="Masukan penyimpanan/ gudang">
                                </div>
                            </div>
                            {{-- end letter1 b2l1 --}}

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 3 Persyaratan</span>
                            </div>
                            {{-- ================================================================================= --}}

                            {{-- letter1 b3l1 --}}
                            <div class="col-md-6 mb-3 letter1">
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter1">
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
                            <div class="col-md-6 mb-3 letter1">
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
                            <div class="col-md-6 mb-3 letter1">
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{-- end letter1 b3l1 --}}

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 4 Pemohon</span>
                            </div>
                            {{-- ================================================================================= --}}

                            {{-- letter1 b4l1 --}}
                            <div class="col-md-6 mb-3 letter1">
                                <div class="form-group">
                                    <label class="form-label">Pemohon<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control pemohon" name="pemohon" id="pemohon"
                                        placeholder="Masukan pemohon">
                                </div>
                            </div>
                            {{-- end letter1 b4l1 --}}

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary close-modal"
                        data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class=" modal detailModalLetter1" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail User</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body container">
                <form id="userDetail" name="userDetail">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6 row">
                                <label for="letter_status" class="col-md-5 col-form-label">Status Pengajuan</label>
                                <div id="letter_status_detail1">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="letter_category_name" class="col-md-5 col-form-label">Kategori Surat</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext letter_category_name">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="user_name" class="col-md-5 col-form-label">Nama Pemohon</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext user_name">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="user_kta" class="col-md-5 col-form-label">Nomor KTA</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext user_kta"
                                        value="{{ old('user_kta') }}">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="club_name" class="col-md-5 col-form-label">Nama Club</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext club_name"
                                        value="{{ old('club_name') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_buku_pas_senpi" class="col-md-5 col-form-label">File Buku Pas
                                    Senpi</label>
                                <div class="col-md-6">
                                    <div id="file_buku_pas_senpi_detail1"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_kta" class="col-md-5 col-form-label">File KTA</label>
                                <div class="col-md-6">
                                    <div id="file_kta_detail1"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_ktp" class="col-md-5 col-form-label">File KTP</label>
                                <div class="col-md-6">
                                    <div id="file_ktp_detail1"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_foto_4x6" class="col-md-5 col-form-label">File Foto</label>
                                <div class="col-md-6">
                                    <div id="file_foto_4x6_detail1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- End Letter 1 --}}

{{-- Start Letter 2 --}}
<div class="modal addModalLetter2 fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah pengajuan surat rekomendasi</h5>
                <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('recomendationletter/store') }}" method="POST" id="addFormLetter2"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-body container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Tempat Surat<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="letter_place" id="letter_place"
                                            placeholder="Masukan tempat surat">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Surat <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="letter_date" id="letter_date"
                                            placeholder="Masukan tanggal surat" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 center">
                                <div class="card" style="width: 10rem;">
                                    <a target="_blank"
                                        href="{{ url('assets/img/letters/sample_letters/sample_6.jpg') }}"
                                        class="text text-sm-center">
                                        <img class="card-img-top" src="/assets/img/letters/sample_letters/sample_6.jpg"
                                            height="auto" alt="">
                                        Lihat contoh surat</a>
                                </div>
                            </div>

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 1 Pemohon</span>
                            </div>
                            {{-- ================================================================================= --}}
                            <input type="hidden" class="letter_category_id" name="letter_category_id" value="2"
                                id="letter_category_id">
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
                                        rows="5"
                                        placeholder="Kepentinan ...">{{ old('mutasi_alasan') }}kepentingan  Olahraga Menembak Berburu.</textarea>
                                </div>
                            </div>
                            {{-- end letter2 b1l2--}}

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 2 Keterangan</span>
                            </div>
                            {{-- ================================================================================= --}}

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
                                    <input type="number" class="form-control" name="no_pabrik" id="no_pabrik"
                                        placeholder="Masukan nomor pabrik">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <div class="form-group">
                                    <label class="form-label">Nomor Buku Pas Senpi <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="no_buku_pas_senpi"
                                        id="no_buku_pas_senpi" placeholder="Masukan nomor buku pas senpi">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
                                <div class="form-group">
                                    <label class="form-label">Nama Pemilik <span class="text-danger">*</span></label>
                                    <input type="string" class="form-control nama_pemilik" name="nama_pemilik"
                                        id="nama_pemilik" placeholder="Masukan nama pemilik">
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

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 3 Persyaratan</span>
                            </div>
                            {{-- ================================================================================= --}}

                            {{-- letter2 b3l2 --}}
                            <div class="col-md-6 mb-3 letter2">
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter2">
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{-- end letter2 b3l2 --}}

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 4 Pemohon</span>
                            </div>
                            {{-- ================================================================================= --}}

                            {{-- letter2 b4l2 --}}
                            <div class="col-md-6 mb-3 letter2">
                                <div class="form-group">
                                    <label class="form-label">Pemohon<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="pemohon" id="pemohon"
                                        placeholder="Masukan pemohon">
                                </div>
                            </div>
                            {{-- end letter2 b4l2 --}}

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary close-modal"
                        data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Letter 2 --}}

{{-- Start Letter 3 --}}
<div class="modal addModalLetter3 fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah pengajuan surat rekomendasi</h5>
                <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('recomendationletter/store') }}" method="POST" id="addFormLetter3"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-body container">
                        <div class="row">
                            <div class="col-md-4 center">
                                <div class="card" style="width: 10rem;">
                                    <a target="_blank"
                                        href="{{ url('assets/img/letters/sample_letters/sample_6.jpg') }}"
                                        class="text text-sm-center">
                                        <img class="card-img-top" src="/assets/img/letters/sample_letters/sample_6.jpg"
                                            height="auto" alt="">
                                        Lihat contoh surat</a>
                                </div>
                            </div>

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 1 Pemohon</span>
                            </div>
                            {{-- ================================================================================= --}}
                            <input type="hidden" class="letter_category_id" name="letter_category_id" value="3"
                                id="letter_category_id">
                            {{-- letter3 b1l3 --}}
                            <div class="col-md-12 mb-3 border-bottom border-gray letter3">
                                <span class="font-weight-medium italic">Disebut Pihak I Pemberi Hibah</span>
                            </div>
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">Nama Pemberi Hibah <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control pihak-1" name="name" id="name" value=""
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
                                    <input type="string" class="form-control" name="address" id="address" value=""
                                        placeholder="Masukan alamat">
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

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 2 Keterangan</span>
                            </div>
                            {{-- ================================================================================= --}}

                            {{-- letter3 b2l3 --}}
                            <div class="col-md-12 mb-3 border-bottom border-gray letter3">
                                <span class="font-weight-medium italic">Disebut Pihak II Penerima Hibah</span>
                            </div>
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">Nama Penerima Hibah <span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control pihak-2" name="name2" id="name2" value=""
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
                                    <input type="string" class="form-control" name="address2" id="address2" value=""
                                        placeholder="Masukan alamat">
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

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 3 Persyaratan</span>
                            </div>
                            {{-- ================================================================================= --}}

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
                                    <input type="number" class="form-control" name="no_pabrik" id="no_pabrik"
                                        placeholder="Masukan nomor pabrik">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">Nomor Buku Pas Senpi <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="no_buku_pas_senpi"
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

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 4 Pemohon</span>
                            </div>
                            {{-- ================================================================================= --}}

                            {{-- letter3 b4l3 --}}
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">Penerima Hibah Pihak II<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control pemohon_pihak_2" name="pemohon_pihak_2"
                                        id="pemohon_pihak_2" placeholder="Masukan pemohon pihak 2">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter3">
                                <div class="form-group">
                                    <label class="form-label">Pemberi Hibah/ Menghibahkan/ Pihak I<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control pemohon_pihak_1" name="pemohon" id="pemohon"
                                        placeholder="Masukan pemohon">
                                </div>
                            </div>
                            {{-- end letter3 b4l3 --}}

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary close-modal"
                        data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Letter 3 --}}

{{-- Start Letter 4 --}}
<div class="modal addModalLetter4 fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah pengajuan surat rekomendasi</h5>
                <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('recomendationletter/store') }}" method="POST" id="addFormLetter4"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-body container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Tempat Surat<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="letter_place" id="letter_place"
                                            placeholder="Masukan tempat surat">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Surat <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="letter_date" id="letter_date"
                                            placeholder="Masukan tanggal surat" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 center">
                                <div class="card" style="width: 10rem;">
                                    <a target="_blank"
                                        href="{{ url('assets/img/letters/sample_letters/sample_6.jpg') }}"
                                        class="text text-sm-center">
                                        <img class="card-img-top" src="/assets/img/letters/sample_letters/sample_6.jpg"
                                            height="auto" alt="">
                                        Lihat contoh surat</a>
                                </div>
                            </div>

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 1 Pemohon</span>
                            </div>
                            {{-- ================================================================================= --}}
                            <input type="hidden" class="letter_category_id" name="letter_category_id" value="4"
                                id="letter_category_id">
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
                                        rows="5"
                                        placeholder="Alasan mutasi">{{ old('mutasi_alasan') }}Kepentingan  Olahraga Menembak Berburu/reaksi.</textarea>
                                </div>
                            </div>
                            {{-- end letter4 b1l4 --}}

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 2 Keterangan</span>
                            </div>
                            {{-- ================================================================================= --}}

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
                                    <input type="number" class="form-control" name="no_pabrik" id="no_pabrik"
                                        placeholder="Masukan nomor pabrik">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <div class="form-group">
                                    <label class="form-label">Nomor Buku Pas Senpi <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="no_buku_pas_senpi"
                                        id="no_buku_pas_senpi" placeholder="Masukan nomor buku pas senpi">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter4">
                                <div class="form-group">
                                    <label class="form-label">Nomor SI Impor <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="no_si_impor" id="no_si_impor"
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

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 3 Persyaratan</span>
                            </div>
                            {{-- ================================================================================= --}}

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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{-- end letter4 b3l4 --}}

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 4 Pemohon</span>
                            </div>
                            {{-- ================================================================================= --}}

                            {{-- letter4 b4l4 --}}
                            <div class="col-md-6 mb-3 letter4">
                                <div class="form-group">
                                    <label class="form-label">Pemohon<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control pemohon" name="pemohon" id="pemohon"
                                        placeholder="Masukan pemohon">
                                </div>
                            </div>
                            {{-- end letter4 b4l4 --}}

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary close-modal"
                        data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Letter 4 --}}

{{-- Start Letter 5 --}}
<div class="modal addModalLetter5 fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah pengajuan surat rekomendasi</h5>
                <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('recomendationletter/store') }}" method="POST" id="addFormLetter5"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-body container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Tempat Surat<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="letter_place" id="letter_place"
                                            placeholder="Masukan tempat surat">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Surat <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="letter_date" id="letter_date"
                                            placeholder="Masukan tanggal surat" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 center">
                                <div class="card" style="width: 10rem;">
                                    <a target="_blank"
                                        href="{{ url('assets/img/letters/sample_letters/sample_6.jpg') }}"
                                        class="text text-sm-center">
                                        <img class="card-img-top" src="/assets/img/letters/sample_letters/sample_6.jpg"
                                            height="auto" alt="">
                                        Lihat contoh surat</a>
                                </div>
                            </div>

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 1 Pemohon</span>
                            </div>
                            {{-- ================================================================================= --}}
                            <input type="hidden" class="letter_category_id" name="letter_category_id" value="5"
                                id="letter_category_id">
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

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 2 Keterangan</span>
                            </div>
                            {{-- ================================================================================= --}}

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
                                        rows="5"
                                        placeholder="Berikan keterangan dalam rangka acara/ kegiatan ...">Latihan rutin dan dalam rangka menghadapi PON 2020 Papua</textarea>
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

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 3 Persyaratan</span>
                            </div>
                            {{-- ================================================================================= --}}

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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{-- end letter5 b3l5 --}}

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 4 Pemohon</span>
                            </div>
                            {{-- ================================================================================= --}}

                            {{-- letter5 b4l5 --}}
                            <div class="col-md-6 mb-3 letter5">
                                <div class="form-group">
                                    <label class="form-label">Pemohon<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control pemohon" name="pemohon" id="pemohon"
                                        placeholder="Masukan pemohon">
                                </div>
                            </div>
                            {{-- end letter5 b4l5 --}}

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary close-modal"
                        data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Letter 5 --}}

{{-- Start Letter 6 --}}
<div class="modal addModalLetter6 fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah pengajuan surat rekomendasi</h5>
                <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('recomendationletter/store') }}" method="POST" id="addFormLetter6"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-body container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Tempat Surat<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="letter_place" id="letter_place"
                                            placeholder="Masukan tempat surat">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Surat <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="letter_date" id="letter_date"
                                            placeholder="Masukan tanggal surat" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 center">
                                <div class="card" style="width: 10rem;">
                                    <a target="_blank"
                                        href="{{ url('assets/img/letters/sample_letters/sample_6.jpg') }}"
                                        class="text text-sm-center">
                                        <img class="card-img-top" src="/assets/img/letters/sample_letters/sample_6.jpg"
                                            height="auto" alt="">
                                        Lihat contoh surat</a>
                                </div>
                            </div>

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 1 Pemohon</span>
                            </div>
                            {{-- ================================================================================= --}}
                            <input type="hidden" class="letter_category_id" name="letter_category_id" value="6"
                                id="letter_category_id">
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

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 2 Keterangan</span>
                            </div>
                            {{-- ================================================================================= --}}

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

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 3 Persyaratan</span>
                            </div>
                            {{-- ================================================================================= --}}

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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 letter6">
                                <label class="col-sm-12 col-form-label">Pilih Nama Anggota rombongan dan Senjata Api
                                    yang digunakan</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_nama_anggota_senjata_digunakan"
                                            id="file_nama_anggota_senjata_digunakan"
                                            name="file_nama_anggota_senjata_digunakan">
                                        <label class="custom-file-label" for="file_nama_anggota_senjata_digunakan"
                                            data-browse="Cari">Pilih
                                            file...</label>
                                    </div>
                                    @if ($errors->has('file_nama_anggota_senjata_digunakan'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Pastikan
                                            format
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{-- end letter6 b3l6--}}

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 4 Pemohon</span>
                            </div>
                            {{-- ================================================================================= --}}

                            {{-- letter6 b4l6 --}}
                            <div class="col-md-6 mb-3 letter6">
                                <div class="form-group">
                                    <label class="form-label">Pemohon<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control pemohon" name="pemohon" id="pemohon"
                                        placeholder="Masukan pemohon">
                                </div>
                            </div>
                            {{-- end letter6 b4l6 --}}

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary close-modal"
                        data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Letter 6 --}}

{{-- Start Letter 7 --}}
<div class="modal addModalLetter7 fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah pengajuan surat rekomendasi</h5>
                <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('recomendationletter/store') }}" method="POST" id="addFormLetter7"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-body container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Tempat Surat<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="letter_place" id="letter_place"
                                            placeholder="Masukan tempat surat">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Surat <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="letter_date" id="letter_date"
                                            placeholder="Masukan tanggal surat" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 center">
                                <div class="card" style="width: 10rem;">
                                    <a target="_blank"
                                        href="{{ url('assets/img/letters/sample_letters/sample_6.jpg') }}"
                                        class="text text-sm-center">
                                        <img class="card-img-top" src="/assets/img/letters/sample_letters/sample_6.jpg"
                                            height="auto" alt="">
                                        Lihat contoh surat</a>
                                </div>
                            </div>

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 1 Pemohon</span>
                            </div>
                            {{-- ================================================================================= --}}
                            <input type="hidden" class="letter_category_id" name="letter_category_id" value="7"
                                id="letter_category_id">
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

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 2 Keterangan</span>
                            </div>
                            {{-- ================================================================================= --}}

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
                                        placeholder="Berikan alasan Pengunduran diri">{{ old('l7_alasan_pengunduran') }}</textarea>
                                </div>
                            </div>
                            {{-- end letter7 b2l7--}}

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 3 Persyaratan</span>
                            </div>
                            {{-- ================================================================================= --}}

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

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 4 Pemohon</span>
                            </div>
                            {{-- ================================================================================= --}}

                            {{-- letter7 b4l7 --}}
                            <div class="col-md-6 mb-3 letter7">
                                <div class="form-group">
                                    <label class="form-label">Pemohon<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control pemohon" name="pemohon" id="pemohon"
                                        placeholder="Masukan pemohon">
                                </div>
                            </div>
                            {{-- end letter7 b4l7 --}}

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary close-modal"
                        data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Letter 7 --}}

{{-- Start letter 8 --}}
<div class="modal addModalLetter8 fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah pengajuan surat rekomendasi</h5>
                <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('recomendationletter/store') }}" method="POST" id="addFormLetter8"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-body container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Tempat Surat<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="letter_place" id="letter_place"
                                            placeholder="Masukan tempat surat">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Surat <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="letter_date" id="letter_date"
                                            placeholder="Masukan tanggal surat" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 center">
                                <div class="card" style="width: 10rem;">
                                    <a target="_blank"
                                        href="{{ url('assets/img/letters/sample_letters/sample_6.jpg') }}"
                                        class="text text-sm-center">
                                        <img class="card-img-top" src="/assets/img/letters/sample_letters/sample_6.jpg"
                                            height="auto" alt="">
                                        Lihat contoh surat</a>
                                </div>
                            </div>

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 1 Pemohon</span>
                            </div>
                            {{-- ================================================================================= --}}
                            <input type="hidden" class="letter_category_id" name="letter_category_id" value="8"
                                id="letter_category_id">
                            {{-- letter8 b1l8 --}}
                            <div class="col-md-12 mb-3 letter8">
                                <div class="form-group">
                                    <label class="form-label">Dasar AD/ART<span class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control" name="dasar_adart" id="dasar_adart"
                                        rows="5"
                                        placeholder="Masukan Dasar AD/ART">AD/ART Perbakin Tahun 2019 BAB IV Keanggotaan Bagian Kesatu Keanggotaan  Pasal 9 ,ART BAB II Pasal 4 dan 5  dan ART Lampiran VIII halaman 48 Susunan Organisasi Klub Menembak.</textarea>
                                </div>
                            </div>
                            {{-- end letter8 b1l8 --}}

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 2 Keterangan</span>
                            </div>
                            {{-- ================================================================================= --}}

                            {{-- letter8 b2l8--}}
                            <div class="col-md-12 mb-3 letter8">
                                <div class="form-group">
                                    <label class="form-label">Sehubungan dasar tersebut diatas, diajukan permohonan
                                        pengesahan/pendirian Klub Menembak di wilayah Kabupaten Bandung</label>
                                </div>
                            </div>
                            {{-- end letter8 b2l8--}}

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 3 Persyaratan</span>
                            </div>
                            {{-- ================================================================================= --}}

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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{-- end letter8 b3l8 --}}

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 4 Pemohon</span>
                            </div>
                            {{-- ================================================================================= --}}

                            {{-- letter8 b4l8 --}}
                            <div class="col-md-6 mb-3 letter8">
                                <div class="form-group">
                                    <label class="form-label">Pemohon<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control pemohon" name="pemohon" id="pemohon"
                                        placeholder="Masukan pemohon">
                                </div>
                            </div>
                            {{-- end letter8 b4l8 --}}

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary close-modal"
                        data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End letter 8 --}}

{{-- Start letter 9 --}}
<div class="modal addModalLetter9 fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah pengajuan surat rekomendasi</h5>
                <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('recomendationletter/store') }}" method="POST" id="addFormLetter9"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-body container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Tempat Surat<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="letter_place" id="letter_place"
                                            placeholder="Masukan tempat surat">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Surat <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="letter_date" id="letter_date"
                                            placeholder="Masukan tanggal surat" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 center">
                                <div class="card" style="width: 10rem;">
                                    <a target="_blank"
                                        href="{{ url('assets/img/letters/sample_letters/sample_6.jpg') }}"
                                        class="text text-sm-center">
                                        <img class="card-img-top" src="/assets/img/letters/sample_letters/sample_6.jpg"
                                            height="auto" alt="">
                                        Lihat contoh surat</a>
                                </div>
                            </div>

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 1 Pemohon</span>
                            </div>
                            {{-- ================================================================================= --}}
                            <input type="hidden" class="letter_category_id" name="letter_category_id" value="9"
                                id="letter_category_id">
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

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 2 Keterangan</span>
                            </div>
                            {{-- ================================================================================= --}}

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
                                        rows="5" placeholder="Dikarenakan ...">{{ old('mutasi_alasan') }}</textarea>
                                </div>
                            </div>
                            {{-- end letter9 b2l9 --}}

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 3 Persyaratan</span>
                            </div>
                            {{-- ================================================================================= --}}

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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{-- end letter9 b3l9 --}}

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 4 Pemohon</span>
                            </div>
                            {{-- ================================================================================= --}}

                            {{-- letter9 b4l9 --}}
                            <div class="col-md-6 mb-3 letter9">
                                <div class="form-group">
                                    <label class="form-label">Pemohon<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control pemohon" name="pemohon" id="pemohon"
                                        placeholder="Masukan pemohon">
                                </div>
                            </div>
                            {{-- end letter9 b4l9 --}}

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary close-modal"
                        data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End letter 9 --}}

{{-- Start letter 10 --}}
<div class="modal addModalLetter10 fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah pengajuan surat rekomendasi</h5>
                <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('recomendationletter/store') }}" method="POST" id="addFormLetter10"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-body container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Tempat Surat<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="letter_place" id="letter_place"
                                            placeholder="Masukan tempat surat">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Surat <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="letter_date" id="letter_date"
                                            placeholder="Masukan tanggal surat" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 center">
                                <div class="card" style="width: 10rem;">
                                    <a target="_blank"
                                        href="{{ url('assets/img/letters/sample_letters/sample_6.jpg') }}"
                                        class="text text-sm-center">
                                        <img class="card-img-top" src="/assets/img/letters/sample_letters/sample_6.jpg"
                                            height="auto" alt="">
                                        Lihat contoh surat</a>
                                </div>
                            </div>

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 1 Pemohon</span>
                            </div>
                            {{-- ================================================================================= --}}
                            <input type="hidden" class="letter_category_id" name="letter_category_id" value="10"
                                id="letter_category_id">
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
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 2 Keterangan</span>
                            </div>
                            {{-- ================================================================================= --}}

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
                                    <input type="number" class="form-control" name="no_buku_pas_senpi"
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
                                    <input type="string" class="form-control nama_pemilik" name="nama_pemilik"
                                        id="nama_pemilik" placeholder="Masukan nama pemilik">
                                </div>
                            </div>
                            {{-- end letter10 b2l10 --}}

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 3 Persyaratan</span>
                            </div>
                            {{-- ================================================================================= --}}

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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
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
                                            file (pdf) dengan ukuran kurang dari 2MB</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{-- end letter10 b3l10 --}}

                            {{-- ================================================================================= --}}
                            <div class="col-md-12 mb-3 border-bottom border-dark">
                                <span class=" font-weight-bold">Bagian 4 Pemohon</span>
                            </div>
                            {{-- ================================================================================= --}}

                            {{-- letter10 b4l10 --}}
                            <div class="col-md-6 mb-3 letter10">
                                <div class="form-group">
                                    <label class="form-label">Pemohon<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control pemohon" name="pemohon" id="pemohon"
                                        placeholder="Masukan pemohon">
                                </div>
                            </div>
                            {{-- end letter10 b4l10 --}}

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary close-modal"
                        data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End letter 10 --}}
@endsection

@section('script')
<script type="text/javascript">
    // set option persyaratan file
    $('#letter_category_id').change(function () {
        let letter = $('#letter_category_id').val();
        let letterData = $('option:selected', '#letter_category_id').attr('data-tag');
        switch (letter) {
            case "1":
                document.getElementById("addFormLetter1").reset();
                $('.letter1').show();
                $('#downloadletter').hide();
                $('.addModalLetter1 form').attr('action', "{{ url('recomendationletter/store') }}");
                $('.addModalLetter1 .modal-title').text(letterData);
                $('.addModalLetter1').modal('show');
                break;
            case "2":
                document.getElementById("addFormLetter2").reset();
                $('.letter2').show();
                $('#downloadletter').hide();
                $('.addModalLetter2 form').attr('action', "{{ url('recomendationletter/store') }}");
                $('.addModalLetter2 .modal-title').text(letterData);
                $('.addModalLetter2').modal('show');
                break;
            case "3":
                document.getElementById("addFormLetter3").reset();
                $('.letter3').show();
                $('#downloadletter').hide();
                $('.addModalLetter3 form').attr('action', "{{ url('recomendationletter/store') }}");
                $('.addModalLetter3 .modal-title').text(letterData);
                $('.addModalLetter3').modal('show');
                break;
            case "4":
                document.getElementById("addFormLetter4").reset();
                $('.letter4').show();
                $('#downloadletter').hide();
                $('.addModalLetter4 form').attr('action', "{{ url('recomendationletter/store') }}");
                $('.addModalLetter4 .modal-title').text(letterData);
                $('.addModalLetter4').modal('show');
                break;
            case "5":
                document.getElementById("addFormLetter5").reset();
                $('.letter5').show();
                $('#downloadletter').hide();
                $('.addModalLetter5 form').attr('action', "{{ url('recomendationletter/store') }}");
                $('.addModalLetter5 .modal-title').text(letterData);
                $('.addModalLetter5').modal('show');
                break;
            case "6":
                document.getElementById("addFormLetter6").reset();
                $('.letter6').show();
                $('#downloadletter').hide();
                $('.addModalLetter6 form').attr('action', "{{ url('recomendationletter/store') }}");
                $('.addModalLetter6 .modal-title').text(letterData);
                $('.addModalLetter6').modal('show');
                break;
            case "7":
                document.getElementById("addFormLetter7").reset();
                $('.letter7').show();
                $('#downloadletter').hide();
                $('.addModalLetter7 form').attr('action', "{{ url('recomendationletter/store') }}");
                $('.addModalLetter7 .modal-title').text(letterData);
                $('.addModalLetter7').modal('show');
                break;
            case "8":
                document.getElementById("addFormLetter8").reset();
                $('.letter8').show();
                $('#downloadletter').hide();
                $('.addModalLetter8 form').attr('action', "{{ url('recomendationletter/store') }}");
                $('.addModalLetter8 .modal-title').text(letterData);
                $('.addModalLetter8').modal('show');
                break;
            case "9":
                document.getElementById("addFormLetter9").reset();
                $('.letter9').show();
                $('#downloadletter').hide();
                $('.addModalLetter9 form').attr('action', "{{ url('recomendationletter/store') }}");
                $('.addModalLetter9 .modal-title').text(letterData);
                $('.addModalLetter9').modal('show');
                break;
            case "10":
                document.getElementById("addFormLetter10").reset();
                $('.letter10').show();
                $('#downloadletter').hide();
                $('.addModalLetter10 form').attr('action', "{{ url('recomendationletter/store') }}");
                $('.addModalLetter10 .modal-title').text(letterData);
                $('.addModalLetter10').modal('show');
                break;
            case "11":
                $('#downloadletter').show();
                var urldownload =
                    'https://docs.google.com/document/d/1AW4MFEgsVA_NEQ3V45VMvjvw46ZmF49u/edit?usp=sharing&ouid=114630718812309264727&rtpof=true&sd=true';
                // var urldownload = 'recomendationletter/downloadletter/' + letter;
                document.getElementById('downloadletter').innerHTML =
                    "<a href='" + urldownload +
                    "' class='btn btn-primary download'>Download file surat</i>";
                break;
            case "12":
                $('#downloadletter').show();
                var urldownload =
                    'https://docs.google.com/document/d/1lSkQLZZgg90JxRD7F1X3kuDcelywSNT6/edit?usp=sharing&ouid=114630718812309264727&rtpof=true&sd=true';
                // var urldownload = 'recomendationletter/downloadletter/' + letter;
                document.getElementById('downloadletter').innerHTML =
                    "<a href='" + urldownload +
                    "' class='btn btn-primary download'>Download file surat</i>";
                break;
            default:
                $('#downloadletter').hide();
                break;
        }
    });
    $(".name").keyup(function () {
        let name = $(".name").val();
        $('.nama_pemilik').val(name);
        $('.pemohon').val(name);
    });
    $(".pihak-1").keyup(function () {
        let name1 = $(".pihak-1").val();
        $('.pemohon_pihak_1').val(name1);
    });
    $("#name2").keyup(function () {
        let name2 = $("#name2").val();
        $('.pemohon_pihak_2').val(name2);
    });
    // add data
    $('.btnAdd').click(function () {
        $('#letter_category_id').prop('selectedIndex', 0);
        $('#downloadletter').hide();
        $('.addModal .modal-title').text('Tambah pengajuan surat rekomendasi');
        $('.addModal').modal('show');
    });
    // check error
    @if(count($errors))
    $('.addModal').modal('show');
    @endif

    // reset select option letter category
    $('.close-modal').click(function () {
        $('#letter_category_id').prop('selectedIndex', 0);
    });

    // Detail Data
    $('.btnDetail').click(function () {
        let id = $(this).attr('data-id');
        let url = "{{ url('recomendationletter/show') }}";

        $('.detailModalLetter1 .modal-title').text('Detail Data Letter');
        $('.detailModalLetter1').modal('show');
        $.ajax({
            type: 'GET',
            url: url + '/' + id,
            dataType: 'JSON',
            success: function (data) {
                console.log(data);
                if (data.status == 1) {
                    document.getElementById('letter_status_detail1').innerHTML =
                        "<span class='" + data.result[1].style_class + "'>" + data.result[1]
                        .approval_status + "</span>";
                    $('.letter_category_name').val(': ' + data.result[1].letter_category_name);
                    $('.user_name').val(': ' + data.result[1].name);
                    $('.user_kta').val(': ' + data.result[1].no_kta);
                    $('.club_name').val(': ' + data.result[1].club);

                    var filePath = 'storage/uploads/letters/category-' + data.result[1]
                        .letter_category_id +
                        "/";
                    document.getElementById('file_buku_pas_senpi_detail1').innerHTML =
                        "<a target='_blank' href='" + filePath + data.result[2]
                        .file_buku_pas_senpi +
                        "' class='btn btn-primary download'>Lihat File</i>";

                    document.getElementById('file_kta_detail1').innerHTML =
                        "<a target='_blank' href='" + filePath + data.result[2].file_kta +
                        "' class='btn btn-primary download'>Lihat File</i>";
                    document.getElementById('file_ktp_detail1').innerHTML =
                        "<a target='_blank' href='" + filePath + data.result[2].file_ktp +
                        "' class='btn btn-primary download'>Lihat File</i>";
                    document.getElementById('file_foto_4x6_detail1').innerHTML =
                        "<a target='_blank' href='" + filePath + data.result[2].file_foto_4x6 +
                        "' class='btn btn-primary download'>Lihat File</i>";
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

    $("#addFormLetter1").validate({
        rules: {
            letter_place: 'required',
            letter_date: 'required',
            name: 'required',
            place_of_birth: 'required',
            date_of_birth: 'required',
            occupation: 'required',
            address: 'required',
            club: 'required',
            no_kta: 'required',
            membership: 'required',
            mutasi_dari: 'required',
            l9_cabang: 'required',
            mutasi_alasan: 'required',
            firearm_category_id: 'required',
            merek: 'required',
            kaliber: 'required',
            no_pabrik: 'required',
            no_buku_pas_senpi: 'required',
            nama_pemilik: 'required',
            jumlah: 'required',
            penyimpanan: 'required',
            pemohon: 'required',
            file_buku_pas_senpi: 'required',
            file_kta: 'required',
            file_ktp: 'required',
            file_foto_4x6: 'required'
        },
        messages: {
            letter_place: "Form data tidak boleh kosong",
            letter_date: "Tanggal harus dipilih",
            name: "Form data tidak boleh kosong",
            place_of_birth: "Form data tidak boleh kosong",
            date_of_birth: "Form data tidak boleh kosong",
            occupation: "Form data tidak boleh kosong",
            address: "Form data tidak boleh kosong",
            club: "Form data tidak boleh kosong",
            no_kta: "Form data tidak boleh kosong",
            membership: "Form data tidak boleh kosong",
            mutasi_dari: "Form data tidak boleh kosong",
            l9_cabang: "Form data tidak boleh kosong",
            mutasi_alasan: "Form data tidak boleh kosong",
            firearm_category_id: "Form data tidak boleh kosong",
            merek: "Form data tidak boleh kosong",
            kaliber: "Form data tidak boleh kosong",
            no_pabrik: "Form data tidak boleh kosong",
            no_buku_pas_senpi: "Form data tidak boleh kosong",
            nama_pemilik: "Form data tidak boleh kosong",
            jumlah: "Form data tidak boleh kosong",
            penyimpanan: "Form data tidak boleh kosong",
            pemohon: "Form data tidak boleh kosong",
            file_buku_pas_senpi: "File harus dipilih",
            file_kta: "File harus dipilih",
            file_ktp: "File harus dipilih",
            file_foto_4x6: "File harus dipilih"
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

    $("#addFormLetter2").validate({
        rules: {
            letter_place: 'required',
            letter_date: 'required',
            letter_category_id: 'required',
            name: 'required',
            place_of_birth: 'required',
            date_of_birth: 'required',
            occupation: 'required',
            address: 'required',
            club: 'required',
            no_kta: 'required',
            membership: 'required',
            mutasi_alasan: 'required',
            firearm_category_id: 'required',
            merek: 'required',
            kaliber: 'required',
            no_pabrik: 'required',
            no_buku_pas_senpi: 'required',
            nama_pemilik: 'required',
            jumlah: 'required',
            penyimpanan: 'required',
            pemohon: 'required',
            file_surat_hibah_senpi: 'required',
            file_buku_pas_senpi: 'required',
            file_foto_senjata: 'required',
            file_kta: 'required',
            file_ktp: 'required',
            file_sertif_menembak: 'required',
            file_skck: 'required',
            file_surat_sehat: 'required',
            file_tes_psikotes: 'required',
            file_kk: 'required',
            file_foto_4x6: 'required'
        },
        messages: {
            letter_place: 'Form data tidak boleh kosong',
            letter_date: 'Form data tidak boleh kosong',
            letter_category_id: 'Form data tidak boleh kosong',
            name: 'Form data tidak boleh kosong',
            place_of_birth: 'Form data tidak boleh kosong',
            date_of_birth: 'Form data tidak boleh kosong',
            occupation: 'Form data tidak boleh kosong',
            address: 'Form data tidak boleh kosong',
            club: 'Form data tidak boleh kosong',
            no_kta: 'Form data tidak boleh kosong',
            membership: 'Form data tidak boleh kosong',
            mutasi_alasan: 'Form data tidak boleh kosong',
            firearm_category_id: 'Form data tidak boleh kosong',
            merek: 'Form data tidak boleh kosong',
            kaliber: 'Form data tidak boleh kosong',
            no_pabrik: 'Form data tidak boleh kosong',
            no_buku_pas_senpi: 'Form data tidak boleh kosong',
            nama_pemilik: 'Form data tidak boleh kosong',
            jumlah: 'Form data tidak boleh kosong',
            penyimpanan: 'Form data tidak boleh kosong',
            pemohon: 'Form data tidak boleh kosong',
            file_surat_hibah_senpi: 'required',
            file_buku_pas_senpi: 'required',
            file_foto_senjata: 'required',
            file_kta: 'File harus dipilih',
            file_ktp: 'File harus dipilih',
            file_sertif_menembak: 'File harus dipilih',
            file_skck: 'File harus dipilih',
            file_surat_sehat: 'File harus dipilih',
            file_tes_psikotes: 'File harus dipilih',
            file_kk: 'File harus dipilih',
            file_foto_4x6: 'File harus dipilih'
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

    $("#addFormLetter3").validate({
        rules: {
            letter_category_id: 'required',
            name: 'required',
            place_of_birth: 'required',
            date_of_birth: 'required',
            occupation: 'required',
            address: 'required',
            no_ktp: 'required',
            name2: 'required',
            occupation2: 'required',
            address2: 'required',
            no_ktp2: 'required',
            firearm_category_id: 'required',
            merek: 'required',
            kaliber: 'required',
            no_pabrik: 'required',
            no_buku_pas_senpi: 'required',
            tanggal_dikeluarkan: 'required',
            jumlah: 'required',
            pemohon_pihak_2: 'required',
            pemohon: 'required'
        },
        messages: {
            letter_category_id: 'Form data tidak boleh kosong',
            name: 'Form data tidak boleh kosong',
            place_of_birth: 'Form data tidak boleh kosong',
            date_of_birth: 'Form data tidak boleh kosong',
            occupation: 'Form data tidak boleh kosong',
            address: 'Form data tidak boleh kosong',
            no_ktp: 'Form data tidak boleh kosong',
            name2: 'Form data tidak boleh kosong',
            occupation2: 'Form data tidak boleh kosong',
            address2: 'Form data tidak boleh kosong',
            no_ktp2: 'Form data tidak boleh kosong',
            firearm_category_id: 'Form data tidak boleh kosong',
            merek: 'Form data tidak boleh kosong',
            kaliber: 'Form data tidak boleh kosong',
            no_pabrik: 'Form data tidak boleh kosong',
            no_buku_pas_senpi: 'Form data tidak boleh kosong',
            tanggal_dikeluarkan: 'Form data tidak boleh kosong',
            jumlah: 'Form data tidak boleh kosong',
            pemohon_pihak_2: 'Form data tidak boleh kosong',
            pemohon: 'Form data tidak boleh kosong'
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

    $("#addFormLetter4").validate({
        rules: {
            letter_place: 'required',
            letter_date: 'required',
            letter_category_id: 'required',
            name: 'required',
            place_of_birth: 'required',
            date_of_birth: 'required',
            occupation: 'required',
            address: 'required',
            club: 'required',
            no_kta: 'required',
            membership: 'required',
            mutasi_alasan: 'required',
            firearm_category_id: 'required',
            merek: 'required',
            kaliber: 'required',
            no_pabrik: 'required',
            no_buku_pas_senpi: 'required',
            no_si_impor: 'required',
            bap_senpi: 'required',
            jumlah: 'required',
            penyimpanan: 'required',
            pemohon: 'required',
            file_si_impor_senjata: 'required',
            file_sba_penitipan_senpi: 'required',
            file_kta: 'required',
            file_ktp: 'required',
            file_sertif_menembak: 'required',
            file_skck: 'required',
            file_surat_sehat: 'required',
            file_tes_psikotes: 'required',
            file_kk: 'required',
            file_foto_4x6: 'required'
        },
        messages: {
            letter_place: 'Form data tidak boleh kosong',
            letter_date: 'Form data tidak boleh kosong',
            letter_category_id: 'Form data tidak boleh kosong',
            name: 'Form data tidak boleh kosong',
            place_of_birth: 'Form data tidak boleh kosong',
            date_of_birth: 'Form data tidak boleh kosong',
            occupation: 'Form data tidak boleh kosong',
            address: 'Form data tidak boleh kosong',
            club: 'Form data tidak boleh kosong',
            no_kta: 'Form data tidak boleh kosong',
            membership: 'Form data tidak boleh kosong',
            mutasi_alasan: 'Form data tidak boleh kosong',
            firearm_category_id: 'Form data tidak boleh kosong',
            merek: 'Form data tidak boleh kosong',
            kaliber: 'Form data tidak boleh kosong',
            no_pabrik: 'Form data tidak boleh kosong',
            no_buku_pas_senpi: 'Form data tidak boleh kosong',
            no_si_impor: 'Form data tidak boleh kosong',
            bap_senpi: 'Form data tidak boleh kosong',
            jumlah: 'Form data tidak boleh kosong',
            penyimpanan: 'Form data tidak boleh kosong',
            pemohon: 'Form data tidak boleh kosong',
            file_si_impor_senjata: 'File harus dipilih',
            file_sba_penitipan_senpi: 'File harus dipilih',
            file_kta: 'File harus dipilih',
            file_ktp: 'File harus dipilih',
            file_sertif_menembak: 'File harus dipilih',
            file_skck: 'File harus dipilih',
            file_surat_sehat: 'File harus dipilih',
            file_tes_psikotes: 'File harus dipilih',
            file_kk: 'File harus dipilih',
            file_foto_4x6: 'File harus dipilih'
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

    $("#addFormLetter5").validate({
        rules: {
            letter_place: 'required',
            letter_date: 'required',
            letter_category_id: 'required',
            name: 'required',
            place_of_birth: 'required',
            date_of_birth: 'required',
            occupation: 'required',
            address: 'required',
            club: 'required',
            no_kta: 'required',
            membership: 'required',
            waktu_mulai: 'required',
            waktu_selesai: 'required',
            dalam_event: 'required',
            lokasi1: 'required',
            jumlah_anggota: 'required',
            pemohon: 'required',
            l5_lampiran1: 'required',
            nama_anggota_senjata_digunakan: 'required',
            file_kta: 'required',
            file_buku_pas_senpi: 'required'
        },
        messages: {
            letter_place: 'Form data tidak boleh kosong',
            letter_date: 'Form data tidak boleh kosong',
            letter_category_id: 'Form data tidak boleh kosong',
            name: 'Form data tidak boleh kosong',
            place_of_birth: 'Form data tidak boleh kosong',
            date_of_birth: 'Form data tidak boleh kosong',
            occupation: 'Form data tidak boleh kosong',
            address: 'Form data tidak boleh kosong',
            club: 'Form data tidak boleh kosong',
            no_kta: 'Form data tidak boleh kosong',
            membership: 'Form data tidak boleh kosong',
            waktu_mulai: 'Form data tidak boleh kosong',
            waktu_selesai: 'Form data tidak boleh kosong',
            dalam_event: 'Form data tidak boleh kosong',
            lokasi1: 'Form data tidak boleh kosong',
            jumlah_anggota: 'Form data tidak boleh kosong',
            pemohon: 'Form data tidak boleh kosong',
            l5_lampiran1: 'File harus dipilih',
            nama_anggota_senjata_digunakan: 'File harus dipilih',
            file_kta: 'File harus dipilih',
            file_buku_pas_senpi: 'File harus dipilih'
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

    $("#addFormLetter6").validate({
        rules: {
            letter_place: 'required',
            letter_date: 'required',
            letter_category_id: 'required',
            name: 'required',
            place_of_birth: 'required',
            date_of_birth: 'required',
            occupation: 'required',
            address: 'required',
            club: 'required',
            no_kta: 'required',
            membership: 'required',
            dalam_event: 'required',
            lokasi1: 'required',
            waktu_mulai: 'required',
            waktu_selesai: 'required',
            jumlah_anggota: 'required',
            pemohon: 'required',
            surat_rekomendasi_pengcab: 'required',
            file_nama_anggota_senjata_digunakan: 'required',
            file_kta: 'required',
            file_buku_pas_senpi: 'required',
            l6_undangan_berburu: 'required',
            file_surat_sehat: 'required'
        },
        messages: {
            letter_place: 'Form data tidak boleh kosong',
            letter_date: 'Form data tidak boleh kosong',
            letter_category_id: 'Form data tidak boleh kosong',
            name: 'Form data tidak boleh kosong',
            place_of_birth: 'Form data tidak boleh kosong',
            date_of_birth: 'Form data tidak boleh kosong',
            occupation: 'Form data tidak boleh kosong',
            address: 'Form data tidak boleh kosong',
            club: 'Form data tidak boleh kosong',
            no_kta: 'Form data tidak boleh kosong',
            membership: 'Form data tidak boleh kosong',
            dalam_event: 'Form data tidak boleh kosong',
            lokasi1: 'Form data tidak boleh kosong',
            waktu_mulai: 'Form data tidak boleh kosong',
            waktu_selesai: 'Form data tidak boleh kosong',
            jumlah_anggota: 'Form data tidak boleh kosong',
            pemohon: 'Form data tidak boleh kosong',
            surat_rekomendasi_pengcab: 'File harus dipilih',
            file_nama_anggota_senjata_digunakan: 'File harus dipilih',
            file_kta: 'File harus dipilih',
            file_buku_pas_senpi: 'File harus dipilih',
            l6_undangan_berburu: 'File harus dipilih',
            file_surat_sehat: 'File harus dipilih'
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

    $("#addFormLetter7").validate({
        rules: {
            letter_place: 'required',
            letter_date: 'required',
            letter_category_id: 'required',
            name: 'required',
            place_of_birth: 'required',
            date_of_birth: 'required',
            occupation: 'required',
            address: 'required',
            club: 'required',
            no_kta: 'required',
            membership: 'required',
            dalam_event: 'required',
            l7_alasan_pengunduran: 'required',
            tembusan1: 'required',
            tembusan2: 'required',
            pemohon: 'required'
        },
        messages: {
            letter_place: 'Form data tidak boleh kosong',
            letter_date: 'Form data tidak boleh kosong',
            letter_category_id: 'Form data tidak boleh kosong',
            name: 'Form data tidak boleh kosong',
            place_of_birth: 'Form data tidak boleh kosong',
            date_of_birth: 'Form data tidak boleh kosong',
            occupation: 'Form data tidak boleh kosong',
            address: 'Form data tidak boleh kosong',
            club: 'Form data tidak boleh kosong',
            no_kta: 'Form data tidak boleh kosong',
            membership: 'Form data tidak boleh kosong',
            dalam_event: 'Form data tidak boleh kosong',
            l7_alasan_pengunduran: 'Form data tidak boleh kosong',
            tembusan1: 'Form data tidak boleh kosong',
            tembusan2: 'Form data tidak boleh kosong',
            pemohon: 'Form data tidak boleh kosong'
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

    $("#addFormLetter8").validate({
        rules: {
            letter_place: 'required',
            letter_date: 'required',
            letter_category_id: 'required',
            dasar_adart: 'required',
            pemohon: 'required',
            l8_kta_anggota_baru: 'required',
            file_ktp: 'required',
            l8_adart: 'required',
            l8_struktur_organisasi: 'required',
            l8_nama_para_pengurus: 'required',
            l8_pas_foto_pengurus: 'required',
            l8_data_anggota_club: 'required',
            l8_surat_keterangan_domisili: 'required',
            file_skck: 'required',
            biaya_administrasi: 'required'
        },
        messages: {
            letter_place: 'Form data tidak boleh kosong',
            letter_date: 'Form data tidak boleh kosong',
            letter_category_id: 'Form data tidak boleh kosong',
            dasar_adart: 'Form data tidak boleh kosong',
            pemohon: 'Form data tidak boleh kosong',
            l8_kta_anggota_baru: 'File harus dipilih',
            file_ktp: 'File harus dipilih',
            l8_adart: 'File harus dipilih',
            l8_struktur_organisasi: 'File harus dipilih',
            l8_nama_para_pengurus: 'File harus dipilih',
            l8_pas_foto_pengurus: 'File harus dipilih',
            l8_data_anggota_club: 'File harus dipilih',
            l8_surat_keterangan_domisili: 'File harus dipilih',
            file_skck: 'File harus dipilih',
            biaya_administrasi: 'File harus dipilih',
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

    $("#addFormLetter9").validate({
        rules: {
            letter_place: 'required',
            letter_date: 'required',
            letter_category_id: 'required',
            name: 'required',
            place_of_birth: 'required',
            date_of_birth: 'required',
            occupation: 'required',
            address: 'required',
            club: 'required',
            no_kta: 'required',
            membership: 'required',
            mutasi_dari: 'required',
            mutasi_menuju: 'required',
            l9_cabang: 'required',
            mutasi_alasan: 'required',
            pemohon: 'required',
            file_ktp: 'required',
            file_kta_club: 'required',
            surat_rekomendasi_club: 'required',
            file_kta: 'required',
            file_foto_4x6: 'required'
        },
        messages: {
            letter_place: 'Form data tidak boleh kosong',
            letter_date: 'Form data tidak boleh kosong',
            letter_category_id: 'Form data tidak boleh kosong',
            name: 'Form data tidak boleh kosong',
            place_of_birth: 'Form data tidak boleh kosong',
            date_of_birth: 'Form data tidak boleh kosong',
            occupation: 'Form data tidak boleh kosong',
            address: 'Form data tidak boleh kosong',
            club: 'Form data tidak boleh kosong',
            no_kta: 'Form data tidak boleh kosong',
            membership: 'Form data tidak boleh kosong',
            mutasi_dari: 'Form data tidak boleh kosong',
            mutasi_menuju: 'Form data tidak boleh kosong',
            l9_cabang: 'Form data tidak boleh kosong',
            mutasi_alasan: 'Form data tidak boleh kosong',
            pemohon: 'Form data tidak boleh kosong',
            file_ktp: 'File harus dipilih',
            file_kta_club: 'File harus dipilih',
            surat_rekomendasi_club: 'File harus dipilih',
            file_kta: 'File harus dipilih',
            file_foto_4x6: 'File harus dipilih'
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

    $("#addFormLetter10").validate({
        rules: {
            letter_place: 'required',
            letter_date: 'required',
            letter_category_id: 'required',
            name: 'required',
            place_of_birth: 'required',
            date_of_birth: 'required',
            occupation: 'required',
            address: 'required',
            club: 'required',
            no_kta: 'required',
            membership: 'required',
            firearm_category_id: 'required',
            merek: 'required',
            kaliber: 'required',
            no_buku_pas_senpi: 'required',
            tanggal_dikeluarkan: 'required',
            jumlah: 'required',
            nama_pemilik: 'required',
            pemohon: 'required',
            file_kta_club: 'required',
            file_ktp: 'required',
            file_buku_pas_senpi: 'required',
            file_foto_4x6: 'required'
        },
        messages: {
            letter_place: 'Form data tidak boleh kosong',
            letter_date: 'Form data tidak boleh kosong',
            letter_category_id: 'Form data tidak boleh kosong',
            name: 'Form data tidak boleh kosong',
            place_of_birth: 'Form data tidak boleh kosong',
            date_of_birth: 'Form data tidak boleh kosong',
            occupation: 'Form data tidak boleh kosong',
            address: 'Form data tidak boleh kosong',
            club: 'Form data tidak boleh kosong',
            no_kta: 'Form data tidak boleh kosong',
            membership: 'Form data tidak boleh kosong',
            firearm_category_id: 'Form data tidak boleh kosong',
            merek: 'Form data tidak boleh kosong',
            kaliber: 'Form data tidak boleh kosong',
            no_buku_pas_senpi: 'Form data tidak boleh kosong',
            tanggal_dikeluarkan: 'Form data tidak boleh kosong',
            jumlah: 'Form data tidak boleh kosong',
            nama_pemilik: 'Form data tidak boleh kosong',
            pemohon: 'Form data tidak boleh kosong',
            file_kta_club: 'File harus dipilih',
            file_ktp: 'File harus dipilih',
            file_buku_pas_senpi: 'File harus dipilih',
            file_foto_4x6: 'File harus dipilih'
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

    // // function for disable right right click
    // window.oncontextmenu = function () {
    //     return false;
    // }

    // // function for disable key shortcut
    // $(window).on('keydown', function (event) {
    //     if (event.keyCode == 123) {
    //         return false; //Prevent from f12
    //     } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
    //         return false; //Prevent from ctrl+shift+i
    //     } else if (event.ctrlKey &&
    //         // event.keyCode === 67 ||
    //         // event.keyCode === 86 ||
    //         event.keyCode === 85 ||
    //         event.keyCode === 117) {
    //         return false;
    //         /*
    //         67  = c
    //         86  = v
    //         85  = u
    //         117 = f6
    //         */
    //     }
    // });

</script>
@endsection
