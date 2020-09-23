<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Master_fakultas;
use App\Models\Master_jurusan;
use App\Models\Master_prodi;
use Response;
use DataTables;

class MasterDataController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function __construct()
    {
        $this->middleware('auth');
	}
	
    public function index(){	
		return \View::make('admin.master_data');
	}

	public function getFakultas(Request $request){
		if($request->ajax()){
			$data = Master_fakultas::where('kode','!=','0')->orderBy('urutan')->get();
			return DataTables::of($data)
				->editColumn('active', function($data){
					if($data->active =='1'){
						return '<i class="fas fa-check" style="color:#2ECC71;"></i>';
					}else{
						return '<i class="fas fa-minus" style="color:#EB4133;"></i>';
					}
				})
				->addColumn('action', function($data){
					return '<button type="button" class="btn btn-outline-primary btn-xs" id="editFak" title="Edit">
							<i class="fas fa-edit"></i>
						</button>
							<span> </span>
						<button type="button" class="btn btn-outline-danger btn-xs" id="removeFak" title="Remove">
							<i class="fas fa-trash"></i>
						</button>
						<span> </span>
						<button type="button" class="btn btn-outline-warning btn-xs" id="activeFak" title="Status">
							<i class="fas fa-sync-alt"></i>
						</button>';
				})
				->rawColumns(['active','action'])
				->make(true);
		}
		return view( 'admin.master_data' );
	}
	public function saveFakultas(Request $request){
		$id = $_POST['id'];
		
	   	if($request->ajax()){
		   	if($id==''){
			   	$duplicate = Master_fakultas::where('nama',$_POST['nama'])->first();
			   	if ($duplicate){
				   	$response = array(
						'status' => 'duplicate'
					);
			   	}else{
					/*******  INSERT NEW  *****/
					$fakultas = new Master_fakultas();
					$fakultas->nama = $_POST['nama'];
					$fakultas->urutan = $_POST['urut'];
					$fakultas->active = '1';
					$fakultas->save();
					$response = array(
						'status' => 'success'
					);
			   	}
		   	}else{
		   		$fakultas = Master_fakultas::where('kode',$id)->first();
				$fakultas->nama = $_POST['nama'];
				$fakultas->urutan = $_POST['urut'];
				$fakultas->save();
				$response = array(
					'status' => 'update'
				);		
		   	}
		   	return Response::json( $response );
	   	}			
	}
	public function activeFakultas(Request $request){
		$id = $_POST['kode'];

		if($request->ajax()){
			$fakultas = Master_fakultas::where('kode',$id)->first();
			if($fakultas->active=='1'){
				$fakultas->active = '0';
			}else{
				$fakultas->active = '1';
			}
			$fakultas->save();
			$response = array(
				'status' => 'success'
			);		
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
				$data = '<option value="0">Pilih Fakultas</option>';
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
	
	public function getJurusan(Request $request){
		if($request->ajax()){
			$data = Master_Jurusan::where('fak',$_GET['fak'])->where('kode','!=','0')->orderBy('urutan')->get();
			return DataTables::of($data)
				->editColumn('active', function($data){
					if($data->active =='1'){
						return '<i class="fas fa-check" style="color:#2ECC71;"></i>';
					}else{
						return '<i class="fas fa-minus" style="color:#EB4133;"></i>';
					}
				})
				->addColumn('action', function($data){
					return '<button type="button" class="btn btn-outline-primary btn-xs" id="editJur" title="Edit">
							<i class="fas fa-edit"></i>
						</button>
							<span> </span>
						<button type="button" class="btn btn-outline-danger btn-xs" id="removeJur" title="Remove">
							<i class="fas fa-trash"></i>
						</button>
						<span> </span>
						<button type="button" class="btn btn-outline-warning btn-xs" id="activeJur" title="Status">
							<i class="fas fa-sync-alt"></i>
						</button>';
				})
				->rawColumns(['active','action'])
				->make(true);
		}
		return view( 'admin.master_data' );
	}
	public function saveJurusan(Request $request){
		$id = $_POST['id'];
		
	   	if($request->ajax()){
		   	if($id==''){
			   	$duplicate = Master_jurusan::where('nama',$_POST['nama'])->first();
			   	if ($duplicate){
				   	$response = array(
						'status' => 'duplicate'
					);
			   	}else{
					/*******  INSERT NEW  *****/
					$jurusan = new Master_jurusan();
					$jurusan->nama = $_POST['nama'];					
					$jurusan->fak = $_POST['fak'];
					$jurusan->urutan = $_POST['urut'];
					$jurusan->active = '1';
					$jurusan->save();
					$response = array(
						'status' => 'success'
					);
			   	}
		   	}else{
		   		$jurusan = Master_jurusan::where('kode',$id)->first();
				$jurusan->nama = $_POST['nama'];				
				$jurusan->fak = $_POST['fak'];
				$jurusan->urutan = $_POST['urut'];
				$jurusan->save();
				$response = array(
					'status' => 'update'
				);		
		   	}
		   	return Response::json( $response );
	   	}			
	}
	public function activeJurusan(Request $request){
		$id = $_POST['kode'];

		if($request->ajax()){
			$fakultas = Master_jurusan::where('kode',$id)->first();
			if($fakultas->active=='1'){
				$fakultas->active = '0';
			}else{
				$fakultas->active = '1';
			}
			$fakultas->save();
			$response = array(
				'status' => 'success'
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

	public function getProdi(Request $request){
		if($request->ajax()){
			$data = Master_prodi::where('jur',$_GET['jur'])->where('kode','!=','0')->orderBy('urutan')->get();
			return DataTables::of($data)
				->editColumn('active', function($data){
					if($data->active =='1'){
						return '<i class="fas fa-check" style="color:#2ECC71;"></i>';
					}else{
						return '<i class="fas fa-minus" style="color:#EB4133;"></i>';
					}
				})
				->addColumn('action', function($data){
					return '<button type="button" class="btn btn-outline-primary btn-xs" id="editProdi" title="Edit">
							<i class="fas fa-edit"></i>
						</button>
							<span> </span>
						<button type="button" class="btn btn-outline-danger btn-xs" id="removeProdi" title="Remove">
							<i class="fas fa-trash"></i>
						</button>
						<span> </span>
						<button type="button" class="btn btn-outline-warning btn-xs" id="activeProdi" title="Status">
							<i class="fas fa-sync-alt"></i>
						</button>';
				})
				->rawColumns(['active','action'])
				->make(true);
		}
		return view( 'admin.master_data' );
	}
	public function getProdiClear(Request $request){
		if($request->ajax()){
			$data = Master_prodi::where('jur','kosong')->orderBy('urutan')->get();
			return DataTables::of($data)
				->addColumn('action', function($data){
					return '';
				})
				->make(true);
		}
		return view( 'admin.master_data' );
	}
	public function saveProdi(Request $request){
		$id = $_POST['id'];
		
	   	if($request->ajax()){
		   	if($id==''){
			   	$duplicate = Master_prodi::where('nama',$_POST['nama'])->first();
			   	if ($duplicate){
				   	$response = array(
						'status' => 'duplicate'
					);
			   	}else{
					/*******  INSERT NEW  *****/
					$prodi = new Master_prodi();
					$prodi->nama = $_POST['nama'];					
					$prodi->fak = $_POST['fak'];					
					$prodi->jur = $_POST['jur'];
					$prodi->urutan = $_POST['urut'];
					$prodi->active = '1';
					$prodi->save();
					$response = array(
						'status' => 'success'
					);
			   	}
		   	}else{
		   		$prodi = Master_prodi::where('kode',$id)->first();
				$prodi->nama = $_POST['nama'];				
				$prodi->fak = $_POST['fak'];					
				$prodi->jur = $_POST['jur'];
				$prodi->urutan = $_POST['urut'];
				$prodi->save();
				$response = array(
					'status' => 'update'
				);		
		   	}
		   	return Response::json( $response );
	   	}			
	}
	public function activeProdi(Request $request){
		$id = $_POST['kode'];

		if($request->ajax()){
			$prodi = Master_prodi::where('kode',$id)->first();
			if($prodi->active=='1'){
				$prodi->active = '0';
			}else{
				$prodi->active = '1';
			}
			$prodi->save();
			$response = array(
				'status' => 'success'
			);		
			return Response::json( $response );		
		}
	}
	
	public function hapusData(Request $request){
		$id = $_POST['kode'];
		$kategori = $_POST['kategori'];

		if($request->ajax()){
			if($kategori == "Fakultas"){
				$cek1 = Master_jurusan::where('fak',$id)->count();
				$cek2 = Master_prodi::where('fak',$id)->count();
				$tabel = Master_fakultas::where('kode',$id)->first();
			}elseif($kategori == "Jurusan"){
				$cek1 = Master_prodi::where('jur',$id)->count();
				$cek2 = 0;
				$tabel = Master_jurusan::where('kode',$id)->first();
			}elseif($kategori == "Prodi"){
				$cek1 = 0;
				$cek2 = 0;
				$tabel = Master_prodi::where('kode',$id)->first();}

			if($cek1 + $cek2 > 0){
				$response = array(
					'status' => 'duplicate'
				);	
			}else{
				$tabel->delete();
				$response = array(
					'status' => 'success'
				);	
			}
			return Response::json( $response );
		}
	}
}
