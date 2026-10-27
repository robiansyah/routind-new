<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\TaxDeposit;
use App\Models\TaxType;
use App\Models\Pay;
use App\Models\User;
use App\Models\Spt;
use Barryvdh\DomPDF\Facade\Pdf;
use Terbilang;
use DB;

use App\Notifications\EmailNotification;

class BillingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index()
    {
        $pay = Spt::with('type')->where([['user_id', auth()->user()->id]])->where('send_flag', '1')->orderBy('created_at', 'desc')->get();
        return view('user.pay', [
            'pay' => $pay,
        ]);
    }

    public function bayar(Request $request, $id)
    {
        $spt = Spt::findOrFail($id);
        $spt->send_flag = 2;
        $spt->ntte = time() . $spt->id;
        $spt->payment_value = $spt->tax_value;
        $spt->date = date('Y-m-d H:i:s');
        $spt->save();
//        $status = ($spt->status == 1) ? 'Kurang Bayar' : (($spt->status == 2) ? 'Lebih Bayar' : 'Nihil');

//        $user = User::findOrFail(auth()->user()->id);
//        $body = "Berikut ini adalah Bukti Penerimaan Elektronik Anda.";
//        $body .= "<br>---------------------------------------------------";
//        $body .= "<br>Nama : " . $user->profile->corporate_name;
//        $body .= "<br>NPWP : " . $user->npwp;
//        $body .= "<br>Tahun Pajak : " . $spt->year;
//        $body .= "<br>Masa Pajak : " . $spt->start_period;
//        $body .= "<br>Jenis SPT : " . $spt->form_code;
//        $body .= "<br>Pembetulan ke :" . $spt->correction_to;
//        $body .= "<br>Status SPT : " . $status;
//        $body .= "<br>Nominal : " . $spt->tax_value;
//        $body .= "<br>Tanggal Penyampaian : " . $spt->date;
//        $body .= "<br>Nomor Tanda Terima Elektronik : " . $spt->ntte;

//        $messages = [
//            'subject' => '[SPT] Bukti Penerimaan Elektronik',
//            'greeting' => 'Hi ' . $user->profile->corporate_name . ',',
//            'body' => $body,
//            'thanks' => 'Terima kasih telah menyampaikan Laporan SPT Anda.',
//        ];
//
//        $user->notify(new EmailNotification($messages));

        $request->session()->flash('alert-success', 'Billing Berhasil Dibayarkan');
        return redirect()->back();
    }

    public function showPay($id){
        $pay = Pay::findOrFail($id);

        return response()->json([
            'data' => $pay,
        ]);
    }

    public function createPay(Request $request)
    {
        return view('user.pay_create');
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

    public function getNominal(Request $request)
    {
        $terbilang = Terbilang::make($request->jmlstr, ' Rupiah');

        return response()->json([
            'kdStatus'=>"1",
            "ketStatus"=>null,
            "message"=>null,
            'data' => ucwords($terbilang),
        ]);
    }

    public function getType(Request $request)
    {
        $id = $request->idJnsWp;
        $deposit = TaxDeposit::select(DB::raw('type_id, code as kdSetor, name as descSetor, month as masaBulan, year as masaTahun, currency as mataUang, corporate as wpBadan, collector as wpPemungut, npwp as npwpNol, npwp_other as npwpLain, nop as butuhNop, nosk as butuhNosk'))
            ->with(['type' => function ($query) {
                $query->select(DB::raw('id, code as kdMap, name as descMap'));
            }])->get();

        return response()->json([
            'kdStatus'=>"1",
            "ketStatus"=>null,
            "message"=>null,
            'data' => $deposit,
        ]);
    }

    public function getBillingCode(Request $request)
    {
        $this->validate($request,[
            'capca' => 'required|captcha',
        ]);

        $type = TaxType::where('code', $request->kdMap)->first();
        $deposit = TaxDeposit::where([['type_id', $type->id], ['code', $request->kjs]])->first();
        $randomNumber = random_int(10000, 99999);

        $pay = new Pay;
        $pay->user_id = auth()->user()->id;
        $pay->wp_type = auth()->user()->wp_type;
        $pay->deposit_id = $deposit->id;
        $pay->start_period = $request->msPjkAwl;
        $pay->end_period = $request->msPjkAkr;
        $pay->year = $request->thnPjk;
        $pay->assignment_number = $request->noSk;
        $pay->amount = $request->jmlStr;
        $pay->description = $request->uraian;
        $pay->billing_id = time().$randomNumber;
        $pay->save();

        $data = Pay::where('id', $pay->id)
            ->with(['user' => function ($query) {
                $query->select(DB::raw('id, username, name'));
            }])
            ->with('deposit')
            ->with('deposit.type')
            ->first();

        return response()->json([
            'kdStatus'=>"1",
            "ketStatus"=>null,
            "message"=>null,
            'data' => $data,
        ]);
    }

    public function cetakBilling(Request $request)
    {
        $data = Pay::where('user_id', auth()->user()->id)->latest('created_at')->first();

        $pdf = Pdf::loadview('print.billing', [
            'data'=>$data,
        ]);

        return response()->json([
            'kdStatus'=>"1",
            "ketStatus"=>"Cetak Sukses",
            "message"=>base64_encode($pdf->output()),
            'data' => null,
        ]);
    }

    public function codeBilling(Request $request)
    {
        //billing random number
        $randomNumber = random_int(10000, 99999);

        $pay = new Pay;
        $pay->user_id = auth()->user()->id;
        $pay->deposit_id = 62;
        $pay->start_period = 00;
        $pay->end_period = 00;
        $pay->year = $request->thPajak;
        $pay->assignment_number = "000000000000000";
        $pay->amount = $request->pajak;
        $pay->billing_id = time().$randomNumber;
        $pay->save();

//        $date = date('d-m-Y H:i:s');
//        $date1 = str_replace('-', '/', $date);
        $tomorrow = date('d-m-Y H:i:s',strtotime($pay->created_at . "+1 month"));
        return response()->json([
            'kdStatus'=>"1",
            "ketStatus"=>$pay->billing_id,
            "message"=>$tomorrow,
            'data' => null,
        ]);
    }

    public function payment(Request $request)
    {
        return view('user.payment', ['type'=>'payment']);
    }

    public function inquiry(Request $request)
    {
        $data = Pay::where('billing_id', str_replace(' ', '', $request->billing_id))->first();
        return view('user.payment', ['type'=>'inquiry', 'data'=>$data]);
    }

    public function inquiryDetail($bill)
    {
        $data = Pay::where('billing_id', str_replace(' ', '', $bill))->first();
        return view('user.payment', ['type'=>'inquiry', 'data'=>$data]);
    }

    public function verify(Request $request, $id)
    {
        $code = $this->quickRandom();
        $data = Pay::findOrFail($id);
        $data->status = 'yes';
        $data->ntpn = $code;
        $data->date = date('Y-m-d');
        $data->save();
        $request->session()->flash('alert-info', 'Pembayaran berhasil dilakukan.');
        return redirect()->route('pelajar.billing.inquiryDetail', ['bill'=>$data->billing_id]);
    }

    public static function quickRandom($length = 16)
    {
        $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    public function ws(Request $request, $type)
    {
        if($type=="pembayaran"){
            $pay = Pay::where([['user_id', auth()->user()->id]])->whereNotNull('ntpn')->orderBy('year', 'desc')->get();
            $data = array();
            $no=1;
            foreach ($pay as $item){
                $data[] = array(
                    "id_sbr_data"=> $no++,
                    "npwp_1"=> $item->user->username,
                    "npwp_2"=> $item->user->username,
                    "masa_tahun_pajak"=> $item->year.$item->end_period,
                    "tgl_bayar"=> $item->date,
                    "ntpn"=> $item->ntpn,
                    "nominal"=> $item->amount,
                    "kode_akun_pajak"=> $item->deposit->type->code,
                    "kode_jenis_setoran"=> $item->deposit->code,
                    "no_ketetapan"=> $item->assignment_number,
                    "nomor_objek_pajak"=> null,
                    "no_sk"=>$item->assignment_number,
                    "kode_billing"=> $item->billing_id,
                );
            }

            return response()->json([
                'kdStatus'=>"1",
                "ketStatus"=>null,
                "message"=>$data,
            ]);

        }elseif($type=="pbkpengirim"){
            return response()->json([
                'kdStatus'=>"0",
                "ketStatus"=>"NOT FOUND",
                "message"=>null,
            ]);
        }elseif($type=="pbkpenerima"){
            return response()->json([
                'kdStatus'=>"0",
                "ketStatus"=>"NOT FOUND",
                "message"=>null,
            ]);
        }
    }
}
