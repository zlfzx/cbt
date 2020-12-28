<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use Illuminate\Http\Request;

class UjianController extends Controller
{
   /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
    public function index(Request $request) {
        $data = Ujian::select([
            'id', 'kelas_id', 'paket_soal_id', 'nama', 'keterangan', 'waktu_mulai', 'waktu_ujian'
          ])
          ->with('paket_soal')
          ->paginate($request->get('per_page', 10));

        return response()->json([
          'status' => TRUE,
          'data' => $data
        ], 200);
    }

  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
    public function checkToken(Request $request)
    {
        $valid = FALSE;
        $token = Ujian::where([
          'token' => $request->token
        ])->find($request->id);

        if ($token) {
          $valid = TRUE;
        }

        return response()->json([
          'status' => $valid
        ], 200);
    }
}
