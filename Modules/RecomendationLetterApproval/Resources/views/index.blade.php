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
                <div class="table-responsive">
                    <table class="table table-striped card-table table-hover text-nowrap table-data">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Klub</th>
                                <th>Tanggal</th>
                                <th>Kategori</th>
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
                                <td colspan="10" align="center">Data kosong</td>
                            </tr>
                            @else
                            @foreach ($letters as $letter)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $letter->name }}</td>
                                <td>{{ $letter->club }}</td>
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
                                @php
                                if (Auth::user()->group_id == 1) {
                                    echo '<td>';
                                        $status = $letter->admin_status;
    
                                        if($status == 1){
                                        $admin_status = 'Diterima / ACC';
                                        $class = 'badge badge-success';
                                        }else if($status == 2){
                                        $admin_status = 'Ditolak';
                                        $class = 'badge badge-danger';
                                        }else {
                                        $admin_status = 'Diproses';
                                        $class = 'badge badge-info';
                                        }
                                    echo '<span class="'. $class .'">'. $admin_status .'</span>';
                                    echo '</td>';
                                echo '<td>';
                                    $status = $letter->sekum_status;
                                    if($status == 1){
                                    $sekum_status = 'Diterima / ACC';
                                    $class = 'badge badge-success';
                                    }else if($status == 2){
                                    $sekum_status = 'Ditolak';
                                    $class = 'badge badge-danger';
                                    }else {
                                    $sekum_status = 'Perlu diproses';
                                    $class = 'badge badge-secondary';
                                    }
                                    echo '<span class="'. $class .'">'. $sekum_status .'</span>';
                                    echo '</td>';
                                echo '<td>';
                                    $status = $letter->ketua_status;
                                    if($status == 1){
                                    $ketua_status = 'Diterima / ACC';
                                    $class = 'badge badge-success';
                                    }else if($status == 2){
                                    $ketua_status = 'Ditolak';
                                    $class = 'badge badge-danger';
                                    }else {
                                    $ketua_status = 'Perlu diproses';
                                    $class = 'badge badge-secondary';
                                    }
                                    echo '<span class="'. $class .'">'. $ketua_status .'</span>';
                                    echo '</td>';
                                }elseif(Auth::user()->group_id == 4){
                                echo '<td>';
                                    $status = $letter->admin_status;

                                    if($status == 1){
                                    $admin_status = 'Diterima / ACC';
                                    $class = 'badge badge-success';
                                    }else if($status == 2){
                                    $admin_status = 'Ditolak';
                                    $class = 'badge badge-danger';
                                    }else {
                                    $admin_status = 'Perlu diproses';
                                    $class = 'badge badge-secondary';
                                    }
                                    echo '<span class="'. $class .'">'. $admin_status .'</span>';
                                    echo '</td>';
                                echo '<td>';
                                    $status = $letter->sekum_status;
                                    if($status == 1){
                                    $sekum_status = 'Diterima / ACC';
                                    $class = 'badge badge-success';
                                    }else if($status == 2){
                                    $sekum_status = 'Ditolak';
                                    $class = 'badge badge-danger';
                                    }else {
                                    $sekum_status = 'Perlu diproses';
                                    $class = 'badge badge-secondary';
                                    }
                                    echo '<span class="'. $class .'">'. $sekum_status .'</span>';
                                    echo '</td>';
                                echo '<td>';
                                    $status = $letter->ketua_status;
                                    if($status == 1){
                                    $ketua_status = 'Diterima / ACC';
                                    $class = 'badge badge-success';
                                    }else if($status == 2){
                                    $ketua_status = 'Ditolak';
                                    $class = 'badge badge-danger';
                                    }else {
                                    $ketua_status = 'Perlu diproses';
                                    $class = 'badge badge-secondary';
                                    }
                                    echo '<span class="'. $class .'">'. $ketua_status .'</span>';
                                    echo '<select class="form-control letter_approval_ketua"
                                        name="letter_status_approval_ketua" data-id="'.$letter->letter_id.'"
                                        data-user="ketua">
                                        <option value="" selected>Update Status</option>
                                        <option value="1">Terima</option>
                                        <option value="2">Tolak</option>
                                    </select>';
                                    echo '</td>';
                                }elseif (Auth::user()->group_id == 2){
                                echo '<td>';
                                    $status = $letter->admin_status;
                                    if($status == 1){
                                    $admin_status = 'Diterima / ACC';
                                    $class = 'badge badge-success';
                                    }else if($status == 2){
                                    $admin_status = 'Ditolak';
                                    $class = 'badge badge-danger';
                                    }else {
                                    $admin_status = 'Perlu diproses';
                                    $class = 'badge badge-secondary';
                                    }
                                    echo '<span class="'. $class .'">'. $admin_status .'</span>';
                                    echo '<select class="form-control letter_approval_admin"
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
                                    $admin_status = 'Diterima / ACC';
                                    $class = 'badge badge-success';
                                    }else if($status == 2){
                                    $admin_status = 'Ditolak';
                                    $class = 'badge badge-danger';
                                    }else {
                                    $admin_status = 'Perlu diproses';
                                    $class = 'badge badge-secondary';
                                    }
                                    echo '<span class="'. $class .'">'. $admin_status .'</span>';
                                    echo '</td>';
                                echo '<td>';
                                    $status = $letter->sekum_status;
                                    if($status == 1){
                                    $sekum_status = 'Diterima / ACC';
                                    $class = 'badge badge-success';
                                    }else if($status == 2){
                                    $sekum_status = 'Ditolak';
                                    $class = 'badge badge-danger';
                                    }else {
                                    $sekum_status = 'Perlu diproses';
                                    $class = 'badge badge-secondary';
                                    }
                                    echo '<span class="'. $class .'">'. $sekum_status .'</span>';
                                    echo '<select class="form-control letter_approval_sekum"
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
                                    @if (Auth::user()->group_id == 1 || Auth::user()->group_id == 2)
                                    <a href="javascript:void(0)" class="btn btn-icon btnDetail btn-outline-info"
                                        data-id="{{ $letter->letter_id }}" data-toggle="tooltip" data-placement="top"
                                        title="Detail">
                                        <i data-feather="eye" width="16" height="16"></i>
                                    </a>
                                    <a href="{{ url('recomendationletterapproval/printletter/'. $letter->letter_id) }}"
                                        target="_blank" class="btn btn-icon btnPrint btn-outline-secondary"
                                        data-id="{{ $letter->letter_id }}" data-toggle="tooltip" data-placement="top"
                                        title="Print">
                                        <i data-feather="printer" width="16" height="16"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger btnDelete"
                                        data-url="{{ url('recomendationletterapproval/delete/'. $letter->letter_id) }}"
                                        data-toggle="tooltip" data-placement="top" title="Hapus">
                                        <i data-feather="trash-2" width="16" height="16"></i>
                                    </a>
                                    @else
                                    <a href="javascript:void(0)" class="btn btn-icon btnDetail btn-outline-info"
                                        data-id="{{ $letter->letter_id }}" data-toggle="tooltip" data-placement="top"
                                        title="Detail">
                                        <i data-feather="eye" width="16" height="16"></i>
                                    </a>
                                    <a href="{{ url('recomendationletterapproval/printletter/'. $letter->letter_id) }}"
                                        target="_blank" class="btn btn-icon btnPrint btn-outline-secondary"
                                        data-id="{{ $letter->letter_id }}" data-toggle="tooltip" data-placement="top"
                                        title="Print">
                                        <i data-feather="printer" width="16" height="16"></i>
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
<!-- </div> -->
<!-- ============================================================== -->
<!-- End Container fluid  -->

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

