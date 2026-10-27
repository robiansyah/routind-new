<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spt;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Profile;
use App\Models\Purchase;
use App\Models\AcademyEvent;
use App\Models\AcademyPurchase;
use App\Models\AcademyMessage;
use App\Models\AcademyBatch;
use App\Models\LogActivity;
use App\Models\Partnership;
use Carbon\Carbon;
use DataTables;
use DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PenggunaImport;

use LevelUp\Experience\Enums\AuditType;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index() {
//        $xp = auth()->user()->getPoints();
//        dd($xp);
//        auth()->user()->addPoints(
//            amount: 5,
//            type: AuditType::Add->value,
//            reason: "Welcoming Bonus",
//        );
//        dd(auth()->user()->experienceHistory);
        User::where('end_date', '<', date('Y-m-d'))->update([
            'paket' => null,
            'end_date' => null,
        ]);
        $teacher = User::whereHas('roles', function ($query){
            $query->where('roles.name', 'pengajar');
        })->count();
        $student = User::whereHas('roles', function ($query){
            $query->where('roles.name', 'pelajar');
        })->count();
        $transaction = Purchase::where('status', 'PAID')->count();
        $event = AcademyEvent::count();

        return view('admin.index',[
            'teacher' => $teacher,
            'student' => $student,
            'transaction' => $transaction,
            'event' => $event,
        ]);
    }

    public function pengguna(Request $request, $type){
        if ($request->ajax()) {
            $data = User::whereHas('roles', function ($query) use ($type){
                $query->where('roles.name', $type);
            })->orderBy('created_at','desc');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return view('admin.pengguna_button', ['user' => $row]);
                })
                ->addColumn('status', function ($row){
                    $status = ($row->email_verified_at != '') ? '<span class="badge bg-success">Email Terverifikasi</span>' : '<a href="'.route('admin.pengguna.email', ['id'=>$row->id]).'" onclick="return confirm(\'Apakah anda yakin akan memverifikasi email ini?\')" class="badge bg-danger">Email Belum Terverifikasi</a>';
                    $status .= '<br>'.\Carbon\Carbon::parse($row->created_at)->format('j M Y, H:i');
                    return $status;
                })
                ->rawColumns(['status'])
                ->toJson();
        }
        $partnership = Partnership::orderByDesc('created_at')->get();
        return view('admin.pengguna',[
            'type' => $type,
            'partnership' => $partnership,
        ]);

