<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Response;
use App\Models\Alumni;
use App\Models\Distribution_questioner;
use App\Models\Poll_alumni;
use App\Models\Questioner;
use App\Models\Question;
use App\Models\Questions_detail;

class KuesionerPekerjaanController extends Controller
{
    public function index()
	{		
        $alumni = Alumni::select('name','npm', 'master_fakultas.nama as fak','master_jurusans.nama as jur','master_prodis.nama as prodi','wisuda')       
            ->join('master_fakultas','alumnis.fak','=','master_fakultas.kode')     
			->join('master_jurusans','alumnis.jur','=','master_jurusans.kode')
            ->join('master_prodis','alumnis.prodi','=','master_prodis.kode')
            ->where('npm',Auth::user()->id)->first();
		$distribusi = Distribution_questioner::where('tahun',substr($alumni->wisuda,0,4))->first();
		$id = '';
		$html = '';
		$Questioner = Questioner::where(function($query) use ($distribusi){$query->where('kode','=',$distribusi->pekerjaan);})
			->get();
	
		if($alumni->prodi != ""){
			$namaprodi = $alumni->prodi;
		}else{
			$namaprodi = '-';
        }
        
		foreach($Questioner as $c){
		/***********************************  KUESIONER TYPE = TABLE *******************************************************/
		    $Questions = Question::where('kode_questioner','=',$c->kode)->orderBy(DB::raw('SUBSTR(kode FROM 1 FOR 1),CAST(SUBSTR(kode FROM 2) AS UNSIGNED)'))->get();	
				foreach ($Questions as $q) {
					// DIV With ID KODE BEGIN
					$html .= '  <div class="row form-group" id="'.$c->kode.$q->kode.'" style="margin-bottom:20px;">';
					$html .= '	<div class="col-sm-1">['.$q->kode.']</div>
								<div class="col-sm-11">'.$q->question.'</div>
											
								<div class="col-sm-1"></div>
								<div class="col-sm-11"><h6><i>'.$q->helptext.'</i></h6></div>';
					
					$kode_kuesioner = $q->kode_questioner;
					$kode_questions = $q->kode;
					$npm = Auth::user()->id;
					$QuestionsDetail = Questions_detail::select(array('questions_details.id as id','jenis','option_value','sub_option','sub_option_class','go_to','skip','id_jawaban','sub_jawaban','npm'))
						->leftjoin('poll_alumnis', 'questions_details.id','=', 
							DB::raw("poll_alumnis.id_jawaban AND poll_alumnis.npm = '$npm'"))
						->where('kode_questioner', '=', $kode_kuesioner)
						->where('kode_questions','=',$kode_questions)
						->orderBy('no')
						->groupBy('no')
						->get();		
					
					
					// DIV 12 BEGIN
					$html .='	<div class="col-sm-1"></div>	
								<div class="col-sm-11">';			
						if($q->jenis=='Combobox'){
							$html .='<div>
									<select name="QuesValue">';
						}
					
						foreach($QuestionsDetail as $r){
							
							
							$id_jawaban = $r->id;
							
							
							if($r->npm==Auth::user()->id && $r->id_jawaban){
								if ($r->jenis=='Combobox'){
									$answer = 'Selected';
								}else{
									$answer = 'Checked';
								}
								$subAnswer = $r->sub_jawaban;
							}else{
								$answer = '';
								$subAnswer = '';
							}
							
							
							if($r->sub_option_class=='numbers'){
									$size = '5';
								}else{
									$size = '30';
								}
							if($r->sub_option!==''){
								$sub = ' <input size="'.$size.'" id="subvalue'.$r->id.'" type="text" class="'.$r->sub_option_class.'" value="'.$subAnswer.'" disabled="disabled"/> '.$r->sub_option.' ';
							}
							else if($r->sub_option=='null'){
								$sub = ' <input size="'.$size.'" id="subvalue'.$r->id.'" type="text" class="'.$r->sub_option_class.'" value="'.$subAnswer.'" disabled="disabled"/> ';
							}
							else{
								$sub = '';
							}
							
							$showed='';
							$skipped='';
									
							$skip=explode(",",$r->skip);
							foreach ($skip as &$id) {
								$skipped .="$('#".$c->kode.$id."').hide();";
							}
									
							$show=explode(",",$r->go_to);
							foreach ($show as &$id) {
								$showed .="$('#".$c->kode.$id."').show();";
							}
									
							if($r->jenis=='Text'){
								if($r->sub_option_class=='numbers'){
									$size = '5';
								}else{
									$size = '30';
								}
								
								$html .='<div class="answerList '.$r->jenis.'">
													<label>
														<input size="'.$size.'" type="'.$r->jenis.'" class="'.$r->sub_option_class.'" name="QuesValue" id="'.$r->id.'" value="'.$subAnswer.'" />
														'.$r->option_value.
													'</label> '.
													$r->sub_option.'
												 </div>';	
							}else if($r->jenis=='Combobox'){
								$html .='<option value="'.$r->id.'" '.$answer.'>'.$r->option_value.'</option>';	
							}else{
								$html .='<div class="answerList '.$r->jenis.'">
														<label>
															<input type="'.$r->jenis.'" name="'.$c->kode.$q->kode.'" id="Option'.$r->id.'" value="'.$r->id.'" onClick="'.$showed.$skipped.'" '.$answer.'/>
															'.$r->option_value.
														'</label>'.
														$sub.'
												 </div>';	
							}
						}
						
						
					if($q->jenis=='Combobox'){
						$html .='	</select>
										</div>';
					}
					// DIV 12 BEGIN
					$html .='</div>';		
				
				// DIV With ID KODE END	
				$html .='</div>';	
				}
			
			
			}
		$data = array (
            'alumni' => $alumni,
			'html'		=>	$html
		);
						
		return \View::make('alumni.kuesioner_pekerjaan')->with($data);
	}

	public function remove()
	{
		$menu = Auth::user()->access;
		if($menu == "Alumni"){
			$npm = Auth::user()->id;
		}else{
			$npm = 'xxx';
		}
		$poll = Poll_alumni::where('npm','=',$npm)->delete();
	
		$response = array(
			'status' => 'success'
		);	
			
		return Response::json( $response );
	}

	public function save(Request $request)
	{
		$menu = Auth::user()->access;
		if($menu == "Alumni"){
			$npm = Auth::user()->id;
		}else{
			$npm = 'xxx';
		}

		if($request->ajax()){
			$poll = new Poll_alumni;			
			$poll->id_jawaban = $_POST['id'];
			$poll->sub_jawaban = $_POST['sub'];
			$poll->npm = $npm;
			$poll->save();
		}
		
		if($_POST['id']=='43')
		{
			$alumni = Alumni::select('npm')->where('npm',$npm)->first();
			$alumni->has_work = '1';
			$alumni->save();
		}
		
	}
}
