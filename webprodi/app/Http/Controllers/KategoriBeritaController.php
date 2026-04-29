<?php

namespace App\Http\Controllers;

use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KategoriBeritaController extends Controller
{
    /**
     * Display a listing of the resource.p
     */
    public function index(Request $request)
    {

        $get_kategori = KategoriBerita::where('id_sms', (int)env('PRODI_ID'))->get();

        if ($request->ajax()) {
            return DataTables::of($get_kategori)
                ->addColumn('status', function ($get_kategori) {
                    if ($get_kategori->status == 1) {
                        return '<span class="badge badge-success">Aktif</span>';
                    } else {
                        return '<span class="badge badge-danger">Non-aktif</span>';
                    }
                })
                ->addColumn('aksi', function ($get_kategori) {
                    return '
                        <div class="btn-group">
                            <a data-id="' . $get_kategori->id . '" class="btn btn-warning btn-sm edit" data-toggle="tooltip" title="Edit Kategori Berita">
                            <i class="fas fa-edit text-white"></i>
                            </a>
                            <a data-id="' . $get_kategori->id . '"  class="btn btn-danger btn-sm delete" data-toggle="tooltip" title="Hapus Kategori Berita">
                            <i class="fas fa-trash-alt text-white"></i>
                            </a>

                        </div>
                    ';
                })
                ->rawColumns(['aksi', 'status'])
                ->make(true);;
        }
        return view('admin_side.pages.admin_kategori_berita.kategori_berita', compact('get_kategori'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $check_validation = $request->validate([
            'nama' => 'required|string|max:100',
            'status' => 'required',

        ]);

        if ($check_validation) {
            try {
                KategoriBerita::updateOrCreate(

                    ['id' => $request->id],
                    [
                        'id_sms' => (int)env('PRODI_ID'),
                        'nama' => $request->nama,
                        'id_induk' => 0,
                        'status' => $request->status,
                    ]
                );
            } catch (\Exception $e) {
                return response()->json(['error' => 'Kategori Berita Gagal Disimpan karena ada kesalahan' . $e->getMessage()]);
            }
            return response()->json(['success' => 'Menu Berhasil Disimpan']);
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $get_kategori = KategoriBerita::find($id);
        return response()->json($get_kategori);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        KategoriBerita::find($id)->delete();
        return response()->json(['success' => 'Kategori Berita Berhasil Dihapus']);
    }
}
