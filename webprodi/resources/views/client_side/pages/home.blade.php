@extends('client_side.layout.app')

@push('styles')
<style>
    /* Premium Modern UI Variables */
    :root {
        --primary-brand: #0f7636;
        --secondary-brand: #ffc107;
        --accent-glow: rgba(15, 118, 54, 0.4);
        --bg-glass: rgba(255, 255, 255, 0.85);
        --text-main: #1e293b;
        --text-light: #64748b;
        --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 10px 25px -3px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        --radius-lg: 20px;
        --radius-xl: 30px;
        --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body { background-color: #f4f7f6; }

    /* Hero Section */
    .hero-section {
        position: relative;
        padding: 60px 0;
        background: linear-gradient(135deg, #0f7636 0%, #084c22 100%);
        overflow: hidden;
        border-radius: 0 0 var(--radius-xl) var(--radius-xl);
        margin-bottom: 50px;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: -50%; left: -50%; width: 200%; height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
        animation: rotateBg 20s linear infinite;
        pointer-events: none;
    }

    @keyframes rotateBg {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Featured Cards */
    .featured-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        margin-top: -60px;
        position: relative;
        z-index: 10;
    }

    .featured-card {
        background: var(--bg-glass);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255,255,255,0.5);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-md);
        transition: var(--transition);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .featured-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: var(--shadow-lg), 0 0 30px var(--accent-glow);
    }

    .fc-img-wrap {
        height: 220px;
        overflow: hidden;
        position: relative;
    }

    .fc-img-wrap img {
        width: 100%; height: 100%; object-fit: cover;
        transition: transform 0.7s ease;
    }

    .featured-card:hover .fc-img-wrap img {
        transform: scale(1.1);
    }

    .fc-badge {
        position: absolute;
        top: 15px; left: 15px;
        background: var(--secondary-brand);
        color: #000;
        font-weight: 800;
        font-size: 0.7rem;
        padding: 6px 12px;
        border-radius: 50px;
        text-transform: uppercase;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    .fc-content {
        padding: 25px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .fc-title {
        font-size: 1.25rem; font-weight: 800; color: var(--text-main);
        line-height: 1.4; margin-bottom: 15px;
        text-decoration: none;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .fc-title:hover { color: var(--primary-brand); text-decoration: none; }

    /* News List Modern */
    .news-list-item {
        background: #fff;
        border-radius: var(--radius-lg);
        padding: 15px;
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 20px;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        border: 1px solid rgba(0,0,0,0.03);
    }
    .news-list-item:hover {
        transform: translateX(10px);
        box-shadow: var(--shadow-md);
        border-color: rgba(15, 118, 54, 0.2);
    }
    .nl-img {
        width: 140px; height: 140px;
        border-radius: 15px;
        overflow: hidden;
        flex-shrink: 0;
    }
    .nl-img img { width: 100%; height: 100%; object-fit: cover; }
    .nl-content { flex-grow: 1; }
    .nl-title { font-weight: 700; font-size: 1.1rem; color: #222; text-decoration: none; display: block; margin-bottom: 8px;}
    .nl-title:hover { color: var(--primary-brand); }
    .nl-meta { font-size: 0.8rem; color: var(--text-light); display: flex; gap: 15px; font-weight: 500; }
    
    @media (max-width: 768px) {
        .news-list-item { flex-direction: column; }
        .nl-img { width: 100%; height: 200px; }
    }

    /* Modern Widget */
    .modern-widget {
        background: #fff;
        border-radius: var(--radius-lg);
        padding: 25px;
        box-shadow: var(--shadow-sm);
        margin-bottom: 30px;
    }
    .widget-title {
        font-size: 1.2rem; font-weight: 800; color: #111;
        margin-bottom: 20px; padding-bottom: 15px;
        border-bottom: 2px dashed #eaeaea;
        position: relative;
    }
    .widget-title::after {
        content: ''; position: absolute; bottom: -2px; left: 0;
        width: 40px; height: 2px; background: var(--primary-brand);
    }

    /* Custom Tabs */
    .custom-tabs .nav-tabs { border: none; gap: 5px; background: #f8fafc; padding: 5px; border-radius: 12px; }
    .custom-tabs .nav-link { 
        border: none; border-radius: 8px; font-weight: 600; font-size: 0.85rem; color: var(--text-light);
        padding: 10px 15px;
    }
    .custom-tabs .nav-link.active { background: var(--primary-brand); color: #fff; box-shadow: 0 4px 10px var(--accent-glow); }
    .tab-item { display: flex; gap: 15px; padding: 15px 0; border-bottom: 1px solid #f1f1f1; }
    .tab-item:last-child { border-bottom: none; }
    .tab-img { width: 80px; height: 80px; border-radius: 12px; object-fit: cover; }
    .tab-info h6 { font-size: 0.95rem; font-weight: 700; line-height: 1.4; margin-bottom: 5px; }
    .tab-info h6 a { color: #222; text-decoration: none; }
    .tab-info h6 a:hover { color: var(--primary-brand); }

    /* Agenda Cards */
    .agenda-card {
        background: #fff; border-radius: var(--radius-lg);
        padding: 20px; display: flex; gap: 20px;
        box-shadow: var(--shadow-sm); transition: var(--transition);
        border-left: 4px solid var(--primary-brand);
    }
    .agenda-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-md); }
    .ag-date { 
        background: rgba(15, 118, 54, 0.1); color: var(--primary-brand);
        min-width: 70px; height: 70px; border-radius: 15px;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
    }
    .ag-day { font-size: 1.8rem; font-weight: 900; line-height: 1; }
    .ag-month { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }

    /* Section Heading */
    .section-heading {
        display: flex; align-items: center; gap: 15px; margin-bottom: 30px;
    }
    .section-heading h3 { font-size: 1.8rem; font-weight: 900; color: #111; margin: 0; }
    .heading-line { flex-grow: 1; height: 2px; background: linear-gradient(90deg, var(--primary-brand), transparent); }

    /* Pimpinan Section */
    .pimpinan-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 30px; }
    .pimpinan-card {
        background: #fff; border-radius: var(--radius-xl);
        padding: 30px 20px; text-align: center;
        box-shadow: var(--shadow-sm); transition: var(--transition);
        position: relative; overflow: hidden;
    }
    .pimpinan-card::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 100px;
        background: linear-gradient(135deg, var(--primary-brand), #059669); z-index: 0;
    }
    .pimpinan-card:hover { transform: translateY(-10px); box-shadow: var(--shadow-lg); }
    .pim-img {
        width: 140px; height: 140px; border-radius: 50%;
        object-fit: cover; border: 5px solid #fff;
        position: relative; z-index: 1; margin: 0 auto 20px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .pim-info { position: relative; z-index: 1; }
    .pim-name { font-size: 1.1rem; font-weight: 800; color: #111; margin-bottom: 5px; }
    .pim-role { font-size: 0.85rem; color: var(--primary-brand); font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }

    /* Quick Links */
    .ql-card {
        background: linear-gradient(135deg, #fff, #f8fafc);
        border-radius: var(--radius-lg); padding: 30px 20px;
        text-align: center; text-decoration: none;
        display: block; box-shadow: var(--shadow-sm);
        transition: var(--transition); border: 1px solid rgba(0,0,0,0.02);
    }
    .ql-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-md); text-decoration: none; }
    .ql-icon {
        width: 70px; height: 70px; border-radius: 20px;
        background: rgba(15, 118, 54, 0.1); color: var(--primary-brand);
        display: flex; align-items: center; justify-content: center;
        font-size: 2rem; margin: 0 auto 15px; transition: transform 0.3s;
    }
    .ql-card:hover .ql-icon { transform: rotate(10deg) scale(1.1); background: var(--primary-brand); color: #fff; }
    .ql-text { font-weight: 800; font-size: 1rem; color: #222; text-transform: uppercase; }
</style>
@endpush

@section('content')

    <div class="page bg-light">
        @include('client_side.layout.header')

        <!-- Hero Area -->
        <div class="hero-section">
            <div class="container text-center pt-5 pb-4">
                <h1 class="text-white font-weight-bold mb-3" style="font-size: 2.5rem; letter-spacing: -0.5px;">Selamat Datang di {{ env('PRODI_NAME', 'Teknik Informatika') }}</h1>
                <p class="text-white-50 mb-0" style="font-size: 1.1rem;">{{ env('FAKULTAS_NAME', 'Fakultas Teknik') }} — Universitas Palangka Raya</p>
            </div>
        </div>

        <div class="container">
            <!-- Featured News Grid (Overlapping Hero) -->
            @if ($berita_latest->count() >= 3)
            <div class="featured-grid mb-5">
                @foreach ($berita_latest->take(3) as $featured)
                <div class="featured-card">
                    <div class="fc-img-wrap">
                        <div class="fc-badge">{{ $featured->jenis ?? 'BERITA' }}</div>
                        <img src="{{ $featured->foto_berita ?? asset('assets/images/default-news.png') }}" alt="{{ $featured->judul }}">
                    </div>
                    <div class="fc-content">
                        <a href="{{ route('detail_berita.index', ['id' => $featured->id]) }}" class="fc-title">
                            {{ $featured->judul }}
                        </a>
                        <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center" style="font-size: 0.8rem; color: #64748b; font-weight: 600;">
                            <span><i class="fa fa-calendar mr-1"></i> {{ \Carbon\Carbon::createFromTimestamp($featured->ts)->format('d M Y') }}</span>
                            <a href="{{ route('detail_berita.index', ['id' => $featured->id]) }}" class="text-primary font-weight-bold" style="color: #0f7636 !important;">Baca <i class="fa fa-arrow-right ml-1"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            <div class="row">
                <!-- Left Main Content -->
                <div class="col-lg-8 mb-5">
                    <div class="section-heading">
                        <h3>Berita Terbaru</h3>
                        <div class="heading-line"></div>
                    </div>

                    <div class="news-list-wrap">
                        @foreach ($berita_latest->skip(3)->take(5) as $list_news)
                        <div class="news-list-item">
                            <a href="{{ route('detail_berita.index', ['id' => $list_news->id]) }}" class="nl-img">
                                <img src="{{ $list_news->foto_berita ?? asset('assets/images/default-news.png') }}" alt="{{ $list_news->judul }}">
                            </a>
                            <div class="nl-content">
                                <div class="mb-2">
                                    <span class="badge badge-warning text-dark font-weight-bold px-2 py-1" style="border-radius: 6px;">{{ $list_news->jenis ?? 'INFO' }}</span>
                                </div>
                                <a href="{{ route('detail_berita.index', ['id' => $list_news->id]) }}" class="nl-title">
                                    {{ $list_news->judul }}
                                </a>
                                <div class="nl-meta mb-2">
                                    <span><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::createFromTimestamp($list_news->ts)->format('d M Y') }}</span>
                                    <span><i class="fa fa-user"></i> Admin</span>
                                </div>
                                <p class="mb-0 text-muted" style="font-size: 0.9rem; line-height: 1.5;">
                                    {{ Str::limit(strip_tags($list_news->isi), 100) }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    @if($berita_latest->count() > 8)
                    <div class="text-center mt-4">
                        <a href="/berita" class="btn btn-outline-success font-weight-bold px-4 py-2" style="border-radius: 50px; border-color: #0f7636; color: #0f7636;">Lihat Semua Berita</a>
                    </div>
                    @endif
                </div>

                <!-- Right Sidebar -->
                <div class="col-lg-4 mb-5">
                    
                    <!-- Custom Tabs Widget -->
                    <div class="modern-widget custom-tabs">
                        <ul class="nav nav-tabs mb-3" id="newsTabs" role="tablist">
                            <li class="nav-item flex-fill text-center">
                                <a class="nav-link active" id="pop-tab" data-toggle="tab" href="#popular" role="tab">Terpopuler</a>
                            </li>
                            <li class="nav-item flex-fill text-center">
                                <a class="nav-link" id="trend-tab" data-toggle="tab" href="#trending" role="tab">Trending</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="popular" role="tabpanel">
                                @foreach ($berita_popular->take(4) as $item)
                                <div class="tab-item">
                                    <img src="{{ $item->foto_berita ?? asset('assets/images/default-news.png') }}" alt="" class="tab-img">
                                    <div class="tab-info">
                                        <span class="text-success font-weight-bold" style="font-size: 0.7rem; text-transform:uppercase;">{{ $item->jenis ?? 'BERITA' }}</span>
                                        <h6><a href="{{ route('detail_berita.index', ['id' => $item->id]) }}">{{ Str::limit($item->judul, 45) }}</a></h6>
                                        <small class="text-muted"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::createFromTimestamp($item->ts)->format('d M Y') }}</small>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="tab-pane fade" id="trending" role="tabpanel">
                                @foreach ($berita_trending->take(4) as $item)
                                <div class="tab-item">
                                    <img src="{{ $item->foto_berita ?? asset('assets/images/default-news.png') }}" alt="" class="tab-img">
                                    <div class="tab-info">
                                        <span class="text-warning font-weight-bold" style="font-size: 0.7rem; text-transform:uppercase;">{{ $item->jenis ?? 'BERITA' }}</span>
                                        <h6><a href="{{ route('detail_berita.index', ['id' => $item->id]) }}">{{ Str::limit($item->judul, 45) }}</a></h6>
                                        <small class="text-muted"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::createFromTimestamp($item->ts)->format('d M Y') }}</small>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Banner Widget -->
                    @if($get_banner->isNotEmpty())
                    <div class="modern-widget p-0 bg-transparent border-0 shadow-none">
                        <div class="d-flex flex-column gap-3">
                            @foreach ($get_banner as $sponsor)
                            <a href="{{ $sponsor->url }}" target="_blank" class="d-block mb-3 rounded overflow-hidden shadow-sm" style="transition: transform 0.3s; transform: scale(1);" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                                <img src="{{ asset('assets/images/banner/' . $sponsor->filegambar) }}" class="img-fluid w-100" alt="Banner">
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Video Widget -->
                    @if(isset($video) && $video->url)
                    <div class="modern-widget p-0 overflow-hidden">
                        <h5 class="bg-dark text-white p-3 m-0 text-center font-weight-bold" style="font-size: 1rem;">Video Profil</h5>
                        <div style="position: relative; padding-bottom: 56.25%; height: 0;">
                            <div id="video-wrapper"></div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="container mb-5">
            <div class="row">
                <div class="col-md-3 col-6 mb-4">
                    <a href="/profil/akreditasi" class="ql-card">
                        <div class="ql-icon"><i class="fa fa-certificate"></i></div>
                        <div class="ql-text">Akreditasi</div>
                    </a>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <a href="/dosen" class="ql-card">
                        <div class="ql-icon" style="background: rgba(255, 193, 7, 0.2); color: #e6a800;"><i class="fa fa-users"></i></div>
                        <div class="ql-text">Dosen</div>
                    </a>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <a href="/berita" class="ql-card">
                        <div class="ql-icon"><i class="fa fa-newspaper-o"></i></div>
                        <div class="ql-text">Berita</div>
                    </a>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <a href="/agenda" class="ql-card">
                        <div class="ql-icon" style="background: rgba(255, 193, 7, 0.2); color: #e6a800;"><i class="fa fa-calendar"></i></div>
                        <div class="ql-text">Agenda</div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Agenda Section -->
        @if($agenda->isNotEmpty())
        <div class="bg-white py-5 mb-5 border-top border-bottom">
            <div class="container">
                <div class="section-heading justify-content-center text-center">
                    <h3><i class="fa fa-calendar-check-o text-success mr-2"></i> Agenda Kegiatan</h3>
                </div>
                <div class="row mt-4">
                    @foreach ($agenda->take(3) as $ag)
                    <div class="col-md-4 mb-4">
                        <div class="agenda-card h-100">
                            <div class="ag-date flex-shrink-0">
                                <span class="ag-day">{{ \Carbon\Carbon::createFromTimestamp($ag->ts)->format('d') }}</span>
                                <span class="ag-month">{{ \Carbon\Carbon::createFromTimestamp($ag->ts)->format('M') }}</span>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mb-2" style="font-size: 1.1rem; color: #111; line-height: 1.3;">{{ Str::limit($ag->judul, 50) }}</h5>
                                <p class="text-muted mb-0" style="font-size: 0.9rem;">{{ Str::limit(strip_tags($ag->isi), 80) }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Pimpinan Section -->
        @if($get_pimpinan->isNotEmpty())
        <div class="container mb-5 pb-5">
            <div class="section-heading text-center justify-content-center flex-column">
                <h3 class="mb-2">Pimpinan Program Studi</h3>
                <p class="text-muted m-0">{{ env('PRODI_NAME', 'Teknik Informatika') }}</p>
            </div>
            <div class="pimpinan-grid mt-5">
                @foreach ($get_pimpinan as $p)
                <div class="pimpinan-card">
                    <img src="{{ $p->foto ? asset('assets/images/pimpinan/' . $p->foto) : 'https://via.placeholder.com/150' }}" alt="{{ $p->nama }}" class="pim-img">
                    <div class="pim-info">
                        <h4 class="pim-name">{{ $p->nama }}</h4>
                        <span class="pim-role">{{ $p->jabatan }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Video Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function getVideoType(url) {
                    const ytRegex = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/;
                    const vmRegex = /vimeo\.com\/(\d+)/;
                    if (ytRegex.test(url)) return "youtube";
                    if (vmRegex.test(url)) return "vimeo";
                    return "html";
                }
                function loadVideo(url) {
                    const vType = getVideoType(url);
                    const wrapper = document.getElementById("video-wrapper");
                    if(!wrapper) return;
                    
                    if (vType === "youtube") {
                        const vId = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/)[1];
                        wrapper.innerHTML = `<iframe style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;border-radius:12px;" src="https://www.youtube.com/embed/${vId}?rel=0" allowfullscreen></iframe>`;
                    } else if (vType === "vimeo") {
                        const vId = url.match(/vimeo\.com\/(\d+)/)[1];
                        wrapper.innerHTML = `<iframe style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;border-radius:12px;" src="https://player.vimeo.com/video/${vId}" allowfullscreen></iframe>`;
                    } else {
                        wrapper.innerHTML = `<video style="position:absolute;top:0;left:0;width:100%;height:100%;border-radius:12px;object-fit:cover;" controls src="${url}"></video>`;
                    }
                }
                const videoUrl = "{{ isset($video) ? $video->url : '' }}";
                if (videoUrl) loadVideo(videoUrl);
            });
        </script>
    </div>

@endsection
