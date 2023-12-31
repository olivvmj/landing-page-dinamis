@extends('admin.layouts.main')

@section('title_content', 'Kelola Landing Page')

@section('page_title', 'Kelola Detail Section')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            @yield('title_content')
        </li>
        <li class="breadcrumb-item active">
            @yield('page_title')
        </li>
    </ol>
@endsection

@section('content')
    <section class="section dashboard">
        <!-- Row -->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title" style="margin-bottom: 0px;">@yield('page_title')</h5>
                        <div>
                            <a class="btn btn-primary modal-effect mb-3 data-table-btn" data-bs-effect="effect-super-scaled"
                                onclick="create()">
                                <span class="fe fe-plus"></span>+ Tambah Data Baru
                            </a>
                        </div>
                        <br>
                        <div class="table-responsive text-nowrap">
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Menu</th>
                                        <th style="width: 1%">Gambar</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- COL END -->

            <div class="modal fade" id="modal_form">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <b>
                                <h5 class="modal-title"></h5>
                            </b>
                            <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="id" name="id">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="type_id" class="form-label">Menu</label>
                                                <select class="form-select" id="menu_section" name="menu_section" aria-label="Default select example">
                                                    <option disabled selected>Pilih Menu</option>
                                                    @foreach ($section as $item)
                                                        <option value="{{ $item->id }}" {{ old('menu_section', '') == $item->id ? 'selected' : '' }}>
                                                            {{ $item->menu }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Gambar</label>
                                                <input id="image" class="dropify" type="file" name="image" data-default-file="" data-allowed-file-extensions="jpeg jpg png" accept=".png, .jpg, .jpeg">
                                                <p class="small">format gambar : png, jpg, jpeg</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Judul</label>
                                                <input type="textarea" name="title" class="form-control" id="title"
                                                    value="{{ old('title') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="desc" class="form-label">Deskripsi</label>
                                                <textarea type="textarea" name="desc" class="form-control" id="desc"
                                                    value="{{ old('desc') }}"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-light" data-bs-dismiss="modal">Kembali</button>
                            <button id="btnSave" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row -->
    </section>
@endsection

@section('component_js')

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">


    <script src="{{ asset('admin') }}/assets/js/cdn.jsdelivr.net_npm_dropify_dist_js_dropify.js"></script>

    <!-- DATA TABLE JS-->

    <!-- INTERNAL Summernote Editor js -->
    <script>
        $(document).ready(function() {
            // Inisialisasi Dropify dengan bahasa Indonesia
            $('.dropify').dropify({
                messages: {
                    default: 'Seret dan lepas berkas di sini atau klik',
                    replace: 'Seret dan lepas atau klik untuk mengganti',
                    remove: 'Hapus',
                    error: 'Oops, terjadi kesalahan.'
                }
            });
        });
    </script>

    <script>
        function previewImage() {
            const image = document.querySelector("#image");
            const imgPreview = document.querySelector(".image-preview");
            imgPreview.style.display = "block";
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
                $("#tampilGambar").addClass('mb-3');
                $("#tampilGambar").width("100%");
                $("#tampilGambar").height("300");
            }
        }
    </script>

    <script>
        var $table;

        $(document).ready(function() {
            // Contoh Inisiator datatable severside
            table = $("#datatable").DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
                },
                responsive: true,
                searching: true,
                paging: true,
                info: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: "{{ route('kelola-detail.datatable') }}",
                columnDefs: [{
                        targets: 0,
                        render: function(data, type, full, meta) {
                            return (meta.row + 1);
                        }
                    },
                    {
                        targets: 1,
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).html(cellData);
                            if (cellData.length > 150) {
                                let txt = cellData;
                                $(td).text(txt.substr(0, 150) + '...');
                            }
                        }
                    },
                    {
                        targets: 2,
                        render: function(data, type, full, meta) {
                            var imagePath = full.image;
                            var imageUrl;

                            if (imagePath) {
                                imageUrl = "{{ url('storage/landingpage/detail/') }}/" + imagePath;
                            } else {
                                imageUrl = "{{ asset('template') }}/assets/images/img.png";
                            }

                            return `<img class="img-thumbnail wd-50p wd-sm-100" src="${imageUrl}">`;
                            // return data  = `<img class="img-thumbnail wd-50p wd-sm-100" src="{{ asset('') }}${data}">`;
                        }
                    },
                    {
                        targets: 3,
                        createdCell: function(td, cellData, rowData, row, col) {
                            if (cellData !== null) {
                                $(td).html(cellData);
                                if (cellData.length > 150) {
                                    let txt = cellData;
                                    $(td).text(txt.substr(0, 150) + '...');
                                }
                            } else {
                                $(td).html("");
                            }
                        }
                    },
                    {
                        targets: 4,
                        createdCell: function(td, cellData, rowData, row, col) {
                            if (cellData !== null) {
                                $(td).html(cellData);
                                if (cellData.length > 150) {
                                    let txt = cellData;
                                    $(td).text(txt.substr(0, 150) + '...');
                                }
                            } else {
                                $(td).html("");
                            }
                        }
                    },
                    {
                        targets: 5,
                        render: function(data, type, full, meta) {
                            // console.log(data);
                            return `
                                <div class="btn-list">
                                    <a href="javascript:void(0)" onclick="edit('${data}')" class="btn btn-sm btn-primary modal-effect btn-edit" data-bs-effect="effect-super-scaled"><i class="bi bi-pencil"></i></a>
                                    <a href="javascript:void(0)" onclick="destroy('${data}')" class="btn btn-sm btn-danger btn-delete"><i class="bi bi-trash"></i></a>
                                </div>
                                `;

                            btn = btn.replace(':id', data);

                            return btn;
                        },
                    },
                ],
                columns: [
                    {
                        data: null
                    },
                    {
                        data: 'menu'
                    },
                    {
                        data: 'image'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'desc'
                    },
                    {
                        data: 'detail_id'
                    },
                ]
            });


            $('#btnSave').on('click', function () {
                submit();
            })
            
            $('#form').on('submit', function(e){
                e.preventDefault();

                submit();
            })

        });

        function create() {
            submit_method = 'create';
            var df = '';
            $('#id').val('');
            $('#form')[0].reset();
            df = $('#image').dropify();

            
            // $('.dropify').dropify();
            df = df.data('dropify');
            df.resetPreview();
            df.clearElement();
            $('#modal_form').modal('show');
            $('.modal-title').text('Tambah Data Detail Section');
            // $('#btnSave').on('click', function() {
            //     submit();
            // })
        }

        function edit(id) {
            submit_method = 'edit';
            var df = "";
            df = $('#image').dropify();

            $('#form')[0].reset();

            var url = "{{ route('kelola-detail.edit', ':id') }}";
            url = url.replace(':id', id);

            $.get(url, function(response) {

                var data = response.data;

                // console.log(data.image);

                $('#id').val(data.id);

                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Data Detail Section');
                // $('.dropify').dropify();
                $('#menu_section').val(data.section_id).change();;
                $('#menu').val(data.menu);
                $('#title').val(data.title);
                $('#desc').val(data.desc);

                df = df.data('dropify');
                df.resetPreview();
                df.clearElement();
                df.settings.defaultFile = `{{ asset('storage/landingpage/detail') }}/` + data.image;
                df.destroy();
                df.init();
                previewImage();
            });
        }
        
        function submit() {            
            var id = $('#id').val();
            // console.log(id);
            var form = $('#form')[0];
            var formData = new FormData(form);

            // console.log($('#modal_form #image').val());
        
            var image = $('#image')[0].files[0]; 
            // console.log(image);
            var url = "{{ route('kelola-detail.store') }}";

            $('#btnSave').text('Menyimpan...');
            $('#btnSave').attr('disabled', true);
            
            if (submit_method == 'edit') {
                var url = "{{ route('kelola-detail.update', ':id') }}";
                url = url.replace(':id', id);
                formData.append('_method', 'PUT');

                // console.log(url);
            }                

            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData, 
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status) {
                        var section = data.section;
                        $('#modal_form').modal('hide');
                        Swal.fire({
                            toast: false,
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        table.ajax.reload();

                        $('#btnSave').text('Simpan');
                        $('#btnSave').attr('disabled', false);
                    } else {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                    // resetForm();
                },
                error: function(data) {
                    var error_message = Object.values(data.responseJSON.errors).join(' ');

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Gagal!',
                        text: error_message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    resetForm();
                },
                complete: function() {
                    $('#btnSave').text('Simpan');
                    $('#btnSave').attr('disabled', false);
                }
            });
        }

        function destroy(id) {
            var url = "{{ route('kelola-detail.destroy', ':id') }}";
            url = url.replace(':id', id);

            Swal.fire({
                title: "Yakin ingin menghapus data ini?",
                text: "Ketika data terhapus, anda tidak bisa mengembalikan data tersebut!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Kembali",
                confirmButtonText: "Ya, Hapus!"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: "delete",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            "id": id
                        },
                        dataType: "JSON",
                        success: function(data) {
                            table.ajax.reload();
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: 'Data berhasil dihapus',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    })
                }
            })
        }


        function resetForm() {
            $('#form')[0].reset();
            $('#image').val('');
        }
    </script>
@endsection
