<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $footers = Footer::orderBy('urut', 'desc')->where("id_ps", env("PRODI_ID"))->get();
        return view('admin_side.pages.admin_footer.footer', compact('footers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'urut' => 'required|integer',
            'url' => 'nullable|url',
            'aktif' => 'required|boolean',
            'newtab' => 'required|boolean',
            'jenis' => 'required|string',
            'icon_key' => 'nullable|string',
        ]);

        Footer::create([
            'id_ps' => env("PRODI_ID"),
            'nama' => $request['nama'],
            'urut' => $request['urut'],
            'url' => $request['url'],
            'aktif' => $request['aktif'],
            'newtab' => $request['newtab'],
            'jenis' => $request['jenis'],
        ]);
        return redirect()->back()->with('success', 'Footer berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Footer $footer)
    {
        return response()->json($footer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Footer $footer)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'urut' => 'required|integer',
            'url' => 'nullable|url',
            'aktif' => 'required|boolean',
            'newtab' => 'required|boolean',
            'jenis' => 'required|string',
            'icon_key' => 'nullable|string',
        ]);

        $footer->update($request->all());
        return redirect()->back()->with('success', 'Footer berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Footer $footer)
    {
        $footer->delete();
        return redirect()->back()->with('success', 'Footer berhasil dihapus');
    }
}
