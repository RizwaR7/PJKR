<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdmStrukturOrganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin_side.pages.admin_struktur_organisasi.struktur_organisasi');
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
        $request->validate([
            'struktur_organisasi' => 'required|image|mimes:png,jpg|max:2048',
        ], [
            'struktur_organisasi.required' => 'Struktur Organisasi Tidak Boleh Kosong',
            'struktur_organisasi.image' => 'File harus berupa gambar',
            'struktur_organisasi.mimes' => 'File harus berupa png,jpg,jpeg',
            'struktur_organisasi.max' => 'File melebihi batas ukuran 2 MB',
        ]);

        $imageName = env('PRODI_ID') . '.' . $request->struktur_organisasi->getClientOriginalExtension();

        if (!file_exists(public_path('assets/images/struktur-organisasi'))) {
            mkdir(public_path('assets/images/struktur-organisasi'), 0777, true);
        }

        if (file_exists(public_path('assets/images/struktur-organisasi/' . $imageName))) {
            unlink(public_path('assets/images/struktur-organisasi/' . $imageName));
        }

        $request->struktur_organisasi->move(public_path('assets/images/struktur-organisasi'), $imageName);

        return response()->json([
            'success' => true,
            'message' => 'Struktur Organisasi Tersimpan',
        ], 200);
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
        //
    }
}
