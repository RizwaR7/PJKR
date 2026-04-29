<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
    <link rel="icon" type="image/png"
        href="{{ asset('assets/images/logo/' . env('PRODI_ID') . '.' . (file_exists(public_path('assets/images/logo/' . env('PRODI_ID') . '.jpg')) ? 'jpg' : (file_exists(public_path('assets/images/logo/' . env('PRODI_ID') . '.jpeg')) ? 'jpeg' : 'png'))) . '?v=' . time() }}">
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

</head>

<body>
    <div class="preloader">
        <div class="cssload-container">
            <svg class="filter" version="1.1">
                <defs>
                    <filter id="gooeyness">
                        <fegaussianblur in="SourceGraphic" stddeviation="10" result="blur"></fegaussianblur>
                        <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 20 -10"
                            result="gooeyness"></fecolormatrix>
                        <fecomposite in="SourceGraphic" in2="gooeyness" operator="atop"></fecomposite>
                    </filter>
                </defs>
            </svg>
            <div class="dots">
                <div class="dot mainDot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
            <small>Please wait...</small>
            <div class="">
                <div class="card-body">
                    <small id="motivate" class="motivate badge sm-badge badge-success ">
                        <?php
                        $quotes = ['Pastikan anda tersambung pada koneksi internet', 'Pastikan hapus cache browser Anda jika gagal memuat halaman', 'Jika gangguan saat memuat halaman, coba refresh browser', 'Tunggu sampai proses memuat selesai'];
                        echo $quotes[array_rand($quotes)];
                        ?>
                    </small>
                </div>
            </div>
        </div>
    </div>

    {{-- Content Page --}}
    @yield('content')

    <footer class="footer-corporate bg-gray-darkest">
        <div class="container">
            <div class="footer-corporate__inner">
                <p class="rights">

                    Develop by
                    <br>
                    <a href="https://tik.upr.ac.id">ICT - Palangka Raya University</a>
                    <br>
                    <!-- <span><a href="https://upr.ac.id">UPR</a></span><span>&nbsp;</span><span class="copyright-year"></span>. All Rights Reserved by Palangka Raya University -->
                    All Rights Reserved

                </p>
                <!-- <ul class="list-inline-xxs">
                        <li><a class="icon icon-xxs icon-warning fa fa-facebook" href="#"></a></li>
                        <li><a class="icon icon-xxs icon-warning fa fa-twitter" href="#"></a></li>
                        <li><a class="icon icon-xxs icon-warning fa fa-google-plus" href="#"></a></li>
                        <li><a class="icon icon-xxs icon-warning fa fa-vimeo" href="#"></a></li>
                        <li><a class="icon icon-xxs icon-warning fa fa-youtube" href="#"></a></li>
                        <li><a class="icon icon-xxs icon-warning fa fa-pinterest" href="#"></a></li>
                    </ul> -->
            </div>
        </div>
    </footer>

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
