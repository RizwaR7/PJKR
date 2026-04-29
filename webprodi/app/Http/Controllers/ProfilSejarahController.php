<?php

namespace App\Http\Controllers;

use App\Models\profil_sejarah;
use Illuminate\Http\Request;

class ProfilSejarahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $default = (int)env('PRODI_ID');
        $get_sejarah = profil_sejarah::where('id_sms', $default)->where('jenis', 2)->first();


        return view('admin_side.pages.admin_sejarah.sejarah', compact('get_sejarah'));
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
        $check_validate = $request->validate([
            'isi' => 'required',
        ]);

        if ($check_validate) {
            $get_user = auth()->user();
            $id_user = $get_user->id;

            $update_sejarah = profil_sejarah::updateOrCreate(
                [
                    'id_sms' => (int)env('PRODI_ID'),
                    'jenis' => 2,
                ],
                [
                    'id_user' => $id_user,
                    'isi' => $request->isi,
                ]
            );
            return response()->json($update_sejarah);
        } else {
            return response()->json($check_validate);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(profil_sejarah $profil_sejarah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(profil_sejarah $profil_sejarah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $check_validate = $request->validate([
            'isi' => 'required',
        ], [
            'regex' => 'Terdapat Eksekusi Script. ',
        ]);

        if ($check_validate) {
            $update_visi_misi = profil_sejarah::where('id', $id)->update(['isi' => $request->isi]);
            return response()->json($update_visi_misi);
        } else {
            return response()->json($check_validate);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(profil_sejarah $profil_sejarah)
    {
        //
    }
}
