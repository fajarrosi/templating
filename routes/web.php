<?php

use Illuminate\Support\Facades\Route;

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
    return view('table');
});

Route::get('/data-tables', function () {
    return view('datatable');
});

Route::post('pertanyaan/update', 'PertanyaanController@update')->name('prt.update');
Route::get('pertanyaan/destroy/{id}', 'PertanyaanController@destroy');
Route::resource('/pertanyaan','PertanyaanController');

Route::post('jawaban/update', 'JawabanController@update')->name('jwb.update');
Route::get('jawaban/destroy/{id}', 'JawabanController@destroy');
Route::resource('/jawaban','JawabanController');