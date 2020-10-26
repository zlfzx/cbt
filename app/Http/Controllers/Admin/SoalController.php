<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Soal\StoreSoal;
use App\Models\Soal;
use App\Models\SoalJawaban;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Gate;

class SoalController extends Controller
{
    public function __construct() {
        $this->middleware(function($request, $next) {
            if (Gate::allows('manage-soal')) {
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
        return view('Soal.index');
    }

    // datatable
    public function dataSoal() {
        $soal = Soal::select('id', 'nama', 'jenis', 'paket_soal_id', 'kelas_id', 'mapel_id')
                    ->with('paket_soal')->with('kelas')->with('mapel')->get();

        return DataTables::of($soal)
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
        return view('Soal.create');
    }

  /**
   * Store a newly created resource in storage.
   *
   * @param StoreSoal $request
   * @return \Illuminate\Http\Response
   */
    public function store(StoreSoal $request)
    {
        $req = $request->all();
        $req_soal = $req['soal'];

        $soal = new Soal;
        $soal->nama = $req_soal['nama'];
        $soal->kelas_id = $req_soal['kelas'];
        $soal->mapel_id = $req_soal['mapel'];
        $soal->paket_soal_id = $req_soal['paket'];
        $soal->jenis = $req_soal['jenis'];
        $soal->soal = $req_soal['soal'];
        if ($request->hasFile('soal.soal_media')) {
            $media_soal = $request->file('soal.soal_media');
            $soal->media = $media_soal->store('media-soal', 'public');
        }
        // $soal->save();

        // simpan jawaban
        if ($req_soal['jenis'] == 'pilihan_ganda') {
            $soal->save();
            $jwb = $req['jawaban'];
            foreach ($jwb['pilgan'] as $key => $value) {
                $jawaban = new SoalJawaban;
                $jawaban->soal_id = $soal->id;
                $jawaban->jawaban = $value['jawaban'];
                if (!empty($value['media'])) {
                    $jawaban->media = $value['media']->store('media-jawaban', 'public');
                }
                // jawaban benar
                if ($jwb['benar'] == $key) {
                    $jawaban->status = '1';
                } else {
                    $jawaban->status = '0';
                }
                $jawaban->save();
            }
        }
        elseif ($req_soal['jenis'] == 'essai') {
            $soal->save();
            $jawaban = new SoalJawaban;
            $jawaban->soal_id = $soal->id;
            $jawaban->jawaban = $request->input('jawaban.essai');
            $jawaban->status = '1';
            $jawaban->save();
        }

        return response()->json([
            'status' => TRUE,
            'message' => 'Soal berhasil ditambahkan'
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
        $soal = Soal::select('id', 'nama', 'soal', 'media', 'jenis', 'kelas_id', 'mapel_id', 'paket_soal_id')
                    ->with(['soal_jawaban:id,jawaban,media,status,soal_id', 'kelas:id,nama', 'mapel:id,nama', 'paket_soal:id,nama'])->findOrFail($id);
        return response()->json([
            'status' => TRUE,
            'message' => $soal
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
        $soal = Soal::with([
            'kelas:id,nama',
            'mapel:id,nama',
            'paket_soal:id,nama',
            'soal_jawaban'
        ])->findOrFail($id);
//        dd($soal->toArray());
        return view('Soal.edit', compact('soal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Soal $soal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Soal $soal)
    {
        $dataSoal = $request->soal;
        $dataJawaban = $request->jawaban;

        // update soal
        $soal->update($dataSoal);

        // update jawaban
        $dd = '';
        if ($soal->jenis == 'essai') {
          $dd = 'essai';
        }
        elseif ($soal->jenis == 'pilihan_ganda') {
          foreach ($dataJawaban['pilgan'] as $key => $value) {
            if ($dataJawaban['benar'] == $key) {
              $value['status'] = '1';
            } else {
              $value['status'] = '0';
            }
            SoalJawaban::find($key)->update($value);
          }
        }

        return response()->json([
            'status' => TRUE,
            'message' => 'Soal berhasil diperbarui'
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Soal $soal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Soal $soal)
    {
        $soal->delete();

        return response()->json([
          'status' => TRUE,
          'message' => 'Soal berhasil dihapus!'
        ], 200);
    }
}
