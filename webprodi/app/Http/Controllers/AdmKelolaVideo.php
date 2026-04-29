<?php

namespace App\Http\Controllers;

use App\Models\M_video;
use Illuminate\Http\Request;

class AdmKelolaVideo extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $video = M_video::where('id_ps', (int)env('PRODI_ID'))->first();

        return view('admin_side.pages.admin_kelola_video.kelola_video', compact('video'));
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
            'id' => 'nullable',
            'name' => 'required',
            'url' => 'required',
            'desc' => 'required',
        ]);

        if ($check_validate) {

            try {
                M_video::updateOrCreate(
                    [
                        'id' => $request->id,
                    ],
                    [
                        'name' => $request->name,
                        'url' => $request->url,
                        'desc' => $request->desc,
                        'id_ps' => (int)env('PRODI_ID'),
                    ]
                );
            } catch (\Exception $e) {

                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menambahkan video: ' .  $e->getMessage(),
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menambahkan video',
            ]);
        } else {

            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan video karena kesalahan validasi',
            ]);
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
