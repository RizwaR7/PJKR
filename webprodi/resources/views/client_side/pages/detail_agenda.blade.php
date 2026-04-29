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
        <div class="section_agenda row" style="width: 100%;">
            <!-- Main Post Section -->
            <div class="col-lg-8">
                <div class="col-lg-12 mb-4 ">
                    <div class="text-left">
                        <a href="{{ route('agenda.index') }}" class="btn btn-info btn-icon-split text-light">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">Kembali</span>
                        </a>
                    </div>
                </div>
                <div class=" featured-post card mb-4 d-flex flex-column align-items-center">
                    <div class="mb-3 p-2 text-center">
                        <h5>
                            {{ $get_detail_agenda->judul_kegiatan }}
                            </h3>
                            <span class="badge sm-badge badge-warning text-white">Agenda</span>
                            <span class="badge sm-badge badge-info text-white "> {{ $get_detail_agenda->counters+1 }} Dilihat</span>
                            <span class="badge sm-badge badge-secondary text-white "> {{ $get_detail_agenda->tempat_kegiatan }}</span>
                    </div>
                </div>

                <div class="featured-post mb-4 card">
                    <div class="newsdesks">
                        {!! $get_detail_agenda->isi_kegiatan !!}
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
