<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spt;
use App\Models\AcademyCategory;
use App\Models\Certificate;
use App\Models\CertificateSign;
use App\Models\CertificateDesign;
use App\Models\Kelas;
use App\Models\ClassStudent;
use App\Models\Question;
use App\Models\Assesment;
use App\Models\AssesmentCategory;
use App\Models\AssesmentForm;
use App\Models\AssesmentOption;
use App\Models\User;
use App\Models\Spt17704a;
use App\Models\Spt17704b;
use App\Models\Spt17704c;
use App\Models\Spt17703a;
use App\Models\Spt17703b;
use App\Models\Spt17702a;
use App\Models\Spt17701a;
use App\Models\Spt17701b;
use App\Models\Spt17701c;
use App\Models\Spt17701d;
use App\Models\Spt1770induk;
use App\Models\Spt1771setor;
use App\Models\Spt1771lampkhus2a;
use App\Models\Spt1771lampkhus1;
use App\Models\Spt1771lampkhus1a;
use App\Models\Spt1771lampiran6a;
use App\Models\Spt1771lampiran6bc;
use App\Models\Spt1771lampiran5a;
use App\Models\Spt1771lampiran5b;
use App\Models\Spt1771lampiran4a;
use App\Models\Spt1771lampiran4alain;
use App\Models\Spt1771lampiran4b;
use App\Models\Spt1771lampiran4blain;
use App\Models\Spt1771lampiran3a;
use App\Models\Spt1771lampiran2;
use App\Models\Spt1771lampiran1;
use App\Models\Spt1771induk;
use App\Models\PphDoc;
use App\Models\PphIncome;
use App\Models\PphFinal;
use App\Models\BupotBill;
use App\Models\InvoiceOutput;
use App\Models\InvoiceInput;
use App\Models\OtherOutput;
use App\Models\OtherInput;
use App\Models\ReturOutput;
use App\Models\ReturInput;
use App\Models\Bupot;
use App\Models\BupotCopy;
use App\Models\BupotDeposit;
use App\Models\Material;
use Illuminate\Support\Str;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use DB;

