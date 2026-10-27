<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spt1771lampkhus2a;
use App\Models\Spt1771lampkhus1;
use App\Models\Spt1771lampkhus1a;
use App\Models\Spt1771lampiran6a;
use App\Models\Spt1771lampiran6bc;
use App\Models\Spt1771lampiran5a;
use App\Models\Spt1771lampiran5b;
use App\Models\Spt1771lampiran4a;
use App\Models\Spt1771lampiran4alain;
use App\Models\Spt1771lampiran4b;
use App\Models\Spt1771lampiran4blain;
use App\Models\Spt1771lampiran3a;
use App\Models\Spt1771lampiran2;
use App\Models\Spt1771lampiran1;
use App\Models\Spt1771induk;
use App\Models\Spt1771setor;
use App\Models\Spt;
use App\Models\Spt1770induk;
use App\Models\Spt17703a;
use App\Models\Spt17703b;
use App\Models\Spt17701a;
use App\Models\Spt17701b;
use App\Models\Spt17701d;
use App\Models\User;
use App\Models\ClassStudent;
use App\Notifications\EmailNotification;
use DataTables;

class EformController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified','spt']);
    }

    public function index(){
        $spt = Spt::where([['user_id', auth()->user()->id], ['send_flag', 2]])->whereIn('form_code', ['1771'])->orderBy('year', 'desc')->orderBy('correction_to')->orderBy('id', 'desc')->get();
        $class_student = ClassStudent::with('kelas')->where('student_id', auth()->user()->id)->first();
        return view('user.eform.archieve',[
            'data' => $spt,
            'class_student' => $class_student,
        ]);
    }

    public function create(){
        return view('user.eform.create');
    }

    public function draft(){
        $spt = Spt::where([['user_id', auth()->user()->id], ['send_flag','<>', 2]])->whereIn('form_code', ['1771'])->orderBy('id', 'desc')->get();
        return view('user.eform.draft', [
            'data' => $spt,
        ]);
    }

    public function store(Request $request, $type)
    {
        $year = $request->year;
        $spt = new SPT;
        $spt->user_id = auth()->user()->id;
        $spt->correction_to = $request->correction_no;
        $spt->form_code = $type;
        $spt->year = $year;
        $spt->date = date('Y-m-d H:i:s');
        $spt->status = 0;
        $spt->tax_value = 0;
        $spt->payment_value = 0;
        $spt->send_flag = 0;
        $spt->save();
        
        //induk
        Spt1771induk::create([
            'spt_id'=>$spt->id, 'telp'=>auth()->user()->mobile_phone, 'periode_awal'=>'01/'.$year, 'periode_akhir'=>$year,
            'alamat'=>auth()->user()->profile->address, 'nama_lengkap'=>auth()->user()->name, 'npwp'=>auth()->user()->username,
        ]);
        if($type=='1771'){
            Spt1771lampiran1::create(['spt_id'=>$spt->id]);
            Spt1771lampiran2::create(['spt_id'=>$spt->id]);
            Spt1771lampiran4a::create(['spt_id'=>$spt->id]);
            Spt1771lampiran4b::create(['spt_id'=>$spt->id]);
            Spt1771lampkhus1::create(['spt_id'=>$spt->id, 'jenis_fiskal'=>'penyusutan']);
            Spt1771lampkhus1::create(['spt_id'=>$spt->id, 'jenis_fiskal'=>'amortisasi']);
            Spt1771lampkhus2a::create(['spt_id'=>$spt->id]);
        }else{
            Spt1770induk::create(['spt_id'=>$spt->id]);
            Spt17703a::create(['spt_id'=>$spt->id]);
            Spt17703b::create(['spt_id'=>$spt->id]);
            Spt17701a::create(['spt_id'=>$spt->id]);
            Spt17701b::create(['spt_id'=>$spt->id]);
            Spt17701d::create(['spt_id'=>$spt->id]);
        }

        $request->session()->flash('alert-info', 'SPT '.$type.' Berhasil Dibuat');
        return redirect()->route('pelajar.eform.'.$type, ['id'=>$spt->id]);
    }

    //1771
    public function corporate(Request $request, $id){
        $spt = Spt::findOrFail($id);
        if($spt->form_code=='1771'){
            $induk = Spt1771induk::where([['spt_id', $id]])->first();
            if($request->type=='submit'){
                $bayar = Spt1771setor::where('spt_id', $id)->sum('bayar');
                return view('user.eform.1771.submit',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'bayar' => $bayar,
                ]);
            }elseif($request->type=='lampkhus2a'){
                $lampkhus2a = Spt1771lampkhus2a::where([['spt_id', $id]])->first();
                return view('user.eform.1771.lampkhus2a',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampkhus2a' => $lampkhus2a,
                ]);
            }elseif($request->type=='lampkhus1a'){
                $penyusutan = Spt1771lampkhus1::where([['jenis_fiskal', 'penyusutan'],['spt_id', $id]])->first();
                $amortisasi = Spt1771lampkhus1::where([['jenis_fiskal', 'amortisasi'],['spt_id', $id]])->first();
                return view('user.eform.1771.lampkhus1a',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'penyusutan' => $penyusutan,
                    'amortisasi' => $amortisasi,
                ]);
            }elseif($request->type=='lampiran6'){
                return view('user.eform.1771.lampiran6',[
                    'spt' => $spt,
                    'induk' => $induk,
                ]);
            }elseif($request->type=='lampiran5'){
                return view('user.eform.1771.lampiran5',[
                    'spt' => $spt,
                    'induk' => $induk,
                ]);
            }elseif($request->type=='lampiran4'){
                $lampiran4a = Spt1771lampiran4a::where([['spt_id', $id]])->first();
                $lampiran4b = Spt1771lampiran4b::where([['spt_id', $id]])->first();
                $pph = Spt1771lampiran4alain::where('spt_id', $id)->sum('terutang');
                $penghasilan = Spt1771lampiran4blain::where('spt_id', $id)->sum('penghasilan');
                return view('user.eform.1771.lampiran4',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran4a' => $lampiran4a,
                    'lampiran4b' => $lampiran4b,
                    'pph' => $pph,
                    'penghasilan' => $penghasilan,
                ]);
            }elseif($request->type=='lampiran3'){
                return view('user.eform.1771.lampiran3',[
                    'spt' => $spt,
                    'induk' => $induk,
                ]);
            }elseif($request->type=='lampiran2'){
                $lampiran2 = Spt1771lampiran2::where([['spt_id', $id]])->first();
                return view('user.eform.1771.lampiran2',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran2' => $lampiran2,
                ]);
            }elseif($request->type=='lampiran1'){
                $lampiran1 = Spt1771lampiran1::where([['spt_id', $id]])->first();
                $lampiran2 = Spt1771lampiran2::where([['spt_id', $id]])->first();
                $penyusutan = Spt1771lampkhus1::where([['jenis_fiskal', 'penyusutan'], ['spt_id', $id]])->first();
                $amortisasi = Spt1771lampkhus1::where([['jenis_fiskal', 'amortisasi'], ['spt_id', $id]])->first();
                return view('user.eform.1771.lampiran1',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran1' => $lampiran1,
                    'lampiran2' => $lampiran2,
                    'penyusutan' => $penyusutan,
                    'amortisasi' => $amortisasi,
                ]);
            }elseif($request->type=='lanjutan'){
                $lampiran4a = Spt1771lampiran4a::where([['spt_id', $id]])->first();
                $lampiran4b = Spt1771lampiran4b::where([['spt_id', $id]])->first();
                $lampkhus2a = Spt1771lampkhus2a::where([['spt_id', $id]])->first();
                return view('user.eform.1771.induk_lanjutan',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran4a' => $lampiran4a,
                    'lampiran4b' => $lampiran4b,
                    'lampkhus2a' => $lampkhus2a,
                ]);
            }else{
                $lampiran1 = Spt1771lampiran1::where([['spt_id', $id]])->first();
                $pph_potput = Spt1771lampiran3a::where('spt_id', $id)->sum('pph');
                $lampkhus2a = Spt1771lampkhus2a::where([['spt_id', $id]])->first();
                return view('user.eform.1771.induk',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran1' => $lampiran1,
                    'pph_potput' => $pph_potput,
                    'lampkhus2a' => $lampkhus2a,
                ]);
            }
        }else{
            $request->session()->flash('alert-danger', 'SPT Tidak Ditemukan');
            return redirect()->back();
        }
    }

    public function datatableView(Request $request, $type, $spt_id){
        if($type=='penyusutan'){
            $data = Spt1771lampkhus1a::where([['jenis_fiskal', 'penyusutan'],['spt_id', $spt_id]])->get();
        }elseif($type=='amortisasi'){
            $data = Spt1771lampkhus1a::where([['jenis_fiskal', 'amortisasi'],['spt_id', $spt_id]])->get();
        }elseif($type=='modal'){
            $data = Spt1771lampiran6a::where([['spt_id', $spt_id]])->get();
        }elseif($type=='utang'){
            $data = Spt1771lampiran6bc::where([['jenis', 'utang'],['spt_id', $spt_id]])->get();
        }elseif($type=='piutang'){
            $data = Spt1771lampiran6bc::where([['jenis', 'piutang'],['spt_id', $spt_id]])->get();
        }elseif($type=='pemegang'){
            $data = Spt1771lampiran5a::where([['spt_id', $spt_id]])->get();
        }elseif($type=='pengurus'){
            $data = Spt1771lampiran5b::where([['spt_id', $spt_id]])->get();
        }elseif($type=='penghasilan'){
            $data = Spt1771lampiran4alain::where([['spt_id', $spt_id]])->get();
        }elseif($type=='lainnya'){
            $data = Spt1771lampiran4blain::where([['spt_id', $spt_id]])->get();
        }elseif($type=='pemotongan'){
            $data = Spt1771lampiran3a::where([['spt_id', $spt_id]])->get();
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
            if($type=='lampiran4a'){
                $this->validate($request,['value' => 'regex:/^[0-9]/']);
                $lamp = Spt1771lampiran4a::find($request->pk);
                $value = str_replace(".","",$request->value);
                $value = str_replace(",","",$value);
                $lamp->$name = $value;
                $lamp->save();
                $hitung = $this->hitungTerutang($request->pk);
                return response()->json(['success' => true, 'column' => $column, 'pajak' => $hitung->{'pjk_'.$column}, 'pph' => $hitung->{'ph_'.$column}, 'jumlah' => $hitung->terutang]);
            }elseif($type=='lampiran4b'){
                $this->validate($request,['value' => 'regex:/^[0-9]/']);
                $lamp = Spt1771lampiran4b::find($request->pk);
                $value = str_replace(".","",$request->value);
                $value = str_replace(",","",$value);
                $lamp->$name = $value;
                $lamp->save();
                $penghasilan = Spt1771lampiran4blain::where('spt_id', $lamp->spt_id)->sum('penghasilan');
                $hitung = $lamp->bantuan+$lamp->hibah+$lamp->dividen+$lamp->iuran+$lamp->laba+$lamp->sisa;
                $lamp->jumlah = $hitung;
                $lamp->total = $penghasilan+$hitung;
                $lamp->save();
                return response()->json(['success' => true, 'column' => $column, 'jumlah' => $hitung]);
            }elseif($type=='lampiran2'){
                $this->validate($request,['value' => 'regex:/^[0-9]/']);
                $lamp = Spt1771lampiran2::find($request->pk);
                $value = str_replace(".","",$request->value);
                $value = str_replace(",","",$value);
                $lamp->$name = $value;
                $lamp->save();
                $hitung = $this->hitungLamp2($request->pk);
                return response()->json(['success' => true, 'hcolumn' => 'jumlah_'.$column, 'vcolumn' => 'jumlah_'.$vcolumn, 'hjumlah' => $hitung->{'jumlah_'.$column}, 'vjumlah' => $hitung->{'jumlah_'.$vcolumn}, 'total' => $hitung->total]);
            }elseif($type=='lampiran1'){
                $this->validate($request,['value' => 'regex:/^[0-9]/']);
                $lamp = Spt1771lampiran1::find($request->pk);
                $value = str_replace(".","",$request->value);
                $value = str_replace(",","",$value);
                $lamp->$name = $value;
                $lamp->save();
                return response()->json(['success' => true, 'column' => $name, 'value' => $lamp->$name, 'id' => $lamp->id]);
            }elseif($type=='lampkhus1a'){
                $this->validate($request,['value' => 'regex:/^[0-9]/']);
                $lamp = Spt1771lampkhus1::find($request->pk);
                $value = str_replace(".","",$request->value);
                $value = str_replace(",","",$value);
                $lamp->$name = $value;
                $lamp->save();
                $fiskal = Spt1771lampkhus1a::where([['jenis_fiskal', $lamp->jenis_fiskal], ['spt_id', $lamp->spt_id]])->sum('fiskal');
                $lamp->jumlah_fiskal = $fiskal;
                $lamp->selisih = $fiskal-$lamp->jumlah_komersial;
                $lamp->save();
                return response()->json(['success' => true, 'name' => $name, 'value' => number_format($request->value, 0, ',', '.'), 'column' => $lamp->jenis_fiskal, 'fiskal'=>$lamp->jumlah_fiskal, 'selisih'=>$lamp->selisih]);
            }elseif($type=='lampkhus2a'){
//                $this->validate($request,['value' => 'regex:/^[0-9]/']);
                $lamp = Spt1771lampkhus2a::find($request->pk);
                $value = str_replace(".","",$request->value);
                $value = str_replace(",","",$value);
                $lamp->$name = $value;
                $lamp->save();
                if(substr($name,6,1)!=''){
                    $y = substr($name,6,1);
                    $lamp->{'nilai6'.$y} = $lamp->{'nilai1'.$y}+$lamp->{'nilai2'.$y}+$lamp->{'nilai3'.$y}+$lamp->{'nilai4'.$y}+$lamp->{'nilai5'.$y};
                    $lamp->save();
                    $name = 'nilai6'.$y;
                }
                return response()->json(['success' => true, 'column' => $name, 'value' => $lamp->$name]);
            }elseif($type=='induk'){
                $lamp = Spt1771induk::find($request->pk);
                $value = str_replace(".","",$request->value);
                $value = str_replace(",","",$value);
                $lamp->$name = $value;
                if($name=='penghasilan'){
                    $lamp1 = Spt1771lampiran1::where('spt_id', $lamp->spt_id)->first();
                    $lamp->pph_terutang_14 = $this->hitungPphTerutang($lamp1->peredaran_usaha+$lamp1->penghasilan_luar, $value, $lamp->tarif_pph);
                }
                $lamp->save();
                return response()->json(['success' => true, 'column' => $name, 'value' => $lamp->$name, 'terutang_14'=>$lamp->pph_terutang_14]);
            }
    	}
    }

    public function storeAjax(Request $request, $type, $spt_id){
        if($type=='penyusutan' || $type=='amortisasi'){
            Spt1771lampkhus1a::updateOrCreate([
                'id' => $request->id
            ],
            [
                'spt_id' => $spt_id,
                'jenis_fiskal' => $type,
                'jenis_harta' => $request->jenis_harta, 
                'kelompok_harta' => $request->kelompok_harta,
                'nama_harta' => $request->nama_harta,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
                'harga' => $request->harga,
                'nilai_sisa' => $request->nilai_sisa,
                'metode_komersial' => $request->metode_komersial,
                'metode_fiskal' => $request->metode_fiskal,
                'fiskal' => $request->fiskal,
                'catatan' => $request->catatan,
            ]);
            $fiskal = Spt1771lampkhus1a::where([['jenis_fiskal', $type], ['spt_id', $spt_id]])->sum('fiskal');
            $lamp = Spt1771lampkhus1::where([['jenis_fiskal', $type], ['spt_id', $spt_id]])->first();
            $lamp->jumlah_fiskal = $fiskal;
            $lamp->selisih = $fiskal-$lamp->jumlah_komersial;
            $lamp->save();
            return response()->json(['success'=>'Data saved successfully.', 'fiskal'=>$lamp->jumlah_fiskal, 'selisih'=>$lamp->selisih]);
        }elseif($type=='modal'){
            Spt1771lampiran6a::updateOrCreate([
                'id' => $request->id
            ],
            [
                'spt_id' => $spt_id,
                'nama' => $request->nama, 
                'alamat' => $request->alamat,
                'npwp' => $request->npwp,
                'rupiah' => $request->rupiah,
                'persen' => $request->persen,
            ]);
            return response()->json(['success'=>'Data saved successfully.']);
        }elseif($type=='utang' || $type=='piutang'){
            Spt1771lampiran6bc::updateOrCreate([
                'id' => $request->id
            ],
            [
                'spt_id' => $spt_id,
                'jenis' => $type,
                'nama' => $request->nama, 
                'npwp' => $request->npwp,
                'jumlah' => $request->jumlah,
                'bunga' => $request->bunga,
                'tahun' => $request->tahun,
            ]);
            return response()->json(['success'=>'Data saved successfully.']);
        }elseif($type=='pemegang'){
            Spt1771lampiran5a::updateOrCreate([
                'id' => $request->id
            ],
            [
                'spt_id' => $spt_id,
                'nama' => $request->nama, 
                'alamat' => $request->alamat,
                'npwp' => $request->npwp,
                'modal' => $request->modal,
                'persen' => $request->persen,
                'dividen' => $request->dividen,
            ]);
            return response()->json(['success'=>'Data saved successfully.']);
        }elseif($type=='pengurus'){

            Spt1771lampiran5b::updateOrCreate([
                'id' => $request->id
            ],
            [
                'spt_id' => $spt_id,
                'nama' => $request->nama, 
                'alamat' => $request->alamat,
                'npwp' => $request->npwp,
                'jabatan' => $request->jabatan,
            ]);
            return response()->json(['success'=>'Data saved successfully.']);
        }elseif($type=='penghasilan'){
            $terutang = ($request->pajak * $request->tarif)/100;
            Spt1771lampiran4alain::updateOrCreate([
                'id' => $request->id
            ],
            [
                'spt_id' => $spt_id,
                'jenis' => $request->jenis, 
                'pajak' => $request->pajak,
                'tarif' => $request->tarif,
                'terutang' => $terutang,
            ]);
            $total = Spt1771lampiran4alain::where('spt_id', $spt_id)->sum('terutang');
            $lamp = Spt1771lampiran4a::where('spt_id', $spt_id)->first();
            $lamp->total = $lamp->terutang+$total;
            $lamp->save();
            return response()->json(['success'=>'Data saved successfully.', 'total'=>$total]);
        }elseif($type=='lainnya'){

            Spt1771lampiran4blain::updateOrCreate([
                'id' => $request->id
            ],
            [
                'spt_id' => $spt_id,
                'jenis' => $request->jenis, 
                'penghasilan' => $request->penghasilan,
            ]);
            $total = Spt1771lampiran4blain::where('spt_id', $spt_id)->sum('penghasilan');
            $lamp = Spt1771lampiran4b::where('spt_id', $spt_id)->first();
            $lamp->total = $lamp->jumlah+$total;
            $lamp->save();
            return response()->json(['success'=>'Data saved successfully.', 'total'=>$total]);
        }elseif($type=='pemotongan'){
            Spt1771lampiran3a::updateOrCreate([
                'id' => $request->id
            ],
            [
                'spt_id' => $spt_id,
                'nama' => $request->nama, 
                'npwp' => $request->npwp,
                'jenis' => $request->jenis,
                'potongan' => $request->potongan,
                'pph' => $request->pph,
                'no_bukti' => $request->no_bukti,
                'tanggal' => $request->tanggal,
                'alamat' => $request->alamat,
                'ntpn' => $request->ntpn,
            ]);
            return response()->json(['success'=>'Data saved successfully.']);
        }elseif($type=='lampiran1'){
            $lamp = Spt1771lampiran1::where('spt_id', $spt_id)->first();
            $lamp->komersial = $request->komersial;
            $lamp->total = $request->total;
            $lamp->save();
            $lampkhus2a = Spt1771lampkhus2a::where([['spt_id', $spt_id]])->first();
            $induk = Spt1771induk::where('spt_id', $spt_id)->first();
            $induk->pph_terutang = $this->hitungPphTerutang($lamp->peredaran_usaha+$lamp->penghasilan_luar, $request->total-$lampkhus2a->nilai65, $induk->tarif_pph);
            if($request->total>50000000000 && $induk->tarif_pph!='pasal 17 ayat 2b'){
                $induk->tarif_pph = 'pasal 17 ayat 1b';
            }elseif($request->total<=50000000000){
                $induk->tarif_pph = 'pasal 31e ayat 1';
            }
            $induk->save();
            $induk->pph_terutang_14 = ($induk->tarif_pph=='pasal 17 ayat 1b') ? 0.22 * $induk->penghasilan : (($induk->tarif_pph=='pasal 17 ayat 2b') ? 0.19 * $induk->penghasilan : 0.11 * $induk->penghasilan);
            $induk->save();
            return response()->json(['success'=>'Data updated successfully.']);
        }elseif($type=='induk'){
            $induk = Spt1771induk::where('spt_id', $spt_id)->first();
            if($request->type=='audit'){
                $induk->audit = $request->audit;
                if($request->audit=='tidak'){
                    $induk->opini = null;
                    $induk->nama_kap = null;
                    $induk->npwp_kap = null;
                    $induk->nama_akuntan = null;
                    $induk->npwp_akuntan = null;
                }
            }elseif($request->type=='pph'){
                if($request->jumlah>=0){
                    $induk->lebih_bayar=null;
                    $induk->kurang_bayar=$request->jumlah;
                }else{
                    $induk->tanggal = null;
                    $induk->lebih_bayar='direstitusikan';
                    $induk->kurang_bayar=0;
                }
            }elseif($request->type=='terutang'){
                $induk->tarif_pph=$request->tarif;
                $induk->pph_terutang = $request->terutang;
                $induk->pph_terutang_14 = ($request->tarif=='pasal 17 ayat 1b') ? 0.22 * $induk->penghasilan : 0.19 * $induk->penghasilan;
            }
            $induk->save();
            return response()->json(['success'=>'Data updated successfully.']);
        }elseif($type=='setor'){
            Spt1771setor::updateOrCreate([
                'id' => $request->id
            ],
            [
                'spt_id' => $spt_id,
                'kode_map' => '411126', 
                'kode_jenis' => '200',
                'tanggal' => $request->tanggal,
                'bayar' => $request->bayar,
                'ntpn' => $request->ntpn,
            ]);
            $bayar = Spt1771setor::where('spt_id', $spt_id)->sum('bayar');
            return response()->json(['success'=>'Data saved successfully.', 'pembayaran'=>$bayar]);
        }
    }

    public function editAjax($type, $id)
    {
        if($type=='penyusutan' || $type=='amortisasi'){
            $lampiran = Spt1771lampkhus1a::find($id);
        }elseif($type=='modal'){
            $lampiran = Spt1771lampiran6a::findOrFail($id);   
        }elseif($type=='utang' || $type=='piutang'){
            $lampiran = Spt1771lampiran6bc::findOrFail($id);  
        }elseif($type=='pemegang'){
            $lampiran = Spt1771lampiran5a::findOrFail($id);
        }elseif($type=='pengurus'){
            $lampiran = Spt1771lampiran5b::findOrFail($id);
        }elseif($type=='penghasilan'){
            $lampiran = Spt1771lampiran4alain::findOrFail($id);
        }elseif($type=='lainnya'){
            $lampiran = Spt1771lampiran4blain::findOrFail($id);
        }elseif($type=='pemotongan'){
            $lampiran = Spt1771lampiran3a::findOrFail($id);
        }elseif($type=='setor'){
            $lampiran = Spt1771setor::findOrFail($id);
        }

        return response()->json($lampiran);
    }

    public function destroyAjax($type, $id)
    {
        if($type=='penyusutan' || $type=='amortisasi'){
            $old = Spt1771lampkhus1a::find($id);
            $spt_id = $old->spt_id;
            $old->delete();
            $fiskal = Spt1771lampkhus1a::where([['jenis_fiskal', $type], ['spt_id', $spt_id]])->sum('fiskal');
            $lamp = Spt1771lampkhus1::where([['jenis_fiskal', $type], ['spt_id', $spt_id]])->first();
            $lamp->jumlah_fiskal = $fiskal;
            $lamp->selisih = $fiskal-$lamp->jumlah_komersial;
            $lamp->save();
            return response()->json(['success'=>'Data saved successfully.', 'fiskal'=>$lamp->jumlah_fiskal, 'selisih'=>$lamp->selisih]);
        }elseif($type=='modal'){
            Spt1771lampiran6a::find($id)->delete();
            return response()->json(['success'=>'Data deleted successfully.']);
        }elseif($type=='utang' || $type=='piutang'){
            Spt1771lampiran6bc::find($id)->delete();
            return response()->json(['success'=>'Data deleted successfully.']);
        }elseif($type=='pemegang'){
            Spt1771lampiran5a::find($id)->delete();
            return response()->json(['success'=>'Data deleted successfully.']);
        }elseif($type=='pengurus'){
            Spt1771lampiran5b::find($id)->delete();
            return response()->json(['success'=>'Data deleted successfully.']);
        }elseif($type=='penghasilan'){
            $lamp = Spt1771lampiran4alain::find($id);
            $spt_id = $lamp->spt_id;
            $lamp->delete();
            $total = Spt1771lampiran4alain::where('spt_id', $spt_id)->sum('terutang');
            return response()->json(['success'=>'Data saved successfully.', 'total'=>$total]);
        }elseif($type=='lainnya'){
            $lamp = Spt1771lampiran4blain::find($id);
            $spt_id = $lamp->spt_id;
            $lamp->delete();
            $total = Spt1771lampiran4alain::where('spt_id', $spt_id)->sum('terutang');
            return response()->json(['success'=>'Data saved successfully.', 'total'=>$total]);
        }elseif($type=='pemotongan'){
            Spt1771lampiran3a::find($id)->delete();
            return response()->json(['success'=>'Data deleted successfully.']);
        }elseif($type=='setor'){
            $setor = Spt1771setor::find($id);
            $spt_id = $setor->spt_id;
            $setor->delete();
            $total = Spt1771setor::where('spt_id', $spt_id)->sum('bayar');
            return response()->json(['success'=>'Data saved successfully.', 'total'=>$total]);
        }
    }

    public function submit(Request $request){
        $request->validate([
            'spt_id'    => 'required',
            'file_laporan' => 'mimes:pdf|max:2048',
            'file_rekapitulasi' => 'mimes:pdf|max:2048',
            'file_nominatif' => 'mimes:pdf|max:2048',
            'file_but' => 'mimes:pdf|max:2048',
            'file_migas' => 'mimes:pdf|max:2048',
            'file_perbandingan' => 'mimes:pdf|max:2048',
            'file_lainnya' => 'mimes:pdf|max:2048',
        ]);

        $lampiran5a = Spt1771lampiran5a::where('spt_id', $request->spt_id)->count();
        $lampiran5b = Spt1771lampiran5b::where('spt_id', $request->spt_id)->count();
        $induk = Spt1771induk::where('spt_id', $request->spt_id)->first();
        $spt = Spt::where('id', $request->spt_id)->first();
        $message="";
        if($lampiran5a==0){
            $message .= "Daftar Pemegang Saham / Pemilik Modal dan Dividen yang Dibagikan Tidak Boleh Kosong (Lampiran V - Bagian A)<br>";
        }
        if($lampiran5b==0){
            $message .= "Daftar Susunan Pengurus dan Komisaris Tidak Boleh Kosong (Lampiran V - Bagian B)<br>";
        }

        if($induk->kurang_bayar>0 && $induk->tanggal==''){
            $message .= "Tanggal Tidak Boleh Kosong (Induk - No. 12)<br>";
        }

        if($induk->tempat_ttd=='' || $induk->tanggal_lapor){
            $message .= "Tempat dan Tanggal TTD Tidak Boleh Kosong (Induk Lanjutan - Penyataan c dan d)<br>";
        }

        //return
        if($lampiran5a==0 || $lampiran5b==0 || $induk->kurang_bayar>0 && $induk->tanggal=='' || $induk->tempat_ttd=='' || $induk->tanggal_lapor){
            $request->session()->flash('alert-danger', $message);
            return redirect()->back();
        }

        // menyimpan data file yang diupload
        if(!empty($request->file_laporan)) {
            $laporan = $request->file('file_laporan');
            $laporan_name = time() . '.' . $laporan->getClientOriginalExtension();
            $folder = 'uploads';
            $laporan->move($folder, $laporan_name);
            $induk->file_laporan = $laporan_name;
            $induk->save();
        }

        //file_rekapitulasi
        if(!empty($request->file_rekapitulasi)) {
            $rekapitulasi = $request->file('file_rekapitulasi');
            $rekapitulasi_name = time().'.'.$rekapitulasi->getClientOriginalExtension();
            $folder = 'uploads';
            $rekapitulasi->move($folder, $rekapitulasi_name);
            $induk->file_rekapitulasi = $rekapitulasi_name;
            $induk->save();
        }


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
//        $body .="<br>Nama : ".$user->profile->corporate_name;
//        $body .="<br>NPWP : ".$user->npwp;
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
//            'greeting' => 'Hi '.$user->profile->corporate_name.',',
//            'body' => $body,
//            'thanks' => 'Terima kasih telah menyampaikan Laporan SPT Anda.',
//        ];
//
//        $user->notify(new EmailNotification($messages));

        $request->session()->flash('alert-info', 'Berhasil');
        return redirect()->route('pelajar.eform.arsip');

    }

    public function detail(Request $request, $id){
        $spt = Spt::findOrFail($id);
        if($spt->form_code=='1771'){
            $induk = Spt1771induk::where([['spt_id', $id]])->first();
            if($request->type=='submit'){
                $bayar = Spt1771setor::where('spt_id', $id)->sum('bayar');
                return view('pengajar.spt.1771.submit',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'bayar' => $bayar,
                ]);
            }elseif($request->type=='lampkhus2a'){
                $lampkhus2a = Spt1771lampkhus2a::where([['spt_id', $id]])->first();
                return view('pengajar.spt.1771.lampkhus2a',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampkhus2a' => $lampkhus2a,
                ]);
            }elseif($request->type=='lampkhus1a'){
                $penyusutan = Spt1771lampkhus1::where([['jenis_fiskal', 'penyusutan'],['spt_id', $id]])->first();
                $amortisasi = Spt1771lampkhus1::where([['jenis_fiskal', 'amortisasi'],['spt_id', $id]])->first();
                return view('pengajar.spt.1771.lampkhus1a',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'penyusutan' => $penyusutan,
                    'amortisasi' => $amortisasi,
                ]);
            }elseif($request->type=='lampiran6'){
                return view('pengajar.spt.1771.lampiran6',[
                    'spt' => $spt,
                    'induk' => $induk,
                ]);
            }elseif($request->type=='lampiran5'){
                return view('pengajar.spt.1771.lampiran5',[
                    'spt' => $spt,
                    'induk' => $induk,
                ]);
            }elseif($request->type=='lampiran4'){
                $lampiran4a = Spt1771lampiran4a::where([['spt_id', $id]])->first();
                $lampiran4b = Spt1771lampiran4b::where([['spt_id', $id]])->first();
                $pph = Spt1771lampiran4alain::where('spt_id', $id)->sum('terutang');
                $penghasilan = Spt1771lampiran4blain::where('spt_id', $id)->sum('penghasilan');
                return view('pengajar.spt.1771.lampiran4',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran4a' => $lampiran4a,
                    'lampiran4b' => $lampiran4b,
                    'pph' => $pph,
                    'penghasilan' => $penghasilan,
                ]);
            }elseif($request->type=='lampiran3'){
                return view('pengajar.spt.1771.lampiran3',[
                    'spt' => $spt,
                    'induk' => $induk,
                ]);
            }elseif($request->type=='lampiran2'){
                $lampiran2 = Spt1771lampiran2::where([['spt_id', $id]])->first();
                return view('pengajar.spt.1771.lampiran2',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran2' => $lampiran2,
                ]);
            }elseif($request->type=='lampiran1'){
                $lampiran1 = Spt1771lampiran1::where([['spt_id', $id]])->first();
                $lampiran2 = Spt1771lampiran2::where([['spt_id', $id]])->first();
                $penyusutan = Spt1771lampkhus1::where([['jenis_fiskal', 'penyusutan'], ['spt_id', $id]])->first();
                $amortisasi = Spt1771lampkhus1::where([['jenis_fiskal', 'amortisasi'], ['spt_id', $id]])->first();
                return view('pengajar.spt.1771.lampiran1',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran1' => $lampiran1,
                    'lampiran2' => $lampiran2,
                    'penyusutan' => $penyusutan,
                    'amortisasi' => $amortisasi,
                ]);
            }elseif($request->type=='lanjutan'){
                $lampiran4a = Spt1771lampiran4a::where([['spt_id', $id]])->first();
                $lampiran4b = Spt1771lampiran4b::where([['spt_id', $id]])->first();
                $lampkhus2a = Spt1771lampkhus2a::where([['spt_id', $id]])->first();
                return view('pengajar.spt.1771.induk_lanjutan',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran4a' => $lampiran4a,
                    'lampiran4b' => $lampiran4b,
                    'lampkhus2a' => $lampkhus2a,
                ]);
            }else{
                $lampiran1 = Spt1771lampiran1::where([['spt_id', $id]])->first();
                $pph_potput = Spt1771lampiran3a::where('spt_id', $id)->sum('pph');
                $lampkhus2a = Spt1771lampkhus2a::where([['spt_id', $id]])->first();
                return view('pengajar.spt.1771.induk',[
                    'spt' => $spt,
                    'induk' => $induk,
                    'lampiran1' => $lampiran1,
                    'pph_potput' => $pph_potput,
                    'lampkhus2a' => $lampkhus2a,
                ]);
            }
        }else{
            $request->session()->flash('alert-danger', 'Eform Tidak Ditemukan');
            return redirect()->back();
        }
    }

    public function hitungTerutang($id){
        $lamp = Spt1771lampiran4a::findOrFail($id);
        $pph = Spt1771lampiran4alain::where('spt_id', $lamp->spt_id)->sum('terutang');
        $deposito = ($lamp->pjk_deposito*$lamp->ph_deposito)/100;
        $obligasi = ($lamp->pjk_obligasi*$lamp->ph_obligasi)/100;
        $bursa = ($lamp->pjk_bursa*$lamp->ph_bursa)/100;
        $ventura = ($lamp->pjk_ventura*$lamp->ph_ventura)/100;
        $bbm = ($lamp->pjk_bbm*$lamp->ph_bbm)/100;
        $pengalihan = ($lamp->pjk_pengalihan*$lamp->ph_pengalihan)/100;
        $persewaan = ($lamp->pjk_persewaan*$lamp->ph_persewaan)/100;
        $pelaksana = ($lamp->pjk_pelaksana*$lamp->ph_pelaksana)/100;
        $perencana = ($lamp->pjk_perencana*$lamp->ph_perencana)/100;
        $pengawas = ($lamp->pjk_pengawas*$lamp->ph_pengawas)/100;
        $dagang_asing = ($lamp->pjk_dagang_asing*$lamp->ph_dagang_asing)/100;
        $pelayaran_asing = ($lamp->pjk_pelayaran_asing*$lamp->ph_pelayaran_asing)/100;
        $pelayaran = ($lamp->pjk_pelayaran*$lamp->ph_pelayaran)/100;
        $aktiva = ($lamp->pjk_aktiva*$lamp->ph_aktiva)/100;
        $derivatif = ($lamp->pjk_derivatif*$lamp->ph_derivatif)/100;
        $terutang = $deposito+$obligasi+$bursa+$ventura+$bbm+$pengalihan+$persewaan+$pelaksana+$perencana+$pengawas+$dagang_asing+$pelayaran_asing+$pelayaran+$aktiva+$derivatif;
        $lamp->terutang = $terutang;
        $lamp->total = $terutang+$pph;
        $lamp->save();

        return $lamp;
    }

    public function hitungLamp2($id){
        $lamp = Spt1771lampiran2::findOrFail($id);
        $lamp->jumlah_barang = $lamp->hpp_barang+$lamp->bul_barang+$lamp->bdlu_barang;
        $lamp->jumlah_gaji = $lamp->hpp_gaji+$lamp->bul_gaji+$lamp->bdlu_gaji;
        $lamp->jumlah_transportasi = $lamp->hpp_transportasi+$lamp->bul_transportasi+$lamp->bdlu_transportasi;
        $lamp->jumlah_penyusutan = $lamp->hpp_penyusutan+$lamp->bul_penyusutan+$lamp->bdlu_penyusutan;
        $lamp->jumlah_sewa = $lamp->hpp_sewa+$lamp->bul_sewa+$lamp->bdlu_sewa;
        $lamp->jumlah_bunga = $lamp->hpp_bunga+$lamp->bul_bunga+$lamp->bdlu_bunga;
        $lamp->jumlah_jasa = $lamp->hpp_jasa+$lamp->bul_jasa+$lamp->bdlu_jasa;
        $lamp->jumlah_piutang = $lamp->hpp_piutang+$lamp->bul_piutang+$lamp->bdlu_piutang;
        $lamp->jumlah_royalti = $lamp->hpp_royalti+$lamp->bul_royalti+$lamp->bdlu_royalti;
        $lamp->jumlah_pemasaran = $lamp->hpp_pemasaran+$lamp->bul_pemasaran+$lamp->bdlu_pemasaran;
        $lamp->jumlah_lainnya = $lamp->hpp_lainnya+$lamp->bul_lainnya+$lamp->bdlu_lainnya;
        $lamp->jumlah_awal = $lamp->hpp_awal+$lamp->bul_awal+$lamp->bdlu_awal;
        $lamp->jumlah_akhir = $lamp->hpp_akhir+$lamp->bul_akhir+$lamp->bdlu_akhir;
        $lamp->jumlah_hpp = $lamp->hpp_barang+$lamp->hpp_gaji+$lamp->hpp_transportasi+$lamp->hpp_penyusutan+$lamp->hpp_sewa+$lamp->hpp_bunga+$lamp->hpp_jasa+$lamp->hpp_piutang+$lamp->hpp_royalti+$lamp->hpp_pemasaran+$lamp->hpp_lainnya+$lamp->hpp_awal-$lamp->hpp_akhir;
        $lamp->jumlah_bul = $lamp->bul_barang+$lamp->bul_gaji+$lamp->bul_transportasi+$lamp->bul_penyusutan+$lamp->bul_sewa+$lamp->bul_bunga+$lamp->bul_jasa+$lamp->bul_piutang+$lamp->bul_royalti+$lamp->bul_pemasaran+$lamp->bul_lainnya+$lamp->bul_awal-$lamp->bul_akhir;
        $lamp->jumlah_bdlu = $lamp->bdlu_barang+$lamp->bdlu_gaji+$lamp->bdlu_transportasi+$lamp->bdlu_penyusutan+$lamp->bdlu_sewa+$lamp->bdlu_bunga+$lamp->bdlu_jasa+$lamp->bdlu_piutang+$lamp->bdlu_royalti+$lamp->bdlu_pemasaran+$lamp->bdlu_lainnya+$lamp->bdlu_awal-$lamp->bdlu_akhir;
        $lamp->save();
        $lamp->total = $lamp->jumlah_barang+$lamp->jumlah_gaji+$lamp->jumlah_transportasi+$lamp->jumlah_penyusutan+$lamp->jumlah_sewa+$lamp->jumlah_bunga+$lamp->jumlah_jasa+$lamp->jumlah_piutang+$lamp->jumlah_royalti+$lamp->jumlah_pemasaran+$lamp->jumlah_lainnya+$lamp->jumlah_awal-$lamp->jumlah_akhir;
        $lamp->save();
        return $lamp;
    }

    public function hitungPphTerutang($komersial, $total, $tarif){
        if($komersial<=4800000000){
            $pph = $total*11/100;
        }elseif($komersial<=50000000000 && $komersial>4800000000){
            $fasilitas = (4800000000/$komersial)*$total;
            $non = $total-$fasilitas;
            $pph_fasilitas = $fasilitas*11/100;
            $pph_non = $non*22/100;
            $pph = $pph_fasilitas+$pph_non;
        }else{
            if($tarif!='pasal 17 ayat 2b'){
                $pph = $total*22/100;
            }else{
                $pph = $total*19/100;
            }
        }
        return $pph;
    }
}