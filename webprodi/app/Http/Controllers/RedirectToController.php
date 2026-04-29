<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectToController extends Controller
{
    public function cek(){
        if(auth()->check()){
             return redirect('admin');
        } else {
            return redirect()->route('masuk_admin');
        }
    }
}
