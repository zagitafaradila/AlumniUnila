<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distribusi_alumni;
use App\Models\Master_fakultas;
use App\Models\Master_jurusan;
use App\Models\Master_prodi;
use App\Models\Alumni;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Auth;
use Response;

class MasterAlumniController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
	}
	
    public function index(){			
		$list_fakultas = Master_fakultas::where('kode','!=','0')->orderBy('urutan')->get();
		
		$data = array (
			'list_fakultas' => $list_fakultas,
		);				
		
		return \View::make('admin.master_alumni')->with($data);
    }

    public function getAlumni(Request $request){
		if($request->ajax()){
			$data = Alumni::select('npm','Alumnis.name','Alumnis.fak','Alumnis.jur','Alumnis.prodi','Master_jurusans.nama as nama_jur','Master_prodis.nama as nama_prodi','wisuda','telp','birthday')
				->join('Master_fakultas','Alumnis.fak','=','Master_fakultas.kode')
				->join('Master_jurusans','Alumnis.jur','=','Master_jurusans.kode')
                ->join('Master_prodis','Alumnis.prodi','=','Master_prodis.kode')
                ->where('Alumnis.fak','LIKE',$_GET['fak'])
                ->where('Alumnis.jur','LIKE',$_GET['jur'])
                ->where('Alumnis.prodi','LIKE',$_GET['prodi'])
				->get();
			return DataTables::of($data)
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
				->rawColumns(['pilih','action'])
				->make(true);
		}
		return view( 'admin.master_alumni' );
    }

    public function save(Request $request){
		$npm = $_POST['npm'];
		$npmLama = $_POST['npmLama'];
		
	   	if($request->ajax()){
		   	if($npmLama==''){		
				$duplicate1 = Alumni::where('npm',$npm)->first();
				$duplicate2 = User::where('id',$npm)->first();
				if ($duplicate1 || $duplicate2){
				   	$response = array(
						'status' => 'duplicate'
					);
			   	}else{
					//  INSERT NEW  
					$usr = new User();
					$usr->id = $_POST['npm'];
					$usr->password = Hash::make($_POST['npm']);
					$usr->fak = $_POST['fak'];
					$usr->jur = $_POST['jur'];
					$usr->prodi = $_POST['prodi'];
					$usr->access = "Alumni";
					$usr->save();

					$mhs = new Alumni();
					$mhs->npm = $_POST['npm'];
					$mhs->name = $_POST['nama'];
					$mhs->birthday = date('Y-m-d',strtotime($_POST['birthday']));
					$mhs->fak = $_POST['fak'];
					$mhs->jur = $_POST['jur'];
					$mhs->prodi = $_POST['prodi'];
					$mhs->telp = $_POST['telp'];
					$mhs->wisuda = date('Y-m-d',strtotime($_POST['wisuda']));
					$mhs->registered = '1';
					$mhs->active = '1';
					$mhs->save();
					
					$response = array(
						'status' => 'success'
					);
			   	}
		   	}else{
			   	$duplicate = null;
			   	if($npmLama!=$npm){
					$duplicate1 = Alumni::where('npm',$npm)->first();
					$duplicate2 = User::where('id',$npm)->first();
					if ($duplicate1 || $duplicate2){
						   $response = array(
							'status' => 'duplicate'
						);
					}else{
						$usr = User::where('id',$npmLama)->first();
						$usr->id = $_POST['npm'];
						$usr->fak = $_POST['fak'];
						$usr->jur = $_POST['jur'];
						$usr->prodi = $_POST['prodi'];
						$usr->save();

						$mhs = Alumni::where('npm',$npmLama)->first();
						$mhs->npm = $_POST['npm'];
						$mhs->name = $_POST['nama'];
						$mhs->birthday = date('Y-m-d',strtotime($_POST['birthday']));
						$mhs->fak = $_POST['fak'];
						$mhs->jur = $_POST['jur'];
						$mhs->prodi = $_POST['prodi'];
						$mhs->telp = $_POST['telp'];
						$mhs->wisuda = date('Y-m-d',strtotime($_POST['wisuda']));
						$mhs->save();

						$response = array(
							'status' => 'update'
						);		
					}
			   	}
			   	else{
					$usr = User::where('id',$npmLama)->first();
					$usr->fak = $_POST['fak'];
					$usr->jur = $_POST['jur'];
					$usr->prodi = $_POST['prodi'];
					$usr->save();

					$mhs = Alumni::where('npm',$npmLama)->first();
					$mhs->name = $_POST['nama'];
					$mhs->birthday = date('Y-m-d',strtotime($_POST['birthday']));
					$mhs->fak = $_POST['fak'];
					$mhs->jur = $_POST['jur'];
					$mhs->prodi = $_POST['prodi'];
					$mhs->telp = $_POST['telp'];
					$mhs->wisuda = date('Y-m-d',strtotime($_POST['wisuda']));
					$mhs->save();

					$response = array(
						'status' => 'update'
					);		
				} 								
			}
			return Response::json( $response );
		}			
	}

	public function hapusData(Request $request){
		$npm = $_POST['npm'];

		if($request->ajax()){
			$used = Distribusi_alumni::where('npm_alumni', $npm)->first();
			if($used){
				if($used['status'] != "Belum Mengisi"){
					$alumni2 = false;
				}else{
					$alumni2 = Distribusi_alumni::where('npm_alumni',$npm)->first();
					$alumni2->delete();
				}				
			}else{
				$alumni2 = true;
			}
			$alumni = User::where('id',$npm)->first();
			$alumni->delete();
			$alumni = Alumni::where('npm',$npm)->first();
			$alumni->delete();	

			if($alumni && $alumni2){
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
	public function hapusDataSelect(Request $request)
	{
		$table = $_POST['id'];
		$table = stripcslashes($table);
		$tableData = json_decode($table);

		if($request->ajax()){
			foreach($tableData as $r){
				$used = Distribusi_alumni::where('npm_alumni', $r)->first();
				if($used){
					if($used['status'] != "Belum Mengisi"){
						$alumni2 = false;
					}else{
						$alumni2 = Distribusi_alumni::where('npm_alumni',$r)->first();
						$alumni2->delete();
					}				
				}else{
					$alumni2 = true;
				}
				$alumni = User::where('id',$r)->first();
				$alumni->delete();
				$alumni = Alumni::where('npm',$r)->first();
				$alumni->delete();	

				if($alumni && $alumni2){
					$response = array(
						'status' => 'success'
					);	
				}else{				
					$response = array(
						'status' => 'duplicate'
					);	
				}
			}
			return Response::json( $response );
		}
	}
}