{{-- Modal detail letter  --}}
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
                                <label for="letter_status" class="col-md-5 col-form-label">Status pengajuan</label>
                                <div id="letter_status_detail1">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="letter_category_name" class="col-md-5 col-form-label">Kategori surat</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext letter_category_name">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="user_name" class="col-md-5 col-form-label">Nama pemohon</label>
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
                                <label for="club_name" class="col-md-5 col-form-label">Nama club</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext club_name"
                                        value="{{ old('club_name') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_buku_pas_senpi" class="col-md-5 col-form-label">File buku pas
                                    senpi</label>
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
                                <label for="file_foto_4x6" class="col-md-5 col-form-label">File foto</label>
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

<div class=" modal detailModalLetter2" tabindex="-1" role="dialog">
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
                                <label for="letter_status" class="col-md-5 col-form-label">Status pengajuan</label>
                                <div id="letter_status_detail2">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="letter_category_name" class="col-md-5 col-form-label">Kategori surat</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext letter_category_name">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="user_name" class="col-md-5 col-form-label">Nama pemohon</label>
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
                                <label for="club_name" class="col-md-5 col-form-label">Nama club</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext club_name"
                                        value="{{ old('club_name') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_surat_hibah_senpi" class="col-md-5 col-form-label">File surat
                                    pernyataan hibah senpi</label>
                                <div class="col-md-6">
                                    <div id="file_surat_hibah_senpi_detail2"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_buku_pas_senpi" class="col-md-5 col-form-label">File buku pas
                                    senpi</label>
                                <div class="col-md-6">
                                    <div id="file_buku_pas_senpi_detail2"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_foto_senjata" class="col-md-5 col-form-label">Foto senjata</label>
                                <div class="col-md-6">
                                    <div id="file_foto_senjata_detail2"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_kta" class="col-md-5 col-form-label">File KTA</label>
                                <div class="col-md-6">
                                    <div id="file_kta_detail2"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_ktp" class="col-md-5 col-form-label">File KTP</label>
                                <div class="col-md-6">
                                    <div id="file_ktp_detail2"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_sertif_menembak" class="col-md-5 col-form-label">File sertifikat lulus
                                    penataran menembak perbakin bid. berburu/reaksi</label>
                                <div class="col-md-6">
                                    <div id="file_sertif_menembak_detail2"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_skck" class="col-md-5 col-form-label">File SKCK</label>
                                <div class="col-md-6">
                                    <div id="file_skck_detail2"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_surat_sehat" class="col-md-5 col-form-label">File surat keterangan
                                    sehat dari dokter Polda </label>
                                <div class="col-md-6">
                                    <div id="file_surat_sehat_detail2"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_tes_psikotes" class="col-md-5 col-form-label">File hasil lulus tes
                                    psikotes dari kepolisian/polda </label>
                                <div class="col-md-6">
                                    <div id="file_tes_psikotes_detail2"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_kk" class="col-md-5 col-form-label">File kartu keluarga </label>
                                <div class="col-md-6">
                                    <div id="file_kk_detail2"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_foto_4x6" class="col-md-5 col-form-label">File foto</label>
                                <div class="col-md-6">
                                    <div id="file_foto_4x6_detail2"></div>
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

