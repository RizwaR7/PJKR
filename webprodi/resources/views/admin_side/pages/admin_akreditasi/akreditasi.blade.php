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
                        style="background: linear-gradient(-90deg, #0d5959 0%, #016666 100%);">Kelola Akreditasi
                    </h4>
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                            <!-- <button type="button" id="btnModalMenuUtama" class="btn btn-sm btn-primary"><i
                                    class="fas fa-plus"></i>
                                Tambah Data
                            </button> -->

                    </div>
                    <div class="table-responsive p-3">
                        <table class="table table-bordered table-hover  table-flush table-sm tb-menu-utama" id="dataTable"
                            width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr class="text-center align-items-center">
                                    <th>Sertifikat</th>
                                    <th>Nama</th>
                                    <th>Starta</th>
                                    <th>Akreditasi</th>
                                    <th>No SK</th>
                                    <th>Mulai Berlaku</th>
                                    <th>Hingga Tanggal</th>
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
        {{-- Modal Label --}}
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
                                <label for="nm_ps">Nama</label>
                                <input type="text" class="form-control" id="nm_ps" name="nm_ps"
                                    placeholder="Nama Prodi" required>
                            </div>
                            <div class="form-group">
                                <label for="strata">Strata</label>
                                <input type="text" class="form-control" id="strata" name="strata"
                                    placeholder="Strata" required>
                            </div>
                            <div class="form-group">
                                <label for="link">Akre</label>
                                <input type="text" class="form-control" id="akre" name="akre" placeholder="Link"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="link">Nomor SK</label>
                                <input type="text" class="form-control" id="no_sk" name="no_sk" placeholder="Link"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="link">Tanggal SK</label>
                                <input type="date" class="form-control" id="ts_sk" name="ts_sk" placeholder="Link"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="link">Tanggal SK</label>
                                <input type="date" class="form-control" id="ts_berlaku" name="ts_berlaku"
                                    placeholder="Link" required>
                            </div>
                            <div class="form-group">
                                <label for="foto_akreditasi">Link Sertifikat Akreditasi</label>
                                <p style="font-size: 11px;" class="text-warning">pastikan disimpan dalam folder sertifikat-akreditasi dan nama file sertifikat.jpeg agar dapat dibaca oleh sistem</p>
                                <input type="text" class="form-control" id="foto_akreditasi" name="foto_akreditasi"
                                    placeholder="Sertifikat Akreditasi Prodi" required>
                            </div>
                            <div class="form-group">
                                <img src="{{ asset('/assets/images/file/sertifikat-akreditasi/akreditasi.jpeg') }}" alt="Sertifikat Akreditasi" style="width: 480px; height: auto;">
                            </div>
                            <div class="form-group">
                                 <!-- Tombol Download -->
                                 <a href="{{ asset('/assets/images/file/sertifikat-akreditasi/akreditasi.jpeg') }}" download="Sertifikat_Akreditasi.jpg" class="btn btn-primary">Download Sertifikat</a>
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
                ajax: "{{ route('profil_akreditasi.index') }}",
                columns: [
                    {
                        data: "foto_akreditasi",
                        name: "foto_akreditasi",
                        render: function(data, type, row) {
                            return `<img src="/assets/images/file/sertifikat-akreditasi/akreditasi.jpeg" alt="Akreditasi" style="width: 100px; height: auto;">`;
                        }
                    },

                    {
                        data: "nm_ps",
                        name: "nm_ps",
                    },
                    {
                        data: "strata",
                        name: "strata",
                    },
                    {
                        data: "akre",
                        name: "akre",
                    },
                    {
                        data: "no_sk",
                        nama: "no_sk",
                    },
                    {
                        data: function(data) {
                            var d = new Date(data.ts_sk * 1000);
                            var y = d.getFullYear();
                            var m = d.getMonth() + 1;
                            var dt = d.getDate();

                            if (m < 10)
                                m = '0' + m;
                            if (dt < 10)
                                dt = '0' + dt;

                            return dt + '-' + m + '-' + y;
                        },
                        name: "ts_sk",
                    },
                    {
                        data: function(data) {
                            var d = new Date(data.ts_berlaku * 1000);
                            var y = d.getFullYear();
                            var m = d.getMonth() + 1;
                            var dt = d.getDate();
                            if (m < 10)
                                m = '0' + m;
                            if (dt < 10)
                                dt = '0' + dt;
                            return dt + '-' + m + '-' + y;
                        },
                        nama: "ts_berlaku",
                    }, {
                        data: "aksi",
                        nama: "aksi",
                        orderable: false,
                        searchable: false,
                    }

                ],
            });


            $("#btnModalMenuUtama").click(function() {
                $("#saveBtn").val("create-menu");
                $("#saveBtn").html("Tambah Menu Utama");
                $("#modalTitle").html("Tambah Menu Utama");
                $("#formMenuUtama").trigger("reset");
                $("#modalMenuUtama").modal("show");
                $("#id").val("");
            });

            $("body").on("click", ".edit", function() {
                var id = $(this).data("id");
                $.get(
                    "{{ route('profil_akreditasi.index') }}" + "/" + id + "/edit",
                    function(data) {
                        $("#modalTitle").html("Edit Akreditasi");
                        $("#saveBtn").val("edit-akreditasi");
                        $("#saveBtn").html("Edit Akreditasi");
                        $("#modalLabel").modal("show");
                        $("#nm_ps").val(data.nm_ps);
                        $("#strata").val(data.strata);
                        $("#akre").val(data.akre);
                        $("#no_sk").val(data.no_sk);
                        $("#ts_sk").val(new Date(data.ts_sk * 1000).toISOString().slice(0, 10));
                        $("#ts_berlaku").val(new Date(data.ts_berlaku * 1000).toISOString().slice(0,
                            10));
                        $("#foto_akreditasi").val(data.foto_akreditasi);
                        $("#id").val(data.id);
                    }
                );
            });

            $("#saveBtn").click(function(e) {
                e.preventDefault();
                var id = $('.edit').data("id");
                $('#id').val(id);
                $.ajax({
                    data: $("#formCommon").serialize(),
                    url: "{{ route('profil_akreditasi.index') }}" + "/" + id,
                    type: "PUT",
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
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            // Preview gambar sebelum diunggah
            $("#foto_dosen").change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $("#fotoPreview").attr("src", e.target.result).show();
                };
                reader.readAsDataURL(this.files[0]);
            });

            // Reset preview saat modal ditutup
            $('#modalLabel').on('hidden.bs.modal', function() {
                $('#fotoPreview').hide();
                $('#formCommon')[0].reset();
            });
        });
    </script>
@endsection
