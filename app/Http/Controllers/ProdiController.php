<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Kelas;

class ProdiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:prodi']);
    }

    public function index()
    {
        $pengajar = User::whereHas('roles', function ($query){
            $query->where('roles.name', 'pengajar');
        })->where('institution_code', auth()->user()->institution_code)->count();
        $pengajar_id = User::whereHas('roles', function ($query){
            $query->where('roles.name', 'pengajar');
        })->where('institution_code', auth()->user()->institution_code)->pluck('id')->all();
        $kelas = Kelas::whereIn('user_id', $pengajar_id)->count();
        $co = User::whereHas('roles', function ($query){
            $query->where('roles.name', 'co-pengajar');
        })->where('institution_code', auth()->user()->institution_code)->count();
        $student = User::whereHas('roles', function ($query){
            $query->where('roles.name', 'pelajar');
        })->where('institution_code', auth()->user()->institution_code)->count();

        return view('prodi.index',[
            'student' => $student,
            'pengajar' => $pengajar,
            'co' => $co,
            'kelas' => $kelas,
        ]);
    }

    public function pengguna(Request $request, $type)
    {
        $user = User::whereHas('roles', function ($query) use ($type){
            $query->where('roles.name', $type);
        })->where('institution_code', auth()->user()->institution_code)->orderBy('created_at', 'desc')->get();
        return view('prodi.pengguna', [
            'data' => $user,
        ]);
    }

    public function penggunaPassword(Request $request, $id)
    {
        // Only users of this prodi's own institution, and never an admin.
        $institution = auth()->user()->institution_code;
        abort_if(empty($institution), 403);

        $user = User::where('institution_code', $institution)
            ->whereDoesntHave('roles', fn ($query) => $query->where('roles.name', 'admin'))
            ->findOrFail($id);

        $password = Str::password(10, symbols: false);
        $user->password = Hash::make($password);
        $user->save();

        $request->session()->flash('alert-info', 'Password '.$user->email.' berhasil direset. Password baru: '.$password.' (sampaikan ke pengguna, hanya ditampilkan sekali)');
        return redirect()->back();
    }

    public function kelas()
    {
        $pengajar_id = User::whereHas('roles', function ($query){
            $query->where('roles.name', 'pengajar');
        })->where('institution_code', auth()->user()->institution_code)->pluck('id')->all();
        $kelas = Kelas::whereIn('user_id', $pengajar_id)->get();
        return view('prodi.kelas', [
            'data' => $kelas,
        ]);
    }
}