<div class=" modal detailModalLetter3" tabindex="-1" role="dialog">
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
                                <label for="letter_status" class="col-md-5 col-form-label">Status pengajuan</label>
                                <div id="letter_status_detail3">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="letter_category_name" class="col-md-5 col-form-label">Kategori surat</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext letter_category_name">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="user_name" class="col-md-5 col-form-label">Nama pemohon</label>
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
                                <label for="club_name" class="col-md-5 col-form-label">Nama club</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext club_name"
                                        value="{{ old('club_name') }}">
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

<div class=" modal detailModalLetter4" tabindex="-1" role="dialog">
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
                                <label for="letter_status" class="col-md-5 col-form-label">Status pengajuan</label>
                                <div id="letter_status_detail4">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="letter_category_name" class="col-md-5 col-form-label">Kategori surat</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext letter_category_name">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="user_name" class="col-md-5 col-form-label">Nama pemohon</label>
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
                                <label for="club_name" class="col-md-5 col-form-label">Nama club</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext club_name"
                                        value="{{ old('club_name') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_si_impor_senjata" class="col-md-5 col-form-label">File SI impor senjata
                                    api</label>
                                <div class="col-md-6">
                                    <div id="file_si_impor_senjata_detail4"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_sba_penitipan_senpi" class="col-md-5 col-form-label">File surat berita
                                    acara penitipan senpi dari Bid. Yanmas Mabes Polri </label>
                                <div class="col-md-6">
                                    <div id="file_sba_penitipan_senpi_detail4"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_kta" class="col-md-5 col-form-label">File KTA Perbakin</label>
                                <div class="col-md-6">
                                    <div id="file_kta_detail4"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_ktp" class="col-md-5 col-form-label">File KTP</label>
                                <div class="col-md-6">
                                    <div id="file_ktp_detail4"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_sertif_menembak" class="col-md-5 col-form-label">File sertifikat lulus
                                    penataran menembak perbakin bid. berburu/reaksi</label>
                                <div class="col-md-6">
                                    <div id="file_sertif_menembak_detail4"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_skck" class="col-md-5 col-form-label">File SKCK</label>
                                <div class="col-md-6">
                                    <div id="file_skck_detail4"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_surat_sehat" class="col-md-5 col-form-label">File surat keterangan
                                    sehat dari dokter Polda </label>
                                <div class="col-md-6">
                                    <div id="file_surat_sehat_detail4"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_tes_psikotes" class="col-md-5 col-form-label">File hasil lulus tes
                                    psikotes dari Kepolisian/polda </label>
                                <div class="col-md-6">
                                    <div id="file_tes_psikotes_detail4"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_kk" class="col-md-5 col-form-label">File kartu keluarga </label>
                                <div class="col-md-6">
                                    <div id="file_kk_detail4"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_foto_4x6" class="col-md-5 col-form-label">File foto</label>
                                <div class="col-md-6">
                                    <div id="file_foto_4x6_detail4"></div>
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

