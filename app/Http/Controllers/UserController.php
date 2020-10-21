<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // index user
    public function index() {
        return Auth::user();
    }

    // check password siswa
    public function checkPassword() {
        $passwd = Siswa::select('id', 'nis', 'password')->find(Auth::user()->id);
        if ($passwd['nis'] == $passwd['password']) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Password belum diubah'
            ], 200);
        }
        return response()->json([
            'status' => FALSE
        ], 200);
    }
}
