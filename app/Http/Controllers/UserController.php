<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\TaxDeposit;
use App\Models\TaxType;
use App\Models\Pay;
use App\Models\User;
use App\Models\Profile;
use App\Models\Discount;
use App\Models\Purchase;
use App\Models\ClassStudent;
use App\Models\Kelas;
use Barryvdh\DomPDF\Facade\Pdf;
use MongoDB\Driver\Session;
use Terbilang;
use DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;

use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index()
    {
        if(date('Y-m-d') > auth()->user()->end_date){
            $user = auth()->user();
            $user->paket = null;
            $user->end_date = null;
            $user->save();
        }

        return view('user.information');
    }

    public function dashboard()
    {
        if(date('Y-m-d') > auth()->user()->end_date){
            $user = auth()->user();
            $user->paket = null;
            $user->end_date = null;
            $user->save();
        }
        
        return view('user.dashboard');
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function profileUpdate(Request $request){
        $id = auth()->user()->id;
        $user = User::findOrFail($id);
        $profile = Profile::where('user_id', $id)->first();

        $user->mobile_phone = $request->mobile_phone;
        $profile->address = $request->address;

        $user->name = $request->name;
        $profile->birth_date = $request->birth_date;
        $profile->birth_place = $request->birth_place;

        $profile->corporate_name = $request->corporate_name;
        $profile->save();
        $user->save();

        if (session()->has('coretax')) {
            DB::connection('coretax_db')
                ->table('users')
                ->where('email', $user->email)
                ->update([
                    'phone' => $request->mobile_phone,
                    'address' => $request->address,
                    'company_name' => $request->corporate_name,
                    'name' => $request->name,
                ]);
        }

        $request->session()->flash('alert-success', 'Data Utama berhasil diubah');
        return redirect()->back();
    }

    public function changePassword()
    {
        return view('user.change_password');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request,[
            'password_old' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        #Match The Old Password
        if(!Hash::check($request->password_old, auth()->user()->password)){
            $request->session()->flash('alert-error', 'Password saat ini tidak cocok');
            return redirect()->back();
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        //update exam db
        DB::connection('second_db')
            ->table('users')
            ->where('email', auth()->user()->email)
            ->update(['password' => Hash::make($request->password)]);

        $request->session()->flash('alert-success', 'Password berhasil diubah');
        return redirect()->back();
    }

    public function getNpwp(Request $request)
    {
        $date = auth()->user()->created_at;
        $data = array(
            "admKpp" => "Simulator Pajak",
            "nama" => auth()->user()->name,
            "npwp" => auth()->user()->username,
            "tglTerdaftar" => date_format($date,"d/m/Y"),
            "alamat" => auth()->user()->profile?->address,
        );
        return response()->json([
            'kdStatus'=>"1",
            "ketStatus"=>"NPWP",
            "message"=> $data,
        ]);
    }

    public function setting(){
        $kelas = ClassStudent::where('student_id', auth()->user()->id)->first();
        return view('user.setting', [
            'kelas' => $kelas,
        ]);
    }

    public function kelas(Request $request)
    {
        $kelas = Kelas::with(['user' => function ($query) {
            $query->select('id', 'name');
        }])->where('code', $request->code)->first();
        return response()->json([
            "status"=>"success",
            "code"=> ($kelas) ? 1 : 0,
            "data"=> ($kelas)? : array(),
        ]);
    }

    public function updateSetting(Request $request, $type){
        $id = auth()->user()->id;
        if($type=='wp_type'){
            $type = $request->wp_type;
            $user = User::findOrFail($id);
            $user->update(['wp_type'=>$type]);
            $request->session()->flash('alert-success', 'Jenis Wajib Pajak berhasil diubah');
            return redirect()->back();
        }elseif($type=='kelas'){
            $kelas = Kelas::where('code', $request->code)->first();
            if($kelas){
                $cek = ClassStudent::where('student_id', $id)->first();
                if($cek){
                    if($cek->class_id==$kelas->id){
                        $cek->nim = $request->nim;
                        $cek->save();
                    }else{
                        $cek->delete();
                        ClassStudent::create([
                            'class_id' => $kelas->id,
                            'student_id' => $id,
                            'nim' => $request->nim,
                        ]);
                    }
                }else{
                    ClassStudent::create([
                        'class_id' => $kelas->id,
                        'student_id' => $id,
                        'nim' => $request->nim,
                    ]);
                }

                $request->session()->flash('alert-success', 'Kelas berhasil diubah');
                return redirect()->back();

            }else{
                $request->session()->flash('alert-error', 'Kelas Tidak Ditemukan');
                return redirect()->back();
            }
        }
    }

    public function report()
    {
        return view('user.report');
    }

    public function praReport()
    {
        return view('user.pra_report');
    }

}
