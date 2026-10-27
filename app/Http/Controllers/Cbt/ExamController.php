<?php

namespace App\Http\Controllers\Cbt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamSession;
use App\Models\Lesson;
use App\Models\Classroom;
use App\Models\Question;
use App\Imports\QuestionsImport;
use Maatwebsite\Excel\Facades\Excel;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get exams
        $exams = Exam::when(request()->q, function($exams) {
            $exams = $exams->where('title', 'like', '%'. request()->q . '%');
        })->with('lesson', 'questions')->latest()->paginate(10);

        //append query string to pagination links
        $exams->appends(['q' => request()->q]);

        //render with inertia
        return inertia('Admin/Exams/Index', [
            'exams' => $exams,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //get lessons
        $lessons = Lesson::all();
        
        //render with inertia
        return inertia('Admin/Exams/Create', [
            'lessons' => $lessons,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'title'             => 'required',
            'lesson_id'         => 'required|integer',
            'duration'          => 'required|integer',
            'description'       => 'required',
            'random_question'   => 'required',
            'random_answer'     => 'required',
            'show_answer'       => 'required',
        ]);

        //create exam
        Exam::create([
            'title'             => $request->title,
            'lesson_id'         => $request->lesson_id,
            'duration'          => $request->duration,
            'description'       => $request->description,
            'random_question'   => $request->random_question,
            'random_answer'     => $request->random_answer,
            'show_answer'       => $request->show_answer,
        ]);

        //redirect
        return redirect()->route('admin.exams.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //get exam
        $exam = Exam::with('lesson')->findOrFail($id);

        //get relation questions with pagination
        $exam->setRelation('questions', $exam->questions()->paginate(5));

        //render with inertia
        return inertia('Admin/Exams/Show', [
            'exam' => $exam,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //get exam
        $exam = Exam::findOrFail($id);

        //get lessons
        $lessons = Lesson::all();

        //render with inertia
        return inertia('Admin/Exams/Edit', [
            'exam' => $exam,
            'lessons' => $lessons,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        //validate request
        $request->validate([
            'title'             => 'required',
            'lesson_id'         => 'required|integer',
            'duration'          => 'required|integer',
            'description'       => 'required',
            'random_question'   => 'required',
            'random_answer'     => 'required',
            'show_answer'       => 'required',
        ]);

        //update exam
        $exam->update([
            'title'             => $request->title,
            'lesson_id'         => $request->lesson_id,
            'duration'          => $request->duration,
            'description'       => $request->description,
            'random_question'   => $request->random_question,
            'random_answer'     => $request->random_answer,
            'show_answer'       => $request->show_answer,
        ]);

        //redirect
        return redirect()->route('admin.exams.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get exam
        $exam = Exam::findOrFail($id);

        //Question::where('exam_id', $exam->id)->delete();

        //ExamSession::where('exam_id', $exam->id)->delete();

        //delete exam
        $exam->delete();

        //redirect
        return redirect()->route('admin.exams.index');
    }

    public function duplicate(Exam $exam)
    {
        $questions = Question::where('exam_id', $exam->id)->get();

        $new = Exam::create([
            'title'             => $exam->title.' Duplicate',
            'lesson_id'         => $exam->lesson_id,
            'duration'          => $exam->duration,
            'description'       => $exam->description,
            'random_question'   => $exam->random_question,
            'random_answer'     => $exam->random_answer,
            'show_answer'       => $exam->show_answer,
        ]);

        foreach ($questions as $item){
            $newQeustion = $item->replicate();
            $newQeustion->exam_id = $new->id;
            $newQeustion->save();
        }

        return redirect()->route('admin.exams.index');
    }

    public function createQuestion(Exam $exam)
    {
        //render with inertia
        return inertia('Admin/Questions/Create', [
            'exam' => $exam,
        ]);
    }
    
    public function storeQuestion(Request $request, Exam $exam)
    {
        //validate request
        $request->validate([
            'question'          => 'required',
            'option_1'          => 'required',
            'option_2'          => 'required',
            'option_3'          => 'required',
            'option_4'          => 'required',
            // 'option_5'          => 'required',
            'answer'            => 'required',
        ]);
        
        //create question
        Question::create([
            'exam_id'           => $exam->id,
            'question'          => $request->question,
            'option_1'          => $request->option_1,
            'option_2'          => $request->option_2,
            'option_3'          => $request->option_3,
            'option_4'          => $request->option_4,
            'option_5'          => $request->option_5,
            'answer'            => $request->answer,
        ]);
        
        //redirect
        return redirect()->route('admin.exams.show', $exam->id);
    }

    public function editQuestion(Exam $exam, Question $question)
    {
        //render with inertia
        return inertia('Admin/Questions/Edit', [
            'exam' => $exam,
            'question' => $question,
        ]);
    }

    public function updateQuestion(Request $request, Exam $exam, Question $question)
    {
        //validate request
        $request->validate([
            'question'          => 'required',
            'option_1'          => 'required',
            'option_2'          => 'required',
            'option_3'          => 'required',
            'option_4'          => 'required',
            // 'option_5'          => 'required',
            'answer'            => 'required',
        ]);
        
        //update question
        $question->update([
            'question'          => $request->question,
            'option_1'          => $request->option_1,
            'option_2'          => $request->option_2,
            'option_3'          => $request->option_3,
            'option_4'          => $request->option_4,
            'option_5'          => $request->option_5,
            'answer'            => $request->answer,
        ]);
        
        //redirect
        return redirect()->route('admin.exams.show', $exam->id);
    }

    public function destroyQuestion(Exam $exam, Question $question)
    {
        //delete question
        $question->delete();
        
        //redirect
        return redirect()->route('admin.exams.show', $exam->id);
    }

    public function import(Exam $exam)
    {
        return inertia('Admin/Questions/Import', [
            'exam' => $exam
        ]);
    }

    public function storeImport(Request $request, Exam $exam)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // import data
        Excel::import(new QuestionsImport($exam->id), $request->file('file'));

        //redirect
        return redirect()->route('admin.exams.show', $exam->id);
    }
}
