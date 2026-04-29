@extends('admin_side.layout.app')

@section('content')
    {{-- Content Wrapper --}}

    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <h4 class="card-header font-weight-bold text-white text-center"
                        style="background: linear-gradient(-90deg, #0d5959 0%, #016666 100%);">Kelola Menu
                    </h4>
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <button type="button" id="btnModalMenuUtama" class="btn  btn-primary"><i class="fas fa-plus"></i>
                            Tambah Data</button>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table table-bordered table-hover table-striped table-flush table-sm tb-menu-utama"
                            id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr class="text-center align-items-center">
                                    <th>Nama Menu Utama</th>
                                    <th>Nomor Urut</th>
                                    <th>Link Tujuan</th>
                                    <th>Status</th>
                                    <th>New Tab</th>
                                    <th>Tindakan/Aksi </th>
                                </tr>
                            </thead>

                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Menu Utama --}}
        <div class="modal fade" id="modalMenuUtama" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <form id="formMenuUtama">
                            <div class="form-group">

                                <input type="hidden" class="form-control" id="id_menu" name="idmenu">
                            </div>
                            <div class="form-group">
                                <label for="nama_menu">Nama Menu</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Nama Menu" required>
                            </div>
                            <div class="form-group">
                                <label for="nomor_urut">Nomor Urut</label>
                                <input type="number" class="form-control" id="urut" name="urut"
                                    placeholder="Nomor Urut" required>
                            </div>
                            <div class="form-group">
                                <label for="link">Link</label>
                                <small class="form-text badge bg-danger text-white">
                                    Jangan menggunakan _ (underscore) pada link
                                </small>

                                <input type="text" class="form-control" id="url" name="url"
                                    value="{{ url('/') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="aktif" name="aktif" required>
                                    <option value="1">Aktif</option>
                                    <option value="0">Nonaktif</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="new_tab">New Tab</label>
                                <select class="form-control" id="newtab" name="newtab" required>
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

            var tableMenu = $("#dataTable").DataTable({
                processing: true,
                serverSide: true,
                order: [],

                ajax: "{{ route('admin_menu.index') }}",

                columns: [{
                        data: "nama",
                        name: "nama",
                    },

                    {
                        data: "urut",
                        name: "urut",
                    },
                    {
                        data: "url",
                        name: "url",
                    },
                    {
                        data: "aktif",
                        name: "aktif",
                    },
                    {
                        data: "newtab",
                        name: "newtab",
                    },
                    {
                        data: "aksi",
                        name: "aksi",
                        orderable: false,
                        searchable: false,
                    },
                ],
            });

            $("#btnModalMenuUtama").click(function() {
                $("#saveBtn").val("create-menu");
                $("#saveBtn").html("Tambah Menu Utama");
                $("#modalTitle").html("Tambah Menu Utama");
                $("#formMenuUtama").trigger("reset");
                $("#modalMenuUtama").modal("show");
                $("#id_menu").val("");
            });

            $("body").on("click", ".editMenu", function() {
                var menu_id = $(this).data("id");
                $.get(
                    "{{ route('admin_menu.index') }}" + "/" + menu_id + "/edit",
                    function(data) {
                        $("#modalTitle").html("Edit Menu Utama");
                        $("#saveBtn").val("edit-menu");
                        $("#saveBtn").html("Edit Menu Utama");
                        $("#modalMenuUtama").modal("show");
                        $("#id_menu").val(data.idmenu);
                        $("#nama").val(data.nama);
                        $("#urut").val(data.urut);
                        $("#url").val(data.url);
                        $("#aktif").val(data.aktif);
                        $("#newtab").val(data.newtab);
                    }
                );
            });

            $("#saveBtn").click(function(e) {
                e.preventDefault();

                $.ajax({
                    data: $("#formMenuUtama").serialize(),
                    url: "{{ route('admin_menu.store') }}",
                    type: "POST",
                    dataType: "json",
                    success: function(data) {
                        Swal.fire({
                            title: data.title,
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        });
                        $("#formMenuUtama").trigger("reset");
                        $("#modalMenuUtama").modal("hide");
                        tableMenu.draw();
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

            $("body").on("click", ".deleteMenu", function() {
                var menu_id = $(this).data("id");
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
                            url: "{{ route('admin_menu.store') }}" + "/" + menu_id,
                            success: function(data) {
                                tableMenu.draw();
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                );
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
