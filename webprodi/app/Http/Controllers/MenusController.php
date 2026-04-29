<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Menu;
use App\Http\Requests\MenuRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class MenusController extends Controller
{
    public function index(Request $request)
    {
        $menus = Menu::where('id_sms', (int)env('PRODI_ID'))->where('induk', 0)->orderBy('urut', 'asc')->get();
        if ($request->ajax()) {
            return DataTables::of($menus)
                ->addIndexColumn()
                ->addColumn('nama', function ($menus) {
                    $countSubMenu = $menus->submenus->count();
                    return '<span>' . $menus->nama . '</span> <span class="badge badge-info"> ' . $countSubMenu . ' <i class="fas fa-tasks fa-fw"></i></span>';
                })
                ->addColumn('aktif', function ($menus) {
                    if ($menus->aktif == 1) {
                        return '<span class="badge badge-success">Aktif</span>';
                    } else {
                        return '<span class="badge badge-danger">Non-aktif</span>';
                    }
                })
                ->addColumn('newtab', function ($menus) {
                    if ($menus->newtab == 1) {
                        return '<span class="badge badge-success">Ya</span>';
                    } else {
                        return '<span class="badge badge-danger">Tidak</span>';
                    }
                })
                ->addColumn('aksi', function ($menus) {
                    return '
                        <div class="btn-group">
                            <a data-id="' . $menus->idmenu . '" class="btn btn-warning btn-sm editMenu" data-toggle="tooltip" title="Edit Menu">
                            <i class="fas fa-edit text-white"></i>
                            </a>
                            <a data-id="' . $menus->idmenu . '"  class="btn btn-danger btn-sm deleteMenu" data-toggle="tooltip" title="Hapus Menu">
                            <i class="fas fa-trash-alt text-white"></i>
                            </a>
                            <a href="' . route('sub_menu.index', $menus->idmenu) . '" class="btn btn-info btn-sm lihatSubmenu" data-toggle="tooltip" title="Lihat Submenu">
                            <i class="fas fa-tasks fa-fw text-white"></i>
                            </a>
                            </a>
                        </div>
                    ';
                })
                ->rawColumns(['aksi', 'aktif', 'newtab', 'nama', 'subMenu'])
                ->make(true);
        }
        /* End Script Default */
        return view('admin_side.pages.admin_menu.menu', compact('menus'));
    }
    public function store(Request $request)
    {

        $check_validate = $this->validate($request, [
            'nama' => 'required|regex:/^(?!.*<\/?script>).*$/i|max:100',
            'urut' => 'required|integer',
            'url' => 'required|regex:/^(?!.*<\/?script>).*$/i|max:100',
            'aktif' => 'required|boolean',
            'newtab' => 'required|boolean',
        ], [
            'nama.required' => 'Judul Menu Tidak Boleh Kosong',
            'urut.required' => 'Nomor Urut Tidak Boleh Kosong',
            'url.required' => 'Link Tidak Boleh Kosong',
            'aktif.required' => 'Status Tidak Boleh Kosong',
            'newtab.required' => 'Status Tidak Boleh Kosong',
            'nama.regex' => 'Judul Menu Tidak Boleh Mengandung Script',
            'url.regex' => 'Link Tidak Boleh Mengandung Script',

        ]);
        if ($check_validate) {
            try {
                Menu::updateOrcreate(
                    [
                        'idmenu' => $request->idmenu,
                    ],
                    ['nama' => $request->nama, 'induk' => 0, 'urut' => $request->urut, 'url' => $request->url, 'aktif' => $request->aktif, 'simbol' => 0, 'newtab' => $request->newtab, 'id_sms' => (int)env('PRODI_ID')]
                );
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Menu Gagal Disimpan karena ada kesalahan Saat Pengimputan',
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => 'Menu Berhasil Disimpan',
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Menu Gagal Disimpan',
        ]);
    }
    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return view('menus.show', ['menu' => $menu]);
    }
    public function edit($id)
    {
        $menu = Menu::find($id);
        return response()->json($menu);
    }
    public function destroy($id)
    {
        Menu::find($id)->delete();
        Menu::where('induk', $id)->delete();
        return response()->json(['success' => 'Menu deleted successfully.']);
    }
}
