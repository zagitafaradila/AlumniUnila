<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DataTables;
use Response;
use App\Models\Alumni_academic;

class RiwayatPendidikanController extends Controller
{
    public function index()
	{	
		return \View::make('alumni.riwayat_pendidikan');
    }
    
    public function getData(Request $request){
		if($request->ajax()){
			$data = Alumni_academic::select('id','jenjang','school','tahun')->where('npm',Auth::user()->id)->orderBy('tahun')
				->get();
			return DataTables::of($data)
				->addColumn('action', function($data){
					return '<button type="button" class="btn btn-outline-primary btn-xs" id="edit" title="Edit">
							<i class="fas fa-edit"></i>
						</button>
							<span> </span>
						<button type="button" class="btn btn-outline-danger btn-xs" id="remove" title="Remove">
							<i class="fas fa-trash"></i>
						</button>';
				})
				->rawColumns(['pilih','action'])
				->make(true);
		}
		return view( 'admin.master_alumni' );
	}
	
	public function save(Request $request){
		$menu = Auth::user()->access;
		if($menu == "Alumni"){
			$npm = Auth::user()->id;
		}else{
			$npm = 'xxx';
		}

		$id = $_POST['id'];
		$jenjang = $_POST['jenjang'];

		if($request->ajax()){
			if($id==''){
				/*******  INSERT NEW  *****/
				$Pendidikan = new Alumni_academic();
				$Pendidikan->npm = $npm;
				$Pendidikan->jenjang = $_POST['jenjang'];
				$Pendidikan->school = $_POST['school'];
				$Pendidikan->tahun = $_POST['tahun'];
				$Pendidikan->save();
				$response = array(
					'status' => 'success'
				);
			}else{
				$Pendidikan = Alumni_academic::where('id',$id)->first();
				$Pendidikan->jenjang = $_POST['jenjang'];
				$Pendidikan->school = $_POST['school'];
				$Pendidikan->tahun = $_POST['tahun'];
				$Pendidikan->save();
				$response = array(
					'status' => 'update'
				);
			}
		}

		return Response::json( $response );
	}
	public function remove(Request $request){
		$id = $_POST['id'];

		if($request->ajax()){
			$Questions = Alumni_academic::where('id',$id)->first();
			$Questions->delete();

			$response = array(
				'status' => 'success'
			);	

			return Response::json( $response );
		}
	}
}
