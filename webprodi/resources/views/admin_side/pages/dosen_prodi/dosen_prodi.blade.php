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
                        style="background: linear-gradient(-90deg, #0d5959 0%, #016666 100%);">Kelola Dosen Prodi
                    </h4>

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <div class="alert alert-warning" role="alert">
                            <small class="text-white">
                                <i class="fas fa-exclamation-triangle "></i>
                                Perhatian! Tabel ini hanya Melihat dosen prodi yang sudah ada pada sistem. Untuk
                                mengelola data dosen baru, silahkan Hubungi Operator.
                            </small>
                        </div>
                    </div>
                    <div class="table-responsive p-3 text-center">
                        <table class="table table-flush table-sm tb-menu-utama" id="dataTable" width="100%"
                            cellspacing="0">
                            <thead class="thead-light">
                                <tr class="text-center align-items-center">
                                    <th>NIP</th>
                                    <th>Nama</th>
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
        <div class="modal fade" id="modalLabel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                <label for="judul_kegiatan">Judul</label>
                                <input type="text" class="form-control" id="judul_kegiatan" name="judul_kegiatan"
                                    placeholder="Judul" required>
                            </div>
                            <div class="form-group">
                                <label for="isi_kegiatan">Berita</label>
                                <textarea type="text" class="form-control" id="summernote" name="isi_kegiatan" placeholder="SummerNote" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tempat_kegiatan">Tempat Kegiatan</label>
                                <input type="text" class="form-control" id="tempat_kegiatan" name="tempat_kegiatan"
                                    placeholder="Tempat Kegiatan" required>
                            </div>
                            <div class="form-group">
                                <label for="kate">Kategori</label>
                                <select class="form-control" id="kate" name="kate" required>
                                    <option value="1">Informasi</option>
                                    <option value="2">Pengumuman</option>
                                    <option value="3">Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ts">Tanggal Berita</label>
                                <input type="date" class="form-control" id="ts" name="ts"
                                    placeholder="Tanggal Berita" required>
                            </div>
                            <div class="form-group">
                                <label for="tampil">Tampilkan</label>
                                <select class="form-control" id="tampil" name="tampil" required>
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
        .VIpgJd-ZVi9od-ORHb-OEVmcd {
            display: none;
        }

        body {
            top: 0px !important;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#summernote").summernote();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            var table = $("#dataTable").DataTable({
                processing: true,
                serverSide: true,
                order: [0, "desc"],
                ajax: "{{ route('dosen_prodi.index') }}",
                columns: [{
                        data: "nip",
                        name: "nip",
                    },
                    {
                        data: "nama_dosen",
                        name: "nama_dosen"
                    },

                ],
            });
            $("#btnModal").click(function() {
                $("#saveBtn").val("create-agenda");
                $("#saveBtn").html("Tambah agenda");
                $("#modalTitle").html("Tambah agenda");
                $("#formCommon").trigger("reset");
                $("#summernote").summernote('code', '');
                $("#modalLabel").modal("show");
                $("#id").val("");
            });
            $("body").on("click", ".edit", function() {
                var id = $(this).data("id");
                $.get(
                    "{{ route('informasi_agenda.index') }}" + "/" + id + "/edit",
                    function(data) {
                        $("#modalTitle").html("Edit agenda");
                        $("#saveBtn").val("edit-agenda");
                        $("#saveBtn").html("Edit agenda");
                        $("#modalLabel").modal("show");
                        $("#id").val(data.id_kegiatan);
                        $("#tempat_kegiatan").val(data.tempat_kegiatan);
                        $("#judul_kegiatan").val(data.judul_kegiatan);
                        $("#ts").val(new Date(data.ts * 1000).toISOString().slice(0, 10));
                        $("#tampil").val(data.tampil)
                        var text = $("<div>").html(data.isi_kegiatan).html();
                        var summernote = $('#summernote').summernote('code', text);
                    }
                );
            });
            $("#saveBtn").click(function(e) {
                e.preventDefault();
                $('#summernote').summernote('code').html;
                $.ajax({
                    data: $("#formCommon").serialize(),
                    url: "{{ route('informasi_agenda.store') }}",
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
                if (confirm("Anda yakin ingin menghapus?") == false) {
                    return;
                }
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('informasi_agenda.store') }}" + "/" + id,
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
