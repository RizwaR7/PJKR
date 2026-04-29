@extends('admin_side.layout.app')

@section('content')
<!-- Container Fluid-->

<div class="container-fluid" id="container-wrapper">
    <!-- Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <h4 class="card-header font-weight-bold text-white text-center"
                    style="background: linear-gradient(-90deg, #0d5959 0%, #016666 100%);">Kelola Visi Misi
                </h4>
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                </div>
                <div class="table-responsive p-3">
                    <form id="formCommon">
                        <input type="hidden" name="id" value="{{ isset($get_visi_misi) ? $get_visi_misi->id :'' }}">
                        <textarea id="summernote" name="isi"></textarea>
                    </form>
                    <button data-id="{{ isset($get_visi_misi) ? $get_visi_misi->id :'' }}" type="button" id="saveBtn"
                        class="btn btn-md mt-2 btn-info"><i class="fas fa-plus"></i>
                        Simpan</button>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var text = $("<div/>")
            .html(`{{ html_entity_decode(isset($get_visi_misi) ? $get_visi_misi->isi :'') }}`)
            .text();
        
        $('#summernote').summernote('code', text);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#saveBtn").click(function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            var get_code = $('#summernote').summernote('code');
            $('#summernote').val(get_code);
            
            $.ajax({
                data: $("#formCommon").serialize(),
                url: "{{ route('profil_visi_misi.store') }}",
                type: "POST",
                dataType: "json",
                success: function(data) {
                    Swal.fire({
                        title: "Berhasil!",
                        text: "Perubahan berhasil disimpan.",
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });
                },
                error: function(data) {
                    Swal.fire({
                        title: "Error!",
                        text: "Terjadi kesalahan, silakan coba lagi.",
                        icon: "error",
                    });
                },
            });
        });
    });
</script>

@endsection
