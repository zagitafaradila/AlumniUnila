<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distribusi_alumni;
use App\Models\Poll_alumni;
use App\Models\Poll_alumni_kompetensi;
use App\Models\Alumni;
use App\Models\Mahasiswa;
use App\Models\Master_fakultas;
use App\Models\Question;
use Response;
use DataTables;
use Auth;
use DB;

class DistribusiAlumniController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
	}

    public function index()
	{	
		$list_fakultas = Master_fakultas::where('kode','!=','0')->orderBy('urutan')->get();
		
		$data = array (
			'list_fakultas' => $list_fakultas,
		);
		return \View::make('admin.distribusi_alumni')->with($data);
	}
	public function indexAdd($id)
	{	
		$list_fakultas = Master_fakultas::where('kode','!=','0')->orderBy('urutan')->get();
		$data_surveyor = Mahasiswa::select(
				'npm',
				'name',
				\DB::raw(
					"COUNT(Distribusi_alumnis.npm_alumni) as jumlah_alumni, SUM(IF(Distribusi_alumnis.status = 'Sudah Mengisi', 1, 0))as jumlah_mengisi"
				))
			->where('npm',$id)
			->leftJoin('Distribusi_alumnis','Mahasiswas.npm','=','Distribusi_alumnis.npm_surveyor')
			->groupBy('Mahasiswas.npm')
			->first();
		
		if($data_surveyor->jumlah_alumni == 0){
			$persen_mengisi = 0;
		}else{
			$persen_mengisi = $data_surveyor->jumlah_mengisi / $data_surveyor->jumlah_alumni * 100;
		}
		
		$data = array (
			'list_fakultas' => $list_fakultas,
			'persen_mengisi' => $persen_mengisi,
			'data_surveyor' => $data_surveyor
		);
		return \View::make('admin.distribusi_alumni_add')->with($data);
	}
	public function indexEdit($id)
	{	
		$list_fakultas = Master_fakultas::where('kode','!=','0')->orderBy('urutan')->get();
		$data_surveyor = Mahasiswa::select(
				'npm',
				'name',
				\DB::raw(
					"COUNT(Distribusi_alumnis.npm_alumni) as jumlah_alumni, SUM(IF(Distribusi_alumnis.status = 'Sudah Mengisi', 1, 0))as jumlah_mengisi"
				))
			->where('npm',$id)
			->leftJoin('Distribusi_alumnis','Mahasiswas.npm','=','Distribusi_alumnis.npm_surveyor')
			->groupBy('Mahasiswas.npm')
			->first();
		
		if($data_surveyor->jumlah_alumni == 0){
			$persen_mengisi = 0;
		}else{
			$persen_mengisi = $data_surveyor->jumlah_mengisi / $data_surveyor->jumlah_alumni * 100;
		}
		
		$data = array (
			'list_fakultas' => $list_fakultas,
			'persen_mengisi' => $persen_mengisi,
			'data_surveyor' => $data_surveyor
		);
		return \View::make('admin.distribusi_alumni_edit')->with($data);
	}

	public function getListDistribusi(Request $request){
		if($request->ajax()){
			$data = Distribusi_alumni::select(
					'Mahasiswas.npm',
					'Mahasiswas.name',
					'Master_jurusans.nama as nama_jur',
					'Master_prodis.nama as nama_prodi',
					'Mahasiswas.angkatan',
					\DB::raw(
						"COUNT(npm_alumni) as jumlah_alumni, SUM(IF(status = 'Sudah Mengisi', 1, 0))as jumlah_mengisi"
					))
				->rightjoin('Mahasiswas','Distribusi_alumnis.npm_surveyor','=','Mahasiswas.npm')
				->join('Master_jurusans','Mahasiswas.jur','=','Master_jurusans.kode')
                ->join('Master_prodis','Mahasiswas.prodi','=','Master_prodis.kode')
                ->where('Mahasiswas.fak','LIKE',$_GET['fak'])
                ->where('Mahasiswas.jur','LIKE',$_GET['jur'])
				->where('Mahasiswas.prodi','LIKE',$_GET['prodi'])
				->groupBy('Mahasiswas.npm')
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
						<button type="button" class="btn btn-outline-success btn-xs" id="add" title="add">
							<i class="fas fa-plus"></i>
						</button>';
				})
				->rawColumns(['pilih','action'])
				->make(true);
		}
		return view( 'admin.distribusi_alumni' );
	}
	public function getAlumniFree(Request $request){
		if($request->ajax()){
			$data = Alumni::select('npm','Alumnis.name','Master_jurusans.nama as nama_jur','Master_prodis.nama as nama_prodi','wisuda')
				->join('Master_fakultas','Alumnis.fak','=','Master_fakultas.kode')
				->join('Master_jurusans','Alumnis.jur','=','Master_jurusans.kode')
                ->join('Master_prodis','Alumnis.prodi','=','Master_prodis.kode')
				->leftjoin('Distribusi_alumnis','Alumnis.npm','=','Distribusi_alumnis.npm_alumni')
				->where('Distribusi_alumnis.id',NULL)
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
		return view( 'admin.distribusi_alumni_add' );
	}
	public function getAlumniSurveyor(Request $request){
		if($request->ajax()){
			$data = Alumni::select('npm','Alumnis.name','Master_jurusans.nama as nama_jur','Master_prodis.nama as nama_prodi','wisuda','status')
				->join('Master_fakultas','Alumnis.fak','=','Master_fakultas.kode')
				->join('Master_jurusans','Alumnis.jur','=','Master_jurusans.kode')
                ->join('Master_prodis','Alumnis.prodi','=','Master_prodis.kode')
				->leftjoin('Distribusi_alumnis','Alumnis.npm','=','Distribusi_alumnis.npm_alumni')
				->where('Distribusi_alumnis.npm_surveyor',$_GET['npm_surveyor'])
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
		return view( 'admin.distribusi_alumni_add' );
	}
	
	public function addSelect(Request $request)
	{
		$table = $_POST['id'];
		$table = stripcslashes($table);
		$tableData = json_decode($table);

		if($request->ajax()){
			foreach($tableData as $r){
				
				//  INSERT NEW  
				$distribusi = new Distribusi_alumni();
				$distribusi->npm_alumni = $r;
				$distribusi->npm_surveyor = $_POST['npm_surveyor'];
				$distribusi->status = "Belum Mengisi";
				$distribusi->save();

				if($distribusi){
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
	public function removeSelect(Request $request)
	{
		$table = $_POST['id'];
		$table = stripcslashes($table);
		$tableData = json_decode($table);

		if($request->ajax()){
			foreach($tableData as $r){
				$used = Distribusi_alumni::where('npm_alumni', $r)->first();
				if($used['status'] == "Belum Mengisi"){
					$used->delete();
				}else{
					$used = false;
				}

				if($used){
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

	

	public function update_status_pekerjaan(){
		$menu = Auth::user()->access;
		if($menu == "Alumni"){
			$npm = Auth::user()->id;
		}else{
			$npm = 'xxx';
		}
		$dataAlumni = Alumni::where('npm',$npm)->first();
		$kodeProdi = $dataAlumni->fak.''.$dataAlumni->jur.''.$dataAlumni->prodi;
		$angkatan = substr($dataAlumni->wisuda, 0, 4);

		$countJPekerjaan = Poll_alumni::select(DB::raw("questions_details.kode_questions"))
			->join('questions_details', function($join) {
				$join->on('questions_details.id', '=', 'id_jawaban');})
			->where('npm',$npm)
			->groupBy('questions_details.kode_questions')->get();
		$countJPekerjaan = count($countJPekerjaan);

		$dataArray = array(
			'status_pekerjaan' => $countJPekerjaan
		);
		Distribusi_alumni::where('npm_alumni',$npm)->update($dataArray);

		$response = array(
			'status' => 'sukses',
		);

		$this->updateStatus($npm, $kodeProdi, $angkatan);

		return Response::json( $response );
	}
	public function update_status_kompetensi(){
		$menu = Auth::user()->access;
		if($menu == "Alumni"){
			$npm = Auth::user()->id;
		}else{
			$npm = 'xxx';
		}
		$dataAlumni = Alumni::where('npm',$npm)->first();
		$kodeProdi = $dataAlumni->fak.''.$dataAlumni->jur.''.$dataAlumni->prodi;
		$angkatan = substr($dataAlumni->wisuda, 0, 4);

		$countJKompetensi = Poll_alumni_kompetensi::select(DB::raw("count(poll_alumni_kompetensis.id) as jumlah"))
			->join('questions_details as jawaban', 'poll_alumni_kompetensis.id_jawaban', 'like', 
				DB::raw("CONCAT(jawaban.id, '%')"))
			->where('npm',$npm)->first();
		

		$dataArray = array(
			'status_kompetensi' => $countJKompetensi->jumlah
		);
		Distribusi_alumni::where('npm_alumni',$npm)->update($dataArray);

		$response = array(
			'status' => 'sukses',
		);

		$this->updateStatus($npm, $kodeProdi, $angkatan);

		return Response::json( $response );
	}

	public function updateStatus($npm, $kodeProdi, $angkatan){
		$cekKPekerjaan = Question::select(DB::raw('count(questions.id) as jumlah'))
			->join('distribution_questioners as distribusi','distribusi.pekerjaan','=','questions.kode_questioner')
			->where('distribusi.tahun',$angkatan)
			->first();
		$cekKKompetensi = Question::select(DB::raw('count(questions.id) as jumlah'))
			->join('distribution_questioners as distribusi', function($join) {
				$join->on('distribusi.kompetensi', '=', 'questions.kode_questioner');})
			->where('distribusi.tahun',$angkatan)
			->first();
		$cekKPS = Question::select(DB::raw('count(questions.id) as jumlah'))
			->join('distribution_questionerprodis as distribusi','distribusi.kode','=','questions.kode_questioner')
			->where('distribusi.tahun',$angkatan)
			->where('distribusi.kode','LIKE',$kodeProdi.'%')
			->first();

		$data = Distribusi_alumni::where('npm_alumni',$npm)->first();

		$hitung = ($cekKPekerjaan->jumlah - $data->status_pekerjaan) + ($cekKKompetensi->jumlah - $data->status_kompetensi) + ($cekKPS->jumlah - $data->status_ps);
		
		if($hitung == 0){
			$dataArray = array(
				'status' => 'Selesai Mengisi'
			);
		}else{
			$dataArray = array(
				'status' => 'Sedang Mengisi'
			);
		}
		
		Distribusi_alumni::where('npm_alumni',$npm)->update($dataArray);
	}
}
