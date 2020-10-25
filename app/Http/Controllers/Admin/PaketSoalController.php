<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PaketSoal\StorePaketSoal;
use App\Models\PaketSoal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
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
        return view('PaketSoal.index');
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
   * @param StorePaketSoal $request
   * @return \Illuminate\Http\Response
   */
    public function store(StorePaketSoal $request)
    {
        $data = $request->all();
        $data['kode_paket'] = strtoupper(Str::random(5));
        $paket_soal = PaketSoal::create($data);

        return response()->json([
            'status' => TRUE,
            'message' => 'Paket Soal berhasil ditambahkan'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
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
     * @param $id
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
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $paket_soal = PaketSoal::findOrFail($id)->update($request->all());

        return response()->json([
            'status' => TRUE,
            'message' => 'Paket Soal berhasil diperbarui'
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
        $paket_soal = PaketSoal::findOrFail($id)->delete();

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

        $data = PaketSoal::select('id', 'nama')
                ->where('nama', 'LIKE', "%$search%")
                ->where('kelas_id', $kelas)
                ->where('mapel_id', $mapel)->get();
        return response()->json($data, 200);
    }
}