<div class=" modal detailModalLetter5" tabindex="-1" role="dialog">
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
                                <label for="letter_status" class="col-md-5 col-form-label">Status pengajuan</label>
                                <div id="letter_status_detail5">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="letter_category_name" class="col-md-5 col-form-label">Kategori surat</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext letter_category_name">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="user_name" class="col-md-5 col-form-label">Nama pemohon</label>
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
                                <label for="club_name" class="col-md-5 col-form-label">Nama club</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext club_name"
                                        value="{{ old('club_name') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="l5_lampiran1" class="col-md-5 col-form-label">File izin penggunaan lapangan
                                    tembak Denma Mako Korpaskhas TNI AU Sulaiman</label>
                                <div class="col-md-6">
                                    <div id="l5_lampiran1_detail5"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_nama_anggota_senjata_digunakan" class="col-md-5 col-form-label">File
                                    nama anggota rombongan dan senjata api yang digunakan </label>
                                <div class="col-md-6">
                                    <div id="file_nama_anggota_senjata_digunakan_detail5"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_kta" class="col-md-5 col-form-label">File KTA Perbakin</label>
                                <div class="col-md-6">
                                    <div id="file_kta_detail5"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_buku_pas_senpi" class="col-md-5 col-form-label">File Buku Pas Senjata
                                    Api </label>
                                <div class="col-md-6">
                                    <div id="file_buku_pas_senpi_detail5"></div>
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

<div class=" modal detailModalLetter6" tabindex="-1" role="dialog">
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
                                <label for="letter_status" class="col-md-5 col-form-label">Status pengajuan</label>
                                <div id="letter_status_detail6">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="letter_category_name" class="col-md-5 col-form-label">Kategori surat</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext letter_category_name">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="user_name" class="col-md-5 col-form-label">Nama pemohon</label>
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
                                <label for="club_name" class="col-md-5 col-form-label">Nama club</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext club_name"
                                        value="{{ old('club_name') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="surat_rekomendasi_pengcab" class="col-md-5 col-form-label">File rekomendasi
                                    dari pengcab Perbakin Kab.Bandung</label>
                                <div class="col-md-6">
                                    <div id="surat_rekomendasi_pengcab_detail6"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_nama_anggota_senjata_digunakan" class="col-md-5 col-form-label">File
                                    nama anggota
                                    rombongan dan senjata api yang digunakan</label>
                                <div class="col-md-6">
                                    <div id="file_nama_anggota_senjata_digunakan_detail6"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_kta" class="col-md-5 col-form-label">File KTA Perbakin</label>
                                <div class="col-md-6">
                                    <div id="file_kta_detail6"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_buku_pas_senpi" class="col-md-5 col-form-label">File buku pas senjata
                                    api </label>
                                <div class="col-md-6">
                                    <div id="file_buku_pas_senpi_detail6"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="l6_undangan_berburu" class="col-md-5 col-form-label">File undangan berburu
                                    dari Kepala Desa / Camat lokasi Berburu</label>
                                <div class="col-md-6">
                                    <div id="l6_undangan_berburu_detail6"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_surat_sehat" class="col-md-5 col-form-label">File surat keterangan
                                    sehat dari dokter </label>
                                <div class="col-md-6">
                                    <div id="file_surat_sehat_detail6"></div>
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

<div class=" modal detailModalLetter7" tabindex="-1" role="dialog">
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
                                <label for="letter_status" class="col-md-5 col-form-label">Status pengajuan</label>
                                <div id="letter_status_detail7">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="letter_category_name" class="col-md-5 col-form-label">Kategori surat</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext letter_category_name">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="user_name" class="col-md-5 col-form-label">Nama pemohon</label>
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
                                <label for="club_name" class="col-md-5 col-form-label">Nama club</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext club_name"
                                        value="{{ old('club_name') }}">
                                </div>
                            </div>
                            <div class="col-md-12 row">
                                <label for="l7_alasan_pengunduran" class="col-md-5 col-form-label">Alasan Pengunduran
                                    diri</label>
                                <div class="col-md-12">
                                    <textarea type="text" class="form-control l7_alasan_pengunduran"
                                        name="l7_alasan_pengunduran" id="l7_alasan_pengunduran" rows="5"></textarea>
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

