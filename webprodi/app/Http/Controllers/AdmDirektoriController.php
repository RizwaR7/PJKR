<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use yajra\Datatables\Datatables;
use App\Models\Multimedia;

class AdmDirektoriController extends Controller
{

    public function index(Request $request, $dir){

       $get_direktori = Multimedia::where('dir', $dir)->whereNot('nama', '')->get();

        if($request->ajax()){
            return Datatables::of($get_direktori)
            ->addColumn('aksi', function($get_direktori){
                return '
                    <div class="btn-group">
                        <a data-id="' . $get_direktori->id . '" class="btn btn-warning btn-sm editMultimedia" data-toggle="tooltip" title="Edit Multimedia">
                        <i class="fas fa-edit text-white"></i>
                        </a>
                        <a data-id="' . $get_direktori->id . '"  class="btn btn-danger btn-sm deleteMultimedia" data-toggle="tooltip" title="Hapus Multimedia">
                        <i class="fas fa-trash-alt text-white"></i>
                        </a>
                    </div>
                ';
            })
            ->addColumn('url',function($get_direktori){
                return '
                <div class="input-group">
                  <input type="text" class="form-control" id="copy-url" value="' . asset('http://' . request()->getHost() . '/assets/images/file/' . $get_direktori->dir . '/' . $get_direktori->nama) . '" readonly>
                  <div class="input-group-append">
                    <button class="btn btn-sm btn-info copy-btn" data-toggle="tooltip" title="Copy URL">
                      <i class="fas fa-copy"></i>
                    </button>
                  </div>
                </div>
                  ';
            })
            ->rawColumns(['aksi','url'])
            ->make(true);
        }
        return view('admin_side.pages.admin_direktori.direktori');
    }

    public function store(Request $request,$dir){
        $is_validated = $request->validate([
            'upload' => 'nullable|file',
        ]);

        if(!$request->hasFile('upload') && is_null($request->id)){
            return response()->json([
                'sucess' => false,
                'message' => 'File tidak boleh kosong'], 500);
        }

        if($is_validated){
            if($request->hasFile('upload')){
                if(is_null($request->id)){
                    $get_dir = $dir;
                    $request->upload->move(public_path('assets/images/file/' . $get_dir), $request->upload->getClientOriginalName());

                } else if ($request->id){
                     $getOldMulti = Multimedia::where('id',$request->id)->first();
                    unlink(public_path('assets/images/file/' . $dir . '/' . $getOldMulti->nama));
                    $dir = $dir;
                    $request->upload->move(public_path('assets/images/file/' . $dir), $request->upload->getClientOriginalName());
                }
            }
            try {
                Multimedia::updateOrCreate(
                    ['id' => $request->id],
                    [
                        'dir' => $dir,
                        'id_sms' => env('PRODI_ID'),
                        'nama' => $request->upload->getClientOriginalName(),
                        'asli' => '',
                        'domain' => '',
                        'tanggal' => now()->format('Y-m-d'),
                        'iduser' => '',
                        'mime' => '',
                    ]
                );
            } catch (\Throwable $th) {
                return response()->json($th);
            }

            return response()->json([

            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Data Gagal Ditambahkan',
            ]);
        }
    }


}
