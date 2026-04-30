<!DOCTYPE html>
<html class="wide wow-animation" lang="id">

<head>
    @php
        $pid_app = env('PRODI_ID');
        $ext_app = 'png';
        if(file_exists(public_path('assets/images/logo/' . $pid_app . '.jpg'))) $ext_app = 'jpg';
        elseif(file_exists(public_path('assets/images/logo/' . $pid_app . '.jpeg'))) $ext_app = 'jpeg';
        elseif(!file_exists(public_path('assets/images/logo/' . $pid_app . '.png'))) $pid_app = '0';
    @endphp
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo/' . $pid_app . '.' . $ext_app) }}?v={{ time() }}">
    <!-- Site Title-->
    <title>{{env('PRODI_NAME_ALIAS')}} - UNIVERSITAS PALANGKA RAYA</title>
    <!-- Meta SEO -->
    <meta name="title" property="og:title" content="{{env('PRODI_NAME_ALIAS')}} Universitas Palangka Raya">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:site_name" content="{{env('PRODI_NAME_ALIAS')}} Universitas Palangka Raya">
    <meta name="description" property="og:description"
        content="{{env('PRODI_NAME_ALIAS')}} di Universitas Palangka Raya. Pelajari lebih lanjut...">
    <meta property="og:image:width" content="735">
    <meta property="og:image:height" content="360">
    <meta property="og:image:type" content="image/png">
    <meta name="description" content="{{env('PRODI_NAME_ALIAS')}} di Universitas Palangka Raya. Pelajari lebih lanjut...">
    <meta name="keywords" content="{{env('PRODI_NAME_ALIAS')}} UPR, Universitas Palangka Raya">
    <meta name="robots" content="noindex, nofollow">
    <meta name="revisit-after" content="1 days">
    <meta name="language" content="ID">
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport"
        content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta name="author" content="admin">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="utf-8" />

    <!-- Modern Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('client_side/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('client_side/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('client_side/css/fonts.css') }}" />

    <style>
        *, *::before, *::after {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        body {
            background: #f8fafc;
            color: #1a1a2e;
            top: 0px !important;
            overflow-x: hidden;
        }
        .VIpgJd-ZVi9od-ORHb-OEVmcd { display: none; }
        .ie-panel {
            display: none;
            background: #212121;
            padding: 10px 0;
            box-shadow: 3px 3px 5px 0 rgba(0, 0, 0, 0.3);
            clear: both;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel { display: block; }
    </style>

    @stack('styles')
</head>

<body>

    {{-- Content Page --}}
    @yield('content')

    <!-- ===== MODERN FOOTER ===== -->
    <footer class="site-footer">
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="footer-brand">
                            <img width="60" src="{{ asset('assets/images/logo/' . $pid_app . '.' . $ext_app) }}" alt="Logo" class="mb-3">
                            <h5>{{ env('PRODI_NAME', 'Teknik Informatika') }}</h5>
                            <p>{{ env('FAKULTAS_NAME', 'Fakultas Teknik') }} — Universitas Palangka Raya</p>
                        </div>
                        <p class="footer-desc">Membangun generasi cerdas dan berkarakter unggul melalui pendidikan, penelitian, dan pengabdian kepada masyarakat.</p>
                    </div>
                    <div class="col-lg-2 col-md-6 mb-4">
                        <h6 class="footer-heading">Navigasi</h6>
                        <ul class="footer-links">
                            <li><a href="/">Beranda</a></li>
                            <li><a href="/profil/sejarah">Sejarah</a></li>
                            <li><a href="/profil/visi-misi">Visi & Misi</a></li>
                            <li><a href="/profil/akreditasi">Akreditasi</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <h6 class="footer-heading">Informasi</h6>
                        <ul class="footer-links">
                            <li><a href="/berita">Berita</a></li>
                            <li><a href="/agenda">Agenda</a></li>
                            <li><a href="/pengumuman">Pengumuman</a></li>
                            <li><a href="/dosen">Daftar Dosen</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <h6 class="footer-heading">Kontak</h6>
                        <ul class="footer-contact">
                            <li><i class="fa fa-map-marker"></i> Jl. Yos Sudarso, Palangka Raya, Kalimantan Tengah</li>
                            <li><i class="fa fa-envelope"></i> info@upr.ac.id</li>
                            <li><i class="fa fa-globe"></i> www.upr.ac.id</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container text-center">
                &copy; {{ date('Y') }} {{ env('PRODI_NAME', 'Teknik Informatika') }} — Universitas Palangka Raya. All rights reserved.
            </div>
        </div>
    </footer>

    <style>
    .site-footer {
        background: #0d1117;
        color: rgba(255,255,255,0.7);
        font-size: 0.9rem;
    }
    .footer-main { padding: 60px 0 30px; }
    .footer-brand h5 {
        color: #fff;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 2px;
    }
    .footer-brand p {
        color: rgba(255,255,255,0.5);
        font-size: 0.8rem;
        margin-bottom: 16px;
    }
    .footer-desc {
        color: rgba(255,255,255,0.5);
        line-height: 1.7;
        font-size: 0.85rem;
    }
    .footer-heading {
        color: #fff;
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 10px;
    }
    .footer-heading::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 30px;
        height: 2px;
        background: #0f7636;
    }
    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .footer-links li { margin-bottom: 10px; }
    .footer-links a {
        color: rgba(255,255,255,0.6);
        text-decoration: none;
        font-size: 0.85rem;
        transition: all 0.2s;
    }
    .footer-links a:hover {
        color: #ffc107;
        padding-left: 6px;
    }
    .footer-contact {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .footer-contact li {
        margin-bottom: 14px;
        font-size: 0.85rem;
        color: rgba(255,255,255,0.5);
        line-height: 1.5;
    }
    .footer-contact i {
        color: #0f7636;
        width: 18px;
        margin-right: 8px;
    }
    .footer-bottom {
        background: rgba(0,0,0,0.3);
        padding: 16px 0;
        font-size: 0.78rem;
        color: rgba(255,255,255,0.35);
        border-top: 1px solid rgba(255,255,255,0.05);
    }
    </style>

    <div class="snackbars" id="form-output-global"></div>

    {{-- Default JS --}}
    <script src="{{ asset('client_side/js/core.min.js') }}"></script>
    <script src="{{ asset('client_side/js/script.js') }}"></script>
    <script src="{{ asset('client_side/js/script.min.js') }}"></script>

    {{-- End Default JS --}}
</body>

</html>
