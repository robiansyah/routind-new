<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personalia;
use App\Models\Income;
use App\Models\Country;
use App\Models\TaxObject;
use App\Models\BupotFinal;
use App\Models\BupotBill;
use App\Models\BupotDeposit;
use App\Models\Spt;
use App\Models\PphDoc;
use App\Models\PphFinal;
use App\Models\PphIncome;
use App\Models\User;
use App\Models\Rate;
use App\Models\ClassStudent;
use App\Notifications\EmailNotification;

use DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PersonaliaImport;
use App\Exports\IncomeExport;
use Carbon\Carbon;

class PPh21Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified','spt']);
    }

    public function personalia(){
        $personalia = Personalia::where('user_id', auth()->user()->id)->get();
        return view('user.pph21.personalia', [
            'data' => $personalia,
        ]);
    }

    public function storePersonalia(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'ptkp' => 'required',
            'position' => 'required',
            'start_date' => 'required',
        ]);

        Personalia::updateOrCreate([
            'id' => $request->id
        ],
            [
                'user_id' => auth()->user()->id,
                'name' => $request->name,
                'npwp' => $request->npwp,
                'gender' => $request->gender,
                'address' => $request->address,
                'ptkp' => $request->ptkp,
                'position' => $request->position,
                'start_date' => $request->start_date,
            ]);


        $request->session()->flash('alert-success', 'Personalia Berhasil Disimpan');
        return redirect()->back();
    }

    public function editPersonalia(Request $request, $id){
        $personalia = Personalia::findOrFail($id);
        return response()->json($personalia);
    }

    public function destroyPersonalia(Request $request, $id){
        Personalia::findOrFail($id)->delete();
        Income::where('personalia_id', $id)->delete();
        $request->session()->flash('alert-success', 'Personalia Berhasil Dihapus');
        return redirect()->back();
    }

    public function statusPersonalia(Request $request, $id, $status){
        if($status=='cancel'){
            $personalia = Personalia::findOrFail($id);
            $personalia->status = $request->status;
            $personalia->end_date = $request->end_date;
            $personalia->save();
            $request->session()->flash('alert-success', 'Status Pegawai Berhasil Diubah');
            return redirect()->back();
        }

    }

    public function importPersonalia(Request $request)
    {
        $this->validate($request, [
            'file'  => 'required|mimes:xls,xlsx'
        ]);
        Excel::import(new PersonaliaImport(auth()->user()->id), $request->file('file')->store('temp'));
        $request->session()->flash('alert-info', 'Personalia berhasil diimpor');
        return redirect()->back();
    }

    public function income(Request $request){
        $period = (!empty($request->period)) ? $request->period : '01';
        $year = (!empty($request->year)) ? $request->year : date('Y');

        $data = Income::with('personalia')->where('user_id', auth()->user()->id)->whereNull('nik');
        if($period!='all'){
            $data->where('period', $period);
        }
        if($year!='all'){
            $data->where('year', $year);
        }
        $result = $data->get();
        return view('user.pph21.income', [
            'data' => $result,
            'period' => $period,
            'year' => $year,
        ]);
    }

    public function createIncome(Request $request, $period, $year){
        $start = date($year.'-'.$period.'-20');
        $end = date($year.'-'.$period.'-t');
        $min = date("m-Y", strtotime($start." -1 months"));
        $active = Personalia::where([['user_id', auth()->user()->id], ['start_date', '<=', $start]])->whereNull('end_date')->get();
        $non = Personalia::where([['user_id', auth()->user()->id], ['start_date', '<=', $start], ['end_date', '>=', $end]])->get();
        $pensiun = Personalia::where([['user_id', auth()->user()->id], ['end_date', '<=', $start], ['status', 'Pensiun']])->get();
        foreach($active as $item){
            $before = Income::where([['period', substr($min, 0, 2)], ['year', substr($min, -4)], ['personalia_id', $item->id]])->first();
            $income = Income::where([['period', $period], ['year', $year], ['personalia_id', $item->id]])->first();
            if(!$income && !$before){
                Income::create([
                    'user_id' => auth()->user()->id,
                    'personalia_id' => $item->id,
                    'npwp' => ($item->npwp!='') ? '1' : '0',
                    'period' => $period,
                    'year' => $year,
                    'status' => 'Pegawai Tetap',
                    'ptkp_code' => $item->ptkp,
                    'ptkp' => $this->itungPtkp($item->ptkp),
                    'no' => IdGenerator::generate(['table' => 'incomes','field'=>'no', 'length' => 15, 'reset_on_prefix_change'  => true, 'prefix' => date($period.'.y-')]),
                ]);
            }elseif(!$income && $before){
                $new = $before->replicate();
                $new->zakat = 0;
                $new->other = 0;
                $new->honorarium = 0;
                $new->natura = 0;
                $new->thr = 0;
                $new->period = $period;
                $new->year = $year;
                $new->no = IdGenerator::generate(['table' => 'incomes','field'=>'no', 'length' => 15, 'reset_on_prefix_change'  => true, 'prefix' => date($period.'.y-')]);
                if($period==12){
                    $all = Income::where([['year', $before->year],['period','<',12],['personalia_id',$before->personalia_id]])->groupBy('period')->get();
                    $bruto_year = $before->salary+$before->pph+$before->premi; $pension_year = $new->pension; $zakat_year = 0; $terutang_year = 0;
                    foreach ($all as $key){
                        $bruto_year += $key->bruto;
                        $pension_year += $key->pension;
                        $zakat_year += $key->zakat;
                        $terutang_year += $key->terutang;
                    }
                    $position_year = ($bruto_year*0.05>=6000000) ? 6000000 : $bruto_year*0.05;
                    $neto = $bruto_year-$position_year-$pension_year-$zakat_year;
                    $pkp = ($neto-$before->ptkp > 0) ? $neto-$before->ptkp : 0;
                    $pph21 = $this->itungPph($pkp, 100);
                    $terutang = $pph21-$terutang_year;
                    $new->pph21 = $pph21;
                    $new->terutang = $terutang;
                }else{
                    $bruto = $before->salary+$before->pph+$before->premi;
                    $pph21 = 0;
                    if($bruto > 0){
                        $rate = Rate::where([['start', '<', $bruto], ['end', '>=', $bruto], ['category', ($before->ptkp < 63000000) ? 'A' : (($before->ptkp <72000000) ? 'B' : 'C')]])->first();
                        $terutang = $bruto * $rate->rates / 100;
                        $rates = $rate->rates;
                    }else{
                        $terutang = 0;
                        $rates = 0;
                    }
                    $new->bruto = $bruto;
                    $new->pph21 = $pph21;
                    $new->terutang = $terutang;
                    $new->rates = $rates;
                }
                $new->save();
            }
        }

        foreach($non as $item){
            $before = Income::where([['period', substr($min, 0, 2)], ['year', substr($min, -4)], ['personalia_id', $item->id]])->first();
            $income = Income::where([['period', $period], ['year', $year], ['personalia_id', $item->id]])->first();
            if(!$income && !$before){
                Income::create([
                    'user_id' => auth()->user()->id,
                    'personalia_id' => $item->id,
                    'npwp' => ($item->npwp!='') ? '1' : '0',
                    'period' => $period,
                    'year' => $year,
                    'status' => 'Pegawai Tetap',
                    'ptkp_code' => $item->ptkp,
                    'ptkp' => $this->itungPtkp($item->ptkp),
                    'no' => IdGenerator::generate(['table' => 'incomes','field'=>'no', 'length' => 15, 'reset_on_prefix_change'  => true, 'prefix' => date($period.'.y-')]),
                ]);
            }elseif(!$income && $before){
                $new = $before->replicate();
                $new->zakat = 0;
                $new->other = 0;
                $new->honorarium = 0;
                $new->natura = 0;
                $new->thr = 0;
                $new->period = $period;
                $new->year = $year;
                $new->no = IdGenerator::generate(['table' => 'incomes','field'=>'no', 'length' => 15, 'reset_on_prefix_change'  => true, 'prefix' => date($period.'.y-')]);
                if($period==12){
                    $all = Income::where([['year', $before->year],['period','<',12],['personalia_id',$before->personalia_id]])->groupBy('period')->get();
                    $bruto_year = $before->salary+$before->pph+$before->premi; $pension_year = $new->pension; $zakat_year = 0; $terutang_year = 0;
                    foreach ($all as $key){
                        $bruto_year += $key->bruto;
                        $pension_year += $key->pension;
                        $zakat_year += $key->zakat;
                        $terutang_year += $key->terutang;
                    }
                    $position_year = ($bruto_year*0.05>=6000000) ? 6000000 : $bruto_year*0.05;
                    $neto = $bruto_year-$position_year-$pension_year-$zakat_year;
                    $pkp = ($neto-$before->ptkp > 0) ? $neto-$before->ptkp : 0;
                    $pph21 = $this->itungPph($pkp, 100);
                    $terutang = $pph21-$terutang_year;
                    $new->pph21 = $pph21;
                    $new->terutang = $terutang;
                }else{
                    $bruto = $before->salary+$before->pph+$before->premi;
                    $pph21 = 0;
                    if($bruto > 0){
                        $rate = Rate::where([['start', '<', $bruto], ['end', '>=', $bruto], ['category', ($before->ptkp < 63000000) ? 'A' : (($before->ptkp <72000000) ? 'B' : 'C')]])->first();
                        $terutang = $bruto * $rate->rates / 100;
                        $rates = $rate->rates;
                    }else{
                        $terutang = 0;
                        $rates = 0;
                    }
                    $new->bruto = $bruto;
                    $new->pph21 = $pph21;
                    $new->terutang = $terutang;
                    $new->rates = $rates;
                }
                $new->save();
            }
        }

        foreach($pensiun as $item){
            $before = Income::where([['period', substr($min, 0, 2)], ['year', substr($min, -4)], ['personalia_id', $item->id]])->first();
            $income = Income::where([['period', $period], ['year', $year], ['personalia_id', $item->id]])->first();
            if(!$income && !$before){
                Income::create([
                    'user_id' => auth()->user()->id,
                    'personalia_id' => $item->id,
                    'npwp' => ($item->npwp!='') ? '1' : '0',
                    'period' => $period,
                    'year' => $year,
                    'status' => 'Pensiun',
                    'ptkp_code' => $item->ptkp,
                    'ptkp' => $this->itungPtkp($item->ptkp),
                    'no' => IdGenerator::generate(['table' => 'incomes','field'=>'no', 'length' => 15, 'reset_on_prefix_change'  => true, 'prefix' => date($period.'.y-')]),
                ]);
            }elseif(!$income && $before){
                $new = $before->replicate();
                $new->zakat = 0;
                $new->other = 0;
                $new->honorarium = 0;
                $new->natura = 0;
                $new->thr = 0;
                $new->period = $period;
                $new->year = $year;
                $new->status = 'Pensiun';
                $new->no = IdGenerator::generate(['table' => 'incomes','field'=>'no', 'length' => 15, 'reset_on_prefix_change'  => true, 'prefix' => date($period.'.y-')]);
                if($period==12){
                    $all = Income::where([['year', $before->year],['period','<',12],['personalia_id',$before->personalia_id]])->groupBy('period')->get();
                    $bruto_year = $before->salary+$before->pph+$before->premi; $pension_year = $new->pension; $zakat_year = 0; $terutang_year = 0;
                    foreach ($all as $key){
                        $bruto_year += $key->bruto;
                        $pension_year += $key->pension;
                        $zakat_year += $key->zakat;
                        $terutang_year += $key->terutang;
                    }
                    $position_year = ($bruto_year*0.05>=6000000) ? 6000000 : $bruto_year*0.05;
                    $neto = $bruto_year-$position_year-$pension_year-$zakat_year;
                    $pkp = ($neto-$before->ptkp > 0) ? $neto-$before->ptkp : 0;
                    $pph21 = $this->itungPph($pkp, 100);
                    $terutang = $pph21-$terutang_year;
                    $new->pph21 = $pph21;
                    $new->terutang = $terutang;
                }else{
                    $bruto = $before->salary+$before->pph+$before->premi;
                    $pph21 = 0;
                    if($bruto > 0){
                        $rate = Rate::where([['start', '<', $bruto], ['end', '>=', $bruto], ['category', ($before->ptkp < 63000000) ? 'A' : (($before->ptkp <72000000) ? 'B' : 'C')]])->first();
                        $terutang = $bruto * $rate->rates / 100;
                        $rates = $rate->rates;
                    }else{
                        $terutang = 0;
                        $rates = 0;
                    }
                    $new->bruto = $bruto;
                    $new->pph21 = $pph21;
                    $new->terutang = $terutang;
                    $new->rates = $rates;
                }
                $new->save();
            }
        }

        $request->session()->flash('alert-success', 'Gaji Berhasil Ditambahkan');
        return redirect()->back();
    }

    public function editIncome(Request $request, $id){
        $income = Income::findOrFail($id);
        if($income->user_id==auth()->user()->id){
            return response()->json($income);
        }else{
            abort(401, 'This action is unauthorized.');
        }

    }

    public function storeIncome(Request $request){
        $this->validate($request,[
            'salary' => 'required',
            'pph' => 'required',
            'other' => 'required',
            'honorarium' => 'required',
            'premi' => 'required',
            'natura' => 'required',
            'thr' => 'required',
            'bruto' => 'required',
            'pension' => 'required',
            'zakat' => 'required',
        ]);
        $income = Income::findOrFail($request->id);
        if($income->year<2024){
            $thr = str_replace(".","",$request->thr);
            $bruto = str_replace(".","",$request->bruto);
            $zakat = str_replace(".","",$request->zakat);
            $bruto_year = ($bruto-$thr)*12;
            $position_year = ($bruto_year*0.05>=6000000) ? 6000000 : $bruto_year*0.05;
            $pension = str_replace(".","",$request->pension);
            $pension_year = $pension*12;
            $neto = $bruto_year-$position_year-$pension_year-$zakat;
            $pkp = ($neto-$income->ptkp > 0) ? $neto-$income->ptkp : 0;
            $pph21 = ($income->npwp==1) ? $this->itungPph($pkp, 100) : $this->itungPph($pkp, 120);
            $terutang = $pph21/12;

            if($thr>0){
                $bruto_thr = $bruto_year+$thr;
                $position_thr = ($bruto_thr*0.05>=6000000) ? 6000000 : $bruto_thr*0.05;
                $neto_thr = $bruto_thr-$position_thr-$pension_year;
                $pkp_thr = ($neto_thr-$income->ptkp > 0) ? $neto_thr-$income->ptkp : 0;
                $pph21_thr = ($income->npwp==1) ? $this->itungPph($pkp_thr, 100) : $this->itungPph($pkp_thr, 120);
                $pph_bonus = $pph21_thr-$pph21;
                $terutang += $pph_bonus;
            }

            $income->update([
                'salary' => str_replace(".","",$request->salary),
                'pph' => str_replace(".","",$request->pph),
                'other' => str_replace(".","",$request->other),
                'honorarium' => str_replace(".","",$request->honorarium),
                'premi' => str_replace(".","",$request->premi),
                'natuna' => str_replace(".","",$request->natuna),
                'thr' => $thr,
                'bruto' => $bruto,
                'pension' => $pension,
                'pkp' => ($thr>0) ? $pkp_thr : $pkp,
                'pph21' => $pph21,
                'terutang' => $terutang,
                'zakat' => $zakat
            ]);
        }else{
            if($income->period<12){
                $bruto = str_replace(".","",$request->bruto);
                $pph21 = 0;
                if($bruto > 0){
                    $rate = Rate::where([['start', '<', $bruto], ['end', '>=', $bruto], ['category', ($income->ptkp < 63000000) ? 'A' : (($income->ptkp <72000000) ? 'B' : 'C')]])->first();
                    $terutang = $bruto * $rate->rates / 100;
                    $rates = $rate->rates;
                }else{
                    $terutang = 0;
                    $rates = 0;
                }
            }else{
                $before = Income::where([['year', $income->year],['period','<',12],['personalia_id',$income->personalia_id]])->get();
                $bruto_year = str_replace(".","",$request->bruto);
                $pension_year = str_replace(".","",$request->pension);
                $zakat_year = str_replace(".","",$request->zakat);
                $terutang_year = 0;
                foreach ($before as $key){
                    $bruto_year += $key->bruto;
                    $pension_year += $key->pension;
                    $zakat_year += $key->zakat;
                    $terutang_year += $key->terutang;
                }
                $position_year = ($bruto_year*0.05>=6000000) ? 6000000 : $bruto_year*0.05;
                $neto = $bruto_year-$position_year-$pension_year-$zakat_year;
                $pkp = ($neto-$income->ptkp > 0) ? $neto-$income->ptkp : 0;
                $pph21 = $this->itungPph($pkp, 100);
                $terutang = $pph21-$terutang_year;
                $rates = 0;
            }

            $income->update([
                'salary' => str_replace(".","",$request->salary),
                'pph' => str_replace(".","",$request->pph),
                'other' => str_replace(".","",$request->other),
                'honorarium' => str_replace(".","",$request->honorarium),
                'premi' => str_replace(".","",$request->premi),
                'natuna' => str_replace(".","",$request->natuna),
                'thr' => str_replace(".","",$request->thr),
                'bruto' => str_replace(".","",$request->bruto),
                'pension' => str_replace(".","",$request->pension),
                'pkp' => 0,
                'pph21' => $pph21,
                'terutang' => $terutang,
                'zakat' => str_replace(".","",$request->zakat),
                'rates' => $rates,
                'no' => ($income->no!=null) ? $income->no : IdGenerator::generate(['table' => 'incomes','field'=>'no', 'length' => 15, 'reset_on_prefix_change'  => true, 'prefix' => date($income->period.'.y-')]),
            ]);
        }
        $request->session()->flash('alert-success', 'Gaji Berhasil Diubah');
        return redirect()->back();
    }

    public function destroyIncome(Request $request, $id){
        $income = Income::findOrFail($id);
        if($income->user_id==auth()->user()->id){
            $income->delete();
            $request->session()->flash('alert-success', 'Gaji Berhasil Dihapus');
            return redirect()->back();
        }else{
            abort(401, 'This action is unauthorized.');
        }
    }

    public function exportIncome(Request $request, $id)
    {
        $income = Income::findOrFail($id);
        $data = Income::where([['personalia_id', $income->personalia_id], ['year', $income->year], ['user_id', auth()->user()->id]])->orderBy('period', 'asc')->get();
        return Excel::download(new IncomeExport($data), 'gaji — '.Carbon::now().'.xlsx');
//        $request->session()->flash('alert-success', 'Gaji Berhasil Didownload');
//        return redirect()->back();

    }

    public function bupot(Request $request, $type){
        $period = (!empty($request->period)) ? $request->period : '01';
        $year = (!empty($request->year)) ? $request->year : date('Y');
        $countries = Country::all();
        if($type=='tidak_final'){
            $data = BupotFinal::where([['user_id', auth()->user()->id], ['type', $type]]);
            $objects = TaxObject::where('kdBupot', '5')->orderBy('kdObjPjk')->get();
        }elseif($type=='final'){
            $objects = TaxObject::where('kdBupot', '6')->get();
            $data = BupotFinal::where([['user_id', auth()->user()->id], ['type', $type]]);
        }elseif($type=='selain_pegawai'){
            $data = BupotFinal::where([['user_id', auth()->user()->id]])->whereIn('type', array('final', 'tidak_final'));
            $objects = TaxObject::whereIn('kdBupot', array('5', '6'))->orderBy('kdObjPjk')->get();
        }elseif($type=='pegawai'){
            $data = Income::where([['user_id', auth()->user()->id]])->whereNotNull('nik')->whereNull('type');
            $objects = TaxObject::where('kdBupot', '4')->orderBy('kdObjPjk')->get();
        }elseif($type=='a1'){
            $data = Income::where([['user_id', auth()->user()->id], ['type', 'year']]);
            $objects = TaxObject::where('kdBupot', '4')->orderBy('kdObjPjk')->get();
            $year = (!empty($request->year)) ? $request->year : 'all';
        }

        if($period!='all' && $type!='a1'){
            $data->where('period', $period);
        }
        if($year!='all'){
            $data->where('year', $year);
        }
        $result = $data->get();
        return view('user.pph21.bupot_'.$type, [
            'data' => $result,
            'period' => $period,
            'year' => $year,
            'objects' => $objects,
            'countries' => $countries,
        ]);
    }

    public function storeBupot(Request $request, $type){
        $this->validate($request,[
            'period' => 'required',
            'year' => 'required',
            'name' => 'required',
            'address' => 'required',
            'object_code' => 'required',
            'bruto' => 'required',
            'dpp' => 'required',
            'tarif' => 'required',
            'pph' => 'required',
            'date' => 'required',
        ]);

        if($type=='pegawai'){
            $no = !empty($request->no) ? $request->no : IdGenerator::generate(['table' => 'incomes','field'=>'no', 'length' => 15, 'reset_on_prefix_change'  => true, 'prefix' => date('m.y-')]);
            Income::updateOrCreate([
                'id' => $request->id
            ],
                [
                    'user_id' => auth()->user()->id,
                    'period' => $request->period,
                    'end_period' => $request->period,
                    'year' => $request->year,
                    'no' => $no,
                    'name' => $request->name,
                    'nik' => $request->npwp,
                    'address' => $request->address,
                    'position' => $request->position,
                    'bruto' => str_replace(".","",$request->bruto),
                    'rates' => str_replace(".","",$request->tarif),
                    'terutang' => str_replace(".","",$request->pph),
                    'date' => $request->date,
                    'ptkp_code' => $request->ptkp,
                    'ptkp' => $this->itungPtkp($request->ptkp),
                    'status' => ($request->object_code=='21-100-01') ? 'Pegawai Tetap' : 'Pensiun',
                ]);
        }else{
            $cek = TaxObject::where('kdObjPjk', $request->object_code)->first();
            $no = !empty($request->no) ? $request->no : IdGenerator::generate(['table' => 'bupot_final','field'=>'no', 'length' => 15, 'reset_on_prefix_change'  => true, 'prefix' => date('m.y-')]);
            BupotFinal::updateOrCreate([
                'id' => $request->id
            ],
                [
                    'user_id' => auth()->user()->id,
                    'period' => $request->period,
                    'year' => $request->year,
                    'no' => $no,
                    'type' => ($cek->kdBupot=='5') ? 'tidak_final' : 'final',
                    'name' => $request->name,
                    'npwp' => $request->npwp,
                    'nik' => $request->nik,
                    'address' => $request->address,
                    'country_code' => $request->country_code,
                    'object_code' => $request->object_code,
                    'bruto' => str_replace(".","",$request->bruto),
                    'dpp' => str_replace(".","",$request->dpp),
                    'tarif' => str_replace(".","",$request->tarif),
                    'pph' => str_replace(".","",$request->pph),
                    'date' => $request->date,
                    'ptkp_code' => ($cek->kdBupot=='5') ? $request->ptkp : null,
                    'ptkp' => ($cek->kdBupot=='5') ? $this->itungPtkp($request->ptkp) : null,
                ]);
        }

        $request->session()->flash('alert-success', 'Bukti Potong Berhasil Disimpan');
        return redirect()->route('pph21.bupot', ['type'=>$type, 'period'=>$request->period, 'year'=>$request->year]);
    }

    public function editBupot(Request $request, $type, $id){
        $bupot = ($type=='pegawai') ? Income::findOrFail($id) : BupotFinal::findOrFail($id);
        return response()->json($bupot);
    }

    public function destroyBupot(Request $request, $type, $id){
        ($type=='pegawai') ? Income::findOrFail($id)->delete() : BupotFinal::findOrFail($id)->delete();
        $request->session()->flash('alert-success', 'Bukti Potong Berhasil Dihapus');
        return redirect()->back();
    }

    public function a1Form(Request $request, $id=null)
    {
        $objects = TaxObject::where('kdBupot', '4')->orderBy('kdObjPjk')->get();
        return view('user.pph21.bupot_a1_form', [
            'objects' => $objects,
            'id' => $id
        ]);
    }

    public function a1Store(Request $request)
    {
        $this->validate($request,[
            'period' => 'required',
            'year' => 'required',
            'nik' => 'required',
            'name' => 'required',
            'address' => 'required',
            'object_code' => 'required',
            'ptkp_code' => 'required',
            'bruto' => 'required',
            'salary' => 'required',
            'pph' => 'required',
        ]);

        if($request->year != $request->end_year){
            $request->session()->flash('alert-error', 'Tahun Harus Sama');
            return redirect()->back();
        }

        $no = !empty($request->no) ? $request->no : IdGenerator::generate(['table' => 'incomes','field'=>'no', 'length' => 15, 'reset_on_prefix_change'  => true, 'prefix' => date('m.y-')]);
        Income::updateOrCreate([
            'id' => $request->id
        ],
            [
                'user_id' => auth()->user()->id,
                'period' => $request->period,
                'year' => $request->year,
                'end_period' => $request->end_period,
                'end_year' => $request->end_year,
                'no' => $no,
                'name' => $request->name,
                'nik' => $request->nik,
                'address' => $request->address,
                'position' => $request->position,
                'ptkp_code' => $request->ptkp_code,
                'ptkp' => str_replace(".","",$request->ptkp),
                'bruto' => str_replace(".","",$request->bruto),
                'salary' => str_replace(".","",$request->salary),
                'pph' => str_replace(".","",$request->pph),
                'other' => str_replace(".","",$request->other),
                'honorarium' => str_replace(".","",$request->honorarium),
                'premi' => str_replace(".","",$request->premi),
                'natura' => str_replace(".","",$request->natura),
                'thr' => str_replace(".","",$request->thr),
                'position_fee' => str_replace(".","",$request->position_fee),
                'pensiom' => str_replace(".","",$request->pensiom),
                'zakat' => str_replace(".","",$request->zakat),
                'terutang' => str_replace(".","",$request->terutang),
                'previous' => str_replace(".","",$request->previous),
                'pkp' => str_replace(".","",$request->pkp),
                'pph21' => str_replace(".","",$request->pph21),
                'type' => 'year',
                'status' => ($request->object_code=='21-100-01') ? 'Pegawai Tetap' : 'Pensiun',
            ]);

        $request->session()->flash('alert-success', 'Bukti Potong A1 Berhasil Diproses');
        return redirect()->route('pph21.bupot', ['type'=>'a1']);
    }

    public function cetakBupot($id, $year)
    {
        $income = Income::findOrFail($id);
//        dd($incomes);

        $salary = $income->salary;
        $pph = $income->pph;
        $other = $income->other;
        $honorarium = $income->honorarium;
        $premi = $income->premi;
        $natura = $income->natura;
        $thr = $income->thr;
        $bruto = $income->bruto;
        $pension = $income->pension;
        $previous = $income->previous;
        $ptkp = $income->ptkp;
        $ptkp_code = $income->ptkp_code;
        $pkp = $income->pkp;
        $pph21 = $income->pph21;
        $terutang = $income->terutang;

        $pdf = Pdf::loadview('print.bupot_a1', [
            'data' => $income,
            'year' => $year,
            'salary' => $salary,
            'pph' => $pph,
            'other' => $other,
            'honorarium' => $honorarium,
            'premi' => $premi,
            'natura' => $natura,
            'thr' => $thr,
            'bruto' => $bruto,
            'pension' => $pension,
            'previous' => $previous,
            'ptkp' => $ptkp,
            'ptkp_code' => $ptkp_code,
            'pkp' => $pkp,
            'pph21' => $pph21,
            'terutang' => $terutang,

        ]);
        return $pdf->download('bupot_a1.pdf');
        // return view('print.faktur', [
        //     'data'=>$data,
        // ]);
    }

    public function cetakFinal($id)
    {
        $bupot = BupotFinal::findOrFail($id);
        $pdf = Pdf::loadview('print.bupot_'.$bupot->type, [
            'bupot' => $bupot,

        ]);
        return $pdf->download('bupot_'.$bupot->type.'.pdf');
    }

    public function cetakTer($id)
    {
        $ter = Income::findOrFail($id);
        $pdf = Pdf::loadview('print.bupot_ter', [
            'ter' => $ter,
        ]);
        return $pdf->download('bupot_ter.pdf');
    }

    public function spt(Request $request){
        $year = (!empty($request->year)) ? $request->year : date('Y');
        $spt = Spt::with('question')->where([['user_id', auth()->user()->id], ['form_code', 'PPH21'], ['year', $year]])->orderBy('start_period', 'desc')->get();
        $class_student = ClassStudent::with('kelas')->where('student_id', auth()->user()->id)->first();
        return view('user.pph21.spt',[
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

        $spt = Spt::where([['user_id', auth()->user()->id], ['send_flag', '<>', 2], ['form_code', 'PPH21'],
            ['start_period', $request->period], ['year', $request->year], ['correction_to', $request->correction_to]
        ])->first();
        if($spt){
            $request->session()->flash('alert-error', 'SPT Masa '.$request->period.' '.$request->year.' Pembetulan Ke '.$request->correction_to.' Sudah Pernah Diposting');
            return redirect()->back();
        }

        //cek gaji
        $income = Income::where([['user_id', auth()->user()->id], ['period', $request->period], ['year', $request->year]])->get();
        if(count($income)==0){
            $request->session()->flash('alert-error', 'Gaji Periode '.$request->period.' '.$request->year.' Belum Ada, Silakan Buat Gaji Terlebih Dahulu');
            return redirect()->back();
        }

        //cek seluruh gaji dari periode awal samapai akhir
        if($request->period=='12'){
            $max = 12;
            $personalia = Personalia::where('user_id', auth()->user()->id)->orderBy('start_date', 'asc')->first();
            if($personalia){
                if(substr($personalia->start_date, 0, 4) == $request->year){
                    $month = substr($personalia->start_date, 5, 2);
                    $max = 13 - $month;
                }
            }
            $income_count = Income::where([['user_id', auth()->user()->id], ['year', $request->year]])->distinct()->count('period');
            if($income_count < $max){
                $request->session()->flash('alert-error', 'Gaji Periode '.$request->year.' Belum Lengkap, Silakan Lengkapi Gaji Terlebih Dahulu');
                return redirect()->back();
            }
        }

        DB::beginTransaction();
        try{
            $spt = new SPT;
            $spt->user_id = auth()->user()->id;
            $spt->correction_to = $request->correction_to;
            $spt->form_code = 'PPH21';
            $spt->year = $request->year;
            $spt->date = date('Y-m-d H:i:s');
            $spt->start_period = $request->period;
            $spt->end_period = $request->period;
            $spt->status = 0;
            $spt->tax_value = 0;
            $spt->payment_value = 0;
            $spt->send_flag = 0;
            $spt->save();

            //gaji
            $pph_tetap = 0; $pph_pensiun=0; $bruto_tetap=0; $bruto_pensiun=0; $jml_tetap=0; $jml_pensiun=0;
            foreach($income as $item){
                if($item->status=='Pegawai Tetap' && $item->terutang > 0){
                    $pph_tetap += $item->terutang;
                    $bruto_tetap += $item->bruto;
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

            DB::commit();

            $request->session()->flash('alert-success', 'SPT Masa '.$request->period.' '.$request->year.' Pembetulan Ke '.$request->correction_to.' Berhasil Diposting');
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollback();

            $request->session()->flash('alert-error', 'SPT Masa '.$request->period.' '.$request->year.' Pembetulan Ke '.$request->correction_to.' Tidak Berhasil Diposting');
            return redirect()->back();
        }
    }

    public function detailSpt(Request $request, $id){
        $spt = Spt::findOrFail($id);
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
    }

    public function setorSpt(Request $request, $id){
        $spt = Spt::findOrFail($id);
        $bill = BupotBill::where('spt_id', $spt->id)->get();
        $deposit = BupotDeposit::where('spt_id', $spt->id)->get();
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

            $email = auth()->user()->email;

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
            $body .="<br>Jenis SPT : SPT Masa PPh Pasal 21/26";
            $body .="<br>Pembetulan ke :".$spt->correction_to;
            $body .="<br>Status SPT : ".$status;
            $body .="<br>Nominal : ".$spt->tax_value;
            $body .="<br>Tanggal Penyampaian : ".$spt->date;
            $body .="<br>Nomor Tanda Terima Elektronik : ".$spt->ntte;

            $messages = [
                'subject' => '[e-SPT PPh 21] Bukti Penerimaan Elektronik',
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
            PphFinal::where('spt_id', $id)->delete();
            PphIncome::where('spt_id', $id)->delete();
            BupotBill::where('spt_id', $spt->id)->delete();
            BupotDeposit::where('spt_id', $spt->id)->delete();
            $spt->delete();
            $request->session()->flash('alert-success', 'SPT Berhasil Dihapus');
            return redirect()->back();
        }
    }

    public function cetakSpt(Request $request, $id)
    {
        $spt = Spt::findOrFail($id);
        $tidak = PphDoc::where('spt_id', $id)
            ->whereHas('object', function ($query){
                $query->whereIn('kdBupot', array('4','5'));
            })->orderBy('kdObjPjk')->get();
        $final = PphDoc::where('spt_id', $id)
            ->whereHas('object', function ($query){
                $query->where('kdBupot', '6');
            })->orderBy('kdObjPjk')->get();

        $pdf = Pdf::loadview('print.pph21_induk', [
            'spt' => $spt,
            'tidak' => $tidak,
            'final' => $final,
        ]);
        return $pdf->download('espt21_induk.pdf');
//        return view('print.pph21_induk', [
//            'spt' => $spt,
//            'tidak' => $tidak,
//            'final' => $final,
//        ]);
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

    public function itungPph($harta, $pengali) {
        $refTarif = array(array(60,5),array(250,15),array(500,25),array(5000,30),array(999999,35));
        $jmlLapis = count($refTarif);
        $pajak = 0;
        $max = 0;
        $pengurang = 0;
        $trf = 0;
        for ($i = 0; $i < $jmlLapis; $i++) {
            if ($i === 0) {
                $max = $refTarif[$i][0];
            } else {
                $max = $refTarif[$i][0] - $refTarif[$i - 1][0];
            }
            $pengurang = $max * 1000000;
            $trf = ($refTarif[$i][1] / 100) * ($pengali / 100);
            if ($harta > $pengurang) {
                $pajak = $pajak + ($pengurang * $trf);
                $harta = $harta - ($pengurang);
            } else {
                $pajak = $pajak + ($harta * $trf);
                $harta = 0;
            }
        }
        if ($pajak < 0) {
            $pajak = 0;
        }
        return $pajak;
    }

}