<div class=" modal detailModalLetter8" tabindex="-1" role="dialog">
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
                                <label for="letter_status" class="col-md-5 col-form-label">Status pengajuan</label>
                                <div id="letter_status_detail8">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="letter_category_name" class="col-md-5 col-form-label">Kategori surat</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext letter_category_name">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="user_name" class="col-md-5 col-form-label">Nama pemohon</label>
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
                                <label for="club_name" class="col-md-5 col-form-label">Nama club</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext club_name"
                                        value="{{ old('club_name') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="l8_kta_anggota_baru" class="col-md-5 col-form-label">File KTA 4(empat) orang
                                    anggota yang
                                    sudah memiliki KTA Perbakin dari PB</label>
                                <div class="col-md-6">
                                    <div id="l8_kta_anggota_baru_detail8"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_ktp" class="col-md-5 col-form-label">File KTP</label>
                                <div class="col-md-6">
                                    <div id="file_ktp_detail8"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="l8_adart" class="col-md-5 col-form-label">File AD/ART klub/perkumpulan
                                    menembak yang berisi nama lambang klub, logo klub/arti dan visi misi klub</label>
                                <div class="col-md-6">
                                    <div id="l8_adart_detail8"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="l8_struktur_organisasi" class="col-md-5 col-form-label">File struktur
                                    organisasi pengurus klub </label>
                                <div class="col-md-6">
                                    <div id="l8_struktur_organisasi_detail8"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="l8_nama_para_pengurus" class="col-md-5 col-form-label">File daftar nama para
                                    pengurus klub</label>
                                <div class="col-md-6">
                                    <div id="l8_nama_para_pengurus_detail8"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="l8_pas_foto_pengurus" class="col-md-5 col-form-label">File berisi foto
                                    pengurus klub ukuran 4X6 latar merah</label>
                                <div class="col-md-6">
                                    <div id="l8_pas_foto_pengurus_detail8"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="l8_data_anggota_club" class="col-md-5 col-form-label">File data anggota klub
                                    minimal 20 orang</label>
                                <div class="col-md-6">
                                    <div id="l8_data_anggota_club_detail8"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="l8_surat_keterangan_domisili" class="col-md-5 col-form-label">File surat
                                    keterangan domisili sekretariat klub dari Desa/Kecamatan/Akte pendirian dari Notaris
                                </label>
                                <div class="col-md-6">
                                    <div id="l8_surat_keterangan_domisili_detail8"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_skck" class="col-md-5 col-form-label">File SKCK ketua klub </label>
                                <div class="col-md-6">
                                    <div id="file_skck_detail8"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="biaya_administrasi" class="col-md-5 col-form-label">File bukti biaya
                                    administrasi sebesar Rp. 15.000.000 </label>
                                <div class="col-md-6">
                                    <div id="biaya_administrasi_detail8"></div>
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

<div class=" modal detailModalLetter9" tabindex="-1" role="dialog">
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
                                <label for="letter_status" class="col-md-5 col-form-label">Status pengajuan</label>
                                <div id="letter_status_detail9">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="letter_category_name" class="col-md-5 col-form-label">Kategori surat</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext letter_category_name">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="user_name" class="col-md-5 col-form-label">Nama pemohon</label>
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
                                <label for="club_name" class="col-md-5 col-form-label">Nama club</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext club_name"
                                        value="{{ old('club_name') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_ktp" class="col-md-5 col-form-label">File KTP</label>
                                <div class="col-md-6">
                                    <div id="file_ktp_detail9"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_kta_club" class="col-md-5 col-form-label">File KTA Klub</label>
                                <div class="col-md-6">
                                    <div id="file_kta_club_detail9"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="surat_rekomendasi_club" class="col-md-5 col-form-label">File surat
                                    rekomendasi
                                    dari klub menembak</label>
                                <div class="col-md-6">
                                    <div id="surat_rekomendasi_club_detail9"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_kta" class="col-md-5 col-form-label">File KTA Perbakin</label>
                                <div class="col-md-6">
                                    <div id="file_kta_detail9"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_foto_4x6" class="col-md-5 col-form-label">File foto</label>
                                <div class="col-md-6">
                                    <div id="file_foto_4x6_detail9"></div>
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

