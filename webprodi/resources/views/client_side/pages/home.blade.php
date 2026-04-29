@extends('client_side.layout.app')

@section('content')

<!-- Page-->
<div class="page">
    @include('client_side.layout.header')
    <div class="swiper-container swiper-slider" data-effect="frame-trapeze" data-loop="true" data-autoplay="5000"
        data-speed="1000" data-mousewheel="false" data-keyboard="true" data-frame-fill="url(#gradient1)">
        <div class="swiper-wrapper">
            <div class="swiper-slide" data-swiper-parallax="-30%" style="background: url('/assets/images/slider/slide-1.jpg') no-repeat center center fixed; width: 100%; height: 100vh; background-size: cover;">
                <div class="swiper-slide-caption">
                    <div style="padding: 4rem; border-radius: .6rem; margin-bottom: 4.5rem;" data-swiper-anime='{ "animation": "fadeIn", "duration": 1000, "delay": 500 }'>
                        <h3 class="text-white text-capitalize" style="line-height: 1.1; margin-bottom: .2em;letter-spacing: .1rem;">
                            Selamat Datang
                            Di Halaman Resmi <br>
                            Jurusan {{env('PRODI_NAME_ALIAS')}}
                        </h3>
                        <h5 class="text-white">
                            Universitas Palangka Raya
                        </h5>
                    </div>

                </div>
            </div>
            @foreach ($berita->take(3) as $key => $data_berita)
            <div class="swiper-slide" data-swiper-parallax="-30%" style="background: url('/assets/images/slider/slide-{{ $key+2 }}.jpg') no-repeat center center fixed; width: 100%; height: 100vh; background-size: cover;">
                <div class="swiper-slide-caption context-dark">
                    <div style="padding: 4rem; border-radius: .6rem; margin-bottom: 4.5rem;" data-swiper-anime='{ "animation": "fadeIn", "duration": 1000, "delay": 500 }'>
                        <h5 class="text-white" data-swiper-anime=' { "animation" : "fadeIn" , "duration" : 1000, "delay" : 500 }'>
                            {{ $data_berita->judul }}
                        </h5>
                        <a class="button btn btn-success text-white border-0"
                            href="{{ route('detail_berita.index', ['id' => str_replace([' ', '/'], ['_', '||'], $data_berita->judul)]) }}"
                            data-swiper-anime='{ "animation": "swiperContentStack", "duration": 1000, "delay": 500 }'>Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev linear-icon-chevron-left" style="border-radius: 1rem;"></div>
        <div class="swiper-button-next linear-icon-chevron-right" style="border-radius: 1rem;"></div>
    </div>


    <section class="section-sm text-center decor-text" style="background-color:rgb(51, 51, 51);">
        <br>
        <div class="container">
            <h5 class="heading-decorated text-white ">Akreditasi</h5>
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <!-- Bagian Kiri -->
                    <div class="col-md-6">
                        <article class="blurb blurb-minimal">
                            <div class="unit flex-row unit-spacing-md">
                                <div class="unit-left" style="z-index: 2">
                                    <p class="text-white">
                                        <b>{!! $akreditasi->nm_ps !!}</b>
                                        <br>
                                        telah terakreditasi <b>"{!! $akreditasi->akre !!}"</b>
                                        <br>
                                        oleh Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT)
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>

                    <!-- Bagian Kanan -->
                    <div class="col-md-6">
                        <article class="blurb blurb-minimal">
                            <div class="unit flex-row unit-spacing-md">
                                <div class="unit-left" style="z-index: 2">
                                    <p class="text-white">
                                        <i>Berdasarkan SK Nomor</i>
                                        <br>
                                        <b>{!! $akreditasi->no_sk !!}</b>
                                        <br>
                                        <br>
                                        <a href="{{ asset('/assets/images/file/sertifikat-akreditasi/akreditasi.jpeg') }}"
                                            download="akreditasi.jpg"
                                            class="btn btn-success">Download Sertifikat Akreditasi</a>
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>

        </div>
        <br>
    </section>

    <!-- Visi Misi-->
    <section class="section-sm bg-default text-center decor-text" style="background-color: #E5E5E5;" id="features">
        <br>
        <div class="container">
            <h5 class="heading-decorated text-success">Visi dan Misi</h5>
            <div class="d-flex justify-content-center">
                <!-- Blurb circle-->
                <article class="blurb blurb-minimal">
                    <div class="unit flex-row unit-spacing-md">
                        <div class="unit-left" style="z-index: 2">

                            {!! $profil->isi !!}

                        </div>
                    </div>
                </article>
            </div>
        </div>
        <br>
    </section>

    <!-- BERITA DAN AGENDA -->
    <section class="section-sm bg-default text-center decor-text ">
        <div class="section-sm section-divided">
            <div class="container">
                <div class="row row-50 row-md-75">
                    <div class="col-lg-8 section-divided__main">
                        <!-- recent comments-->
                        <section class="section-sm">
                            <h5 class="heading-decorated text-success">Berita</h5>
                        </section>
                        <div class="">
                            @foreach ($berita as $berita)
                            <div class="featured-post mb-4 card">
                                <a href="{{ route('detail_berita.index', ['id' =>  $berita->id]) }}" class="newsdesk" style="color: inherit;">

                                    @if ($berita->foto_berita)
                                    <img src="{{ $berita->foto_berita }}" class="img-fluid card-img-top banner-img">
                                    @endif

                                    <!-- Judul berita -->
                                    <p class="h5 text-left mt-3">{{ $berita->judul }}</p>

                                    <!-- Tanggal dan jenis berita -->
                                    <p>
                                        {{ \Carbon\Carbon::parse($berita->ts)->format('d F Y') }}
                                        <span>
                                            <span class="badge md-badge badge-{{ $berita->jenis == 'Berita' ? 'warning' : ($berita->jenis == 'Kegiatan' ? 'secondary' : ($berita->jenis == 'Pengumuman' ? 'success' : 'danger')) }} text-white">
                                                {{ $berita->jenis }}
                                            </span>
                                            <span class="badge md-badge ml-2 badge-secondary text-white">
                                                {{ $berita->counters }} Dilihat
                                            </span>
                                        </span>
                                    </p>

                                    <!-- Konten berita -->
                                    <p>{{ Str::limit(strip_tags($berita->isi), 100) }}</p>

                                    <!-- Tombol untuk detail berita -->
                                    <a href="{{ route('detail_berita.index', ['id' =>  $berita->id]) }}"
                                        class="btn btn-success">
                                        Selanjutnya
                                    </a>
                                </a>
                            </div>
                            @endforeach



                        </div>
                        <div class="d-flex justify-content-center mt-1 ">
                            <a href=/berita class="btn btn-md tag-pink text-light w-100 bg-success rounded-pill">Lihat
                                Berita
                                Selengkapnya<span class="ml-1"><i class="fa fa-angle-down"></i></span></a>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex  section-divided__aside">
                        <!-- Posts-->
                        <section class="section-sm">
                            <h5 class="mb-5 heading-decorated text-success">Agenda
                            </h5>

                            <ul class="list-sm card-body card text-left ">
                                @foreach ($agenda as $agenda_data)
                                <li class="list-unstyled">
                                    <!-- Post inline-->
                                    <article class="post-inline">
                                        <div class="post-inline__header">
                                            <span class="badge md-badge badge-secondary text-white">
                                                {{ \Carbon\Carbon::createFromTimestamp($agenda_data->ts)->format('d M Y') }}</span>
                                            <span class="ml-2">

                                            </span>

                                        </div>
                                        <p class="post-inline__link">
                                            <a width="100%"
                                                href="{{ route('detail_agenda.index', ['id' =>  $agenda_data->id_kegiatan]) }}">{{ $agenda_data->judul_kegiatan }}</a>
                                        </p>
                                    </article>
                                </li>
                                @endforeach
                                <div class="d-flex justify-content-center mt-4 ">
                                    <a href="{{ route('agenda.index') }}"
                                        class="btn btn-md tag-pink text-light bg-success rounded w-100">Lihat
                                        Selengkapnya<span class="ml-1"><i
                                                class="fa fa-angle-down"></i></span></a>
                                </div>
                            </ul>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PIMPINAN -->
    <section class="section-md text-center bg-default">
        <div class="container">
            <h5 class="heading-decorated text-success">Pimpinan</h5>
            <div class="row row-30 justify-content-center">
                @foreach ($get_pimpinan as $pimpinan)
                <div class="col-sm-6 col-md-3">
                    <figure class="box-icon-image d-flex justify-content-center">
                        <div class="card shadow p-3" style="width: 300px; height: 400px; display: flex; flex-direction: column; align-items: center; justify-content: space-between; overflow: hidden;">
                            <div class="text-center" style="width: 250px;">
                                <img alt="" width="100%" style="max-width: 200px; height: 250px; object-fit: cover; object-position: top; margin-left: auto; margin-right: auto;"
                                    @if($pimpinan->foto_pimpinan)
                                    src="{{ $pimpinan->foto_pimpinan }}"
                                    @endif
                                />
                            </div>
                            <div class="text-secondary text-center" style="width: 100%; flex-grow: 1; display: flex; flex-direction: column; justify-content: center; text-align: center;">
                                <br>
                                <span style="font-size: clamp(12px, 1.5vw, 16px); font-weight: bold;">{{ $pimpinan->pimpinan->nama_dosen ?? '-' }}</span>
                                <br>
                                <span style="font-size: clamp(10px, 1.2vw, 14px);">NIP. {{ $pimpinan->pimpinan->nip ?? '-' }}</span>
                                <hr>
                                <span class="text-dark font-weight-bold" style="font-size: clamp(10px, 1.3vw, 14px);">{{ $pimpinan->jabatan ?? '-' }}</span>
                            </div>
                        </div>

                    </figure>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- PARTNER -->
    <section class="section-sm text-center bg-default">
        <div class="container">
            <h5 class="heading-decorated text-center text-success">Mitra Kami</h5>
            <div class="row justify-content-center align-items-center">
                @foreach ($get_banner as $sponsor)

                <div class="col-md-2 mb-2">
                    <a href="{{ $sponsor->url }}">
                        <!-- <img src="{{ asset('assets/images/banner/' . $sponsor->filegambar) }}" style="width: 40%; height: auto;" class="img-fluid" alt=""> -->
                        <img src="{{ asset('assets/images/banner/' . $sponsor->filegambar) }}"
                            class="img-fluid responsive-image"
                            alt="Gambar Banner">
                    </a>
                </div>

                @endforeach
            </div>
        </div>
    </section>

    <!-- Video -->
    @if(isset($video) and $video->url)
    <section class="section-sm bg-default decor-text" style="background-color: #E5E5E5;" id="features">
        <div class="container">
            <h5 class="heading-decorated heading-decorated_center text-success text-center">{{ $fakultas->nm_fak }}</h5>
            <div class="row d-flex justify-content-center align-items-center p-4">
                <div class="col-lg-6 col-md-12 text-center mb-4">

                    <div class="video-container text-center">
                        <div id="video-wrapper"></div>
                        <div id="unsupported-message" class="unsupported-message" style="display: none; color: red;">
                            Format video tidak didukung.
                        </div>
                    </div>
                    <div id="noConnectionMessage" style="display: none; color: red; font-size: 18px; margin-top: 10px;">
                        Tidak ada koneksi internet. Silakan coba lagi nanti.
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 text-dark text-left">
                    <h6>{{ $video->name }}</h6>
                    <p style="text-align: justify;">
                        {{ $video->desc }}
                    </p>
                    <a href="/profil/sejarah" class="btn btn-success fw-bold d-inline-flex align-items-center" style="border-radius: 50px;">
                        Sejarah
                        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" class="arrow-icon" style="margin-left: 8px;">
                            <path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z" fill="white" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Page Footer-->
    <section class="pre-footer-corporate bg-image-7 bg-overlay-darkest py-4">
        <div class="container">
            <div class="row justify-content-center">

                <!-- Kolom Gambar Footer -->
                @if ($footersgambar->isNotEmpty())
                <div class="col-md-4 col-lg-3 text-center mb-3">
                    @foreach ($footersgambar as $f)
                    <a href="{{ $f->url }}" target="_blank">
                        <img src="{{ $f->url }}" alt="Gambar Footer" class="img-fluid" style="max-width: 200px; height: auto;" target="_blank" rel="noopener noreferrer">
                    </a>
                    @endforeach
                </div>
                @endif

                <!-- Kolom Link Terkait -->
                @if ($footerslink->isNotEmpty())
                <div class="col-md-4 col-lg-3 mb-3">
                    <h6 class="fw-bold">Link Terkait</h6>
                    <hr class="mt-0 mb-2">
                    <ul class="list-unstyled">
                        @foreach ($footerslink as $f)
                        <li style="display: flex; align-items: flex-start;">
                        @if(!empty($f->icon_key))
                            <img id="icon_preview_{{ $f->id }}"
                                src="{{ asset('/assets/images/footer_icon/' . $f->icon_key . '.svg') }}"
                                style="width: 20px; filter: brightness(0) invert(1); margin-right: 10px;">
                        @else
                            <div style="width: 20px; filter: brightness(0) invert(1); margin-right: 10px;">

                            </div>
                        @endif
                            <a href="{{ $f->url }}" class="text-decoration-none" target="_blank" rel="noopener noreferrer">
                                {{ $f->nama }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Kolom Kontak -->
                @if ($footerskontak->isNotEmpty())
                <div class="col-md-4 col-lg-3 mb-3">
                    <h6 class="fw-bold">Kontak</h6>
                    <hr class="mt-0 mb-2">
                    <ul class="list-unstyled">
                        @foreach ($footerskontak as $f)
                        <li style="display: flex; align-items: flex-start;">
                        @if(!empty($f->icon_key))
                            <img id="icon_preview_{{ $f->id }}"
                                src="{{ asset('/assets/images/footer_icon/' . $f->icon_key . '.svg') }}"
                                style="width: 20px; filter: brightness(0) invert(1); margin-right: 10px;">
                        @else
                            <div style="width: 20px; filter: brightness(0) invert(1); margin-right: 10px;">

                            </div>
                        @endif
                            <a href="{{ $f->url }}" class="text-decoration-none" target="_blank" rel="noopener noreferrer">
                                {{ $f->nama }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Kolom Lokasi -->
                @if ($footerslokasi->isNotEmpty())
                <div class="col-md-6 col-lg-3 mb-3">
                    <h6 class="fw-bold">Lokasi</h6>
                    <hr class="mt-0 mb-2">
                    <ul class="list-unstyled">
                        @foreach ($footerslokasi as $f)
                        <li style="display: flex; align-items: flex-start;">
                            <img id="icon_preview_{{ $f->id }}"
                                src="{{ asset('/assets/images/footer_icon/' . $f->icon_key . '.svg') }}"
                                style="width: 20px; filter: brightness(0) invert(1); margin-right: 10px;">
                            <a href="{{ $f->url }}" class="text-decoration-none" style="text-align:justify;" target="_blank" rel="noopener noreferrer">
                                {{ $f->nama }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="map-container mt-2 rounded-3" >
                        <iframe
                            class="w-100"
                            style="height: auto; border: 0; clip-path: inset(0 round 12px);"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4962.778896164773!2d113.89863957586623!3d-2.21586469776456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dfcb304be0bbb2b%3A0xb9b2574f19f5131c!2sUniversity%20of%20Palangka%20Raya!5e1!3m2!1sen!2sid!4v1740035835704!5m2!1sen!2sid"
                            allowfullscreen
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>


                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- TAMPIL VIDEO -->
    <script>
        function getVideoType(url) {
            const youtubeRegex = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/;
            const vimeoRegex = /vimeo\.com\/(\d+)/;

            if (youtubeRegex.test(url)) {
                return "youtube";
            } else if (vimeoRegex.test(url)) {
                return "vimeo";
            } else {
                return "html";
            }
        }

        function getMimeType(url) {
            const extension = url.split(".").pop().toLowerCase();
            const mimeTypes = {
                "mp4": "video/mp4",
                "webm": "video/webm",
                "ogg": "video/ogg",
                "mkv": "video/x-matroska",
                "mov": "video/quicktime",
            };
            return mimeTypes[extension] || null;
        }

        function loadVideo(url) {
            const videoType = getVideoType(url);
            const wrapper = document.getElementById("video-wrapper");
            const unsupportedMessage = document.getElementById("unsupported-message");

            wrapper.innerHTML = "";
            unsupportedMessage.style.display = "none";

            if (videoType === "youtube") {
                const videoId = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/)[1];
                wrapper.innerHTML = `<iframe src="https://www.youtube.com/embed/${videoId}?autoplay=0&rel=0"
                frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
            </iframe>`;
            } else if (videoType === "vimeo") {
                const videoId = url.match(/vimeo\.com\/(\d+)/)[1];
                wrapper.innerHTML = `<iframe src="https://player.vimeo.com/video/${videoId}?autoplay=0"
                frameborder="0" allow="autoplay; fullscreen; encrypted-media" allowfullscreen>
            </iframe>`;
            } else {
                const mimeType = getMimeType(url);
                if (mimeType) {
                    wrapper.innerHTML = `<video controls src="${url}">
                    Your browser does not support the video tag.
                </video>`;
                    const player = new Plyr(wrapper.querySelector("video"));

                    if (!player.supported.ui) {
                        wrapper.innerHTML = "";
                        unsupportedMessage.style.display = "block";
                    }
                } else {
                    unsupportedMessage.style.display = "block";
                }
            }
        }

        const videoUrl = "{{isset($video) ? $video->url : ''}}";
        if (videoUrl) {
            loadVideo(videoUrl);
        }
    </script>

</div>
@endsection
