<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spt17704a;
use App\Models\Spt17704b;
use App\Models\Spt17704c;
use App\Models\Spt17703a;
use App\Models\Spt17703b;
use App\Models\Spt17702a;
use App\Models\Spt17701a;
use App\Models\Spt17701b;
use App\Models\Spt17701c;
use App\Models\Spt17701d;
use App\Models\Spt1770induk;
use App\Models\Spt1771setor;
use App\Models\Spt;
use App\Models\User;
use App\Notifications\EmailNotification;
use DataTables;

class Eform1770Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified','spt']);
    }
    //1770
    public function business(Request $request, $id){
        $spt = Spt::findOrFail($id);
        if($spt->send_flag != 2 && $spt->form_code=='1770'){
            $induk = Spt1770induk::where([['spt_id', $id]])->first();
            if($request->type=='submit'){
                $bayar = Spt1771setor::where('spt_id', $id)->sum('bayar');
                return view('user.eform.1770.submit',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'bayar' => $bayar,
                ]);
            }elseif($request->type=='lampiran3'){
                $lampiran3a = Spt17703a::where([['spt_id', $id]])->first();
                $lampiran3b = Spt17703b::where([['spt_id', $id]])->first();
                return view('user.eform.1770.lampiran3',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran3a' => $lampiran3a,
                    'lampiran3b' => $lampiran3b,
                ]);
            }elseif($request->type=='lampiran2'){
                return view('user.eform.1770.lampiran2',[
                    'spt' => $spt,
                    'induk' => $induk,
                ]);
            }elseif($request->type=='lampiran1'){
                $lampiran1 = Spt17701a::where([['spt_id', $id]])->first();
                return view('user.eform.1770.lampiran1',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran1' => $lampiran1,
                ]);
            }elseif($request->type=='lanjutan'){
                $lampiran1b = Spt17701b::where([['spt_id', $id]])->first();
                $lampiran1d = Spt17701d::where([['spt_id', $id]])->first();
                return view('user.eform.1770.lanjutan',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran1b' => $lampiran1b,
                    'lampiran1d' => $lampiran1d,
                ]);
            }elseif ($request->type=='induk') {
                $lampiran1a = Spt17701a::where([['spt_id', $id]])->first();
                $lampiran1b = Spt17701b::where([['spt_id', $id]])->first();
                $lampiran1c = Spt17701c::where('spt_id', $id)->sum('neto');
                $lampiran1d = Spt17701d::where([['spt_id', $id]])->first();
                $lampiran2a = Spt17702a::where('spt_id', $id)->sum('pph');
                return view('user.eform.1770.induk',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran1a' => $lampiran1a,
                    'lampiran1b' => $lampiran1b,
                    'lampiran1c' => $lampiran1c,
                    'lampiran1d' => $lampiran1d,
                    'lampiran2a' => $lampiran2a,
                ]);
            }else{
                return view('user.eform.1770.lampiran4',[
                    'spt' => $spt,
                    'induk' => $induk,
                ]);
            }
        }else{
            $request->session()->flash('alert-danger', 'SPT Tidak Ditemukan');
            return redirect()->back();
        }
    }

    public function datatableView(Request $request, $type, $spt_id){
        if($type=='harta'){
            $data = Spt17704a::where([['spt_id', $spt_id]])->get();
        }elseif($type=='utang'){
            $data = Spt17704b::where([['spt_id', $spt_id]])->get();
        }elseif($type=='keluarga'){
            $data = Spt17704c::where([['spt_id', $spt_id]])->get();
        }elseif($type=='bupot'){
            $data = Spt17702a::where([['spt_id', $spt_id]])->get();
        }elseif($type=='pekerjaan'){
            $data = Spt17701c::where([['spt_id', $spt_id]])->get();
        }elseif($type=='setor'){
            $data = Spt1771setor::where([['spt_id', $spt_id]])->get();
        }

        if ($request->ajax()) {            
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) use($type){

                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-primary btn-sm edit'.$type.'"><i class="fa fa-pencil"></i></a>';
                        $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm delete'.$type.'"><i class="fa fa-trash"></i></a>';
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function editableUpdate(Request $request, $type)
    {
    	if($request->ajax()){
            $name = $request->name;
            $column = substr($name, strpos($name, "_") + 1);
            $vcolumn = strstr($name, '_', true);
            if($type=='lampiran3a'){
                $this->validate($request,['value' => 'regex:/^[0-9]/']);
                $lamp = Spt17703a::find($request->pk);
                $value = str_replace(".","",$request->value);
                $value = str_replace(",","",$value);
                $lamp->$name = $value;
                $lamp->save();
                $hitung = $this->hitungTerutang($request->pk);
                return response()->json(['success' => true, 'jumlah' => $hitung->pph_total]);
            }elseif($type=='lampiran3b'){
                $this->validate($request,['value' => 'regex:/^[0-9]/']);
                $lamp = Spt17703b::find($request->pk);
                $value = str_replace(".","",$request->value);
                $value = str_replace(",","",$value);
                $lamp->$name = $value;
                $lamp->save();
                $lain = $lamp->luar_negeri+$lamp->imbalan+$lamp->lainnya;
                $jumlah = $lamp->bantuan+$lamp->warisan+$lamp->laba+$lamp->asuransi+$lamp->beasiswa+$lain;
                $lamp->jumlah = $jumlah;
                $lamp->save();
                return response()->json(['success' => true, 'column' => $column, 'jumlah' => $jumlah, 'lainnya' => $lain]);
            }elseif($type=='lampiran1'){
                $lamp = Spt17701a::find($request->pk);
                $value = str_replace(".","",$request->value);
                $value = str_replace(",","",$value);
                $lamp->$name = $value;
                $lamp->save();
                $this->hitungLamp1a($request->pk);
                return response()->json(['success' => true, 'column' => $name, 'value' => $lamp->$name]);
            }elseif($type=='lampiran1b'){
                $this->validate($request,['value' => 'regex:/^[0-9]/']);
                $lamp = Spt17701b::find($request->pk);
                $value = str_replace(".","",$request->value);
                $value = str_replace(",","",$value);
                $lamp->$name = $value;
                $lamp->save();
                $hitung = $this->hitungLamp1b($request->pk);
                return response()->json(['success' => true, 'peredaran_jumlah' => $hitung->peredaran_jumlah, 'penghasilan_jumlah' => $hitung->penghasilan_jumlah]);
            }elseif($type=='lampiran1d'){
                $this->validate($request,['value' => 'regex:/^[0-9]/']);
                $lamp = Spt17701d::find($request->pk);
                $value = str_replace(".","",$request->value);
                $value = str_replace(",","",$value);
                $lamp->$name = $value;
                $lamp->save();
                $jumlah = $lamp->bunga+$lamp->royalti+$lamp->sewa+$lamp->hadiah+$lamp->keuntungan+$lamp->lainnya;
                $lamp->jumlah = $jumlah;
                $lamp->save();
                return response()->json(['success' => true, 'jumlah' => $jumlah]);
            }elseif($type=='induk'){
                $lamp = Spt1770induk::find($request->pk);
                $value = str_replace(".","",$request->value);
                $value = str_replace(",","",$value);
                $lamp->$name = $value;
                $lamp->save();
                if($name == 'ptkp_code'){
                    $lamp->ptkp = $this->itungPtkp($request->value);
                    $lamp->save();
                }
                return response()->json(['success' => true, 'column' => $name, 'value' => $lamp->$name]);
            }
    	}
    }

    public function storeAjax(Request $request, $type, $spt_id){
        if($type=='harta'){
            Spt17704a::updateOrCreate([
                'id' => $request->id
            ],
            [
                'spt_id' => $spt_id,
                'kodeHarta' => $request->kodeHarta, 
                'jnsHarta' => $request->jnsHarta,
                'thPerolehan' => $request->thPerolehan,
                'harga' => $request->harga,
                'ket' => $request->ket,
            ]);
            return response()->json(['success'=>'Data saved successfully.']);
        }elseif($type=='utang'){
            Spt17704b::updateOrCreate([
                'id' => $request->id
            ],
            [
                'spt_id' => $spt_id,
                'kodeUtang' => $request->kodeUtang, 
                'nmPbrPinjam' => $request->nmPbrPinjam,
                'almtPbrPinjam' => $request->almtPbrPinjam,
                'thPinjam' => $request->thPinjam,
                'jmlPinjam' => $request->jmlPinjam,
            ]);
            return response()->json(['success'=>'Data saved successfully.']);
        }elseif($type=='keluarga'){
            Spt17704c::updateOrCreate([
                'id' => $request->id
            ],
            [
                'spt_id' => $spt_id,
                'nmAgKel' => $request->nmAgKel, 
                'nik' => $request->nik,
                'hubKel' => $request->hubKel,
                'kerja' => $request->kerja,
            ]);
            return response()->json(['success'=>'Data saved successfully.']);
        }elseif($type=='bupot'){
            Spt17702a::updateOrCreate([
                'id' => $request->id
            ],
            [
                'spt_id' => $spt_id,
                'nama' => $request->nama, 
                'npwp' => $request->npwp,
                'nomor' => $request->nomor,
                'tanggal' => $request->tanggal,
                'jenis' => $request->jenis,
                'pph' => $request->pph,
            ]);
            return response()->json(['success'=>'Data saved successfully.']);
        }elseif($type=='pekerjaan'){

            Spt17701c::updateOrCreate([
                'id' => $request->id
            ],
            [
                'spt_id' => $spt_id,
                'nama' => $request->nama, 
                'npwp' => $request->npwp,
                'penghasilan' => $request->penghasilan,
                'pengurangan' => $request->pengurangan,
                'neto' => $request->penghasilan - $request->pengurangan,
            ]);
            return response()->json(['success'=>'Data saved successfully.']);
        }elseif($type=='jenis_lapor'){
            $induk = Spt1770induk::where('spt_id', $spt_id)->first();
            if($request->type=='jenis_lapor'){
                $induk->jenis_lapor = $request->jenis_lapor;
                if($request->jenis_lapor=='Pembukuan'){
                    $lampiran1b = Spt17701b::where('spt_id', $spt_id);
                    $lampiran1b->update([
                        'peredaran_dagang' => 0, 'norma_dagang' => 0, 'penghasilan_dagang' => 0,
                        'peredaran_industri' => 0, 'norma_industri' => 0, 'penghasilan_industri' => 0,
                        'peredaran_jasa' => 0, 'norma_jasa' => 0, 'penghasilan_jasa' => 0,
                        'peredaran_bebas' => 0, 'norma_bebas' => 0, 'penghasilan_bebas' => 0,
                        'peredaran_lainnya' => 0, 'norma_lainnya' => 0, 'penghasilan_lainnya' => 0,
                        'peredaran_jumlah' => 0, 'penghasilan_jumlah' => 0,
                    ]);
                }else{
                    $lampiran1a = Spt17701a::where('spt_id', $spt_id);
                    $lampiran1a->update([
                        'butir1a' => 0, 'butir1b' => 0, 'butir1c' => 0,'butir1d' => 0, 'butir1e' => 0,
                        'butir2a' => 0, 'butir2b' => 0, 'butir2c' => 0,'butir2d' => 0, 'butir2e' => 0,
                        'butir2f' => 0, 'butir2g' => 0, 'butir2h' => 0,'butir2i' => 0, 'butir2j' => 0,
                        'butir2k' => 0, 'butir2l' => 0, 'butir3a' => 0,'butir3b' => 0, 'butir3c' => 0,
                        'butir3d' => 0, 'butir4' => 0, 'audit' => 'tidak', 'opini' => null, 'nama_kap' => null,
                        'npwp_kap' => null, 'nama_akuntan' => null, 'npwp_akuntan' => null, 'nama_kkp' => null,
                        'npwp_kkp' => null, 'nama_konsultan' => null, 'npwp_konsultan' => null
                    ]);
                }
            }
            $induk->save();
            return response()->json(['success'=>'Data updated successfully.']);
        }elseif($type=='lampiran1'){
            $lampiran1 = Spt17701a::where('spt_id', $spt_id)->first();
            if($request->type=='audit'){
                $lampiran1->audit = $request->audit;
                if($request->audit=='tidak'){
                    $lampiran1->opini = null;
                    $lampiran1->nama_kap = null;
                    $lampiran1->npwp_kap = null;
                    $lampiran1->nama_akuntan = null;
                    $lampiran1->npwp_akuntan = null;
                    $lampiran1->nama_kkp = null;
                    $lampiran1->npwp_kkp = null;
                    $lampiran1->nama_konsultan = null;
                    $lampiran1->npwp_konsultan = null;
                }
            }
            $lampiran1->save();
            return response()->json(['success'=>'Data updated successfully.']);
        }elseif($type=='setor'){
            Spt1771setor::updateOrCreate([
                'id' => $request->id
            ],
            [
                'spt_id' => $spt_id,
                'kode_map' => '411125',
                'kode_jenis' => '200',
                'tanggal' => $request->tanggal,
                'bayar' => $request->bayar,
                'ntpn' => $request->ntpn,
            ]);
            $bayar = Spt1771setor::where('spt_id', $spt_id)->sum('bayar');
            return response()->json(['success'=>'Data saved successfully.', 'pembayaran'=>$bayar]);
        }elseif($type=='induk'){
            $induk = Spt1770induk::where('spt_id', $spt_id)->first();
            if($request->type=='hitung'){
                $induk->neto_jumlah = $request->butir5;
                $induk->pkp = $request->butir11;
                $induk->pph_terutang = $request->butir12;
                $induk->kurang_bayar = $request->butir19;
                if($request->butir19>=0){
                    $induk->lebih_bayar=null;
                }else{
                    $induk->lebih_bayar='direstitusikan';
                    $induk->tanggal_lunas = null;
                }
            }elseif($request->type=='angsuran'){
                $induk->angsuran = $request->angsuran;
            }
            $induk->save();
            return response()->json(['success'=>'Data saved successfully.']);
        }
    }

    public function editAjax($type, $id)
    {
        if($type=='harta'){
            $lampiran = Spt17704a::find($id);
        }elseif($type=='utang'){
            $lampiran = Spt17704b::findOrFail($id);
        }elseif($type=='keluarga'){
            $lampiran = Spt17704c::findOrFail($id);  
        }elseif($type=='pekerjaan'){
            $lampiran = Spt17701c::findOrFail($id);
        }elseif($type=='bupot'){
            $lampiran = Spt17702a::findOrFail($id);
        }elseif($type=='setor'){
            $lampiran = Spt1771setor::findOrFail($id);
        }

        return response()->json($lampiran);
    }

    public function destroyAjax($type, $id)
    {
        if($type=='harta'){
            Spt17704a::find($id)->delete();
            return response()->json(['success'=>'Data deleted successfully.']);
        }elseif($type=='utang'){
            Spt17704b::find($id)->delete();
            return response()->json(['success'=>'Data deleted successfully.']);
        }elseif($type=='keluarga'){
            Spt17704c::find($id)->delete();
            return response()->json(['success'=>'Data deleted successfully.']);
        }elseif($type=='pekerjaan'){
            Spt17701c::find($id)->delete();
            return response()->json(['success'=>'Data deleted successfully.']);
        }elseif($type=='bupot'){
            Spt17702a::find($id)->delete();
            return response()->json(['success'=>'Data deleted successfully.']);
        }elseif($type=='setor'){
            $setor = Spt1771setor::find($id);
            $spt_id = $setor->spt_id;
            $setor->delete();
            $total = Spt1771setor::where('spt_id', $spt_id)->sum('bayar');
            return response()->json(['success'=>'Data saved successfully.', 'total'=>$total]);
        }
    }

    public function submit(Request $request, $id){
        $request->validate([
            'file_laporan' => 'mimes:pdf|max:2048',
            'file_rekapitulasi' => 'mimes:pdf|max:2048',
            'file_bupot' => 'mimes:pdf|max:2048',
            'file_lainnya' => 'mimes:pdf|max:2048',
        ]);

        $lampiran4a = Spt17704a::where('spt_id', $id)->count();
        $induk = Spt1770induk::where('spt_id', $id)->first();
        $spt = Spt::where('id', $id)->first();
        $message="";
        if($lampiran4a==0){
            $message .= "Harta Pada Akhir Tahun Tidak Boleh Kosong (Lampiran IV - Bagian A)<br>";
        }
        if($induk->tanggal_lapor==''){
            $message .= "Tanggal Lapor Tidak Boleh Kosong (Induk - Bagian Pernyataan)<br>";
        }

        if($induk->kurang_bayar>0 && $induk->tanggal_lunas==''){
            $message .= "Tanggal Lunas Tidak Boleh Kosong (Induk - No. 19)<br>";
        }

        //return
        if($lampiran4a==0 || $induk->kurang_bayar>0 && $induk->tanggal_lunas=='' || $induk->tanggal_lapor==''){
            $request->session()->flash('alert-danger', $message);
            return redirect()->back();
        }

        // menyimpan data file yang diupload
        //file_laporan
        if(!empty($request->file_laporan)) {
            $laporan = $request->file('file_laporan');
            $laporan_name = time().'.'.$laporan->getClientOriginalExtension();
            $folder = 'uploads';
            $laporan->move($folder,$laporan_name);
            $induk->file_laporan = $laporan_name;
        }

        //file_rekapitulasi
        if(!empty($request->file_rekapitulasi)) {
            $rekapitulasi = $request->file('file_rekapitulasi');
            $rekapitulasi_name = time().'.'.$rekapitulasi->getClientOriginalExtension();
            $folder = 'uploads';
            $rekapitulasi->move($folder, $rekapitulasi_name);
            $induk->file_rekapitulasi = $rekapitulasi_name;
        }

        //file_bupot
        if(!empty($request->file_bupot)) {
            $bupot = $request->file('file_bupot');
            $bupot_name = time().'.'.$bupot->getClientOriginalExtension();
            $folder = 'uploads';
            $bupot->move($folder, $bupot_name);
            $induk->file_bupot = $bupot_name;
        }

        //file_lainnya
        if(!empty($request->file_lainnya)) {
            $lainnya = $request->file('file_lainnya');
            $lainnya_name = time().'.'.$lainnya->getClientOriginalExtension();
            $folder = 'uploads';
            $lainnya->move($folder, $lainnya_name);
            $induk->file_lainnya = $lainnya_name;
        }

        $induk->save();

        if($induk->kurang_bayar>0){
            $bayar = Spt1771setor::where('spt_id', $request->id)->sum('bayar');
            $spt->status = 1;
            $spt->tax_value = $induk->kurang_bayar;
            $spt->payment_value = $bayar;
        }else{
            $spt->status = 0;
            $spt->tax_value =  0;
        }
        $spt->send_flag = 2;
        $spt->ntte = time().$spt->id;
        $spt->date = date('Y-m-d H:i:s');
        $spt->save();

//        $user = User::findOrFail(auth()->user()->id);
//        $body = "Berikut ini adalah Bukti Penerimaan Elektronik Anda.";
//        $body .="<br>---------------------------------------------------";
//        $body .="<br>Nama : ".$user->name;
//        $body .="<br>NPWP : ".$user->username;
//        $body .="<br>Tahun Pajak : ".$spt->year;
//        $body .="<br>Masa Pajak : ".$spt->start_period;
//        $body .="<br>Jenis SPT : ".$spt->form_code;
//        $body .="<br>Pembetulan ke :".$spt->correction_to;
//        $body .="<br>Status SPT : Nihil";
//        $body .="<br>Nominal : ".$spt->tax_value;
//        $body .="<br>Tanggal Penyampaian : ".$spt->date;
//        $body .="<br>Nomor Tanda Terima Elektronik : ".$spt->ntte;

//        $messages = [
//            'subject' => '[e-Form] Bukti Penerimaan Elektronik',
//            'greeting' => 'Hi '.$user->name.',',
//            'body' => $body,
//            'thanks' => 'Terima kasih telah menyampaikan Laporan SPT Anda.',
//        ];

//        $user->notify(new EmailNotification($messages));

        $request->session()->flash('alert-info', 'Berhasil');
        return redirect()->route('pelajar.spt.arsip');

    }

    public function detail(Request $request, $id){
        $spt = Spt::findOrFail($id);
        if($spt->form_code=='1770'){
            $induk = Spt1770induk::where([['spt_id', $id]])->first();
            if($request->type=='submit'){
                $bayar = Spt1771setor::where('spt_id', $id)->sum('bayar');
                return view('pengajar.spt.1770.submit',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'bayar' => $bayar,
                ]);
            }elseif($request->type=='lampiran3'){
                $lampiran3a = Spt17703a::where([['spt_id', $id]])->first();
                $lampiran3b = Spt17703b::where([['spt_id', $id]])->first();
                return view('pengajar.spt.1770.lampiran3',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran3a' => $lampiran3a,
                    'lampiran3b' => $lampiran3b,
                ]);
            }elseif($request->type=='lampiran2'){
                return view('pengajar.spt.1770.lampiran2',[
                    'spt' => $spt,
                    'induk' => $induk,
                ]);
            }elseif($request->type=='lampiran1'){
                $lampiran1 = Spt17701a::where([['spt_id', $id]])->first();
                return view('pengajar.spt.1770.lampiran1',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran1' => $lampiran1,
                ]);
            }elseif($request->type=='lanjutan'){
                $lampiran1b = Spt17701b::where([['spt_id', $id]])->first();
                $lampiran1d = Spt17701d::where([['spt_id', $id]])->first();
                return view('pengajar.spt.1770.lanjutan',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran1b' => $lampiran1b,
                    'lampiran1d' => $lampiran1d,
                ]);
            }elseif ($request->type=='induk') {
                $lampiran1a = Spt17701a::where([['spt_id', $id]])->first();
                $lampiran1b = Spt17701b::where([['spt_id', $id]])->first();
                $lampiran1c = Spt17701c::where('spt_id', $id)->sum('neto');
                $lampiran1d = Spt17701d::where([['spt_id', $id]])->first();
                $lampiran2a = Spt17702a::where('spt_id', $id)->sum('pph');
                return view('pengajar.spt.1770.induk',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran1a' => $lampiran1a,
                    'lampiran1b' => $lampiran1b,
                    'lampiran1c' => $lampiran1c,
                    'lampiran1d' => $lampiran1d,
                    'lampiran2a' => $lampiran2a,
                ]);
            }else{
                return view('pengajar.spt.1770.lampiran4',[
                    'spt' => $spt,
                    'induk' => $induk,
                ]);
            }
        }else{
            $request->session()->flash('alert-danger', 'Eform Tidak Ditemukan');
            return redirect()->back();
        }
    }


    public function hitungTerutang($id){
        $lamp = Spt17703a::findOrFail($id);
        $lamp->pjk_total = $lamp->pjk_deposito+$lamp->pjk_obligasi+$lamp->pjk_saham+$lamp->pjk_hadiah+$lamp->pjk_pesangon+$lamp->pjk_honorarium+$lamp->pjk_pengalihan+$lamp->pjk_bangunan+$lamp->pjk_sewa+$lamp->pjk_usaha+$lamp->pjk_bbm+$lamp->pjk_koperasi+$lamp->pjk_dividen+$lamp->pjk_istri+$lamp->pjk_lain;
        $lamp->pph_total = $lamp->pph_deposito+$lamp->pph_obligasi+$lamp->pph_saham+$lamp->pph_hadiah+$lamp->pph_pesangon+$lamp->pph_honorarium+$lamp->pph_pengalihan+$lamp->pph_bangunan+$lamp->pph_sewa+$lamp->pph_usaha+$lamp->pph_bbm+$lamp->pph_koperasi+$lamp->pph_dividen+$lamp->pph_istri+$lamp->pph_lain;
        $lamp->save();

        return $lamp;
    }

    public function hitungLamp1b($id){
        $lamp = Spt17701b::findOrFail($id);
        $lamp->peredaran_jumlah = $lamp->peredaran_dagang+$lamp->peredaran_industri+$lamp->peredaran_jasa+$lamp->peredaran_bebas+$lamp->peredaran_lainnya;
        $lamp->penghasilan_jumlah = $lamp->penghasilan_dagang+$lamp->penghasilan_industri+$lamp->penghasilan_jasa+$lamp->penghasilan_bebas+$lamp->penghasilan_lainnya;
        $lamp->save();
        return $lamp;
    }

    public function hitungLamp1a($id){
        $lamp = Spt17701a::findOrFail($id);
        $butir1c = $lamp->butir1a-$lamp->butir1b;
        $butir1e = $butir1c-$lamp->butir1d;
        $butir2l = $lamp->butir2a+$lamp->butir2b+$lamp->butir2c+$lamp->butir2d+$lamp->butir2e+$lamp->butir2f+$lamp->butir2g+$lamp->butir2h+$lamp->butir2i+$lamp->butir2j+$lamp->butir2k;
        $butir3d = $lamp->butir3a+$lamp->butir3b+$lamp->butir3c;
        $butir4 = $butir1e+$butir2l-$butir3d;
        $lamp->butir1c = $butir1c;
        $lamp->butir1e = $butir1e;
        $lamp->butir2l = $butir2l;
        $lamp->butir3d = $butir3d;
        $lamp->butir4 = $butir4;
        $lamp->save();
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