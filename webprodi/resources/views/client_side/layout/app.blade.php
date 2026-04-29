<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

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

    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css"
        href="//fonts.googleapis.com/css?family=Fira+Sans:300,600,800,800i%7COpen+Sans:300,400,400i" />
    <link rel="stylesheet" href="{{ asset('client_side/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('client_side/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('client_side/css/mod_style.css') . '?v=' . time() }}" />
    <link rel="stylesheet" href="{{ asset('client_side/css/fonts.css') }}" />

    <style>
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

        html.ie-10 .ie-panel,
        html.lt-ie-10 .ie-panel {
            display: block;
        }

        .banner-img {
            width: 100%;
            /* Gambar memenuhi lebar penuh */
            height: 200px;
            /* Atur tinggi agar menyerupai banner */
            object-fit: cover;
            /* Pangkas gambar agar sesuai ukuran tanpa distorsi */
            margin-top: 0;
            /* Menghapus margin atas */
            margin-bottom: 0;
            /* Menghapus margin bawah */
            border-radius: 5px;
            /* Tambahkan sudut melengkung jika diinginkan */
        }
    </style>

    <!-- IMG -->
    <style>
        /* Default style for all screens */
        img.responsive-image {
            width: 40%;
            height: auto;
        }

        /* For mobile screens (max width: 768px) */
        @media (max-width: 768px) {
            img.responsive-image {
                width: 25%;
                /* Adjust width for mobile */
                height: auto;
                /* Maintain aspect ratio */
            }
        }
    </style>

    <style>
        @media (max-width: 991.98px) {
            .rd-navbar-wrap {
                margin-top: 0 !important;
            }
        }
    </style>

    <!-- Add this CSS for hover effect -->
    <style>
        .arrow-icon {
            transition: transform 0.3s ease;
        }

        .btn:hover .arrow-icon {
            transform: translateX(5px);
        }
    </style>

    <style>
        .map-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%; /* Rasio 16:9 agar responsif */
            height: 0;
            overflow: hidden;
        }

        .map-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>

    <!-- video -->
    <style>
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            max-width: 100%;
            background: #000;
            border-radius: 25px;
            box-shadow: 9px 6px 20px 0px rgba(0, 0, 0, 0.5);
        }

        iframe,
        video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 25px;
        }

        .unsupported-message {
            color: red;
            font-size: 18px;
            text-align: center;
            margin-top: 10px;
        }
    </style>

    <!-- Add this CSS for hover effect -->
    <style>
        .arrow-icon {
            transition: transform 0.3s ease;
        }

        .btn:hover .arrow-icon {
            transform: translateX(5px);
        }
    </style>

    @stack('styles')
</head>

<body>


    {{-- Content Page --}}
    @yield('content')

    <style>
        /* Newsup Footer */
        .newsup-footer { background-color: #15181d; color: #ccc; padding: 60px 0 30px; font-size: 0.9rem; }
        .newsup-footer h5 { color: #fff; font-weight: 700; margin-bottom: 20px; font-size: 1.1rem; }
        .newsup-footer a { color: #ccc; text-decoration: none; }
        .newsup-footer a:hover { color: #1e5dd6; }
        .newsup-footer-bottom { background-color: #0d0f12; padding: 15px 0; font-size: 0.8rem; text-align: center; color: #888; }
    </style>
    <footer class="newsup-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <img width="200px" src="{{ asset('assets/images/logo/' . $pid_app . '.' . $ext_app) }}" alt="Logo" class="mb-3">
                    <p class="text-muted" style="line-height: 1.6; max-width: 400px;">
                        Membangun generasi cerdas dan berkarakter unggul di {{env('PRODI_NAME_ALIAS', 'Universitas Palangka Raya')}}.
                    </p>
                </div>
                <div class="col-md-6 mb-4 text-md-right text-left">
                    <p class="mt-4 pt-4 text-muted">
                        &copy; {{ date('Y') }} {{env('PRODI_NAME_ALIAS', 'Universitas Palangka Raya')}}.
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <div class="newsup-footer-bottom">
        <div class="container">
            Proudly powered by WordPress | Theme: Newsup by Themeansar
        </div>
    </div>

    <div class="snackbars" id="form-output-global"></div>

    {{-- Default JS --}}
    <style>
        .VIpgJd-ZVi9od-ORHb-OEVmcd {
            display: none;
        }

        body {
            top: 0px !important;
        }
    </style>
    <script src="{{ asset('client_side/js/core.min.js') }}"></script>
    <script src="{{ asset('client_side/js/script.js') }}"></script>
    <script src="{{ asset('client_side/js/script.min.js') }}"></script>
    <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>

    {{-- End Default JS --}}
</body>

</html>
