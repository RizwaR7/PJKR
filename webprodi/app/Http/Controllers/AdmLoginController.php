<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class AdmLoginController extends Controller
{

    public function login(Request $request)
    {



        $is_validate = $request->validate([
            'sid' => 'required',
            'password' => 'required'
        ]);

        if ($is_validate) {
            if (auth()->attempt($is_validate)) {
                $request->session()->regenerate();
                return redirect('redirect');
            } else {
                return back()->withErrors(['error' => 'Username Atau Password Salah!']);
            }
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('masuk_admin');
    }
}
