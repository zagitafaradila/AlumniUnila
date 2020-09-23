<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Master_fakultas;
use App\Models\Master_jurusan;
use App\Models\Master_prodi;
use Illuminate\Support\Facades\Hash;
use Response;
use DataTables;

class UserController extends Controller
{

	public function __construct(){
        $this->middleware('auth');
	}
	
    public function user_manager(){			
		$list_fakultas = Master_fakultas::where('kode','!=','0')->orderBy('urutan')->get();
		
		$data = array (
			'list_fakultas' => $list_fakultas,
		);
						
		return \View::make('admin.user_manager')->with($data);
	}

	public function getUser(Request $request){
		if($request->ajax()){
			$data = User::select('id','Users.fak','Users.jur','Users.prodi','Master_fakultas.nama as nama_fak','Master_jurusans.nama as nama_jur','Master_prodis.nama as nama_prodi','access')
				->join('Master_fakultas','Users.fak','=','Master_fakultas.kode')
				->join('Master_jurusans','Users.jur','=','Master_jurusans.kode')
				->join('Master_prodis','Users.prodi','=','Master_prodis.kode')
				->where('access','!=','Surveyor')
				->where('access','!=','Alumni')
				->get();
			return DataTables::of($data)
				->editColumn('nama_fak', function($data){
					if($data->nama_fak == 'Pilih Fakultas'){
						return 'Semua Fakultas';
					}else{ return $data->nama_fak; }
				})
				->editColumn('nama_jur', function($data){
					if($data->nama_jur == 'Pilih Jurusan'){
						return 'Semua Jurusan';
					}else{ return $data->nama_jur; }
				})
				->editColumn('nama_prodi', function($data){
					if($data->nama_prodi == 'Pilih Prodi'){
						return 'Semua Prodi';
					}else{ return $data->nama_prodi; }
				})
				->addColumn('action', function($data){
					return '<button type="button" class="btn btn-outline-primary btn-xs" id="edit" title="Edit">
							<i class="fas fa-edit"></i>
						</button>
							<span> </span>
						<button type="button" class="btn btn-outline-danger btn-xs" id="remove" title="Remove">
							<i class="fas fa-trash"></i>
						</button>';
				})
				->rawColumns(['action'])
				->make(true);
		}
		return view( 'admin.user_manager' );
	}
	
	public function save(Request $request){
		$id = $_POST['id'];
		$idlama = $_POST['idlama'];
		
	   	if($request->ajax()){
		   	if($idlama==''){		
				$duplicate = User::where('id',$id)->first();
				if ($duplicate){
				   	$response = array(
						'status' => 'duplicate'
					);
			   	}else{
					//  INSERT NEW  
					$usr = new User();
					$usr->id = $_POST['id'];
					$usr->password = Hash::make($_POST['password']);
					$usr->fak = $_POST['fak'];
					$usr->jur = $_POST['jur'];
					$usr->prodi = $_POST['prodi'];
					$usr->access = $_POST['access'];
					$usr->save();
					$response = array(
						'status' => 'success'
					);
			   	}
		   	}else{
			   	$duplicate = null;
			   	if($idlama!==$id){
				   	$duplicate = User::where('id',$id)->first();
					if ($duplicate){
						$response = array(
							'status' => 'duplicate'
						);
					}else{
						$usr = User::where('id',$id)->first();
						$usr->id = $_POST['id'];
						if($_POST['password']!=="********"){
							$usr->password = Hash::make($_POST['password']);
						}							
						$usr->fak = $_POST['fak'];
						$usr->jur = $_POST['jur'];
						$usr->prodi = $_POST['prodi'];
						$usr->access = $_POST['access'];
						$usr->save();
						$response = array(
							'status' => 'update'
						);		
					}
			   	}
			   	else{
					$usr = User::where('id',$id)->first();
				   	if($_POST['password']!=="********"){
						$usr->password = Hash::make($_POST['password']);
					}							
					$usr->fak = $_POST['fak'];
					$usr->jur = $_POST['jur'];
					$usr->prodi = $_POST['prodi'];
					$usr->access = $_POST['access'];
					$usr->save();
					$response = array(
						'status' => 'update'
					);		
				} 								
			}
			return Response::json( $response );
		}			
	}
	
	public function comboFakultas(Request $request){		
		if($request->ajax())
		{	
			if(Auth::user()->fak !='0'){
				$fakultas = Master_fakultas::where('kode',Auth::user()->fak)->first();
				$data = '<option value="'.$fakultas->kode.'">'.$fakultas->nama.'</option>';
			}else{
				$data = '<option value="0">Semua Fakultas</option>';
				$fakultas = Master_fakultas::where('active','1')->where('kode','!=','0')->orderBy('urutan')->get();
				foreach ($fakultas as $r){
					$data .= '<option value="'.$r->kode.'">'.$r->nama.'</option>';
				}
			}			
			$response = array(
				'option' => $data
			);	
			return Response::json( $response );
		}	
	}
	public function comboJurusan(Request $request){
		if($request->ajax())
		{
			$fak = $_GET['fak'];
			if(Auth::user()->jur !='0'){
				$Jurusan = Master_jurusan::where('kode',Auth::user()->jur)->orderBy('urutan')->first();
				$data = '<option value="'.$Jurusan->kode.'">'.$Jurusan->nama.'</option>';				
			}else{
				$data = '<option value="0">Semua Jurusan</option>';
				$Jurusan = Master_jurusan::where('fak', $fak)->where('active','1')->where('kode','!=','0')->orderBy('urutan')->get();
				foreach ($Jurusan as $r){
					$data .= '<option value="'.$r->kode.'">'.$r->nama.'</option>';
				}
			}			
			$response = array(
				'option' => $data
			);	
			return Response::json( $response );
		}	
	}
	public function comboProdi(Request $request){
		if($request->ajax())
		{
			$jur = $_GET['jur'];
			if(Auth::user()->prodi !='0'){
				$Prodi = Master_prodi::where('kode',Auth::user()->prodi)->orderBy('urutan')->first();
				$data = '<option value="'.$Prodi->kode.'">'.$Prodi->nama.'</option>';				
			}else{
				$data = '<option value="0">Semua Program Studi</option>';
				$Prodi = Master_Prodi::where('jur', $jur)->where('active','1')->where('kode','!=','0')->orderBy('urutan')->get();
				foreach ($Prodi as $r){
					$data .= '<option value="'.$r->kode.'">'.$r->nama.'</option>';
				}
			}			
			$response = array(
				'option' => $data
			);	
			return Response::json( $response );
		}	
	}  

	public function hapusData(Request $request){
		$id = $_POST['id'];

		if($request->ajax()){
			$tabel = User::where('id',$id)->first();
			$tabel->delete();

			if($tabel){
				$response = array(
					'status' => 'success'
				);	
			}else{				
				$response = array(
					'status' => 'duplicate'
				);	
			}
			return Response::json( $response );
		}
	}
}
