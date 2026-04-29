@extends('admin_side.layout.app')

@section('content')
    <!-- Container Fluid-->

    <div class="container-fluid" id="container-wrapper">
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <h4 class="card-header font-weight-bold text-white text-center"
                        style="background: linear-gradient(-90deg, #0d5959 0%, #016666 100%);">Kelola Pimpinan
                    </h4>
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <button type="button" id="btnModal" class="btn  btn-info"><i class="fas fa-plus"></i>
                            Tambah Data</button>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table table-bordered table-hover table-flush table-sm tb-menu-utama" id="dataTable"
                            width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr class="text-center align-items-center">
                                <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Program Studi</th>
                                    <th>Jabatan</th>
                                    <th>NO SK</th>
                                    <th>Tanggal Berlaku</th>
                                    <th>Berlaku SK</th>
                                    <th>Urut Tampil</th>
                                    <th>Tampilkan</th>
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
                        <form id="formCommon" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="foto_pimpinan">Foto Pimpinan <i>(kosongkan jika tidak ada)</i></label>
                                <div>
                                    <img id="fotoPreview" width="236" height="236" src="#" alt="Preview Foto" style="display: none; margin-bottom: 20px;" />
                                    <input type="file" class="uploads form-control" style="margin-top: 20px;" name="foto_pimpinan" id="foto_pimpinan">
                                </div>
                            </div>

                            <div class="form-group">

                                <input type="hidden" class="form-control" id="id" name="id">
                            </div>
                            <!-- <div class="form-group">
                                <label for="nm_ps">Nama (Nama Otomatis Dicocokan Dari Data Dosen)</label>
                                <input type="text" class="form-control" id="nama_dosen" name="nama_dosen"
                                    placeholder="Nama Dosen" required>
                            </div> -->
                            <div class="form-group">
                                <label for="nm_ps">Nama (Nama Otomatis Dicocokan Dari Data Dosen)</label>
                                <select class="form-control select2" id="nama_dosen" name="nama_dosen" required>
                                    <option value="" disabled selected>Pilih Nama Dosen</option>
                                    @foreach($list_dosen as $dosen)
                                        <option value="{{ $dosen->nama_dosen }}">{{ $dosen->nama_dosen }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="strata">Jabatan</label>
                                <input type="text" class="form-control" id="jabatan" name="jabatan"
                                    placeholder="Jabatan" required>
                            </div>
                            <div class="form-group">
                                <label for="link">No SK</label>
                                <input type="text" class="form-control" id="no_sk_pim" name="no_sk_pim"
                                    placeholder="No SK" required>
                            </div>
                            <div class="form-group">
                                <label for="link">Tanggal SK</label>
                                <input type="date" class="form-control" id="ts_sk_pim" name="ts_sk_pim"
                                    placeholder="Tanggal SK" required>
                            </div>
                            <div class="form-group">
                                <label for="link">SK Berlaku</label>
                                <input type="date" class="form-control" id="ts_berlaku_pim" name="ts_berlaku_pim"
                                    placeholder="SK Berlaku" required>
                            </div>
                            <div class="form-group">
                                <label for="link">Urutan Tampil</label>
                                <input type="number" class="form-control" id="no_urut" name="no_urut"
                                    placeholder="Urutan Tampil" required>
                            </div>
                            <div class="form-group">
                                <label for="link">Tampilkan</label>
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
                ajax: "{{ route('profil_pimpinan.index') }}",
                columns: [
                    {
                        data: "foto_pimpinan",
                        name: "foto_pimpinan",
                    },
                    {
                        data: "nama_dosen",
                        name: "nama_dosen",
                    },
                    {
                        data: "program_studi",
                        name: "program_studi",
                    },

                    {
                        data: "jabatan",
                        name: "jabatan",
                    },

                    {
                        data: "no_sk_pim",
                        name: "no_sk_pim",
                    },
                    {
                        data: function(data) {
                            var d = new Date(data.ts_sk_pim * 1000);
                            var y = d.getFullYear();
                            var m = d.getMonth() + 1;
                            var dt = d.getDate();

                            if (m < 10)
                                m = '0' + m;
                            if (dt < 10)
                                dt = '0' + dt;

                            return dt + '-' + m + '-' + y;
                        },

                        name: "ts_sk_pim",
                    },
                    {
                        data: function(data) {
                            var d = new Date(data.ts_berlaku_pim * 1000);
                            var y = d.getFullYear();
                            var m = d.getMonth() + 1;
                            var dt = d.getDate();

                            if (m < 10)
                                m = '0' + m;
                            if (dt < 10)
                                dt = '0' + dt;

                            return dt + '-' + m + '-' + y;
                        },
                        nama: "ts_berlaku_pim",
                    },
                    {
                        data: "no_urut",
                        nama: "no_urut",
                    },

                    {
                        data: "tampil",
                        nama: "tampil",
                    },

                    {
                        data: "aksi",
                        nama: "aksi",
                        orderable: false,
                        searchable: false,
                    }

                ],
            });
            $("#btnModal").click(function() {
                $("#saveBtn").val("create-pimpinan");
                $("#saveBtn").html("Simpan");
                $("#modalTitle").html("Tambah pimpinan");
                $("#formCommon").trigger("reset");
                $("#modalLabel").modal("show");
                $("#id").val("");
            });
            $("body").on("click", ".edit", function() {
                var id = $(this).data("id");
                $.get(
                    "{{ route('profil_pimpinan.index') }}" + "/" + id + "/edit",
                    function(data) {
                        $("#modalTitle").html("Edit Pimpinan");
                        $("#saveBtn").val("edit-pimpinan");
                        $("#saveBtn").html("Edit Pimpinan");
                        $("#modalLabel").modal("show");
                        $("#nama_dosen").val(data[0].nama_dosen);
                        $("#jabatan").val(data[0].jabatan);
                        $("#no_sk_pim").val(data[0].no_sk_pim);
                        $("#ts_sk_pim").val(new Date(data[0].ts_sk_pim * 1000).toISOString()
                            .slice(
                                0, 10));
                        $("#ts_berlaku_pim").val(new Date(data[0].ts_berlaku_pim * 1000)
                            .toISOString()
                            .slice(
                                0, 10));
                        $("#no_urut").val(data[0].no_urut);
                        $("#tampil").val(data[0].tampil);
                        $("#id").val(data[0].id);
                    }
                );
            });

            $("#saveBtn").click(function(e) {
            e.preventDefault();

            let formData = new FormData($("#formCommon")[0]);  // Mengambil semua data dari form
            $.ajax({
                data: formData,
                url: "{{ route('profil_pimpinan.store') }}",
                type: "POST",
                contentType: false,
                processData: false,
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
                            url: "{{ route('profil_pimpinan.index') }}" + "/" + id,
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

    <script type="text/javascript">
        $(document).ready(function() {
            // Preview gambar sebelum diunggah
            $("#foto_pimpinan").change(function() {
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

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Cari Nama Dosen",
                allowClear: true
            });

            // Batasi tampilan awal hanya 10 data
            $('#nama_dosen option:gt(10)').hide();

            // Tampilkan semua opsi saat pengguna membuka dropdown
            $('#nama_dosen').on('select2:open', function () {
                $('#nama_dosen option').show();
            });
        });
    </script>

@endsection
