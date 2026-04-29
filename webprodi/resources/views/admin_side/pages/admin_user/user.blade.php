@extends('admin_side.layout.app')

@section('content')
    <!-- Container Fluid-->

    <div class="container-fluid" id="container-wrapper">
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <h4 class="card-header font-weight-bold text-white text-center"
                        style="background: linear-gradient(-90deg, #0d5959 0%, #016666 100%);">Kelola User
                    </h4>
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                        <button type="button" id="btnModalLabel" class="btn btn-md btn-info"><i class="fas fa-plus"></i>
                            Tambah Data</button>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table table-flush table-hover table-striped table-bordered " id="dataTable"
                            width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr class="text-center align-items-center">
                                    <th>Username</th>
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
                                <label for="sid">Username</label>
                                <input type="text" class="form-control" id="sid" name="sid">
                            </div>
                            <div class="form-group form_password">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    autocomplete="new-password">
                            </div>

                            <div class="form-group form_old_password">
                                <label for="old_password">Password Lama</label>
                                <input type="password" class="form-control" id="old_password" name="old_password"
                                    autocomplete="new-password">
                            </div>
                            <div class="form-group form_new_password">
                                <label for="new_password">Password Baru</label>
                                <input type="password" class="form-control" id="new_password" name="new_password"
                                    autocomplete="new-password">
                            </div>
                            <div class="form-group form_confirm_password">
                                <label for="confirm_password">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                    autocomplete="new-password">
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
                ajax: "{{ route('user.index') }}",
                columns: [{
                        data: "sid",
                        name: "sid",
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
                $("#saveBtn").val("tambah-User");
                $("#saveBtn").html("Tambah User");
                $(".form_password").removeClass("d-none");
                $(".form_old_password").addClass("d-none");
                $(".form_new_password").addClass("d-none");
                $(".form_confirm_password").addClass("d-none");
                $("#modalTitle").html("Tambah User");
                $("#formCommon").trigger("reset");
                $("#modalLabel").modal("show");
                $("#id").val("");
            });
            $("body").on("click", ".edit", function() {
                var id = $(this).data("id");
                $.get(
                    "{{ route('user.index') }}" + "/" + id + "/edit",
                    function(data) {
                        $("#modalTitle").html("Edit User");
                        $("#saveBtn").val("edit-User");
                        $("#saveBtn").html("Edit User");
                        $("#modalLabel").modal("show");
                        $(".form_old_password").removeClass("d-none");
                        $(".form_new_password").removeClass("d-none");
                        $(".form_confirm_password").removeClass("d-none");
                        $(".form_password").addClass("d-none");
                        $("#formCommon").trigger("reset");
                        $("#id").val(data.id);
                        $("#sid").val(data.sid);
                        $("#pass").val(data.pass);
                    }
                );
            });
            $("#saveBtn").click(function(e) {
                e.preventDefault();
                $.ajax({
                    data: new FormData($("#formCommon")[0]),
                    processData: false,
                    contentType: false,
                    url: "{{ route('user.store') }}",
                    type: "POST",
                    dataType: "json",
                    success: function(data) {
                        $("#formCommon").trigger("reset");
                        $("#modalLabel").modal("hide");
                        Swal.fire({
                            title: data.title,
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        });
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

            $("body").on("click", ".delete", function() {
                var id = $(this).data("id");
                Swal.fire({
                    title: 'Apakah Anda Yakin Menghapus Data Ini?',
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
                            url: "{{ route('user.index') }}" + "/" + id,
                            success: function(data) {
                                Swal.fire(
                                    'Deleted!',
                                    'User has been deleted.',
                                    'success'
                                )
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
                    }
                })
            });

            

        });
    </script>
@endsection
