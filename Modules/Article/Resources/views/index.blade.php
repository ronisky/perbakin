@extends('layouts.app')
@section('title', 'Data Artikel')

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
                        <h3 class="h3">Data Artikel</h3>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb" class="float-right">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/dashboard">
                                        <i data-feather="home" width="16" height="16" class="me-2">
                                        </i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Data Artikel</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="addData">
                    <a href="javascript:void(0)" class="btn btn-success btnAdd">
                        <i data-feather="plus" width="16" height="16" class="me-2"></i>
                        Tambah Artikel
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped card-table table-hover text-nowrap table-data">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Penulis</th>
                                <th>Judul</th>
                                <th>Isi</th>
                                <th>image</th>
                                <th width="10%">status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (sizeof($articles) == 0)
                            <tr>
                                <td colspan="7" align="center">Data kosong</td>
                            </tr>
                            @else
                            @foreach ($articles as $article)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $article->article_author }}</td>
                                <td title="{{ $article->article_title}}">
                                    @php
                                    $articleTitle = substr($article->article_title, 0, 20);
                                    $title = $articleTitle . '...';
                                    @endphp
                                    {{ $title}}</td>
                                <td title="{{ strip_tags($article->article_content)}}">
                                    @php
                                    $content = substr(strip_tags(html_entity_decode($article->article_content)), 0, 30);
                                    @endphp
                                    {{ $content }}
                                </td>
                                <td title="{{ $title }}">
                                    @php
                                    $fileName = substr($article->image_thumbnail_path, 0, 20);
                                    $extension = pathinfo($article->image_thumbnail_path, PATHINFO_EXTENSION);
                                    $name = $fileName . '...' . $extension;
                                    @endphp
                                    <a href="{{asset('storage/uploads/images')}}/{{$article->image_thumbnail_path}}"
                                        target="_blank"><img width="50px"
                                            src="{{asset('storage/uploads/images')}}/{{$article->image_thumbnail_path}}"
                                            alt="{{$article->image_thumbnail_path}}"></a>
                                </td>
                                <td>
                                    <form id="formStatus">
                                        @csrf
                                        @php
                                        $status = $article->publish_status;
                                        $checked = '';
                                        if($status == 1)
                                        $checked = 'checked';
                                        @endphp
                                        <label class="switch" for="checkboxindex{{$loop->iteration}}">
                                            <input class="checkstatus" id="checkboxindex{{$loop->iteration}}"
                                                type="checkbox" value="{{$article->publish_status}}" name="class_status"
                                                data-id="{{$article->article_id}}" {{$checked}}>
                                            <div class="slider round"></div>
                                        </label>

                                    </form>
                                </td>
                                <td>
                                    @if($article->article_id > 0)
                                    <a href="javascript:void(0)" class="btn btn-icon btnEdit btn-outline-warning"
                                        data-id="{{ $article->article_id }}" data-toggle="tooltip" data-placement="top"
                                        title="Ubah">
                                        <i data-feather="edit" width="16" height="16"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-outline-danger btnDelete"
                                        data-url="{{ url('article/delete/'. $article->article_id) }}"
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
                <h5 class="modal-title">Tambah Artikel</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ url('article/store') }}" method="POST" id="addForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <span class="small mb-3">*Form dengan tanda <span class="text-danger">*</span> Wajib di
                            isi!</span>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="article_category_id">Kategori Artikel<span
                                            class="text-danger">*</span>
                                    </label>
                                    <select class="form-control" name="article_category_id" id="article_category_id">
                                        <option value="" selected="selected">- Pilih Kategori -</option>
                                        @if(sizeof($article_categories) > 0)
                                        @foreach($article_categories as $article_category)
                                        <option value="{{ $article_category->article_category_id }}">
                                            {{ $article_category->article_category_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('article_category_id'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Kategori
                                            tidak boleh sama</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Judul Artikel<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="article_title" id="article_title"
                                        placeholder="Masukan judul artikel" value="{{ old('article_title') }}">
                                    @if ($errors->has('article_title'))
                                    <span class="text-danger">
                                        <label id="basic-error" class="validation-error-label" for="basic">Judul artikel
                                            tidak
                                            boleh sama</label>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3" id="article_status_chose">
                                <div class="form-group">
                                    <label class="form-label">Status Artikel <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control" name="publish_status" id="publish_status">
                                        <option value="">- Status Artikel -</option>
                                        <option value="1">Publish</option>
                                        <option value="0">Review</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <div id="thumbnail-image"></div>
                                    </label>
                                    <select class="form-control" id="change-image-chose">
                                        <option value="">- Ubah Gambar -</option>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                                <div class="form-group change-image">
                                    <label class="form-label">Pilih Image<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="image_thumbnail_path"
                                        id="image_thumbnail_path" value="{{ old('image_thumbnail_path') }}" required>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Konten Artikel<span class="text-danger">*</span></label>
                                    <textarea rows="10" type="text" class="form-control summernote"
                                        name="article_content" id="article_content" height="50"
                                        placeholder="Masukan konten artikel"
                                        required>{{ old('article_content') }}</textarea>
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

    $('#change-image-chose').change(function () {
        let data = $('#change-image-chose').val();
        if (data == 1) {
            $('.change-image').show();
        } else {
            $('.change-image').hide();
        }
    })

    $('.btnAdd').click(function () {
        document.getElementById("addForm").reset();
        let data_images = "";
        data_images = ``
        document.getElementById("image_thumbnail_path").innerHTML = textToHTML(data_images);
        $('#article_status_chose').hide();
        $('#change-image-chose').hide();
        $('.change-image').show();
        $('#thumbnail-image').hide();
        $('.addModal form').attr('action', "{{ url('article/store') }}");
        $('.addModal .modal-title').text('Tambah Artikel');
        $('.addModal').modal('show');
    });

    // check error
    @if(count($errors))
    $('.addModal').modal('show');
    @endif

    $('.btnEdit').click(function () {

        var id = $(this).attr('data-id');
        var url = "{{ url('article/getdata') }}";

        $('.change-image').hide();
        $('#change-image-chose').show();
        $('#thumbnail-image').show();
        $('#image_thumbnail_path').prop('required', false);
        $('.addModal form').attr('action', "{{ url('article/update') }}" + '/' + id);


        $('#article_status_chose').show();
        $('.addModal .modal-title').text('Ubah article');
        $('.addModal').modal('show');
        $.ajax({
            type: 'GET',
            url: url + '/' + id,
            dataType: 'JSON',
            success: function (data) {

                if (data.status == 1) {
                    $('#article_category_id').val(data.result.article_category_id);
                    $('#article_title').val(data.result.article_title);
                    $('#article_content').val(data.result.article_content);
                    $('#publish_status').val(data.result.publish_status);

                    let image_thumbnail_path = data.result.image_thumbnail_path;
                    const path = image_thumbnail_path;
                    const [extension, ...nameParts] = path.split('.').reverse();
                    const dataName = image_thumbnail_path.substr(0, 20) + '.' + extension;
                    let data_images_path = "";
                    data_images_path =
                        `<a href="{{asset('storage/uploads/images')}}/${image_thumbnail_path}" target="_blank" class="image_thumbnail_path"><span>Gambar sekarang = ${dataName}</span></a>`
                    document.getElementById("thumbnail-image").innerHTML = textToHTML(
                        data_images_path);
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
            article_title: "required",
            article_content: "required",
            article_category_id: "required",
            image_thumbnail_path: "required",
        },
        messages: {
            article_title: "Judul artikel tidak boleh kosong",
            article_content: "Konten artikel tidak boleh kosong",
            article_category_id: "Kategori artikel harus dipilih",
            image_thumbnail_path: "Pastikan pilih gambar dengan ekstensi .jpg/.jpeg/.png/.bmp",
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
        let url = "{{ url('article/updatestatus') }}" + '/' + id;
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
                            publish_status: value,
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
                            publish_status: value,
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
