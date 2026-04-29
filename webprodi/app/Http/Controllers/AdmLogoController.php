<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;

class AdmLogoController extends Controller
{
    public function index(Request $request)
    {
        return view('admin_side.pages.admin_logo.logo');
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:png,jpg|max:2048',
        ], [
            'logo.required' => 'Logo Tidak Boleh Kosong',
            'logo.image' => 'File harus berupa gambar',
            'logo.mimes' => 'File harus berupa png,jpg,jpeg',
            'logo.max' => 'File melebihi batas ukuran 2 MB',
        ]);

        $imageName = env('PRODI_ID') . '.' . $request->logo->getClientOriginalExtension();
        if (file_exists(public_path('assets/images/logo/' . $imageName))) {
            unlink(public_path('assets/images/logo/' . $imageName));
        }
        $request->logo->move(public_path('assets/images/logo'), $imageName);

        return response()->json([
            'success' => true,
            'message' => 'Logo Tersimpan',
        ], 200);
    }
}
