@extends('admin_side.layout.app')

@section('content')
    <!-- Container Fluid-->

    <div class="container-fluid" id="container-wrapper">
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">

                <div class="card mb-4">
                    <h4 class="card-header font-weight-bold text-white text-center"
                        style="background: linear-gradient(-90deg, #0d5959 0%, #016666 100%);">Kelola File
                    </h4>
                    <a href="{{ route('multimedia.index') }}" class="btn btn-sm btn-secondary"><i
                            class="fas fa-arrow-left"></i> Kembali
                        ke Multimedia</a>
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                        <button type="button" id="btnModalLabel" class="btn btn-md btn-info"><i class="fas fa-plus"></i>
                            Tambah Data</button>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table table-bordered table-hover table-striped table-sm " id="dataTable"
                            width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr class="text-center align-items-center">
                                    <th>Nama File</th>
                                    <th>Alamat URL File</th>
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
                                <label for="dir">Nama File</label>
                                <input type="file" class="form-control" encype="multipart/form-data" id="upload"
                                    name="upload" required>
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
                ajax: "{{ route('direktori.index', [Request::segment(4)]) }}",
                columns: [{
                        data: "nama",
                        name: "nama",
                    },
                    {
                        data: "url",
                        name: "url",
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
                $("#saveBtn").val("tambah-File");
                $("#saveBtn").html("Tambah File");
                $("#modalTitle").html("Tambah File");
                $("#formCommon").trigger("reset");
                $("#modalLabel").modal("show");
                $("#id").val("");
            });

            $("body").on("click", ".editMultimedia", function() {
                var id = $(this).data("id");
                $.get(
                    "{{ route('multimedia.index') }}" + "/" + id + "/edit",
                    function(data) {
                        $("#modalTitle").html("Edit File");
                        $("#saveBtn").val("edit-file");
                        $("#saveBtn").html("Edit File");
                        $("#modalLabel").modal("show");
                        $("#id").val(data.id);
                        $("#dir").val(data.nama);

                    }
                );
            });
            $("#saveBtn").click(function(e) {
                e.preventDefault();
                $.ajax({
                    data: new FormData($("#formCommon")[0]),
                    processData: false,
                    contentType: false,
                    url: "{{ route('direktori.store', [Request::segment(4)]) }}",
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

            $("body").on("click", ".copy-btn", function() {
                var self = $(this);
                var copyText = $(this).closest("tr").find("#copy-url").val();
                navigator.clipboard.writeText(copyText)
                    .then(function() {
                        self.attr('title', 'Copied!')
                            .tooltip('_fixTitle')
                            .tooltip('show')
                            .tooltip('_fixTitle')
                            .attr('title', 'Copy URL');
                        Swal.fire({
                            title: 'Copied!',
                            icon: 'success',
                            timer: 1000
                        });
                    })
                    .catch(function(err) {
                        console.error('Error copying text: ', err);
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
