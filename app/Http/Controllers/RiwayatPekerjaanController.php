<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Response;
use DataTables;
use App\Models\Alumni;
use App\Models\Alumni_work;
use App\Models\Login_perusahaan;

class RiwayatPekerjaanController extends Controller
{
    public function index()
	{	
		return \View::make('alumni.riwayat_pekerjaan');
    }

    public function getData(Request $request){
		if($request->ajax()){
			$data = Alumni_work::where('npm',Auth::user()->id)->orderBy('tahun')
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

		if($request->ajax()){
			if($id==''){
				/*******  INSERT NEW  *****/
				$pekerjaan = new Alumni_work();
				$pekerjaan->npm = $npm;
				$pekerjaan->tahun =$_POST['tahun'];
				$pekerjaan->perusahaan =$_POST['perusahaan'];
				$pekerjaan->posisi =$_POST['posisi'];
				$pekerjaan->nama_atasan =$_POST['nama'];
				$pekerjaan->telp_atasan =$_POST['telp'];
				$pekerjaan->email_atasan =$_POST['email'];
				$pekerjaan->save();
				$id_perusahaan = $pekerjaan->id;
				$response = array(
					'status' => 'success'
				);
			}else{
				$pekerjaan = Alumni_work::where('id', $id)->first();
											
				$pekerjaan->tahun = $_POST['tahun'];
				$pekerjaan->perusahaan = $_POST['perusahaan'];
				$pekerjaan->posisi = $_POST['posisi'];
				$pekerjaan->nama_atasan = $_POST['nama'];
				$pekerjaan->telp_atasan = $_POST['telp'];
				$pekerjaan->email_atasan = $_POST['email'];
				$pekerjaan->save();
				$id_perusahaan = $id;
				$response = array(
					'status' => 'update'
				);	
			}

			if($_POST['email']!=='' && $_POST['email']!==$_POST['emailold']){
				$uniqueid =  uniqid();
				$login = new Login_perusahaan();
				$login->key_valid =  $uniqueid;
				$login->id_perusahaan =  $id_perusahaan;
				$login->npm =  $npm;
				$login->save();		
			
				$alumni = Alumni::select('name')->where('npm',$npm)->first();
			
				$data = array(
					'kepada' => $_POST['nama'],
					'id' => $uniqueid,
					'alumni' => $alumni->name,
					'tahun' => $_POST['tahun'],
					'posisi' => $_POST['posisi']
				);
			
				/*
				Mail::send('alumni.mail', $data, function($message) {
						$message->to($_POST['email'], $_POST['nama'])->subject('Permohonan Partisipasi Pengisian Kuesioner Alumni Universitas Lampung');
				});
				*/			
			}
		}
		return Response::json( $response );
	}
	public function remove(Request $request){
		$id = $_POST['id'];

		if($request->ajax()){
			$Questions = Alumni_work::where('id',$id)->first();
			$Questions->delete();

			$response = array(
				'status' => 'success'
			);	

			return Response::json( $response );
		}
	}
}
