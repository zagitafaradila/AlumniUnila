<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distribution_questioner;
use App\Models\Distribution_questionerprodi;
use App\Models\Questioner;
use App\Models\Question;
use App\Models\Questions_detail;
use DB;
use Response;
use DataTables;
use Auth;

class KuesionerBuilderController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index()
	{	
		return \View::make('admin.questioner_builder');
    }
    
    public function getKuesioner(Request $request){
        if(Auth::user()->access == 'Administrator'){
            if($request->ajax()){
                $data = Questioner::select('kode','nama','kategori')
                    ->where('kategori','!=','Program Studi')
                    ->get();
                return DataTables::of($data)
                    ->addColumn('action', function($data){
                        return '<button type="button" class="btn btn-outline-primary btn-xs" id="editKuesioner" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                                <span> </span>
                            <button type="button" class="btn btn-outline-danger btn-xs" id="removeKuesioner" title="Remove">
                                <i class="fas fa-trash"></i>
                            </button>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }elseif(Auth::user()->access == 'Kepala Program Studi'){
            if($request->ajax()){
                $data = Questioner::select(DB::raw("SUBSTRING_INDEX(kode,' - ',-1) as kode"),'nama')
                    ->where('kode','LIKE',Auth::user()->fak.'-'.Auth::user()->jur.'-'.Auth::user()->prodi.'%')
                    ->get();
                return DataTables::of($data)
                    ->addColumn('action', function($data){
                        return '<button type="button" class="btn btn-outline-primary btn-xs" id="editKuesionerPS" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                                <span> </span>
                            <button type="button" class="btn btn-outline-danger btn-xs" id="removeKuesionerPS" title="Remove">
                                <i class="fas fa-trash"></i>
                            </button>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }
		
		return view( 'admin.questioner_builder' );
    }
    public function getDistribusi(Request $request){
        if(Auth::user()->access == 'Administrator'){
            if($request->ajax()){
                $data = Distribution_questioner::select('tahun','perusahaan','pekerjaan','kompetensi')->get();
                return DataTables::of($data)
                    ->addColumn('action', function($data){
                        return '<button type="button" class="btn btn-outline-primary btn-xs" id="editDistribusi" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }elseif(Auth::user()->access == 'Kepala Program Studi'){
            if($request->ajax()){
                $data = Distribution_questionerprodi::select('tahun', DB::raw("SUBSTRING_INDEX(kode,' - ',-1) as kode"))
                    ->where('kode','LIKE',Auth::user()->fak.'-'.Auth::user()->jur.'-'.Auth::user()->prodi.'%')
                    ->get();
                return DataTables::of($data)
                    ->addColumn('action', function($data){
                        return '<button type="button" class="btn btn-outline-primary btn-xs" id="editDistribusiPS" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }
		
		return view( 'admin.questioner_builder' );
	}
    public function getPertanyaan(Request $request){
        if(Auth::user()->access == 'Administrator'){
            if($request->ajax()){
                $data = Question::select('kode','question')
                    ->where('kode_questioner',$_GET['kode_questioner'])
                    ->get();
                return DataTables::of($data)
                    ->addColumn('action', function($data){
                        return '<button type="button" class="btn btn-outline-primary btn-xs" id="editPertanyaan" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                                <span> </span>
                            <button type="button" class="btn btn-outline-danger btn-xs" id="removePertanyaan" title="Remove">
                                <i class="fas fa-trash"></i>
                            </button>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }elseif(Auth::user()->access == 'Kepala Program Studi'){
            if($request->ajax()){
                $data = Question::select('kode','question')
                    ->where('kode_questioner',Auth::user()->fak.'-'.Auth::user()->jur.'-'.Auth::user()->prodi.' - '.$_GET['kode_questioner'])
                    ->get();
                return DataTables::of($data)
                    ->addColumn('action', function($data){
                        return '<button type="button" class="btn btn-outline-primary btn-xs" id="editPertanyaanPS" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                                <span> </span>
                            <button type="button" class="btn btn-outline-danger btn-xs" id="removePertanyaanPS" title="Remove">
                                <i class="fas fa-trash"></i>
                            </button>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }
		
		return view( 'admin.questioner_builder' );
	}
	public function getKategori(Request $request){
		$kuesioner = $_GET['kuesioner'];
		$table = Questioner::where('kode', $kuesioner)->first();
		$response = array(
			'kategori' => $table->kategori
		);

		return Response::json( $response );
	}

    public function saveKuesioner(Request $request){
		if(Auth::user()->access == "Administrator"){			
			$kode =  $_POST['kode'];
			$kategori = $_POST['kategori'];
			$table = 'tableKuesioner';
		}
		elseif(Auth::user()->access == "Kepala Program Studi"){
			if($_POST['id'] !=''){
				$id = Auth::user()->fak.'-'.Auth::user()->jur.'-'.Auth::user()->prodi.' - '.$id;
			}			
			$kode =  Auth::user()->fak.'-'.Auth::user()->jur.'-'.Auth::user()->prodi.' - '.$_POST['kode'];
			$kategori = "Program Studi";
			$table = 'tableKuesionerPS';
		}
		
	   	if($request->ajax()){
            if($_POST['id']==''){		
				$duplicate = Questioner::where('kode',$kode)->first();
				if ($duplicate){
					$response = array(
						'status' => 'duplicate',
						'tabel' => $table
					);
				}else{
					//  INSERT NEW  
					$Questioner = new Questioner();
					$Questioner->kode = $kode;
					$Questioner->nama = $_POST['nama'];
					$Questioner->kategori = $kategori;
					$Questioner->active = "1";
					$Questioner->save();
					$response = array(
						'status' => 'success',
						'tabel' => $table
					);
				}
			}else{
				$duplicate = null;
				if($_POST['id']!=$kode){
					$duplicate = Questioner::where('kode',$kode)->first();
					if ($duplicate){
						$response = array(
							'status' => 'duplicate',
							'tabel' => $table
						);
					}else{
                        $Questioner = Questioner::where('kode',$_POST['id'])->first();
                        $Questioner->kode = $kode;
						$Questioner->nama = $_POST['nama'];
						$Questioner->kategori = $kategori;
						$Questioner->save();
						$response = array(
							'status' => 'update',
							'tabel' => $table
						);		
					}
				}
				else{
					$Questioner = Questioner::where('kode',$_POST['id'])->first();					
					$Questioner->nama = $_POST['nama'];
					$Questioner->kategori = $kategori;
					$Questioner->save();
					$response = array(
						'status' => 'update',
						'tabel' => $table
					);		
				} 
            }
            
			return Response::json( $response );
		}			
	}
	public function removeKuesioner(Request $request){
		$kode = $_POST['kode'];

		if($request->ajax()){
			$used1 = Question::where('kode_questioner', $kode)->first();
			$used2 = Distribution_questioner::whereRaw(
				"perusahaan = '$kode' || pekerjaan = '$kode' || kompetensi = '$kode'")->first();
			$used3 = Distribution_questionerprodi::where('kode', $kode)->first();
			if($used1 or $used2 or $used3){
				$response = array(
					'status' => 'duplicate'
				);
			}else{
				$Questioner = Questioner::where('kode',$kode)->first();
				$Questioner->delete();

				if($Questioner){
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

	public function saveDistribusi(Request $request){
		$tahun 	= $_POST['tahun'];	
		if($request->ajax()){
			if(Auth::user()->access =="Administrator"){
				$duplicate = Distribution_questioner::where('tahun',$tahun)->first();
				if(!$duplicate){
					//  INSERT NEW  
					$data = new Distribution_questioner();
                    $data->tahun = $tahun;
					$data->perusahaan = $_POST['KPerusahaan'];
					$data->pekerjaan = $_POST['KPekerjaan'];
					$data->kompetensi = $_POST['KKompetensi'];
					$data->save();
					$response = array(
						'status' => 'success',
						'tabel' => 'tableDistribusi'
					);
				}else{
					$duplicate2 = Alumni::where('wisuda','LIKE',$tahun.'%')
						->join('poll_alumnis', function($join) {
							$join->on('alumnis.npm', '=', 'poll_alumnis.npm');})
						->join('poll_alumni_kompetensis', function($join) {
							$join->on('alumnis.npm', '=', 'poll_alumni_kompetensis.npm');})
						->join('poll_perusahaans', function($join) {
							$join->on('alumnis.npm', '=', 'poll_perusahaans.npm');})
						->join('poll_prodis', function($join) {
							$join->on('alumnis.npm', '=', 'poll_prodis.npm');})
						->first();
					if($duplicate2){
						$response = array(
							'status' => 'duplicate',
							'tabel' => 'tableDistribusi'
						);
					}else{
						$data = Distribution_questioner::where('tahun',$tahun)->first();
						$data->perusahaan = $_POST['KPerusahaan'];
						$data->pekerjaan = $_POST['KPekerjaan'];
						$data->kompetensi = $_POST['KKompetensi'];
						$data->save();
						$response = array(
							'status' => 'success',
							'tabel' => 'tableDistribusi'
						);
					}				
				}
			}elseif(Auth::user()->access =='Kepala Program Studi'){
				$duplicate = Distribution_questionerprodi::where('kode','LIKE',Auth::user()->fak.'-'.Auth::user()->jur.'-'.Auth::user()->prodi.'%')
					->where('tahun',$tahun)->first();
				if(!$duplicate){
					//  INSERT NEW 					
					$data = new Distribution_questionerprodi();
                    $data->tahun = $tahun;
					$data->kode = Auth::user()->fak.'-'.Auth::user()->jur.'-'.Auth::user()->prodi.' - '.$_POST['KProgramStudi'];
					$data->save();
					$response = array(
						'status' => 'success',
						'tabel' => 'tableDistribusiPS'
					);
				}else{
					// UPDATE
					$duplicate2 = Alumni::where('wisuda','LIKE',$tahun.'%')
						->where('fak',Auth::user()->fak)
						->where('jur',Auth::user()->jur)
						->where('prodi',Auth::user()->prodi)
						->join('poll_prodis', function($join) {
							$join->on('alumnis.npm', '=', 'poll_prodis.npm');})
						->first();
					if($duplicate2){
						$response = array(
							'status' => 'duplicate',
							'tabel' => 'tableDistribusiPS'
						);
					}else{
						$data = Distribution_questionerprodi::where('kode','LIKE',Auth::user()->fak.'-'.Auth::user()->jur.'-'.Auth::user()->prodi.'%')
							->where('tahun',$tahun)->first();
						$data->kode = Auth::user()->fak.'-'.Auth::user()->jur.'-'.Auth::user()->prodi.' - '.$_POST['KProgramStudi'];
						$data->save();
						$response = array(
							'status' => 'success',
							'tabel' => 'tableDistribusiPS'
						);
					}				
				}
			}
			return Response::json( $response );
		}			
	}
	   
	public function savePertanyaan(Request $request){
		$id 	= $_POST['id'];	
		$kode 	= $_POST['kode'];	
		if(Auth::user()->access =="Administrator"){
			$kuesioner = $_POST['kuesioner'];
		}else{
			$kuesioner = Auth::user()->fak.'-'.Auth::user()->jur.'-'.Auth::user()->prodi.' - '.$_POST['kuesioner'];
		}
		if($request->ajax()){
			if($id==''){
				$duplicate = Question::where('kode_questioner', $kuesioner)->where('kode',$kode)->first();
				if ($duplicate){
					$response = array(
						'status' => 'duplicate'
					);
				}else{
					//  INSERT NEW  
					$Questions = new Question();
					$Questions->kode_questioner = $kuesioner;
					$Questions->kode 		= $_POST['kode'];
					$Questions->level 		= $_POST['level'];
					$Questions->question 	= $_POST['pertanyaan'];
					$Questions->helptext 	= $_POST['help'];
					$Questions->jenis 		= $_POST['jenis'];
					$Questions->save();
					$response = array(
						'status' => 'success'
					);
				}
			}else{
				$Questions = Question::where('kode_questioner', $kuesioner)->where('id',$id)->first();
				$Questions->kode 		= $_POST['kode'];
				$Questions->level 		= $_POST['level'];
				$Questions->question 	= $_POST['pertanyaan'];
				$Questions->helptext 	= $_POST['help'];
				$Questions->jenis 		= $_POST['jenis'];
				$Questions->save();
				$response = array(
					'status' => 'update'
				);	
			}

			$QuestionsDetail = Questions_detail::where('kode_questioner', $kuesioner)->where('kode_questions',$kode)->get();
			foreach($QuestionsDetail as $r){
				$r->delete();
			}

			$cekJumlah = Question::select(DB::raw("count(kode) as jumlah"))
				->where('kode_questioner',$kuesioner)
				->first();
			$arrayQuestioner = array(
				'jumlah' => $cekJumlah->jumlah
			);
			if(Auth::user()->access =="Administrator"){
				Questioner::where('kode',$kuesioner)->update($arrayQuestioner);
			}else{
				Questioner_prodi::where('kode',$kuesioner)->update($arrayQuestioner);
			}

			return Response::json( $response );
		}			
	}
	public function savePertanyaanDetails(Request $request){
		$kode 	= $_POST['kode'];	
		$value 	= $_POST['optionvalue'];	
		if(Auth::user()->access =="Administrator"){
			$kuesioner = $_POST['kuesioner'];
		}else{
			$kuesioner = Auth::user()->fak.'-'.Auth::user()->jur.'-'.Auth::user()->prodi.' - '.$_POST['kuesioner'];
		}
		if($request->ajax()){
			if($value !== 'undefined'){
				//  INSERT NEW  
				$QuestionsDetail 					= new Questions_detail();
				$QuestionsDetail->kode_questioner 	= $kuesioner;
				$QuestionsDetail->kode_questions 	= $kode;
				$QuestionsDetail->jenis 			= $_POST['type'];
				$QuestionsDetail->no 				= $_POST['nomor'];
				$QuestionsDetail->option_value		= $_POST['optionvalue'];
				$QuestionsDetail->sub_option		= $_POST['suboption'];
				$QuestionsDetail->go_to				= $_POST['goto'];
				$QuestionsDetail->skip				= $_POST['skip'];
				$QuestionsDetail->save();
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
	public function editPertanyaan(Request $request){
		if(Auth::user()->access == 'Administrator'){
			$kuesioner = $_GET['kuesioner'];			
		}elseif(Auth::user()->access == 'Kepala Program Studi'){
			$kuesioner = Auth::user()->fak.'-'.Auth::user()->jur.'-'.Auth::user()->prodi.' - '.$_GET['kuesioner'];
		}
		$kode = $_GET['kode'];

		if($request->ajax())
		{	
			$Questions = Question::where('kode_questioner', $kuesioner)
				->where('kode',$kode)->first();
			
			$QuestionsDetail = Questions_detail::where('kode_questioner', $kuesioner)
				->where('kode_questions',$kode)
				->orderBy('no')->get();

			$tabel = '';
			if($QuestionsDetail){
				foreach ($QuestionsDetail as $r){
					if($r->jenis=='Radio'){			
						$tabel .=	
							'<tr>
								<td width="20" class="center"><input class="form-control" type="radio" disabled></input></td>
								<td><input class="form-control" size=25 type="text" id="QuesValue" name="QuesValue" value="'.$r->option_value.'"/></td>
								<td><button class="btn btn-block btn-danger btn-xs deleteLink" title="Remove" id="QuesTableDelete"><span class="fa fa-times"></span></button></td>
								<td width="20"></td>
								<td width="40"><input type="text" size="10" id="latbox" placeholder="Opsi Jawaban" disabled/></td>
								<td width="150"><input type="text" placeholder="Text Keterangan" style="border:none;" id="QuesSub" name="QuesSub" value="'.$r->sub_option.'"/></td>
								<td width="10"></td>
								<td width="120">Tampilkan : </td>
								<td><input class="form-control" size=5 type="text" id="QuesGoto" name="QuesGoto" value="'.$r->go_to.'"/></td>
								<td width="120"> Sembunyikan : </td>
								<td><input class="form-control" size=5 type="text" id="QuesSkip" name="QuesSkip" value="'.$r->skip.'"/></td>
							</tr>';
					}			
					else if($r->jenis=='Combobox'){			
						$tabel .=	
							'<tr>
								<td><input class="form-control" size=80 type="text" id="QuesValue" name="QuesValue" value="'.$r->option_value.'"/></td>
								<td><button class="btn btn-block btn-danger btn-xs deleteLink" title="Remove" id="QuesTableDelete"><span class="fa fa-times"></span></button></td>
								<td width="150"><input type="hidden" placeholder="Text Keterangan" style="border:none;" id="QuesSub" name="QuesSub" value="'.$r->sub_option.'"/></td>
								<td><input size=5 type="hidden" id="QuesGoto" name="QuesGoto" value="'.$r->go_to.'"/></td>
								<td><input size=5 type="hidden" id="QuesSkip" name="QuesSkip" value="'.$r->skip.'"/></td>
							</tr>';
					}			
					else if($r->jenis=='Checkbox'){			
						$tabel .=	
							'<tr>
								<td width="20" class="center"><input class="form-control" type="checkbox" disabled></input></td>
								<td><input class="form-control" size=25 type="text" id="QuesValue" name="QuesValue" value="'.$r->option_value.'"/></td>
								<td><button class="btn btn-block btn-danger btn-xs  deleteLink" title="Remove" id="QuesTableDelete"><span class="fa fa-times"></span></button></td>
								<td width="20"></td>
								<td width="40"><input type="text" size="10" placeholder="Opsi Jawaban" disabled/></td>
								<td width="150"><input class="form-control" type="text" placeholder="Text Keterangan" style="border:none;" id="QuesSub" name="QuesSub" value="'.$r->sub_option.'"/></td>
								<td></td>
								<td></td>
								<td><input type="hidden" id="QuesGoto" name="QuesGoto" value="'.$r->go_to.'"/></td>
								<td><input type="hidden" id="QuesSkip" name="QuesSkip" value="'.$r->skip.'"/></td>
							</tr>';
					}			
					else if($r->jenis=='Text'){			
						$tabel .=	
							'<tr>
								<td></td>
								<td><input class="form-control" size=50 type="text" id="QuesValue" name="QuesValue" value="'.$r->option_value.'"/></td>
								<td width="150"><input class="form-control" type="text" placeholder="Text Keterangan" style="border:none;" id="QuesSub" name="QuesSub" value="'.$r->sub_option.'"/></td>
								<td><input type="hidden" id="QuesGoto" name="QuesGoto" value="'.$r->go_to.'"/></td>
								<td><input type="hidden" id="QuesSkip" name="QuesSkip" value="'.$r->skip.'"/></td>
							</tr>';
					}	
					else if($r->jenis=='Textarea'){			
						$tabel .=	
							'<tr>
								<td></td>
								<td><textarea class="form-control" id="QuesValue" name="QuesValue"/>'.$r->option_value.'</textarea></td>
								<td width="150"><input type="hidden" placeholder="Text Keterangan" style="border:none;" id="QuesSub" name="QuesSub" value="'.$r->sub_option.'"/></td>
								<td><input type="hidden" id="QuesGoto" name="QuesGoto" value="'.$r->go_to.'"/></td>
								<td><input type="hidden" id="QuesSkip" name="QuesSkip" value="'.$r->skip.'"/></td>
							</tr>';
					}	
				}
			}			
            
			$response = array(
				'id'				=> $Questions->id,
				'kode' 				=> $Questions->kode,
				'pertanyaan' 		=> $Questions->question,
				'bantuan' 			=> $Questions->helptext,
				'jenis' 			=> $Questions->jenis,
				'level' 			=> $Questions->level,
				'tabel' 			=> $tabel,
			);	
			return Response::json( $response );
		}	
	}
	public function removePertanyaan(Request $request){
		$kode = $_POST['kode'];

		if($request->ajax()){
			$Questions = Question::where('kode',$kode)->first();
			$Questions->delete();

			$QuestionsDetail = Questions_detail::where('kode_questions',$kode)->first();
			$QuestionsDetail->delete();

			$response = array(
			'status' => 'success'
			);	

			return Response::json( $response );
		}
	}
	
    public function comboTahun(Request $request){		
		if($request->ajax())
		{	
			$data = '<option value="">Pilih Tahun</option>';
            $maxTahun = date("Y");

            for($i=2018; $i<=$maxTahun; $i++){				
				if(Auth::user()->access =='Administrator'){
					$check = Distribution_questioner::where('tahun',$i)->first();
				}elseif(Auth::user()->access =='Kepala Program Studi'){
					$check = Distribution_questionerprodi::where('tahun',$i)->first();
				}
				
				if(!$check){
					$data .= '<option value="'.$i.'">'.$i.'</option>';
				}
			}
            
			$response = array(
				'option' => $data
			);	
			return Response::json( $response );
		}	
    }
    public function comboKuesioner(Request $request){		
		if($request->ajax())
		{	
            $data = '<option value="">Pilih Kuesioner</option>';
            
			if(Auth::user()->access =='Administrator'){
                $Questioner = Questioner::where('active','1')
					->where('kategori','!=','Program Studi')
					->orderBy('kode')->get();			
				foreach ($Questioner as $r){
					$data .= '<option value="'.$r->kode.'">'.$r->kode.'</option>';
				}
			}elseif(Auth::user()->access =='Kepala Program Studi'){
				$Questioner = Questioner::select(DB::raw("SUBSTRING_INDEX(kode,' - ',-1) as kode"))
					->where('kode','LIKE',Auth::user()->fak.'-'.Auth::user()->jur.'-'.Auth::user()->prodi.'%')
					->orderBy('kode')->get();			
				foreach ($Questioner as $r){
					$data .= '<option value="'.$r->kode.'">'.$r->kode.'</option>';
				}
			}			
            
			$response = array(
				'option' => $data
			);	
			return Response::json( $response );
		}	
    }
    public function comboKPerusahaan(Request $request){		
		if($request->ajax())
		{	
			$data = '<option value="">Pilih Kode</option>';
			$tabel = Questioner::where('kategori','Perusahaan')->orderBy('kode')->get();

			foreach ($tabel as $t){
				$data .= '<option value="'.$t->kode.'">'.$t->kode.'</option>';
			}
            
			$response = array(
				'option' => $data
			);	
			return Response::json( $response );
		}	
	}
    public function comboKPekerjaan(Request $request){		
		if($request->ajax())
		{	
			$data = '<option value="">Pilih Kode</option>';
			$tabel = Questioner::where('kategori','Pekerjaan')->orderBy('kode')->get();

			foreach ($tabel as $t){
				$data .= '<option value="'.$t->kode.'">'.$t->kode.'</option>';
			}
            
			$response = array(
				'option' => $data
			);	
			return Response::json( $response );
		}	
	}
    public function comboKKompetensi(Request $request){		
		if($request->ajax())
		{	
			$data = '<option value="">Pilih Kode</option>';
			$tabel = Questioner::where('kategori','Kompetensi')->orderBy('kode')->get();

			foreach ($tabel as $t){
				$data .= '<option value="'.$t->kode.'">'.$t->kode.'</option>';
			}
            
			$response = array(
				'option' => $data
			);	
			return Response::json( $response );
		}	
	}
    public function comboKProgramStudi(Request $request){		
		if($request->ajax())
		{	
			$data = '<option value="">Pilih Kode</option>';
			$tabel = Questioner::select(DB::raw("SUBSTRING_INDEX(kode,' - ',-1) as kode"))
				->where('kode','LIKE',Auth::user()->fak.'-'.Auth::user()->jur.'-'.Auth::user()->prodi.'%')
				->orderBy('kode')->get();

			foreach ($tabel as $t){
				$data .= '<option value="'.$t->kode.'">'.$t->kode.'</option>';
			}
            
			$response = array(
				'option' => $data
			);	
			return Response::json( $response );
		}	
	}
}