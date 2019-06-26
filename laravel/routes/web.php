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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/home', 'HomeController@store');

Route::get('p', function () {
    $pokedex = DB::table('pokedexes')->paginate(10);
    return view('p', ['Pokedex' => $pokedex]);
});

Route::get('/p/capture', 'pController@capture');

Route::get('/p/select', 'pController@select');

Route::get('/p/capture/view', 'pCaptureController@index');

Route::get('/p/capture/capture', 'pCaptureController@capture');
