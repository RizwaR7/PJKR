<?php

namespace App\Http\Controllers;

use App\Models\Profil_visi_misi;
use Illuminate\Http\Request;

class ProfilVisiMisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $default = (int)env('PRODI_ID');
        $get_visi_misi = Profil_visi_misi::where('id_sms', $default)->where('jenis', 1)->first();

        // Jika data tidak ditemukan, berikan nilai default
        if (!$get_visi_misi) {
            $get_visi_misi = (object)[
                'judul' => 'Default Judul',
                'deskripsi' => 'Default Deskripsi'
            ];
        }

        return view('admin_side.pages.admin_visi_misi.visi_misi', compact('get_visi_misi'));
    }

    public function store(Request $request)
    {
        $check_validate = $request->validate([
            'isi' => 'required',
        ]);

        if ($check_validate) {
            $get_user = auth()->user();
            $id_user = $get_user->id;

            $update_visi_misi = Profil_visi_misi::updateOrCreate(
                [
                    'id_sms' => (int)env('PRODI_ID'),
                    'jenis' => 1,
                ],
                [
                    'id_user' => $id_user,
                    'isi' => $request->isi,
                ]
            );
            return response()->json($update_visi_misi);
        } else {
            return response()->json($check_validate);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $check_validate = $request->validate([
            'isi' => 'required|regex:/^(?!.*<\/?script>).*$/i',
        ], [
            'regex' => 'Terdapat Eksekusi Script. ',
        ]);

        if ($check_validate) {
            $update_visi_misi = Profil_visi_misi::where('id', $id)->update(['isi' => $request->isi]);
            return response()->json($update_visi_misi);
        } else {
            return response()->json($check_validate);
        }
    }
}
