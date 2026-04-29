<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Menu;
use App\Models\Profil;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profil = Profil::where('id_sms', (int)env('PRODI_ID'))->first();
        /* Show Menu Navigation */
        $menus = Menu::getMenu();

        $agenda = Agenda::where('id_sms', (int)env('PRODI_ID'))
            ->where('tampil', 1)
            ->orderBy('ts', 'desc')
            ->limit(6)
            ->get();

        // $get_dosen = DB::table("dosen_ps")
        // ->join("dosen_siter", "dosen_ps.id_ptk", "=", "dosen_siter.id_dosen")
        // ->where("dosen_ps.id_sms", 5211085)
        // ->paginate(10)
        // ;

        $get_dosen = DB::table("dosen_siter")
            ->where('nama_program_studi', env('PRODI_NAME'))
            ->paginate(10);

        // Fetch popular berita based on counters
        $berita_popular = Berita::where('id_sms', env('PRODI_ID'))->orderBy('counters', 'desc')->take(4)->get();

        // Fetch recent berita based on creation date
        $berita_recent = Berita::where('id_sms', env('PRODI_ID'))->orderBy('ts', 'desc')->take(5)->get();

        return view('client_side.pages.dosen', compact('get_dosen', 'profil', 'menus', 'agenda', 'berita_popular', 'berita_recent'));
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
