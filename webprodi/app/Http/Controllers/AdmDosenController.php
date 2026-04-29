<?php

namespace App\Http\Controllers;

use App\Models\DosenSiter;
use App\Models\Pimpinan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class AdmDosenController extends Controller
{
    public function index(Request $request)
    {
        // $get_dosen = DosenSiter::where('nama_program_studi', env('PRODI_NAME'))->get();
        $get_dosen = DB::table('dosen_siter')
            ->where('nama_program_studi', env('PRODI_NAME'))
            ->get();
        if ($request->ajax()) {
            return DataTables::of($get_dosen)
                ->addColumn('foto_dosen', function ($get_dosen) {
                    // Mengembalikan URL lengkap untuk foto dosen dalam bentuk lingkaran

                    if (!empty($get_dosen->foto_dosen)) {
                        return '<img src="' . env("APP_URL") . $get_dosen->foto_dosen . '" width="50" height="50" style="border-radius: 50%; object-fit: cover; object-position: top;">';
                    } else {
                        return '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="gray" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                            </svg>';
                    }
                })


                ->addColumn('nip', function ($get_dosen) {
                    return $get_dosen->nip;
                })
                ->addColumn('nidn', function ($get_dosen) {
                    return $get_dosen->nidn;
                })->addColumn('nama_dosen', function ($get_dosen) {
                    return $get_dosen->nama_dosen;
                })->addColumn("jenis_kelamin", function ($get_dosen) {
                    return $get_dosen->jenis_kelamin;
                })->addColumn("nama_ikatan_kerja", function ($get_dosen) {
                    return $get_dosen->nama_ikatan_kerja;
                })
                ->addColumn('nama_golongan', function ($get_dosen) {
                    return $get_dosen->nama_golongan;
                })->addColumn('email', function ($get_dosen) {
                    return $get_dosen->email_sister;
                })->addColumn('scholar_id', function ($get_dosen) {
                    return $get_dosen->scholar_id;
                })
                ->addColumn('sinta_id', function ($get_dosen) {
                    return $get_dosen->sinta_id;
                })
                ->addColumn('sister_id', function ($get_dosen) {
                    return $get_dosen->sister_id;
                })
                ->addColumn('aksi', function ($get_dosen) {
                    return '
                        <div class="btn-group">
                            <a data-id="' . $get_dosen->id_dosen . '" class="btn btn-warning btn-sm edit" data-toggle="tooltip" title="Edit Dosen">
                            <i class="fas fa-edit text-white"></i>
                            </a>
                            <a data-id="' . $get_dosen->id_dosen . '"  class="btn btn-danger btn-sm delete" data-toggle="tooltip" title="Hapus Dosen">
                            <i class="fas fa-trash-alt text-white"></i>
                            </a>
                        </div>
                    ';
                })
                ->rawColumns(['aksi'])
                ->escapeColumns(['nama_dosen'])
                ->make(true);
        }

        $nama_program_studi = env('PRODI_NAME');

        return view('admin_side.pages.admin_dosen.dosen', compact('nama_program_studi'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $check_validate = $request->validate([
            'id_dosen' => 'nullable', // id_dosen is optional for new entries
            'nip' => 'required',
            'nidn' => 'nullable',
            'jenis_kelamin' => 'required',
            'email' => 'nullable',
            'nama_dosen' => 'required',
            'nama_program_studi' => 'required',
            'nama_golongan' => 'nullable',
            'foto_dosen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // validasi foto
            'scholar_id' => 'nullable',
            'sinta_id' => 'nullable',
            'sister_id' => 'nullable',
            'nama_ikatan_kerja' => 'nullable',
        ]);

        if ($check_validate) {
            try {
                $foto_dosen = null;
                if ($request->hasFile('foto_dosen')) {
                    $file = $request->file('foto_dosen');
                    $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

                    // Cek folder dan buat jika belum ada
                    $destinationPath = public_path('assets/images/foto_dosen');
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true);
                    }

                    // Pindahkan file ke direktori 'public/assets/images/foto_dosen'
                    $file->move($destinationPath, $fileName);
                    $foto_dosen = 'assets/images/foto_dosen/' . $fileName;
                } else {
                    $foto_dosen = $request->foto_dosen ?? '';
                }

                // Simpan atau perbarui data dosen
                DosenSiter::updateOrCreate(
                    [
                        'id_dosen' => $request->id_dosen, // only if updating an existing record
                    ],
                    [
                        'nip' => $request->nip,
                        'nama_dosen' => $request->nama_dosen,
                        'nama_program_studi' => $request->nama_program_studi,
                        'foto_dosen' => $foto_dosen,
                        'scholar_id' => $request->scholar_id,
                        'sinta_id' => $request->sinta_id,
                        'sister_id' => $request->sister_id,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'email' => $request->email_sister,
                        'email_sister' => $request->email_sister,
                        'nidn' => $request->nidn,
                        'nama_golongan' => $request->nama_golongan,
                        'nama_ikatan_kerja' => $request->nama_ikatan_kerja,

                    ]
                );
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => "Dosen Gagal Ditambahkan karena ada kesalahan Saat Pengimputan: " . $e->getMessage(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Success',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Dosen Gagal Ditambahkan karena ada kesalahan Saat Validasi',
        ]);
    }

    public function edit(Request $request, $id)
    {
        $get_detail_dosen = DosenSiter::where([
            ['nama_program_studi', env('PRODI_NAME')],
            ['id_dosen', $id]
        ])->get();

        return response()->json($get_detail_dosen);
    }

    public function destroy(Request $request, $id)
    {
        $get_pimpinan = Pimpinan::where([['id_sms', (int)env('PRODI_ID')], ['id_dosen', $id]])->first();
        if ($get_pimpinan) {
            return response()->json([
                'success' => false,
                'message' => 'Dosen Gagal Dihapus karena Dosen Tersebut adalah Pimpinan Program Studi',
            ], 400);
        } else {
            $delete_dosen = DosenSiter::where([
                ['nama_program_studi', env('PRODI_NAME')],
                ['id_dosen', $id]
            ])->delete();
            return response()->json([
                'success' => true,
                'message' => 'Dosen Berhasil Dihapus',
            ]);
        }
    }
}
