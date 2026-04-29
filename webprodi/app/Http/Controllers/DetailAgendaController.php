<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Menu;
use App\Models\Pengumuman;

class DetailAgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $menus = Menu::getMenu();
        $get_detail_agenda = Agenda::where('id_sms', (int)env('PRODI_ID'))
            ->where('id_kegiatan', $id)
            ->orderBy('ts', 'desc')
            ->where('tampil', 1)
            ->first();

        if (!empty($get_detail_agenda)) {
            Agenda::where('id_kegiatan', $get_detail_agenda->id_kegiatan)
                ->update(['counters' => $get_detail_agenda->counters + 1]);
        }

        $agenda = Agenda::where('id_sms', (int)env('PRODI_ID'))
            ->where('tampil', 1)
            ->orderBy('ts', 'desc')
            ->where('tampil', 1)
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
            ->where('tampil', 1)
            ->orderBy('ts', 'desc')->take(5)->get();

        return view('client_side.pages.detail_agenda', compact('get_detail_agenda', 'agenda', 'menus', 'berita_popular', 'berita_recent'));
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
