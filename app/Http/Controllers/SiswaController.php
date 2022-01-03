<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Kelas;
use App\Siswa;

class SiswaController extends Controller
{
    public function index($id){
    	$data['no'] = 1;
        $siswa = DB::table('siswa')
        	->join('kelas', 'kelas.k_id', '=', 'siswa.k_id')
        	->where('siswa.k_id',$id)
        	->get();
        $data['siswa'] = $siswa;  
        return view('/admin/siswa/index',$data);
    }
}
