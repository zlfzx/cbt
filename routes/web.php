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

Route::get('/', function () {
    return view('app');
});

Route::view('/{any}', 'app')->where('any', '.*');

// Auth::routes();
// Route::match(['get', 'post'], '/register', function () {
//     return redirect('/login');
// })->name('register');

// Route::get('/admin/login', 'Auth\LoginController@showLoginForm');

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return redirect('/admin/login');
    });
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
});

