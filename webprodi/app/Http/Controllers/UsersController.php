<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::where('id_ps', (int)env('PRODI_ID'))->get();




        return view('admin_side.pages.admin_user.user', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $user = new User;
        $user->password = $request->input('password');
        $user->sid = $request->input('sid');
        $user->pass = $request->input('pass');
        $user->aktif = $request->input('aktif');
        $user->tingkat = $request->input('tingkat');
        $user->induk = $request->input('induk');
        $user->jumlahlogin = $request->input('jumlahlogin');
        $user->tslogin = $request->input('ts_login');
        $user->tslogout = $request->input('ts_logout');
        $user->ip = $request->input('ip');
        $user->id_ps = $request->input('id_ps');
        $user->save();

        return to_route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->password = $request->input('password');
        $user->sid = $request->input('sid');
        $user->pass = $request->input('pass');
        $user->aktif = $request->input('aktif');
        $user->tingkat = $request->input('tingkat');
        $user->induk = $request->input('induk');
        $user->jumlahlogin = $request->input('jumlahlogin');
        $user->tslogin = $request->input('ts_login');
        $user->tslogout = $request->input('ts_logout');
        $user->ip = $request->input('ip');
        $user->id_ps = $request->input('id_ps');
        $user->save();

        return to_route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return to_route('users.index');
    }
}
