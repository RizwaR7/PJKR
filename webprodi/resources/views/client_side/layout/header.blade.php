@php
    $pid = env('PRODI_ID');
    $ext = 'png';
    if(file_exists(public_path('assets/images/logo/' . $pid . '.jpg'))) $ext = 'jpg';
    elseif(file_exists(public_path('assets/images/logo/' . $pid . '.jpeg'))) $ext = 'jpeg';
    elseif(!file_exists(public_path('assets/images/logo/' . $pid . '.png'))) $pid = '0';
@endphp

<!-- Modern Sticky Header -->
<header id="site-header">
    <!-- Top micro-bar -->
    <div class="header-topbar">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="topbar-left">
                <span><i class="fa fa-university"></i> Universitas Palangka Raya</span>
            </div>
            <div class="topbar-right d-none d-md-flex">
                <a href="/masuk-admin"><i class="fa fa-sign-in"></i> Login Admin</a>
            </div>
        </div>
    </div>

    <!-- Main Navbar -->
    <nav class="main-navbar" id="mainNav">
        <div class="container">
            <div class="nav-inner">
                <!-- Brand -->
                <a href="{{ config('app.url') }}" class="nav-brand">
                    <img src="{{ asset('assets/images/logo/' . $pid . '.' . $ext) }}?v={{ time() }}" alt="Logo" class="nav-logo">
                    <div class="nav-brand-text">
                        <span class="brand-name">{{ env('PRODI_NAME_ALIAS', 'INFORMATICS') }}</span>
                        <span class="brand-sub">{{ env('FAKULTAS_NAME', 'Fakultas Teknik') }}</span>
                    </div>
                </a>

                <!-- Mobile Toggle -->
                <button class="nav-toggle" data-toggle="collapse" data-target="#navMenu" aria-label="Toggle navigation">
                    <span></span><span></span><span></span>
                </button>

                <!-- Menu -->
                <div class="collapse navbar-collapse nav-menu-wrap" id="navMenu">
                    <ul class="nav-menu">
                        <li class="nav-menu-item active">
                            <a href="{{ config('app.url') }}" class="nav-menu-link">
                                <i class="fa fa-home"></i> Beranda
                            </a>
                        </li>
                        @foreach ($menus as $data_menu)
                        <li class="nav-menu-item {{ $data_menu->submenus->isNotEmpty() ? 'has-dropdown' : '' }}">
                            <a class="nav-menu-link" 
                               href="{{ $data_menu->submenus->isNotEmpty() ? '#' : $data_menu->url }}" 
                               {!! $data_menu->newtab == 1 ? 'target="_blank"' : '' !!}
                               {!! $data_menu->submenus->isNotEmpty() ? 'data-toggle="dropdown"' : '' !!}>
                                {{ $data_menu->nama }}
                                @if($data_menu->submenus->isNotEmpty())
                                <i class="fa fa-angle-down ml-1"></i>
                                @endif
                            </a>
                            @if ($data_menu->submenus->isNotEmpty())
                            <ul class="nav-dropdown">
                                @foreach ($data_menu->submenus as $submenu)
                                @if($submenu->aktif == 1)
                                <li><a href="{{ $submenu->url }}">{{ $submenu->nama }}</a></li>
                                @endif
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

<style>
/* ===== TOP BAR ===== */
.header-topbar {
    background: #094720;
    padding: 6px 0;
    font-size: 0.78rem;
    color: rgba(255,255,255,0.7);
}
.header-topbar a { color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.2s; }
.header-topbar a:hover { color: #ffc107; }
.topbar-left span { margin-right: 20px; }
.topbar-left i, .topbar-right i { margin-right: 5px; }
.topbar-right { display: flex; gap: 16px; align-items: center; }

/* ===== MAIN NAVBAR ===== */
.main-navbar {
    background: #0f7636;
    padding: 0;
    position: sticky;
    top: 0;
    z-index: 1030;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}
.main-navbar.scrolled {
    background: rgba(15, 118, 54, 0.97);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
}
.nav-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.nav-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    padding: 10px 0;
    flex-shrink: 0;
}
.nav-brand:hover { text-decoration: none; }
.nav-logo {
    height: 45px;
    width: auto;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
}
.nav-brand-text { display: flex; flex-direction: column; }
.brand-name {
    color: #fff;
    font-weight: 800;
    font-size: 1.1rem;
    letter-spacing: 0.5px;
    line-height: 1.2;
}
.brand-sub {
    color: rgba(255,255,255,0.6);
    font-size: 0.7rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Nav Menu */
.nav-menu {
    display: flex;
    align-items: center;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 2px;
}
.nav-menu-item { position: relative; }
.nav-menu-item.active .nav-menu-link {
    background: rgba(255, 193, 7, 0.9);
    color: #000;
}
.nav-menu-link {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 16px 18px;
    color: #fff;
    font-weight: 600;
    font-size: 0.82rem;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    text-decoration: none;
    transition: all 0.2s ease;
    white-space: nowrap;
}
.nav-menu-link:hover {
    background: rgba(255,255,255,0.12);
    color: #fff;
    text-decoration: none;
}

/* Dropdown */
.nav-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    min-width: 220px;
    background: #fff;
    border-radius: 0 0 12px 12px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    list-style: none;
    padding: 8px 0;
    margin: 0;
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: all 0.25s ease;
    border-top: 3px solid #ffc107;
}
.has-dropdown:hover .nav-dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}
.nav-dropdown li a {
    display: block;
    padding: 10px 20px;
    color: #333;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
}
.nav-dropdown li a:hover {
    background: #f0fdf4;
    color: #0f7636;
    padding-left: 26px;
}

/* Toggle Button */
.nav-toggle {
    display: none;
    flex-direction: column;
    gap: 5px;
    background: none;
    border: none;
    cursor: pointer;
    padding: 8px;
}
.nav-toggle span {
    width: 24px;
    height: 2px;
    background: #fff;
    border-radius: 2px;
    transition: 0.3s;
}

@media (max-width: 991px) {
    .nav-toggle { display: flex; }
    .nav-menu-wrap {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #0c612c;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    .nav-menu {
        flex-direction: column;
        align-items: stretch;
        padding: 8px 0;
    }
    .nav-menu-link { padding: 12px 20px; }
    .nav-dropdown {
        position: static;
        opacity: 1;
        visibility: visible;
        transform: none;
        box-shadow: none;
        border-radius: 0;
        background: rgba(0,0,0,0.15);
        border-top: none;
    }
    .nav-dropdown li a { color: rgba(255,255,255,0.85); padding: 10px 36px; }
    .nav-dropdown li a:hover { background: rgba(255,255,255,0.1); color: #ffc107; }
}
</style>

<script>
window.addEventListener('scroll', function() {
    const nav = document.getElementById('mainNav');
    if (nav) nav.classList.toggle('scrolled', window.scrollY > 50);
});
</script>