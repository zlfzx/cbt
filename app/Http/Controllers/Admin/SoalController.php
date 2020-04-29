<?php

namespace App\Http\Controllers\Admin;

use App\Soal;
use App\SoalJawaban;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DataTables;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('soal');
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
        return view('soal_tambah');
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
            'soal.kelas' => 'required',
            'soal.mapel' => 'required',
            'soal.paket' => 'required',
            'soal.jenis' => 'required',
            'soal.nama' => 'required',
            'soal.soal' => 'required',
            'soal.soal_media' => 'nullable|file|mimetypes:video/mp4,video/x-msvideo,video/3gpp',
            'jawaban.essai' => 'required_if:soal.jenis,essai',
            'soal.jumlah_pilihan' => 'required_if:soal.jenis,pilihan_ganda',
            'jawaban.pilgan.*.jawaban' => 'required_if:soal.jenis,pilihan_ganda',
            'jawaban.pilgan.*.media' => 'nullable|file|mimetypes:video/mp4,video/x-msvideo,video/3gpp',
            'jawaban.benar' => 'required_if:soal.jenis,pilihan_ganda'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => FALSE,
                'message' => $validator->errors()->all()
            ], 200);
        }

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
     * @param  \App\Admin\Soal  $soal
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
     * @param  \App\Admin\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function edit(Soal $soal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Soal $soal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Soal $soal)
    {
        //
    }
}
