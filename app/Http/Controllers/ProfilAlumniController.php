<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Alumni;
use App\Models\Master_fakultas;
use App\Models\Master_jurusan;
use App\Models\Master_prodi;

class ProfilAlumniController extends Controller
{
    public function index()
	{	
		$alumni 	= Alumni::where('npm',Auth::user()->id)->first(); 	
		$fakultas = Master_fakultas::where('active','1')->orderBy('urutan')->get();
		$jurusan  = Master_jurusan::where('fak',$alumni->fak)->orderBy('urutan')->get();
		$prodi  = Master_prodi::where('jur',$alumni->jur)->orderBy('urutan')->get();
		$data = array (
			'fakultas'=> $fakultas,
			'jurusan'=> $jurusan,
			'prodi'=> $prodi,
			'alumni'	=> $alumni
		);

		return \View::make('alumni.profil_alumni')->with($data);
	}

	public function save(){
		$menu = Auth::user()->access;
		if($menu == "Alumni"){
			$npm = Auth::user()->id;
		}else{
			$npm = 'xxx';
		}
		
		if($_POST['jurusan']=='' || $_POST['jurusan']=='Pilih Jurusan'){
			$this->index();
		}else{
			//$file = Input::file('foto');    
			
			$alumni = Alumni::where('npm', '=', $npm)->first();
			$alumni->name = $_POST['nama'];		
			$alumni->birth_place = $_POST['tempatlahir'];			
			$alumni->birthday= date('Y-m-d',strtotime($_POST['tgllahir']));			
			$alumni->wisuda= date('Y-m-d',strtotime($_POST['tglwisuda']));	
			$alumni->jk = $_POST['jk'];				
			$alumni->agama = $_POST['agama'];				
			$alumni->telp = $_POST['telp'];				
			$alumni->email = $_POST['email'];								
			$alumni->telp_wa = $_POST['telp_wa'];				
			$alumni->instagram = $_POST['instagram'];				
			$alumni->fb = $_POST['fb'];				
			$alumni->twitter = $_POST['twitter'];				
			$alumni->linkedin = $_POST['linkedin'];							
			$alumni->social = $_POST['sosial'];				
			$alumni->telp_other = $_POST['telp2'];				
			$alumni->address = $_POST['alamat'];		
			$filename = '';	
			/*if (Input::hasFile('foto')) {
				$destinationPath    = 'assets/uploads/profile-images/';
				$filename = $npm.'.'.$file->getClientOriginalExtension();
				$old_image = $destinationPath.$filename;
			
				$file->move($destinationPath, $filename);
			}*/
			if($filename!==''){
				$alumni->foto = $filename;
			}
			
			$alumni->save();

			return redirect()->route('profil_alumni');
		}
	}
}
