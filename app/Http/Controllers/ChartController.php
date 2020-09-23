<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master_fakultas;
use App\Models\Alumni;
use DB;
use Response;

class ChartController extends Controller
{
    public function jumlah_alumni(Request $request){
		if($request->ajax()){
            $data = Master_fakultas::select('master_fakultas.nama','master_fakultas.urutan',DB::raw('count(alumnis.npm) as jumlah_alumni'),DB::raw("COUNT(IF(status = 'Sudah Mengisi', 1, NULL)) as jumlah_mengisi,"))
                ->rightjoin('alumnis', 'master_fakultas.kode', '=', 'alumnis.fak')
                ->rightjoin('distribusi_alumnis', 'distribusi_alumnis.npm_alumni', '=', 'alumnis.npm')
			    ->orderBy('kode')
				->groupBy('urutan')
                ->get();
            $label = array('January', 'February', 'March', 'April', 'May', 'June', 'July');
            $response = array(
                'label' => $label,
                'status' => 'Sukses',
                'tabel' => $data
			);	
		}
		return Response::json( $response );
	}
}
