<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Menu;
use App\Models\Pengumuman;
use App\Models\Profil;
use Illuminate\Http\Request;

class DetailStrukturOrganisasiController extends Controller
{
    public function index()
    {
        $menus = Menu::getMenu();

        $agenda = Agenda::where('id_sms', (int)env('PRODI_ID'))
            ->where('tampil', 1)
            ->orderBy('ts', 'desc')
            ->limit(6)
            ->get();


        // Fetch popular berita based on counters
        $thisYear = strtotime(date('Y-01-01'));
        $berita_popular = Berita::where('id_sms', env('PRODI_ID'))
            ->where('tampil', 1)
            // ->where('ts', '>=', $thisYear)
            ->orderBy('counters', 'desc')->take(4)->get();

        // Fetch recent berita based on creation date
        $berita_recent = Berita::where('id_sms', env('PRODI_ID'))
            ->where('tampil', 1)->orderBy('ts', 'desc')->take(5)->get();
        return view('client_side.pages.profil_struktur_organisasi', compact('menus', 'agenda', 'berita_popular', 'berita_recent'));
    }
}
