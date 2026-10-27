<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spt;
use App\Models\User;
use App\Models\Kelas;
use App\Models\ClassStudent;
use App\Models\Question;
use App\Models\Certificate;
use App\Models\Material;
use DB;
use App\Services\EvaluationService;

class RuangKelasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EvaluationService $evaluationService)
    {
        $this->middleware(['auth','verified']);
        $this->evaluationService = $evaluationService;
    }

    public function index(Request $request, $code)
    {
        $id = auth()->user()->id;
        $kelas = Kelas::with('user')->where('code', $code)->withCount('students')->first();
        if(!$kelas){
            $request->session()->flash('alert-error', 'Kelas tidak ditemukan');
            return redirect()->route('pelajar.index');
        }
        $questions = Question::with('assesments', 'assesments.category', 'spt')->withCount('assesments', 'spt')->where([['class_id', $kelas->id]])->orderBy('end_date', 'desc')->get();
        if($kelas->user->id != $id){
            $cek = ClassStudent::where([['student_id', $id], ['class_id', $kelas->id]])->first();
            if(!$cek){
                $request->session()->flash('alert-error', 'Kelas tidak ditemukan');
                return redirect()->route('pelajar.index');
            }
        }
        return view('user.feed.index',[
            'kelas' => $kelas,
            'questions' => $questions,
        ]);
    }

    public function leaderboard(Request $request, $code)
    {
        $id = auth()->user()->id;
        $kelas = Kelas::with('user')->where('code', $code)->withCount('students')->first();
        if(!$kelas){
            $request->session()->flash('alert-error', 'Kelas tidak ditemukan');
            return redirect()->route('pelajar.index');
        }
        $questions = Question::with('spt', 'spt.user')->withCount('spt')->where([['class_id', $kelas->id],['status', 'Show']])->orderBy('end_date', 'desc')->get();
        if($kelas->user->id != $id){
            $cek = ClassStudent::where([['student_id', $id], ['class_id', $kelas->id]])->first();
            if(!$cek){
                $request->session()->flash('alert-error', 'Kelas tidak ditemukan');
                return redirect()->route('pelajar.index');
            }
        }
        return view('user.feed.leaderboard',[
            'kelas' => $kelas,
            'questions' => $questions,
        ]);
    }

    public function leaderboardShow(Request $request, $code, $id)
    {
        $user_id = auth()->user()->id;
        $kelas = Kelas::with('user')->where('code', $code)->withCount('students')->first();
        if(!$kelas){
            $request->session()->flash('alert-error', 'Kelas tidak ditemukan');
            return redirect()->route('pelajar.index');
        }
        $questions = Question::where('class_id', $kelas->id)->count();
        $question = Question::with('spt', 'spt.user')->where('id', $id)->first();
        if($kelas->user->id != $user_id){
            $cek = ClassStudent::where([['student_id', $user_id], ['class_id', $kelas->id]])->first();
            if(!$cek){
                $request->session()->flash('alert-error', 'Kelas tidak ditemukan');
                return redirect()->route('pelajar.index');
            }
        }
        return view('user.feed.leaderboard_show',[
            'kelas' => $kelas,
            'question' => $question,
            'questions' => $questions,
        ]);
    }

    public function winner(Request $request, $code)
    {
        $kelas = Kelas::with('user')->where('code', $code)->withCount('students')->first();
        if(!$kelas){
            $request->session()->flash('alert-error', 'Kelas tidak ditemukan');
            return redirect()->route('pelajar.index');
        }

        $student=array();
        foreach($kelas->students as $key){
            $arrayuser=array();
            array_push($student, $this->get_value($key->student_id, $key->student->name, $arrayuser, $kelas->id));
        }
        $temp = array();
        foreach ($student as $item){
            foreach ($item as $item2){
                $temp[] = $item2;
            }
        }
        $array = collect($temp)->sortBy('time')->sortBy('nilai')->reverse()->toArray();
        $questions = Question::where('class_id', $kelas->id)->count();

        return view('user.feed.winner',[
            'kelas' => $kelas,
            'student' => $array,
            'questions' => $questions,
        ]);
    }

    public function get_value($student_id, $student_name, $arrayuser, $kelas_id)
    {
        $questions = Question::where('class_id', $kelas_id)->orderBy('start_date', 'asc')->get();
        $nilai = 0; $time = 0;
        foreach ($questions as $item){
            $times = Spt::where('question_id', $item->id)->sum('second');
            $spt = Spt::where([['user_id', $student_id], ['question_id', $item->id]])->first();
            if($spt){
                $nilai += $spt->nilai * $item->weight / 100;

                $time += ($times==0 || $spt->second==0) ? 0 : (($times/$spt->second) * ($item->weight)) / 100;
            }
        }
        $indukarray=array("id"=>$student_id,"nama"=>$student_name,"nilai"=>$nilai,"time"=>$time);
        array_push($arrayuser,$indukarray);

        return $arrayuser;
    }

    public function question(Request $request, $code)
    {
        $this->validate($request,[
            'spt' => 'required',
            'question_id' => 'required',
        ]);

        $kelas = Kelas::where('code', $code)->first();
        if($kelas){
            $question = Question::findOrFail($request->question_id);
            $spt = Spt::findOrFail($request->spt);
            $spt->question_id = $question->id;
            $spt->save();

            $this->evaluationService->evaluation($request->spt);
            $request->session()->flash('alert-success', 'Penugasan Berhasil Disubmit');
            return redirect()->back();
        }else{
            $request->session()->flash('alert-error', 'Penugasan tidak ditemukan');
            return redirect()->back();
        }
    }

    public function achievement(Request $request, $code)
    {
        $id = auth()->user()->id;
        $kelas = Kelas::with('user')->where('code', $code)->withCount('students')->first();
        if(!$kelas){
            $request->session()->flash('alert-error', 'Kelas tidak ditemukan');
            return redirect()->route('pelajar.index');
        }
        $questions = Question::with('assesments', 'assesments.category', 'spt')->withCount('assesments', 'spt')->where('class_id', $kelas->id)->orderBy('end_date', 'desc')->get();
        $sertifikat = Certificate::where([['user_id', $id], ['visibility', 'public']])->get();
        return view('user.feed.achievement',[
            'kelas' => $kelas,
            'sertifikat' => $sertifikat,
            'questions' => $questions,
        ]);
    }

    public function list(Request $request, $code, $type)
    {
        $id = auth()->user()->id;
        if($type=='spt'){
            $data = Spt::select(DB::raw("CONCAT('SPT ',form_code,' Tahun ',year,'/',start_period,'-',end_period,' Pembetulan ke-' ,correction_to) AS name"), 'id')
                ->where([['user_id', $id], ['send_flag', 2], ['form_code', $request->form_code]])
                ->whereNull('question_id')
                ->orderBy('year', 'desc')->orderBy('form_code', 'desc')->orderBy('correction_to')->orderBy('id', 'desc')
                ->pluck('name', 'id');
            return response()->json($data);
        }elseif ($type=='question'){
            $now = date('Y-m-d H:i:s');
            $kelas = Kelas::where('code', $code)->first();
            $spt = Spt::where('user_id', $id)->whereNotNull('question_id')->pluck('question_id')->all();
            $data = Question::select(DB::raw("CONCAT(type,' - ',description) AS type"), 'id')
                ->where([['class_id', $kelas->id], ['start_date', '<=', $now], ['end_date', '>=', $now], ['status', 'Show']])->whereNotIn('id', $spt)->pluck('type', 'id');
            return response()->json($data);
        }
    }

    public function material(Request $request, $code)
    {
        $kelas = Kelas::with('user')->where('code', $code)->withCount('students')->first();
        if(!$kelas){
            $request->session()->flash('alert-error', 'Kelas tidak ditemukan');
            return redirect()->route('pelajar.index');
        }
        $questions = Question::with('assesments', 'assesments.category', 'spt')->withCount('assesments', 'spt')->where('class_id', $kelas->id)->orderBy('end_date', 'desc')->get();
        $materials = Material::where([['class_id', $kelas->id], ['status', 'Show']])->orderBy('created_at')->get();
        return view('user.feed.material',[
            'kelas' => $kelas,
            'questions' => $questions,
            'materials' => $materials,
        ]);
    }
}