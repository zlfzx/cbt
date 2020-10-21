<?php

use App\Models\Siswa;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'AuthController@login');

Route::middleware('auth:api')->group(function() {
    Route::get('user', function() {
        return Auth::user();
    });

    // check password siswa
    Route::get('password/check', function() {
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
    });

    // change password
    Route::post('password/change', 'AuthController@changePassword');

    // logout
    Route::post('logout', 'AuthController@logout');
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
