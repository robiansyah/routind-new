<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spt;
use App\Models\ClassStudent;
use App\Models\SptType;
use App\Models\InvoiceInput;
use App\Models\InvoiceOutput;
use App\Models\ReturInput;
use App\Models\ReturOutput;
use App\Models\OtherInput;
use App\Models\OtherOutput;
use App\Models\PpnDok;
use App\Models\PpnFaktur;
use App\Models\PpnInduk;
use App\Models\Income;
use App\Models\Country;
use App\Models\TaxObject;
use App\Models\BupotFinal;
use App\Models\BupotBill;
use App\Models\PphDoc;
use App\Models\PphFinal;
use App\Models\PphIncome;
use App\Models\Bupot;
use App\Models\BupotCopy;
use App\Models\BupotDeposit;
use App\Models\PphComplete;
use App\Models\User;
use App\Models\Pay;
use App\Models\PayBill;

use DB;
use App\Notifications\EmailNotification;

class SptNewController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified', 'spt']);
    }

    public function index(Request $request, $status)
    {
        $jenis = !empty($request->jenis) ? $request->jenis : 'all';
        $tahun = !empty($request->tahun) ? $request->tahun : 'all';
        $status = ($status=='konsep') ? 0 : (($status=='menunggu') ? 1 : (($status=='selesai') ? 2 : 3));

        $class_student = ClassStudent::with('kelas')->where('student_id', auth()->user()->id)->first();
        $spt = Spt::with('question')->where([['user_id', auth()->user()->id], ['send_flag', $status]]);
        if($jenis!='all'){
            $spt->where('type_code', $jenis);
        }else{
            $spt->whereIn('type_code', array('PPH21', 'PPHUNI', 'PPN1111'));
        }
        if($tahun!='all'){
            $spt->where('year', $tahun);
        }

        $data = $spt->orderBy('year', 'desc')->orderBy('created_at', 'desc')->get();
        return view('spt.index',[
            'data' => $data,
            'class_student' => $class_student,
            'status' => $status,
            'tahun' => $tahun,
            'jenis' => $jenis,
            'list_jenis' => SptType::where('id', '>', '2')->get(),
        ]);
    }

    public function show(Request $request, $id)
    {
        $spt = Spt::findOrFail($id);
        if($spt->type_code=='PPN1111'){
            $induk = PpnInduk::where('spt_id', $id)->first();
            if(!$induk){
                $request->session()->flash('alert-error', 'SPT Tidak Ditemukan');
                return redirect()->back();
            }
            $dok = PpnDok::where('spt_id', $id)->get();
            $faktur = PpnFaktur::where('spt_id', $id)->orderBy('invoice_no')->orderBy('transaction_code')->get();

            return view('user.faktur.spt_detail', [
                'induk' => $induk,
                'dok' => $dok,
                'faktur' => $faktur,
            ]);
        }elseif($spt->type_code=='PPH21'){
            $tidak = PphDoc::where('spt_id', $id)
                ->whereHas('object', function ($query){
                    $query->whereIn('kdBupot', array('4','5'));
                })->orderBy('kdObjPjk')->get();
            $final = PphDoc::where('spt_id', $id)
                ->whereHas('object', function ($query){
                    $query->where('kdBupot', '6');
                })->orderBy('kdObjPjk')->get();

            return view('user.pph21.spt_detail', [
                'spt' => $spt,
                'tidak' => $tidak,
                'final' => $final,
            ]);
        }elseif($spt->type_code=='PPHUNI'){
            $bupot = BupotCopy::where('spt_id', $spt->id)->get();
            $deposit = BupotDeposit::where('spt_id', $spt->id)->get();
            return view('user.ebupot.spt_send', [
                "data"=>$spt,
                "bupot"=>$bupot,
                "deposit"=>$deposit,
            ]);
        }else{
            $request->session()->flash('alert-error', 'SPT Tidak Ditemukan');
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $data = Spt::findOrFail($id);
        $data->send_flag = 3;
        $data->save();

        $request->session()->flash('alert-success', 'SPT Berhasil Dihapus');
        return redirect()->route('spt.index', ['status'=>'dibatalkan']);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'type_code' => 'required',
            'year' => 'required',
            'period' => 'required',
            'correction_to' => 'required',
        ]);

