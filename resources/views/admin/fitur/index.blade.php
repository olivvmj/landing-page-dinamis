@extends("admin.layouts.main")

@section("title_content", "Kelola Landing Page")

@section("page_title" , "Fitur Parkirkan")

@section("breadcrumb")
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        Home
    </li>
    <li class="breadcrumb-item active">
        Kelola Landing Page
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
                    <h5 class="card-title" style="margin-bottom: 0px;">Fitur Parkirkan</h5>
                    <div>
                        <a class="btn btn-primary modal-effect mb-3 data-table-btn" data-bs-effect="effect-super-scaled" onclick="create()">
                            <span class="fe fe-plus"></span>Tambah Data Baru
                        </a>
                    </div>
                    <br>
                    <div class="table-responsive text-nowrap">
                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Judul</th>
                                    <th>Sub-Judul</th>
                                    <th style="width: 1%">Image</th>
                                    <th>Fitur</th>
                                    <th>Deskripsi Fitur</th>
                                    <th>Option</th>
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
                        <b><h5 class="modal-title"></h5></b>
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
                                            <input type="text" name="judul" class="form-control" id="judul" value="{{ old('judul') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <input type="hidden" id="id" name="id">
                                            <label for="subjudul" class="form-label">Sub Judul</label>
                                            <input type="text" name="subjudul" class="form-control" id="subjudul" value="{{ old('subjudul') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" id="image" class="dropify" name="image" data-height="150">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="fitur" class="form-label">Fitur</label>
                                            <input type="text" id="fitur" class="form-control" name="fitur" value="{{ old('fitur') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="desk_fitur" class="form-label">Deskripsi Fitur</label>
                                            <input type="text" id="desk_fitur" class="form-control" name="desk_fitur" value="{{ old('desk_fitur') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button  id="btnSave" class="btn btn-primary">Simpan</button>
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
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: "{{ route('kelola-fitur.datatable') }}",
            columnDefs: [
            {
                targets: 0,
                render: function(data, type, full, meta) {
                    return (meta.row + 1);
                }
            },
            {
                targets: 1,
                createdCell: function(td, cellData, rowData, row, col) {
                    $(td).html($(td).text())
                    if($(td).text().length > 150) {
                        let txt = $(td).text()
                        $(td).text(txt.substr(0, 150) + '...')
                    }
                },

            },
            {
                targets: 2,
                createdCell: function(td, cellData, rowData, row, col) {
                    $(td).html($(td).text())
                    if($(td).text().length > 150) {
                        let txt = $(td).text()
                        $(td).text(txt.substr(0, 150) + '...')
                    }
                },
            },
            {
                targets: 3,
                render: function(data, type, full, meta) {
                    var imagePath = full.image;
                    var imageUrl = imagePath ? "{{ url('storage/landingpage/fitur/') }}/" + imagePath : "{{ asset('template') }}/assets/images/pengaturan_tarif.png";
                    return `<img class="img-thumbnail wd-50p wd-sm-100" src="${imageUrl}">`;
                }
            },
            
            {
                targets: 4,
                createdCell: function(td, cellData, rowData, row, col) {
                    $(td).html($(td).text())
                    if($(td).text().length > 150) {
                        let txt = $(td).text()
                        $(td).text(txt.substr(0, 150) + '...')
                    }
                },
            },
            
            {
                targets: 5,
                createdCell: function(td, cellData, rowData, row, col) {
                    $(td).html($(td).text())
                    if($(td).text().length > 150) {
                        let txt = $(td).text()
                        $(td).text(txt.substr(0, 150) + '...')
                    }
                },
            },
            {
                targets: -1,
                render: function(data, type, full, meta) {
                    return `
                    <div class="btn-list">
                        <a href="javascript:void(0)" onclick="edit('${data}')" class="btn btn-sm btn-primary modal-effect btn-edit" data-bs-effect="effect-super-scaled"><i class="bi bi-pencil"></i></a>
                        <a href="javascript:void(0)" onclick="destroy('${data}')" class="btn btn-sm btn-danger btn-delete"><i class="bi bi-trash"></i></a>
                    </div>
                    `;

                    btn = btn.replace(':id', data);
                    
                    return btn;
                },
            }, ],
            columns: [
                { data: null },
                { data: 'judul'},
                { data: 'subjudul'},
                { data: 'image'},
                { data: 'fitur'},
                { data: 'desk_fitur'},
                { data: 'id'}, 
            ]
        });

        
        $('#form').on('submit', function(e){
            e.preventDefault();

            submit();
        })

    });

    function create(){
        submit_method = 'create';

        $('#id').val('');
        $('#form')[0].reset();

        $('#modal_form').modal('show');
        
        $('.dropify').dropify();
        $('.modal-title').text('Tambah Data Solusi Parkirkan');
        $('#btnSave').on('click', function(){
            submit();
        })
    }
    
    function edit(id) {
        submit_method = 'edit';
        var url = "{{ route('kelola-fitur.edit', ':id') }}";
        url = url.replace(':id', id);
        
        $.get(url, function (response) {
            var data = response.data;
            console.log(data);
            
            $('#id').val(data.id);
            $('#modal_form').modal('show');
            $('.dropify').dropify();
            $('.modal-title').text('Edit Data Fitur');
            $('#judul').val(data.fitur.judul);
            $('#subjudul').val(data.fitur.subjudul);
            $('#fitur').val(data.fitur); 
            $('#desk_fitur').val(data.desk_fitur); 
            // Tampilkan gambar lama jika ada
            var imageName = data.solusi.image;
            if (imageName) {
                var imageUrl = "{{ url('storage') }}/" + imageName;
                $('#image').attr('src', imageUrl);
            } else {
                $('#image').attr('src', "{{ asset('admin/assets/img/default_gambar.png') }}");
            }
            
        });
        
        $('#btnSave').on('click', function(){
            submit();
        })
    }

    function destroy(id) {
        var url = "{{ route('kelola-fitur.destroy',":id") }}";
        url = url.replace(':id', id);
    
        Swal.fire({
            title: "Yakin ingin menghapus data ini?",
            text: "Ketika data terhapus, anda tidak bisa mengembalikan data tersbut!",
            icon: "warning",
            showCancelButton  : true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor : "#d33",
            confirmButtonText : "Ya, Hapus!"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url    : url,
                    type   : "delete",
                    data: { 
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        "id":id },
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

    function submit() {
        var id = $('#id').val();
        var form = $('#form')[0];
        var judul = $('#judul').val();
        var subjudul = $('#subjudul').val();
        var image = $('#image').prop('files')[0];
        var fitur = $('#fitur').val();
        var desk_fitur = $('#desk_fitur').val();

        console.log("ID:", id);
        console.log("Judul Section:", judul);
        console.log("Sub Judul Section:", subjudul);
        console.log("Image:", image);
        console.log("Fitur Aplikasi:", fitur);
        console.log("Deskripsi Fitur Aplikasi:", desk_fitur);

        var formData = new FormData(form);
        formData.append('judul', judul);
        formData.append('subjudul', subjudul);
        formData.append('fitur', fitur);
        formData.append('desk_fitur', desk_fitur);

        console.log("FormData:", formData);

        var url = "";

        if (submit_method === 'create') {
            url = "{{ route('kelola-fitur.store') }}";
        } else if (submit_method === 'edit') {
            url = "{{ route('kelola-fitur.update', ':id') }}";
            url = url.replace(':id', id);
            formData.append('_method', 'PUT');
        }

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            processData: false,
            contentType: false,
            data: formData,
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
                    // for (var i = 0; i < data.inputerror.length; i++) {
                    //     $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
                    //     $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                    // }

                    Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'ERROR!',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 2000
                    });

                    $('#btnSave').text('Simpan');
                    $('#btnSave').attr('disabled', false);
                }
            },
            error: function(data) {
                var error_message = "";

                $.each(data.responseJSON.errors, function(key, value) {
                    error_message += value + " ";
                });

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'ERROR!',
                    text: error_message,
                    showConfirmButton: false,
                    timer: 2000
                });

                $('#btnSave').text('Simpan');
                $('#btnSave').attr('disabled', false);
            },
        });
    }
</script>
@endsection