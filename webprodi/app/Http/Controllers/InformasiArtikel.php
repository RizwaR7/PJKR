<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use Yajra\DataTables\DataTables;
use Exception;

class InformasiArtikel extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $get_artikel = Artikel::where('id_sms', (int)env('PRODI_ID'));

        if ($request->ajax()) {
            return DataTables::of($get_artikel)
                ->addColumn('aksi', function ($get_artikel) {
                    return '
                    <div class="btn-group">
                    <a data-id="' . $get_artikel->id . '" class="btn btn-warning btn-sm edit" data-toggle="tooltip" title="Edit Artikel">
                    <i class="fas fa-edit text-white"></i>
                    </a>
                    <a data-id="' . $get_artikel->id . '"  class="btn btn-danger btn-sm delete" data-toggle="tooltip" title="Hapus Artikel">
                    <i class="fas fa-trash-alt text-white"></i>
                    </a>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }


        return view('admin_side.pages.admin_artikel.artikel');
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
        if ($request->id) {
            $count = Artikel::where('judul', $request->judul)->where('id', '!=', $request->id)->where('id_sms', env('PRODI_ID'))->count();
            if ($count > 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Judul Sudah Tersedia !",
                ], 500);
            }
        } else {
            $count = Artikel::where('judul', $request->judul)
                ->where('id_sms', env('PRODI_ID'))
                ->count();

            if ($count > 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Judul Sudah Tersedia! !",
                ], 500);
            }
        }

        $check_validation = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'ts' => 'required',
            'tampil' => 'required',
        ], [
            "judul.required" => "Judul harus diisi",
            "isi.required" => "Isi harus diisi",
            "ts.required" => "Waktu harus diisi",
            "tampil.required" => "Tampil harus diisi",
        ]);

        if ($check_validation) {
            try {
                Artikel::updateOrCreate([
                    "id" => $request->id
                ], [
                    'id_sms' => (int)env('PRODI_ID'),
                    'judul' => $request->judul,
                    'isi' => $request->isi,
                    'id_admin' => 99,
                    'ts' => strtotime($request->ts),
                    'setuju' => 0,
                    'hapus' => 0,
                    'domain' => '',
                    'kategori' => 1,
                    'lengket' => 0,
                    'infopenting' => 1,
                    'caption' => '',
                    'tampil' => $request->tampil,
                    'counters' => 0,
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Artikel Gagal Disimpan",
                ], 500);
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Artikel Berhasil Disimpan'
            ], 200);
        }
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
        $get_artikel = Artikel::find($id);
        return response()->json($get_artikel);
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
        Artikel::destroy($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Artikel Berhasil Dihapus',

        ], 200);
    }
}
