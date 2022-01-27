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
	Route::get('/import/kelas', 'KelasController@import')->name('import.kelas'); 
	Route::post('/importExcel', 'KelasController@importExcel');
	// Route Siswa
	Route::get('/{id}/siswa', 'SiswaController@index')->name('siswa');
	Route::post('/siswa/action', 'SiswaController@action')->name('action.siswa');
	Route::get('/tambah/{id}/siswa', 'SiswaController@insert')->name('insert.siswa');
	Route::post('/store/{id}/siswa', 'SiswaController@store')->name('store.siswa');
	Route::get('/import/{id}/siswa', 'SiswaController@import')->name('import.siswa'); 
	Route::post('/siswa/importExcel', 'SiswaController@importExcel');
	//Route kh
	Route::get('/jenis_kh', 'KhController@index')->name('kh');
	Route::post('/jenis_kh/action', 'KhController@actionkh')->name('action.kh');
	Route::get('/tambah/jenis_kh', 'KhController@insert')->name('insert.kh');
	Route::post('/store/jenis_kh', 'KhController@store')->name('store.kh');
	// Route Tahun Ajar
	Route::get('/th_ajar', 'ThAjarController@index')->name('th_ajar');
	Route::get('/tambah/th_ajar', 'ThAjarController@insert')->name('insert.th_ajar');
	Route::post('/store/th_ajar', 'ThAjarController@store')->name('store.th_ajar');
	Route::get('/edit/th_ajar/{id}', 'ThAjarController@edit')->name('edit.th_ajar');
	Route::post('/update/th_ajar/{id}','ThAjarController@update')->name('update.th_ajar');
	Route::get('/delete/th_ajar/{id}', 'ThAjarController@delete')->name('delete.th_ajar');
	// Route Penguji KH 
	Route::get('/uji/{id}/{nama}', 'UjiKhController@index')->name('ujikh');
	Route::get('/edit/penguji/{id}', 'UjiKhController@edit')->name('edit.ujikh');
	Route::post('/update/penguji/{id}','UjiKhController@update')->name('update.ujikh');
	// Route Rekap KH
	Route::get('/rekap/{id}', 'RekapKhController@index')->name('rekap');
	Route::post('/rekap/action', 'RekapKhController@actionrekap')->name('action.rekap');
});

Route::group(['prefix' => 'guru',  'middleware' => 'is_user'], function(){
	// Route dashboard 
	Route::get('/home', 'GuruController@index')->name('guruhome');
	// Route profil guru
	Route::get('/profil/{id}', 'GuruController@edit')->name('profil.guru');
	Route::post('/update{id}','GuruController@update')->name('update.guru');
	// Route Kelas yang diuji KH
	Route::get('/kh', 'GuruController@kh')->name('kh.guru');
	// Route Rekap KH
	Route::get('/rekap/{id}', 'GuruController@rekap')->name('rekap.guru');
	Route::post('/rekap/action', 'GuruController@action')->name('guru.rekap');
});