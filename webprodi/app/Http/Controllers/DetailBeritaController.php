<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Menu;
use App\Models\Profil;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailBeritaController extends Controller
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

        $get_detail_berita = DB::table('berita')
            ->select('judul', 'ts', 'isi', 'id', 'foto_berita', 'counters', DB::raw('"Berita" as jenis'))
            ->where('id', $id)
            ->where('tampil', 1)
            ->first();
        if (!empty($get_detail_berita)) {
            DB::table('berita')
                ->where('id', $get_detail_berita->id)
                ->update(['counters' => $get_detail_berita->counters + 1]);
        }

        if (empty($get_detail_berita)) {
            abort(404);
        }


        return view('client_side.pages.detail_berita', compact('get_detail_berita', 'profil', 'menus', 'agenda', 'all', 'berita_popular', 'berita_recent'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
