<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Agenda;
use Exception;

class InformasiAgenda extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $get_agenda = Agenda::where('id_sms', (int)env('PRODI_ID'));
        if ($request->ajax()) {
            return DataTables::of($get_agenda)
                ->addcolumn('tampil', function ($get_agenda) {
                    if ($get_agenda->tampil == 1) {
                        return '<span class="badge badge-success">Tampil</span>';
                    } else {
                        return '<span class="badge badge-danger">Tidak Tampil</span>';
                    }
                })
                ->addColumn('aksi', function ($get_agenda) {
                    return '
                    <div class="btn-group">
                    <a data-id="' . $get_agenda->id_kegiatan . '" class="btn btn-warning btn-sm edit" data-toggle="tooltip" title="Edit Artikel">
                    <i class="fas fa-edit text-white"></i>
                    </a>
                    <a data-id="' . $get_agenda->id_kegiatan . '"  class="btn btn-danger btn-sm delete" data-toggle="tooltip" title="Hapus Artikel">
                    <i class="fas fa-trash-alt text-white"></i>
                    </a>';
                })
                ->rawColumns(['aksi', 'tampil'])
                ->make(true);
        };
        return view('admin_side.pages.admin_agenda.agenda');
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
            $count = Agenda::where('judul_kegiatan', $request->judul_kegiatan)->where('id_kegiatan', '!=', $request->id)->count();
            if ($count > 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Judul Kegiatan Sudah Tersedia !",
                ], 500);
            }
        } else {
            $count = Agenda::where('judul_kegiatan', $request->judul_kegiatan)->count();
            if ($count > 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Judul Kegiatan Sudah Tersedia !",
                ], 500);
            }
        }

        $check_validate = $request->validate([
            'judul_kegiatan' => 'required',
            'tempat_kegiatan' => 'required',
            'isi_kegiatan' => 'required',
            'ts' => 'required',
            'tampil' => 'required'
        ], [
            "judul_kegiatan.required" => "Judul harus diisi",
            "tempat_kegiatan.required" => "Tempat harus diisi",
            "isi_kegiatan.required" => "Isi harus diisi",
            "ts.required" => "Waktu harus diisi",
            "tampil.required" => "Tampil harus diisi",
        ]);
        if ($check_validate) {
            try {
                Agenda::updateOrCreate([
                    "id_kegiatan" => $request->id
                ], [
                    'id_sms' => (int)env('PRODI_ID'),
                    'judul_kegiatan' => $request->judul_kegiatan,
                    'tempat_kegiatan' => $request->tempat_kegiatan ?? "Unknown",
                    'isi_kegiatan' => $request->isi_kegiatan,
                    'ts' => strtotime($request->ts),
                    'tampil' => $request->tampil,
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Agenda Berhasil Disimpan'
                ], 200);
            } catch (Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Agenda Gagal Disimpan Karena Ada Kesalahan : "
                ], 500);
            }
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
        $get_agenda = Agenda::findOrFail($id);
        return response()->json($get_agenda);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $get_agenda = Agenda::findOrFail($id);
        $get_agenda->delete();
        return response()->json([
            'success' => true,
            'message' => 'Agenda Berhasil Dihapus',
        ]);
    }
}
