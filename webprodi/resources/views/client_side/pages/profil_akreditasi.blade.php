@extends('client_side.layout.app')

@section('content')
<link rel="stylesheet" href="{{ asset('client_side/css/berita.css?v=') . time() }}" />

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
                <div class="featured-post mb-12 card">
                    <div class="newsdesks">
                        @if ($profil_akreditasi)
                            <p class="text-dark">
                                            <b>{!! $profil_akreditasi->nm_ps !!}</b>
                                            <br>
                                            telah terakreditasi <b>"{!! $profil_akreditasi->akre !!}"</b>
                                            <br>
                                            oleh Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT)
                            </p>
                            <hr>
                            <p class="text-dark">
                                            <i>Berdasarkan SK Nomor</i>
                                            <br>
                                            <b>{!! $profil_akreditasi->no_sk !!}</b>
                                            <br>
                                            <br>
                                            <a href="{{ asset('/assets/images/file/sertifikat-akreditasi/akreditasi.jpeg') }}"
                                                download="akreditasi.jpg"
                                                class="btn btn-success">Download Sertifikat Akreditasi</a>
                            </p>
                        @else
                            <p class="text-dark">Data akreditasi belum tersedia.</p>
                        @endif

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
