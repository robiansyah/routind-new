<?php

namespace App\Http\Controllers\Cbt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Classroom;
use App\Models\RoleUser;
use App\Models\Profile;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use DB;

class StudentController extends Controller
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
        //get students
        $students = User::whereHas('roles', function ($query){
            $query->whereIn('roles.name', array('pelajar', 'ter'));
        })->when(request()->q, function($students) {
            $students = $students->where('name', 'like', '%'. request()->q . '%');
        })->with(['classroom', 'profile'])->latest()->paginate(10);
        //append query string to pagination links
        $students->appends(['q' => request()->q]);

        //render with inertia
        return inertia('Admin/Students/Index', [
            'students' => $students,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //get classrooms
        $classrooms = Classroom::all();

        //render with inertia
        return inertia('Admin/Students/Create', [
            'classrooms' => $classrooms,
        ]);
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
            'mobile_phone' => 'required|string',
            'classroom_id' => 'required'
        ]);

        //create student
        $username = IdGenerator::generate(['table' => 'users', 'field'=>'username', 'length' => 15, 'prefix' => date('Ymd')]);
        DB::beginTransaction();
        try{
            $user = User::create([
                'name' => $request->name,
                'username' => $username,
                'email' => $request->email,
                'mobile_phone' => $request->mobile_phone,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'email_verified_at' => date('Y-m-d H:i:s'),
                'approved_at' => date('Y-m-d H:i:s'),
                'classroom_id'  => $request->classroom_id
            ]);

            RoleUser::create([
                'user_id' => $user->id,
                'role_id' => 3,
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
        return redirect()->route('admin.students.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //get student
        $student = User::with('profile')->where('id', $id)->first();

        //get classrooms
        $classrooms = Classroom::all();

        //render with inertia
        return inertia('Admin/Students/Edit', [
            'student' => $student,
            'classrooms' => $classrooms,
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
            'mobile_phone'  => 'required|string',
            'classroom_id'  => 'required',
        ]);

        $student = User::findOrFail($id);
        $student->update([
            'name'           => $request->name,
            'email'          => $request->email,
            'mobile_phone'   => $request->mobile_phone,
            'classroom_id'   => $request->classroom_id
        ]);

        //redirect
        return redirect()->route('admin.students.index');
    }
    
    public function password($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        //redirect
        return redirect()->route('admin.students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get student
        $student = User::findOrFail($id);

        //delete student
        $student->delete();

        //redirect
        return redirect()->route('admin.students.index');
    }

    public function import()
    {
        return inertia('Admin/Students/Import');
    }

    public function storeImport(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // import data
        Excel::import(new StudentsImport(), $request->file('file'));

        //redirect
        return redirect()->route('admin.students.index');
    }

    public function validation(string $id)
    {
        //get student
        $student = User::findOrFail($id);
        $student->update([
            'approved_at'   => date('Y-m-d H:i:s')
        ]);

        //redirect
        return redirect()->route('admin.students.index');
    }
}
