<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use NextApps\VerificationCode\VerificationCode;
use App\Models\Spt;
use App\Models\User;
use App\Notifications\EmailNotification;
// use Mail;

class VerificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function sendCode(Request $request)
    {
        $email = auth()->user()->email;
        VerificationCode::send($email);
        
        return response()->json([
            'kdStatus'=>"1",
            "ketStatus"=>"Token Berhasil Dikirim",
            "message"=>null,
        ]);
        
    }

    public function verifyCode(Request $request)
    {
        $this->validate($request,[
            'token' => 'required|captcha',
        ]);

//        $email = auth()->user()->email;
//        $result = VerificationCode::verify($request->token, $email);
//        if($result){
            $status = ($request->jnsSpt=='1770SS') ? "2" : "1";
            $spt = Spt::where([
                ['user_id', auth()->user()->id], ['year', $request->thPajak],
                ['correction_to', $request->pembetulan], ['form_code', $request->jnsSpt], ['send_flag','<>', 2]
                ])->first();
            $spt->send_flag = 2;
            $spt->ntte = time().$spt->id;
            $spt->date = date('Y-m-d H:i:s');
            $spt->save();

            $user = User::findOrFail(auth()->user()->id);
            $body = "Berikut ini adalah Bukti Penerimaan Elektronik Anda.";
            $body .="<br>---------------------------------------------------";
            $body .="<br>Nama : ".$user->name;
            $body .="<br>NPWP : ".$user->username;
            $body .="<br>Tahun Pajak : ".$spt->year;
            $body .="<br>Masa Pajak : 01/12";
            $body .="<br>Jenis SPT : ".$spt->form_code;
            $body .="<br>Pembetulan ke :".$spt->correction_to;
            $body .="<br>Status SPT : Nihil";
            $body .="<br>Nominal : ".$spt->tax_value;
            $body .="<br>Tanggal Penyampaian : ".$spt->date;
            $body .="<br>Nomor Tanda Terima Elektronik : ".$spt->ntte;

            $messages = [
                'subject' => '[e-Filing] Bukti Penerimaan Elektronik',
                'greeting' => 'Hi '.$user->name.',',
                'body' => $body,
                'thanks' => 'Terima kasih telah menyampaikan Laporan SPT Anda.',
            ];

//            $user->notify(new EmailNotification($messages));

            return response()->json([
                'kdStatus'=>$status,
                "ketStatus"=>"Kode Berhasil Diverifikasi",
                "message"=>null,
            ]);
//        }else{
//            return response()->json([
//                'kdStatus'=>"3",
//                "ketStatus"=>"Kode Verifikasi Tidak Cocok",
//                "message"=>null,
//            ]);
//        }
    }

    public function html_email() {
        $data = array('name'=>"Virat Gandhi");
        Mail::send('mail', $data, function($message) {
           $message->to('garamasin26@gmail.com', 'Tutorials Point')->subject
              ('Laravel HTML Testing Mail');
           $message->from('robiansyah26@gmail.com','Robiansyah');
        });
        echo "HTML Email Sent. Check your inbox.";
     }

    public function feedback(Request $request)
    {
        $status = $request->status;
        $year = $request->thPajak;
        $correction = $request->pembetulan;
        $spt = $request->jnsSpt;

        return response()->json([
            'kdStatus'=>"1",
            "ketStatus"=>"Feedback berhasil",
            "message"=>null,
        ]);
    }

    public function sendBpe(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);
        $spt = Spt::findOrFail($request->id);
        if($user->id!=$spt->user_id){
            return response()->json([
                'kdStatus'=>"0",
                "ketStatus"=>null,
                "message"=>"Pengguna tidak cocok",
            ]);
        }

        $body = "Berikut ini adalah Bukti Penerimaan Elektronik Anda.";
        $body .="<br>---------------------------------------------------";
        $body .="<br>Nama : ".$user->name;
        $body .="<br>NPWP : ".$user->username;
        $body .="<br>Tahun Pajak : ".$spt->year;
        $body .="<br>Masa Pajak : 01/12";
        $body .="<br>Jenis SPT : ".$spt->form_code;
        $body .="<br>Pembetulan ke :".$spt->correction_to;
        $body .="<br>Status SPT : Nihil";
        $body .="<br>Nominal : ".$spt->tax_value;
        $body .="<br>Tanggal Penyampaian : ".$spt->date;
        $body .="<br>Nomor Tanda Terima Elektronik : ".$spt->ntte;

        $messages = [
            'subject' => '[e-Filing] Bukti Penerimaan Elektronik',
            'greeting' => 'Hi '.$user->name.',',
            'body' => $body,
            'thanks' => 'Terima kasih telah menyampaikan Laporan SPT Anda.',
        ];
        
        $user->notify(new EmailNotification($messages));

        return response()->json([
            'kdStatus'=>"1",
            "ketStatus"=>"Email Berhasil dikirim",
            "message"=>null,
        ]);
    }

}
