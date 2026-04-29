@extends('admin_side.layout.app')

@section('content')
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <!-- Row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="card mb-4">
        <h4 class="card-header font-weight-bold text-white text-center"
            style="background: linear-gradient(-90deg, #0d5959 0%, #016666 100%);">
            Kelola Struktur Organisasi
        </h4>
        <div class="card-body">
          <div class="alert alert-warning d-inline-block mt-1" role="alert">
            <i class="fas fa-info-circle mr-2"></i> Harap pastikan ukuran gambar agar sesuai dengan ukuran yang telah ditentukan.
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="container mt-4">
                <div class="row">
                  <!-- Kolom untuk gambar -->
                  <div class="col-md-6 d-flex align-items-center justify-content-center">
                      <img style="max-width:100%; height:auto; max-height: 150px; width: 100%;object-fit: cover;object-position: center;" src="{{ asset('assets/images/struktur-organisasi/' . env('PRODI_ID') . '.' . (file_exists(public_path('assets/images/struktur-organisasi/' . env('PRODI_ID') . '.jpg')) ? 'jpg' : (file_exists(public_path('assets/images/struktur-organisasi/' . env('PRODI_ID') . '.jpeg')) ? 'jpeg' : 'png'))) }}?v={{ time() }}" alt="Struktur Organisasi">
                  </div>

                  <!-- Kolom untuk form -->
                  <div class="col-md-6 d-flex flex-column">
                      <div class="mt-3 mt-md-0"> <!-- Tambahkan margin atas -->
                          <h3>Preview Gambar</h3>
                      </div>
                      <form id="formCommon" class="formCommon">
                          <div class="input-group">
                              <input type="file" class="custom-sfile-input" enctype="multipart/form-data" id="logo" name="struktur_organisasi">
                          </div>
                          <div class="input-group-append d-flex justify-content">
                              <button class="btn btn-success mt-2 saveBtn" id="saveBtn" type="submit">Upload</button>
                          </div>
                      </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
    $("#saveBtn").click(function(e) {
      e.preventDefault();
      $.ajax({
        data: new FormData($("#formCommon")[0]),
        processData: false,
        contentType: false,
        url: "{{ route('profil_struktur_organisasi.store') }}",
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
          location.reload();
        },
        error: function(data) {
          var errorText = JSON.parse(data.responseText).message;
          Swal.fire({
            title: data.title,
            text: errorText,
            icon: 'error',
            confirmButtonText: 'Ok'
          });
          console.log("Error:", data);
        },
      });
    });
  });
</script>
@endsection