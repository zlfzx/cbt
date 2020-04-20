<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mapel;
use Illuminate\Http\Request;
use DataTables;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mapel');
    }

    // datatable
    public function dataMapel() {
        $mapel = Mapel::select('id', 'nama')->get();
        return DataTables::of($mapel)
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
        $mapel = new Mapel;
        $mapel->nama = $request->mapel;
        $mapel->save();

        return response()->json([
            'status' => TRUE,
            'message' => 'Mata Pelajaran berhasil ditambahkan'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mapel = Mapel::select('id', 'nama')->findOrFail($id);
        return response()->json($mapel, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mapel = Mapel::findOrFail($id);
        $mapel->nama = $request->mapel;
        $mapel->save();

        return response()->json([
            'status' => TRUE,
            'message' => 'Mata Pelajaran berhasil diubah'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mapel = Mapel::findOrFail($id);
        $mapel->delete();

        return response()->json([
            'status' => TRUE,
            'message' => 'Mata Pelajaran dan data terkait berhasil dihapus'
        ], 200);
    }
}
