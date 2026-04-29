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
                    style="background: linear-gradient(-90deg, #0d5959 0%, #016666 100%);">Kelola Artikel
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
                                <th>Tanggal</th>
                                <th>Judul</th>
                                <th>Alamat URL</th>
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
            order: [0, "desc"],
            ajax: "{{ route('informasi_artikel.index') }}",
            columns: [
                { data: function(data) { return formatDate(data.ts); }, name: "ts" },
                { data: "judul", name: "judul" },
                { data: function(data) { return generateUrl(data); }, name: "url", searchable: false },
                { data: "counters", name: "counters" },
                { data: "tampil", name: "tampil" },
                { data: "aksi", name: "aksi", orderable: false, searchable: false }
            ]
        });

        function formatDate(timestamp) {
            var d = new Date(timestamp * 1000);
            var y = d.getFullYear();
            var m = ('0' + (d.getMonth() + 1)).slice(-2);
            var dt = ('0' + d.getDate()).slice(-2);
            return `${dt}-${m}-${y}`;
        }

        function generateUrl(data) {
            var baseUrl = "{{ url('/') }}";
            var fullUrl = baseUrl + "/artikel/detail/" + data.id;
            return `<div class="input-group">
                        <input type="text" class="form-control copy-url" value="${fullUrl}" readonly>
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-info copy-btn" data-url="${fullUrl}" title="Copy URL">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>`;
        }

        $(document).on('click', '.copy-btn', function() {
            var url = $(this).data("url");
            navigator.clipboard.writeText(url);
            alert('URL copied: ' + url);
        });

        $("#btnModal").click(function() {
            resetForm("Tambah artikel");
        });

        $("body").on("click", ".edit", function() {
            var id = $(this).data("id");
            $.get("{{ route('informasi_artikel.index') }}/" + id + "/edit", function(data) {
                resetForm("Edit artikel", data);
            });
        });

        function resetForm(title, data = null) {
            $("#modalTitle").html(title);
            $("#formCommon").trigger("reset");
            $("#summernote").summernote('code', data ? data.isi : '');
            $("#id").val(data ? data.id : "");
            $("#judul").val(data ? data.judul : "");
            $("#ts").val(data ? new Date(data.ts * 1000).toISOString().slice(0, 10) : "");
            $("#tampil").val(data ? data.tampil : "1");
            $("#modalLabel").modal("show");
        }

        $("#saveBtn").click(function(e) {
            e.preventDefault();
            $.ajax({
                data: $("#formCommon").serialize(),
                url: "{{ route('informasi_artikel.store') }}",
                type: "POST",
                dataType: "json",
                success: function(data) {
                    Swal.fire("Success", data.message, "success");
                    $("#modalLabel").modal("hide");
                    table.draw();
                },
                error: function(data) {
                    Swal.fire("Error", "Terjadi kesalahan", "error");
                },
            });
        });

        $("body").on("click", ".delete", function() {
            var id = $(this).data("id");
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan menghapus data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('informasi_artikel.store') }}/" + id,
                        success: function() {
                            Swal.fire('Dihapus!', 'Data berhasil dihapus.', 'success');
                            table.draw();
                        }
                    });
                }
            });
        });

        $('.modal-body').on('click', '.close-upload', function() {
            $(this).closest('.upload-section').remove();
        });
        
        $(".modal-dialog").css({"overflow-y": "auto", "max-height": "90vh"});
    });

</script>
@endsection