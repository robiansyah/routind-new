<?php

namespace App\Http\Controllers\Cbt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Grade;
use App\Models\ExamSession;
use App\Models\Classroom;
use Carbon\Carbon;
use App\Exports\GradesExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class ReportController extends Controller
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
        //geta ll exams
        $exams = Exam::with('lesson')->get();
        $classrooms = Classroom::all();

        return inertia('Admin/Reports/Index', [
            'exams'         => $exams,
            'classrooms'    => $classrooms,
            'grades'        => []
        ]);
    }

    public function filter(Request $request)
    {
        $this->validate($request, [
            'exam_id'       => 'required',
            'classroom_id'  => 'required',
        ]);

        //geta all exams
        $exams = Exam::with('lesson')->get();
        $classrooms = Classroom::all();

        //get exam
        $exam = Exam::with('lesson')->findOrFail($request->exam_id);
        $classroom = Classroom::findOrFail($request->classroom_id);

        if($exam) {

            //get grades / nilai
            $grades = Grade::selectRaw('grades.* , MAX(grades.grade) AS grade, exams.*, users.name, users.email, classrooms.title as classrom_title, lessons.title as lesson_title')
                    ->leftJoin('exams', 'exams.id', '=', 'grades.exam_id')
                    ->leftJoin('users', 'users.id', '=', 'grades.student_id')
                    ->leftJoin('classrooms', 'classrooms.id', '=', 'users.classroom_id')
                    ->leftJoin('lessons', 'lessons.id', '=', 'exams.lesson_id')
                    ->where('grades.exam_id', $exam->id)
                    ->where('grades.exam_session_id', $classroom->id)
                    ->groupBy('grades.student_id')
                    ->get();

        } else {
            $grades = [];
        }        
        
        return inertia('Admin/Reports/Index', [
            'exams'         => $exams,
            'classrooms'    => $classrooms,
            'grades'         => $grades,
        ]);
        
    }

    public function export(Request $request)
    {
        //get exam
        $exam = Exam::with('lesson')->findOrFail($request->exam_id);

        //get exam session
        $classroom = Classroom::findOrFail($request->classroom_id);

        //get grades / nilai
        $grades = Grade::selectRaw('grades.* , MAX(grades.grade) AS grade, exams.*, users.name, users.email, classrooms.title as classrom_title, lessons.title as lesson_title')
            ->leftJoin('exams', 'exams.id', '=', 'grades.exam_id')
            ->leftJoin('users', 'users.id', '=', 'grades.student_id')
            ->leftJoin('classrooms', 'classrooms.id', '=', 'users.classroom_id')
            ->leftJoin('lessons', 'lessons.id', '=', 'exams.lesson_id')
            ->where('grades.exam_id', $exam->id)
            ->where('grades.exam_session_id', $classroom->id)
            ->groupBy('grades.student_id')
            ->get();

        return Excel::download(new GradesExport($grades), 'grade : '.$exam->title.' — '.$exam->lesson->title.' — '.Carbon::now().'.xlsx');
    }
}
