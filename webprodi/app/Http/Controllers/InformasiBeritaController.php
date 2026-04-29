<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Exception;

use Yajra\DataTables\DataTables;

class InformasiBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $get_berita = Berita::where('id_sms', (int)env('PRODI_ID'));
            return DataTables::of($get_berita)
                ->addcolumn('tampil', function ($get_berita) {
                    if ($get_berita->tampil == 1) {
                        return '<span class="badge badge-success">Tampil</span>';
                    } else {
                        return '<span class="badge badge-danger">Tidak Tampil</span>';
                    }
                })
                ->addColumn('aksi', function ($get_berita) {
                    return '
                    <div class="btn-group">
                    <a data-id="' . $get_berita->id . '" class="btn btn-warning btn-sm edit" data-toggle="tooltip" title="Edit Berita">
                    <i class="fas fa-edit text-white"></i>
                    </a>
                    <a data-id="' . $get_berita->id . '"  class="btn btn-danger btn-sm delete" data-toggle="tooltip" title="Hapus Berita">
                    <i class="fas fa-trash-alt text-white"></i>
                    </a>
                    </div>';
                })
                ->rawColumns(['aksi', 'tampil'])
                ->make(true);
        }
        return view('admin_side.pages.admin_berita.berita');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->id) {
            $count = Berita::where('judul', $request->judul)->where('id', '!=', $request->id)->count();
            if ($count > 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Judul Sudah Tersedia !",
                ], 500);
            }
        } else {
            $count = Berita::where('judul', $request->judul)->count();
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
            'tampil' => 'required',
            // 'foto_berita' => 'required',
        ], [
            "judul.required" => "Judul harus diisi",
            "isi.required" => "Isi harus diisi",
            "ts.required" => "Waktu harus diisi",
            "tampil.required" => "Tampil harus diisi",
            // "foto_berita.required" => "Foto berita harus diisi",
        ]);

        if ($check_validation) {
            try {
                Berita::updateOrCreate([
                    "id" => $request->id
                ], [
                    'id_admin' => 99,
                    'id_sms' => (int)env('PRODI_ID'),
                    'judul' => $request->judul,
                    'ts' => strtotime($request->ts),
                    'setuju' => 0,
                    'hapus' => 0,
                    'domain' => '',
                    'kategori' => 1,
                    'lengket' => 0,
                    'infopenting' => 1,
                    'caption' => '',
                    'isi' => $request->isi,
                    'tampil' => $request->tampil,
                    'foto_berita' => $request->foto_berita,
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
        $get_berita = Berita::findOrFail($id);

        return response()->json($get_berita);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete_berita = Berita::where('id', $id)->delete();
        if ($delete_berita) {
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