class TeacherController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:pengajar,co-pengajar,prodi']);
    }

    public function index() {
        if(auth()->user()->hasRole('pengajar')){
            $kelas = Kelas::with('co:id,name')->where('user_id', auth()->user()->id)->count();
            $kelas_id = Kelas::where('user_id', auth()->user()->id)->pluck('id')->all();
        }else{
            $kelas = Kelas::with('co:id,name')->where('co_id', auth()->user()->id)->count();
            $kelas_id = Kelas::where('co_id', auth()->user()->id)->pluck('id')->all();
        }
        $student = ClassStudent::whereIn('class_id', $kelas_id)->count();
        $question = Question::whereIn('class_id', $kelas_id)->count();
        $question_id = Question::whereIn('class_id', $kelas_id)->pluck('id')->all();
        $assesment = Assesment::whereIn('question_id', $question_id)->count();

        return view('pengajar.index',[
            'kelas' => $kelas,
            'student' => $student,
            'question' => $question,
            'assesment' => $assesment,
        ]);
    }

    public function kelas(){
        if(auth()->user()->hasRole('pengajar')) {
            $kelas = Kelas::where('user_id', auth()->user()->id)->with('co:id,name')->withCount('students','questions','materials')->orderBy('created_at', 'desc')->get();
        }else{
            $kelas = Kelas::where('co_id', auth()->user()->id)->with('co:id,name')->withCount('students','questions','materials')->orderBy('created_at', 'desc')->get();
        }
        $co = User::whereHas('roles', function ($query){
            $query->where('roles.name', 'co-pengajar');
        })->where('institution_code', auth()->user()->institution_code)->get();
        return view('pengajar.kelas', [
            'data' => $kelas,
            'co' => $co,
        ]);
    }

    public function kelasChampion(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->champion = ($kelas->champion=='Show') ? 'Hide' : 'Show';
        $kelas->save();

        $request->session()->flash('alert-success', 'Kelas Champion berhasil diubah');
        return redirect()->back();
    }

    public function kelasDetail($id){
        $kelas = Kelas::with('co:id,name')->findOrFail($id);
        $students = ClassStudent::with('student:id,name,email')->where('class_id', $id)->orderBy('nim')->get();
        $questions = Question::with('form')->withCount('assesments', 'spt')->where('class_id', $id)->get();
        $materials = Material::where('class_id', $id)->orderBy('created_at')->get();

        return view('pengajar.kelas_detail', [
            'kelas' => $kelas,
            'students' => $students,
            'questions' => $questions,
            'materials' => $materials,
        ]);
    }

    public function kelasDuplicate(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);
        $new = $kelas->replicate();
        $new->name = $kelas->name." Copy";
        $new->code = $this->generateUniqueCode();
        $new->save();

        $question = Question::where('class_id', $id)->with('assesments')->get();
        $ins_assesment = array();
        foreach ($question as $item){
            $newq = $item->replicate();
            $newq->class_id = $new->id;
            $newq->save();
            if(count($item->assesments)){
                foreach ($item->assesments as $key){
                    $ins_assesment[] = [
                        'question_id' => $newq->id,
                        'category_id' => $key->category_id,
                        'option_id' => $key->option_id,
                        'answer' => $key->answer,
                        'weight' => $key->weight,
                    ];
                }
            }
        }
        Assesment::insert($ins_assesment);

        $materials = Material::where('class_id', $id)->get();
        foreach ($materials as $item) {
            $newq = $item->replicate();
            $newq->class_id = $new->id;
            $newq->status = 'Hide';
            $newq->save();
        }

        $request->session()->flash('alert-success', 'Kelas Berhasil berhasil diduplikat');
        return redirect()->back();
    }

    public function kelasCode(Request $request, $id){
        $kelas = Kelas::findOrFail($id);
        if(count($kelas->students)){
            $request->session()->flash('alert-danger', 'Kode Kelas tidak dapat diubah karena masih memiliki pelajar');
            return redirect()->back();
        }
        $kelas->code = $this->generateUniqueCode();
        $kelas->save();

        $request->session()->flash('alert-success', 'Kode Kelas berhasil diubah');
        return redirect()->back();
    }

    public function kelasStore(Request $request){
        $this->validate($request,[
            'name' => 'required',
        ]);

        $kelas = new Kelas;
        $kelas->name = $request->name;
        $kelas->code = $this->generateUniqueCode();
        $kelas->co_id = $request->co_id;
        $kelas->user_id = auth()->user()->id;
        $kelas->save();

        $request->session()->flash('alert-success', 'Kelas berhasil dibuat');
        return redirect()->back();
    }

    public function kelasEdit($id){
        $kelas = Kelas::findOrFail($id);

	    return response()->json([
	      'data' => $kelas,
	    ]);
    }

    public function kelasUpdate(Request $request, $id){
        $this->validate($request,[
            'name' => 'required',
        ]);
        
        $kelas = Kelas::findOrFail($id);
        $kelas->name = $request->name;
        $kelas->co_id = $request->co_id;
        $kelas->save();

        $request->session()->flash('alert-success', 'Kelas berhasil diedit');
        return redirect()->back();
    }

    public function kelasDestroy(Request $request, $id){
        $kelas = Kelas::withCount('students')->findOrFail($id);
        if($kelas->students_count > 0){
            $request->session()->flash('alert-danger', 'Kelas tidak dapat dihapus karena sudah ada pelajar');
            return redirect()->back();
        }
        $kelas->delete();

        $request->session()->flash('alert-success', 'Kelas berhasil dihapus');
        return redirect()->back();
    }

    public function kelasStudentEnrolle($id){
        //get students already enrolled
        $students_enrolled = ClassStudent::where('class_id', $id)->pluck('student_id')->all();

        //get students
        $students = User::whereHas('roles', function ($query){
            $query->where('roles.name', 'pelajar');
        })->whereNotIn('id', $students_enrolled)->get();

        return view('pengajar.student_enrolle', [
            'class_id' => $id,
            'students' => $students,
        ]);
    }

    public function kelasStudentStore(Request $request, $id){
        $request->validate([
            'student_id'    => 'required',
        ]);

        //create exam_group
        foreach($request->student_id as $student_id) {
            ClassStudent::create([
                'class_id'         => $id,
                'student_id'      => $student_id,
            ]);
        }

        //redirect
        $request->session()->flash('alert-info', 'Pelajar berhasil ditambahkan');
        return redirect()->route('pengajar.kelas.detail', $id);
    }

    public function kelasStudentDestroy(Request $request){
        $request->validate([
            'id' => 'required',
        ]);

        $class = ClassStudent::whereIn('id', $request->id)->with('kelas.questions')->get();
        foreach ($class as $item){
            if(count($item->kelas->questions)){
                foreach ($item->kelas->questions as $key){
                    Spt::where([['user_id', $item->student_id],['question_id', $key->id]])->update(array('question_id' => null, 'nilai' => null, 'second' => null));
                }
            }
        }
        ClassStudent::whereIn('id', $request->id)->delete();
        //redirect
        $request->session()->flash('alert-info', 'Pelajar berhasil dihapus');
        return redirect()->back();
    }

    public function soalCreate($id)
    {
        $forms = AssesmentForm::all();

        return view('pengajar.soal.tambah', [
            'class_id' => $id,
            'forms' => $forms,
        ]);
    }

    public function soalStore(Request $request, $id)
    {
        $request->validate([
            'form_id' => 'required',
            'question' => 'required',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'weight' => 'required',
        ]);

        Question::create([
            'class_id' => $id,
            'form_id' => $request->form_id,
            'question' => $request->question,
            'type' => $request->type,
            'weight' => $request->weight,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
        ]);

        $request->session()->flash('alert-info', 'Soal berhasil ditambahkan');
        return redirect()->route('pengajar.kelas.detail', $id);
    }

    public function soalTemplate($id)
    {
        $templates = Question::with('form:id,name')
            ->where('class_id', '5a7c2e6b-ed6b-4314-af04-4d006f296b73')
            ->orderBy('form_id')
            ->get();

        return view('pengajar.soal.template', [
            'class_id' => $id,
            'templates' => $templates,
        ]);
    }

    public function template($id)
    {
        $data = Question::with('assesments', 'assesments.category')->findOrFail($id);
        return response()->json([
            "status"=>"success",
            "data"=> $data,
        ]);
    }

    public function soalTemplateStore(Request $request, $id)
    {
        $request->validate([
            'template_id' => 'required',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'weight' => 'required',
        ]);

        $question = Question::with('assesments')->findOrFail($request->template_id);
        $ins_assesment = array();

        $newq = $question->replicate();
        $newq->class_id = $id;
        $newq->type = $request->type;
        $newq->weight = $request->weight;
        $newq->start_date = $request->start_date;
        $newq->end_date = $request->end_date;
        $newq->description = $request->description;

        $newq->save();
        if(count($question->assesments)){
            foreach ($question->assesments as $key){
                $ins_assesment[] = [
                    'question_id' => $newq->id,
                    'category_id' => $key->category_id,
                    'option_id' => $key->option_id,
                    'answer' => $key->answer,
                    'weight' => $key->weight,
                ];
            }
        }
        Assesment::insert($ins_assesment);

        $request->session()->flash('alert-info', 'Soal berhasil ditambahkan');
        return redirect()->route('pengajar.kelas.detail', $id);

    }

    public function soalEdit($kelas_id, $id)
    {
        $forms = AssesmentForm::all();
        $question = Question::findOrFail($id);
        return view('pengajar.soal.edit', [
            'class_id' => $kelas_id,
            'forms' => $forms,
            'question' => $question,
        ]);
    }

    public function soalUpdate(Request $request, $kelas_id, $id)
    {
        $request->validate([
            'form_id' => 'required',
            'question' => 'required',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'weight' => 'required',
        ]);

        $question = Question::findOrFail($id);
        $question->update([
            'class_id' => $kelas_id,
            'form_id' => $request->form_id,
            'question' => $request->question,
            'type' => $request->type,
            'weight' => $request->weight,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
        ]);

        $request->session()->flash('alert-info', 'Soal berhasil diedit');
        return redirect()->route('pengajar.kelas.detail', $kelas_id);
    }

    public function soalDetail(Request $request, $kelas_id, $question_id){
        $kelas = Kelas::findOrFail($kelas_id);
        $question = Question::with('spt', 'assesments', 'assesments.category')->findOrFail($question_id);

        return view('pengajar.soal.detail', [
            'kelas' => $kelas,
            'question' => $question,
        ]);
    }

    public function soalDestroy(Request $request, $kelas_id, $id)
    {
        $question = Question::where('id', $id)->withCount('spt')->first();
        if($question->spt_count > 0){
            $request->session()->flash('alert-danger', 'Soal tidak dapat dihapus karena sudah ada pelajar yg submit');
            return redirect()->route('pengajar.kelas.detail', $kelas_id);
        }
        $question->delete();
        Assesment::where('question_id', $question->id)->delete();

        $request->session()->flash('alert-success', 'Soal berhasil dihapus');
        return redirect()->route('pengajar.kelas.detail', $kelas_id);
    }

    public function soalStatus(Request $request, $kelas_id, $id)
    {
        $question = Question::findOrFail($id);
        $question->status = ($question->status=='Show') ? 'Hide' : 'Show';
        $question->save();

        $request->session()->flash('alert-success', 'Status Soal berhasil diubah');
        return redirect()->route('pengajar.kelas.detail', $kelas_id);
    }

    public function penilaianCreate($id)
    {
        $question = Question::findOrFail($id);
        $categories = AssesmentCategory::where('form_id', $question->form_id)->orWhereNull('form_id')->get();

        return view('pengajar.penilaian.tambah', [
            'question' => $question,
            'categories' => $categories,
        ]);
    }

    public function penilaianStore(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'weight' => 'required',
        ]);

        $question = Question::findOrFail($id);
        $option = (!empty($request->option)) ? $request->option : null;
        if($option!=null){
            $opt = AssesmentOption::findOrFail($option);
            $answer = $opt->name;
        }else{
            $answer = $request->answer;
        }

        Assesment::create([
            'question_id' => $question->id,
            'category_id' => $request->category_id,
            'option_id' => $option,
            'answer' => $answer,
            'weight' => $request->weight,
        ]);

        $request->session()->flash('alert-info', 'Penilaian berhasil ditambahkan');
        return redirect()->route('pengajar.soal.detail', ['kelas_id'=>$question->class_id, 'id'=>$question->id]);
    }

    public function penilaianEdit($soal_id, $id)
    {
        $question = Question::findOrFail($soal_id);
        $categories = AssesmentCategory::where('form_id', $question->form_id)->orWhereNull('form_id')->get();
        $assesment = Assesment::findOrFail($id);

        return view('pengajar.penilaian.edit', [
            'question' => $question,
            'categories' => $categories,
            'assesment' => $assesment,
        ]);
    }

    public function penilaianUpdate(Request $request, $soal_id, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'weight' => 'required',
        ]);

        $question = Question::findOrFail($soal_id);
        $option = (!empty($request->option)) ? $request->option : null;
        if($option!=null){
            $opt = AssesmentOption::findOrFail($option);
            $answer = $opt->name;
        }else{
            $answer = $request->answer;
        }

        $assesment = Assesment::findOrFail($id);
        $assesment->update([
            'question_id' => $question->id,
            'category_id' => $request->category_id,
            'option_id' => $option,
            'answer' => $answer,
            'weight' => $request->weight,
        ]);

        $request->session()->flash('alert-info', 'Penilaian berhasil diedit');
        return redirect()->route('pengajar.soal.detail', ['kelas_id'=>$question->class_id, 'id'=>$question->id]);
    }

    public function penilaianDestroy(Request $request, $question_id, $id)
    {
        Assesment::findOrFail($id)->delete();
        $request->session()->flash('alert-info', 'Penilaian berhasil dihapus');
        return redirect()->back();
    }

    public function penilaianPelajarDestroy(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        Spt::whereIn('id', $request->id)->update(array('question_id' => null, 'nilai' => null, 'second' => null));
        $request->session()->flash('alert-info', 'Nilai Pelajar berhasil dihapus');
        return redirect()->back();
    }

    public function penilaianList(Request $request)
    {
        $categories = AssesmentCategory::findOrFail($request->id);
        $options = '';
        if($categories->option_code!=''){
            $code = 1;
            $options = AssesmentOption::where('code', $categories->option_code)->pluck('name', 'id');
        }else{
            $code = 2;
        }
        return response()->json([
            "status"=>"success",
            "code"=> $code,
            "data"=> $options,
        ]);
    }

    public function generateUniqueCode()
    {

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 6;

        $code = '';

        while (strlen($code) < 6) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }

        if (Kelas::where('code', $code)->exists()) {
            $this->generateUniqueCode();
        }

        return $code;

    }

    public function pelajarDetail($id){
        $pelajar = User::findOrFail($id);
        $spt = Spt::where('user_id', $id)->orderBy('form_code', 'desc')->orderBy('year', 'desc')->orderBy('start_period', 'desc')->get();
        $invoice['keluaran'] = InvoiceOutput::where('user_id', $id)->orderBy('invoice_year', 'desc')->orderBy('invoice_period', 'desc')->orderBy('invoice_no', 'asc')->get();
        $invoice['masukan'] = InvoiceInput::where('user_id', $id)->orderBy('invoice_year', 'desc')->orderBy('invoice_period', 'desc')->orderBy('invoice_no', 'asc')->get();
        $other['keluaran'] = OtherOutput::where('user_id', $id)->orderBy('other_year', 'desc')->orderBy('other_period', 'desc')->orderBy('other_no', 'asc')->get();
        $other['masukan'] = OtherInput::where('user_id', $id)->orderBy('other_year', 'desc')->orderBy('other_period', 'desc')->orderBy('other_no', 'asc')->get();
        $retur['keluaran'] = ReturOutput::with('invoice')->where('user_id', $id)->orderBy('retur_year', 'desc')->orderBy('retur_period', 'desc')->orderBy('retur_no', 'asc')->get();
        $retur['masukan'] = ReturInput::with('invoice')->where('user_id', $id)->orderBy('retur_year', 'desc')->orderBy('retur_period', 'desc')->orderBy('retur_no', 'asc')->get();
        $bupot = Bupot::where('npwpPemotong', $pelajar->npwp)->orderBy('thnPajak', 'desc')->orderBy('msPajak', 'desc')->orderBy('noBupot', 'asc')->get();
        $kelas = ClassStudent::where('student_id', $id)->first();

        return view('pengajar.pelajar_detail', [
            'pelajar' => $pelajar,
            'spt' => $spt,
            'kelas' => $kelas,
            'invoice' => $invoice,
            'other' => $other,
            'retur' => $retur,
            'bupot' => $bupot,
        ]);
    }

    public function pelajarDestroy(Request $request, $type, $id){
        if($type=='spt'){
            $spt = Spt::findOrFail($id);
            if($spt->form_code=='PPH21'){
                PphIncome::where('spt_id', $id)->delete();
                PphFinal::where('spt_id', $id)->delete();
                PphDoc::where('spt_id', $id)->delete();
                BupotBill::where('spt_id', $id)->delete();
            }
            $spt->delete();
        }elseif($type=="keluaran"){
            InvoiceOutput::findOrFail($id)->delete();
        }elseif($type=="masukan"){
            InvoiceInput::findOrFail($id)->delete();
        }elseif($type=="dok-keluaran"){
            OtherOutput::findOrFail($id)->delete();
        }elseif($type=="dok-masukan"){
            OtherInput::findOrFail($id)->delete();
        }elseif($type=="retur-keluaran"){
            ReturOutput::findOrFail($id)->delete();
        }elseif($type=="retur-masukan"){
            ReturInput::findOrFail($id)->delete();
        }elseif($type=="bupot"){
            Bupot::findOrFail($id)->delete();
        }

        $request->session()->flash('alert-info', 'Data Berhasil Dihapus');
        return redirect()->back();
    }

    public function pelajarSpt(Request $request, $spt_id){
        $spt = Spt::where([['id', $spt_id]])->first();
        if($spt){
            if($spt->form_code=='PPH21'){
                $tidak = PphDoc::where('spt_id', $spt_id)
                    ->whereHas('object', function ($query){
                        $query->whereIn('kdBupot', array('4','5'));
                    })->orderBy('kdObjPjk')->get();
                $final = PphDoc::where('spt_id', $spt_id)
                    ->whereHas('object', function ($query){
                        $query->where('kdBupot', '6');
                    })->orderBy('kdObjPjk')->get();
                return view('pengajar.spt.preview'.$spt->form_code, [
                    'spt'=>$spt,
                    'tidak' => $tidak,
                    'final' => $final,
                ]);
            }elseif($spt->form_code=='PPHUNI'){
                $bupot = BupotCopy::where('spt_id', $spt->id)->get();
                $deposit = BupotDeposit::where('spt_id', $spt->id)->get();
                return view('pengajar.spt.preview'.$spt->form_code, [
                    "data"=>$spt,
                    "bupot"=>$bupot,
                    "deposit"=>$deposit,
                ]);
            }
            return view('pengajar.spt.preview'.$spt->form_code, [
                'spt'=>$spt
            ]);
        }else{
            $request->session()->flash('alert-danger', 'SPT Tidak Ditemukan');
            return redirect()->back();
        }
    }

    public function pelajarEform(Request $request, $id){
        $spt = Spt::findOrFail($id);
        if($spt->form_code=='1771'){
            $induk = Spt1771induk::where([['spt_id', $id]])->first();
            if($request->type=='submit'){
                $bayar = Spt1771setor::where('spt_id', $id)->sum('bayar');
                return view('pengajar.spt.1771.submit',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'bayar' => $bayar,
                ]);
            }elseif($request->type=='lampkhus2a'){
                $lampkhus2a = Spt1771lampkhus2a::where([['spt_id', $id]])->first();
                return view('pengajar.spt.1771.lampkhus2a',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampkhus2a' => $lampkhus2a,
                ]);
            }elseif($request->type=='lampkhus1a'){
                $penyusutan = Spt1771lampkhus1::where([['jenis_fiskal', 'penyusutan'],['spt_id', $id]])->first();
                $amortisasi = Spt1771lampkhus1::where([['jenis_fiskal', 'amortisasi'],['spt_id', $id]])->first();
                return view('pengajar.spt.1771.lampkhus1a',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'penyusutan' => $penyusutan,
                    'amortisasi' => $amortisasi,
                ]);
            }elseif($request->type=='lampiran6'){
                return view('pengajar.spt.1771.lampiran6',[
                    'spt' => $spt,
                    'induk' => $induk,
                ]);
            }elseif($request->type=='lampiran5'){
                return view('pengajar.spt.1771.lampiran5',[
                    'spt' => $spt,
                    'induk' => $induk,
                ]);
            }elseif($request->type=='lampiran4'){
                $lampiran4a = Spt1771lampiran4a::where([['spt_id', $id]])->first();
                $lampiran4b = Spt1771lampiran4b::where([['spt_id', $id]])->first();
                $pph = Spt1771lampiran4alain::where('spt_id', $id)->sum('terutang');
                $penghasilan = Spt1771lampiran4blain::where('spt_id', $id)->sum('penghasilan');
                return view('pengajar.spt.1771.lampiran4',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran4a' => $lampiran4a,
                    'lampiran4b' => $lampiran4b,
                    'pph' => $pph,
                    'penghasilan' => $penghasilan,
                ]);
            }elseif($request->type=='lampiran3'){
                return view('pengajar.spt.1771.lampiran3',[
                    'spt' => $spt,
                    'induk' => $induk,
                ]);
            }elseif($request->type=='lampiran2'){
                $lampiran2 = Spt1771lampiran2::where([['spt_id', $id]])->first();
                return view('pengajar.spt.1771.lampiran2',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran2' => $lampiran2,
                ]);
            }elseif($request->type=='lampiran1'){
                $lampiran1 = Spt1771lampiran1::where([['spt_id', $id]])->first();
                $lampiran2 = Spt1771lampiran2::where([['spt_id', $id]])->first();
                $penyusutan = Spt1771lampkhus1::where([['jenis_fiskal', 'penyusutan'], ['spt_id', $id]])->first();
                $amortisasi = Spt1771lampkhus1::where([['jenis_fiskal', 'amortisasi'], ['spt_id', $id]])->first();
                return view('pengajar.spt.1771.lampiran1',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran1' => $lampiran1,
                    'lampiran2' => $lampiran2,
                    'penyusutan' => $penyusutan,
                    'amortisasi' => $amortisasi,
                ]);
            }elseif($request->type=='lanjutan'){
                $lampiran4a = Spt1771lampiran4a::where([['spt_id', $id]])->first();
                $lampiran4b = Spt1771lampiran4b::where([['spt_id', $id]])->first();
                $lampkhus2a = Spt1771lampkhus2a::where([['spt_id', $id]])->first();
                return view('pengajar.spt.1771.induk_lanjutan',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran4a' => $lampiran4a,
                    'lampiran4b' => $lampiran4b,
                    'lampkhus2a' => $lampkhus2a,
                ]);
            }else{
                $lampiran1 = Spt1771lampiran1::where([['spt_id', $id]])->first();
                $pph_potput = Spt1771lampiran3a::where('spt_id', $id)->sum('pph');
                $lampkhus2a = Spt1771lampkhus2a::where([['spt_id', $id]])->first();
                return view('pengajar.spt.1771.induk',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran1' => $lampiran1,
                    'pph_potput' => $pph_potput,
                    'lampkhus2a' => $lampkhus2a,
                ]);
            }
        }elseif($spt->form_code=='1770'){
            $induk = Spt1770induk::where([['spt_id', $id]])->first();
            if($request->type=='submit'){
                $bayar = Spt1771setor::where('spt_id', $id)->sum('bayar');
                return view('pengajar.spt.1770.submit',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'bayar' => $bayar,
                ]);
            }elseif($request->type=='lampiran3'){
                $lampiran3a = Spt17703a::where([['spt_id', $id]])->first();
                $lampiran3b = Spt17703b::where([['spt_id', $id]])->first();
                return view('pengajar.spt.1770.lampiran3',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran3a' => $lampiran3a,
                    'lampiran3b' => $lampiran3b,
                ]);
            }elseif($request->type=='lampiran2'){
                return view('pengajar.spt.1770.lampiran2',[
                    'spt' => $spt,
                    'induk' => $induk,
                ]);
            }elseif($request->type=='lampiran1'){
                $lampiran1 = Spt17701a::where([['spt_id', $id]])->first();
                return view('pengajar.spt.1770.lampiran1',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran1' => $lampiran1,
                ]);
            }elseif($request->type=='lanjutan'){
                $lampiran1b = Spt17701b::where([['spt_id', $id]])->first();
                $lampiran1d = Spt17701d::where([['spt_id', $id]])->first();
                return view('pengajar.spt.1770.lanjutan',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran1b' => $lampiran1b,
                    'lampiran1d' => $lampiran1d,
                ]);
            }elseif ($request->type=='induk') {
                $lampiran1a = Spt17701a::where([['spt_id', $id]])->first();
                $lampiran1b = Spt17701b::where([['spt_id', $id]])->first();
                $lampiran1c = Spt17701c::where('spt_id', $id)->sum('neto');
                $lampiran1d = Spt17701d::where([['spt_id', $id]])->first();
                $lampiran2a = Spt17702a::where('spt_id', $id)->sum('pph');
                return view('pengajar.spt.1770.induk',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran1a' => $lampiran1a,
                    'lampiran1b' => $lampiran1b,
                    'lampiran1c' => $lampiran1c,
                    'lampiran1d' => $lampiran1d,
                    'lampiran2a' => $lampiran2a,
                ]);
            }else{
                return view('pengajar.spt.1770.lampiran4',[
                    'spt' => $spt,
                    'induk' => $induk,
                ]);
            }
        }else{
            $request->session()->flash('alert-danger', 'Eform Tidak Ditemukan');
            return redirect()->back();
        }
    }

    public function pelajarNilai(Request $request, $spt_id){
        $spt = Spt::where([['id', $spt_id]])->first();
        if($spt){
            $spt->nilai = $request->nilai;
            $spt->jenis_nilai = $request->jenis;
            $spt->save();
            $request->session()->flash('alert-info', 'SPT Berhasil Dinilai');
            return redirect()->back();
        }else{
            $request->session()->flash('alert-danger', 'SPT Tidak Ditemukan');
            return redirect()->back();
        }
    }

    public function sertifikat($id){
        $kelas = Kelas::findOrFail($id);
        $students = ClassStudent::with('student')->where('class_id', $id)->orderBy('nim')->get();

        return view('pengajar.sertifikat_index', [
            'kelas' => $kelas,
            'students' => $students,
        ]);
    }

    public function sertifikatCreate($id){
        $kelas = Kelas::findOrFail($id);
        $students = ClassStudent::with('student', 'student.certificates')->where('class_id', $id)->orderBy('nim')->get();
        $sign = CertificateSign::all();
        $design = CertificateDesign::all();

        return view('pengajar.sertifikat_tambah', [
            'kelas' => $kelas,
            'students' => $students,
            'sign' => $sign,
            'design' => $design,
        ]);
    }

    public function sertifikatStore(Request $request, $id){
        $request->validate([
            'student_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'design_id' => 'required',
            'sign_id' => 'required',
            'date' => 'required',
        ]);

        //create exam_group
        $year = date('Y');
        $max = Certificate::whereYear('created_at', $year)->orderBy('no', 'DESC')->first();
        $no = ($max) ? $max->no + 1 : 1;
        foreach($request->student_id as $student_id) {
            $str = 'RTND-'.date('y').strtoupper(Str::random(6));
            $data[] = [
                'user_id' => $student_id,
                'design_id' => $request->design_id,
                'sign_id' => $request->sign_id,
                'name' => $request->name,
                'description' => $request->description,
                'date' => $request->date,
                'code' => $str,
                'no' => $no++,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
        Certificate::insert($data);

        //redirect
        $request->session()->flash('alert-info', 'Sertifikat berhasil ditambahkan');
        return redirect()->route('pengajar.certificate', $id);
    }

    public function masukanStore(Request $request)
    {
//        dd($request->class_id);
        $this->validate($request,[
            'class_id' => 'required',
            'invoice_no' => 'required',
            'invoice_date' => 'required',
            'invoice_period' => 'required',
            'invoice_year' => 'required',
            'customer_id' => 'required',
            'customer_name' => 'required',
            'customer_address' => 'required',
            'credit' => 'required',
            'dpp' => 'required',
            'ppn' => 'required',
            'ppnbm' => 'required',
        ]);

        $students = ClassStudent::with('student:id,name,email')->whereIn('class_id', $request->class_id)->orderBy('nim')->get();
        $code = substr($request->invoice_no,0,5);
        $invoice_no = substr($request->invoice_no,-15);
        DB::beginTransaction();
        try{
            foreach ($students as $item){
                InvoiceInput::create([
                    'user_id' => $item->student->id,
                    'transaction_code' => $code,
                    'invoice_no' => $invoice_no,
                    'invoice_date' => $request->invoice_date,
                    'invoice_period' => $request->invoice_period,
                    'invoice_year' => $request->invoice_year,
                    'collector_id' => $request->customer_id,
                    'collector_name' => $request->customer_name,
                    'collector_address' => $request->customer_address,
                    'credit' => $request->credit,
                    'dpp' => str_replace(".","",$request->dpp),
                    'ppn' => str_replace(".","",$request->ppn),
                    'ppnbm' => str_replace(".","",$request->ppnbm),
                    'approval_date' => date('Y-m-d'),
                ]);
            }

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }

        $request->session()->flash('alert-success', 'Faktur Pajak Masukan Berhasil Dibuat');
        return redirect()->back();


    }

}