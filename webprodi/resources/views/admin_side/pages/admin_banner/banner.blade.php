@extends('admin_side.layout.app')

@section('content')
    <!-- Container Fluid-->

    <div class="container-fluid" id="container-wrapper">
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <h4 class="card-header font-weight-bold text-white text-center"
                        style="background: linear-gradient(-90deg, #0d5959 0%, #016666 100%);">Kelola Banner Partner
                    </h4>

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                        <button type="button" id="btnModalLabel" class="btn btn-md btn-info"><i class="fas fa-plus"></i>
                            Tambah Data</button>
                    </div>

                    <div class="table-responsive p-3">
                        <table class="table table-flush table-sm text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr class="text-center align-items-center">
                                    <th>Nomor Urut</th>
                                    <th>Banner</th>
                                    <th>Url</th>

                                    <th>Tampil</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Kategori Berita --}}
        <div class="modal fade" id="modalLabel" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formCommon">
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="id" name="id">
                            </div>
                            <div class="form-group">
                                <label for="filegambar">Upload File</label>
                                <small class="text-white badge bg-danger">*Pastikan ukuran gambar 300x100 pixel</small>
                                <input type="file" class="form-control" id="filegambar" name="filegambar">
                            </div>
                            <div class="form-group">
                                <label for="url">Url</label>
                                <input type="text" class="form-control" id="url" name="url">
                            </div>

                            <div class="form-group">
                                <label for="nomor">Nomor</label>
                                <input type="number" class="form-control" id="nomor" name="nomor">
                            </div>
                            <div class="form-group">
                                <label for="tampil">Tampil</label>
                                <select class="form-control" id="tampil" name="tampil">
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="saveBtn" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--END Row-->
    <!---Container Fluid-->
    <style>
        .goog-te-banner-frame.skiptranslate {
            display: none;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            var table = $("#dataTable").DataTable({
                processing: true,
                serverSide: true,
                order: [],
                ajax: "{{ route('banner.index') }}",
                columns: [{
                        data: "nomor",
                        name: "nomor",
                    },
                    {
                        data: "filegambar",
                        name: "filegambar",
                        render: function(data, type, row, meta) {
                            return '<img src="' + "{{ url('/assets/images/banner/') }}" + "/" +
                                data +
                                '" width="50" >';
                        }
                    },
                    {
                        data: "url",
                        name: "url",
                    },

                    {
                        data: "tampil",
                        name: "tampil",
                    },

                    {
                        data: "aksi",
                        name: "aksi",
                        orderable: false,
                        searchable: false,
                    },
                ],
            });
            $("#btnModalLabel").click(function() {
                $("#saveBtn").val("tambah-Banner");
                $("#saveBtn").html("Tambah Banner");
                $("#modalTitle").html("Tambah Banner");
                $("#formCommon").trigger("reset");
                $("#modalLabel").modal("show");
                $("#id").val("");
            });
            $("body").on("click", ".edit", function() {
                var id = $(this).data("id");
                $.get(
                    "{{ route('banner.index') }}" + "/" + id + "/edit",
                    function(data) {
                        $("#modalTitle").html("Edit Banner");
                        $("#saveBtn").val("edit-banner");
                        $("#saveBtn").html("Edit Banner");
                        $("#modalLabel").modal("show");
                        $("#id").val(data.id);
                        $("#grup").val(data.grup);
                        $("#nomor").val(data.nomor);
                        $("#filenama").val(data.filenama);
                        $("#tampil").val(data.tampil);
                        $("#url").val(data.url);
                        $("#besar").val(data.besar);
                        $("#domain").val(data.domain);
                        $("#ukuran").val(data.ukuran);
                    }
                );
            });
            $("#saveBtn").click(function(e) {
                e.preventDefault();
                $.ajax({
                    data: new FormData($("#formCommon")[0]),
                    processData: false,
                    contentType: false,
                    url: "{{ route('banner.store') }}",
                    type: "POST",
                    dataType: "json",
                    success: function(data) {
                        Swal.fire({
                            title: data.title,
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        });
                        $("#formCommon").trigger("reset");
                        $("#modalLabel").modal("hide");
                        table.draw();
                    },
                    error: function(data) {
                        var errorText = JSON.parse(data.responseText).message;
                        Swal.fire({
                            title: data.title,
                            text: errorText,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                        console.log(errorText);
                    },
                });
            });

            $("body").on("click", ".delete", function() {
                var id = $(this).data("id");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('banner.index') }}" + "/" + id,
                            success: function(data) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                );
                                table.draw();
                            },
                            error: function(data) {
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong',
                                    'error'
                                );
                                console.log("Error:", data);
                            },
                        });
                    }
                });

            });
        });
    </script>
@endsection
