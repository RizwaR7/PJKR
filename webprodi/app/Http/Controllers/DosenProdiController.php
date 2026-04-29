<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\DosenProdi;
use Illuminate\Support\Facades\DB;

class DosenProdiController extends Controller
{
    public function index(Request $request)
    {
        $get_dosen = DB::table("dosen_ps")
            ->join("dosen_siter", "dosen_ps.id_ptk", "=", "dosen_siter.id_dosen")
            ->where("dosen_ps.id_sms", (int)env('PRODI_ID'))
            ->get();
        if ($request->ajax()) {
            return DataTables::of($get_dosen)
                ->addColumn('aksi', function ($get_dosen) {})
                ->make(true);
        }
        return view('admin_side.pages.dosen_prodi.dosen_prodi');
    }
}
