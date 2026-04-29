@extends('client_side.layout.app')

@push('styles')
<style>
    /* Modern Styling Variables */
    :root {
        --primary-modern: #10b981;
        --primary-hover: #059669;
        --bg-light: #f8fafc;
        --card-bg: #ffffff;
        --text-dark: #1e293b;
        --text-muted: #64748b;
        --border-radius-lg: 1.5rem;
        --border-radius-xl: 2rem;
        --shadow-soft: 0 10px 40px -10px rgba(0,0,0,0.08);
        --shadow-hover: 0 20px 40px -10px rgba(16, 185, 129, 0.2);
    }

    /* Hero Glassmorphism */
    .glass-box {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
        border-radius: var(--border-radius-lg);
        padding: 3rem;
        transition: transform 0.3s ease;
    }
    .glass-box:hover {
        transform: translateY(-5px);
    }

    /* Akreditasi Card */
    .modern-card {
        background: var(--card-bg);
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow-soft);
        padding: 2.5rem;
        border: none;
        transition: all 0.4s ease;
    }
    .modern-card:hover {
        box-shadow: var(--shadow-hover);
        transform: translateY(-5px);
    }
    
    .akreditasi-badge {
        font-size: 2.5rem;
        font-weight: 900;
        background: linear-gradient(135deg, var(--primary-modern), #34d399);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
        margin-bottom: 0.5rem;
    }

    /* Headings */
    .heading-modern {
        font-weight: 800;
        letter-spacing: -0.025em;
        color: var(--text-dark);
        margin-bottom: 2rem;
        position: relative;
        display: inline-block;
    }
    .heading-modern::after {
        content: '';
        position: absolute;
        width: 50%;
        height: 4px;
        background: var(--primary-modern);
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 2px;
    }
    .heading-modern.left-align::after {
        left: 0;
        transform: translateX(0);
    }

    /* News Grid & Cards */
    .news-card-modern {
        border-radius: 1.2rem;
        overflow: hidden;
        box-shadow: var(--shadow-soft);
        background: #fff;
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.03);
    }
    .news-card-modern:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-hover);
    }
    .news-card-modern img {
        object-fit: cover;
    }
    .news-card-modern .home-featured-media img,
    .news-card-modern .home-list-media img,
    .news-card-modern .position-relative img {
        transition: transform 0.5s ease;
    }
    .news-card-modern:hover .home-featured-media img,
    .news-card-modern:hover .home-list-media img,
    .news-card-modern:hover .position-relative img {
        transform: scale(1.05);
    }

    /* Pill Badges */
    .badge-modern {
        padding: 0.5em 1em;
        border-radius: 50rem;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .heading-modern {
        border-left: 4px solid #0f7636;
        padding-left: 10px;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 1.25rem;
        margin-bottom: 20px;
    }

    /* Pimpinan Cards */
    .pimpinan-card {
        background: #fff;
        border-radius: var(--border-radius-xl);
        box-shadow: var(--shadow-soft);
        padding: 2rem 1.5rem;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.03);
    }
    .pimpinan-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 120px;
        background: linear-gradient(135deg, var(--primary-modern), #34d399);
        z-index: 0;
        border-radius: var(--border-radius-xl) var(--border-radius-xl) 0 0;
    }
    .pimpinan-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-hover);
    }
    .pimpinan-img-wrapper {
        position: relative;
        z-index: 1;
        width: 120px;
        height: 120px;
        margin: 0 auto 1.5rem;
        border-radius: 50%;
        padding: 5px;
        background: #fff;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .pimpinan-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }
    .pimpinan-info {
        position: relative;
        z-index: 1;
    }

    /* Mitra Kami / Sponsors */
    .sponsor-img {
        filter: grayscale(100%) opacity(70%);
        transition: all 0.3s ease;
    }
    .sponsor-img:hover {
        filter: grayscale(0%) opacity(100%);
        transform: scale(1.05);
    }

    /* Section Backgrounds */
    .bg-modern-light {
        background-color: var(--bg-light);
    }

    /* Buttons */
    .btn-modern {
        border-radius: 50rem;
        padding: 0.75rem 2rem;
        font-weight: 600;
        letter-spacing: 0.025em;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        position: relative;
        overflow: hidden;
    }
    .btn-modern::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -60%;
        width: 20%;
        height: 200%;
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(35deg);
        transition: all 0.6s ease;
        opacity: 0;
    }
    .btn-modern:hover::after {
        left: 120%;
        opacity: 1;
    }
    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
    }
    .object-fit-cover {
        object-fit: cover;
    }
