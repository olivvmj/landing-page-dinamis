@extends('admin.layouts.main')

@section('title_content', 'Kelola Landing Page')

@section('page_title', 'Solusi Parkirkan')

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
                                        <th>Judul</th>
                                        <th>Sub-Judul</th>
                                        <th style="width: 1%">Gambar</th>
                                        <th>Solusi</th>
                                        <th>Deskripsi Solusi</th>
                                        <th>Action</th>
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
                                <input type="hidden" name="image_lama" id="image_lama">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <input type="hidden" id="id" name="id">
                                                <label for="judul" class="form-label">Judul</label>
                                                <input type="text" name="judul" class="form-control" id="judul"
                                                    value="{{ old('judul') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <input type="hidden" id="id" name="id">
                                                <label for="subjudul" class="form-label">Sub Judul</label>
                                                <input type="text" name="subjudul" class="form-control" id="subjudul"
                                                    value="{{ old('subjudul') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Gambar</label>
                                                {{-- <input type="file" id="image" class="dropify" name="image" accept=".png, .jpg, .jpeg" --}}
                                                <input id="image" class="dropify" type="file" name="image" data-default-file="" data-allowed-file-extensions="jpeg jpg png" accept=".png, .jpg, .jpeg">
                                                <p class="small">note : format gambar (png, jpg, jpeg)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="solusi" class="form-label">solusi Aplikasi</label>
                                                <input type="text" id="solusi" class="form-control" name="solusi"
                                                    value="{{ old('solusi') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="desk_solusi" class="form-label">Deskripsi Solusi</label>
                                                <input type="text" id="desk_solusi" class="form-control" name="desk_solusi"
                                                    value="{{ old('desk_solusi') }}">
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


    <script src="https://cdn.jsdelivr.net/npm/dropify/dist/js/dropify.min.js"></script>

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
                responsive: true,
                searching: false,
                paging: false,
                info: false,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: "{{ route('kelola-solusi.datatable') }}",
                columnDefs: [{
                        targets: 0,
                        render: function(data, type, full, meta) {
                            return (meta.row + 1);
                        }
                    },
                    {
                        targets: 1,
                        createdCell: function(td, cellData, rowData, row, col) {
                            if (cellData === null || cellData === undefined || cellData === "") {
                                $(td).html();
                            } else {
                                $(td).html(cellData);
                                if (cellData.length > 150) {
                                    let txt = cellData;
                                    $(td).text(txt.substr(0, 150) + '...');
                                }
                            }
                        },
                    },
                    {
                        targets: 2,
                        createdCell: function(td, cellData, rowData, row, col) {
                            if (cellData === null || cellData === undefined || cellData === "") {
                                $(td).html();
                            } else {
                                $(td).html(cellData);
                                if (cellData.length > 150) {
                                    let txt = cellData;
                                    $(td).text(txt.substr(0, 150) + '...');
                                }
                            }
                        },
                    },
                    {
                        targets: 3,
                        render: function(data, type, full, meta) {
                            var imagePath = full.image;
                            var imageUrl;

                            if (imagePath) {
                                imageUrl = "{{ url('storage/landingpage/solusi/') }}/" + imagePath;
                            } else {
                                imageUrl = "{{ asset('template') }}/assets/images/img.png";
                            }

                            return `<img class="img-thumbnail wd-50p wd-sm-100" src="${imageUrl}">`;
                            // return data  = `<img class="img-thumbnail wd-50p wd-sm-100" src="{{ asset('') }}${data}">`;
                        }
                    },
                    {
                        targets: 4,
                        createdCell: function(td, cellData, rowData, row, col) {
                            if (cellData === null || cellData === undefined || cellData === "") {
                                $(td).html();
                            } else {
                                $(td).html(cellData);
                                if (cellData.length > 150) {
                                    let txt = cellData;
                                    $(td).text(txt.substr(0, 150) + '...');
                                }
                            }
                        },
                    },
                    {
                        targets: 5,
                        createdCell: function(td, cellData, rowData, row, col) {
                            if (cellData === null || cellData === undefined || cellData === "") {
                                $(td).html();
                            } else {
                                $(td).html(cellData);
                                if (cellData.length > 150) {
                                    let txt = cellData;
                                    $(td).text(txt.substr(0, 150) + '...');
                                }
                            }
                        },
                    },
                    {
                        targets: -1,
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
                columns: [{
                        data: null
                    },
                    {
                        data: 'judul'
                    },
                    {
                        data: 'subjudul'
                    },
                    {
                        data: 'image'
                    },
                    {
                        data: 'solusi'
                    },
                    {
                        data: 'desk_solusi'
                    },
                    {
                        data: 'id'
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
            $('.modal-title').text('Tambah Data solusi Parkirkan');
            // $('#btnSave').on('click', function() {
            //     submit();
            // })
        }

        function edit(id) {
            submit_method = 'edit';
            var df = "";
            df = $('#image').dropify();
            
            $('#form')[0].reset();

            var url = "{{ route('kelola-solusi.edit', ':id') }}";
            url = url.replace(':id', id);
            
            $.get(url, function(response) {
                
                var data = response.data;

                // console.log(data.image);

                $('#id').val(data.id);

                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Data solusi');
                // $('.dropify').dropify();
                $('#judul').val(data.judul);
                $('#subjudul').val(data.subjudul);
                $('#solusi').val(data.solusi);
                $('#desk_solusi').val(data.desk_solusi);

                // var imageName = data.solusi.image;

                df = df.data('dropify');
                df.resetPreview();
                df.clearElement();
                df.settings.defaultFile = `{{ asset('storage/landingpage/solusi') }}/`+data.image;
                df.destroy();
                df.init();
                // Tampilkan gambar lama jika ada
                // if (imageName) {
                //     var imageUrl = "{{ url('storage') }}/" + imageName;
                //     $('#image').attr('src', imageUrl);
                // } else {
                //     $('#image').attr('src', "{{ asset('admin/assets/img/default_gambar.png') }}");
                // }

            });
        }
        
        function submit() {
            var id = $('#id').val();
            var form = $('#form')[0];
            var formData = new FormData(form);
        

            var judul = $('#judul').val();
            var subjudul = $('#subjudul').val();
            var image = $('#image')[0].files[0];
            var solusi = $('#solusi').val();
            var desk_solusi = $('#desk_solusi').val();
            // var image = $('#image').prop('files')[0];
            // var submit_method = '';
            // console.log(judul);            
            var url = "{{ route('kelola-solusi.store') }}";

            $('#btnSave').text('Menyimpan...');
            $('#btnSave').attr('disabled', true);
            
            if (submit_method == 'edit') {
                // formData.append('judul', judul);
                // formData.append('subjudul', subjudul);
                // formData.append('solusi', solusi);
                // var url = "{{ route('kelola-solusi.store') }}";
                var url = "{{ route('kelola-solusi.update', ':id') }}";
                url = url.replace(':id', id);
                formData.append('_method', 'PUT');
            }                
            // } else if (submit_method === 'edit') {
            //     var url = "{{ route('kelola-solusi.update', ':id') }}";
            //     url = url.replace(':id', id);
            //     formData.append('_method', 'PUT');
            // }

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
                    console.log(data);
                    if (data.status) {
                        var solusi = data.solusi;
                        console.log("solusi:", solusi);
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
                    resetForm();
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
            var url = "{{ route('kelola-solusi.destroy', ':id') }}";
            url = url.replace(':id', id);

            Swal.fire({
                title: "Yakin ingin menghapus data ini?",
                text: "Ketika data terhapus, anda tidak bisa mengembalikan data tersebut!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
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
