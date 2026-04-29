<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Profil;
use App\Http\Requests\ProfilRequest;

class ProfilsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('profils.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProfilRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProfilRequest $request)
    {
        $profil = new Profil;
        $profil->isi = $request->input('isi');
        $profil->jenis = $request->input('jenis');
        $profil->id_sms = $request->input('id_sms');
        $profil->id_user = $request->input('id_user');
        $profil->save();

        return to_route('profils.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $profil = Profil::findOrFail($id);
        return view('profils.show', ['profil' => $profil]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $profil = Profil::findOrFail($id);
        return view('profils.edit', ['profil' => $profil]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProfilRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfilRequest $request, $id)
    {
        $profil = Profil::findOrFail($id);
        $profil->isi = $request->input('isi');
        $profil->jenis = $request->input('jenis');
        $profil->id_sms = $request->input('id_sms');
        $profil->id_user = $request->input('id_user');
        $profil->save();

        return to_route('profils.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $profil = Profil::findOrFail($id);
        $profil->delete();

        return to_route('profils.index');
    }
}
