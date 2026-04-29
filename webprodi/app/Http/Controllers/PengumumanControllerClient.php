<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Menu;
use App\Models\Pengumuman;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengumumanControllerClient extends Controller
{
    public function index(Request $request)
    {
        /* Show Profil jurusan */
        $profil = Profil::where('id_sms', (int)env('PRODI_ID'))->first();
        /* Show Menu Navigation */
        $menus = Menu::getMenu();

        $agenda = Agenda::where('id_sms', (int)env('PRODI_ID'))
            ->where('tampil', 1)
            ->orderBy('ts', 'desc')
            ->limit(6)
            ->get();

        // Menangkap input pencarian dari search form
        $query = $request->input('query');

        if ($query) {
            $query = preg_replace('/[^A-Za-z0-9\s]/', ' ', $query); // Mengganti tanda '-' dengan spasi
        }

        // Query utama untuk mengambil berita, pengumuman, dan artikel
        $beritaQuery = DB::table('berita')
            ->select('judul', 'ts', 'isi', 'id', 'foto_berita', 'counters', DB::raw('"Berita" as jenis'))
            ->where('tampil', 1)
            ->where('id_sms', (int)env('PRODI_ID'));

        $pengumumanQuery = DB::table('pengumuman')
            ->select('judul', 'ts', 'isi', 'id', 'foto_berita', 'counters', DB::raw('"Pengumuman" as jenis'))
            ->where('tampil', 1)
            ->where('id_sms', (int)env('PRODI_ID'));

        $artikelQuery = DB::table('artikel')
            ->select('judul', 'ts', 'isi', 'id', 'foto_berita', 'counters', DB::raw('"Artikel" as jenis'))
            ->where('tampil', 1)
            ->where('id_sms', (int)env('PRODI_ID'));

        // Jika ada pencarian, filter berdasarkan judul
        if (!empty($query)) {
            $beritaQuery->where('judul', 'LIKE', "%{$query}%");
            $pengumumanQuery->where('judul', 'LIKE', "%{$query}%");
            $artikelQuery->where('judul', 'LIKE', "%{$query}%");
        }

        // Pastikan semua data muncul jika tidak ada pencarian
        $all = $pengumumanQuery
            ->orderByRaw('ts DESC') // Pastikan urutan tetap sesuai timestamp
            ->paginate(8);

        // Fetch berita populer berdasarkan jumlah views dalam tahun berjalan
        $thisYear = strtotime(date('Y-01-01'));
        $berita_popular = Berita::where('id_sms', env('PRODI_ID'))
            ->where('tampil', 1)
            ->orderBy('counters', 'desc')->take(4)
            ->get();

        // Fetch berita terbaru berdasarkan waktu publikasi
        $berita_recent = DB::table('berita')
            ->where('id_sms', env('PRODI_ID'))
            ->where('tampil', 1)
            ->orderBy('ts', 'desc')
            ->take(5)
            ->get();

        return view('client_side.pages.pengumuman', compact('profil', 'menus', 'agenda', 'all', 'berita_popular', 'berita_recent'));
    }
}
