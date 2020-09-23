<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Response;
use App\Models\Alumni;
use App\Models\Distribution_questioner;
use App\Models\Questioner;
use App\Models\Question;
use App\Models\Questions_detail;
use App\Models\Poll_alumni_kompetensi;

class KuesionerKompetensiController extends Controller
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
		$html_table = '';
        $Questioner = Questioner::where('kode','=',$distribusi->kompetensi)
			->orderBy('kode')->get();	 
	
		foreach($Questioner as $c){		

		/***********************************  KUESIONER TYPE = TABLE *******************************************************/
			$Questions = Question::where('kode_questioner','=',$c->kode)->orderBy('kode_questioner')->get();
			foreach($Questions as $q){
				$html_table .= 
					"<tr>
						<td>[".$q->kode."]</td>
						<td>".$q->question."</td>
						<td style='text-align:center'>";
				
				$npm = Auth::user()->id;
				$kode_questioner = $q->kode_questioner;
				$kode_questions = $q->kode;
				$QuestionsDetail = Questions_detail::select(array('questions_details.id as id','jenis','option_value','kompetensi_diri.id_jawaban as jawaban_diri','kompetensi_pt.id_jawaban as jawaban_pt'))
					->leftjoin('poll_alumni_kompetensis as kompetensi_diri', 'kompetensi_diri.id_jawaban','=', 
						DB::raw("CONCAT(questions_details.id, '-Diri') AND kompetensi_diri.npm = '$npm'"))
					->leftjoin('poll_alumni_kompetensis as kompetensi_pt', 'kompetensi_pt.id_jawaban','=', 
						DB::raw("CONCAT(questions_details.id, '-PT') AND kompetensi_pt.npm = '$npm'"))
					->where(function($query) use ($kode_questioner){
						$query->where('kode_questioner', '=', $kode_questioner);})
					->where(function($query) use ($kode_questions){
						$query->where('kode_questions','=',$kode_questions);})
					->orderBy('no')
					->groupBy('no')
					->get();
				
				foreach($QuestionsDetail as $r){
					if($r->id == $r->jawaban_diri){
						$answer = 'Checked';
					}else{
						$answer = '';
					}
					$html_table .='&nbsp <input type="radio" name="'.$c->kode.$q->kode.'-Diri" id="Option'.$r->id.'" value="'.$r->id.'-Diri" '.$answer.'/>
								'.$r->option_value.'&nbsp &nbsp';	
				}
				$html_table	.= "</td><td style='text-align:center'>";

				foreach($QuestionsDetail as $r){
					if($r->id == $r->jawaban_pt){
						$answer = 'Checked';
					}else{
						$answer = '';
					}
					$html_table .='&nbsp <input type="radio" name="'.$c->kode.$q->kode.'-PT" id="Option'.$r->id.'" value="'.$r->id.'-PT" '.$answer.'/>
								'.$r->option_value.'&nbsp &nbsp';	
				}

				$html_table .=
				"</td>
					</tr>";
			}			
		/******/
		}
		$data = array (
			'alumni'=> $alumni,
			'html_table' => $html_table
		);
						
		return \View::make('alumni.kuesioner_kompetensi')->with($data);
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
			$poll = new Poll_alumni_kompetensi;
			
			$poll->id_jawaban = $_POST['id'];
			$poll->npm = $npm;
			$poll->save();
		}
	}

	public function remove()
	{
		$menu = Auth::user()->access;
		if($menu == "Alumni"){
			$npm = Auth::user()->id;
		}else{
			$npm = 'xxx';
		}

		$poll = Poll_alumni_kompetensi::where('npm','=',$npm)->delete();
	
		$response = array(
			'status' => 'success'
		);	
			
		return Response::json( $response );
	}
}
