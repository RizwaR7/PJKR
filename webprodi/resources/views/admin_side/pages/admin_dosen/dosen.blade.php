@extends('admin_side.layout.app')

@section('content')
<!-- Container Fluid-->

<div class="container-fluid" id="container-wrapper">
    <!-- Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <h4 class="card-header font-weight-bold text-white text-center"
                    style="background: linear-gradient(-90deg, #0d5959 0%, #016666 100%);">Kelola Dosen
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
                                <th>
                                    Foto
                                </th>
                                <th>NIP</th>
                                <th>NIDN</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Nama Ikatan Kerja</th>
                                <th>Golongan</th>
                                <th>Email</th>
                                <th>Scholar ID</th>
                                <th>Sinta ID</th>
                                <th>Sister ID</th>
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
                        <input type="hidden" name="id_dosen" id="id_dosen">
                        <div class="form-group">
                            <label for="nip">NIP Dosen</label>
                            <input type="text" class="form-control" id="nip" name="nip"
                                placeholder="NIP Dosen" required>
                        </div>

                        <div class="form-group">
                            <label for="nidn">NIDN Dosen</label>
                            <input type="text" class="form-control" id="nidn" name="nidn"
                                placeholder="NIDN Dosen" required>
                        </div>

                        <div class="form-group">
                            <label for="foto_dosen">Foto Dosen <i>(kosongkan jika tidak ada)</i></label>
                            <div>
                                <img id="fotoPreview" width="236" height="236" src="#" alt="Preview Foto" style="display: none; margin-bottom: 20px;" />
                                <input type="file" class="uploads form-control" style="margin-top: 20px;" name="foto_dosen" id="foto_dosen">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama_dosen">Nama Dosen</label>
                            <input type="text" class="form-control" id="nama_dosen" name="nama_dosen"
                                placeholder="Nama Dosen" required>
                        </div>

                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin"
                                placeholder="Jenis Kelamin" required>
                        </div>

                        <div class="form-group">
                            <label for="nama_ikatan_kerja">Nama Ikatan Kerja</label>
                            <input type="text" class="form-control" id="nama_ikatan_kerja" name="nama_ikatan_kerja"
                                placeholder="Nama Ikatan Kerja" required>
                        </div>

                        <div class="form-group">
                            <label for="nama_golongan">Nama Golongan</label>
                            <input type="text" class="form-control" id="nama_golongan" name="nama_golongan"
                                placeholder="Nama Golongan" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email_sister"
                                placeholder="Email" required>
                        </div>

                        <div class="form-group">
                            <label for="scholar_id">Scholar ID</label>
                            <input type="text" class="form-control" id="scholar_id" name="scholar_id"
                                placeholder="Scholar ID" required>
                        </div>

                        <div class="form-group">
                            <label for="sinta_id">Sinta ID</label>
                            <input type="text" class="form-control" id="sinta_id" name="sinta_id"
                                placeholder="Sinta ID" required>
                        </div>

                        <div class="form-group">
                            <label for="sister_id">Sister ID</label>
                            <input type="text" class="form-control" id="sister_id" name="sister_id"
                                placeholder="Sister ID" required>
                        </div>

                        <div class="form-group">
                            <label for="nama_program_studi">Program Studi</label>
                            <input type="text" class="form-control" id="nama_program_studi" name="nama_program_studi" value="{{$nama_program_studi}}" readonly
                                placeholder="Nama Program Studi" required>
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
            ajax: "{{ route('profil_dosen.index') }}",
            columns: [


                {
                    data: "foto_dosen",
                    name: "foto_dosen",
                },

                {
                    data: "nip",
                    name: "nip",
                },

                {
                    data: "nidn",
                    name: "nidn",
                },

                {
                    data: "nama_dosen",
                    name: "nama_dosen",
                },

                {
                    data: "jenis_kelamin",
                    name: "jenis_kelamin",
                },

                {
                    data: "nama_ikatan_kerja",
                    name: "nama_ikatan_kerja",
                },

                {
                    data:"nama_golongan",
                    name:"nama_golongan"
                },

                {
                    data: "email_sister",
                    name: "email",
                },
                {
                    data: "scholar_id",
                    name: "scholar_id",
                },

                {
                    data: "sinta_id",
                    name: "sinta_id",
                },

                {
                    data: "sister_id",
                    name: "sister_id",
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
            $("#saveBtn").val("create-dosen");
            $("#saveBtn").html("Simpan");
            $("#modalTitle").html("Tambah Dosen");
            $("#formCommon").trigger("reset");
            $("#modalLabel").modal("show");
            $("#id_dosen").val("");
        });

        $("body").on("click", ".edit", function() {
            var id_dosen = $(this).data("id");
            $.get(
                "{{ route('profil_dosen.index') }}" + "/" + id_dosen + "/edit",
                function(data) {
                    $("#modalTitle").html("Edit Dosen");
                    $("#saveBtn").val("edit-dosen");
                    $("#saveBtn").html("Edit Dosen");
                    $("#modalLabel").modal("show");
                    $("#nama_dosen").val(data[0].nama_dosen);
                    $("#nama_program_studi").val(data[0].nama_program_studi);
                    $("#id_dosen").val(data[0].id_dosen);
                    $("#nip").val(data[0].nip);
                    $("#scholar_id").val(data[0].scholar_id);
                    $("#sinta_id").val(data[0].sinta_id);
                    $("#sister_id").val(data[0].sister_id);
                    $("#nidn").val(data[0].nidn);
                    $("#jenis_kelamin").val(data[0].jenis_kelamin);
                    $("#nama_ikatan_kerja").val(data[0].nama_ikatan_kerja);
                    $("#nama_golongan").val(data[0].nama_golongan);
                    $("#email").val(data[0].email_sister);


                    if (data[0].foto_dosen) {
                        fetch("/" + data[0].foto_dosen).then((res) => res.blob()).then(blob => {
                            const splitted_url = data[0].foto_dosen.split("/")
                            const file = new File([blob], splitted_url[splitted_url.length - 1], {
                                type: blob.type
                            });
                            const container = new DataTransfer();
                            container.items.add(file);
                            document.querySelector("#foto_dosen").files = container.files;
                        });
                    }

                }
            );
        });

        $("#saveBtn").click(function(e) {
            e.preventDefault();

            let formData = new FormData($("#formCommon")[0]); // Mengambil semua data dari form
            $.ajax({
                data: formData,
                url: "{{ route('profil_dosen.store') }}",
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
                        url: "{{ route('profil_dosen.index') }}" + "/" + id,
                        success: function(data) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
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

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Cari Nama Dosen",
            allowClear: true
        });

        // Batasi tampilan awal hanya 10 data
        $('#nama_dosen option:gt(10)').hide();

        // Tampilkan semua opsi saat pengguna membuka dropdown
        $('#nama_dosen').on('select2:open', function() {
            $('#nama_dosen option').show();
        });
    });
</script>

@endsection
