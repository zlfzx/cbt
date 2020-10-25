<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use Illuminate\Http\Request;

class UjianController extends Controller
{
  /**
   * @param Request $request
   */
    public function index(Request $request) {
        $data = Ujian::with('paket_soal')
          ->paginate($request->get('per_page', 10));

        return response()->json([
          'status' => TRUE,
          'data' => $data
        ], 200);

    }
}
