<?php

namespace App\Http\Controllers;

use App\Models\Pimpinan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PimpinanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $get_pimpinan = Pimpinan::where('id_sms', (int)env('PRODI_ID'))->get();
        $list_dosen = DB::table('dosen_siter')
            ->select('id_dosen', 'nama_dosen', 'foto_dosen')
            ->where('nama_program_studi', env('PRODI_NAME'))
            ->orderBy('nama_dosen', 'asc')
            ->get();


        if ($request->ajax()) {
            return DataTables::of($get_pimpinan)
                ->addColumn('foto_pimpinan', function ($get_pimpinan) {
                    // Mengembalikan URL lengkap untuk foto dalam bentuk lingkaran tanpa border tambahan
                    return '<img src="' . env("APP_URL") . $get_pimpinan->foto_pimpinan . '" width="50" height="50" class="rounded-circle">';
                })
                ->addColumn('nama_dosen', function ($get_pimpinan) {
                    return $get_pimpinan->pimpinan->nama_dosen;
                })
                ->addColumn('program_studi', function ($get_pimpinan) {
                    return $get_pimpinan->pimpinan->nama_program_studi;
                })
                ->addColumn('tampil', function ($get_pimpinan) {
                    if ($get_pimpinan->tampil == 1) {
                        return '<span class="badge badge-success">Ya</span>';
                    } else {
                        return '<span class="badge badge-danger">Tidak</span>';
                    }
                })
                ->addColumn('aksi', function ($get_pimpinan) {
                    return '
                        <div class="btn-group">
                            <a data-id="' . $get_pimpinan->id . '" class="btn btn-warning btn-sm edit" data-toggle="tooltip" title="Edit Pimpinan">
                            <i class="fas fa-edit text-white"></i>
                            </a>
                            <a data-id="' . $get_pimpinan->id . '"  class="btn btn-danger btn-sm delete" data-toggle="tooltip" title="Hapus Pimpinan">
                            <i class="fas fa-trash-alt text-white"></i>
                            </a>
                        </div>
                    ';
                })
                ->rawColumns(['aksi'])
                ->escapeColumns(['program_studi', 'nama_dosen'])
                ->make(true);
        }
        return view('admin_side.pages.admin_pimpinan.pimpinan', compact('list_dosen'));
        // return view('admin_side.pages.admin_pimpinan.pimpinan');
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
        // Validasi input
        $check_validate = $request->validate([
            'nama_dosen' => 'required',
            'jabatan' => 'required',
            'no_sk_pim' => 'required',
            'ts_sk_pim' => 'required',
            'ts_berlaku_pim' => 'required',
            'no_urut' => 'required',
            'tampil' => 'required',
            'foto_pimpinan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // validasi foto
        ]);

        if ($check_validate) {
            try {
                // Cek dan simpan foto_pimpinan jika ada
                $foto_pimpinan = null;
                if ($request->hasFile('foto_pimpinan')) {
                    $file = $request->file('foto_pimpinan');
                    $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

                    // Cek folder dan buat jika belum ada
                    $destinationPath = public_path('assets/images/foto_pimpinan');
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true);
                    }

                    // Pindahkan file ke direktori 'public/assets/images/foto_pimpinan'
                    $file->move($destinationPath, $fileName);
                    $foto_pimpinan = 'assets/images/foto_pimpinan/' . $fileName;
                }

                // Ambil id_dosen berdasarkan nama_dosen
                $get_reference_name = DB::table('dosen_siter')
                    ->where('nama_dosen', 'like', '%' . $request->nama_dosen . '%')
                    ->select('id_dosen')
                    ->get();

                if (count($get_reference_name) == 0) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Nama Dosen Tidak Cocok pada Database, Jika Belum Terdaftar Silahkan Hubungi Operator!',
                    ]);
                }

                // Simpan atau perbarui data pimpinan
                Pimpinan::updateOrCreate(
                    [
                        'id' => $request->id,
                    ],
                    [
                        'id_dosen' => $get_reference_name[0]->id_dosen,
                        'jabatan' => $request->jabatan,
                        'no_sk_pim' => $request->no_sk_pim,
                        'ts_sk_pim' => strtotime($request->ts_sk_pim),
                        'ts_berlaku_pim' => strtotime($request->ts_berlaku_pim),
                        'no_urut' => $request->no_urut,
                        'tampil' => $request->tampil,
                        'foto_pimpinan' => $foto_pimpinan,
                        'id_sms' => (int)env('PRODI_ID')
                    ]
                );
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => "Pimpinan Gagal Ditambahkan karena ada kesalahan Saat Pengimputan: " . $e->getMessage(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Pimpinan Berhasil Ditambahkan',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Pimpinan Gagal Ditambahkan karena ada kesalahan Saat Validasi',
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(Pimpinan $pimpinan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $get_detail_pimpinan = DB::select("
            SELECT *
            FROM pimpinan_ps
            JOIN dosen_siter ON pimpinan_ps.id_dosen = dosen_siter.id_dosen
            WHERE pimpinan_ps.id = $id
        ");

        return response()->json($get_detail_pimpinan);
    }
    public function update(Request $request, Pimpinan $pimpinan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $delete_pimpinan = Pimpinan::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Pimpinan Berhasil Dihapus',
        ]);
    }
}
