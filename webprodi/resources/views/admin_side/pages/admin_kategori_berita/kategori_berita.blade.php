@extends('admin_side.layout.app')

@section('content')
    <!-- Container Fluid-->

    <div class="container-fluid" id="container-wrapper">
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Kategori Berita</h6>
                        adf/adfa/asdf
                    </div>
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <button type="button" id="btnModalLabel" class="btn btn-md btn-info"><i class="fas fa-plus"></i>
                            Tambah Data</button>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table table-flush table-sm text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr class="text-center align-items-center">
                                    <th>Nama Kategori</th>
                                    <th>Status</th>
                                    <th>Tindakan/Aksi</th>
                                </tr>
                            </thead>
                            <tfoot class="thead-light">
                                <tr class="text-center align-items-center">
                                    <th>Nama Kategori</th>
                                    <th>Status</th>
                                    <th>Tindakan/Aksi</th>
                                </tr>
                            </tfoot>
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
                                <label for="nama_menu">Nama Kategori</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Nama Kategori" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="1">Aktif</option>
                                    <option value="0">Nonaktif</option>
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
                ajax: "{{ route('admin_kategori_berita.index') }}",
                columns: [{
                        data: "nama",
                        name: "nama",
                    },
                    {
                        data: "status",
                        name: "status",
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
                $("#saveBtn").val("tambah-kategori");
                $("#saveBtn").html("Tambah Kategori");
                $("#modalTitle").html("Tambah Kategori");
                $("#formCommon").trigger("reset");
                $("#modalLabel").modal("show");
                $("#id").val("");
            });

            $("body").on("click", ".edit", function() {
                var id = $(this).data("id");
                $.get(
                    "{{ route('admin_kategori_berita.index') }}" + "/" + id + "/edit",
                    function(data) {
                        $("#modalTitle").html("Edit Kategori Berita");
                        $("#saveBtn").val("edit-kategori");
                        $("#saveBtn").html("Edit Kategori Berita");
                        $("#modalLabel").modal("show");
                        $("#id").val(data.id);
                        $("#nama").val(data.nama);
                        $("#status").val(data.status);

                    }
                );
            });

            $("#saveBtn").click(function(e) {
                e.preventDefault();

                $.ajax({
                    data: $("#formCommon").serialize(),
                    url: "{{ route('admin_kategori_berita.store') }}",
                    type: "POST",
                    dataType: "json",
                    success: function(data) {
                        $("#formCommon").trigger("reset");
                        $("#modalLabel").modal("hide");
                        table.draw();
                    },
                    error: function(data) {
                        console.log("Error:", data);
                    },
                });
            });

            $("body").on("click", ".delete", function() {
                var id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('admin_kategori_berita.index') }}" + "/" + id,
                    success: function(data) {
                        table.draw();
                    },
                    error: function(data) {
                        console.log("Error:", data);
                    },
                });
            });
        });
    </script>
@endsection
