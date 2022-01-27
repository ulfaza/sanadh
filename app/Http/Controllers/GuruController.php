<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Kelas;
use App\Siswa;
use App\Kh;
use App\ThAjar;
use App\UjiKh;
use App\RekapKh;

class GuruController extends Controller
{
    public function index(){
    	return view('guru/home');
    }

    public function edit($id)
    {
        // mengambil data users berdasarkan id yang dipilih
        $users = DB::table('users')->where('id',$id)->get();
        // passing data admin yang didapat ke view edit_profil.blade.php
        return view('/guru/edit_profil',['users' => $users]);
    }

    public function update(Request $request, $id){
        DB::table('users')->where('id',$request->id)->update([
            'nama' => $request->nama
        ]);           
      	return redirect()->route('guruhome');
    }

    public function kh(){
        $ujikh = DB::table('uji_kh')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'uji_kh.k_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->where('uji_kh.penguji', Auth::user()->nama)
            ->where('m_th_ajar.status', "AKTIF")
            ->get();
        $data['ujikh'] = $ujikh;
        return view('guru/kh/index', $data);
    }

    public function rekap($uji_id)
    {
        $kh = DB::table('m_kh')
            ->join('uji_kh', 'uji_kh.kh_id', '=', 'm_kh.kh_id')
            ->where('uji_kh.uji_id',$uji_id)
            ->get();

        $rekapkh = DB::table('rekap_kh')
            ->join('m_siswa', 'm_siswa.s_id', '=', 'rekap_kh.s_id')
            ->where('rekap_kh.uji_id',$uji_id)
            ->get();

        $ujikh = DB::table('uji_kh')
            ->join('m_kelas', 'm_kelas.k_id', '=', 'uji_kh.k_id')
            ->join('m_th_ajar', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
            ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
            ->where('uji_kh.uji_id',$uji_id)
            ->get();

        $data['ujikh'] = $ujikh;
        $data['kh'] = $kh;
        $data['rekapkh'] = $rekapkh;
        return view('/guru/rekapkh/index', $data);
    }

    function action(Request $request)
    {
        if($request->ajax())
        {
            if($request->action == 'edit')
            {
                $data = array(
                    'nilai_a1'  =>  $request->nilai_a1,
                    'nilai_a2'  =>  $request->nilai_a2,
                    'nilai_a3'  =>  $request->nilai_a3,
                    'nilai_a4'  =>  $request->nilai_a4,
                    'total'     =>  $request->nilai_a1 + $request->nilai_a2 + $request->nilai_a3 + $request->nilai_a4
                );
                DB::table('rekap_kh')
                    ->where('r_id', $request->r_id)
                    ->update($data);
            }
            if($request->action == 'delete')
            {
                DB::table('th_ajar')
                    ->where('ta_id', $request->ta_id)
                    ->delete();
            }
            return response()->json($request);
        }
    }
}
