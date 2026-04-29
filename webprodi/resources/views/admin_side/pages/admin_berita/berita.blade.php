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
                    style="background: linear-gradient(-90deg, #0d5959 0%, #016666 100%);">Kelola Berita
                </h4>
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <button type="button" id="btnModal" class="btn btn-md btn-info"><i class="fas fa-plus"></i>
                        Tambah Data</button>
                </div>
                <div class="table-responsive p-3 text-center">
                    <table class="table table-bordered table-hover table-flush table-sm tb-menu-utama" id="dataTable"
                        width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr class="text-center align-items-center">
                                <th>Cover</th>
                                <th>Tanggal</th>
                                <th>Judul</th>
                                <th>Alamat URL </th>
                                <th>Jumlah Dilihat</th>
                                <th>Tampil</th>
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
    <div class="modal fade" id="modalLabel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" style="overflow-y: auto;">
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
                            <label for="foto_berita">Cover</label>
                            <input type="text" class="form-control" id="foto_berita" name="foto_berita" placeholder="Foto Berita"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="isi">Berita</label>
                            <textarea type="text" class="form-control" id="summernote" name="isi" placeholder="SummerNote" required></textarea>
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
            order: [1, "desc"],
            ajax: "{{ route('informasi_berita.index') }}",
            columns: [{
                    data: "foto_berita",
                    name: "foto_berita",
                    render: function(data, type, row) {
                        // Render kolom gambar
                        return data ?`<img src="${data}" alt="Foto Berita" width="150" height="100" style="object-fit: cover;" />`:
                        `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                            <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z"/>
                        </svg>`;
                    }
                },
                {
                    data: function(data) {
                        var d = new Date(data.ts * 1000);
                        var y = d.getFullYear();
                        var m = d.getMonth() + 1;
                        var dt = d.getDate();
                        if (m < 10)
                            m = '0' + m;
                        if (dt < 10)
                            dt = '0' + dt;
                        return dt + '-' + m + '-' + y;
                    },
                    name: "ts",
                },
                {
                    data: "judul",
                    name: "judul",
                },
                {
                    data: function(data) {
                        var baseUrl = "{{ url('/') }}";
                        var fullUrl = baseUrl + "/berita/detail/" + data.id;

                        return `<div class="input-group">
                            <input type="text" class="form-control copy-url" value="${fullUrl}" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-info copy-btn" data-url="${fullUrl}" data-toggle="tooltip" title="Copy URL">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>`;
                    },
                    name: "url",
                    searchable: false,

                },
                {
                    data: "counters",
                    name: "counters",
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

        // Script to handle the copy button
        $(document).on('click', '.copy-btn', function() {
            var url = $(this).closest('.input-group').find('.copy-url').val();
            var tempInput = document.createElement('input');
            tempInput.value = url;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            alert('URL copied: ' + url);
        });


        $("#btnModal").click(function() {
            $("#saveBtn").val("create-berita");
            $("#saveBtn").html("Tambah Berita");
            $("#modalTitle").html("Tambah Berita");
            $("#formCommon").trigger("reset");
            $("#summernote").summernote('code', '');
            $("#modalLabel").modal("show");
            $("#id").val("");
        });
        $("body").on("click", ".edit", function() {
            var id = $(this).data("id");
            $.get(
                "{{ route('informasi_berita.index') }}" + "/" + id + "/edit",
                function(data) {
                    $("#modalTitle").html("Edit berita");
                    $("#saveBtn").val("edit-berita");
                    $("#saveBtn").html("Edit berita");
                    $("#modalLabel").modal("show");
                    $("#id").val(data.id);
                    $("#judul").val(data.judul);
                    $("#ts").val(new Date(data.ts * 1000).toISOString().slice(0, 10));
                    $("#foto_berita").val(data.foto_berita);
                    $("#tampil").val(data.tampil)
                    var text = $("<div>").html(data.isi).html();
                    var summernote = $('#summernote').summernote('code', text);
                }
            );
        });
        $("#saveBtn").click(function(e) {
            e.preventDefault();
            $('#summernote').summernote('code').html;
            $.ajax({
                data: $("#formCommon").serialize(),
                url: "{{ route('informasi_berita.store') }}",
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
                        url: "{{ route('informasi_berita.store') }}" + "/" + id,
                        success: function(data) {
                            table.draw();
                        },
                        error: function(data) {
                            console.log("Error:", data);
                        },
                    });
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    );
                }
            });
        });
        $(".modal-dialog").css({"overflow-y": "auto", "max-height": "90vh"});
    });
</script>
@endsection
