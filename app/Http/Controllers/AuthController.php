<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthUser\ChangePassword;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  /**
   * Create a new AuthController instance
   */
  public function __construct()
  {
    $this->middleware('auth:api', ['except' => ['login']]);
  }

  /**
   * login user
   */
  public function login()
  {
      $credential = request(['nis', 'password']);

      $siswa = Siswa::where('nis', $credential['nis'])->with('kelas:id,nama')->first();
      if ($siswa) {
          if ($credential['password'] === $siswa->password) {
              $token = auth()->guard('api')->login($siswa);
              return $this->respondWithToken($token);
          } else {
              $message = 'Login gagal, password salah!';
              return response()->json([
                  'message' => $message
              ], 401);
          }
      } else {
          $message = 'Login gagal, NIS tidak ditemukan!';
          return response()->json([
              'message' => $message
          ], 401);
      }
  }

  /**
   * Get user login
   */
  public function me()
  {
    return response()->json(auth()->guard('api')->user());
  }

  /**
   * Logout
   */
  public function logout()
  {
    auth()->logout();
    return response()->json([
      'status' => 'success',
      'message' => 'Berhasil keluar'
    ], 200);
  }

  /**
   * refresh token user
   */
  public function refresh()
  {
    return $this->respondWithToken(auth()->refresh());
  }

  /**
   * @param $token
   * @return \Illuminate\Http\JsonResponse
   */
  protected function respondWithToken($token)
  {
    return response()->json([
      'access_token' => $token,
      'token_type' => 'bearer',
      'expires_in' => auth()->guard('api')->factory()->getTTL() * 60,
      'data' => auth()->guard('api')->user()
    ]);
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
