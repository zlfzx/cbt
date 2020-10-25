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

Route::group([
  'prefix' => 'admin',
//  'middleware' => 'auth'
], function () {
    Route::redirect('/', '/admin/login');
    Auth::routes([
        'register' => false, // Registration Routes...
        'reset' => false, // Password Reset Routes...
        'verify' => false, // Email Verification Routes...
    ]);
    Route::group(['middlware' => 'auth', 'namespace' => 'Admin'],function(){
        Route::get('/', 'HomeController@index')->name('home');

        Route::post('/mapel/data', 'MapelController@dataMapel')->name('mapel.data');
        Route::get('/mapel/select', 'MapelController@select')->name('mapel.select');
        Route::resource('mapel', 'MapelController');

        Route::post('/kelas/data', 'KelasController@dataKelas')->name('kelas.data'); // datatable
        Route::get('/kelas/select', 'KelasController@select')->name('kelas.select'); // select2
        Route::resource('kelas', 'KelasController');

        Route::post('/siswa/data', 'SiswaController@dataSiswa')->name('siswa.data');
        Route::post('/siswa/lihat_password', 'SiswaController@lihat_password')->name('siswa.lihat_password');
        Route::post('/siswa/reset_password', 'SiswaController@reset_password')->name('siswa.reset_password');
        Route::resource('siswa', 'SiswaController')->except('create', 'edit');

        Route::post('/soal/data', 'SoalController@dataSoal')->name('soal.data');
        Route::resource('soal', 'SoalController');

        Route::post('/paket-soal/data', 'PaketSoalController@dataPaketSoal')->name('paket-soal.data');
        Route::get('/paket-soal/select', 'PaketSoalController@select')->name('paket-soal.select');
        Route::resource('paket-soal', 'PaketSoalController');

        Route::get('/ujian/aktif', 'UjianController@aktif')->name('ujian.aktif');
        Route::post('/ujian/data-aktif', 'UjianController@dataAktif')->name('ujian.data-aktif');
        Route::post('/ujian/data', 'UjianController@dataUjian')->name('ujian.data');
        Route::resource('ujian', 'UjianController');

        Route::post('/pengaturan/data-admin', 'PengaturanController@dataAdmin')->name('pengaturan.data-admin');
        Route::post('/pengaturan/tambah-admin', 'PengaturanController@tambah_admin')->name('pengaturan.tambah-admin');
        Route::resource('pengaturan', 'PengaturanController');
    });
});

Route::view('/{any}', 'app')->where('any', '.*');
