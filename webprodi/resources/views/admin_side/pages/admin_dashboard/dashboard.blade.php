@extends('admin_side.layout.app')

@section('content')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>

        <div class="row mb-3">
            {{-- Total User --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total User
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $getUser }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-friends fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Pengumuman
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $getPengumuman }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-bullhorn fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Berita
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $getBerita }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-newspaper fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Artikel
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $getArtikel }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-pen-square fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->
        <!-- Sidebar -->
        <div class="col-lg-12 card p-3" style="width: 100%;">
            <div class="row">
                <div class="col-lg-4" style="width: 100%;">
                    <div class="sidebasr">
                        <div class="widget popular-posts">
                            <h3 class="widget-title">Populer</h3>
                            <ul class="list-disc">
                                @foreach ($berita_popular as $berita)
                                    <li><a
                                            href="{{ route('detail_berita.index', ['id' => $berita->id]) }}">{{ $berita->judul }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" style="width: 100%;">
                    <div class="sidebars">
                        <div class="widget recent-posts">
                            <h3 class="widget-title">Terbaru</h3>
                            <ul>
                                @foreach ($berita_recent as $berita)
                                    <li><a
                                            href="{{ route('detail_berita.index', ['id' => $berita->id]) }}">{{ $berita->judul }}</a>
                                        <br>
                                        <span>{{ \Carbon\Carbon::createFromTimestamp($berita->ts)->format('F d, Y') }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" style="width: 100%;">
                    <div class="sidebars">
                        <div class="widget agenda-posts">
                            <h3 class="widget-title">Agenda</h3>
                            <ul>
                                @foreach ($agenda as $agenda_data)
                                    <li>
                                        <!-- Post inline-->
                                        <article class="post-inline ">
                                            <div class="post-inline__header">
                                                <span>
                                                    {{ \Carbon\Carbon::createFromTimestamp($agenda_data->ts)->format('d M Y') }}
                                                </span>
                                                <p class="post-inline__link ">
                                                    <a
                                                        href="{{ route('detail_agenda.index', ['id' => $agenda_data->id_kegiatan]) }}">{{ $agenda_data->judul_kegiatan }}</a>
                                                </p>
                                        </article>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Logout -->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to logout?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                        <a href="login.html" class="btn btn-primary">Logout</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!---Container Fluid-->
@endsection
