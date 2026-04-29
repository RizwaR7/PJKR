<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;

class AdmSliderController extends Controller
{
    public function index(Request $request)
    {
        return view('admin_side.pages.admin_slider.slider');
    }
    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:png,jpg,jpeg|max:3072',
        ], [
            'logo.required' => 'Logo Tidak Boleh Kosong',
            'logo.image' => 'File harus berupa gambar',
            'logo.mimes' => 'File harus berupa png,jpg,jpeg',
            'logo.max' => 'File melebihi batas ukuran 3 MB',
        ]);
        $imageName = $request->get('filename') . '.' . 'jpg'; #$request->logo->getClientOriginalExtension();
        $folderPath = public_path('assets/images/slider/');
        $fileNameWithoutExtension = $request->get('filename');

        // Cek apakah file dengan nama tersebut ada
        if (file_exists($folderPath . $imageName)) {
            $extensions = ['png', 'jpeg', 'jpg', 'gif', 'webp', 'svg'];

            foreach ($extensions as $ext) {
                $filePath = $folderPath . $fileNameWithoutExtension . '.' . $ext;

                // Cek jika file dengan ekstensi tersebut ada, lalu hapus
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        $request->logo->move(public_path('assets/images/slider'), $imageName);

        return response()->json([
            'success' => true,
            'message' => 'Banner Tersimpan',
        ], 200);
    }
}
