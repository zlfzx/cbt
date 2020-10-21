<?php

namespace App\Http\Controllers\Admin;

use App\Models\Siswa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class SiswaController extends Controller
{
    public function __construct() {
        $this->middleware(function($request, $next) {
            if (Gate::allows('manage-siswa')) {
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
        return view('siswa');
    }

    // datatable
    public function dataSiswa() {
        $siswa = Siswa::select('id', 'nama', 'nis', 'kelas_id')->with('kelas')->get();
        return DataTables::of($siswa)
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nis' => 'required|unique:siswa',
            'kelas' => 'required',
            'password' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => FALSE,
                'message' => $validator->errors()->all()
            ]);
        }

        $siswa = new Siswa;
        $siswa->nama = $request->nama;
        $siswa->nis = $request->nis;
        if ($request->password) {
            $siswa->password = $request->password;
        } else {
            $siswa->password =  $request->nis;
        }
        $siswa->kelas_id = $request->kelas;

        $siswa->save();
        return response()->json([
            'status' => TRUE,
            'message' => 'Siswa berhasil ditambahkan'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Siswa $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Siswa::select('id', 'nama', 'nis', 'password', 'kelas_id')->with('kelas')->findOrFail($id);
        return response()->json($siswa, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nis' => 'required|unique:siswa,nis,'.$id,
            'kelas' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => FALSE,
                'message' => $validator->errors()->all()
            ]);
        }

        $siswa = Siswa::findOrFail($id);

        $siswa->nama = $request->nama;
        $siswa->nis = $request->nis;
        $siswa->password = $request->password;
        $siswa->kelas_id = $request->kelas;
        $siswa->save();

        return response()->json([
            'status' => TRUE,
            'message' => 'Siswa berhasil diubah'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return response()->json([
            'status' => TRUE,
            'message' =>'Siswa berhasil dihapus'
        ], 200);
    }

    // lihat password
    public function lihat_password(Request $request) {
        $siswa = Siswa::select('id', 'nama', 'password')->findOrFail($request->id);
        return response()->json($siswa, 200);
    }

    // reset password
    public function reset_password(Request $request) {
        $siswa = Siswa::select('id', 'nama', 'nis', 'password')->findOrFail($request->id);

        $siswa->password = $siswa->nis;
        $siswa->save();
        return response()->json([
            'status' => TRUE,
            'message' => 'Password '.$siswa->nama.' berhasil direset'
        ], 200);
    }
}
