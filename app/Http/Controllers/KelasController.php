<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Kelas;

class KelasController extends Controller
{
    public function index(){
        $data['no'] = 1;
        $kelas = DB::table('kelas')
        	->join('users', 'users.id', '=', 'kelas.id')
        	->get();
        $data['kelas'] = $kelas;
        return view('/admin/kelas/index',$data);
    }

    public function insert()
    {
    	$guru = DB::table('users')
    		->where('role',"guru")->get();
    	$data['guru'] = $guru;
        return view('/admin/kelas/insert', $data);
    }

    public function store(Request $request)
    {
      $kelas = new kelas;
      $kelas->id     		= $request->id;
      $kelas->nama_kelas    = $request->nama_kelas;

      if ($kelas->save()){
        return redirect('/admin/kelas');
      }
      else{
        return redirect('/admin/kelas/insert');
      }
    }

    public function edit($id)
    {
        // mengambil data users berdasarkan id yang dipilih
        $kelas = DB::table('kelas')
        	->join('users', 'users.id', '=', 'kelas.id')
        	->where('kelas.k_id',$id)
        	->get();
        $data['kelas'] = $kelas;
        // passing data admin yang didapat ke view edit_profil.blade.php
        return view('/admin/kelas/edit')->with('kelas', $kelas);
        // return view('/admin/edit_karakteristik')->with('karakteristik', $karakteristik);
		// return redirect()->route('edit.kelas', $id);
    }

    public function update(Request $request, $id){
        DB::table('users')->where('id',$request->id)->update([
            'nama' => $request->nama,
            'email' => $request->email
        ]);           
      	return redirect()->route('adminhome');
    }

    public function delete($k_id){
        $kelas = Kelas::findOrFail($k_id)->delete();
        return redirect()->route('kelas');
    }
}
