<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Halaman;
use App\Models\Menu;
use App\Models\Profil;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailHalamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $profil = Profil::where('id_sms', (int)env('PRODI_ID'))->first();
        /* Show Menu Navigation */
        $menus = Menu::getMenu();

        $agenda = Agenda::where('id_sms', (int)env('PRODI_ID'))
            ->where('tampil', 1)
            ->limit(6)
            ->get();

        // Fetch the latest berita
        $all = Berita::orderBy('ts', 'desc')->paginate(8);

        // Fetch popular berita based on counters
        $thisYear = strtotime(date('Y-01-01'));

        $berita_popular = Berita::where('id_sms', env('PRODI_ID'))
            ->where('tampil', 1)
            // ->where('ts', '>=', $thisYear)
            ->orderBy('counters', 'desc')->take(4)->get();

        // Fetch recent berita based on creation date
        $berita_recent = Berita::where('id_sms', env('PRODI_ID'))
            ->where('tampil', 1)->orderBy('ts', 'desc')->take(5)->get();

        $get_detail_halaman = DB::table('halaman')
            ->select('*')
            ->where('id', $id)
            ->where('id_sms', (int)env('PRODI_ID'))
            ->first();

        if (empty($get_detail_halaman)) {
            abort(404);
        }

        return view('client_side.pages.detail_halaman', compact('get_detail_halaman', 'profil', 'menus', 'agenda', 'all', 'berita_popular', 'berita_recent'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
}
