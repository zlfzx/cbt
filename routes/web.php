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

//Route::get('/template', function () {
//    return view('layouts.admin');
//});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return redirect('/admin/login');
    });
    Auth::routes();
    Route::get('/', 'HomeController@index')->name('home');

    Route::post('/mapel/data', 'Admin\MapelController@dataMapel')->name('mapel.data');
    Route::get('/mapel/select', 'Admin\MapelController@select')->name('mapel.select');
    Route::resource('mapel', 'Admin\MapelController');

    Route::post('/kelas/data', 'Admin\KelasController@dataKelas')->name('kelas.data'); // datatable
    Route::get('/kelas/select', 'Admin\KelasController@select')->name('kelas.select'); // select2
    Route::resource('kelas', 'Admin\KelasController');

    Route::post('/siswa/data', 'Admin\SiswaController@dataSiswa')->name('siswa.data');
    Route::post('/siswa/lihat_password', 'Admin\SiswaController@lihat_password')->name('siswa.lihat_password');
    Route::post('/siswa/reset_password', 'Admin\SiswaController@reset_password')->name('siswa.reset_password');
    Route::resource('siswa', 'Admin\SiswaController');

    Route::post('/soal/data', 'Admin\SoalController@dataSoal')->name('soal.data');
    Route::resource('soal', 'Admin\SoalController');

    Route::post('/paket-soal/data', 'Admin\PaketSoalController@dataPaketSoal')->name('paket-soal.data');
    Route::get('/paket-soal/select', 'Admin\PaketSoalController@select')->name('paket-soal.select');
    Route::resource('paket-soal', 'Admin\PaketSoalController');

    Route::get('/ujian/aktif', 'Admin\UjianController@aktif')->name('ujian.aktif');
    Route::post('/ujian/data-aktif', 'Admin\UjianController@dataAktif')->name('ujian.data-aktif');
    Route::post('/ujian/data', 'Admin\UjianController@dataUjian')->name('ujian.data');
    Route::resource('ujian', 'Admin\UjianController');

    Route::post('/pengaturan/data-admin', 'Admin\PengaturanController@dataAdmin')->name('pengaturan.data-admin');
    Route::post('/pengaturan/tambah-admin', 'Admin\PengaturanController@tambah_admin')->name('pengaturan.tambah-admin');
    Route::resource('pengaturan', 'Admin\PengaturanController');
});

Route::view('/{any}', 'app')->where('any', '.*');

// Auth::routes();
// Route::match(['get', 'post'], '/register', function () {
//     return redirect('/login');
// })->name('register');
