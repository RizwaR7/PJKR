<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png"
        href="{{ asset('assets/images/logo/' . env('PRODI_ID') . '.' . (file_exists(public_path('assets/images/logo/' . env('PRODI_ID') . '.jpg')) ? 'jpg' : (file_exists(public_path('assets/images/logo/' . env('PRODI_ID') . '.jpeg')) ? 'jpeg' : 'png'))) . '?v=' . time() }}">
    <title>ADMINISTRATOR - UNIVERSITAS PALANGKA RAYA</title>
    <link href="{{ asset('admin_side/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_side/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    {{-- <link href="{{ asset('admin_side/css/ruang-admin.min.css?v=').time()}}" rel="stylesheet"> --}}
    <link href="{{ asset('admin_side/css/dashboard.min.css?v=') . time() }}" rel="stylesheet">
    <link href="{{ asset('admin_side/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('admin_side/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_side/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin_side/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('admin_side/js/costum.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="{{ asset('admin_side/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_side/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    {{-- Parent Wrapper --}}
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="img-fluid">
                    <img src="{{ asset('assets/images/logo/' . env('PRODI_ID') . '.png') . '?v=' . time() }}"
                        style="width: 45px;">
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item ">
                <a class="nav-link " href="{{ route('admin_dashboard.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item {{ Route::is('user.index') ? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('user.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>User</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item {{ Route::is('informasi_halaman.index') ? 'active' : '' }} ">
                <a class="nav-link" href="{{ route('informasi_halaman.index') }}">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Halaman</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item {{ Route::is('admin_menu.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin_menu.index') }}">
                    <i class="fas fa-fw fa-stream"></i>
                    <span>Menu </span>
                </a>
            </li>
            {{-- <li class="nav-item {{ Route::is('admin_kategori_berita.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin_kategori_berita.index') }}">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Kategori Berita</span>
            </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm"
                    aria-expanded="true" aria-controls="collapseForm">
                    <i class="fas fa-fw fa-university"></i>
                    <span>Profil</span>
                </a>
                <div id="collapseForm"
                    class="collapse {{ Route::is('profil_visi_misi.index') ? 'show' : '' }} {{ Route::is('profil_sejarah.index') ? 'show' : '' }} {{ Route::is('profil_akreditasi.index') ? 'show' : '' }} {{ Route::is('profil_pimpinan.index') ? 'show' : '' }} {{ Route::is('profil_dosen.index') ? 'show' : '' }} {{ Route::is('profil_struktur_organisasi.index') ? 'show' : '' }} "
                    aria-labelledby="headingForm" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Profil</h6>
                        <a class="collapse-item {{ Route::is('profil_visi_misi.index') ? 'active' : '' }}"
                            href="{{ route('profil_visi_misi.index') }}"><i class="fas fa-fw fa-eye"></i> Visi Misi
                        </a>
                        <a class="collapse-item {{ Route::is('profil_sejarah.index') ? 'active' : '' }}"
                            href="{{ route('profil_sejarah.index') }}"><i class="fas fa-fw fa-history"></i> Sejarah
                        </a>
                        <a class="collapse-item {{ Route::is('profil_akreditasi.index') ? 'active' : '' }}"
                            href="{{ route('profil_akreditasi.index') }}"><i class="fas fa-fw fa-certificate"></i>
                            Akreditasi
                        </a>
                        <a class="collapse-item {{ Route::is('profil_dosen.index') ? 'active' : '' }}"
                            href="{{ route('profil_dosen.index') }}"><i class="fas fa-fw fa-user"></i>
                            Dosen
                        </a>
                        <a class="collapse-item {{ Route::is('profil_pimpinan.index') ? 'active' : '' }}"
                            href="{{ route('profil_pimpinan.index') }}"><i class="fas fa-fw fa-user-tie"></i>
                            Pimpinan
                        </a>
                        <a class="collapse-item {{ Route::is('profil_struktur_organisasi.index') ? 'active' : '' }}"
                            href="{{ route('profil_struktur_organisasi.index') }}"><i class="fas fa-fw fa-user-tie"></i>
                            Struktur Organisasi
                        </a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable"
                    aria-expanded="true" aria-controls="collapseTable">
                    <i class="fas fa-fw fa-book-open"></i>
                    <span>Informasi</span>
                </a>
                <div id="collapseTable"
                    class="collapse  {{ route::is('informasi_agenda.index') ? 'show' : '' }} {{ Route::is('informasi_artikel.index') ? 'show' : '' }}  {{ Route::is('informasi_pengumuman.index') ? 'show' : '' }}{{ Route::is('informasi_berita.index') ? 'show' : '' }} "
                    aria-labelledby="headingTable" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kelola Informasi</h6>
                        <a class="collapse-item {{ Route::is('informasi_pengumuman.index') ? 'active' : '' }}"
                            href="{{ route('informasi_pengumuman.index') }}">
                            <i class="fas fa-fw fa-bullhorn"></i>
                            <span>Pengumuman</span>
                        </a>
                        <a class="collapse-item {{ Route::is('informasi_berita.index') ? 'active' : '' }}"
                            href="{{ route('informasi_berita.index') }}"><i class="fas fa-fw fa-newspaper"></i>
                            Berita</a>
                        <a class="collapse-item {{ Route::is('informasi_artikel.index') ? 'active' : '' }}"
                            href="{{ route('informasi_artikel.index') }}"><i class="fas fa-fw fa-file-alt"></i>
                            Artikel</a>
                        <a class="collapse-item {{ route::is('informasi_agenda.index') ? 'active' : '' }}"
                            href="{{ route('informasi_agenda.index') }}"><i class="fas fa-fw fa-calendar-alt"></i>
                            Agenda</a>
                    </div>
                </div>
            </li>
            <!-- <li class="nav-item  {{ route::is('dosen_prodi.index') ? 'active' : '' }}">
                <a class="nav-link " href="{{ route('dosen_prodi.index') }}">
                    <i class="fas fa-fw fa-user-graduate"></i>
                    <span>Dosen Prodi</span>
                </a>
            </li> -->


            <hr class="sidebar-divider">

            <li class="nav-item {{ route::is('slider.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('slider.index') }}">
                    <i class="fas fa-fw fa-image"></i>
                    <span>Banner Utama</span>
                </a>
            </li>

            <li class="nav-item {{ route::is('logo.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('logo.index') }}">
                    <i class="fas fa-fw fa-image"></i>
                    <span>Logo Utama</span>
                </a>
            </li>
            <li class="nav-item {{ route::is('multimedia.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('multimedia.index') }}">
                    <i class="fas fa-fw fa-images"></i>
                    <span>Multimedia Website</span>
                </a>
            </li>
            <li class="nav-item {{ route::is('kelola_video.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('kelola_video.index') }}">
                    <i class="fas fa-fw fa-images"></i>
                    <span>Kelola Video</span>
                </a>
            </li>
            <li class="nav-item {{ route::is('banner.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('banner.index') }}">
                    <i class="fas fa-fw fa-handshake"></i>
                    <span>Logo Partner</span>
                </a>
            </li>
            <li class="nav-item {{ route::is('footer.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('footer.index') }}">
                    <i class="fas fa-fw fa-info"></i>
                    <span>Footer</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="version" id="version-ruangadmin"></div>
        </ul>
        <!-- Sidebar -->
        {{-- Content Wrapper --}}
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li>
                            <script>
                                function showCurrentTime() {
                                    const currentTime = new Date();
                                    const options = {
                                        year: "numeric",
                                        month: "numeric",
                                        day: "numeric",
                                        hour: "numeric",
                                        minute: "numeric",
                                        second: "numeric"
                                    };
                                    const currentFormattedTime = currentTime.toLocaleString("id-ID", options);
                                    document.getElementById("currentTime").innerHTML =
                                        `<span class="badge badge-medium" style="color: black;background-color: #91e1e0; padding: 5px;">${currentFormattedTime}</span>`;
                                }
                                setInterval(showCurrentTime, 1000); // set interval untuk memperbarui waktu secara realtime
                            </script>

                        <li class="d-flex align-items-center">
                            <span id="currentTime" class="text-white mr-3"></span>
                            <span class="text-gray-400"></span>
                        </li>
                        </li>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user-cog fa-lg" style="color:white;"></i>
                                <span class="ml-2 d-none d-lg-inline text-white small">Administrator</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#gantiPasswordModal">
                                    <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Ganti Password
                                </a>

                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout_admin') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Topbar -->
                {{-- Yeild Here --}}
                @yield('content') {{-- Yeild Here --}}
                {{-- Yeild Here --}}

                <!-- Modal Ganti Password -->
                <div class="modal fade show" id="gantiPasswordModal" tabindex="9999991" role="dialog"
                    aria-labelledby="gantiPasswordModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="gantiPasswordModalLabel">Ganti Password</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('user.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="id" id="id" class="form-control"
                                            value="{{ Auth::user()->id }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="sid">Username (Ubah Di Kelola User)</label>
                                        <input type="text" name="sid" id="sid" class="form-control"
                                            value="{{ Auth::user()->sid }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="old_password">Password Lama</label>
                                        <input type="password" name="old_password" id="old_password"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">Password Baru</label>
                                        <input type="password" name="new_password" id="new_password"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password">Konfirmasi Password Baru</label>
                                        <input type="password" name="confirm_password" id="confirm_password"
                                            class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Ganti Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Content Wrapper --}}
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> - developed by
                            <b><a href="#" target="_blank">UPT TIK </a></b>
                        </span>
                    </div>
                </div>
            </footer>
            <!-- Footer -->
        </div>
        {{-- End Parent Wrapper --}}
        <!-- Scroll to top -->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        {{-- Script Default --}}
        {{-- Script Level Plugin --}}
        <script src="{{ asset('admin_side/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('admin_side/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <script src="{{ asset('admin_side/js/ruang-admin.min.js') }}"></script>
        <!-- <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script> -->
</body>

</html>