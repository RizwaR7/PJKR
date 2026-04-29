<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Profil;
use App\Models\Akreditasi;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Pimpinan;
use App\Models\banner;
use App\Models\Footer;
use App\Models\M_fak;
use App\Models\M_video;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /* Show Profil jurusan */
        $profil = Profil::where('id_sms', env('PRODI_ID'))->first();
        $akreditasi = Akreditasi::where('id_ps', env('PRODI_ID'))->first();
        $fakultas = M_fak::where('nm_fak', env('FAKULTAS_NAME'))->first();
        /* Show Menu Navigation */
        $menus = Menu::getMenu();
        $agenda = Agenda::where('id_sms', env('PRODI_ID'))
            ->where('tampil', 1)
            ->orderBy('ts', 'desc')
            ->limit(6)
            ->get();
        $berita_latest = DB::table('berita')
            ->select('judul', 'ts', 'isi', 'id', 'foto_berita', 'counters', DB::raw('"Berita" as jenis'))
            ->where('tampil', 1)
            ->where('id_sms', (int)env('PRODI_ID'))
            ->orderBy('ts', 'desc')
            ->limit(6)
            ->get();

        $berita_popular = DB::table('berita')
            ->select('judul', 'ts', 'isi', 'id', 'foto_berita', 'counters', DB::raw('"Berita" as jenis'))
            ->where('tampil', 1)
            ->where('id_sms', (int)env('PRODI_ID'))
            ->orderBy('counters', 'desc')
            ->limit(6)
            ->get();

        $trending_since = strtotime('-30 days');
        $berita_trending = DB::table('berita')
            ->select('judul', 'ts', 'isi', 'id', 'foto_berita', 'counters', DB::raw('"Berita" as jenis'))
            ->where('tampil', 1)
            ->where('id_sms', (int)env('PRODI_ID'))
            ->where('ts', '>=', $trending_since)
            ->orderBy('counters', 'desc')
            ->limit(6)
            ->get();
        $get_pimpinan = Pimpinan::where('id_sms', env('PRODI_ID'))
            ->where('tampil', 1)
            ->orderBy('no_urut', 'asc')->get();

        // print_r($get_pimpinan);
        $get_banner = banner::where('id_sms', (int)env('PRODI_ID'))->get();

        $footersgambar = Footer::where('jenis', 'gambar')
            ->where('aktif', '1')
            ->where('id_ps', (int)env('PRODI_ID'))
            ->get();

        $footerslink = Footer::where('jenis', 'link')
            ->where('aktif', '1')
            ->where('id_ps', (int)env('PRODI_ID'))
            ->get();

        $footerskontak = Footer::where('jenis', 'kontak')
            ->where('aktif', '1')
            ->where('id_ps', (int)env('PRODI_ID'))
            ->get();

        $footerslokasi = Footer::where('jenis', 'lokasi')
            ->where('aktif', '1')
            ->where('id_ps', (int)env('PRODI_ID'))
            ->get();

        $video = M_video::where('id_ps', (int)env('PRODI_ID'))->first();
        return view('client_side.pages.home', compact(
            'profil',
            'akreditasi',
            'fakultas',
            'menus',
            'agenda',
            'berita_latest',
            'berita_popular',
            'berita_trending',
            'get_pimpinan',
            'get_banner',
            'footersgambar',
            'footerslink',
            'footerskontak',
            'footerslokasi',
            'video'
        ));
    }
}
