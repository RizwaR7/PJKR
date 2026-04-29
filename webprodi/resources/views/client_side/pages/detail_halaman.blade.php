@extends('client_side.layout.app')

@section('content')
<link rel="stylesheet" href="{{ asset('client_side/css/berita.css?v=') . time() }}" />
<style>
.featured-post iframe, .featured-post video {
    width: 100%;
    aspect-ratio: 16/9;
    position: relative;
}
</style>
<!-- Page-->
<div class="page">
    @include('client_side.layout.header')

    <!-- Main Content -->
    <div class="container">
        <div class="textheader" style="width: 100%; height: auto; margin-top: 100px;">
            <p class="judul h5 m-1">
                {{ $get_detail_halaman->judul }}
            </p>
        </div>
        <div class="section_berita row" style="width: 100%; height: auto">
            <!-- Main Post Section -->
            <div class="col-lg-8">
                <div class="col-lg-12 mb-4 ">
                    <div class="text-left">
                        <a href="{{ route('berita.index') }}" class="btn btn-info btn-icon-split text-light">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">Kembali</span>
                        </a>
                    </div>
                </div>

                <div class="mb-3 p-2 text-center">
                    <img src="{{ $get_detail_halaman->foto_halaman }}" alt="" style="width: 100%; height: auto;">
                </div>

                <div class="featured-post mb-4 card">
                    <div class="newsdesks" style="text-align: justify;">
                        {!! $get_detail_halaman->isi !!}
                    </div>
                </div>
                <!-- Pagination Links -->
            </div>

            <!-- Sidebar -->
            @include('client_side.layout.sidebar')

        </div>

        <script src="{{ asset('client_side/js/custom-script.js') }}"></script>
</div>
</div>
@endsection
