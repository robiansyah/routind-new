<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spt;
use App\Models\Spt1770ssA;
use App\Models\Spt1770ssB;
use App\Models\Spt1770ssC;
use App\Models\Spt1770sMain;
use App\Models\Spt1770sHeader;
use App\Models\Spt1770sApart;
use App\Models\Spt1770s1a;
use App\Models\Spt1770s1b;
use App\Models\Spt1770s1c;
use App\Models\Spt1770s2a;
use App\Models\Spt1770s2b;
use App\Models\Spt1770s2c;
use App\Models\Spt1770s2d;
use App\Models\Pay;
use App\Models\Payment;
use App\Models\ClassStudent;
use DB;


class SptController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified', 'spt']);
    }

    public function dashboard(Request $request, $type)
    {
        if($type=='spt_detail'){
            $data = array();
            $spt = Spt::where([['user_id', auth()->user()->id], ['id', $request->id]])->first();
            if($spt){
                $data = array(
                    "id"=> $spt->id,
                    "username"=> $spt->user->username,
                    "npwp"=> $spt->user->npwp,
                    "name"=> $spt->user->name,
                    "corporate_name"=> $spt->user->profile->corporate_name,
                    "jenis"=> $spt->form_code,
                    "periode"=> $spt->start_period,
                    "tahun"=> $spt->year,
                    "pembetulanke"=> $spt->correction_to,
                    "status"=> $spt->status,
                    "nilaipajak"=> ($spt->tax_value==null) ? 0 : $spt->tax_value,
                    "sumber"=> "Web",
                    "ntte"=> $spt->ntte,
                    "tgl"=> $spt->date,
                    "flagkirim"=> null,
                    "message"=> null
                );
            }
            return response()->json([
                "data"=>$data
            ]);
        }
    }

    public function index(Request $request)
    {
        $class_student = ClassStudent::with('kelas')->where('student_id', auth()->user()->id)->first();
        $spt = Spt::with('question')->where([['user_id', auth()->user()->id], ['send_flag', 2]])->whereIn('form_code', ['1770SS', '1770S', '1770'])->orderBy('year', 'desc')->orderBy('created_at', 'desc')->get();
        return view('user.spt.archives',[
            'data' => $spt,
            'class_student' => $class_student,
        ]);
    }

    public function create(Request $request)
    {
        return view('user.spt.create');
    }

    public function efile(Request $request, $type, $spt='x')
    {
        return view('user.efile.'.$type, [
            'spt'=>$spt
        ]);
    }

    public function preview(Request $request, $id)
    {
        $spt = Spt::where([['user_id', auth()->user()->id], ['id', $id]])->first();
        if($spt){
            return view('user.spt.preview'.$spt->form_code, [
                'spt'=>$spt
            ]);
        }else{
            return redirect()->route('pelajar.spt.arsip');
        }
    }

    public function draft(Request $request)
    {
        $spt = Spt::where([['user_id', auth()->user()->id], ['send_flag','<>', 2]])->whereIn('form_code', ['1770SS', '1770S', '1770'])->orderBy('id', 'desc')->get();
        return view('user.spt.draft',[
            'data' => $spt,
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $spt = Spt::findOrFail($id);
        $spt->delete();

        $request->session()->flash('alert-success', 'SPT Berhasil Dihapus');
        return redirect()->back();
    }

    public function help(Request $request)
    {
        return view('user.spt.help');
    }

    public function rev(Request $request)
    {
        $spt = Spt::where([['user_id', auth()->user()->id], ['year', $request->th]])->first();
        $status = ($spt) ? "1" : "0";
        $message = ((!$spt) ? 0 : (($spt->send_flag!=2) ? $spt->correction_to : $spt->correction_to + 1) );

        return response()->json([
            'kdStatus'=>$status,
            "message"=>$message,
        ]);
    }

    public function data(Request $request)
    {
        $year = $request->th;
        $correction_to = $request->revno;
        $form_code = $request->jns;

        $spt = Spt::where([['user_id', auth()->user()->id], ['send_flag', '<>', 2], ['year', $year],['correction_to', $correction_to],['form_code', $form_code]])->first();

        if($spt){
            if($spt->form_code=='1770S'){
                $detilss = null;
                $bagIC = array("daftarBuktiPotong" => Spt1770s1c::where('spt_id', $spt->id)->get());
                $bagIIB = array("daftarHarta" => Spt1770s2b::where('spt_id', $spt->id)->get());
                $bagIIC = array("daftarUtang" => Spt1770s2c::where('spt_id', $spt->id)->get());
                $bagIID = array("daftarKeluarga" => Spt1770s2d::where('spt_id', $spt->id)->get());
                $detils = array(
                    "headerSPT" => Spt1770sHeader::where('spt_id', $spt->id)->first(),
                    "indukSPT" => Spt1770sMain::where('spt_id', $spt->id)->first(),
                    "bagIA" => Spt1770s1a::where('spt_id', $spt->id)->first(),
                    "bagIB" => Spt1770s1b::where('spt_id', $spt->id)->first(),
                    "bagIC" => $bagIC,
                    "bagIIA" => Spt1770s2a::where('spt_id', $spt->id)->first(),
                    "bagIIB" => $bagIIB,
                    "bagIIC" => $bagIIC,
                    "bagIID" => $bagIID,
                    "bagPisahHarta" => Spt1770sApart::where('spt_id', $spt->id)->first(),
                );
            }else{
                $detils = null;
                $detilss = array(
                    "bagA" => Spt1770ssA::where('spt_id', $spt->id)->first(),
                    "bagB" => Spt1770ssB::where('spt_id', $spt->id)->first(),
                    "bagC" => Spt1770ssC::where('spt_id', $spt->id)->first(),
                );
            }
            $data = array(
                "idspt" => $spt->id,
                "tahunpajak" => $spt->year,
                "pembetulanke" => $spt->correction_to,
                "kodeformulir" => $spt->form_code,
                "jenisspt" => "01",
                "ptkp" => "00",
                "detilss" => $detilss,
                "detils" => $detils,
                "statusspt"=> $spt->status,
                "nilaipajak" => $spt->tax_value,
                "flagkirim" => $spt->send_flag,
                "tglLunas" => $spt->paid_date,
                "payment" => ($spt->status==1) ? Payment::where('spt_id', $spt->id)->get() : null,
                "nilaipayment" => $spt->payment_value,
                "flagreskom" => 0,
                "fgform"=> null,
                "fgprep"=> null
            );
        }else{
            $data = null;
        }

        return response()->json([
            'kdStatus'=>"1",
            "ketStatus"=>"Data ".$request->th,
            "message"=>$data,
        ]);
    }

    public function store(Request $request)
    {
        $code = $request->kodeformulir;
        $cek = Spt::where([['user_id', auth()->user()->id], ['send_flag', '<>', 2], ['year', $request->tahunpajak], ['correction_to', $request->pembetulanke], ['form_code', $code]])->first();
        if(!$cek){
            $spt = new SPT;
            $spt->user_id = auth()->user()->id;
            $spt->correction_to = $request->pembetulanke;
            $spt->form_code = $code;
            $spt->year = $request->tahunpajak;
            $spt->date = date('Y-m-d H:i:s');
            $spt->status = $request->statusspt;
            $spt->tax_value = $request->nilaipajak;
            $spt->payment_value = $request->nilaipayment;
            $spt->send_flag = $request->flagkirim;
			//$spt->paid_date = ($request->tglLunas) ? date("Y-m-d", strtotime($request->tglLunas)) : null;
            $spt->save();
			
			$payment = $request->payment;
            if($payment){
                $length = count($payment);
                for ($i=0; $i<$length; $i++){
                    Payment::create([
                        "spt_id"=> $spt->id,
                        "jnstrx"=> $payment[$i]["jnstrx"],
                        "ntpnPbk"=> $payment[$i]["ntpnPbk"],
                        "tglBayar"=> date("Y-m-d", strtotime($payment[$i]["tglBayar"])),
                        "nilai"=> $payment[$i]["nilai"],
                    ]);
                }
            }

        }else{
            $cek->date = date('Y-m-d H:i:s');
            $cek->status = $request->statusspt;
            $cek->tax_value = $request->nilaipajak;
            $cek->payment_value = $request->nilaipayment;
            $cek->send_flag = $request->flagkirim;
			//$cek->paid_date = ($request->tglLunas) ? date("Y-m-d", strtotime($request->tglLunas)) : null;
            $cek->save();
			
			$payment = $request->payment;
            if($payment){
				//hapus data lama
				Payment::where('spt_id', $cek->id)->delete();
                
				$length = count($payment);
                for ($i=0; $i<$length; $i++){
                    Payment::create([
                        "spt_id"=> $cek->id,
                        "jnstrx"=> $payment[$i]["jnstrx"],
                        "ntpnPbk"=> $payment[$i]["ntpnPbk"],
                        "tglBayar"=> date("Y-m-d", strtotime($payment[$i]["tglBayar"])),
                        "nilai"=> $payment[$i]["nilai"],
                    ]);
                }
            }
        }

        if($code=='1770SS'){
            $detilss = $request->detilss;
            $gross = $detilss['bagA']['a1PBruto'];
            $reduction = $detilss['bagA']['a2Pengurangan'];
            $ptkp_type = $detilss['bagA']['a3JnsPtkp'];
            $dependents = $detilss['bagA']['a31JmlTanggungan'];
            $ptkp = $detilss['bagA']['a32Ptkp'];
            $pkp = $detilss['bagA']['a4Pkp'];
            $pph_debt = $detilss['bagA']['a5PphTerutang'];
            $pph_deducted = $detilss['bagA']['a6PphDipotong'];
            $lbkbn = $detilss['bagA']['a7LbKbN'];
            $lbkbn_amount = $detilss['bagA']['a71JmlLbKbN'];

            $final_gross_tax = $detilss['bagB']['b1PBrutoFinal'];
            $pph_final = $detilss['bagB']['b2PphFinal'];
            $excluded_income = $detilss['bagB']['b3PenghasilanDikecualikan'];

            $assets = $detilss['bagC']['c1JmlHarta'];
            $debt = $detilss['bagC']['c2JmlUtang'];

            if(!$cek){
                //simpan
                $bagA = new Spt1770ssA;
                $bagA->spt_id = $spt->id;
                $bagA->gross = $gross;
                $bagA->reduction = $reduction;
                $bagA->ptkp_type = $ptkp_type;
                $bagA->dependents = $dependents;
                $bagA->ptkp = $ptkp;
                $bagA->pkp = $pkp;
                $bagA->pph_debt = $pph_debt;
                $bagA->pph_deducted = $pph_deducted;
                $bagA->lbkbn = $lbkbn;
                $bagA->lbkbn_amount = $lbkbn_amount;
                $bagA->save();

                $bagB = new Spt1770ssB;
                $bagB->spt_id = $spt->id;
                $bagB->final_gross_tax = $final_gross_tax;
                $bagB->pph_final = $pph_final;
                $bagB->excluded_income = $excluded_income;
                $bagB->save();

                $bagC = new Spt1770ssC;
                $bagC->spt_id = $spt->id;
                $bagC->assets = $assets;
                $bagC->debt = $debt;
                $bagC->save();

            }else{
                //update
                $bagA = Spt1770ssA::where('spt_id', $cek->id)->first();
                $bagA->gross = $gross;
                $bagA->reduction = $reduction;
                $bagA->ptkp_type = $ptkp_type;
                $bagA->dependents = $dependents;
                $bagA->ptkp = $ptkp;
                $bagA->pkp = $pkp;
                $bagA->pph_debt = $pph_debt;
                $bagA->pph_deducted = $pph_deducted;
                $bagA->lbkbn = $lbkbn;
                $bagA->lbkbn_amount = $lbkbn_amount;
                $bagA->save();

                $bagB = Spt1770ssB::where('spt_id', $cek->id)->first();
                $bagB->final_gross_tax = $final_gross_tax;
                $bagB->pph_final = $pph_final;
                $bagB->excluded_income = $excluded_income;
                $bagB->save();

                $bagC = Spt1770ssC::where('spt_id', $cek->id)->first();
                $bagC->assets = $assets;
                $bagC->debt = $debt;
                $bagC->save();
            }

        }elseif($code=='1770S'){
            $detils = $request->detils;
            $kewajibanPajak = $detils['headerSPT']['kewajibanPajak'];
            $npwpPasangan = $detils['headerSPT']['npwpPasangan'];

            $phNettoDN = $detils['indukSPT']['phNettoDN'];
            $phNettoDNLain = $detils['indukSPT']['phNettoDNLain'];
            $phLN = $detils['indukSPT']['phLN'];
            $jmlPhNetto = $detils['indukSPT']['jmlPhNetto'];
            $zakatSumbang = $detils['indukSPT']['zakatSumbang'];
            $jmlPhNettoAkhir = $detils['indukSPT']['jmlPhNettoAkhir'];
            $jnsPtkp = $detils['indukSPT']['jnsPtkp'];
            $jmlTanggungan = $detils['indukSPT']['jmlTanggungan'];
            $phTKP = $detils['indukSPT']['phTKP'];
            $phKP = $detils['indukSPT']['phKP'];
            $pphTerutang = $detils['indukSPT']['pphTerutang'];
            $penguranganPs24 = $detils['indukSPT']['penguranganPs24'];
            $jmlPPhTerutang = $detils['indukSPT']['jmlPPhTerutang'];
            $pphDipotong = $detils['indukSPT']['pphDipotong'];
            $statusBayarPph = $detils['indukSPT']['statusBayarPph'];
            $jmlBayarPPh = $detils['indukSPT']['jmlBayarPPh'];
            $pphPasal25 = $detils['indukSPT']['pphPasal25'];
            $stppphPasal25 = $detils['indukSPT']['stppphPasal25'];
            $fiskalLN = $detils['indukSPT']['fiskalLN'];
            $jmlKreditPajak = $detils['indukSPT']['jmlKreditPajak'];
            $lbKbN = $detils['indukSPT']['lbKbN'];
            $ntpn = $detils['indukSPT']['ntpn'];
			$tglLunas = $detils['indukSPT']['tglLunas'];
            $pph = $detils['indukSPT']['pph'];
            $permohonanLB = $detils['indukSPT']['permohonanLB'];
            $angsPPh25 = $detils['indukSPT']['angsPPh25'];
            $dsrHitAngs = $detils['indukSPT']['dsrHitAngs'];

            $phBunga = $detils['bagIA']['phBunga'];
            $phRoyalti = $detils['bagIA']['phRoyalti'];
            $phSewa = $detils['bagIA']['phSewa'];
            $phHadiah = $detils['bagIA']['phHadiah'];
            $phAlihHarta = $detils['bagIA']['phAlihHarta'];
            $phLain = $detils['bagIA']['phLain'];

            $bantuanHibah = $detils['bagIB']['bantuanHibah'];
            $warisan = $detils['bagIB']['warisan'];
            $labaAnggota = $detils['bagIB']['labaAnggota'];
            $asuransi = $detils['bagIB']['asuransi'];
            $beasiswa = $detils['bagIB']['beasiswa'];
            $phBOPLain = $detils['bagIB']['phBOPLain'];

            $bagIC = $request->filled("detils.bagIC");
            $bagIIA = $request->filled("detils.bagIIA");
            $bagIIB = $request->filled("detils.bagIIB");
            $bagIIC = $request->filled("detils.bagIIC");
            $bagIID = $request->filled("detils.bagIID");

            $phSuami = $detils['bagPisahHarta']['phSuami'];
            $phIstri = $detils['bagPisahHarta']['phIstri'];
            $phGab = $detils['bagPisahHarta']['phGab'];


            if(!$cek){
                $header = new Spt1770sHeader;
                $header->spt_id = $spt->id;
                $header->npwp = auth()->user()->username;
                $header->tahunPajak = $request->tahunpajak;
                $header->kewajibanPajak = $kewajibanPajak;
                $header->npwpPasangan = $npwpPasangan;
                $header->nomorHp = auth()->user()->mobile_phone;
                $header->save();

                $main = new Spt1770sMain;
                $main->spt_id = $spt->id;
                $main->ubahData = $request->pembetulanke;
                $main->phNettoDN = $phNettoDN;
                $main->phNettoDNLain = $phNettoDNLain;
                $main->phLN = $phLN;
                $main->jmlPhNetto = $jmlPhNetto;
                $main->zakatSumbang = $zakatSumbang;
                $main->jmlPhNettoAkhir = $jmlPhNettoAkhir;
                $main->jnsPtkp = $jnsPtkp;
                $main->jmlTanggungan = $jmlTanggungan;
                $main->phTKP = $phTKP;
                $main->phKP = $phKP;
                $main->pphTerutang = $pphTerutang;
                $main->penguranganPs24 = $penguranganPs24;
                $main->jmlPPhTerutang = $jmlPPhTerutang;
                $main->pphDipotong = $pphDipotong;
                $main->statusBayarPph = $statusBayarPph;
                $main->jmlBayarPPh = $jmlBayarPPh;
                $main->pphPasal25 = $pphPasal25;
                $main->stppphPasal25 = $stppphPasal25;
                $main->fiskalLN = $fiskalLN;
                $main->jmlKreditPajak = $jmlKreditPajak;
                $main->lbKbN = $lbKbN;
                $main->ntpn = $ntpn;
                $main->tglLunas = ($tglLunas) ? date("Y-m-d", strtotime($tglLunas)) : null;
                $main->pph = $pph;
                $main->permohonanLB = $permohonanLB;
                $main->angsPPh25 = $angsPPh25;
                $main->dsrHitAngs = $dsrHitAngs;
                $main->save();

                $bagIA = new Spt1770s1a;
                $bagIA->spt_id = $spt->id;
                $bagIA->phBunga = $phBunga;
                $bagIA->phRoyalti = $phRoyalti;
                $bagIA->phSewa = $phSewa;
                $bagIA->phHadiah = $phHadiah;
                $bagIA->phAlihHarta = $phAlihHarta;
                $bagIA->phLain = $phLain;
                $bagIA->total = $phBunga+$phRoyalti+$phSewa+$phHadiah+$phAlihHarta+$phLain;
                $bagIA->save();

                $bagIB = new Spt1770s1b;
                $bagIB->spt_id = $spt->id;
                $bagIB->bantuanHibah = $bantuanHibah;
                $bagIB->warisan = $warisan;
                $bagIB->labaAnggota = $labaAnggota;
                $bagIB->asuransi = $asuransi;
                $bagIB->beasiswa = $beasiswa;
                $bagIB->phBOPLain = $phBOPLain;
                $bagIB->total = $bantuanHibah+$warisan+$labaAnggota+$asuransi+$beasiswa+$phBOPLain;
                $bagIB->save();

                $apart = new Spt1770sApart;
                $apart->spt_id = $spt->id;
                $apart->phSuami = $phSuami;
                $apart->phIstri = $phIstri;
                $apart->phGab = $phGab;
                $apart->save();

                if($bagIIA){
                    $IIa = new Spt1770s2a;
                    $IIa->spt_id = $spt->id;

                    $IIa->phBungaDep = ($request->filled("detils.bagIIA.phBungaDep")) ? $detils['bagIIA']['phBungaDep'] : null;
                    $IIa->pjkBungaDep = ($request->filled("detils.bagIIA.pjkBungaDep")) ? $detils['bagIIA']['pjkBungaDep'] : null;
                    $IIa->phBungaObl = ($request->filled("detils.bagIIA.phBungaObl")) ? $detils['bagIIA']['phBungaObl'] : null;
                    $IIa->pjkBungaObl = ($request->filled("detils.bagIIA.pjkBungaObl")) ? $detils['bagIIA']['pjkBungaObl'] : null;
                    $IIa->phJualSaham = ($request->filled("detils.bagIIA.phJualSaham")) ? $detils['bagIIA']['phJualSaham'] : null;
                    $IIa->pjkJualSaham = ($request->filled("detils.bagIIA.pjkJualSaham")) ? $detils['bagIIA']['pjkJualSaham'] : null;
                    $IIa->phHadiah = ($request->filled("detils.bagIIA.phHadiah")) ? $detils['bagIIA']['phHadiah'] : null;
                    $IIa->pjkHadiah = ($request->filled("detils.bagIIA.pjkHadiah")) ? $detils['bagIIA']['pjkHadiah'] : null;
                    $IIa->phPesangon = ($request->filled("detils.bagIIA.phPesangon")) ? $detils['bagIIA']['phPesangon'] : null;
                    $IIa->pjkPesangon = ($request->filled("detils.bagIIA.pjkPesangon")) ? $detils['bagIIA']['pjkPesangon'] : null;
                    $IIa->phHonor = ($request->filled("detils.bagIIA.phHonor")) ? $detils['bagIIA']['phHonor'] : null;
                    $IIa->pjkHonor = ($request->filled("detils.bagIIA.pjkHonor")) ? $detils['bagIIA']['pjkHonor'] : null;
                    $IIa->phAlihTB = ($request->filled("detils.bagIIA.phAlihTB")) ? $detils['bagIIA']['phAlihTB'] : null;
                    $IIa->pjkAlihTB = ($request->filled("detils.bagIIA.pjkAlihTB")) ? $detils['bagIIA']['pjkAlihTB'] : null;
                    $IIa->phSewaTB = ($request->filled("detils.bagIIA.phSewaTB")) ? $detils['bagIIA']['phSewaTB'] : null;
                    $IIa->pjkSewaTB = ($request->filled("detils.bagIIA.pjkSewaTB")) ? $detils['bagIIA']['pjkSewaTB'] : null;
                    $IIa->phBgnGunaSerah = ($request->filled("detils.bagIIA.phBgnGunaSerah")) ? $detils['bagIIA']['phBgnGunaSerah'] : null;
                    $IIa->pjkBgnGunaSerah = ($request->filled("detils.bagIIA.pjkBgnGunaSerah")) ? $detils['bagIIA']['pjkBgnGunaSerah'] : null;
                    $IIa->phBungaSimp = ($request->filled("detils.bagIIA.phBungaSimp")) ? $detils['bagIIA']['phBungaSimp'] : null;
                    $IIa->pjkBungaSimp = ($request->filled("detils.bagIIA.pjkBungaSimp")) ? $detils['bagIIA']['pjkBungaSimp'] : null;
                    $IIa->phTrDerivatif = ($request->filled("detils.bagIIA.phTrDerivatif")) ? $detils['bagIIA']['phTrDerivatif'] : null;
                    $IIa->pjkTrDerivatif = ($request->filled("detils.bagIIA.pjkTrDerivatif")) ? $detils['bagIIA']['pjkTrDerivatif'] : null;
                    $IIa->phDividen = ($request->filled("detils.bagIIA.phDividen")) ? $detils['bagIIA']['phDividen'] : null;
                    $IIa->pjkDividen = ($request->filled("detils.bagIIA.pjkDividen")) ? $detils['bagIIA']['pjkDividen'] : null;
                    $IIa->phIstri = ($request->filled("detils.bagIIA.phIstri")) ? $detils['bagIIA']['phIstri'] : null;
                    $IIa->pjkPhIstri = ($request->filled("detils.bagIIA.pjkPhIstri")) ? $detils['bagIIA']['pjkPhIstri'] : null;
                    $IIa->phLain = ($request->filled("detils.bagIIA.phLain")) ? $detils['bagIIA']['phLain'] : null;
                    $IIa->pjkPhLain = ($request->filled("detils.bagIIA.pjkPhLain")) ? $detils['bagIIA']['pjkPhLain'] : null;
                    $IIa->save();
                }

                if($bagIIB){
                    foreach($detils['bagIIB']['daftarHarta'] as $item){
                        $daftarHarta = new Spt1770s2b;
                        $daftarHarta->spt_id = $spt->id;
                        $daftarHarta->kodeHarta = $item['kodeHarta'];
                        $daftarHarta->jnsHarta = $item['jnsHarta'];
                        $daftarHarta->thPerolehan = $item['thPerolehan'];
                        $daftarHarta->harga = $item['harga'];
                        $daftarHarta->ket = $item['ket'];
                        $daftarHarta->save();
                    }
                }

                if($bagIIC){
                    foreach($detils['bagIIC']['daftarUtang'] as $item){
                        $daftarUtang = new Spt1770s2c;
                        $daftarUtang->spt_id = $spt->id;
                        $daftarUtang->kodeUtang = $item['kodeUtang'];
                        $daftarUtang->nmPbrPinjam = $item['nmPbrPinjam'];
                        $daftarUtang->almtPbrPinjam = $item['almtPbrPinjam'];
                        $daftarUtang->thPinjam = $item['thPinjam'];
                        $daftarUtang->jmlPinjam = $item['jmlPinjam'];
                        $daftarUtang->save();
                    }
                }

                if($bagIID){
                    foreach($detils['bagIID']['daftarKeluarga'] as $item){
                        $daftarKeluarga = new Spt1770s2d;
                        $daftarKeluarga->spt_id = $spt->id;
                        $daftarKeluarga->nmAgKel = $item['nmAgKel'];
                        $daftarKeluarga->nik = $item['nik'];
                        $daftarKeluarga->hubKel = $item['hubKel'];
                        $daftarKeluarga->kerja = $item['kerja'];
                        $daftarKeluarga->save();
                    }
                }
            }else{
                //update
                $header = Spt1770sHeader::where('spt_id', $cek->id)->first();
                $header->tahunPajak = $request->tahunpajak;
                $header->kewajibanPajak = $kewajibanPajak;
                $header->npwpPasangan = $npwpPasangan;
                $header->save();

                $main = Spt1770sMain::where('spt_id', $cek->id)->first();
                $main->ubahData = $request->pembetulanke;
                $main->phNettoDN = $phNettoDN;
                $main->phNettoDNLain = $phNettoDNLain;
                $main->phLN = $phLN;
                $main->jmlPhNetto = $jmlPhNetto;
                $main->zakatSumbang = $zakatSumbang;
                $main->jmlPhNettoAkhir = $jmlPhNettoAkhir;
                $main->jnsPtkp = $jnsPtkp;
                $main->jmlTanggungan = $jmlTanggungan;
                $main->phTKP = $phTKP;
                $main->phKP = $phKP;
                $main->pphTerutang = $pphTerutang;
                $main->penguranganPs24 = $penguranganPs24;
                $main->jmlPPhTerutang = $jmlPPhTerutang;
                $main->pphDipotong = $pphDipotong;
                $main->statusBayarPph = $statusBayarPph;
                $main->jmlBayarPPh = $jmlBayarPPh;
                $main->pphPasal25 = $pphPasal25;
                $main->stppphPasal25 = $stppphPasal25;
                $main->fiskalLN = $fiskalLN;
                $main->jmlKreditPajak = $jmlKreditPajak;
                $main->lbKbN = $lbKbN;
                $main->ntpn = $ntpn;
                $main->tglLunas = ($tglLunas) ? date("Y-m-d", strtotime($tglLunas)) : null;
                $main->pph = $pph;
                $main->permohonanLB = $permohonanLB;
                $main->angsPPh25 = $angsPPh25;
                $main->dsrHitAngs = $dsrHitAngs;
                $main->lampBuktiPtg = ($request->filled('detils.indukSPT.lampBuktiPtg')) ? $detils['indukSPT']['lampBuktiPtg'] : null;
                $main->lampSSP = ($request->filled('detils.indukSPT.lampSSP')) ? $detils['indukSPT']['lampSSP'] : null;
                $main->lampSrtKuasa = ($request->filled('detils.indukSPT.lampSrtKuasa')) ? $detils['indukSPT']['lampSrtKuasa'] : null;
                $main->lampHitPH = ($request->filled('detils.indukSPT.lampHitPH')) ? $detils['indukSPT']['lampHitPH'] : null;
                $main->lampLain = ($request->filled('detils.indukSPT.lampLain')) ? $detils['indukSPT']['lampLain'] : null;
                $main->isiLampLain = ($request->filled('detils.indukSPT.isiLampLain')) ? $detils['indukSPT']['isiLampLain'] : null;
                $main->namaWP = ($request->filled('detils.indukSPT.namaWP')) ? $detils['indukSPT']['namaWP'] : null;
                $main->npwppernyataan = ($request->filled('detils.indukSPT.npwppernyataan')) ? $detils['indukSPT']['npwppernyataan'] : null;
                $main->wpkuasa = ($request->filled('detils.indukSPT.wpkuasa')) ? $detils['indukSPT']['wpkuasa'] : null;
                $main->save();

                $bagIA = Spt1770s1a::where('spt_id', $cek->id)->first();
                $bagIA->phBunga = $phBunga;
                $bagIA->phRoyalti = $phRoyalti;
                $bagIA->phSewa = $phSewa;
                $bagIA->phHadiah = $phHadiah;
                $bagIA->phAlihHarta = $phAlihHarta;
                $bagIA->phLain = $phLain;
                $bagIA->total = $phBunga+$phRoyalti+$phSewa+$phHadiah+$phAlihHarta+$phLain;
                $bagIA->save();

                $bagIB = Spt1770s1b::where('spt_id', $cek->id)->first();
                $bagIB->bantuanHibah = $bantuanHibah;
                $bagIB->warisan = $warisan;
                $bagIB->labaAnggota = $labaAnggota;
                $bagIB->asuransi = $asuransi;
                $bagIB->beasiswa = $beasiswa;
                $bagIB->phBOPLain = $phBOPLain;
                $bagIB->total = $bantuanHibah+$warisan+$labaAnggota+$asuransi+$beasiswa+$phBOPLain;
                $bagIB->save();

                if($bagIC){
                    //delete
                    Spt1770s1c::where('spt_id', $cek->id)->delete();

                    //insert
                    foreach($detils['bagIC']['daftarBuktiPotong'] as $item){
                        $daftarBuktiPotong = new Spt1770s1c;
                        $daftarBuktiPotong->spt_id = $cek->id;
                        $daftarBuktiPotong->nmPemotong = $item['nmPemotong'];
                        $daftarBuktiPotong->npwpPemotong = $item['npwpPemotong'];
                        $daftarBuktiPotong->nomorBP = $item['nomorBP'];
                        $daftarBuktiPotong->tglBP = ($item['tglBP']) ? date("Y-m-d", strtotime($item['tglBP'])) : null;;
                        $daftarBuktiPotong->pasalPph = $item['pasalPph'];
                        $daftarBuktiPotong->jmlPPhDiPotong = $item['jmlPPhDiPotong'];
                        $daftarBuktiPotong->save();
                    }
                }

                if($bagIIA){
                    $IIa = Spt1770s2a::where('spt_id', $cek->id)->first();
                    if(!$IIa){
                        $IIa = new Spt1770s2a;
                        $IIa->spt_id = $cek->id;
                    }
                    $IIa->phBungaDep = ($request->filled("detils.bagIIA.phBungaDep")) ? $detils['bagIIA']['phBungaDep'] : null;
                    $IIa->pjkBungaDep = ($request->filled("detils.bagIIA.pjkBungaDep")) ? $detils['bagIIA']['pjkBungaDep'] : null;
                    $IIa->phBungaObl = ($request->filled("detils.bagIIA.phBungaObl")) ? $detils['bagIIA']['phBungaObl'] : null;
                    $IIa->pjkBungaObl = ($request->filled("detils.bagIIA.pjkBungaObl")) ? $detils['bagIIA']['pjkBungaObl'] : null;
                    $IIa->phJualSaham = ($request->filled("detils.bagIIA.phJualSaham")) ? $detils['bagIIA']['phJualSaham'] : null;
                    $IIa->pjkJualSaham = ($request->filled("detils.bagIIA.pjkJualSaham")) ? $detils['bagIIA']['pjkJualSaham'] : null;
                    $IIa->phHadiah = ($request->filled("detils.bagIIA.phHadiah")) ? $detils['bagIIA']['phHadiah'] : null;
                    $IIa->pjkHadiah = ($request->filled("detils.bagIIA.pjkHadiah")) ? $detils['bagIIA']['pjkHadiah'] : null;
                    $IIa->phPesangon = ($request->filled("detils.bagIIA.phPesangon")) ? $detils['bagIIA']['phPesangon'] : null;
                    $IIa->pjkPesangon = ($request->filled("detils.bagIIA.pjkPesangon")) ? $detils['bagIIA']['pjkPesangon'] : null;
                    $IIa->phHonor = ($request->filled("detils.bagIIA.phHonor")) ? $detils['bagIIA']['phHonor'] : null;
                    $IIa->pjkHonor = ($request->filled("detils.bagIIA.pjkHonor")) ? $detils['bagIIA']['pjkHonor'] : null;
                    $IIa->phAlihTB = ($request->filled("detils.bagIIA.phAlihTB")) ? $detils['bagIIA']['phAlihTB'] : null;
                    $IIa->pjkAlihTB = ($request->filled("detils.bagIIA.pjkAlihTB")) ? $detils['bagIIA']['pjkAlihTB'] : null;
                    $IIa->phSewaTB = ($request->filled("detils.bagIIA.phSewaTB")) ? $detils['bagIIA']['phSewaTB'] : null;
                    $IIa->pjkSewaTB = ($request->filled("detils.bagIIA.pjkSewaTB")) ? $detils['bagIIA']['pjkSewaTB'] : null;
                    $IIa->phBgnGunaSerah = ($request->filled("detils.bagIIA.phBgnGunaSerah")) ? $detils['bagIIA']['phBgnGunaSerah'] : null;
                    $IIa->pjkBgnGunaSerah = ($request->filled("detils.bagIIA.pjkBgnGunaSerah")) ? $detils['bagIIA']['pjkBgnGunaSerah'] : null;
                    $IIa->phBungaSimp = ($request->filled("detils.bagIIA.phBungaSimp")) ? $detils['bagIIA']['phBungaSimp'] : null;
                    $IIa->pjkBungaSimp = ($request->filled("detils.bagIIA.pjkBungaSimp")) ? $detils['bagIIA']['pjkBungaSimp'] : null;
                    $IIa->phTrDerivatif = ($request->filled("detils.bagIIA.phTrDerivatif")) ? $detils['bagIIA']['phTrDerivatif'] : null;
                    $IIa->pjkTrDerivatif = ($request->filled("detils.bagIIA.pjkTrDerivatif")) ? $detils['bagIIA']['pjkTrDerivatif'] : null;
                    $IIa->phDividen = ($request->filled("detils.bagIIA.phDividen")) ? $detils['bagIIA']['phDividen'] : null;
                    $IIa->pjkDividen = ($request->filled("detils.bagIIA.pjkDividen")) ? $detils['bagIIA']['pjkDividen'] : null;
                    $IIa->phIstri = ($request->filled("detils.bagIIA.phIstri")) ? $detils['bagIIA']['phIstri'] : null;
                    $IIa->pjkPhIstri = ($request->filled("detils.bagIIA.pjkPhIstri")) ? $detils['bagIIA']['pjkPhIstri'] : null;
                    $IIa->phLain = ($request->filled("detils.bagIIA.phLain")) ? $detils['bagIIA']['phLain'] : null;
                    $IIa->pjkPhLain = ($request->filled("detils.bagIIA.pjkPhLain")) ? $detils['bagIIA']['pjkPhLain'] : null;
                    $IIa->save();
                }

                if($bagIIB){
                    //delete
                    Spt1770s2b::where('spt_id', $cek->id)->delete();

                    //insert
                    foreach($detils['bagIIB']['daftarHarta'] as $item){
                        $daftarHarta = new Spt1770s2b;
                        $daftarHarta->spt_id = $cek->id;
                        $daftarHarta->kodeHarta = $item['kodeHarta'];
                        $daftarHarta->jnsHarta = $item['jnsHarta'];
                        $daftarHarta->thPerolehan = $item['thPerolehan'];
                        $daftarHarta->harga = $item['harga'];
                        $daftarHarta->ket = $item['ket'];
                        $daftarHarta->save();
                    }
                }

                if($bagIIC){
                    //delete
                    Spt1770s2c::where('spt_id', $cek->id)->delete();

                    //insert
                    foreach($detils['bagIIC']['daftarUtang'] as $item){
                        $daftarUtang = new Spt1770s2c;
                        $daftarUtang->spt_id = $cek->id;
                        $daftarUtang->kodeUtang = $item['kodeUtang'];
                        $daftarUtang->nmPbrPinjam = $item['nmPbrPinjam'];
                        $daftarUtang->almtPbrPinjam = $item['almtPbrPinjam'];
                        $daftarUtang->thPinjam = $item['thPinjam'];
                        $daftarUtang->jmlPinjam = $item['jmlPinjam'];
                        $daftarUtang->save();
                    }
                }

                if($bagIID){
                    //delete
                    Spt1770s2d::where('spt_id', $cek->id)->delete();

                    //insert
                    foreach($detils['bagIID']['daftarKeluarga'] as $item){
                        $daftarKeluarga = new Spt1770s2d;
                        $daftarKeluarga->spt_id = $cek->id;
                        $daftarKeluarga->nmAgKel = $item['nmAgKel'];
                        $daftarKeluarga->nik = $item['nik'];
                        $daftarKeluarga->hubKel = $item['hubKel'];
                        $daftarKeluarga->kerja = $item['kerja'];
                        $daftarKeluarga->save();

                    }
                }

                $apart = Spt1770sApart::where('spt_id', $cek->id)->first();
                $apart->phSuami = $phSuami;
                $apart->phIstri = $phIstri;
                $apart->phGab = $phGab;
                $apart->save();
            }
        }

        return response()->json([
            'kdStatus'=>"1",
            "ketStatus"=>"Simpan Sukses",
            "message"=>$request->flagkirim,
        ]);
    }

    public function refNpwp(Request $request)
    {
        return response()->json([
            'kdStatus'=>"1",
            "message"=>"Simulator Pajak",
        ]);
    }

    public function refPph(Request $request)
    {
        return response()->json([
            'kdStatus'=>"1",
            "ketStatus"=> "SUKSES",
            "message"=>array (
                array(60,5),
                array(250,15),
                array(500,25),
                array(5000,30),
                array(999999,35),
            ),
        ]);
    }

    public function detail(Request $request, $id)
    {
        $spt = Spt::where([['user_id', auth()->user()->id], ['id', $id]])->first();
        if($spt){
            return response()->json([
                'kdStatus'=>"1",
                "data"=>$spt,
                "message"=>array(
                    "name" => auth()->user()->name,
                    "npwp" => auth()->user()->username,
                )
            ]);
        }
    }

    public function ntpn(Request $request)
    {
        $pay = Pay::where([['user_id', auth()->user()->id],['ntpn', $request->no]])->first();
        $status = ($pay) ? "1" : "0";

        return response()->json([
            'kdStatus'=>$status,
            "message"=>array(
                "tglBayar" => ($pay) ? $pay->date : "",
                "jmlBayar" => ($pay) ? $pay->amount : "",
            )
        ]);
    }

}
