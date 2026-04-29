<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\Akreditasi;
use App\Models\Berita;
use App\Models\Menu;
use App\Models\Pengumuman;
use App\Models\Profil;


class DetailProfilAkreditasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::getMenu();
        $agenda = Agenda::where('id_sms', (int)env('PRODI_ID'))
            ->where('tampil', 1)
            ->orderBy('ts', 'desc')
            ->limit(6)
            ->get();

        $profil_akreditasi = Akreditasi::where('id_ps', (int)env('PRODI_ID'))->first();

        // Fetch popular berita based on counters
        $thisYear = strtotime(date('Y-01-01'));
        $berita_popular = Berita::where('id_sms', env('PRODI_ID'))
            ->where('tampil', 1)
            // ->where('ts', '>=', $thisYear)
            ->orderBy('counters', 'desc')->take(4)->get();

        // Fetch recent berita based on creation date
        $berita_recent = Berita::where('id_sms', env('PRODI_ID'))
            ->where('tampil', 1)->orderBy('ts', 'desc')->take(5)->get();
        return view('client_side.pages.profil_akreditasi', compact('menus', 'profil_akreditasi', 'agenda', 'berita_popular', 'berita_recent'));
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
