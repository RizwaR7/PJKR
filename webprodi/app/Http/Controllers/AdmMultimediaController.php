<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Multimedia;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class AdmMultimediaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $get_multimedia = Multimedia::where('id_sms', (int)env('PRODI_ID'))->where('nama', ' ')->orderBy('id', 'desc')->get();

            return DataTables::of($get_multimedia)

                ->addColumn('jumlah', function ($multimedia) {
                    return $multimedia->where('dir', $multimedia->dir)->count() - 1;
                })
                ->addColumn('aksi', function ($multimedia) {
                    return '
                        <div class="btn-group">
                            <a data-id="' . $multimedia->id . '"  class="btn btn-danger btn-sm deleteMultimedia" data-toggle="tooltip" title="Hapus Multimedia">
                            <i class="fas fa-trash-alt text-white"></i>
                            </a>
                            <a href="' . route('direktori.index', $multimedia->dir) . '" class="btn btn-info btn-sm lihatMultimedia" data-toggle="tooltip" title="Lihat Multimedia">
                            <i class="fas fa-tasks fa-fw text-white"></i>
                            </a>
                            </a>
                        </div>
                    ';
                })
                ->rawColumns(['aksi', 'jumlah'])
                ->make(true);
        }
        return view('admin_side.pages.admin_multimedia.multimedia');
    }

    public function store(Request $request)
    {
        $isValidated = $request->validate([
            'dir' => 'required',
        ], [
            'dir.required' => 'Folder harus diisi',
        ]);
        if ($isValidated) {
            if (preg_match('/\s/', $request->dir)) {
                $request->merge(['dir' => str_replace(' ', '-', $request->dir)]);
            }
            if (is_null($request->id)) {
                if (!file_exists(public_path('assets/images/file/' . $request->dir))) {
                    mkdir(public_path('assets/images/file/' . $request->dir), 0777, true);
                } else {
                    return response()->json(
                        [
                            'status' => false,
                            'message' => 'Nama Folder Sudah Digunakan!',
                        ],
                        500
                    );
                }
            } else {
                $getOldMulti = Multimedia::where('id', $request->id)->first();
                $new_dir = $request->dir;
                rename(public_path('assets/images/file/' . $getOldMulti->dir), public_path('assets/images/file/' . $new_dir));
            }
            try {
                Multimedia::updateOrCreate([
                    'id' => $request->id
                ], [
                    'dir' => $request->dir,
                    'id_sms' => env('PRODI_ID'),
                    'nama' => '',
                    'asli' => '',
                    'domain' => '',
                    'tanggal' => now()->format('Y-m-d'),
                    'iduser' => '',
                    'mime' => '',
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'success' => 'Multimedia Gagal Disimpan karena ada kesalahan Penginputan'
                ]);
            }
            return response()->json([
                'status' => true,
                'message' => 'Folder Berhasil Disimpan',
            ], 200);
        }
    }
    public function edit($id)
    {
        $get_multimedia = Multimedia::find($id);
        return response()->json($get_multimedia);
    }

    public function destroy($id)
    {

        $dir = Multimedia::find($id)->dir;
        $folderPath = public_path('assets/images/file/' . $dir);
        if (file_exists($folderPath)) {
            File::deleteDirectory($folderPath);
        }
        Multimedia::find($id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Multimedia Berhasil Dihapus',
        ], 200);
    }
}