//        $spt = Spt::where([['user_id', auth()->user()->id], ['send_flag', '<>', 2], ['type_code', $request->type_code],
//            ['start_period', $request->period], ['year', $request->year],
//            ['correction_to', $request->correction_to]])->first();
//        if($spt){
//            $request->session()->flash('alert-error', 'SPT Masa '.$request->period.' '.$request->year.' Pembetulan Ke '.$request->correction_to.' Sudah Pernah Diposting');
//            return redirect()->back();
//        }

        DB::beginTransaction();
        try{
            $spt = new SPT;
            $spt->user_id = auth()->user()->id;
            $spt->correction_to = $request->correction_to;
            $spt->form_code = $request->type_code;
            $spt->type_code = $request->type_code;
            $spt->year = $request->year;
            $spt->date = date('Y-m-d H:i:s');
            $spt->start_period = $request->period;
            $spt->end_period = ($request->type_code=='1770' || $request->type_code=='1771') ? 12 : $request->period;
            $spt->status = 0;
            $spt->tax_value = 0;
            $spt->payment_value = 0;
            $spt->send_flag = 0;
            $spt->save();

            if($request->type_code=='PPN1111'){
                $lampiran = array("ab");
                $ekspor = OtherOutput::where([['user_id', auth()->user()->id], ['other_period', $request->period],
                    ['other_year', $request->year], ['approval', 'Approved'], ['status', 'Normal']])->get();
                if(count($ekspor)){
                    foreach($ekspor as $item){
                        PpnDok::create([
                            'spt_id' => $spt->id,
                            'type' => 'A1',
                            'name' => $item->transaction_name,
                            'doc_no' => $item->other_no,
                            'doc_date' => $item->other_date,
                            'dpp' => ($item->status=='Normal') ? $item->dpp : 0,
                            'ppn' => ($item->status=='Normal') ? $item->ppn : 0,
                            'ppnbm' => ($item->status=='Normal') ? $item->ppnbm : 0,
                        ]);
                    }
                    $lampiran[] = "a1";
                }

                $impor = OtherInput::where([['user_id', auth()->user()->id], ['other_period', $request->period],
                    ['other_year', $request->year], ['approval', 'Approved'], ['status', 'Normal']])->get();
                if(count($impor)){
                    foreach($impor as $item){
                        PpnDok::create([
                            'spt_id' => $spt->id,
                            'type' => 'B1',
                            'name' => $item->transaction_name,
                            'doc_no' => $item->other_no,
                            'doc_date' => $item->other_date,
                            'dpp' => ($item->status=='Normal') ? $item->dpp : 0,
                            'ppn' => ($item->status=='Normal') ? $item->ppn : 0,
                            'ppnbm' => ($item->status=='Normal') ? $item->ppnbm : 0,
                        ]);
                    }
                    $lampiran[] = "b1";
                }

                $keluaran = InvoiceOutput::where([['user_id', auth()->user()->id], ['invoice_period', $request->period], ['invoice_year', $request->year], ['approval', 'Approved']])->get();
                if(count($keluaran)){
                    foreach($keluaran as $item){
                        PpnFaktur::create([
                            'spt_id' => $spt->id,
                            'type' => 'A2',
                            'name' => $item->customer_name,
                            'npwp' => $item->customer_id,
                            'transaction_id' => $item->transaction_id,
                            'transaction_code' => $item->transaction_code,
                            'invoice_no' => $item->invoice_no,
                            'invoice_date' => $item->invoice_date,
                            'dpp' => ($item->status=='Normal' || $item->status=='Normal - Pengganti') ? $item->dpp : 0,
                            'ppn' => ($item->status=='Normal' || $item->status=='Normal - Pengganti') ? $item->ppn : 0,
                            'ppnbm' => ($item->status=='Normal' || $item->status=='Normal - Pengganti') ? $item->ppnbm : 0,
                        ]);
                    }
                    $lampiran[] = "a2";
                }

                $retur_keluaran = ReturOutput::where([['user_id', auth()->user()->id], ['retur_period', $request->period], ['retur_year', $request->year], ['approval', 'Approved']])->get();
                if(count($retur_keluaran)){
                    foreach($retur_keluaran as $item){
                        PpnFaktur::create([
                            'spt_id' => $spt->id,
                            'type' => 'A2',
                            'name' => $item->invoice->customer_name,
                            'npwp' => $item->invoice->customer_id,
                            'transaction_id' => $item->invoice->transaction_id,
                            'transaction_code' => $item->invoice->transaction_code,
                            'invoice_no' => $item->invoice->invoice_no,
                            'invoice_date' => $item->invoice->invoice_date,
                            'retur_no' => $item->retur_no,
                            'dpp' => '-'.$item->dpp,
                            'ppn' => '-'.$item->ppn,
                            'ppnbm' => '-'.$item->ppnbm,
                        ]);
                    }
                    $lampiran[] = "a2";
                }

                $masukan = InvoiceInput::where([['user_id', auth()->user()->id], ['invoice_period', $request->period], ['invoice_year', $request->year], ['approval', 'Approved']])->get();
                if(count($masukan)){
                    $b2 = false; $b3 = false;
                    foreach($masukan as $item){
                        if($item->credit=='ya'){
                            $b2 = true;
                        }else{
                            $b3 = true;
                        }
                        PpnFaktur::create([
                            'spt_id' => $spt->id,
                            'type' => ($item->credit=='ya') ? 'B2' : 'B3',
                            'name' => $item->collector_name,
                            'npwp' => $item->collector_id,
                            'transaction_code' => $item->transaction_code,
                            'invoice_no' => $item->invoice_no,
                            'invoice_date' => $item->invoice_date,
                            'dpp' => ($item->status=='Normal') ? $item->dpp : 0,
                            'ppn' => ($item->status=='Normal') ? $item->ppn : 0,
                            'ppnbm' => ($item->status=='Normal') ? $item->ppnbm : 0,
                        ]);
                    }
                    if($b2==true){
                        $lampiran[] = "b2";
                    }
                    if($b3==true){
                        $lampiran[] = "b3";
                    }
                }

                $retur_masukan = ReturInput::where([['user_id', auth()->user()->id], ['retur_period', $request->period], ['retur_year', $request->year], ['approval', 'Approved']])->get();
                if(count($retur_masukan)){
                    foreach($retur_masukan as $item){
                        PpnFaktur::create([
                            'spt_id' => $spt->id,
                            'type' => ($item->invoice->credit=='ya') ? 'B2' : 'B3',
                            'name' => $item->invoice->collector_name,
                            'npwp' => $item->invoice->collector_id,
                            'transaction_code' => $item->invoice->transaction_code,
                            'invoice_no' => $item->invoice->invoice_no,
                            'invoice_date' => $item->invoice->invoice_date,
                            'retur_no' => $item->retur_no,
                            'dpp' => '-'.$item->dpp,
                            'ppn' => '-'.$item->ppn,
                            'ppnbm' => '-'.$item->ppnbm,
                        ]);
                    }
                }

                //jumlah
                $dpp_a1 = PpnDok::where([['type', 'A1'], ['spt_id', $spt->id]])->sum('dpp');
                $jml_a21 = PpnFaktur::select(DB::raw("SUM(dpp) as dpp"), DB::raw("SUM(ppn) as ppn"), DB::raw("SUM(ppnbm) as ppnbm"))
                    ->where([['type', 'A2'], ['spt_id', $spt->id]])->whereIN('transaction_id', array('1', '4', '5', '6', '9'))->groupBy("type")->first();
                $jml_a22 = PpnFaktur::select(DB::raw("SUM(dpp) as dpp"), DB::raw("SUM(ppn) as ppn"), DB::raw("SUM(ppnbm) as ppnbm"))
                    ->where([['type', 'A2'], ['spt_id', $spt->id]])->whereIN('transaction_id', array('2', '3'))->groupBy("type")->first();
                $jml_a23 = PpnFaktur::select(DB::raw("SUM(dpp) as dpp"), DB::raw("SUM(ppn) as ppn"), DB::raw("SUM(ppnbm) as ppnbm"))
                    ->where([['type', 'A2'], ['spt_id', $spt->id]])->whereIN('transaction_id', array('7'))->groupBy("type")->first();
                $jml_a24 = PpnFaktur::select(DB::raw("SUM(dpp) as dpp"), DB::raw("SUM(ppn) as ppn"), DB::raw("SUM(ppnbm) as ppnbm"))
                    ->where([['type', 'A2'], ['spt_id', $spt->id]])->whereIN('transaction_id', array('8'))->groupBy("type")->first();
                $jml_b1 = PpnDok::select(DB::raw("SUM(dpp) as dpp"), DB::raw("SUM(ppn) as ppn"), DB::raw("SUM(ppnbm) as ppnbm"))
                    ->where([['type', 'B1'], ['spt_id', $spt->id]])->groupBy("type")->first();
                $jml_b2 = PpnFaktur::select(DB::raw("SUM(dpp) as dpp"), DB::raw("SUM(ppn) as ppn"), DB::raw("SUM(ppnbm) as ppnbm"))
                    ->where([['type', 'B2'], ['spt_id', $spt->id]])->groupBy("type")->first();
                $jml_b3 = PpnFaktur::select(DB::raw("SUM(dpp) as dpp"), DB::raw("SUM(ppn) as ppn"), DB::raw("SUM(ppnbm) as ppnbm"))
                    ->where([['type', 'B3'], ['spt_id', $spt->id]])->groupBy("type")->first();
                $dpp_a21 = ($jml_a21) ? $jml_a21->dpp : 0;
                $ppn_a21 = ($jml_a21) ? $jml_a21->ppn : 0;
                $ppnbm_a21 = ($jml_a21) ? $jml_a21->ppnbm : 0;
                $dpp_a22 = ($jml_a22) ? $jml_a22->dpp : 0;
                $ppn_a22 = ($jml_a22) ? $jml_a22->ppn : 0;
                $ppnbm_a22 = ($jml_a22) ? $jml_a22->ppnbm : 0;
                $dpp_a23 = ($jml_a23) ? $jml_a23->dpp : 0;
                $ppn_a23 = ($jml_a23) ? $jml_a23->ppn : 0;
                $ppnbm_a23 = ($jml_a23) ? $jml_a23->ppnbm : 0;
                $dpp_a24 = ($jml_a24) ? $jml_a24->dpp : 0;
                $ppn_a24 = ($jml_a24) ? $jml_a24->ppn : 0;
                $ppnbm_a24 = ($jml_a24) ? $jml_a24->ppnbm : 0;
                $dpp_b1 = ($jml_b1) ? $jml_b1->dpp : 0;
                $ppn_b1 = ($jml_b1) ? $jml_b1->ppn : 0;
                $ppnbm_b1 = ($jml_b1) ? $jml_b1->ppnbm : 0;
                $dpp_b2 = ($jml_b2) ? $jml_b2->dpp : 0;
                $ppn_b2 = ($jml_b2) ? $jml_b2->ppn : 0;
                $ppnbm_b2 = ($jml_b2) ? $jml_b2->ppnbm : 0;
                $dpp_b3 = ($jml_b3) ? $jml_b3->dpp : 0;
                $ppn_b3 = ($jml_b3) ? $jml_b3->ppn : 0;
                $ppnbm_b3 = ($jml_b3) ? $jml_b3->ppnbm : 0;
                PPnInduk::create([
                    'spt_id' => $spt->id,
                    'dpp_a1' => $dpp_a1,
                    'dpp_a2' => $dpp_a21+$dpp_a22+$dpp_a23+$dpp_a24,
                    'ppn_a2' => $ppn_a21+$ppn_a22+$ppn_a23+$ppn_a24,
                    'ppnbm_a2' => $ppnbm_a21+$ppnbm_a22+$ppnbm_a23+$ppnbm_a24,
                    'dpp_a21' => $dpp_a21,
                    'ppn_a21' => $ppn_a21,
                    'ppnbm_a21' => $ppnbm_a21,
                    'dpp_a22' => $dpp_a22,
                    'ppn_a22' => $ppn_a22,
                    'ppnbm_a22' => $ppnbm_a22,
                    'dpp_a23' => $dpp_a23,
                    'ppn_a23' => $ppn_a23,
                    'ppnbm_a23' => $ppnbm_a23,
                    'dpp_a24' => $dpp_a24,
                    'ppn_a24' => $ppn_a24,
                    'ppnbm_a24' => $ppnbm_a24,
                    'dpp_b1' => $dpp_b1,
                    'ppn_b1' => $ppn_b1,
                    'ppnbm_b1' => $ppnbm_b1,
                    'dpp_b2' => $dpp_b2,
                    'ppn_b2' => $ppn_b2,
                    'ppnbm_b2' => $ppnbm_b2,
                    'dpp_b3' => $dpp_b3,
                    'ppn_b3' => $ppn_b3,
                    'ppnbm_b3' => $ppnbm_b3,
                    'ppn_calculated' => $ppn_b1+$ppn_b2,
                    'ttd_name' => auth()->user()->name,
                    'ttd_position' => 'PEMILIK',
                    'lampiran' => json_encode($lampiran),
                ]);

                $tax_value = $ppn_a21-($ppn_b1+$ppn_b2);
                $spt->tax_value = $tax_value;
                $spt->status = ($tax_value > 0) ? 1 : (($tax_value < 0) ? 2 : 0);
                $spt->save();
            }elseif($request->type_code=='PPH21'){
                $income = Income::where([['user_id', auth()->user()->id], ['end_period', $request->period], ['year', $request->year]])->get();

                $pph_tetap = 0; $pph_pensiun=0; $bruto_tetap=0; $bruto_pensiun=0; $jml_tetap=0; $jml_pensiun=0;
                $ins = array();
                foreach($income as $item){
                    if($item->status=='Pegawai Tetap' && $item->terutang > 0){
                        $pph_tetap += ($item->terutang-$item->previous);
                        if($item->type=='year'){
                            $prev = Income::where([['user_id', auth()->user()->id], ['end_period', '<>', $request->period], ['year', $request->year], ['nik', $item->nik]])->sum('bruto');
                            $bruto = $item->bruto-$prev;
                            $bruto_tetap += $bruto;
                        }else{
                            $bruto_tetap += $item->bruto;
                        }
                        $jml_tetap++;
                    }elseif($item->status=='Pensiun' && $item->terutang > 0){
                        $pph_pensiun += $item->terutang;
                        $bruto_pensiun += $item->bruto;
                        $jml_pensiun++;
                    }
                    $ins[] = [
                        'spt_id'=>$spt->id,
                        'personalia_id'=>$item->personalia_id,
                        'npwp'=>$item->npwp,
                        'period'=>$item->period,
                        'year'=>$item->year,
                        'salary'=>$item->salary,
                        'pph'=>$item->pph,
                        'other'=>$item->other,
                        'honorarium'=>$item->honorarium,
                        'premi'=>$item->premi,
                        'natura'=>$item->natura,
                        'thr'=>$item->thr,
                        'bruto'=>$item->bruto,
                        'pension'=>$item->pension,
                        'zakat'=>$item->zakat,
                        'previous'=>$item->previous,
                        'status'=>$item->status,
                        'ptkp_code'=>$item->ptkp_code,
                        'ptkp'=>$item->ptkp,
                        'pkp'=>$item->pkp,
                        'pph21'=>$item->pph21,
                        'terutang'=>$item->terutang,
                        'rates'=>$item->rates,
                        'no'=>$item->no
                    ];
                }
                PphIncome::insert($ins);
                //pph final dan tidak final
                $final = BupotFinal::where([['user_id', auth()->user()->id], ['period', $request->period], ['year', $request->year]])->get();
                $ins_final = array();
                foreach($final as $item){
                    $ins_final[] = [
                        'spt_id'=>$spt->id,
                        'type'=>$item->type,
                        'period'=>$item->period,
                        'year'=>$item->year,
                        'no'=>$item->no,
                        'npwp'=>$item->npwp,
                        'nik'=>$item->nik,
                        'name'=>$item->name,
                        'address'=>$item->address,
                        'country_code'=>$item->country_code,
                        'object_code'=>$item->object_code,
                        'bruto'=>$item->bruto,
                        'dpp'=>$item->dpp,
                        'tarif'=>$item->tarif,
                        'pph'=>$item->pph,
                        'date'=>$item->date,
                        'ptkp_code'=>$item->ptkp_code
                    ];
                }
                PphFinal::insert($ins_final);

                //buat tax object
                PphDoc::create(['spt_id'=>$spt->id, 'kdObjPjk'=>'21-100-01', 'jmlPph'=>$pph_tetap, 'jmlBruto'=>$bruto_tetap, 'jmlPenerima'=>$jml_tetap]);
                PphDoc::create(['spt_id'=>$spt->id, 'kdObjPjk'=>'21-100-02', 'jmlPph'=>$pph_pensiun, 'jmlBruto'=>$bruto_pensiun, 'jmlPenerima'=>$jml_pensiun]);
                $object = TaxObject::where('kdBupot', '>', '4')->groupBy('kdObjPjk')->get();
                foreach ($object as $item){
                    $bupot = BupotFinal::where([['object_code', $item->kdObjPjk], ['user_id', auth()->user()->id], ['period', $request->period], ['year', $request->year]])->get();
                    if(count($bupot)){
                        $jml=0; $pph=0; $bruto=0;
                        foreach($bupot as $key){
                            $pph += $key->pph;
                            $bruto += $key->bruto;
                            $jml++;
                        }
                        PphDoc::create(['spt_id'=>$spt->id, 'kdObjPjk'=>$item->kdObjPjk, 'jmlPph'=>$pph, 'jmlBruto'=>$bruto, 'jmlPenerima'=>$jml]);
                    }else{
                        PphDoc::create(['spt_id'=>$spt->id, 'kdObjPjk'=>$item->kdObjPjk]);
                    }

                }

                $tax_value = 0;
                $bupot = PphDoc::where('spt_id', $spt->id)->get();
                foreach ($bupot as $item){
                    $kjs = $item->object->deposit->code;
                    $kdMap = $item->object->deposit->type->code;
                    $tax_value += $item->jmlPph;
                    if($item->jmlPph > 0){
                        $cek = BupotBill::where([['npwp', auth()->user()->npwp], ['spt_id', $spt->id], ['kdMap', $kdMap], ['kjs', $kjs]])->first();
                        if($cek){
                            $cek->pphDipotong += $item->jmlPph;
                            $cek->save();
                        }else{
                            BupotBill::create([
                                "spt_id"=> $spt->id,
                                "npwp"=> auth()->user()->npwp,
                                "msPajak"=> $request->period,
                                "thnPajak"=> $request->year,
                                "kdMap"=> $kdMap,
                                "kjs"=> $kjs,
                                "pphDipotong"=> $item->jmlPph,
                                "pphDipotongLama"=> $item->jmlPph,
                            ]);
                        }
                    }
                }

                $spt->tax_value = $tax_value;
                $spt->status = ($tax_value > 0) ? 1 : (($tax_value < 0) ? 2 : 0);
                $spt->save();
            }elseif($request->type_code=='PPHUNI'){
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
            }

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();

            $request->session()->flash('alert-error', 'SPT Gagal Dibuat ');
            return redirect()->back();
        }

        $request->session()->flash('alert-success', 'SPT Masa '.$request->period.' '.$request->year.' Pembetulan Ke '.$request->correction_to.' Berhasil Diposting');
        return redirect()->route('spt.index', ['status'=>'konsep']);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'captcha' => 'required|captcha',
            'type' => 'required',
        ]);

        $spt = Spt::findOrFail($id);
        if($spt->status != 1 || $request->type=='deposit') {
            $spt->send_flag = 2;
            $spt->ntte = time() . $spt->id;
            $spt->date = date('Y-m-d H:i:s');
            $spt->save();
            $status = ($spt->status == 1) ? 'Kurang Bayar' : (($spt->status == 2) ? 'Lebih Bayar' : 'Nihil');

            $user = User::findOrFail(auth()->user()->id);
            $body = "Berikut ini adalah Bukti Penerimaan Elektronik Anda.";
            $body .= "<br>---------------------------------------------------";
            $body .= "<br>Nama : " . $user->profile->corporate_name;
            $body .= "<br>NPWP : " . $user->npwp;
            $body .= "<br>Tahun Pajak : " . $spt->year;
            $body .= "<br>Masa Pajak : " . $spt->start_period;
            $body .= "<br>Jenis SPT : " . $spt->form_code;
            $body .= "<br>Pembetulan ke :" . $spt->correction_to;
            $body .= "<br>Status SPT : " . $status;
            $body .= "<br>Nominal : " . $spt->tax_value;
            $body .= "<br>Tanggal Penyampaian : " . $spt->date;
            $body .= "<br>Nomor Tanda Terima Elektronik : " . $spt->ntte;

            $messages = [
                'subject' => '[e-Faktur] Bukti Penerimaan Elektronik',
                'greeting' => 'Hi ' . $user->profile->corporate_name . ',',
                'body' => $body,
                'thanks' => 'Terima kasih telah menyampaikan Laporan SPT Anda.',
            ];

//            $user->notify(new EmailNotification($messages));

            $request->session()->flash('alert-success', 'SPT Berhasil');
            return redirect()->route('spt.index', ['status'=>'selesai']);
        }else{
            $spt->send_flag = 1;
            $spt->save();

            $request->session()->flash('alert-success', 'SPT Berhasil');
            return redirect()->route('spt.index', ['status'=>'menunggu']);
        }


    }
}
