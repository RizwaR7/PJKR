@extends('admin_side.layout.app')

@section('content')
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <!-- Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <h4 class="card-header font-weight-bold text-white text-center"
                    style="background: linear-gradient(-90deg, #0d5959 0%, #016666 100%);">Kelola Banner Utama
                </h4>
                <div class="card-body">
                    <div class="alert alert-warning d-inline-block mt-1" role="alert">
                        <i class="fas fa-info-circle mr-2"></i> Harap pastikan ukuran gambar agar sesuai dengan ukuran yang telah ditentukan.
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="container mt-4">
                                    <div class="row">
                                        <!-- Kolom untuk gambar -->
                                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                                            <img style="max-width:100%; height:auto; max-height: 150px; width: 100%;object-fit: cover;object-position: center;" src="{{ asset('assets/images/slider/slide-1.' .
                                            (file_exists(public_path('assets/images/slider/slide-1.jpg')) ? 'jpg' : (file_exists(public_path('assets/images/slider/slide-1.jpeg'))
                                            ? 'jpeg' : 'png'))) }}?v={{ time() }}" alt="Slide 1">
                                        </div>

                                        <!-- Kolom untuk form -->
                                        <div class="col-md-6 d-flex flex-column">
                                            <div class="mt-3 mt-md-0"> <!-- Tambahkan margin atas -->
                                                <h3>Slider 1</h3>
                                            </div>
                                            <form id="formCommon1" class="formCommon">
                                                <div class="input-group">
                                                    <input type="file" class="custom-sfile-input" enctype="multipart/form-data" id="logo" name="logo">
                                                </div>
                                                <div class="input-group-append d-flex justify-content">
                                                    <button class="btn btn-success mt-2 saveBtn" id="saveBtn1" type="submit">Upload</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="container mt-4">
                                    <div class="row">
                                        <!-- Kolom untuk gambar -->
                                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                                            <img style="max-width:100%; height:auto; max-height: 150px; width: 100%;object-fit: cover;object-position: center;" src="{{ asset('assets/images/slider/slide-2.' .
                                            (file_exists(public_path('assets/images/slider/slide-2.jpg')) ? 'jpg' : (file_exists(public_path('assets/images/slider/slide-2.jpeg'))
                                            ? 'jpeg' : 'png'))) }}?v={{ time() }}" alt="Slide 2">
                                        </div>

                                        <!-- Kolom untuk form -->
                                        <div class="col-md-6 d-flex flex-column">
                                            <div class="mt-3 mt-md-0"> <!-- Tambahkan margin atas -->
                                                <h3>Slider 2</h3>
                                            </div>
                                            <form id="formCommon2" class="formCommon">
                                                <div class="input-group">
                                                    <input type="file" class="custom-sfile-input" enctype="multipart/form-data" id="logo" name="logo">
                                                </div>
                                                <div class="input-group-append d-flex justify-content">
                                                    <button class="btn btn-success mt-2 saveBtn" id="saveBtn2" type="submit">Upload</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="container mt-4">
                                    <div class="row">
                                        <!-- Kolom untuk gambar -->
                                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                                            <img style="max-width:100%; height:auto; max-height: 150px; width: 100%;object-fit: cover;object-position: center;" src="{{ asset('assets/images/slider/slide-3.' .
                                            (file_exists(public_path('assets/images/slider/slide-3.jpg')) ? 'jpg' : (file_exists(public_path('assets/images/slider/slide-3.jpeg'))
                                            ? 'jpeg' : 'png'))) }}?v={{ time() }}" alt="Slide 3">
                                        </div>

                                        <!-- Kolom untuk form -->
                                        <div class="col-md-6 d-flex flex-column">
                                            <div class="mt-3 mt-md-0"> <!-- Tambahkan margin atas -->
                                                <h3>Slider 3</h3>
                                            </div>
                                            <form id="formCommon3" class="formCommon">
                                                <div class="input-group">
                                                    <input type="file" class="custom-sfile-input" enctype="multipart/form-data" id="logo" name="logo">
                                                </div>
                                                <div class="input-group-append d-flex justify-content">
                                                    <button class="btn btn-success mt-2 saveBtn" id="saveBtn3" type="submit">Upload</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="container mt-4">
                                    <div class="row">
                                        <!-- Kolom untuk gambar -->
                                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                                            <img style="max-width:100%; height:auto; max-height: 150px; width: 100%;object-fit: cover;object-position: center;" src="{{ asset('assets/images/slider/slide-4.' .
                                            (file_exists(public_path('assets/images/slider/slide-4.jpg')) ? 'jpg' : (file_exists(public_path('assets/images/slider/slide-4.jpeg'))
                                            ? 'jpeg' : 'png'))) }}?v={{ time() }}" alt="Slide 4">
                                        </div>

                                        <!-- Kolom untuk form -->
                                        <div class="col-md-6 d-flex flex-column">
                                            <div class="mt-3 mt-md-0"> <!-- Tambahkan margin atas -->
                                                <h3>Slider 4</h3>
                                            </div>
                                            <form id="formCommon4" class="formCommon">
                                                <div class="input-group">
                                                    <input type="file" class="custom-sfile-input" enctype="multipart/form-data" id="logo" name="logo">
                                                </div>
                                                <div class="input-group-append d-flex justify-content">
                                                    <button class="btn btn-success mt-2 saveBtn" id="saveBtn4" type="submit">Upload</button>
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
        $("#saveBtn1").click(function(e) {
            e.preventDefault();
            $.ajax({
                data: new FormData($("#formCommon1")[0]),
                processData: false,
                contentType: false,
                url: "{{ route('slider.store') }}?filename=slide-1",
                type: "POST",
                dataType: "json",
                success: function(data) {
                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    });
                    $("#formCommon1").trigger("reset");
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
        $("#saveBtn2").click(function(e) {
            e.preventDefault();
            $.ajax({
                data: new FormData($("#formCommon2")[0]),
                processData: false,
                contentType: false,
                url: "{{ route('slider.store') }}?filename=slide-2",
                type: "POST",
                dataType: "json",
                success: function(data) {
                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    });
                    $("#formCommon1").trigger("reset");
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
        $("#saveBtn3").click(function(e) {
            e.preventDefault();
            $.ajax({
                data: new FormData($("#formCommon3")[0]),
                processData: false,
                contentType: false,
                url: "{{ route('slider.store') }}?filename=slide-3",
                type: "POST",
                dataType: "json",
                success: function(data) {
                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    });
                    $("#formCommon1").trigger("reset");
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
        $("#saveBtn4").click(function(e) {
            e.preventDefault();
            $.ajax({
                data: new FormData($("#formCommon4")[0]),
                processData: false,
                contentType: false,
                url: "{{ route('slider.store') }}?filename=slide-4",
                type: "POST",
                dataType: "json",
                success: function(data) {
                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    });
                    $("#formCommon1").trigger("reset");
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