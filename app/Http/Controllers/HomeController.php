<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Alumni;
use App\Models\Alumni_academic;
use App\Models\Alumni_work;
use App\Models\Master_fakultas;
use App\Models\Poll_alumni_kompetensi;
use App\Models\Distribusi_alumni;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(){
        $menu = Auth::user()->access;
		if($menu == "Administrator"){
            return $this->admin();
		}elseif($menu == "Alumni"){
            return $this->alumni();
		}elseif($menu == "Kepala Program Studi"){
            return $this->kaprodi();
		}        
    }
    public function admin()
    {
        { //Jumlah Alumni
            $jumlah_alumni_bar = Master_fakultas::select('master_fakultas.nama','master_fakultas.urutan',DB::raw('count(alumnis.npm) as jumlah_alumni'),DB::raw("COUNT(distribusi_alumnis.status) as jumlah_mengisi"))
                ->leftjoin('alumnis', 'master_fakultas.kode', '=', 'alumnis.fak')
                ->leftjoin('distribusi_alumnis', 'distribusi_alumnis.npm_alumni', '=', DB::raw("alumnis.npm and distribusi_alumnis.status = 'Sudah Mengisi'"))
                ->where('master_fakultas.kode',"!=",'0')
                ->orderBy('kode')
                ->groupBy('urutan')
                ->get();
            $jumlah_alumni_pie = Alumni::select(DB::raw('count(alumnis.npm) as jumlah_alumni'),DB::raw("COUNT(sudah_mengisi.status) as sudah_mengisi"),DB::raw("COUNT(belum_mengisi.status) as belum_mengisi"),DB::raw("COUNT(sedang_mengisi.status) as sedang_mengisi"))
                ->leftjoin('distribusi_alumnis as sudah_mengisi', 'sudah_mengisi.npm_alumni', '=', DB::raw("alumnis.npm and sudah_mengisi.status = 'Sudah Mengisi'"))
                ->leftjoin('distribusi_alumnis as sedang_mengisi', 'sedang_mengisi.npm_alumni', '=', DB::raw("alumnis.npm and sedang_mengisi.status = 'Sedang Mengisi'"))
                ->leftjoin('distribusi_alumnis as belum_mengisi', 'belum_mengisi.npm_alumni', '=', DB::raw("alumnis.npm and belum_mengisi.status = 'Belum Mengisi'"))
                ->first();
        }

        { //jumlah kompetensi
            $jumlah_kompetensi_pt = Poll_alumni_kompetensi::select('pertanyaan.kode','pertanyaan.question as pertanyaan',DB::raw('NULL as jawaban_diri'),DB::raw("AVG(jawaban.option_value) as jawaban_pt"))
                ->leftjoin('questions_details as jawaban', 'poll_alumni_kompetensis.id_jawaban', '=', 
                    DB::raw("CONCAT(jawaban.id, '-PT')"))
                ->leftjoin('questions as pertanyaan','pertanyaan.kode','=','jawaban.kode_questions')
                ->where('poll_alumni_kompetensis.id_jawaban','LIKE','%-PT')
                ->groupBy('pertanyaan.kode');
            
            $jumlah_kompetensi_diri = Poll_alumni_kompetensi::select('pertanyaan.kode','pertanyaan.question as pertanyaan',DB::raw("AVG(jawaban.option_value) as jawaban_diri"),DB::raw("NULL as jawaban_pt"))
                ->leftjoin('questions_details as jawaban', 'poll_alumni_kompetensis.id_jawaban', '=', 
                    DB::raw("CONCAT(jawaban.id, '-DIRI')"))
                ->leftjoin('questions as pertanyaan','pertanyaan.kode','=','jawaban.kode_questions')
                ->where('poll_alumni_kompetensis.id_jawaban','LIKE','%-DIRI')
                ->groupBy('pertanyaan.kode')
                ->union($jumlah_kompetensi_pt);

            $jumlah_kompetensi = DB::query()->fromSub($jumlah_kompetensi_diri, 'tb')
                ->select('tb.kode','tb.pertanyaan',DB::raw("SUM(tb.jawaban_diri) as jawaban_diri"),DB::raw("SUM(tb.jawaban_pt) as jawaban_pt"))
                ->groupBy('tb.kode')
                ->get();
        }

        $data = array (
            'jumlah_alumni_bar' => $jumlah_alumni_bar,
            'jumlah_alumni_pie' => $jumlah_alumni_pie,
            'jumlah_kompetensi' => $jumlah_kompetensi
        );
        
        return \View::make('admin.home')->with($data);
    }
    public function alumni()
    {
        $menu = Auth::user()->access;
		if($menu == "Alumni"){
			$npm = Auth::user()->id;
		}else{
			$npm = 'xxx';
        }
        
        {// profil
            $alumni = Alumni::select('alumnis.name',
                'alumnis.foto',
                'alumnis.birth_place',
                'alumnis.address',
                'alumnis.telp',
                'alumnis.wisuda',
                'alumnis.email',
                'users.email_verified_at',
                'alumnis.fak',
                'alumnis.jur',
                'alumnis.prodi')
                ->leftJoin('users', function($join) {
                    $join->on('alumnis.npm', '=', 'users.id');
                })
                ->where('npm',$npm)
                ->first();	
            $nilai_profil=0;
            if($alumni->name){
                $nilai_profil = $nilai_profil + 1;
            };
            if($alumni->foto){
                $nilai_profil = $nilai_profil + 1;
            };
            if($alumni->birth_place){
                $nilai_profil = $nilai_profil + 1;
            };
            if($alumni->address){
                $nilai_profil = $nilai_profil + 1;
            };
            if($alumni->telp){
                $nilai_profil = $nilai_profil + 1;
            };
            if($alumni->wisuda){
                $nilai_profil = $nilai_profil + 1;
            };
            if($alumni->email){
                $nilai_profil = $nilai_profil + 1;
            };
            if($alumni->email_verified_at){
                $nilai_profil = $nilai_profil + 1;
            };
            if($alumni->fak){
                $nilai_profil = $nilai_profil + 1;
            };
            if($alumni->jur){
                $nilai_profil = $nilai_profil + 1;
            };
            if($alumni->prodi){
                $nilai_profil = $nilai_profil + 1;
            };
        }

		$sekolah = Alumni_academic::select(DB::raw("count(school) as jumlah"))
		    ->where(function($query) use ($npm){
                $query->where('npm', '=', $npm);})
            ->first();

		$pekerjaan 	= Alumni_work::select(DB::raw("count(perusahaan) as jumlah"))
		    ->where(function($query) use ($npm){
                $query->where('npm', '=', $npm);})
            ->first();

        { // Kuesioner
            $angkatan = substr($alumni->wisuda, 0, 4);
            $kodeProdi = $alumni->fak.'-'.$alumni->jur.'-'.$alumni->prodi;
            $status = Distribusi_alumni::select('status_pekerjaan','status_kompetensi','status_ps')
                ->where('npm_alumni',$npm)->first();

            $quest_pekerjaan = Question::select(DB::raw("count(kode_questioner) as jumlah"))
                ->join('distribution_questioners', function($join) {
                    $join->on('distribution_questioners.pekerjaan', '=', 'kode_questioner');})
                ->where('distribution_questioners.tahun',$angkatan)->first();
            $quest_kompetensi = Question::select(DB::raw("count(kode_questioner) as jumlah"))
                ->join('distribution_questioners', function($join) {
                    $join->on('distribution_questioners.kompetensi', '=', 'kode_questioner');})
                ->where('distribution_questioners.tahun',$angkatan)->first();
                
            $quest_ps = Question::select(DB::raw("count(kode_questioner) as jumlah"))
                ->join('distribution_questionerprodis', function($join) {
                    $join->on('distribution_questionerprodis.kode', '=', 'kode_questioner');})
                ->where('distribution_questionerprodis.tahun',$angkatan)
                ->where('distribution_questionerprodis.kode','LIKE',$kodeProdi.'%')->first();
        } //kuesioner
			
			
	    $data = array (
            'persen_profil' => $nilai_profil / 11 * 100,
            'jumlah_pekerjaan' => $pekerjaan->jumlah,
            'jumlah_sekolah' => $sekolah->jumlah,
	    );
        
        return \View::make('alumni.home')->with($data);
    }
    public function kaprodi()
    {
        { //Jumlah Alumni
            $jumlah_alumni_bar = Master_fakultas::select('master_fakultas.nama','master_fakultas.urutan',DB::raw('count(alumnis.npm) as jumlah_alumni'),DB::raw("COUNT(distribusi_alumnis.status) as jumlah_mengisi"))
                ->leftjoin('alumnis', 'master_fakultas.kode', '=', 'alumnis.fak')
                ->leftjoin('distribusi_alumnis', 'distribusi_alumnis.npm_alumni', '=', DB::raw("alumnis.npm and distribusi_alumnis.status = 'Sudah Mengisi'"))
                ->where('master_fakultas.kode',"!=",'0')
                ->orderBy('kode')
                ->groupBy('urutan')
                ->get();
            $jumlah_alumni_pie = Alumni::select(DB::raw('count(alumnis.npm) as jumlah_alumni'),DB::raw("COUNT(sudah_mengisi.status) as sudah_mengisi"),DB::raw("COUNT(belum_mengisi.status) as belum_mengisi"),DB::raw("COUNT(sedang_mengisi.status) as sedang_mengisi"))
                ->leftjoin('distribusi_alumnis as sudah_mengisi', 'sudah_mengisi.npm_alumni', '=', DB::raw("alumnis.npm and sudah_mengisi.status = 'Sudah Mengisi'"))
                ->leftjoin('distribusi_alumnis as sedang_mengisi', 'sedang_mengisi.npm_alumni', '=', DB::raw("alumnis.npm and sedang_mengisi.status = 'Sedang Mengisi'"))
                ->leftjoin('distribusi_alumnis as belum_mengisi', 'belum_mengisi.npm_alumni', '=', DB::raw("alumnis.npm and belum_mengisi.status = 'Belum Mengisi'"))
                ->first();
        }

        { //jumlah kompetensi
            $jumlah_kompetensi_pt = Poll_alumni_kompetensi::select('pertanyaan.kode','pertanyaan.question as pertanyaan',DB::raw('NULL as jawaban_diri'),DB::raw("AVG(jawaban.option_value) as jawaban_pt"))
                ->leftjoin('questions_details as jawaban', 'poll_alumni_kompetensis.id_jawaban', '=', 
                    DB::raw("CONCAT(jawaban.id, '-PT')"))
                ->leftjoin('questions as pertanyaan','pertanyaan.kode','=','jawaban.kode_questions')
                ->where('poll_alumni_kompetensis.id_jawaban','LIKE','%-PT')
                ->groupBy('pertanyaan.kode');
            
            $jumlah_kompetensi_diri = Poll_alumni_kompetensi::select('pertanyaan.kode','pertanyaan.question as pertanyaan',DB::raw("AVG(jawaban.option_value) as jawaban_diri"),DB::raw("NULL as jawaban_pt"))
                ->leftjoin('questions_details as jawaban', 'poll_alumni_kompetensis.id_jawaban', '=', 
                    DB::raw("CONCAT(jawaban.id, '-DIRI')"))
                ->leftjoin('questions as pertanyaan','pertanyaan.kode','=','jawaban.kode_questions')
                ->where('poll_alumni_kompetensis.id_jawaban','LIKE','%-DIRI')
                ->groupBy('pertanyaan.kode')
                ->union($jumlah_kompetensi_pt);

            $jumlah_kompetensi = DB::query()->fromSub($jumlah_kompetensi_diri, 'tb')
                ->select('tb.kode','tb.pertanyaan',DB::raw("SUM(tb.jawaban_diri) as jawaban_diri"),DB::raw("SUM(tb.jawaban_pt) as jawaban_pt"))
                ->groupBy('tb.kode')
                ->get();
        }

        $data = array (
            'jumlah_alumni_bar' => $jumlah_alumni_bar,
            'jumlah_alumni_pie' => $jumlah_alumni_pie,
            'jumlah_kompetensi' => $jumlah_kompetensi
        );
        
        return \View::make('admin.home')->with($data);
    }
}
