<?php

namespace App\Http\Controllers;

use App\Models\Halaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class HalamanController extends Controller
{
    public function index()
    {
        $data = DB::table('halaman')
            ->where('id_sms', (int)env('PRODI_ID'))
            ->get();

        return view('admin_side.pages.admin_halaman.halaman', [
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_sms' => 'required|string|in:' . env('PRODI_ID'),
            'judul'    => 'required|string',
            'isi'    => 'required|string',
            'foto_halaman'    => 'required|string',
        ]);

        Halaman::create($validatedData);

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_sms' => 'required|string|in:' . env('PRODI_ID'),
            'judul' => 'required|string',
            'isi' => 'required|string',
            'foto_halaman' => 'required|string',
        ]);

        $halaman = Halaman::findOrFail($id);

        $halaman->update($validatedData);

        return redirect()->back();
    }


    public function destroy($id)
    {
        $halaman = Halaman::findOrFail($id);

        $halaman->delete();

        return redirect()->back();
    }
}
