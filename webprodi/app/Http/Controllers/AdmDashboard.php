<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengumuman;
use App\Models\Berita;
use App\Models\Artikel;
use App\Models\Menu;
use App\Models\Agenda;


class AdmDashboard extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $getUser = User::where('id_ps', env('PRODI_ID'))->count();
        $getPengumuman = Pengumuman::where('id_sms', env('PRODI_ID'))->count();
        $getBerita = Berita::where('id_sms', env('PRODI_ID'))->count();
        $getArtikel = Artikel::where('id_sms', env('PRODI_ID'))->count();

        $thisYear = strtotime(date('Y-01-01'));
        $berita_popular = Pengumuman::where('id_sms', env('PRODI_ID'))
            ->where('tampil', 1)
            // ->where('ts', '>=', $thisYear)
            ->orderBy('counters', 'desc')->take(4)->get();

        // Fetch recent berita based on creation date
        $berita_recent = Pengumuman::where('id_sms', env('PRODI_ID'))
            ->where('tampil', 1)->orderBy('ts', 'desc')->take(5)->get();


        $agenda = Agenda::where('id_sms', (int)$_ENV['PRODI_ID'])
            ->where('tampil', 1)
            ->orderBy('ts', 'desc')
            ->limit(6)
            ->get();




        return view("admin_side.pages.admin_dashboard.dashboard", compact('getUser', 'getPengumuman', 'getBerita', 'getArtikel', 'agenda', 'berita_popular', 'berita_recent'));
    }
    // Add more methods for other actions in the admin dashboard if needed
}
