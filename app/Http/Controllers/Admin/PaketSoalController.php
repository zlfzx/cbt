<?php

namespace App\Http\Controllers\Admin;

use App\PaketSoal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use DataTables;
use Illuminate\Support\Facades\Gate;

class PaketSoalController extends Controller
{
    public function __construct() {
        $this->middleware(function($request, $next) {
            if (Gate::allows('manage-paket')) {
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
        return view('paket_soal');
    }

    // datatable
    public function dataPaketSoal() {
        $data = PaketSoal::select('id', 'kode_paket', 'nama', 'keterangan', 'kelas_id', 'mapel_id')->with('kelas')->with('mapel')->get();
        return DataTables::of($data)
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
            'keterangan' => 'nullable',
            'kelas' => 'required',
            'mapel' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => FALSE,
                'message' => $validator->errors()->all()
            ], 200);
        }
        
        $paket_soal = new PaketSoal;
        $paket_soal->kode_paket = strtoupper(Str::random(5));
        $paket_soal->nama = $request->nama;
        $paket_soal->keterangan = $request->keterangan;
        $paket_soal->kelas_id = $request->kelas;
        $paket_soal->mapel_id = $request->mapel;
        $paket_soal->save();

        return response()->json([
            'status' => TRUE,
            'message' => 'Paket Soal berhasil ditambahkan'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\PaketSoal  $paketSoal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paket = PaketSoal::select('id', 'nama', 'kode_paket', 'kelas_id', 'mapel_id')
                          ->with(['kelas:id,nama', 'mapel:id,nama', 'soal', 'soal.soal_jawaban'])->findOrFail($id);
        // $paket['soal'] = \App\Soal::with(['soal_jawaban'])->where('paket_soal_id', '=', $id)->get();
        return response()->json([
            'status' => TRUE,
            'message' => $paket
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\PaketSoal  $paketSoal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paket_soal = PaketSoal::select('id', 'nama', 'keterangan', 'kelas_id', 'mapel_id')->with('kelas')->with('mapel')->findOrFail($id);
        return response()->json([
            'status' => TRUE,
            'message' => $paket_soal
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\PaketSoal  $paketSoal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $paket_soal = PaketSoal::findOrFail($id);
        $paket_soal->nama = $request->nama;
        $paket_soal->keterangan = $request->keterangan;
        $paket_soal->kelas_id = $request->kelas;
        $paket_soal->mapel_id = $request->mapel;
        $paket_soal->save();

        return response()->json([
            'status' => TRUE,
            'message' => 'Paket Soal berhasil diperbarui'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\PaketSoal  $paketSoal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paket_soal = PaketSoal::findOrFail($id);
        $paket_soal->delete();

        return response()->json([
            'status' => TRUE,
            'message' => 'Paket Soal dan data terkait berhasil dihapus'
        ], 200);
    }

    // select2
    public function select(Request $request) {
        $search = $request->get('q');
        $kelas = $request->get('kelas');
        $mapel = $request->get('mapel');

        $data = PaketSoal::select('id', 'nama')->where('nama', 'LIKE', "%$search%")
                                               ->where('kelas_id', $kelas)
                                               ->where('mapel_id', $mapel)->get();
        return response()->json($data, 200);
    }
}
