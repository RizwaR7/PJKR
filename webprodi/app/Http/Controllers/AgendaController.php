<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Menu;
use App\Models\Berita;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $menus = Menu::getMenu();

        $query = $request->input('query');

        if ($query) {
            $query = preg_replace('/[^A-Za-z0-9\s]/', ' ', $query); // Mengganti tanda '-' dengan spasi
        }

        $agenda = Agenda::where('id_sms', (int)$_ENV['PRODI_ID'])
            ->where('tampil', 1)
            ->when($query, function ($q) use ($query) {
                return $q->where('judul_kegiatan', 'LIKE', "%{$query}%");
            })
            ->orderBy('ts', 'desc')
            ->paginate(8);


        // Fetch popular berita based on counters
        $thisYear = strtotime(date('Y-01-01'));
        $berita_popular = Berita::where('id_sms', env('PRODI_ID'))
            ->where('tampil', 1)
            ->orderBy('counters', 'desc')
            ->take(4)
            ->get();

        // Fetch recent berita based on creation date
        $berita_recent = Berita::where('id_sms', env('PRODI_ID'))
            ->where('tampil', 1)->orderBy('ts', 'desc')->take(5)->get();

        return view('client_side.pages.agenda', compact('agenda', 'menus', 'berita_popular', 'berita_recent'));
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
