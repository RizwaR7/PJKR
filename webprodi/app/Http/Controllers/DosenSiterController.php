<?php

namespace App\Http\Controllers;

use App\Models\DosenSiter;
use Illuminate\Http\Request;

class DosenSiterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosensiters = DosenSiter::orderBy('nama_dosen', 'asc')->get();
        return view('admin_side.pages.admin_dosensiter.dosensiter', compact('dosensiters'));
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
        $nidn = $request->input('nidn');
        $nip = $request->input('nip');
        $nik = $request->input('nik');
        $nama_dosen = $request->input('nama_dosen');
        $jenis_kelamin = $request->input('jenis_kelamin');
        $jns_sdm = $request->input('jns_sdm');
        $nama_ikatan_kerja = $request->input('nama_ikatan_kerja');
        $fakultas = $request->input('fakultas');
        $nama_program_studi = $request->input('nama_program_studi');
        $nama_golongan = $request->input('nama_golongan');
        $email = $request->input('email');
        $email_sister = $request->input('email_sister');
        $status_keaktifan = $request->input('status_keaktifan');
        $status_kepegawaian = $request->input('status_kepegawaian');
        $scholar_id = $request->input('scholar_id');
        $sinta_id = $request->input('sinta_id');

        DosenSiter::create([
            'nidn' => $nidn,
            'nip' => $nip,
            'nik' => $nik,
            'nama_dosen' => $nama_dosen,
            'jenis_kelamin' => $jenis_kelamin,
            'jns_sdm' => $jns_sdm,
            'nama_ikatan_kerja' => $nama_ikatan_kerja,
            'fakultas' => $fakultas,
            'nama_program_studi' => $nama_program_studi,
            'nama_golongan' => $nama_golongan,
            'email' => $email,
            'email_sister' => $email_sister,
            'status_keaktifan' => $status_keaktifan,
            'status_kepegawaian' => $status_kepegawaian,
            'scholar_id' => $scholar_id,
            'sinta_id' => $sinta_id,
        ]);

        return redirect()->back(); 
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DosenSiter::find($id)->delete();
        return redirect()->back();
    }
}
