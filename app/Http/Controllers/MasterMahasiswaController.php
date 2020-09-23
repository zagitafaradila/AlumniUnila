<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distribusi_alumni;
use App\Models\Master_fakultas;
use App\Models\Master_jurusan;
use App\Models\Master_prodi;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Auth;
use Response;

class MasterMahasiswaController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
	}
	
    public function index(){			
		$list_fakultas = Master_fakultas::where('kode','!=','0')->orderBy('urutan')->get();
		
		$data = array (
			'list_fakultas' => $list_fakultas,
		);
				
		
		return \View::make('admin.master_mahasiswa')->with($data);
    }
    
    public function getMahasiswa(Request $request){
		if($request->ajax()){
			$data = Mahasiswa::select('npm','Mahasiswas.name','Mahasiswas.fak','Mahasiswas.jur','Mahasiswas.prodi','Master_jurusans.nama as nama_jur','Master_prodis.nama as nama_prodi','angkatan','telp','birthday')
				->join('Master_fakultas','Mahasiswas.fak','=','Master_fakultas.kode')
				->join('Master_jurusans','Mahasiswas.jur','=','Master_jurusans.kode')
                ->join('Master_prodis','Mahasiswas.prodi','=','Master_prodis.kode')
                ->where('Mahasiswas.fak','LIKE',$_GET['fak'])
                ->where('Mahasiswas.jur','LIKE',$_GET['jur'])
                ->where('Mahasiswas.prodi','LIKE',$_GET['prodi'])
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
		return view( 'admin.master_mahasiswa' );
    }

    public function comboJurusan(Request $request){
		if($request->ajax())
		{
			$fak = $_GET['fak'];
			if(Auth::user()->jur !='0'){
				$Jurusan = Master_jurusan::where('kode',Auth::user()->jur)->orderBy('urutan')->first();
				$data = '<option value="'.$Jurusan->kode.'">'.$Jurusan->nama.'</option>';				
			}else{
				$data = '<option value="%">Semua Jurusan</option>';
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
				$data = '<option value="%">Semua Program Studi</option>';
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

	public function comboJurusanModal(Request $request){
		if($request->ajax())
		{
			$fak = $_GET['fak'];
			if(Auth::user()->jur !='0'){
				$Jurusan = Master_jurusan::where('kode',Auth::user()->jur)->orderBy('urutan')->first();
				$data = '<option value="'.$Jurusan->kode.'">'.$Jurusan->nama.'</option>';				
			}else{
				$data = '<option value="0">Pilih Jurusan</option>';
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
	public function comboProdiModal(Request $request){
		if($request->ajax())
		{
			$jur = $_GET['jur'];
			if(Auth::user()->prodi !='0'){
				$Prodi = Master_prodi::where('kode',Auth::user()->prodi)->orderBy('urutan')->first();
				$data = '<option value="'.$Prodi->kode.'">'.$Prodi->nama.'</option>';				
			}else{
				$data = '<option value="0">Pilih Program Studi</option>';
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

	public function save(Request $request){
		$npm = $_POST['npm'];
		$npmLama = $_POST['npmLama'];
		
	   	if($request->ajax()){
		   	if($npmLama==''){		
				$duplicate1 = Mahasiswa::where('npm',$npm)->first();
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
					$usr->access = "Surveyor";
					$usr->save();

					$mhs = new Mahasiswa();
					$mhs->npm = $_POST['npm'];
					$mhs->name = $_POST['nama'];
					$mhs->birthday = date('Y-m-d',strtotime($_POST['birthday']));
					$mhs->fak = $_POST['fak'];
					$mhs->jur = $_POST['jur'];
					$mhs->prodi = $_POST['prodi'];
					$mhs->telp = $_POST['telp'];
					$mhs->angkatan = $_POST['angkatan'];
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
					$duplicate1 = Mahasiswa::where('npm',$npm)->first();
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

						$mhs = Mahasiswa::where('npm',$npmLama)->first();
						$mhs->npm = $_POST['npm'];
						$mhs->name = $_POST['nama'];
						$mhs->birthday = date('Y-m-d',strtotime($_POST['birthday']));
						$mhs->fak = $_POST['fak'];
						$mhs->jur = $_POST['jur'];
						$mhs->prodi = $_POST['prodi'];
						$mhs->telp = $_POST['telp'];
						$mhs->angkatan = $_POST['angkatan'];
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

					$mhs = Mahasiswa::where('npm',$npmLama)->first();
					$mhs->name = $_POST['nama'];
					$mhs->birthday = date('Y-m-d',strtotime($_POST['birthday']));
					$mhs->fak = $_POST['fak'];
					$mhs->jur = $_POST['jur'];
					$mhs->prodi = $_POST['prodi'];
					$mhs->telp = $_POST['telp'];
					$mhs->angkatan = $_POST['angkatan'];
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
			$used = Distribusi_alumni::where('npm_surveyor', $npm)->first();
			if($used){
				$response = array(
					'status' => 'duplicate'
				);
			}else{
				$tabel1 = User::where('id',$npm)->first();
				$tabel1->delete();
				$tabel2 = Mahasiswa::where('npm',$npm)->first();
				$tabel2->delete();

				if($tabel1 && $tabel2){
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
	public function hapusDataSelect(Request $request)
	{
		$table = $_POST['id'];
		$table = stripcslashes($table);
		$tableData = json_decode($table);

		if($request->ajax()){
			foreach($tableData as $r){
				$used = Distribusi_alumni::where('npm_surveyor', $r)->first();			
				if($used){
					$response = array(
						'status' => 'duplicate'
					);	
				}else{				
					$mahasiswa = Mahasiswa::where('npm',$r)->first();
					$mahasiswa->delete();				
					$mahasiswa = User::where('id',$r)->first();
					$mahasiswa->delete();

					$response = array(
						'status' => 'success'
					);	
				}
			}
			return Response::json( $response );
		}
	}
}
