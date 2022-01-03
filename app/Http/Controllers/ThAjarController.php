<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Kelas;
use App\Siswa;
use App\Kh;
use App\ThAjar;

class ThAjarController extends Controller
{
    public function index()
    {
        $data['th_ajar'] = ThAjar::all();
        return view('/admin/th_ajar/index', $data);
    }

    function actionthajar(Request $request)
    {
        if($request->ajax())
        {
            if($request->action == 'edit')
            {
                $data = array(
                    'th_ajar'	=>  $request->th_ajar,
                    'smt'      	=>  $request->smt
                );
                DB::table('th_ajar')
                    ->where('ta_id', $request->ta_id)
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

    public function insert()
    {
        return view('/admin/th_ajar/insert');
    }

    public function store(Request $request)
    {
      $th_ajar = new th_ajar;
      dd($request->th_ajar);
      // $th_ajar->th_ajar	= $request->th_ajar;
      // $th_ajar->smt   	= $request->smt;

      // if ($th_ajar->save()){
      //   return redirect('/admin/th_ajar');
      // }
      // else{
      //   return redirect('/admin/tambah/th_ajar');
      // }
    }
}
