<header class="page-header" style="background-color: #0f7636;">
    <!-- Top Banner Area -->
    <div class="header-banner" style="position: relative; background: url('/assets/images/slider/slide-1.jpg') center/cover; padding: 40px 0; overflow: hidden;">
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(15, 118, 54, 0.85);"></div>
        <div class="container position-relative" style="z-index: 1;">
            <div class="row align-items-center justify-content-center text-center text-md-left">
                <div class="col-auto mb-3 mb-md-0">
                    @php
                        $pid = env('PRODI_ID');
                        $ext = 'png';
                        if(file_exists(public_path('assets/images/logo/' . $pid . '.jpg'))) $ext = 'jpg';
                        elseif(file_exists(public_path('assets/images/logo/' . $pid . '.jpeg'))) $ext = 'jpeg';
                        elseif(!file_exists(public_path('assets/images/logo/' . $pid . '.png'))) $pid = '0';
                    @endphp
                    <img width="100px" src="{{ asset('assets/images/logo/' . $pid . '.' . $ext) }}?v={{ time() }}" alt="Logo" style="filter: drop-shadow(0 4px 6px rgba(0,0,0,0.3));" />
                </div>
                <div class="col-auto text-white">
                    <h2 class="font-weight-bold mb-1" style="font-size: 2rem; letter-spacing: 0.5px; text-shadow: 0 2px 4px rgba(0,0,0,0.5);">{{ strtoupper(env('PRODI_NAME_ALIAS', 'FAKULTAS KEGURUAN DAN ILMU PENDIDIKAN')) }}</h2>
                    <div style="background-color: #ffc107; color: #000; display: inline-block; padding: 4px 15px; font-weight: 700; font-size: 1.1rem; letter-spacing: 0.5px; box-shadow: 0 2px 4px rgba(0,0,0,0.3);">UNIVERSITAS PALANGKA RAYA</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar Area -->
    <div class="header-navbar" style="background-color: #0c612c; box-shadow: 0 4px 10px rgba(0,0,0,0.1); border-bottom: 3px solid #094720;">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark p-0">
                <button class="navbar-toggler my-2" type="button" data-toggle="collapse" data-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNavbar">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active" style="background-color: #ffc107;">
                            <a class="nav-link text-dark font-weight-bold px-4 py-3" href="{{ config('app.url') }}">
                                <i class="fa fa-home mr-2"></i> BERANDA
                            </a>
                        </li>
                        @foreach ($menus as $data_menu)
                        <li class="nav-item {{ $data_menu->submenus->isNotEmpty() ? 'dropdown' : '' }}">
                            <a class="nav-link text-white font-weight-bold px-3 py-3 text-uppercase {{ $data_menu->submenus->isNotEmpty() ? 'dropdown-toggle' : '' }}" 
                               href="{{ $data_menu->submenus->isNotEmpty() ? '#' : $data_menu->url }}" 
                               {!! $data_menu->newtab == 1 ? 'target="_blank"' : '' !!}
                               {!! $data_menu->submenus->isNotEmpty() ? 'id="navbarDropdown'.$data_menu->idmenu.'" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : '' !!}>
                                {{ $data_menu->nama }}
                            </a>
                            @if ($data_menu->submenus->isNotEmpty())
                            <div class="dropdown-menu rounded-0 mt-0 border-0 shadow" aria-labelledby="navbarDropdown{{ $data_menu->idmenu }}" style="background-color: #ffffff; border-top: 3px solid #ffc107 !important;">
                                @foreach ($data_menu->submenus as $submenu)
                                @if($submenu->aktif == 1)
                                <a class="dropdown-item py-2 font-weight-bold text-dark text-uppercase" style="font-size: 0.85rem;" href="{{ $submenu->url }}">{{ $submenu->nama }}</a>
                                @endif
                                @endforeach
                            </div>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<style>
    .dropdown:hover > .dropdown-menu {
        display: block;
    }
    .dropdown > .dropdown-toggle:active {
        pointer-events: none;
    }
    .header-navbar .nav-item .nav-link {
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        transition: background-color 0.2s ease;
    }
    .header-navbar .nav-item:hover {
        background-color: rgba(255,255,255,0.1);
    }
    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #0f7636 !important;
    }
</style>