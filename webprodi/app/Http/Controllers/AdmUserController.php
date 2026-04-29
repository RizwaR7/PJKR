<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use yajra\Datatables\Datatables;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdmUserController extends Controller
{
    public function index(Request $request)
    {
        $get_user = User::select('id', 'sid')->where('id_ps', env('PRODI_ID'))->get();
        if ($request->ajax()) {
            return Datatables::of($get_user)
                ->addColumn('aksi', function ($data) {
                    $button = '<div class="btn-group" role="group" aria-label="Basic example"> '
                        . '<button data-id="' . $data->id . '" type="button" name="edit" class="edit btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>'
                        . '<button data-id="' . $data->id . '" type="button" name="delete" class="delete btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>'
                        . '</div>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin_side.pages.admin_user.user');
    }

    public function store(Request $request)
{
    if ($request->id == null) {
        $create_validate = $request->validate([
            'sid' => 'required|unique:user|min:5|max:20',
            'password' => 'required|min:5|max:20',
        ], [
            'sid.unique' => 'Username sudah ada',
            'sid.required' => 'Username harus diisi',
            'sid.min' => 'Username minimal 5 karakter',
            'sid.max' => 'Username maksimal 20 karakter',
            'password.required' => 'Password harus diisi',
        ]);

        if ($create_validate) {
            User::create([
                'sid' => $request->sid,
                'password' => Hash::make($request->password),
                'pass' => $request->password,
                'id_ps' => env('PRODI_ID'),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Ditambahkan',
            ], 200);
        }
    } else {
        $user = User::find($request->id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan',
            ], 404);
        }

        $update_validate = $request->validate([
            'sid' => 'required',
            'old_password' => 'nullable',
            'new_password' => 'nullable|min:5|max:20',
            'confirm_password' => 'nullable|same:new_password',
        ]);

        // Jika user hanya mengubah nama
        if ($request->sid !== $user->sid && empty($request->new_password)) {
            $user->update(['sid' => $request->sid]);
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Diubah',
            ], 200);
        }

        // Jika user hanya mengubah password
        if (!empty($request->new_password) && !empty($request->old_password)) {
            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Password lama tidak cocok',
                ], 400);
            }

            $user->update([
                'password' => Hash::make($request->new_password),
                'pass' => $request->new_password,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Diubah',
            ], 200);
        }

        // Jika user mengubah nama dan password
        if ($request->sid !== $user->sid && !empty($request->new_password) && !empty($request->old_password)) {
            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Password lama tidak cocok',
                ], 400);
            }

            $user->update([
                'sid' => $request->sid,
                'password' => Hash::make($request->new_password),
                'pass' => $request->new_password,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Diubah',
            ], 200);
        }

        return redirect()->back()->with('info', 'Tidak ada perubahan yang dilakukan');
    }
}

    public function edit($id)
    {
        $get_user = User::where('id', $id)->first();
        return response()->json($get_user);
    }
    public function destroy($id)
    {
        $get_user = User::select('id', 'sid')->where('id_ps', env('PRODI_ID'))->get();


        // if (count($get_user) < 3) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Admin harus ada minimal 2 user',
        //     ], 500);
        // }

        $get_user = User::findOrFail($id);
        $get_user->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus',
        ], 200);
    }
}
