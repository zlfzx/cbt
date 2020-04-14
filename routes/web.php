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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/template', function () {
    return view('layouts.global');
});
// Route::get('/template/login', function () {
//     return view('auth._login');
// });
// Route::get('/template/register', function () {
//     return view('auth._register');
// });

Auth::routes();
Route::match(['get', 'post'], '/register', function () {
    return redirect('/login');
})->name('register');


Route::get('/home', 'HomeController@index')->name('home');
