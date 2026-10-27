<?php

namespace App\Http\Controllers\Cbt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Classroom;
use App\Models\ClassroomTeacher;
use App\Models\RoleUser;
use App\Models\Profile;
use App\Imports\TeachersImport;
use Maatwebsite\Excel\Facades\Excel;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use DB;

class TeacherController extends Controller
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
        //get teachers
        $teachers = User::whereHas('roles', function ($query){
            $query->where('roles.name', 'pengajar');
        })->when(request()->q, function($teachers) {
            $teachers = $teachers->where('name', 'like', '%'. request()->q . '%');
        })->withCount('classrooms')->latest()->paginate(10);
        //append query string to pagination links
        $teachers->appends(['q' => request()->q]);

        //render with inertia
        return inertia('Admin/Teachers/Index', [
            'teachers' => $teachers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //render with inertia
        return inertia('Admin/Teachers/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
        ]);

        //create teacher
        $username = IdGenerator::generate(['table' => 'users', 'field'=>'username', 'length' => 15, 'prefix' => date('Ymd')]);
        DB::beginTransaction();
        try{
            $user = User::create([
                'name' => $request->name,
                'username' => $username,
                'email' => $request->email,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'email_verified_at' => date('Y-m-d H:i:s'),
                'approved_at' => date('Y-m-d H:i:s'),
            ]);

            RoleUser::create([
                'user_id' => $user->id,
                'role_id' => 2,
            ]);

            Profile::create([
                'user_id' => $user->id,
                'corporate_name' => 'PT. '.$request->name,
            ]);
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }

        //redirect
        return redirect()->route('admin.teachers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //get exam_session
        $teacher = User::findOrFail($id);

        //get relation exam_groups with pagination
        $teacher->setRelation('classrooms', $teacher->classrooms()->with('classroom')->paginate(5));

        //render with inertia
        return inertia('Admin/Teachers/Show', [
            'teacher'  => $teacher,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //get teacher
        $teacher = User::findOrFail($id);

        return inertia('Admin/Teachers/Edit', [
            'student' => $teacher,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //validate request
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email',
        ]);

        $teacher = User::findOrFail($id);
        $teacher->update([
            'name'          => $request->name,
            'email'          => $request->email,
        ]);

        //redirect
        return redirect()->route('admin.teachers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get teacher
        $teacher = User::findOrFail($id);
        //delete classrooms
        ClassroomTeacher::where('user_id', $id)->delete();
        //delete teacher
        $teacher->delete();

        //redirect
        return redirect()->route('admin.teachers.index');
    }

    public function import()
    {
        return inertia('Admin/Teachers/Import');
    }

    public function storeImport(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // import data
        Excel::import(new TeachersImport(), $request->file('file'));

        //redirect
        return redirect()->route('admin.teachers.index');
    }

    public function createEnrolle(User $teacher)
    {
        //get classrooms already enrolled
        $classrooms_enrolled = ClassroomTeacher::pluck('classroom_id')->all();
            
        //get classrooms
        $classrooms = Classroom::whereNotIn('id', $classrooms_enrolled)->get();

        //render with inertia
        return inertia('Admin/Teachers/Classroom', [
            'teacher' => $teacher,
            'classrooms' => $classrooms,
        ]);
    }

    public function storeEnrolle(Request $request, User $teacher)
    {
        //validate request
        $request->validate([
            'classroom_id' => 'required',
        ]);
        
        //create exam_group
        foreach($request->classroom_id as $classroom_id) {

            //select classroom
            $classroom = Classroom::findOrFail($classroom_id);

            //create exam_group
            ClassroomTeacher::create([
                'user_id' => $teacher->id,
                'classroom_id' => $classroom->id,
            ]);
        }
        
        //redirect
        return redirect()->route('admin.teachers.show', $teacher->id);
    }

    public function destroyEnrolle(User $teacher, ClassroomTeacher $classroom_teacher)
    {
        //delete exam_group
        $classroom_teacher->delete();
        
        //redirect
        return redirect()->route('admin.teachers.show', $teacher->id);
    }
}
