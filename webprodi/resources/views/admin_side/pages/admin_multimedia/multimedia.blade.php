@extends('admin_side.layout.app')

@section('content')
    <!-- Container Fluid-->

    <div class="container-fluid" id="container-wrapper">
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <h4 class="card-header font-weight-bold text-white text-center"
                        style="background: linear-gradient(-90deg, #0d5959 0%, #016666 100%);">Kelola Multimedia
                    </h4>
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <div class="alert alert-warning" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                <div>Peringatan! Untuk Melihat Isi Folder, Dapat Mengklik Icon Berwarna Biru Pada Tabel Data
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                        <button type="button" id="btnModalLabel" class="btn btn-md btn-info"><i class="fas fa-plus"></i>
                            Tambah Data</button>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table table-bordered table-hover table-striped table-sm " id="dataTable"
                            width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr class="text-center align-items-center">
                                    <th>Direktori</th>
                                    <th>Jumlah File</th>
                                    <th>Tindakan/Aksi</th>
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
                                <label for="dir">Nama Direktori (Folder)</label>
                                <input type="text" class="form-control" id="dir" name="dir"
                                    placeholder="Nama Folder" required>
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
    @if (isset($page_config['javascript']))
        {!! $page_config['javascript'] !!}
    @endif
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
                ajax: "{{ route('multimedia.index') }}",
                columns: [{
                        data: "dir",
                        name: "dir",
                    },
                    {
                        data: "jumlah",
                        name: "jumlah",
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
                $("#saveBtn").val("tambah-Multimedia");
                $("#saveBtn").html("Tambah Multimedia");
                $("#modalTitle").html("Tambah Multimedia");
                $("#formCommon").trigger("reset");
                $("#modalLabel").modal("show");
                $("#id").val("");
            });

            $("body").on("click", ".editMultimedia", function() {
                var id = $(this).data("id");
                $.get(
                    "{{ route('multimedia.index') }}" + "/" + id + "/edit",
                    function(data) {
                        $("#modalTitle").html("Edit Multimedia");
                        $("#saveBtn").val("edit-kategori");
                        $("#saveBtn").html("Edit Multimedia");
                        $("#modalLabel").modal("show");
                        $("#id").val(data.id);
                        $("#dir").val(data.dir);

                    }
                );
            });
            $("#saveBtn").click(function(e) {
                e.preventDefault();
                $.ajax({
                    data: $("#formCommon").serialize(),
                    url: "{{ route('multimedia.store') }}",
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
                    },
                });
            });

            $("body").on("click", ".deleteMultimedia", function() {
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
                            url: "{{ route('multimedia.index') }}" + "/" + id,
                            success: function(data) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                );
                                table.draw();
                            },
                            error: function(data) {
                                console.log("Error:", data);
                            },
                        });
                    }
                });
            });
        });
    </script>
@endsection
