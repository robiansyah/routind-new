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
use App\Services\TripayService;
use Haruncpi\LaravelIdGenerator\IdGenerator;

use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\InvoiceFee;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct(TripayService $tripayService)
    {
        $this->middleware(['auth','verified']);
        Configuration::setXenditKey(config('xendit.API_KEY'));
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

    public function paket(){
        return view('user.paket');
    }

    public function paketCheckout($type)
    {
        return view('user.paket_checkout',([
            'type' => $type,
        ]));
    }

    public function checkout(Request $request)
    {
        $this->validate($request,[
            'paket' => 'required',
        ]);
        $price = ($request->paket=='platinum') ? '75000' : '50000';
        $diskon = 0;
        $kode_diskon = '-';
        if(!empty($request->diskon_id)){
            $discount = Discount::where([['id', $request->diskon_id], ['start_date', '<=', date('Y-m-d')], ['end_date', '>=', date('Y-m-d')]])->first();
            if($discount){
                $kode_diskon = $discount->code;
                $diskon = ($discount->type=='rupiah') ? $discount->amount : (($request->paket=='platinum') ? $price * $discount->amount / 100  : $price * ($discount->amount/2) / 100 );
            }else{
                $request->session()->flash('alert-error', 'Kode Diskon Tidak Berlaku');
                return redirect()->back();
            }
        }
        $inv = IdGenerator::generate(['table' => 'purchases','field'=>'invoice_code', 'length' => 11, 'reset_on_prefix_change'  => true, 'prefix' => 'INV-'.date('y')]);
        $total = $price-$diskon;
        if($diskon > 0){
            $fees = array(['type'=>'Diskon', 'value'=>-$diskon],['type'=>'Biaya Transaksi', 'value'=>4500]);
        }else{
            $fees = array(['type'=>'Biaya Transaksi', 'value'=>4500]);
        }

        $apiInstance = new InvoiceApi();
        //request create invoice
        $create_invoice = new \Xendit\Invoice\CreateInvoiceRequest([
            'external_id' => (string) Str::uuid(),
            'customer' => [
                'given_names' => auth()->user()->name,
                'email' => auth()->user()->email,
                'mobile_number' => auth()->user()->mobile_phone,
            ],
            'customer_notification_preference' => [
                'invoice_created' => ['email', 'whatsapp'],
                'invoice_reminder' => ['email', 'whatsapp'],
                'invoice_paid' => ['email', 'whatsapp'],
            ],
            'description' => 'Invoice pembayaran transaksi produk '.$request->paket.' untuk user '.auth()->user()->name,
            'amount' => $total+4500,
            'items' => array([
                'name' => $request->paket,
                'price' => $price,
                'quantity' => 1,
            ]),
            'fees' => $fees,
            'failure_redirect_url' => route('pelajar.invoice'),
            'success_redirect_url' => route('pelajar.invoice'),
        ]);

        try {

            //create invoice
            $invoice = $apiInstance->createInvoice($create_invoice);

            $purchase = new Purchase;
            $purchase->user_id = auth()->user()->id;
            $purchase->paket = $request->paket;
            $purchase->discount_code = $kode_diskon;
            $purchase->discount_amount = $diskon;
            $purchase->status = 'UNPAID';
            $purchase->transaction_code = $invoice['external_id'];
            $purchase->invoice_code = $inv;
            $purchase->amount = $invoice['amount'];
            $purchase->invoice_url = $invoice['invoice_url'];
            $purchase->save();

            $url = $invoice['invoice_url'];
            return response()->json(['success' => true, 'url' => $url]);
        } catch (\Xendit\XenditSdkException $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function cost(Request $request)
    {
        $cost = $this->tripayService->getCost($request->code, $request->amount);
        return response()->json([
            'message'=>"success",
            "code"=> ($cost) ? 1 : 0 ,
            "data"=> $cost,
        ]);
    }

    public function discount(Request $request)
    {
        $code = $request->code;
        $discount = Discount::where([['code', $code], ['start_date', '<=', date('Y-m-d')], ['end_date', '>=', date('Y-m-d')]])->first();
        return response()->json([
            "status"=>"success",
            "code"=> ($discount) ? 1 : 0,
            "data"=> ($discount)? : array(),
        ]);
    }

    public function invoice(){
        $purchase = Purchase::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        return view('user.invoice', [
            'purchase' => $purchase,
        ]);
    }

    public function invoiceDetail(Request $request, $code)
    {
        $purchase = Purchase::where([['user_id', auth()->user()->id], ['invoice_code', $code]])->first();
        if(!$purchase){
            $request->session()->flash('alert-error', 'Transaksi tidak ditemukan');
            return redirect()->back();
        }
        $transaction = $this->tripayService->detailTransaction($purchase->transaction_code);
        return view('user.invoice_detail', [
            'purchase' => $purchase,
            'transaction' => $transaction,
        ]);
    }

    public function invoiceCancel(Request $request, $code)
    {
        $purchase = Purchase::where([['user_id', auth()->user()->id], ['invoice_code', $code]])->first();
        if(!$purchase){
            $request->session()->flash('alert-error', 'Transaksi tidak ditemukan');
            return redirect()->back();
        }
        $purchase->update(['status' => 'FAILED']);

        $request->session()->flash('alert-success', 'Transaksi Berhasil Dibatalkan');
        return redirect()->back();

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
