<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Pengaturan\StoreAdmin;
use App\Models\Pengaturan;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class PengaturanController extends Controller
{
    public function __construct() {
        $this->middleware(function($request, $next) {
            if (Gate::allows('manage-pengaturan')) {
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
        return view('Pengaturan.index');
    }

  /**
   * @return mixed
   * @throws \Exception
   */
    public function dataAdmin() {
        $data = User::get();
        $data = json_decode($data, true);
        return DataTables::of($data)
                         ->addIndexColumn()
                         ->make(true);
    }

  /**
   * @param StoreAdmin $request
   * @return \Illuminate\Http\JsonResponse
   */
    public function tambah_admin(StoreAdmin $request) {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $admin = User::create($data);

        return response()->json([
            'status' => TRUE,
            'message' => 'Admin berhasil ditambah'
        ], 200);
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
     * @param  \App\Admin\Pengaturan  $pengaturan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengaturan $pengaturan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Pengaturan  $pengaturan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengaturan $pengaturan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Pengaturan $pengaturan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengaturan $pengaturan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Pengaturan $pengaturan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengaturan $pengaturan)
    {
        //
    }
}
