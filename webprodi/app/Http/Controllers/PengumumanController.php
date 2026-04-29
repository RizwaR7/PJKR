<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $get_pengumuman = Pengumuman::where('id_sms', (int)env('PRODI_ID'));
        if ($request->ajax()) {
            return DataTables::of($get_pengumuman)
                ->addColumn('tampil', function ($get_pengumuman) {
                    if ($get_pengumuman->tampil == 1) {
                        return '<span class="badge badge-success">Tampil</span>';
                    } else {
                        return '<span class="badge badge-danger">Tidak Tampil</span>';
                    }
                })
                ->addColumn('aksi', function ($get_pengumuman) {
                    return '
                    <div class="btn-group">
                    <a data-id="' . $get_pengumuman->id . '" class="btn btn-warning btn-sm edit" data-toggle="tooltip" title="Edit Pengumuman">
                    <i class="fas fa-edit text-white"></i>
                    </a>
                    <a data-id="' . $get_pengumuman->id . '"  class="btn btn-danger btn-sm delete" data-toggle="tooltip" title="Hapus Pengumuman">
                    <i class="fas fa-trash-alt text-white"></i>
                    </a>';
                })
                ->rawColumns(['aksi', 'tampil'])
                ->make(true);
        }
        return view('admin_side.pages.admin_pengumuman.pengumuman', compact('get_pengumuman'));
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
            $id = $request->id;
            $count = Pengumuman::where('judul', $request->input('judul'))->where('id', '!=', $id)->count();
            if ($count > 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Judul Pengumuman Sudah Tersedia !",
                ], 500);
            }
        } else {
            $count = Pengumuman::where('judul', $request->input('judul'))->count();
            if ($count > 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Judul Pengumuman Sudah Tersedia !",
                ], 500);
            }
        }

        $check_validation = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'ts' => 'required',
            'tampil' => 'required',
            'foto_berita' => 'nullable',
        ], [
            "judul.required" => "Judul harus diisi",
            "isi.required" => "Isi harus diisi",
            "ts.required" => "Waktu harus diisi",
            "tampil.required" => "Tampil harus diisi",
            "foto_berita.required" => "Foto Berita harus diisi",
        ]);

        if ($check_validation) {
            try {
                Pengumuman::updateOrCreate(
                    [
                        'id' => $request->id,
                    ],
                    [
                        'id_sms' => (int)env('PRODI_ID'),
                        'judul' => $request->judul,
                        'foto_berita' => $request->foto_berita,
                        'isi' => $request->isi,
                        'ts' => strtotime($request->ts),
                        'tampil' => $request->tampil,
                        'id_admin' => 99,
                        'setuju' => 0,
                        'hapus' => 0,
                        'domain' => '',
                        'kategori' => 0,
                        'lengket' => 0,
                        'infopenting' => 1,
                        'tgl_input' => date('Y-m-d H:i:s'),
                        'id2' => '',
                        'counter' => 0,
                        'caption' => ''

                    ]
                );
            } catch (\Exception $e) {
                return response()->json([
                    'error' => $e->getMessage()
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Disimpan'
            ]);
        }
        return response()->json(['error' => 'Data Gagal Disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengumuman $pengumuman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $get_pengumuman = Pengumuman::find($id);



        return response()->json($get_pengumuman);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengumuman $pengumuman) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $pengumuman = Pengumuman::find($id);
        $pengumuman->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Di Hapus'
        ]);
    }
}