//        $user = User::whereHas('roles', function ($query) use ($type){
//            $query->where('roles.name', $type);
//        })->orderBy('id', 'desc')->get();
//        return view('admin.pengguna', [
//            'data' => $user,
//        ]);
    }

    public function penggunaStore(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|unique:users,email,NULL,id,deleted_at,NULL',
            'mobile_phone' => 'required',
            'role_id' => 'required',
        ]);

        $npwp = IdGenerator::generate(['table' => 'users','field'=>'npwp', 'length' => 16, 'prefix' => '183573002']);
        $nik = IdGenerator::generate(['table' => 'users','field'=>'username', 'length' => 16, 'prefix' => '293573001']);
        $affiliate = IdGenerator::generate(['table' => 'users','field'=>'affiliate_code', 'length' => 8, 'prefix' => 'RTND']);
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'username' => $nik,
                'npwp' => $npwp,
                'email' => $request->email,
                'mobile_phone' => $request->mobile_phone,
                'password' => Hash::make($request->mobile_phone),
                'email_verified_at' => date('Y-m-d H:i:s'),
                'institution_code' => $request->institution_code,
                'affiliate_code' => ($request->role_id=='6') ? $affiliate : NULL,
                'affiliate_status' => ($request->role_id=='6') ? 'active' : 'not active',
            ]);

            RoleUser::create([
                'user_id' => $user->id,
                'role_id' => $request->role_id,
            ]);

            Profile::create([
                'user_id' => $user->id,
                'corporate_name' => 'PT. ' . $request->name,
            ]);
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();

            $request->session()->flash('alert-danger', 'Pengguna gagal dibuat karena '.$e);
            return redirect()->back();
        }

        $request->session()->flash('alert-info', 'Pengguna Berhasil Ditambahkan');
        return redirect()->back();
    }

    public function penggunaImport(Request $request)
    {
        $this->validate($request, [
            'file'  => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new PenggunaImport(), $request->file('file')->store('temp'));
        $request->session()->flash('alert-info', 'Pengguna berhasil diimpor');
        return redirect()->back();
    }

    public function penggunaEdit($id){
        $data = User::with('roles')->findOrFail($id);
        return response()->json([
            "status"=>"success",
            "code"=> 1,
            "data"=> $data,
        ]);
    }

    public function penggunaUpdate(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'mobile_phone' => 'required',
            'role_id' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_phone = $request->mobile_phone;
        $user->institution_code = $request->institution_code;
        $user->save();
        $role = RoleUser::where('user_id', $user->id)->first();
        if($role){
            $role->role_id = $request->role_id;
            $role->save();
        }

        $coretax_cek = DB::connection('coretax_db')
            ->table('users')
            ->where('email', $request->email)
            ->first();
        if($coretax_cek) {
            DB::connection('coretax_db')->table('users')->where('id', $coretax_cek->id)
                ->update([
                    'name' => $request->name,
                    'phone' => $request->mobile_phone,
                    'code' => $request->institution_code,
                ]);
        }

        $request->session()->flash('alert-info', 'Pengguna Berhasil Diubah');
        return redirect()->back();
    }

    public function penggunaDestroy(Request $request, $id){
        DB::beginTransaction();
        try{
            RoleUser::where('user_id', $id)->delete();
            Profile::where('user_id', $id)->delete();
            User::findOrFail($id)->delete();
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        $request->session()->flash('alert-info', 'Pengguna Berhasil Dihapus');
        return redirect()->back();
    }

    public function penggunaPaket(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->paket = 'premium';
        $user->end_date =  date("Y-m-d", strtotime(($user->hasRole('pengajar')) ? "+6 months" : "+2 days"));
        $user->save();

        $request->session()->flash('alert-info', 'Paket Pengguna Berhasil Diubah');
        return redirect()->back();
    }

    public function penggunaEmail(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();

        $request->session()->flash('alert-info', 'Email berhasil diverifikasi');
        return redirect()->back();
    }

    public function penggunaPassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->password = Hash::make($user->mobile_phone);
        $user->save();

        $request->session()->flash('alert-info', 'Password berhasil direset');
        return redirect()->back();
    }

    public function approved(Request $request, $id){
        $user = User::findOrFail($id);
        $user->approved_at = date('Y-m-d H:i:s');
        $user->save();

        $request->session()->flash('alert-info', 'User berhasil diverifikasi');
        return redirect()->back();
    }

    public function transaction()
    {
        $transaction = Purchase::orderBy('id', 'desc')->lazy();
        return view('admin.transaction', [
            'data' => $transaction,
        ]);
    }

    public function log(Request $request)
    {
        if ($request->ajax()) {
            $data = LogActivity::where('user_id', '<>', 3)->with(['user' => function ($query) {
                $query->select('id', 'username', 'name');
            }])->orderBy('id','desc');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return \Carbon\Carbon::parse($row->created_at )->isoFormat('D MMMM Y H:m:s');
                })
                ->toJson();
        }
        return view('admin.log');
    }

    public function registration(Request $request)
    {
        $event_id = $request->event_id ?? null;
        $status = $request->status ?? null;

        $data = AcademyPurchase::orderBy('created_at', 'desc');
        if($status=='PAID'){
            $data->whereIn('status', array('PAID', 'SETTLED'));
        }elseif($status=='UNPAID'){
            $data->whereNotIn('status', array('PAID', 'SETTLED'));
        }
        if($event_id!=null){
            $data->whereIn('batch_id', $event_id);
        }else{
            $data->limit(50);
        }
        $registration = $data->get();
        $events = AcademyBatch::with('event')->orderBy('created_at', 'desc')->lazy();
        return view('admin.registration', [
            'data' => $registration,
            'event_id' => $event_id,
            'status' => $status,
            'events' => $events,
        ]);
    }

    public function message()
    {
        $message = AcademyMessage::orderBy('id', 'desc')->get();
        return view('admin.message', [
            'data' => $message,
        ]);
    }

    public function messageReply(Request $request, $id)
    {
        $message = AcademyMessage::findOrFail($id);
        return view('admin.message_reply', [
            'data' => $message,
        ]);
    }

    public function messageUpdate(Request $request, $id)
    {
        $this->validate($request,[
            'reply' => 'required',
        ]);

        $message = AcademyMessage::findOrFail($id);
        $message->reply = $request->reply;
        $message->save();

        //kirim email
        
    }

    public function messageDestroy(Request $request, $id)
    {
        AcademyMessage::findOrFail($id)->delete();

        $request->session()->flash('alert-info', 'Pesan Berhasil Dihapus');
        return redirect()->back();
    }
}