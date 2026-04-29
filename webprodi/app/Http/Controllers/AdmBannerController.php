<?php

namespace App\Http\Controllers;

use App\Models\banner;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdmBannerController extends Controller
{

    public function index(Request $request)
    {
        $data = banner::where('id_sms', (int)env('PRODI_ID'))->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addcolumn('aksi', function ($data) {
                    return '
                      <div class="btn-group">
                            <a data-id="' . $data->id . '" class="btn btn-warning btn-sm edit" data-toggle="tooltip" title="Edit Kategori Berita">
                            <i class="fas fa-edit text-white"></i>
                            </a>
                            <a data-id="' . $data->id . '"  class="btn btn-danger btn-sm delete" data-toggle="tooltip" title="Hapus Kategori Berita">
                            <i class="fas fa-trash-alt text-white"></i>
                            </a>
                        </div>
                ';
                })
                ->rawcolumns(['aksi'])
                ->make(true);
        }
        return view('admin_side.pages.admin_banner.banner');
    }

    public function store(Request $request)
    {
        $check_validate = $this->validate($request, [
            'filegambar' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'nomor' => 'required|integer',
            'url' => 'required|regex:/^(?!.*<\/?script>).*$/i|max:100',
            'tampil' => 'required',
        ], [
            'nomor.required' => 'Nomor Tidak Boleh Kosong',
            'url.required' => 'Link Tidak Boleh Kosong',
            'tampil.required' => 'Tampil Tidak Boleh Kosong',
            'url.regex' => 'Link Tidak Boleh Mengandung Script',
        ]);

        if ($request->id) {
            $old_banner = banner::find($request->id);
        }

        if ($check_validate) {
            if ($request->id) {
                if ($request->hasFile('filegambar')) {
                    $filegambar_nama = $request->filegambar->getClientOriginalName();
                    $filegambar_path = public_path('assets/images/banner/' . $filegambar_nama);
                    if (file_exists($filegambar_path)) {
                        unlink($filegambar_path);
                    }
                    $request->filegambar->move(public_path('assets/images/banner'), $filegambar_nama);
                } else {
                    $filegambar_nama = $old_banner->filegambar;
                }
            } else {
                if ($request->hasFile('filegambar')) {
                    $filegambar_nama = $request->filegambar->getClientOriginalName();
                    $filegambar_path = public_path('assets/images/banner/' . $filegambar_nama);
                    if (file_exists($filegambar_path)) {
                        unlink($filegambar_path);
                    }
                    $request->filegambar->move(public_path('assets/images/banner'), $filegambar_nama);
                } else {
                    return response()->json(['success' => false, 'message' => 'File Gambar Tidak Boleh Kosong'], 500);
                }
            }

            try {
                banner::updateOrcreate(
                    ['id' => $request->id],
                    [
                        'id_sms' => (int)env('PRODI_ID'),
                        'filegambar' => $filegambar_nama,
                        'nomor' => $request->nomor ?? 0,
                        'grup' => $request->grup ?? 0,
                        'url' => $request->url ?? 0,
                        'tampil' => $request->tampil ?? 0,
                        'domain' => $request->domain ?? 0,
                        'besar' => 1010,
                        'ukuran' => '1010x1010',
                    ]
                );
            } catch (Exception $e) {
                return response()->json(['success' => false, 'message' => 'Data Gagal Disimpans' . $e], 500);
            }
            return response()->json(['success' => true, 'message' => 'Data Berhasil Disimpan'], 200);
        }
        return response()->json([
            'success' => false,
            'message' => "Terjadi Kesalahan",
        ], 500);
    }
    public function edit(Request $request, $id)
    {
        $getDataBanner = banner::find($id);
        return response()->json($getDataBanner);
    }

    public function destroy($id)
    {
        $getDataBanner = banner::find($id);
        if ($getDataBanner) {
            $filegambar_path = public_path('assets/images/banner/') . $getDataBanner->filegambar;
            if (file_exists($filegambar_path)) {
                unlink($filegambar_path);
            }
            $getDataBanner->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Banner Berhasil Dihapus',
            ], 200);
        }
    }
}
