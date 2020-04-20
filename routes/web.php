<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/template', function () {
    return view('layouts.global');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return redirect('/admin/login');
    });
    Auth::routes();
    Route::get('/', 'HomeController@index')->name('home');
    
    Route::post('/mapel/data', 'Admin\MapelController@dataMapel')->name('mapel.data');
    Route::resource('mapel', 'Admin\MapelController');

    Route::post('/kelas/data', 'Admin\KelasController@dataKelas')->name('kelas.data'); // datatable
    Route::resource('kelas', 'Admin\KelasController');
    
    Route::resource('siswa', 'Admin\SiswaController');
    Route::resource('soal', 'Admin\SoalController');
    Route::resource('paket-soal', 'Admin\PaketSoalController');

    Route::get('/ujian/riwayat', 'Admin\UjianController@riwayat')->name('ujian.riwayat');
    Route::resource('ujian', 'Admin\UjianController');

    Route::resource('pengaturan', 'Admin\PengaturanController');
});

Route::get('/', function () {
    return view('app');
});

Route::view('/{any}', 'app')->where('any', '.*');

// Auth::routes();
// Route::match(['get', 'post'], '/register', function () {
//     return redirect('/login');
// })->name('register');
