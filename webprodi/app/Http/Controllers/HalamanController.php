<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Halaman;
use Exception;

use Yajra\DataTables\DataTables;

class HalamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $get_halaman = Halaman::where('id_sms', (int)env('PRODI_ID'));
            return DataTables::of($get_halaman)
                ->addColumn('aksi', function ($get_halaman) {
                    return '
                    <div class="btn-group">
                    <a data-id="' . $get_halaman->id . '" class="btn btn-warning btn-sm edit" data-toggle="tooltip" title="Edit Berita">
                    <i class="fas fa-edit text-white"></i>
                    </a>
                    <a data-id="' . $get_halaman->id . '"  class="btn btn-danger btn-sm delete" data-toggle="tooltip" title="Hapus Berita">
                    <i class="fas fa-trash-alt text-white"></i>
                    </a>
                    </div>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin_side.pages.admin_halaman.halaman');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->id) {
            $count = Halaman::where('judul', $request->judul)->where('id', '!=', $request->id)->count();
            if ($count > 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Judul Sudah Tersedia !",
                ], 500);
            }
        } else {
            $count = Halaman::where('judul', $request->judul)->count();
            if ($count > 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Judul Sudah Tersedia !",
                ], 500);
            }
        }

        $check_validation = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'ts' => 'required',
        ], [
            "judul.required" => "Judul harus diisi",
            "isi.required" => "Isi harus diisi",
            "ts.required" => "Waktu harus diisi",
        ]);

        if ($check_validation) {
            try {
                Halaman::updateOrCreate([
                    "id" => $request->id
                ], [
                    'id_sms' => (int)env('PRODI_ID'),
                    'judul' => $request->judul,
                    'ts' => strtotime($request->ts),
                    'isi' => $request->isi,
                    'foto_halaman' => $request->foto_halaman,
                    'counters' => 0,
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Data Gagal Disimpan Karena Ada Kesalahan Saat Pengimputan",
                ], 500);
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Data Berhasil Disimpan'
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'message' => "Data Gagal Disimpan Karena Ada Kesalahan Saat Saat Validasi",
        ], 500);
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
        $get_berita = Halaman::findOrFail($id);

        return response()->json($get_berita);
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
        $delete_halaman = Halaman::where('id', $id)->delete();
        if ($delete_halaman) {
            return response()->json([
                'status' => 'success',
                'message' => 'Berita Berhasil Disimpan'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Berita Gagal Disimpan'
            ], 500);
        }
    }
}
