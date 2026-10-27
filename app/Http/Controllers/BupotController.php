<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Spt;
use App\Models\TaxDeposit;
use App\Models\TaxObject;
use App\Models\TaxType;
use App\Models\Pay;
use App\Models\User;
use App\Models\Bupot;
use App\Models\BupotCopy;
use App\Models\BupotDoc;
use App\Models\BupotSign;
use App\Models\BupotDeposit;
use App\Models\BupotBill;
use App\Models\PphComplete;
use App\Models\PphDoc;
use App\Models\Country;
use App\Models\Rate;
use App\Models\ClassStudent;
use App\Notifications\EmailNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Terbilang;
use DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class BupotController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified','spt']);
    }

    public function index()
    {
        return view('user.ebupot.dashboard');
    }

    public function pph(Request $request, $type)
    {
        $period = (!empty($request->period)) ? $request->period : '01';
        $year = (!empty($request->year)) ? $request->year : date('Y');

        if($type=='dftr-disetor-sendiri'){
            return view('user.ebupot.pph.self_list');
        }elseif ($type=='input-disetor-sendiri'){
            $data = BupotDeposit::where([['id', $request->id], ['npwp', auth()->user()->npwp]])->first();
            return view('user.ebupot.pph.self_input', [
                'jenis_input'=> ($request->status=='Pembetulan') ? 'Pembetulan' : 'Perekaman',
                'data' => $data,
            ]);
        }elseif ($type=='dftr-ps42152223'){
            $bupot = Bupot::select(DB::raw("idBupot, npwpPemotong as npwp, 
            CONCAT(msPajak,'-',thnPajak) AS periode, kdObjPjk, noBupot, idDipotong, namaDipotong as nmDipotong,
            jmlBruto, pphDipotong as jmlPphDipotong, fgPosting, fgStatus, revNo, kdJnsPjk as jnsPjk") )
                ->where([['kdBupot', 0],['npwpPemotong', auth()->user()->npwp], ['msPajak', $period], ['thnPajak', $year]])->get();

            return view('user.ebupot.pph.chapter_list',[
                'data' => $bupot,
                'period' => $period,
                'year' => $year,
            ]);
        }elseif ($type=='input-ps42152223'){
            $data = Bupot::where([['idBupot', $request->idBupot], ['npwpPemotong', auth()->user()->npwp]])->first();
            return view('user.ebupot.pph.chapter_input', [
                'jenis_input'=> ($request->status=='Pembetulan') ? 'Pembetulan' : 'Perekaman',
                'data' => $data,
            ]);
        }elseif ($type=='dftr-ps26'){
            return view('user.ebupot.pph.non_residen_list');
        }elseif ($type=='input-ps26'){
            $countries = Country::all();
            $data = Bupot::where([['idBupot', $request->idBupot], ['npwpPemotong', auth()->user()->npwp]])->first();
            return view('user.ebupot.pph.non_residen_input', [
                'jenis_input'=> ($request->status=='Pembetulan') ? 'Pembetulan' : 'Perekaman',
                'data' => $data,
                'countries' => $countries,
            ]);
        }elseif ($type=='impor-data'){
            return view('user.ebupot.pph.import');
        }elseif ($type=='posting'){
            return view('user.ebupot.pph.posting');
        }

    }

    public function spt(Request $request)
    {
        $year = (!empty($request->year)) ? $request->year : date('Y');
        $spt = Spt::where([['user_id', auth()->user()->id], ['form_code', 'PPHUNI'], ['year', $year]])->get();
        $class_student = ClassStudent::with('kelas')->where('student_id', auth()->user()->id)->first();
        return view('user.ebupot.spt',[
            'data' => $spt,
            'year' => $year,
            'class_student' => $class_student,
        ]);

    }

    public function storeSpt(Request $request){
        $this->validate($request,[
            'period' => 'required',
            'year' => 'required',
            'correction_to' => 'required'
        ]);

        $spt = Spt::where([['user_id', auth()->user()->id], ['send_flag', '<>', 2], ['form_code', 'PPHUNI'],
            ['start_period', $request->period], ['year', $request->year],
            ['correction_to', $request->correction_to]])->first();
        if($spt){
            $request->session()->flash('alert-error', 'SPT Masa '.$request->period.' '.$request->year.' Pembetulan Ke '.$request->correction_to.' Sudah Pernah Diposting');
            return redirect()->back();
        }

        DB::beginTransaction();
        try{
            $spt = new SPT;
            $spt->user_id = auth()->user()->id;
            $spt->correction_to = $request->correction_to;
            $spt->form_code = "PPHUNI";
            $spt->year = $request->year;
            $spt->start_period = $request->period;
            $spt->end_period = $request->period;
            $spt->date = date('Y-m-d H:i:s');
            $spt->status = 0;
            $spt->tax_value = 0;
            $spt->payment_value = 0;
            $spt->send_flag = 0;
            $spt->save();

            $com = new PphComplete;
            $com->spt_id = $spt->id;
            $com->save();

            $object = TaxObject::where('kdBupot', '3')->get();
            foreach ($object as $item){
                $doc = new PphDoc;
                $doc->spt_id = $spt->id;
                $doc->kdObjPjk =$item->kdObjPjk;
                $doc->save();
            }
            $tax_value = 0;
            $temp = "temp";
            $bupot = Bupot::where([['npwpPemotong', auth()->user()->npwp], ['thnPajak', $request->year], ['msPajak', $request->period]])->get();
            foreach ($bupot as $item){
                $item->fgPosting = 1;
                $item->save();
                $copy = $item->replicate();
                $copy->setTable('bupot_copy');
                $copy->spt_id = $spt->id;
                $copy->save();

                $kjs = $item->object->deposit->code;
                $kdMap = $item->object->deposit->type->code;
                $tax_value += $item->pphDipotong;

                $cek = BupotBill::where([['npwp', auth()->user()->npwp], ['spt_id', $spt->id], ['msPajak', $request->period], ['thnPajak', $request->year], ['kdMap', $kdMap], ['kjs', $kjs]])->first();
                if($cek){
                    $cek->pphDipotong += $item->pphDipotong;
                    $cek->save();
                }else{
                    BupotBill::create([
                        "spt_id"=> $spt->id,
                        "npwp"=> $item->npwpPemotong,
                        "msPajak"=> $request->period,
                        "thnPajak"=> $request->year,
                        "kdMap"=> $kdMap,
                        "kjs"=> $kjs,
                        "pphDipotong"=> $item->pphDipotong,
                        "pphDipotongLama"=> $item->pphDipotong,
                    ]);
                }

                if($item->kdObjPjk != $temp){
                    $doc = new PphDoc;
                    $doc->spt_id = $spt->id;
                    $doc->kdObjPjk =$item->kdObjPjk;
                    $doc->jmlBruto =$item->jmlBruto;
                    $doc->jmlPph =$item->pphDipotong;
                    $doc->save();
                }else{
                    $doc = PphDoc::where([['spt_id', $spt->id], ['kdObjPjk',  $item->kdObjPjk]])->first();
                    $doc->jmlBruto += $item->jmlBruto;
                    $doc->jmlPph += $item->pphDipotong;
                    $doc->save();
                }
                $temp = $item->kdObjPjk;
            }

            $spt->tax_value = $tax_value;
            $spt->status = ($tax_value > 0) ? 1 : 0;
            $spt->save();

            $temp = "temp";
            $bupot = BupotDeposit::where([['npwp', auth()->user()->npwp], ['fgSsKb', 1], ['msPajak', $request->period." - ".$request->period], ['thnPajak', $request->year]])->get();
            foreach ($bupot as $item){
                if($item->kdObjPjk != $temp){
                    $doc = new PphDoc;
                    $doc->spt_id = $spt->id;
                    $doc->kdObjPjk =$item->kdObjPajak;
                    $doc->jmlBruto =$item->jmlBruto;
                    $doc->jmlPph =$item->jmlSetor;
                    $doc->save();
                }else{
                    $doc = PphDoc::where([['spt_id', $spt->id], ['kdObjPjk',  $item->kdObjPjk]])->first();
                    $doc->jmlBruto += $item->jmlBruto;
                    $doc->jmlPph += $item->jmlSetor;
                    $doc->save();
                }
                $temp = $item->kdObjPjk;
            }

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }

        $request->session()->flash('alert-success', 'SPT Masa '.$request->period.' '.$request->year.' Pembetulan Ke '.$request->correction_to.' Berhasil Diposting');
        return redirect()->back();
    }

    public function detailSpt(Request $request, $id){
        $spt = Spt::findOrFail($id);
        $bupot = BupotCopy::where('spt_id', $spt->id)->get();
        $deposit = BupotDeposit::where('spt_id', $spt->id)->get();
        return view('user.ebupot.spt_send', [
            "data"=>$spt,
            "bupot"=>$bupot,
            "deposit"=>$deposit,
        ]);
    }

    public function cetakSpt(Request $request, $id)
    {
        $spt = Spt::findOrFail($id);
        $bupot = BupotCopy::where('spt_id', $spt->id)->get();
        $deposit = BupotDeposit::where('spt_id', $spt->id)->get();

        $pdf = Pdf::loadview('print.bupot_induk', [
            'data' => $spt,
            "bupot"=>$bupot,
            "deposit"=>$deposit,
        ]);
        return $pdf->download('bupot_induk.pdf');
    }

    public function setorSpt(Request $request, $id){
        $spt = Spt::findOrFail($id);
        $bill = BupotBill::where([['npwp', auth()->user()->npwp], ['spt_id', $spt->id]])->get();
        $deposit = BupotDeposit::where([['npwp', auth()->user()->npwp], ['spt_id', $spt->id]])->get();
        return view('user.pph21.spt_setor', [
            'spt' => $spt,
            'bill' => $bill,
            'deposit' => $deposit,
        ]);
    }

    public function statusSpt(Request $request, $id, $status){
        if($status=='approval'){
            $this->validate($request,[
                'captcha' => 'required|captcha',
            ]);

            $spt = Spt::findOrFail($id);
            $spt->send_flag = 2;
            $spt->ntte = time().$spt->id;
            $spt->date = date('Y-m-d H:i:s');
            $spt->save();
            $status = ($spt->tax_value > 0) ? 'Kurang Bayar' : 'Nihil';

            $user = User::findOrFail(auth()->user()->id);
            $body = "Berikut ini adalah Bukti Penerimaan Elektronik Anda.";
            $body .="<br>---------------------------------------------------";
            $body .="<br>Nama : ".$user->profile->corporate_name;
            $body .="<br>NPWP : ".$user->npwp;
            $body .="<br>Tahun Pajak : ".$spt->year;
            $body .="<br>Masa Pajak : ".$spt->start_period;
            $body .="<br>Jenis SPT : SPT PPh Unifikasi";
            $body .="<br>Pembetulan ke :".$spt->correction_to;
            $body .="<br>Status SPT : ".$status;
            $body .="<br>Nominal : ".$spt->tax_value;
            $body .="<br>Tanggal Penyampaian : ".$spt->date;
            $body .="<br>Nomor Tanda Terima Elektronik : ".$spt->ntte;

            $messages = [
                'subject' => '[e-Bupot] Bukti Penerimaan Elektronik',
                'greeting' => 'Hi '.$user->profile->corporate_name.',',
                'body' => $body,
                'thanks' => 'Terima kasih telah menyampaikan Laporan SPT Anda.',
            ];

            $user->notify(new EmailNotification($messages));

            $request->session()->flash('alert-success', 'SPT Masa '.$spt->start_period.' '.$spt->year.' Pembetulan Ke '.$spt->correction_to.' Berhasil Diupload');
            return redirect()->back();
        }elseif($status=='destroy'){
            $this->validate($request,[
                'captcha' => 'required|captcha',
            ]);

            $spt = Spt::findOrFail($id);
            if($spt->send_flag==2){
                $request->session()->flash('alert-error', 'SPT Masa '.$spt->start_period.' '.$spt->year.' Pembetulan Ke '.$spt->correction_to.' Tidak Dapat Dihapus');
                return redirect()->back();
            }
            PphDoc::where('spt_id', $id)->delete();
            PphComplete::where('spt_id', $id)->delete();
            BupotBill::where('spt_id', $spt->id)->delete();
            BupotDeposit::where('spt_id', $spt->id)->delete();
            $spt->delete();
            $request->session()->flash('alert-success', 'SPT Berhasil Dihapus');
            return redirect()->back();
        }
    }
    public function setting(Request $request, $type)
    {
        if($type=='penandatangan'){
            return view('user.ebupot.sign');
        }

    }

    public function cetak()
    {
        $data = Pay::where('user_id', auth()->user()->id)->latest('created_at')->first();
        $customPaper = array(0,0,612,1008);
        $pdf = Pdf::loadview('print.pph', [
            'data'=>$data,
        ])->setPaper($customPaper, 'potrait');

        return $pdf->download('nama.pdf');
    }

    public static function quickRandom($length)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    public function pphApi(Request $request, $type)
    {
        //pasal 4 ayat 2, 15, 22, 23
        if($type=='report_ps42152223' || $type=='report_ps26'){
            $data = Bupot::where('idBupot', $request->idBupot)->first();
            $customPaper = array(0,0,612,1008);
            $pdf = Pdf::loadview('print.pph', [
                'data'=>$data,
            ])->setPaper($customPaper, 'potrait');

            return response()->json([
                "status"=>"success",
                "code"=> 1,
                "timestamp"=> null,
                "error"=> null,
                "error_msg"=> null,
                "message"=> null,
                "path"=> null,
                "data"=> base64_encode($pdf->output()),
            ]);
        }elseif($type=='save_ps42152223'){
            if($request->jnsTrx==0){
                $cek = Bupot::where([['npwpPemotong', $request->npwpPemotong], ['msPajak', $request->msPajak], ['thnPajak', $request->thnPajak]])->orderBy('id', 'desc')->first();

                $bupot = Bupot::create([
                    "kdBupot"=> "0",
                    "idBupot"=> time()."-".$this->quickRandom(19),
                    "thnPajak"=> $request->thnPajak,
                    "msPajak"=> $request->msPajak,
                    "noBupot"=> ($cek) ? $cek->noBupot+1 : "2000000001",
                    "npwpPemotong"=> $request->npwpPemotong,
                    "fgIdDipotong"=> $request->fgIdDipotong,
                    "idDipotong"=> $request->idDipotong,
                    "namaDipotong"=> $request->namaDipotong,
                    "fgQq"=> $request->fgQq,
                    "namaQq"=> $request->namaQq,
                    "almtDipotong"=> $request->almtDipotong,
                    "kelDipotong"=> $request->kelDipotong,
                    "kecDipotong"=> $request->kecDipotong,
                    "kotaDipotong"=> $request->kotaDipotong,
                    "provDipotong"=> $request->provDipotong,
                    "kdPosDipotong"=> $request->kdPosDipotong,
                    "noTelpDipotong"=> $request->noTelpDipotong,
                    "fgNikErr"=> $request->fgNikErr,
                    "alasanNikTanpaValidasi"=> $request->alasanNikTanpaValidasi,
                    "kdObjPjk"=> $request->kdObjPjk,
                    "kdJnsPjk"=> $request->kdJnsPjk,
                    "fgFasilitas"=> $request->fgFasilitas,
                    "noSkb"=> $request->noSkb,
                    "noAturanDtp"=> $request->noAturanDtp,
                    "ntpnDtp"=> $request->ntpnDtp,
                    "noSKPP23"=> $request->noSKPP23,
                    "noDokLainnya"=> $request->noDokLainnya,
                    "jmlBruto"=> $request->jmlBruto,
                    "tarif"=> $request->tarif,
                    "tarifLt"=> $request->tarifLt,
                    "pphDipotong"=> $request->pphDipotong,
                    "fgStatus"=> $request->fgStatus,
                    "revNo"=> $request->revNo,
                    "tglPemotongan"=> date('Y-m-d'),
                    "fgTtdSebagai"=> 0,
                    "nikNpwpTtd"=> auth()->user()->npwp,
                    "namaTtd"=> auth()->user()->name,
                    "fgNikNpwpTtd"=> 0,
                    "fgLbDiprosesOleh"=> 0,
                    "createdBy"=> $request->createdBy,
                ]);

                $doc = $request->dokDasarPemotongan;
                $length = count($doc);
                for ($i=0; $i<$length; $i++){
                    BupotDoc::create([
                        "bupot_id"=> $bupot->id,
                        "jnsDok"=> $doc[$i]["jnsDok"],
                        "namaDok"=> $doc[$i]["namaDok"],
                        "nomorDok"=> $doc[$i]["nomorDok"],
                        "tglDok"=> date("Y-m-d", strtotime($doc[$i]["tglDok"])),
                    ]);
                }
            }else{
                $bupot = Bupot::where('idBupot', $request->idBupot)->first();
                $bupot->update([
                    "kdObjPjk"=> $request->kdObjPjk,
                    "kdJnsPjk"=> $request->kdJnsPjk,
                    "fgFasilitas"=> $request->fgFasilitas,
                    "noSkb"=> $request->noSkb,
                    "noAturanDtp"=> $request->noAturanDtp,
                    "ntpnDtp"=> $request->ntpnDtp,
                    "noSKPP23"=> $request->noSKPP23,
                    "noDokLainnya"=> $request->noDokLainnya,
                    "jmlBruto"=> $request->jmlBruto,
                    "tarif"=> $request->tarif,
                    "tarifLt"=> $request->tarifLt,
                    "pphDipotong"=> $request->pphDipotong,
                    "fgStatus"=> $request->fgStatus,
                    "revNo"=> $request->revNo,
                ]);

                //hapus doc lama
                BupotDoc::where('bupot_id', $bupot->id)->delete();

                //tambah doc baru
                $doc = $request->dokDasarPemotongan;
                $length = count($doc);
                for ($i=0; $i<$length; $i++){
                    BupotDoc::create([
                        "bupot_id"=> $bupot->id,
                        "jnsDok"=> $doc[$i]["jnsDok"],
                        "namaDok"=> $doc[$i]["namaDok"],
                        "nomorDok"=> $doc[$i]["nomorDok"],
                        "tglDok"=> date("Y-m-d", strtotime($doc[$i]["tglDok"])),
                    ]);
                }
            }

            return response()->json([
                "status"=>"success",
                "code"=> 1,
                "timestamp"=> null,
                "error"=> null,
                "error_msg"=> null,
                "message"=> null,
                "path"=> null,
                "data"=> null,
            ]);

            //pasal 26
        }elseif($type=="save_ps26"){
            if($request->jnsTrx==0) {
                $cek = Bupot::where([['npwpPemotong', $request->npwpPemotong], ['msPajak', $request->msPajak], ['thnPajak', $request->thnPajak]])->orderBy('id', 'desc')->first();
                $bupot = Bupot::create([
                    "kdBupot"=> "1",
                    "idBupot"=> time()."-".$this->quickRandom(19),
                    "thnPajak"=> $request->thnPajak,
                    "msPajak"=> $request->msPajak,
                    "noBupot"=> ($cek) ? $cek->noBupot+1 : "2000000001",
                    "npwpPemotong"=> $request->npwpPemotong,
                    "fgIdDipotong"=> $request->fgIdDipotong,
                    "idDipotong"=> $request->idDipotong,
                    "namaDipotong"=> $request->namaDipotong,
                    "almtDipotong"=> $request->almtDipotong,
                    "kdNgrDipotong"=> $request->kdNgrDipotong,
                    "namaNgrDipotong"=> $request->namaNgrDipotong,
                    "tempatLahirDipotong"=> $request->tempatLahirDipotong,
                    "tglLahirDipotong"=> ($request->tglLahirDipotong) ? date("Y-m-d", strtotime($request->tglLahirDipotong)) : null,
                    "noPasporDipotong"=> $request->noPasporDipotong,
                    "noKitasDipotong"=> $request->noKitasDipotong,
                    "kdObjPjk"=> $request->kdObjPjk,
                    "kdJnsPjk"=> $request->kdJnsPjk,
                    "fgFasilitas"=> $request->fgFasilitas,
                    "noSkdln"=> $request->noSkdln,
                    "noAturanDtp"=> $request->noAturanDtp,
                    "ntpnDtp"=> $request->ntpnDtp,
                    "noDokLainnya"=> $request->noDokLainnya,
                    "jmlBruto"=> $request->jmlBruto,
                    "kiraNetto"=> $request->kiraNetto,
                    "tarif"=> $request->tarif,
                    "pphDipotong"=> $request->pphDipotong,
                    "fgStatus"=> $request->fgStatus,
                    "revNo"=> $request->revNo,
                    "tglPemotongan"=> date("Y-m-d"),
                    "fgTtdSebagai"=> 0,
                    "nikNpwpTtd"=> auth()->user()->npwp,
                    "namaTtd"=> auth()->user()->name,
                    "fgNikNpwpTtd"=> 0,
                    "fgLbDiprosesOleh"=> 0,
                    "createdBy"=> $request->createdBy,
                ]);

                $doc = $request->dokDasarPemotongan;
                $length = count($doc);
                for ($i=0; $i<$length; $i++){
                    BupotDoc::create([
                        "bupot_id"=> $bupot->id,
                        "jnsDok"=> $doc[$i]["jnsDok"],
                        "namaDok"=> $doc[$i]["namaDok"],
                        "nomorDok"=> $doc[$i]["nomorDok"],
                        "tglDok"=> date("Y-m-d", strtotime($doc[$i]["tglDok"])),
                    ]);
                }
            }else{
                $bupot = Bupot::where('idBupot', $request->idBupot)->first();
                $bupot->update([
                    "fgIdDipotong"=> $request->fgIdDipotong,
                    "idDipotong"=> $request->idDipotong,
                    "namaDipotong"=> $request->namaDipotong,
                    "almtDipotong"=> $request->almtDipotong,
                    "kdNgrDipotong"=> $request->kdNgrDipotong,
                    "namaNgrDipotong"=> $request->namaNgrDipotong,
                    "tempatLahirDipotong"=> $request->tempatLahirDipotong,
                    "tglLahirDipotong"=> ($request->tglLahirDipotong) ? date("Y-m-d", strtotime($request->tglLahirDipotong)) : null,
                    "noPasporDipotong"=> $request->noPasporDipotong,
                    "noKitasDipotong"=> $request->noKitasDipotong,
                    "kdObjPjk"=> $request->kdObjPjk,
                    "kdJnsPjk"=> $request->kdJnsPjk,
                    "fgFasilitas"=> $request->fgFasilitas,
                    "noSkdln"=> $request->noSkdln,
                    "noAturanDtp"=> $request->noAturanDtp,
                    "ntpnDtp"=> $request->ntpnDtp,
                    "noDokLainnya"=> $request->noDokLainnya,
                    "jmlBruto"=> $request->jmlBruto,
                    "kiraNetto"=> $request->kiraNetto,
                    "tarif"=> $request->tarif,
                    "pphDipotong"=> $request->pphDipotong,
                    "fgStatus"=> $request->fgStatus,
                    "revNo"=> $request->revNo,
                ]);

                //hapus doc lama
                BupotDoc::where('bupot_id', $bupot->id)->delete();

                //tambah doc baru
                $doc = $request->dokDasarPemotongan;
                $length = count($doc);
                for ($i=0; $i<$length; $i++){
                    BupotDoc::create([
                        "bupot_id"=> $bupot->id,
                        "jnsDok"=> $doc[$i]["jnsDok"],
                        "namaDok"=> $doc[$i]["namaDok"],
                        "nomorDok"=> $doc[$i]["nomorDok"],
                        "tglDok"=> date("Y-m-d", strtotime($doc[$i]["tglDok"])),
                    ]);
                }
            }

            return response()->json([
                "status"=>"success",
                "code"=> 1,
                "timestamp"=> null,
                "error"=> null,
                "error_msg"=> null,
                "message"=> null,
                "path"=> null,
                "data"=> null,
            ]);
        }elseif($type=='dftr_fasilitas42' || $type=="dftr_fasilitas26"){
            return response()->json([
                "status"=> "error",
                "code"=> 0,
                "timestamp"=> null,
                "error"=> null,
                "error_msg"=> ($type=='dftr_fasilitas42') ? "DAFTFAS42152223005 - Fasilitas PPh 42152223 tidak ditemukan." : "DAFTFAS26 - Fasilitas PPh 26 tidak ditemukan.",
                "message"=> null,
                "path"=> null,
                "data"=> null
            ]);

        }elseif($type=="dftr_pphbp"){
            $kdBupot = $request->kdBupot;
            $period = $request->period;
            $year = $request->year;

            $bupot = Bupot::select(DB::raw("idBupot, npwpPemotong as npwp, 
            CONCAT(msPajak,'-',thnPajak) AS periode, kdObjPjk, noBupot, idDipotong, namaDipotong as nmDipotong,
            jmlBruto, pphDipotong as jmlPphDipotong, fgPosting, fgStatus, revNo, kdJnsPjk as jnsPjk") )
                ->where([['kdBupot', $kdBupot],['npwpPemotong', auth()->user()->npwp], ['msPajak', $period], ['thnPajak', $year]])->get();

            return response()->json([
                "status"=> (count($bupot)) ? "success" : "error",
                "code"=> (count($bupot)) ? 1 : 0,
                "timestamp"=> null,
                "error"=> null,
                "error_msg"=> (count($bupot)) ? null : "Data tidak ditemukan",
                "message"=> null,
                "path"=> null,
                "data"=> $bupot,
            ]);

            //posting
        }elseif($type=='cek_posting'){
            $spt = Spt::where([['user_id', auth()->user()->id], ['form_code', 'PPHUNI'], ['year', $request->thnPajak], ['start_period', $request->msPajak]])
                ->latest('created_at')->first();
            if($spt){
                if($spt->send_flag != 2){
                    $data = array(
                        "npwp"=> auth()->user()->npwp,
                        "thnPajak"=> $spt->year,
                        "msPajak"=> $spt->start_period,
                        "revNo"=> $spt->correction_to,
                        "jnsSpt"=> $spt->form_code
                    );
                    $message = "Anda akan memperbaharui SPT ".$spt->year."/".$spt->start_period." revisi ke-".$spt->correction_to;
                }else{
                    $data = array(
                        "npwp"=> auth()->user()->npwp,
                        "thnPajak"=> $spt->year,
                        "msPajak"=> $spt->start_period,
                        "revNo"=> $spt->correction_to+1,
                        "jnsSpt"=> $spt->form_code
                    );
                    $message = "Anda akan membuat SPT baru ".$request->thnPajak."/".$request->msPajak." revisi ke-".$spt->correction_to+1;
                }
            }else{
                $data = array(
                    "npwp"=> auth()->user()->npwp,
                    "thnPajak"=> $request->thnPajak,
                    "msPajak"=> $request->msPajak,
                    "revNo"=> "0",
                    "jnsSpt"=> "PPHUNI"
                );
                $message = "Anda akan membuat SPT baru ".$request->thnPajak."/".$request->msPajak." revisi ke-0";
            }
            return response()->json([
                "status"=> "success",
                "code"=> 1,
                "timestamp"=> null,
                "error"=> null,
                "error_msg"=> null,
                "message"=> $message,
                "path"=> null,
                "data"=> $data,
            ]);
        }elseif($type=='kirim_posting'){
            $bupot = Bupot::where([['thnPajak', $request->thnPajak], ['msPajak', $request->msPajak]])->get();
            //update bill to 0
            $bupot_bill = BupotBill::where([['npwp', auth()->user()->npwp], ['msPajak', $request->msPajak], ['thnPajak', $request->thnPajak]])->get();
            if(count($bupot_bill)){
                foreach ($bupot_bill as $item){
                    $item->pphDipotong = 0;
                    $item->save();
                }
            }
            $tax_value = 0;
            foreach ($bupot as $item){
                $item->fgPosting = 1;
                $item->save();
                if($item->fgStatus==0){
                    $kjs = $item->object->deposit->code;
                    $kdMap = $item->object->deposit->type->code;
                    $tax_value += $item->pphDipotong;

                    $cek = BupotBill::where([['npwp', auth()->user()->npwp], ['msPajak', $request->msPajak], ['thnPajak', $request->thnPajak], ['kdMap', $kdMap], ['kjs', $kjs]])->first();
                    if($cek){
                        $cek->pphDipotong += $item->pphDipotong;
                        $cek->save();
                    }else{
                        BupotBill::create([
                            "npwp"=> $item->npwpPemotong,
                            "msPajak"=> $request->msPajak,
                            "thnPajak"=> $request->thnPajak,
                            "kdMap"=> $kdMap,
                            "kjs"=> $kjs,
                            "pphDipotong"=> $item->pphDipotong,
                            "pphDipotongLama"=> $item->pphDipotong,
                        ]);
                    }
                }
            }

            $cek = Spt::where([['user_id', auth()->user()->id], ['form_code', 'PPHUNI'], ['year', $request->thnPajak], ['start_period', $request->msPajak], ['correction_to', $request->revNo]])->first();
            if($cek){
                //ambil data pphdoc
                $doc = PphDoc::where('spt_id', $cek->id)->get();
                foreach ($doc as $item){
                    if($item->object->kdBupot == 3){
                        $tax_value += $item->jmlPPh;
                    }else{
                        $item->delete();
                    }
                }
                $cek->tax_value = $tax_value;
                $cek->save();

            }else{
                DB::beginTransaction();
                try{
                    $spt = new SPT;
                    $spt->user_id = auth()->user()->id;
                    $spt->correction_to = $request->revNo;
                    $spt->form_code = "PPHUNI";
                    $spt->year = $request->thnPajak;
                    $spt->start_period = $request->msPajak;
                    $spt->end_period = $request->msPajak;
                    $spt->date = date('Y-m-d H:i:s');
                    $spt->status = 1;
                    $spt->tax_value = $tax_value;
                    $spt->payment_value = 0;
                    $spt->send_flag = 0;
                    $spt->save();

                    $com = new PphComplete;
                    $com->spt_id = $spt->id;
                    $com->save();

                    $object = TaxObject::where('kdBupot', '3')->get();
                    foreach ($object as $item){
                        $doc = new PphDoc;
                        $doc->spt_id = $spt->id;
                        $doc->kdObjPjk =$item->kdObjPjk;
                        $doc->save();
                    }

                    DB::commit();
                }catch(\Exception $e){
                    DB::rollback();
                }

            }

            $bupot = Bupot::where([['thnPajak', $request->thnPajak], ['msPajak', $request->msPajak], ['fgStatus', 0]])->get();
            $temp = "temp";
            foreach ($bupot as $item){
                if($item->kdObjPjk != $temp){
                    $doc = new PphDoc;
                    $doc->spt_id = ($cek) ? $cek->id : $spt->id;
                    $doc->kdObjPjk =$item->kdObjPjk;
                    $doc->jmlBruto =$item->jmlBruto;
                    $doc->jmlPph =$item->pphDipotong;
                    $doc->save();
                }else{
                    $doc = PphDoc::where([['spt_id', ($cek) ? $cek->id : $spt->id], ['kdObjPjk',  $item->kdObjPjk]])->first();
                    $doc->jmlBruto += $item->jmlBruto;
                    $doc->jmlPph += $item->pphDipotong;
                    $doc->save();
                }
                $temp = $item->kdObjPjk;
            }

            $deposit = BupotDeposit::where([['npwp', auth()->user()->npwp],['fgSskb', '1'],['thnPajak', $request->thnPajak], ['msPajak', $request->msPajak." - ".$request->msPajak]])->get();
            if(count($deposit)){
                foreach ($deposit as $item){
                    if($item->kdObjPajak != $temp){
                        $doc = new PphDoc;
                        $doc->spt_id = ($cek) ? $cek->id : $spt->id;
                        $doc->kdObjPjk =$item->kdObjPajak;
                        $doc->jmlBruto =$item->jmlBruto;
                        $doc->jmlPph =$item->jmlSetor;
                        $doc->save();
                    }else{
                        $doc = PphDoc::where([['spt_id', ($cek) ? $cek->id : $spt->id], ['kdObjPjk',  $item->kdObjPajak]])->first();
                        $doc->jmlBruto += $item->jmlBruto;
                        $doc->jmlPph += $item->jmlSetor;
                        $doc->save();
                    }

                    $temp = $item->kdObjPajak;
                }
            }

            return response()->json([
                "status"=>"success",
                "code"=> 1,
                "timestamp"=> null,
                "error"=> null,
                "error_msg"=> null,
                "message"=> null,
                "path"=> null,
                "data"=> array(
                    "idSpt"=> ($cek) ? $cek->id : $spt->id,
                ),
            ]);

            //setor sendiri
        }elseif($type=="dftr_pphss"){
            $bupot = BupotDeposit::select(DB::raw("id, npwp, kdObjPajak,
            CONCAT(msPajak,'-',thnPajak) AS periode, noBuktiSetor, jmlBruto, jmlSetor, idSetor") )
                ->where([['npwp', auth()->user()->npwp], ['fgSsKb', 1]]);

            $msPajak = $request->period." - ".$request->period;
            $thnPajak = $request->year;
            $bupot->where([['msPajak', $msPajak], ['thnPajak', $thnPajak]]);


            $result = $bupot->get();

            return response()->json([
                "status"=> (count($result)) ? "success" : "error",
                "code"=> (count($result)) ? 1 : 0,
                "timestamp"=> null,
                "error"=> null,
                "error_msg"=> (count($result)) ? null : "Data tidak ditemukan",
                "message"=> null,
                "path"=> null,
                "data"=> $result,
            ]);
        }elseif($type=="check_laporspt" || $type=='checkbs_laporspt'){
            return response()->json([
                "status"=> "success",
                "code"=> 1,
                "timestamp"=> null,
                "error"=> null,
                "error_msg"=> null,
                "message"=> null,
                "path"=> null,
                "data"=> array(
                    "fgLapor" => "0"
                ),
            ]);
        }elseif($type=='delete_bp_ps42152223'){
            $bupot = Bupot::where('idBupot', $request->idBupot)->first();
            $bupot->delete();

            return response()->json([
                "status"=> "success",
                "code"=> 1,
                "timestamp"=> null,
                "error"=> null,
                "error_msg"=> null,
                "message"=> null,
                "path"=> null,
                "data"=> null,
            ]);
            // }elseif($type=='email_ps42152223'){
        }elseif ($type=='ter'){
            $bruto = $request->bruto;
            $ptkp = $this->itungPtkp($request->ptkp);
            $rate = Rate::where([['start', '<', $bruto], ['end', '>=', $bruto], ['category', ($ptkp < 63000000) ? 'A' : (($ptkp <72000000) ? 'B' : 'C')]])->first();

            return response()->json([
                "status"=>"success",
                "code"=> ($rate) ? 1 : 0,
                "timestamp"=> null,
                "error"=> null,
                "error_msg"=> null,
                "message"=> null,
                "path"=> null,
                "data"=> ($rate) ? $rate->rates : 0,
            ]);
        }
    }

    public function commonApi(Request $request, $type)
    {
        if($type=='check_ntpn'){
            //$npwp = $request->npwpSsp;
            $username = auth()->user()->username;
            $pay = Pay::where([['ntpn', $request->ntpn], ['year', $request->thnPajak]])
                ->whereHas('user', function ($query) use ($username){
                    $query->where('username', $username);
                })->first();
            if($pay){
                $data = array(
                    "thPajak"=> $request->thnPajak,
                    "msPajak"=> $pay->start_period.' - '.$pay->end_period,
                    "jnsPajak"=> $pay->deposit->type->code.' - '.$pay->deposit->type->name,
                    "jnsSetoran"=> $pay->deposit->name,
                    "jmlSetor"=> $pay->amount,
                    "tglSetor"=> $pay->date,
                    "kjs"=> $pay->deposit->code,
                    "kdMap"=> $pay->deposit->type->code
                );
            }

            return response()->json([
                "status"=> ($pay) ? "success" : "error",
                "code"=> ($pay) ? 1 : 0,
                "timestamp"=> null,
                "error"=> null,
                "error_msg"=> ($pay) ? null : "Data tidak ditemukan",
                "message"=> null,
                "path"=> null,
                "data"=> ($pay) ? $data : null,
            ]);
        }elseif($type=='obj_pjk_pphall' || $type=='obj_pjk_pphss'){
            if($type=='obj_pjk_pphall'){
                $data = TaxObject::where('kdBupot', $request->kdbupot)->get();
            }else{
                $data = TaxObject::where('kdBupot', 2)->get();
            }

            return response()->json([
                "status"=>"success",
                "code"=> 1,
                "timestamp"=> null,
                "error"=> null,
                "error_msg"=> null,
                "message"=> null,
                "path"=> null,
                "data"=> $data,
            ]);
        }elseif ($type=='get_tarif'){
            $object = TaxObject::where('kdObjPjk', $request->kdObjPjk)->first();

            return response()->json([
                "status"=> ($object) ? "success" : "error",
                "code"=> ($object) ? 1 : 0,
                "timestamp"=> null,
                "error"=> null,
                "error_msg"=> ($object) ? null : "Data tidak ditemukan",
                "message"=> null,
                "path"=> null,
                "data"=> array(
                    "kdObjPjk"=> $request->kdObjPjk,
                    "tarif"=> ($object) ? $object->tarif : 20,
                ),
            ]);
        }else{
            $data = array(
                "idBupot"=> "f615d141-6a06-4b44-a4f0-8d65f6a60ce4",
                "npwp"=> "390114916652000",
                "periode"=> "07-2023",
                "kdObjPjk"=> "24-104-03",
                "noBupot"=> "2000000001",
                "idDipotong"=> "768599839645000",
                "nmDipotong"=> "FADLIL ABDANI",
                "jmlBruto"=> "50000",
                "jmlPphDipotong"=> "1000",
                "fgPosting"=> "1",
                "fgStatus"=> "0",
                "revNo"=> "0",
                "tglBupot"=> "02/07/2023",
                "jnsPjk"=> "PPH23"
            );
            return response()->json([
                "status"=>"success",
                "code"=> 1,
                "timestamp"=> null,
                "error"=> null,
                "error_msg"=> null,
                "message"=> null,
                "path"=> null,
                "data"=> [$data],
            ]);
        }
    }

    public function sptApi(Request $request, $type)
    {
        if ($type == 'save_buktisetor') {
            $pay = Pay::where([['user_id', auth()->user()->id], ['ntpn', $request->noBuktiSetor]])->first();
            $spt =Spt::findOrFail($request->spt_id);
            $msPajak = $spt->start_period." - ".$spt->end_period;
            if($msPajak==$request->msPajak){
                BupotDeposit::create([
                    "spt_id"=> $request->spt_id,
                    "npwp"=> auth()->user()->npwp,
                    "npwpSsp"=> auth()->user()->npwp,
                    "noBuktiSetor"=> $request->noBuktiSetor,
                    "fgPbkBpe"=> $request->fgPbkBpe,
                    "fgSsKb"=> $request->fgSsKb,
                    "thnPajak"=> $request->thnPajak,
                    "msPajak"=> $request->msPajak,
                    "kdMap"=> $request->kdMap,
                    "kdJnsSetor"=> $request->kdJnsSetor,
                    "kdObjPajak"=> $request->kdObjPajak,
                    "jmlBruto"=> $request->jmlBruto,
                    "idSetor"=> $pay->id,
                    "jmlSetor"=> $request->jmlSetor,
                    "tglSetor"=> $request->tglSetor,
                ]);

                $spt->payment_value += $request->jmlSetor;
                $spt->save();
            }

            return response()->json([
                "status" => ($msPajak==$request->msPajak) ? "success" : "error",
                "code" => ($msPajak==$request->msPajak) ? 1 : 0,
                "timestamp" => null,
                "error_msg" => ($msPajak==$request->msPajak) ? null : "Masa Pajak Tidak Sesuai",
                "error" => null,
                "message" => null,
                "path" => null,
                "data" => null,
            ]);
        }elseif($type=="save_bukti_setor"){
            $pay = Pay::where([['user_id', auth()->user()->id], ['ntpn', $request->noBuktiSetor]])->first();

            BupotDeposit::create([
                "npwp"=> auth()->user()->npwp,
                "npwpSsp"=> auth()->user()->npwp,
                "noBuktiSetor"=> $request->noBuktiSetor,
                "fgPbkBpe"=> $request->fgPbkBpe,
                "fgSsKb"=> $request->fgSsKb,
                "thnPajak"=> $request->thnPajak,
                "msPajak"=> $request->msPajak,
                "kdMap"=> $request->kdMap,
                "kdJnsSetor"=> $request->kdJnsSetor,
                "kdObjPajak"=> $request->kdObjPajak,
                "jmlBruto"=> $request->jmlBruto,
                "idSetor"=> $pay->id,
                "jmlSetor"=> $request->jmlSetor,
                "tglSetor"=> $request->tglSetor,
            ]);

            return response()->json([
                "status" => "success",
                "code" => 1,
                "timestamp" => null,
                "error_msg" => null,
                "error" => null,
                "message" => null,
                "path" => null,
                "data" => null,
            ]);
        }elseif($type=="edit_bukti_setor"){
            BupotDeposit::where([['id', $request->id]])
                ->update([
                    "kdObjPajak"=> $request->kdObjPajak,
                    "jmlBruto"=> $request->jmlBruto,
                    "jmlSetor"=> $request->jmlSetor,
                ]);
            return response()->json([
                "status" => "success",
                "code" => 1,
                "timestamp" => null,
                "error" => null,
                "error_msg" => null,
                "message" => null,
                "path" => null,
                "data" => null,
            ]);
        }elseif($type=="check_buktisetor"){
            $bupot = BupotDeposit::where([['idSetor', $request->idSetor], ['noBuktiSetor', $request->noBuktiSetor]])->first();
            return response()->json([
                "status" => ($bupot) ? "success" : "error",
                "code" => ($bupot) ? 1 : 0,
                "timestamp" => null,
                "error" => null,
                "error_msg" => ($bupot) ? null : "Data tidak ditemukan",
                "message" => ($bupot) ? "Data berhasil dihapus" : null,
                "path" => null,
                "data" => array(
                    "fgLapor"=> "0"
                ),
            ]);
        }elseif($type=="delete_buktisetor"){
            $bupot = BupotDeposit::where([['id', $request->id], ['npwp', auth()->user()->npwp]])->first();
            if($bupot){
                if($bupot->spt_id!=''){
                    $spt = Spt::findOrFail($request->spt_id);
                    $spt->payment_value -= $bupot->jmlSetor;
                    $spt->save();
                }
                $bupot->delete();
            }
            return response()->json([
                "status" => ($bupot) ? "success" : "error",
                "code" => ($bupot) ? 1 : 0,
                "timestamp" => null,
                "error" => null,
                "error_msg" => ($bupot) ? null : "Data tidak ditemukan",
                "message" => null,
                "path" => null,
                "data" => "Bukti Setor berhasil dihapus",
            ]);
        }elseif($type=="dftr_tagihan"){
            $bill = BupotBill::where([['npwp', auth()->user()->npwp], ['spt_id', $request->spt_id], ['msPajak', $request->msPajak], ['thnPajak', $request->thnPajak]])->get();
            $data = array();
            foreach ($bill as $item) {
                if($item->pphDipotong!=$item->pphDipotongLama){
                    $item->kdBilling = null;
                    $item->pphDipotongLama = $item->pphDipotong;
                    $item->save();
                }
                $data[] = array(
                    "kdMap" => $item->kdMap,
                    "kjs" => $item->kjs,
                    "pphDipotong" => $item->pphDipotong,
                    "kdBilling" => $item->kdBilling
                );
            }
            return response()->json([
                "status" => "success",
                "code" => 1,
                "timestamp" => null,
                "error" => null,
                "error_msg" => null,
                "message" => null,
                "path" => null,
                "data" => $data,
            ]);
        }elseif($type=="dftr_pembayaran"){
            $deposit = BupotDeposit::where([['npwp', auth()->user()->npwp], ['spt_id', $request->spt_id], ['msPajak', $request->msPajak." - ".$request->msPajak], ['thnPajak', $request->thnPajak], ['fgSsKb', '0']])->get();
            $data = array();
            foreach ($deposit as $item){
                $data[] = array(
                    "id"=>$item->id,
                    "idSetor"=> $item->idSetor,
                    "noBuktiSetor"=> $item->noBuktiSetor,
                    "jnsPajak"=> $item->kdMap,
                    "jnsSetoran"=> $item->kdJnsSetor,
                    "periode"=> substr($item->msPajak, 0, 2).substr($item->msPajak, 5).$item->year,
                    "tglSetor"=> $item->tglSetor,
                    "jmlSetor"=> $item->jmlSetor
                );
            }
            return response()->json([
                "status" => (count($deposit)) ? "success" : "error",
                "code" => (count($deposit)) ? 1 : 0,
                "timestamp" => null,
                "error" => null,
                "error_msg" => null,
                "message" => null,
                "path" => null,
                "data" => $data,
            ]);
        }elseif($type=="dftr_ringkasan"){
            $bill = BupotBill::where([['npwp', auth()->user()->npwp], ['type', $request->type], ['msPajak', $request->msPajak], ['thnPajak', $request->thnPajak]])->get();
            $data = array();
            foreach ($bill as $item){
                $setor = 0;
                $deposit = BupotDeposit::where([['npwp', auth()->user()->npwp], ['type', $request->type], ['msPajak', $request->msPajak." - ".$request->msPajak], ['thnPajak', $request->thnPajak],
                    ['fgSsKb', '0'], ['kdMap', $item->kdMap], ['kdJnsSetor', $item->kjs]])->get();
                if(count($deposit)){
                    foreach ($deposit as $key){
                        $setor +=$key->jmlSetor;
                    }
                }
                $data[] = array(
                    "kdMap"=> $item->kdMap,
                    "kjs"=> $item->kjs,
                    "pphDipotong"=> $item->pphDipotong,
                    "pphDisetor"=> $setor,
                    "selisih"=> $item->pphDipotong-$setor
                );
            }

            return response()->json([
                "status" => "success",
                "code" => 1,
                "timestamp" => null,
                "error" => null,
                "error_msg" => null,
                "message" => null,
                "path" => null,
                "data" => $data,
            ]);
        }elseif($type=="save_lengkapi"){
            // update
            PphComplete::where('spt_id', $request->idSpt)
                ->update([
                    "fgDOSS"=> $request->fgDOSS,
                    "kdObjPjk7"=> $request->kdObjPjk7,
                    "fgSebagai"=> $request->fgSebagai,
                    "fgNikNpwp"=> $request->fgNikNpwp,
                    "nikNpwpTtd"=> $request->nikNpwpTtd,
                    "nmWpTtd"=> $request->nmWpTtd,
                ]);
            $doc = $request->dokDipersamakan;
            $tax = 0;
            if($doc){
                $length = count($doc);
                for ($i=0; $i<$length; $i++){
                    PphDoc::where([['spt_id', $request->idSpt],['kdObjPjk', $doc[$i]["kdObjPjk"]]])->update([
                        "jmlPph"=> $doc[$i]["jmlPph"],
                        "jmlBruto"=> $doc[$i]["jmlBruto"],
                    ]);
                    $tax += $doc[$i]["jmlPph"];
                }
            }

            //cari spt
            $spt = Spt::findOrFail($request->idSpt);
            $bupot = Bupot::where([['thnPajak', $spt->year], ['msPajak', $spt->start_period]])->get();
            foreach ($bupot as $item){
                if($item->fgPosting == 1 && $item->fgStatus == 0){
                    $tax += $item->pphDipotong;
                }
            }
            //update spt
            $spt->tax_value = $tax;
            $spt->save();

            return response()->json([
                "status" => "success",
                "code" => 1,
                "timestamp" => null,
                "error" => null,
                "error_msg" => null,
                "message" => null,
                "path" => null,
                "data" => null,
            ]);
        }elseif($type=="dftr_spt"){
            $spt = Spt::where([['user_id', auth()->user()->id], ['form_code', 'PPHUNI']])->orderBy('year', 'desc')->orderBy('start_period', 'desc')->get();
            $data = array();
            foreach ($spt as $item){
                $data[] = array(
                    "idSpt"=> $item->id,
                    "thnPajak"=> $item->year,
                    "msPajak"=> $item->start_period,
                    "revNo"=> $item->correction_to,
                    "jmlPphKs"=> $item->tax_value,
                    "stsSpt"=> $item->status
                );
            }

            return response()->json([
                "status" => "success",
                "code" => 1,
                "timestamp" => null,
                "error" => null,
                "error_msg" => null,
                "message" => null,
                "path" => null,
                "data" => $data,
            ]);
        }elseif($type=="save_kirim"){

        }elseif($type=="create_billing"){
            $type = TaxType::where('code', $request->kdMap)->first();
            $deposit = TaxDeposit::where([['type_id', $type->id], ['code', $request->kdJnsPjk]])->first();
            $randomNumber = random_int(10000, 99999);
            //buat billing
            $pay = new Pay;
            $pay->user_id = auth()->user()->id;
            $pay->wp_type = auth()->user()->wp_type;
            $pay->deposit_id = $deposit->id;
            $pay->start_period = $request->msPajak;
            $pay->end_period = $request->msPajak;
            $pay->year = $request->thnPajak;
            $pay->assignment_number = IdGenerator::generate(['table' => 'pays','field'=>'assignment_number', 'length' => 15, 'reset_on_prefix_change'  => true, 'prefix' => date($request->msPajak.'.y-')]);
            $pay->amount = $request->nominal;
            $pay->billing_id = time().$randomNumber;
            $pay->save();
            //expired +1 month
            $expired = date('d-m-Y H:i:s',strtotime($pay->created_at . "+1 month"));

            //update bupot billing
            BupotBill::where([['npwp', auth()->user()->npwp], ['msPajak', $request->msPajak], ['thnPajak', $request->thnPajak], ['kdMap', $request->kdMap], ['kjs', $request->kdJnsPjk]])
                ->update(['kdBilling'=> $pay->billing_id]);

            return response()->json([
                "status" => "success",
                "code" => 1,
                "timestamp" => null,
                "error" => null,
                "error_msg" => null,
                "message" => null,
                "path" => null,
                "data" => array(
                    "billingId"=> $pay->billing_id,
                    "billingExpdate"=> $expired,
                    "responseCode"=> "00",
                    "responseDescription"=> "Pembuatan kode billing berhasil."
                ),
            ]);
        }elseif($type=="report_billing"){
            $data = Pay::where('billing_id', $request->kdBilling)->first();
            $pdf = Pdf::loadview('print.billing', [
                'data'=>$data,
            ]);

            return response()->json([
                "status"=>"success",
                "code"=> 1,
                "timestamp"=> null,
                "error"=> null,
                "error_msg"=> null,
                "message"=> null,
                "path"=> null,
                "data"=> base64_encode($pdf->output()),
            ]);
        }
    }

    public function itungPtkp($val) {
        $kd = substr($val,0,1);
        $jml = substr($val,-1);
        $nptkp = 54000000;
        $ntbh = 4500000;
        if ($kd == '2') {
            return ($nptkp * 2) + (($jml + 1) * $ntbh);
        } else if ($kd == '1') {
            return $nptkp + (($jml + 1) * $ntbh);
        } else {
            return $nptkp + ($jml * $ntbh);
        }
    }

}
