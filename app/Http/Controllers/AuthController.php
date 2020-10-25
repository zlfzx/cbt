<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthUser\ChangePassword;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        $siswa = Siswa::where('nis', '=', $request->nis)->with('kelas:id,nama')->first();
        $status = 'error';
        $message = '';
        $data = null;
        $code = 401;
        if ($siswa) {
            if ($request->password === $siswa->password) {
                Auth::login($siswa);
                $siswa->generateToken();
                $status = 'success';
                $message = 'Login Sukses';
                $data = $siswa->toArray();
                $code = 200;
            } else {
                $message = 'Login gagal, password salah!';
            }
        } else {
            $message = 'Login gagal, NIS tidak ditemukan!';
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function logout(Request $request) {
        $siswa = Auth::user();
        if ($siswa) {
            $siswa->api_token = null;
            $siswa->save();
        }
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Logout Berhasil',
            'data' => null
        ], 200);
    }

  /**
   * @param ChangePassword $request
   * @return \Illuminate\Http\JsonResponse
   */
    public function changePassword(ChangePassword $request)
    {
        $passwd = Siswa::find(Auth::user()->id);
        $passwd->password = $request->password_baru;
        $passwd->save();

        return response()->json([
            'status' => TRUE,
            'message' => 'Kata Sandi berhasil diubah',
            'check' => FALSE
        ], 200);
    }
}
