<?php

namespace App\Http\Controllers\Admin;

use App\PaketSoal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaketSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('paket_soal');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\PaketSoal  $paketSoal
     * @return \Illuminate\Http\Response
     */
    public function show(PaketSoal $paketSoal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\PaketSoal  $paketSoal
     * @return \Illuminate\Http\Response
     */
    public function edit(PaketSoal $paketSoal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\PaketSoal  $paketSoal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaketSoal $paketSoal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\PaketSoal  $paketSoal
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaketSoal $paketSoal)
    {
        //
    }
}
