<?php

namespace App\Http\Controllers\Cbt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\ExamClassroom;
use DB;

class ClassroomController extends Controller
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
        //get classrooms
        $classrooms = Classroom::when(request()->q, function($classrooms) {
            $classrooms = $classrooms->where('title', 'like', '%'. request()->q . '%');
        })->latest()->paginate(10);

        //append query string to pagination links
        $classrooms->appends(['q' => request()->q]);

        //render with inertia
        return inertia('Admin/Classrooms/Index', [
            'classrooms' => $classrooms,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/Classrooms/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'title' => 'required|string|unique:classrooms,title,NULL,id,deleted_at,NULL',
            'start_time'    => 'required',
            'end_time'      => 'required',
        ]);

        DB::beginTransaction();
        try{
            //create classroom
            $classroom = Classroom::create([
                'title' => $request->title,
                'start_time'    => date('Y-m-d H:i:s', strtotime($request->start_time)),
                'end_time'      => date('Y-m-d H:i:s', strtotime($request->end_time)),
            ]);

            $exams = Exam::all();
            foreach ($exams as $exam){
                ExamClassroom::create([
                    'exam_id' => $exam->id,
                    'classroom_id' => $classroom->id,
                    'status' => 'off',
                ]);
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        //redirect
        return redirect()->route('admin.classrooms.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //get exam
        $classroom = Classroom::with('exams', 'exams.exam')->findOrFail($id);

        //render with inertia
        return inertia('Admin/Classrooms/Show', [
            'classroom' => $classroom,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //get classroom
        $classroom = Classroom::findOrFail($id);

        //render with inertia
        return inertia('Admin/Classrooms/Edit', [
            'classroom' => $classroom,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        //validate request
        $request->validate([
            'title' => 'required|string|unique:classrooms,title,'.$classroom->id,
            'start_time'    => 'required',
            'end_time'      => 'required',
        ]);

        //update classroom
        $classroom->update([
            'title' => $request->title,
            'start_time'    => date('Y-m-d H:i:s', strtotime($request->start_time)),
            'end_time'      => date('Y-m-d H:i:s', strtotime($request->end_time)),
        ]);

        //redirect
        return redirect()->route('admin.classrooms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get classroom
        $classroom = Classroom::findOrFail($id);

        //delete classroom
        $classroom->delete();

        //redirect
        return redirect()->route('admin.classrooms.index');
    }

    public function updateExam(Classroom $classroom, ExamClassroom $exam)
    {
        $exam->update([
            'status' => ($exam->status=='on') ? 'off' : 'on'
        ]);

        //redirect
        return redirect()->route('admin.classrooms.show', $classroom->id);
    }
}
