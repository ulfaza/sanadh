<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Kelas;
use App\Siswa;
use App\Kh;
use App\ThAjar;
use App\UjiKh;

class ThAjarController extends Controller
{
    public function index()
    {
      $data['no'] = 1;
      $data['th_ajar'] = ThAjar::all();
      
      $uji = DB::table('m_th_ajar')
          ->join('uji_kh', 'm_th_ajar.ta_id', '=', 'uji_kh.ta_id')
          ->join('m_kh', 'm_kh.kh_id', '=', 'uji_kh.kh_id')
          ->select('m_th_ajar.smt', 'm_th_ajar.th_ajaran', 'm_kh.kh_nama')
          ->distinct('m_th_ajar.ta_id')
          ->get();
      
      $data['uji'] = $uji;
      return view('/admin/th_ajar/index', $data);
    }

    public function insert()
    {
        return view('/admin/th_ajar/insert');
    }

    public function store(Request $request)
    {
      $kh = DB::table('m_kh')->where('kh_nama', '!=', "Dzikrul Ghofilin")->get();
      $kelas = DB::table('m_kelas')->where('tingkat', '!=', 13)->get();
      
      $th_ajar = new ThAjar;
      $th_ajar->th_ajaran = $request->th_ajaran;
      $th_ajar->smt       = $request->smt;
      $th_ajar->status    = "NONAKTIF";
      $th_ajar->save();

      $th_ajar2 = DB::table('m_th_ajar')->where('th_ajaran',$request->th_ajaran)->where('smt',$request->smt)->get(); 

      foreach ($th_ajar2 as $ta) {
        $id_th_ajar = $ta->ta_id;
      }

      foreach ($kh as $khs) {
        foreach ($kelas as $k){
            DB::table('uji_kh')->insert([
              ['kh_id' => $khs->kh_id, 
               'penguji' => NULL,
               'k_id' => $k->k_id,
               'ta_id' => $id_th_ajar
              ],
            ]);
        }       
      }

      if ($request->smt == "GENAP") {
        $kh = DB::table('m_kh')->where('kh_nama', "Dzikrul Ghofilin")->get();
        $kelas = DB::table('m_kelas')->where('tingkat', 12)->get();

        foreach ($kh as $khs) {
          foreach ($kelas as $k){
              DB::table('uji_kh')->insert([
                ['kh_id' => $khs->kh_id, 
                 'penguji' => NULL,
                 'k_id' => $k->k_id,
                 'ta_id' => $id_th_ajar
                ],
              ]);
          }       
        }
      }

      $uji_kh = DB::table('uji_kh')->where('ta_id',$id_th_ajar)->get();
      $siswa = DB::table('m_siswa')->get();

      foreach ($uji_kh as $uk) {
        foreach ($siswa as $s){
          if ($uk->k_id == $s->k_id) {
            DB::table('rekap_kh')->insert([
              ['uji_id' => $uk->uji_id,
               's_id' => $s->s_id,
               'nilai_a1' => 0,
               'nilai_a2' => 0,
               'nilai_a3' => 0,
               'nilai_a4' => 0,
               'total' => 0,
               'kriteria' => NULL
              ],
            ]);
          }
        }       
      }
      
      return redirect('/admin/th_ajar');
    }

    public function edit($id)
    {
        // mengambil data users berdasarkan id yang dipilih
        $th_ajar = DB::table('m_th_ajar')
          ->where('ta_id',$id)
          ->get();
        $data['th_ajar'] = $th_ajar;
        // passing data admin yang didapat ke view edit_profil.blade.php
        return view('/admin/th_ajar/edit', $data);
    }

    public function update(Request $request, $ta_id){
        DB::table('m_th_ajar')->where('ta_id',$ta_id)->update([
            'th_ajaran' => $request->th_ajaran,
            'smt' => $request->smt,
            'status' => $request->status
        ]);           
        return redirect()->route('th_ajar');
    }

    public function delete($k_id){
        $kelas = Kelas::findOrFail($k_id)->delete();
        return redirect()->route('kelas');
    }
}
