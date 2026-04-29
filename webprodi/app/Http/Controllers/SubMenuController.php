<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Response;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubMenuController extends Controller
{

    public function index(Request $request, $id)
    {

        $get_menu_utama = Menu::find($id);
        $data_submenu = $get_menu_utama->submenus;

        if ($request->ajax()) {

            return DataTables::of($data_submenu)
                ->addColumn('aktif', function ($submenu) {
                    if ($submenu->aktif == 1) {
                        return '<span class="badge badge-success">Aktif</span>';
                    } else {
                        return '<span class="badge badge-danger">Non-aktif</span>';
                    }
                })
                ->addColumn('newtab', function ($submenu) {
                    if ($submenu->newtab == 1) {
                        return '<span class="badge badge-success">Ya</span>';
                    } else {
                        return '<span class="badge badge-danger">Tidak</span>';
                    }
                })
                ->addColumn('aksi', function ($submenu) {
                    return '
                    <div class="btn-group">
                    <a data-id="' . $submenu->idmenu . '" class="btn btn-warning btn-sm editMenu" data-toggle="tooltip" title="Edit Menu">
                    <i class="fas fa-edit text-white"></i>
                    </a>
                    <a data-id="' . $submenu->idmenu . '"  class="btn btn-danger btn-sm deleteMenu" data-toggle="tooltip" title="Hapus Menu">
                    <i class="fas fa-trash-alt text-white"></i>
                    </a>

                </div>

                    ';
                })
                ->rawColumns(['aksi', 'aktif', 'newtab'])
                ->make(true);
        }



        $script = "
        <script src='" . asset('admin_side/vendor/jquery/jquery.min.js') . "'></script>
        <script src='" . asset('admin_side/vendor/bootstrap/js/bootstrap.bundle.min.js') . "'></script>
        <script src='" . asset('admin_side/vendor/jquery-easing/jquery.easing.min.js') . "'></script>
        <script src='" . asset('admin_side/js/ruang-admin.min.js') . "'></script>
        <script src='" . asset('admin_side/vendor/chart.js/Chart.min.js') . "'></script>
        <script src='" . asset('admin_side/js/demo/chart-area-demo.js') . "'></script>
        <script src='" . asset('admin_side/js/costum.js') . "'></script>
        ";
        /* End Script Default */
        $page_config['javascript'] = $script;

        return view('admin_side.pages.admin_submenu.submenu', compact('data_submenu', 'page_config',));
    }


    public function store(Request $request, $id)
    {

        $get_menu_utama = Menu::find($id);

        $check_validate = $this->validate($request, [
            'nama' => 'required|string|max:100',
            'urut' => 'required|integer',
            'url' => 'required|string|max:250',
            'aktif' => 'required|boolean',
            'newtab' => 'required|boolean',
        ], [
            'required' => ':attribute harus diisi',
            'string' => ':attribute harus berupa string',
            'max' => ':attribute maksimal :max karakter',
            'integer' => ':attribute harus berupa angka',
            'boolean' => ':attribute harus berupa boolean',
        ]);

        if ($check_validate) {
            try {
                Menu::updateOrcreate(
                    [
                        'idmenu' => $request->idmenu,
                        'urut' => $request->urut
                    ],

                    ['nama' => $request->nama, 'induk' => $get_menu_utama->idmenu, 'urut' => $request->urut, 'url' => $request->url, 'aktif' => $request->aktif, 'simbol' => 0, 'newtab' => $request->newtab, 'id_sms' => (int)env('PRODI_ID')]
                );
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Menu Gagal Disimpan karena ada kesalahan Saat Pengimputan',
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => 'Submenu Berhasil Disimpan',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Submenu Gagal Disimpan karena kesalahan Validasi',
        ]);
    }

    // public function edit(Request $request, $id)
    // {

    //     $submenu = Menu::find($id);
    //     return response()->json($submenu);
    // }


}