<div class=" modal detailModalLetter10" tabindex="-1" role="dialog">
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
                                <label for="letter_status" class="col-md-5 col-form-label">Status pengajuan</label>
                                <div id="letter_status_detail10">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="letter_category_name" class="col-md-5 col-form-label">Kategori surat</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext letter_category_name">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="user_name" class="col-md-5 col-form-label">Nama pemohon</label>
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
                                <label for="club_name" class="col-md-5 col-form-label">Nama club</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext club_name"
                                        value="{{ old('club_name') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_kta" class="col-md-5 col-form-label">File KTA Perbakin</label>
                                <div class="col-md-6">
                                    <div id="file_kta_detail10"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_ktp" class="col-md-5 col-form-label">File KTP</label>
                                <div class="col-md-6">
                                    <div id="file_ktp_detail10"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_buku_pas_senpi" class="col-md-5 col-form-label">File buku pas senjata
                                    api</label>
                                <div class="col-md-6">
                                    <div id="file_buku_pas_senpi_detail10"></div>
                                </div>
                            </div>
                            <div class="col-md-6 row my-1">
                                <label for="file_foto_4x6" class="col-md-5 col-form-label">File foto</label>
                                <div class="col-md-6">
                                    <div id="file_foto_4x6_detail10"></div>
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
{{-- End Modal detail letter  --}}

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

    $('.letter_approval_admin').change(function () {
        let id = $(this).attr('data-id');
        let user = $(this).attr('data-user');
        let status = $('.letter_approval_admin').val();
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

    $('.letter_approval_sekum').change(function () {
        let id = $(this).attr('data-id');
        let user = $(this).attr('data-user');
        let status = $('.letter_approval_sekum').val();
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

    $('.letter_approval_ketua').change(function () {
        let id = $(this).attr('data-id');
        let user = $(this).attr('data-user');
        let status = $('.letter_approval_ketua').val();
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
                        console.log(data);
                        if (data.status == 1) {
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

    // Detail Data
    $('.btnDetail').click(function () {
        let id = $(this).attr('data-id');
        let url = "{{ url('recomendationletter/show') }}";

        $.ajax({
            type: 'GET',
            url: url + '/' + id,
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 1) {
                    switch (data.result[1].letter_category_id) {
                        case 1:
                            $('.detailModalLetter1 .modal-title').text('Detail Data Letter');
                            $('.detailModalLetter1').modal('show');

                            document.getElementById('letter_status_detail1').innerHTML =
                                "<span class='" + data.result[1].style_class + "'>" + data.result[1]
                                .approval_status + "</span>";
                            $('.letter_category_name').val(': ' + data.result[1]
                                .letter_category_name);
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
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_foto_4x6 +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            break;
                        case 2:
                            $('.detailModalLetter2 .modal-title').text('Detail Data Letter');
                            $('.detailModalLetter2').modal('show');

                            document.getElementById('letter_status_detail2').innerHTML =
                                "<span class='" + data.result[1].style_class + "'>" + data.result[1]
                                .approval_status + "</span>";
                            $('.letter_category_name').val(': ' + data.result[1]
                                .letter_category_name);
                            $('.user_name').val(': ' + data.result[1].name);
                            $('.user_kta').val(': ' + data.result[1].no_kta);
                            $('.club_name').val(': ' + data.result[1].club);

                            var filePath = 'storage/uploads/letters/category-' + data.result[1]
                                .letter_category_id +
                                "/";
                            document.getElementById('file_surat_hibah_senpi_detail2').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_surat_hibah_senpi +
                                "' class='btn btn-primary download'>Lihat File</i>";

                            document.getElementById('file_buku_pas_senpi_detail2').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_buku_pas_senpi +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_foto_senjata_detail2').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_foto_senjata +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_kta_detail2').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_kta +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_ktp_detail2').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_ktp +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_sertif_menembak_detail2').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_sertif_menembak +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_skck_detail2').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_skck +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_surat_sehat_detail2').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_surat_sehat +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_tes_psikotes_detail2').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_tes_psikotes +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_kk_detail2').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_kk +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_foto_4x6_detail2').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_foto_4x6 +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            break;
                        case 3:
                            $('.detailModalLetter3 .modal-title').text('Detail Data Letter');
                            $('.detailModalLetter3').modal('show');

                            document.getElementById('letter_status_detail3').innerHTML =
                                "<span class='" + data.result[1].style_class + "'>" + data.result[1]
                                .approval_status + "</span>";
                            $('.letter_category_name').val(': ' + data.result[1]
                                .letter_category_name);
                            $('.user_name').val(': ' + data.result[1].name);
                            $('.user_kta').val(': ' + data.result[1].no_kta);
                            $('.club_name').val(': ' + data.result[1].club);
                            break;
                        case 4:
                            $('.detailModalLetter4 .modal-title').text('Detail Data Letter');
                            $('.detailModalLetter4').modal('show');

                            document.getElementById('letter_status_detail4').innerHTML =
                                "<span class='" + data.result[1].style_class + "'>" + data.result[1]
                                .approval_status + "</span>";
                            $('.letter_category_name').val(': ' + data.result[1]
                                .letter_category_name);
                            $('.user_name').val(': ' + data.result[1].name);
                            $('.user_kta').val(': ' + data.result[1].no_kta);
                            $('.club_name').val(': ' + data.result[1].club);

                            var filePath = 'storage/uploads/letters/category-' + data.result[1]
                                .letter_category_id +
                                "/";
                            document.getElementById('file_si_impor_senjata_detail4').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_si_impor_senjata +
                                "' class='btn btn-primary download'>Lihat File</i>";

                            document.getElementById('file_sba_penitipan_senpi_detail4').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_sba_penitipan_senpi +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_kta_detail4').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2].file_kta +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_ktp_detail4').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_ktp +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_sertif_menembak_detail4').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_sertif_menembak +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_skck_detail4').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_skck +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_surat_sehat_detail4').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_surat_sehat +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_tes_psikotes_detail4').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_tes_psikotes +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_kk_detail4').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_kk +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_foto_4x6_detail4').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_foto_4x6 +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            break;
                        case 5:
                            $('.detailModalLetter5 .modal-title').text('Detail Data Letter');
                            $('.detailModalLetter5').modal('show');

                            document.getElementById('letter_status_detail5').innerHTML =
                                "<span class='" + data.result[1].style_class + "'>" + data.result[1]
                                .approval_status + "</span>";
                            $('.letter_category_name').val(': ' + data.result[1]
                                .letter_category_name);
                            $('.user_name').val(': ' + data.result[1].name);
                            $('.user_kta').val(': ' + data.result[1].no_kta);
                            $('.club_name').val(': ' + data.result[1].club);

                            var filePath = 'storage/uploads/letters/category-' + data.result[1]
                                .letter_category_id +
                                "/";
                            document.getElementById('l5_lampiran1_detail5').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .l5_lampiran1 +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_nama_anggota_senjata_digunakan_detail5')
                                .innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_nama_anggota_senjata_digunakan +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_kta_detail5').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2].file_kta +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_buku_pas_senpi_detail5').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_buku_pas_senpi +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            break;
                        case 6:
                            $('.detailModalLetter6 .modal-title').text('Detail Data Letter');
                            $('.detailModalLetter6').modal('show');

                            document.getElementById('letter_status_detail6').innerHTML =
                                "<span class='" + data.result[1].style_class + "'>" + data.result[1]
                                .approval_status + "</span>";
                            $('.letter_category_name').val(': ' + data.result[1]
                                .letter_category_name);
                            $('.user_name').val(': ' + data.result[1].name);
                            $('.user_kta').val(': ' + data.result[1].no_kta);
                            $('.club_name').val(': ' + data.result[1].club);

                            var filePath = 'storage/uploads/letters/category-' + data.result[1]
                                .letter_category_id +
                                "/";
                            document.getElementById('surat_rekomendasi_pengcab_detail6').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .surat_rekomendasi_pengcab +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_nama_anggota_senjata_digunakan_detail6')
                                .innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_nama_anggota_senjata_digunakan +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_kta_detail6').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2].file_kta +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_buku_pas_senpi_detail6').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_buku_pas_senpi +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_surat_sehat_detail6').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_surat_sehat +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('l6_undangan_berburu_detail6').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .l6_undangan_berburu +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            break;
                        case 7:
                            $('.detailModalLetter7 .modal-title').text('Detail Data Letter');
                            $('.detailModalLetter7').modal('show');

                            document.getElementById('letter_status_detail7').innerHTML =
                                "<span class='" + data.result[1].style_class + "'>" + data.result[1]
                                .approval_status + "</span>";
                            $('.letter_category_name').val(': ' + data.result[1]
                                .letter_category_name);
                            $('.user_name').val(': ' + data.result[1].name);
                            $('.user_kta').val(': ' + data.result[1].no_kta);
                            $('.club_name').val(': ' + data.result[1].club);
                            $('.user_kta').val(': ' + data.result[1].no_kta);
                            $('.club_name').val(': ' + data.result[1].club);
                            $('.l7_alasan_pengunduran').val('Dikarenakan: ' + data.result[1]
                                .l7_alasan_pengunduran);

                            break;
                        case 8:
                            $('.detailModalLetter8 .modal-title').text('Detail Data Letter');
                            $('.detailModalLetter8').modal('show');

                            document.getElementById('letter_status_detail8').innerHTML =
                                "<span class='" + data.result[1].style_class + "'>" + data.result[1]
                                .approval_status + "</span>";
                            $('.letter_category_name').val(': ' + data.result[1]
                                .letter_category_name);
                            $('.user_name').val(': ' + data.result[1].name);
                            $('.user_kta').val(': ' + data.result[1].no_kta);
                            $('.club_name').val(': ' + data.result[1].club);

                            var filePath = 'storage/uploads/letters/category-' + data.result[1]
                                .letter_category_id +
                                "/";
                            document.getElementById('l8_kta_anggota_baru_detail8').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .l8_kta_anggota_baru +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_ktp_detail8')
                                .innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_ktp +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('l8_adart_detail8').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2].l8_adart +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('l8_struktur_organisasi_detail8').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .l8_struktur_organisasi +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('l8_nama_para_pengurus_detail8').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .l8_nama_para_pengurus +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('l8_pas_foto_pengurus_detail8').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .l8_pas_foto_pengurus +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('l8_data_anggota_club_detail8').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .l8_data_anggota_club +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('l8_surat_keterangan_domisili_detail8')
                                .innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .l8_surat_keterangan_domisili +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_skck_detail8').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_skck +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('biaya_administrasi_detail8').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .biaya_administrasi +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            break;
                        case 9:
                            $('.detailModalLetter9 .modal-title').text('Detail Data Letter');
                            $('.detailModalLetter9').modal('show');

                            document.getElementById('letter_status_detail9').innerHTML =
                                "<span class='" + data.result[1].style_class + "'>" + data.result[1]
                                .approval_status + "</span>";
                            $('.letter_category_name').val(': ' + data.result[1]
                                .letter_category_name);
                            $('.user_name').val(': ' + data.result[1].name);
                            $('.user_kta').val(': ' + data.result[1].no_kta);
                            $('.club_name').val(': ' + data.result[1].club);

                            var filePath = 'storage/uploads/letters/category-' + data.result[1]
                                .letter_category_id +
                                "/";
                            document.getElementById('file_ktp_detail9').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_ktp +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_kta_club_detail9')
                                .innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_kta_club +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('surat_rekomendasi_club_detail9').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .surat_rekomendasi_club +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            if (data.result[2].file_kta) {
                                document.getElementById('file_kta_detail9').innerHTML =
                                    "<a target='_blank' href='" + filePath + data.result[2]
                                    .file_kta +
                                    "' class='btn btn-primary download'>Lihat File</i>";
                            } else {
                                document.getElementById('file_kta_detail9').innerHTML =
                                    "<label for='surat_rekomendasi_club' class='col-md-5 col-form-label'>Tidak ada file</label>";
                            }

                            document.getElementById('file_foto_4x6_detail9').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_foto_4x6 +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            break;
                        case 10:
                            $('.detailModalLetter10 .modal-title').text('Detail Data Letter');
                            $('.detailModalLetter10').modal('show');

                            document.getElementById('letter_status_detail10').innerHTML =
                                "<span class='" + data.result[1].style_class + "'>" + data.result[1]
                                .approval_status + "</span>";
                            $('.letter_category_name').val(': ' + data.result[1]
                                .letter_category_name);
                            $('.user_name').val(': ' + data.result[1].name);
                            $('.user_kta').val(': ' + data.result[1].no_kta);
                            $('.club_name').val(': ' + data.result[1].club);

                            var filePath = 'storage/uploads/letters/category-' + data.result[1]
                                .letter_category_id +
                                "/";
                            document.getElementById('file_kta_detail10').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_kta +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_ktp_detail10')
                                .innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_ktp +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_buku_pas_senpi_detail10').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_buku_pas_senpi +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            document.getElementById('file_foto_4x6_detail10').innerHTML =
                                "<a target='_blank' href='" + filePath + data.result[2]
                                .file_foto_4x6 +
                                "' class='btn btn-primary download'>Lihat File</i>";
                            break;
                        default:
                            break;
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

</script>
@endsection
