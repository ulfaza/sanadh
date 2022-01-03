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
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin',  'middleware' => 'is_admin'], function(){
	// Route dashboard 
	Route::get('/home', 'AdminController@index')->name('adminhome');
	// Route profil 
	Route::get('/profil/{id}', 'AdminController@edit')->name('profil.admin');
	Route::post('/update{id}','AdminController@update')->name('update.admin');
	// Route kelas
	Route::get('/kelas', 'KelasController@index')->name('kelas');
	Route::get('/tambahkelas', 'KelasController@insert')->name('insert.kelas');
	Route::post('/store/kelas', 'KelasController@store')->name('store.kelas');
	Route::get('/edit/kelas/{id}', 'KelasController@edit')->name('edit.kelas');
	Route::post('/update/kelas/{id}','KelasController@update')->name('update.kelas');
	Route::get('/delete/kelas/{id}', 'KelasController@delete')->name('delete.kelas');
	// Route Siswa
	Route::get('{id}/siswa', 'SiswaController@index')->name('siswa');
	//Route kh
	Route::get('/jenis_kh', 'KhController@index')->name('kh');
	Route::post('/jenis_kh/action', 'KhController@actionkh')->name('action.kh');
	Route::get('/tambah/jenis_kh', 'KhController@insert')->name('insert.kh');
	Route::post('/store/jenis_kh', 'KhController@store')->name('store.kh');
	// Route Tahun Ajar
	Route::get('/th_ajar', 'ThAjarController@index')->name('th_ajar');
	Route::post('/th_ajar/action', 'ThAjarController@actionthajar')->name('action.thajar');
	Route::get('/tambah/th_ajar', 'ThAjarController@insert')->name('insert.th_ajar');
	Route::post('/store/th_ajar', 'ThAjarController@store')->name('store.th_ajar');
});