</style>
@endpush

@section('content')

<div class="page bg-light">
    @include('client_side.layout.header')

    <style>
        /* Newsup Theme Mimic Styles */
        body { background-color: #f1f1f1; }
        .newsup-main-content { margin-top: 30px; }
        .newsup-post-cat {
            background: #0f7636; color: #fff; font-size: 0.7rem; font-weight: 700;
            padding: 3px 8px; text-transform: uppercase; margin-right: 5px; display: inline-block;
        }
        .newsup-featured-card { position: relative; overflow: hidden; height: 350px; margin-bottom: 20px; }
        .newsup-featured-card img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease; }
        .newsup-featured-card:hover img { transform: scale(1.05); }
        .newsup-featured-overlay {
            position: absolute; bottom: 0; left: 0; right: 0;
            background: linear-gradient(to top, rgba(15, 118, 54, 0.9) 0%, rgba(15, 118, 54, 0.2) 50%, rgba(0,0,0,0) 100%); color: #fff;
        }
        .newsup-featured-title { font-size: 1.3rem; font-weight: 800; color: #fff; text-decoration: none; display: block; margin-top: 10px; line-height: 1.3; }
        .newsup-featured-title:hover { color: #0f7636; }

        .newsup-list-card { background: #fff; display: flex; margin-bottom: 20px; padding: 15px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .newsup-list-img { width: 40%; max-width: 250px; height: 180px; overflow: hidden; flex-shrink: 0; }
        .newsup-list-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease; }
        .newsup-list-card:hover .newsup-list-img img { transform: scale(1.05); }
        .newsup-list-content { padding-left: 20px; flex: 1; }
        .newsup-list-title { font-size: 1.25rem; font-weight: 800; color: #111; text-decoration: none; display: block; margin: 10px 0; line-height: 1.3; }
        .newsup-list-title:hover { color: #0f7636; text-decoration: none; }
        .newsup-meta { font-size: 0.75rem; color: #555; font-weight: 600; margin-bottom: 10px; text-transform: uppercase; }
        .newsup-meta i { margin-right: 5px; }
        .newsup-excerpt { font-size: 0.95rem; color: #444; line-height: 1.6; }

        .newsup-widget { background: #fff; padding: 20px; margin-bottom: 30px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .newsup-widget-title { font-size: 1.1rem; font-weight: 800; border-bottom: 2px solid #0f7636; padding-bottom: 10px; margin-bottom: 20px; text-transform: uppercase; }
        
        .newsup-tabs .nav-tabs { border-bottom: none; display: flex; }
        .newsup-tabs .nav-item { flex: 1; text-align: center; }
        .newsup-tabs .nav-link { border: 1px solid #ddd; border-bottom: none; border-radius: 0; color: #555; font-weight: 600; font-size: 0.8rem; padding: 10px; }
        .nav-tabs .nav-link.active {
            border-top: 3px solid #0f7636 !important;
            border-bottom: none;
            color: #0f7636;
            background-color: #fff;
            font-weight: bold;
        }
        .nav-tabs .nav-link:hover:not(.active) {
            color: #0f7636;
            background-color: #f8f9fa;
        }    
        .newsup-tab-content { border: 1px solid #ddd; border-top: none; padding: 15px; background: #fff; }
        
        .newsup-small-post { display: flex; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee; }
        .newsup-small-post:last-child { margin-bottom: 0; padding-bottom: 0; border-bottom: none; }
        .newsup-small-img { width: 80px; height: 60px; overflow: hidden; flex-shrink: 0; }
        .newsup-small-img img { width: 100%; height: 100%; object-fit: cover; }
        .newsup-small-content { padding-left: 15px; }
        .newsup-small-title { font-size: 0.9rem; font-weight: 700; color: #111; text-decoration: none; line-height: 1.3; }
        .newsup-small-title:hover { color: #0f7636; }
        .newsup-small-content .newsup-post-cat {
            color: #0f7636; }

        .pagination-modern .page-item .page-link { border-radius: 0; margin: 0 3px; font-weight: 700; color: #555; border: 1px solid #ddd; }
        .pagination-modern .page-item.active .page-link { background-color: #0f7636; border-color: #0f7636; color: #fff; }

        .newsup-featured-overlay .newsup-post-cat {
            background-color: #ffc107;
            color: #000;
            padding: 4px 10px;
            font-size: 0.75rem;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 10px;
            border-radius: 2px;
        }
        .newsup-news-list .newsup-post-cat {
            color: #ffc107; }

        /* Footer */
        .newsup-footer { background-color: #15181d; color: #ccc; padding: 60px 0 30px; font-size: 0.9rem; }
        .newsup-footer h5 { color: #fff; font-weight: 700; margin-bottom: 20px; font-size: 1.1rem; }
        .newsup-footer a { color: #ccc; text-decoration: none; }
        .newsup-footer a:hover { color: #0f7636; }
        .newsup-footer-bottom { background-color: #0d0f12; padding: 15px 0; font-size: 0.8rem; text-align: center; color: #888; }

        /* Agenda Cards */
        .agenda-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            display: flex;
            align-items: stretch;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .agenda-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }
        .agenda-date-badge {
            background: linear-gradient(135deg, #0f7636, #094720);
            color: #fff;
            min-width: 80px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 15px 10px;
        }
        .agenda-day { font-size: 2rem; font-weight: 800; line-height: 1; }
        .agenda-month { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }
        .agenda-body { padding: 15px; flex: 1; }
        .agenda-title { font-size: 1rem; font-weight: 700; color: #222; margin-bottom: 8px; line-height: 1.3; }
        .agenda-excerpt { font-size: 0.85rem; line-height: 1.5; }

        /* Pimpinan Cards (Green Theme) */
        .pimpinan-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            padding: 0;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .pimpinan-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        }
        .pimpinan-img-wrap {
            width: 100%;
            height: 220px;
            overflow: hidden;
        }
        .pimpinan-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .pimpinan-card:hover .pimpinan-img-wrap img {
            transform: scale(1.05);
        }
        .pimpinan-info {
            padding: 15px;
        }

        /* Quick Link Cards */
        .quick-link-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #fff;
            border-radius: 10px;
            padding: 30px 15px;
            text-decoration: none;
            color: #333;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
            text-align: center;
        }
        .quick-link-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
            text-decoration: none;
            color: #0f7636;
        }
        .ql-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #fff;
            margin-bottom: 12px;
            transition: transform 0.3s ease;
        }
        .quick-link-card:hover .ql-icon {
            transform: scale(1.1);
        }
        .quick-link-card span {
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    </style>

    <div class="container newsup-main-content">
        <div class="row">
            <!-- Left Column: Main Content -->
            <div class="col-lg-8">
                
                <!-- Featured Top Grid (2 Posts side-by-side) -->
                @if ($berita_latest->count() >= 2)
                <div class="row mb-4">
                    @foreach ($berita_latest->take(2) as $featured)
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="newsup-featured-card">
                            <a href="{{ route('detail_berita.index', ['id' => $featured->id]) }}">
                                <img src="{{ $featured->foto_berita ?? asset('assets/images/default-news.png') }}" alt="{{ $featured->judul }}">
                                <div class="newsup-featured-overlay">
                                    <span class="newsup-post-cat">{{ $featured->jenis ?? 'UNCATEGORIZED' }}</span>
                                    <h3 class="newsup-featured-title">{{ Str::limit($featured->judul, 70) }}</h3>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- List News (Below Featured) -->
                <div class="newsup-news-list">
                    @foreach ($berita_latest->skip(2) as $list_news)
                    <div class="newsup-list-card">
                        <a href="{{ route('detail_berita.index', ['id' => $list_news->id]) }}" class="newsup-list-img">
                            <img src="{{ $list_news->foto_berita ?? asset('assets/images/default-news.png') }}" alt="{{ $list_news->judul }}">
                        </a>
                        <div class="newsup-list-content">
                            <span class="newsup-post-cat">{{ $list_news->jenis ?? 'UNCATEGORIZED' }}</span>
                            <a href="{{ route('detail_berita.index', ['id' => $list_news->id]) }}" class="newsup-list-title">
                                {{ $list_news->judul }}
                            </a>
                            <div class="newsup-meta">
                                <span><i class="fa fa-clock-o"></i> {{ strtoupper(\Carbon\Carbon::createFromTimestamp($list_news->ts)->format('F d, Y')) }}</span>
                                <span class="ml-3"><i class="fa fa-user"></i> ADMIN</span>
                            </div>
                            <div class="newsup-excerpt">
                                {{ Str::limit(strip_tags($list_news->isi), 160) }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>


            </div>

            <!-- Right Column: Sidebar -->
            <div class="col-lg-4">
                
                <!-- Tabs Widget -->
                <div class="newsup-tabs mb-4">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="latest-tab" data-toggle="tab" href="#latest" role="tab"><i class="fa fa-clock-o mr-1"></i> Latest</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="popular-tab" data-toggle="tab" href="#popular" role="tab"><i class="fa fa-fire mr-1"></i> Popular</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="trending-tab" data-toggle="tab" href="#trending" role="tab"><i class="fa fa-bolt mr-1"></i> Trending</a>
                        </li>
                    </ul>
                    <div class="tab-content newsup-tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="latest" role="tabpanel">
                            @foreach ($berita_latest->take(4) as $item)
                            <div class="newsup-small-post">
                                <a href="{{ route('detail_berita.index', ['id' => $item->id]) }}" class="newsup-small-img">
                                    <img src="{{ $item->foto_berita ?? asset('assets/images/default-news.png') }}" alt="{{ $item->judul }}">
                                </a>
                                <div class="newsup-small-content">
                                    <span class="newsup-post-cat" style="font-size:0.6rem; padding: 2px 4px;">{{ $item->jenis ?? 'UNCATEGORIZED' }}</span>
                                    <a href="{{ route('detail_berita.index', ['id' => $item->id]) }}" class="newsup-small-title">{{ Str::limit($item->judul, 50) }}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="popular" role="tabpanel">
                            @foreach ($berita_popular->take(4) as $item)
                            <div class="newsup-small-post">
                                <a href="{{ route('detail_berita.index', ['id' => $item->id]) }}" class="newsup-small-img">
                                    <img src="{{ $item->foto_berita ?? asset('assets/images/default-news.png') }}" alt="{{ $item->judul }}">
                                </a>
                                <div class="newsup-small-content">
                                    <span class="newsup-post-cat" style="font-size:0.6rem; padding: 2px 4px;">{{ $item->jenis ?? 'UNCATEGORIZED' }}</span>
                                    <a href="{{ route('detail_berita.index', ['id' => $item->id]) }}" class="newsup-small-title">{{ Str::limit($item->judul, 50) }}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="trending" role="tabpanel">
                            @foreach ($berita_trending->take(4) as $item)
                            <div class="newsup-small-post">
                                <a href="{{ route('detail_berita.index', ['id' => $item->id]) }}" class="newsup-small-img">
                                    <img src="{{ $item->foto_berita ?? asset('assets/images/default-news.png') }}" alt="{{ $item->judul }}">
                                </a>
                                <div class="newsup-small-content">
                                    <span class="newsup-post-cat" style="font-size:0.6rem; padding: 2px 4px;">{{ $item->jenis ?? 'UNCATEGORIZED' }}</span>
                                    <a href="{{ route('detail_berita.index', ['id' => $item->id]) }}" class="newsup-small-title">{{ Str::limit($item->judul, 50) }}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Banners / Ayo Bergabung -->
                @if($get_banner->isNotEmpty())
                <div class="mb-4 text-center">
                    @foreach ($get_banner as $sponsor)
                    <a href="{{ $sponsor->url }}" target="_blank" class="d-block mb-3">
                        <img src="{{ asset('assets/images/banner/' . $sponsor->filegambar) }}" class="img-fluid shadow-sm" alt="Banner">
                    </a>
                    @endforeach
                </div>
                @endif

                <!-- Video Widget -->
                @if(isset($video) && $video->url)
                <div class="newsup-widget p-0 overflow-hidden mb-4 border border-light">
                    <h5 class="bg-dark text-white p-2 m-0 text-center" style="font-size: 0.9rem; font-weight: 700;">PROFIL - {{ $fakultas->nm_fak ?? 'UNIVERSITAS' }}</h5>
                    <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                        <div id="video-wrapper"></div>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>

    <!-- =============================================== -->
    <!-- SECTION: AGENDA & KEGIATAN -->
    <!-- =============================================== -->
    @if($agenda->isNotEmpty())
    <div class="container mt-5 mb-4">
        <h3 class="heading-modern"><i class="fa fa-calendar mr-2"></i>Agenda & Kegiatan</h3>
        <div class="row">
            @foreach ($agenda->take(3) as $ag)
            <div class="col-md-4 mb-4">
                <div class="agenda-card">
                    <div class="agenda-date-badge">
                        <span class="agenda-day">{{ \Carbon\Carbon::createFromTimestamp($ag->ts)->format('d') }}</span>
                        <span class="agenda-month">{{ strtoupper(\Carbon\Carbon::createFromTimestamp($ag->ts)->format('M')) }}</span>
                    </div>
                    <div class="agenda-body">
                        <h5 class="agenda-title">{{ Str::limit($ag->judul, 60) }}</h5>
                        <p class="agenda-excerpt text-muted mb-0">{{ Str::limit(strip_tags($ag->isi), 100) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- =============================================== -->
    <!-- SECTION: PIMPINAN -->
    <!-- =============================================== -->
    @if($get_pimpinan->isNotEmpty())
    <div style="background: linear-gradient(135deg, #0f7636 0%, #094720 100%); padding: 60px 0;">
        <div class="container">
            <h3 class="text-center text-white mb-2" style="font-weight: 800; letter-spacing: 1px;">PIMPINAN PRODI</h3>
            <p class="text-center mb-5" style="color: rgba(255,255,255,0.7);">{{ env('PRODI_NAME', 'Teknik Informatika') }} — Universitas Palangka Raya</p>
            <div class="row justify-content-center">
                @foreach ($get_pimpinan as $p)
                <div class="col-lg-3 col-md-4 col-6 mb-4">
                    <div class="pimpinan-card text-center">
                        <div class="pimpinan-img-wrap">
                            <img src="{{ $p->foto ? asset('assets/images/pimpinan/' . $p->foto) : 'https://via.placeholder.com/300x350/e0e0e0/555?text=Foto' }}" alt="{{ $p->nama }}">
                        </div>
                        <div class="pimpinan-info">
                            <h6 class="mb-1" style="font-weight: 700; font-size: 0.95rem;">{{ $p->nama }}</h6>
                            <small class="text-muted" style="font-size: 0.8rem;">{{ $p->jabatan }}</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- =============================================== -->
    <!-- SECTION: QUICK LINKS / LAYANAN -->
    <!-- =============================================== -->
    <div class="container mt-5 mb-5">
        <h3 class="heading-modern"><i class="fa fa-link mr-2"></i>Akses Cepat</h3>
        <div class="row">
            <div class="col-md-3 col-6 mb-4">
                <a href="/profil/akreditasi" class="quick-link-card">
                    <div class="ql-icon" style="background: #0f7636;"><i class="fa fa-certificate"></i></div>
                    <span>Akreditasi</span>
                </a>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <a href="/dosen" class="quick-link-card">
                    <div class="ql-icon" style="background: #ffc107; color: #000;"><i class="fa fa-users"></i></div>
                    <span>Daftar Dosen</span>
                </a>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <a href="/berita" class="quick-link-card">
                    <div class="ql-icon" style="background: #0f7636;"><i class="fa fa-newspaper-o"></i></div>
                    <span>Berita</span>
                </a>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <a href="/agenda" class="quick-link-card">
                    <div class="ql-icon" style="background: #ffc107; color: #000;"><i class="fa fa-calendar"></i></div>
                    <span>Agenda</span>
                </a>
            </div>
        </div>
    </div>



    <!-- TAMPIL VIDEO SCRIPT -->
    <script>
        function getVideoType(url) {
            const youtubeRegex = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/;
            const vimeoRegex = /vimeo\.com\/(\d+)/;
            if (youtubeRegex.test(url)) return "youtube";
            else if (vimeoRegex.test(url)) return "vimeo";
            else return "html";
        }
        function loadVideo(url) {
            const videoType = getVideoType(url);
            const wrapper = document.getElementById("video-wrapper");
            if(!wrapper) return;
            if (videoType === "youtube") {
                const videoId = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/)[1];
                wrapper.innerHTML = `<iframe style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;" src="https://www.youtube.com/embed/${videoId}?rel=0" allowfullscreen></iframe>`;
            } else if (videoType === "vimeo") {
                const videoId = url.match(/vimeo\.com\/(\d+)/)[1];
                wrapper.innerHTML = `<iframe style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;" src="https://player.vimeo.com/video/${videoId}" allowfullscreen></iframe>`;
            } else {
                wrapper.innerHTML = `<video style="position:absolute;top:0;left:0;width:100%;height:100%;" controls src="${url}"></video>`;
            }
        }
        const videoUrl = "{{isset($video) ? $video->url : ''}}";
        if (videoUrl) loadVideo(videoUrl);
    </script>
</div>
@endsection
