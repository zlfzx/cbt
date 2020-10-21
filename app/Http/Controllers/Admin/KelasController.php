<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class KelasController extends Controller
{
    public function __construct() {
        $this->middleware(function($request, $next) {
            if (Gate::allows('manage-kelas')) {
                return $next($request);
            }
            abort(403, 'Access Forbidden');
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kelas');
    }

    // DataTables
    public function dataKelas(Request $request) {
        return DataTables::of(Kelas::select('id', 'nama')->get())
                ->addIndexColumn()
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kelas = new Kelas;
        $kelas->nama = $request->kelas;

        $kelas->save();
        return response()->json([
            'status' => TRUE,
            'message' => 'Kelas berhasil ditambahkan'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Kelas  $kelas
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelas = Kelas::select('id', 'nama')->findOrFail($id);
        return response()->json($kelas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $kelas->nama = $request->kelas;
        $kelas->save();

        return response()->json([
            'status' => TRUE,
            'message' => 'Kelas berhasil diubah'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return response()->json([
            'status' => TRUE,
            'message' => 'Kelas dan data terkait berhasil dihapus'
        ], 200);
    }

    // select2
    public function select(Request $request) {
        $search = $request->get('q');

        $data = Kelas::select('id', 'nama')->where('nama', 'LIKE', "%$search%")->get();
        return response()->json($data, 200);
    }
}
