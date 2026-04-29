<?php

namespace App\Http\Controllers;

use App\Models\Akreditasi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AkreditasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $akreditasi = Akreditasi::where('id_ps', (int)$_ENV['PRODI_ID'])->get();


        if ($request->ajax()) {
            return DataTables::of($akreditasi)
                ->addColumn('aksi', function ($akreditasi) {
                    return '
                        <div class="btn-group">
                            <a data-id="' . $akreditasi->id_ps . '" class="btn btn-warning btn-sm edit" data-toggle="tooltip" title="Edit Akreditasi">
                            <i class="fas fa-edit text-white"></i>
                            </a>
                        </div>
                    ';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        /* Script Default */
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


        return view('admin_side.pages.admin_akreditasi.akreditasi', compact('akreditasi', 'page_config'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Akreditasi $akreditasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $get_akre = Akreditasi::find($id);
        return response()->json($get_akre);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, $id)
    // {
    //     $is_validate = $request->validate([
    //         'nm_ps' => 'required|string|max:100',
    //         'strata' => 'required|string|max:100',
    //         'akre' => 'required|string|max:100',
    //         'no_sk' => 'required|string|max:100',
    //         'ts_sk' => 'required',
    //         'ts_berlaku' => 'required',
    //         ],
    //         [
    //             'nm_ps.required' => 'Namaa harus diisi',
    //             'strata.required' => 'Strata harus diisi',
    //             'akre.required' => 'Akreditasi harus diisi',
    //             'no_sk.required' => 'Nomor SK harus diisi',
    //             'ts_sk.required' => 'Tgl SK harus diisi',
    //             'ts_berlaku.required' => 'Tgl Berlaku harus diisi',
    //         ]
    //     );

    //     $akre = Akreditasi::find($id);

    //     if($is_validate){
    //      $akre->update([
    //         'nm_ps' => $request->nm_ps,
    //         'strata' => $request->strata,
    //         'akre' => $request->akre,
    //         'no_sk' => $request->no_sk,
    //         'ts_sk' => strtotime($request->ts_sk),
    //         'ts_berlaku' => strtotime($request->ts_berlaku),

    //     ]);
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Data Berhasil Disimpan',
    //     ]);
    //     }

    //     return response()->json([
    //         'success' => false,
    //         'message' => 'Data Gagal Disimpan karena kesalahan Validasi',
    //     ]);
    // }

    public function update(Request $request, $id)
    {
        // Validate the request input
        $is_validate = $request->validate(
            [
                'nm_ps' => 'required|string|max:100',
                'strata' => 'required|string|max:100',
                'akre' => 'required|string|max:100',
                'no_sk' => 'required|string|max:100',
                'ts_sk' => 'required',
                'ts_berlaku' => 'required',
                'foto_akreditasi' => 'nullable',
            ],
            [
                'nm_ps.required' => 'Nama harus diisi',
                'strata.required' => 'Strata harus diisi',
                'akre.required' => 'Akreditasi harus diisi',
                'no_sk.required' => 'Nomor SK harus diisi',
                'ts_sk.required' => 'Tgl SK harus diisi',
                'ts_berlaku.required' => 'Tgl Berlaku harus diisi',
                'foto_akreditasi.required' => 'Foto akreditasi harus diisi',
            ]
        );

        // Find the Akreditasi record by ID
        $akre = Akreditasi::find($id);

        if ($is_validate) {

            // Update the other fields
            $akre->update([
                'nm_ps' => $request->nm_ps,
                'strata' => $request->strata,
                'akre' => $request->akre,
                'no_sk' => $request->no_sk,
                'ts_sk' => strtotime($request->ts_sk),
                'ts_berlaku' => strtotime($request->ts_berlaku),
                'foto_akreditasi' => $request->foto_akreditasi,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Disimpan',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data Gagal Disimpan karena kesalahan Validasi',
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Akreditasi $akreditasi)
    {
        //
    }
}
