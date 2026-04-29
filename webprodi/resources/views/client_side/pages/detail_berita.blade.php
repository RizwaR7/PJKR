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
        <div class="textheader" style="width: 100%;">
        </div>
        <div class="section_berita row">
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
                <div class=" featured-post card mb-4 d-flex flex-column align-items-center">
                    @if ($get_detail_berita->foto_berita)
                    <img src="{{ $get_detail_berita->foto_berita }}" class="img-fluid card-img-top banner-img" style="display: block;object-fit: cover;object-position: center;height: 100%;max-height: 200px;width: 100%;">
                    @endif
                    <div class="mb-3 p-2 text-center">
                        <h5>
                            {{ $get_detail_berita->judul }}
                            </h3>
                            <span
                                class="badge sm-badge badge-{{ $get_detail_berita->jenis == 'Berita' ? 'primary' : ($get_detail_berita->jenis == 'Kegiatan' ? 'secondary' : ($get_detail_berita->jenis == 'Pengumuman' ? 'success' : 'danger')) }} text-white">{{ $get_detail_berita->jenis }}</span>
                            <span class="badge sm-badge badge-info text-white "> {{ $get_detail_berita->counters+1 }}
                                Dilihat</span>
                    </div>
                </div>

                <div class="featured-post mb-4 card">
                    <div class="newsdesks">
                        {!! $get_detail_berita->isi !!}
                    </div>
                </div>
                <!-- Pagination Links -->
            </div>

            <!-- Sidebar -->
            @include('client_side.layout.sidebar')
        </div>
    </div>

</div>

<script src="{{ asset('client_side/js/custom-script.js') }}"></script>
@endsection
