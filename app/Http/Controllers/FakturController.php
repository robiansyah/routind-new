<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nsfp;
use App\Models\MasterTransaction;
use App\Models\InvoiceInput;
use App\Models\InvoiceOutput;
use App\Models\InvoiceOutputItem;
use App\Models\ReferenceItem;
use App\Models\ReferenceTransaction;
use App\Models\ReturInput;
use App\Models\ReturOutput;
use App\Models\OtherInput;
use App\Models\OtherOutput;
use App\Models\PpnDok;
use App\Models\PpnFaktur;
use App\Models\PpnInduk;
use App\Models\Spt;
use App\Models\User;
use App\Models\Unit;
use App\Models\ClassStudent;
use App\Notifications\EmailNotification;

use DataTables;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;
use iio\libmergepdf\Merger;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class FakturController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified','spt']);
    }

    public function nsfp(){
        $nsfp = Nsfp::where('user_id', auth()->user()->id)->orderBy('year', 'desc')->get();

        return view('user.faktur.nsfp', [
            'nsfp' => $nsfp,
        ]);
    }

    public function storeNsfp(Request $request){
        $this->validate($request,[
            'year' => 'required',
            'range' => 'required|integer|between:5,100',
        ]);
        $year = substr($request->year, -2);

        $start = IdGenerator::generate(['table' => 'nsfp','field'=>'end_nsfp', 'length' => 15, 'reset_on_prefix_change'  => true, 'prefix' => '001.'.$year.'.']);
        $init = substr($start, -8);
        $last = $init+($request->range-1);
        $end = '001.'.$year.'.'.str_pad($last, 8, "0", STR_PAD_LEFT);

        $nsfp = new NSFP;
        $nsfp->user_id = auth()->user()->id;
        $nsfp->year = $request->year;
        $nsfp->range = $request->range;
        $nsfp->start_nsfp = $start;
        $nsfp->end_nsfp = $end;
        $nsfp->start_no = $init;
        $nsfp->end_no = $last;
        $nsfp->save();

        $request->session()->flash('alert-success', 'NSFP berhasil dibuat');
        return redirect()->back();
    }

    public function pajak(Request $request, $type){
        $period = (!empty($request->period)) ? $request->period : date('m');
        $year = (!empty($request->year)) ? $request->year : date('Y');
        if($type=='keluaran'){
            $data = InvoiceOutput::where('user_id', auth()->user()->id);
        }elseif($type=='masukan'){
            $data = InvoiceInput::where('user_id', auth()->user()->id);
        }else{
            $request->session()->flash('alert-error', 'Faktur Pajak Tidak Ditemukan');
            return redirect()->back();
        }

        if($period!='all'){
            $data->where('invoice_period', $period);
        }
        if($year!='all'){
            $data->where('invoice_year', $year);
        }

        $result = $data->orderBy('invoice_year', 'desc')->orderBy('invoice_period', 'desc')->orderBy('invoice_no', 'asc')->get();
        return view('user.faktur.pajak_'.$type , [
            'data' => $result,
            'users' => ($type=='masukan') ? ReferenceTransaction::where('user_id', auth()->user()->id)->get() : '',
            'period' => $period,
            'year' => $year,
        ]);
    }

    public function detailPajak(Request $request, $type, $id){
        if($type=='keluaran'){
            $invoice = InvoiceOutput::findOrFail($id);
        }elseif($type=='masukan'){
            $invoice = InvoiceInput::findOrFail($id);
        }
        return response()->json($invoice);
    }

    public function createPajak(Request $request){
        $this->validate($request,[
            'invoice_date' => 'required',
            'invoice_period' => 'required',
            'invoice_year' => 'required',
        ]);
        
        $invoice_no = IdGenerator::generate(['table' => 'invoice_outputs','field'=>'invoice_no', 'length' => 15, 'reset_on_prefix_change'  => true, 'prefix' => date('y').'.000-']);
        $invoice = new InvoiceOutput;
        $invoice->user_id = auth()->user()->id;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->invoice_period = $request->invoice_period;
        $invoice->invoice_year =$request->invoice_year;
        $invoice->payment = 'lunas';
        $invoice->status = 'Normal';
        $invoice->invoice_no = $invoice_no;
        $invoice->save();

//        $transactions = MasterTransaction::all();
//        $users = ReferenceTransaction::where('user_id', auth()->user()->id)->get();
//        $items = ReferenceItem::where('user_id', auth()->user()->id)->get();

        $request->session()->flash('alert-success', 'Faktur Pajak Keluaran Berhasil Dibuat');
        return redirect()->route('faktur.pajak.edit', ['type'=>'keluaran', 'id'=>$invoice->id]);
    }

    public function storePajak(Request $request, $type){
        if($type=='masukan'){
            $this->validate($request,[
                'invoice_no' => 'required',
                'invoice_date' => 'required',
                'invoice_period' => 'required',
                'invoice_year' => 'required',
                'customer_id' => 'required',
                'customer_name' => 'required',
                'customer_address' => 'required',
                'credit' => 'required',
                'dpp' => 'required',
                'ppn' => 'required',
                'ppnbm' => 'required',
            ]);

            $code = substr($request->invoice_no,0,5);
            $invoice_no = substr($request->invoice_no,-15);
            InvoiceInput::updateOrCreate([
                'id' => $request->id
            ],
                [
                    'user_id' => auth()->user()->id,
                    'transaction_code' => $code,
                    'invoice_no' => $invoice_no,
                    'invoice_date' => $request->invoice_date,
                    'invoice_period' => $request->invoice_period,
                    'invoice_year' => $request->invoice_year,
                    'collector_id' => $request->customer_id,
                    'collector_name' => $request->customer_name,
                    'collector_address' => $request->customer_address,
                    'credit' => $request->credit,
                    'dpp' => str_replace(".","",$request->dpp),
                    'ppn' => str_replace(".","",$request->ppn),
                    'ppnbm' => str_replace(".","",$request->ppnbm),
                    'approval_date' => date('Y-m-d'),
                ]);

            $request->session()->flash('alert-success', 'Faktur Pajak Keluaran Berhasil Dibuat');
            return redirect()->back();
        }
    }

    public function editPajak(Request $request, $type, $id){
        if($type=='keluaran'){
            $invoice = InvoiceOutput::findOrFail($id);

            $transactions = MasterTransaction::all();
            $units = Unit::all();

            return view('user.faktur.pajak_keluaran_form' , [
                'data' => $invoice,
                'transactions' => $transactions,
                'units' => $units,
            ]);
        }elseif($type=='masukan'){
            $invoice = InvoiceInput::findOrFail($id);
            return response()->json($invoice);
        }

    }

    public function changePajak(Request $request, $type, $id){
        if($type=='keluaran'){
            $old = InvoiceOutput::findOrFail($id);
            $old->status = 'Diganti';
            $old->approval = 'Amanded';
            $old->save();

            $invoice = $old->replicate();
            $digit = (int)substr($old->transaction_code, 3, 2)+1;
            $invoice->transaction_code = "0".$old->transaction_id.".".str_pad($digit,2,"0",STR_PAD_LEFT);
            $invoice->status = 'Normal - Pengganti';
            $invoice->approval = 'Created';
            $invoice->save();

            $old_items = InvoiceOutputItem::where('invoice_id', $id)->get();
            foreach($old_items as $item){
                $new_item  = $item->replicate();
                $new_item->invoice_id = $invoice->id;
                $new_item->save();
            }

            $transactions = MasterTransaction::all();
            $units = Unit::all();

            return view('user.faktur.pajak_keluaran_form' , [
                'data' => $invoice,
                'transactions' => $transactions,
                'units' => $units,
            ]);
        }else{
            echo 'a';
        }

    }

    public function updatePajak(Request $request, $type, $id){
        if($type=='keluaran'){

            $invoice = InvoiceOutput::findOrFail($id);
            $invoice->transaction_id = $request->transaction_id;
            $invoice->transaction_code = $request->transaction_code;
            $invoice->invoice_no = $request->invoice_no;
            $invoice->invoice_date = $request->invoice_date;
            $invoice->invoice_period = $request->invoice_period;
            $invoice->invoice_year = $request->invoice_year;
            $invoice->invoice_reference = $request->invoice_reference;
            $invoice->customer_type = 0;
            $invoice->customer_id = $request->customer_id;
            $invoice->customer_name = $request->customer_name;
            $invoice->customer_address = $request->customer_address;
//            $invoice->customer_phone = $customer->phone;
            $invoice->payment = ($request->payment) ? $request->payment : 'lunas';
            $invoice->dpp_split = ($request->dpp_split) ? str_replace(".","",$request->dpp_split) : 0;
            $invoice->ppn_split = ($request->ppn_split) ? str_replace(".","",$request->ppn_split) : 0;
            $invoice->ppnbm_split = ($request->ppnbm_split) ? str_replace(".","",$request->ppnbm_split) : 0;

            $invoice->save();

            $request->session()->flash('alert-success', 'Faktur Pajak Keluaran Berhasil Disimpan');
            return redirect()->route('faktur.pajak', ['type'=>'keluaran', 'period'=>$request->invoice_period, 'year'=>$request->invoice_year]);
        }elseif($type=='masukan'){

        }

    }

    public function destroyPajak(Request $request, $type, $id){
        if($type=='keluaran'){
            $invoice = InvoiceOutput::findOrFail($id);
            $invoice->approval = 'Deleted';
            $invoice->save();

            $request->session()->flash('alert-success', 'Faktur Pajak Keluaran Berhasil Dihapus');
        }elseif($type=='masukan'){
            $invoice = InvoiceInput::findOrFail($id)->delete();

            $request->session()->flash('alert-success', 'Faktur Pajak Masukan Berhasil Dihapus');
        }
        return redirect()->back();
    }

    public function cetakPajak($id)
    {
        $data = InvoiceOutput::findOrFail($id);
        $items = InvoiceOutputItem::where('invoice_id', $data->id)->get();

        $pdf = Pdf::loadview('print.faktur', [
            'data' => $data,
            'items' => $items,
        ]);
        return $pdf->download('faktur-keluaran.pdf');
        // return view('print.faktur', [
        //     'data'=>$data,
        // ]);
    }

    public function statusPajak(Request $request, $type, $id, $status){
        if($type=='keluaran'){
            if($status=='approval'){
                $invoice = InvoiceOutput::findOrFail($id);
                if($invoice->transaction_code != ''){

                    $item = InvoiceOutputItem::where('invoice_id', $id)->first();
                    if(!$item){
                        $request->session()->flash('alert-error', 'Barang / Jasa Masih Kosong, Silakan Edit Faktur dan Lengkapi Barang / Jasa');
                        return redirect()->back();
                    }

                    $invoice->approval = 'Approved';
                    $invoice->approval_date = date('Y-m-d');
                    $invoice->save();
                    $user = User::where('npwp', $invoice->customer_id)->first();
                    if($user){
                        InvoiceInput::create([
                            'user_id' => $user->id,
                            'transaction_code' => $invoice->transaction_code,
                            'invoice_no' => $invoice->invoice_no,
                            'invoice_date' => $invoice->invoice_date,
                            'invoice_period' => $invoice->invoice_period,
                            'invoice_year' => $invoice->invoice_year,
                            'collector_id' => auth()->user()->npwp,
                            'collector_name' => auth()->user()->profile->corporate_name,
                            'collector_address' => auth()->user()->profile->address,
                            'credit' => 'tidak',
                            'dpp' => $invoice->dpp,
                            'ppn' => $invoice->ppn,
                            'ppnbm' => $invoice->ppnbm,
                            'approval_date' => date('Y-m-d'),
                        ]);
                    }

                    $request->session()->flash('alert-success', 'Approval Sukses');

                }else{
                    $request->session()->flash('alert-error', 'Kode Transaksi Kosong, Silakan Edit Faktur dan Lengkapi Kode');
                }
                return redirect()->back();
            }elseif($status=='cancel'){
                $this->validate($request,[
                    'captcha' => 'required|captcha',
                ]);

                $invoice = InvoiceOutput::findOrFail($id);
                $invoice->status = 'Batal';
                $invoice->approval = 'Canceled';
                $invoice->save();

                $cek = InvoiceInput::where([
                    ['transaction_code', $invoice->transaction_code],
                    ['invoice_no', $invoice->invoice_no],
                    ['invoice_date', $invoice->invoice_date],
                    ['invoice_period', $invoice->invoice_period],
                    ['invoice_year', $invoice->invoice_year],
                    ['collector_id', auth()->user()->npwp],
                ])->first();
                if($cek){
                    $cek->delete();
                }

                $request->session()->flash('alert-success', 'Faktur Berhasil Dibatalkan');
                return redirect()->back();
            }
        }else{
            if($status=='approval'){
                $invoice = InvoiceInput::findOrFail($id);
                $invoice->approval = 'Approved';
                $invoice->approval_date = date('Y-m-d');
                $invoice->save();
                $request->session()->flash('alert-success', 'Approval Sukses');
                return redirect()->back();
            }elseif($status=='cancel'){
                $this->validate($request,[
                    'captcha' => 'required|captcha',
                ]);

                $invoice = InvoiceInput::findOrFail($id);
                $invoice->status = 'Batal';
//                $invoice->approval = 'Canceled';
                $invoice->save();
                $request->session()->flash('alert-success', 'Faktur Berhasil Dibatalkan');
                return redirect()->back();
            }
        }
    }

    public function retur(Request $request, $type){
        $period = (!empty($request->period)) ? $request->period : date('m');
        $year = (!empty($request->year)) ? $request->year : date('Y');
        $now = date('m-Y');
        $min = date("m-Y", strtotime("-3 months"));
        if($type=='keluaran'){
            $data = ReturOutput::where('user_id', auth()->user()->id);
            $invoices = InvoiceOutput::where([['user_id', auth()->user()->id], ['approval', 'Approved'], ['invoice_year', $year]])
//                ->whereBetween('invoice_period', [substr($min, 0, 2), substr($now, 0, 2)])
//                ->whereBetween('invoice_year', [substr($min, -4), substr($now, -4)])
                ->whereIN('status', array('Normal', 'Normal - Pengganti'))->orderBy('invoice_period', 'desc')->orderBy('invoice_no', 'desc')->get();
        }elseif($type=='masukan'){
            $data = ReturInput::where('user_id', auth()->user()->id);
            $invoices = InvoiceInput::where([['user_id', auth()->user()->id], ['approval', 'Approved'], ['status', 'Normal'], ['credit', 'ya'], ['invoice_year', $year]])
//                ->whereBetween('invoice_period', [substr($min, 0, 2), substr($now, 0, 2)])
//                ->whereBetween('invoice_year', [substr($min, -4), substr($now, -4)])
                ->orderBy('invoice_period', 'desc')->orderBy('invoice_no', 'desc')->get();
        }else{
            $request->session()->flash('alert-error', 'Retur Faktur Pajak Tidak Ditemukan');
            return redirect()->back();
        }

        if($period!='all'){
            $data->where('retur_period', $period);
        }
        if($year!='all'){
            $data->where('retur_year', $year);
        }

        $result = $data->orderBy('retur_year', 'desc')->orderBy('retur_period', 'desc')->get();
        return view('user.faktur.retur_'.$type , [
            'data' => $result,
            'invoices' => $invoices,
            'period' => $period,
            'year' => $year,
        ]);
    }

    public function storeRetur(Request $request, $type){
        $this->validate($request,[
            'retur_no' => 'required',
            'retur_date' => 'required',
            'retur_period' => 'required',
            'retur_year' => 'required',
            'invoice_id' => 'required',
            'dpp' => 'required',
            'ppn' => 'required',
            'ppnbm' => 'required',
        ]);
        if($type=='keluaran'){
            ReturOutput::updateOrCreate([
                'id' => $request->id
            ],
                [
                    'user_id' => auth()->user()->id,
                    'retur_no' => $request->retur_no,
                    'retur_date' => $request->retur_date,
                    'retur_period' => $request->retur_period,
                    'retur_year' => $request->retur_year,
                    'invoice_id' => $request->invoice_id,
                    'dpp' => str_replace(".","",$request->dpp),
                    'ppn' => str_replace(".","",$request->ppn),
                    'ppnbm' => str_replace(".","",$request->ppnbm),
                ]);
        }else{
            ReturInput::updateOrCreate([
                'id' => $request->id
            ],
                [
                    'user_id' => auth()->user()->id,
                    'retur_no' => $request->retur_no,
                    'retur_date' => $request->retur_date,
                    'retur_period' => $request->retur_period,
                    'retur_year' => $request->retur_year,
                    'invoice_id' => $request->invoice_id,
                    'dpp' => str_replace(".","",$request->dpp),
                    'ppn' => str_replace(".","",$request->ppn),
                    'ppnbm' => str_replace(".","",$request->ppnbm),
                ]);
        }

        $request->session()->flash('alert-success', 'Retur Faktur Pajak '.$type.' Berhasil Disimpan');
        return redirect()->back();
    }

    public function editRetur(Request $request, $type, $id){
        if($type=='keluaran'){
            $invoice = ReturOutput::findOrFail($id);
        }elseif($type=='masukan'){
            $invoice = ReturInput::findOrFail($id);
        }

        return response()->json($invoice);

    }

    public function destroyRetur(Request $request, $type, $id){
        if($type=='keluaran'){
            ReturOutput::findOrFail($id)->delete();

            $request->session()->flash('alert-success', 'Retur Faktur Pajak Keluaran Berhasil Dihapus');
            return redirect()->route('faktur.retur', ['type'=>'keluaran']);
        }elseif($type=='masukan'){
            ReturInput::findOrFail($id)->delete();

            $request->session()->flash('alert-success', 'Retur Faktur Pajak Masukan Berhasil Dihapus');
            return redirect()->route('faktur.retur', ['type'=>'masukan']);
        }
    }

    public function statusRetur(Request $request, $type, $id, $status){
        if($type=='keluaran'){
            if($status=='approval'){
                $retur = ReturOutput::findOrFail($id);
                $retur->approval = 'Approved';
                $retur->approval_date = date('Y-m-d');
                $retur->save();
                $request->session()->flash('alert-success', 'Approval Sukses');
                return redirect()->back();
            }
        }else{
            if($status=='approval'){
                $retur = ReturInput::findOrFail($id);
                $retur->approval = 'Approved';
                $retur->approval_date = date('Y-m-d');
                $retur->save();
                $request->session()->flash('alert-success', 'Approval Sukses');
                return redirect()->back();
            }
        }
    }

    public function other(Request $request, $type){
        $period = (!empty($request->period)) ? $request->period : date('m');
        $year = (!empty($request->year)) ? $request->year : date('Y');
        if($type=='keluaran'){
            $data = OtherOutput::where('user_id', auth()->user()->id);
        }elseif($type=='masukan'){
            $data = OtherInput::where('user_id', auth()->user()->id);
        }else{
            $request->session()->flash('alert-error', 'Dokumen Lainnya Tidak Ditemukan');
            return redirect()->back();
        }

        if($period!='all'){
            $data->where('other_period', $period);
        }
        if($year!='all'){
            $data->where('other_year', $year);
        }

        $result = $data->orderBy('other_year', 'desc')->orderBy('other_period', 'desc')->get();
        return view('user.faktur.lainnya_'.$type , [
            'data' => $result,
            'period' => $period,
            'year' => $year,
        ]);
    }

    public function storeOther(Request $request, $type){
        $this->validate($request,[
            'other_no' => 'required',
            'other_date' => 'required',
            'other_period' => 'required',
            'other_year' => 'required',
            'transaction_detail' => 'required',
            'transaction_doc' => 'required',
            'transaction_name' => 'required',
            'dpp' => 'required',
            'ppn' => 'required',
            'ppnbm' => 'required',
        ]);
        if($type=='keluaran'){
            OtherOutput::updateOrCreate([
                'id' => $request->id
            ],
                [
                    'user_id' => auth()->user()->id,
                    'other_no' => $request->other_no,
                    'other_date' => $request->other_date,
                    'other_period' => $request->other_period,
                    'other_year' => $request->other_year,
                    'transaction_detail' => $request->transaction_detail,
                    'transaction_doc' => $request->transaction_doc,
                    'transaction_name' => $request->transaction_name,
                    'dpp' => str_replace(".","",$request->dpp),
                    'ppn' => str_replace(".","",$request->ppn),
                    'ppnbm' => str_replace(".","",$request->ppnbm),
                ]);
        }else{
            OtherInput::updateOrCreate([
                'id' => $request->id
            ],
                [
                    'user_id' => auth()->user()->id,
                    'other_no' => $request->other_no,
                    'other_date' => $request->other_date,
                    'other_period' => $request->other_period,
                    'other_year' => $request->other_year,
                    'transaction_detail' => $request->transaction_detail,
                    'transaction_doc' => $request->transaction_doc,
                    'transaction_name' => $request->transaction_name,
                    'dpp' => str_replace(".","",$request->dpp),
                    'ppn' => str_replace(".","",$request->ppn),
                    'ppnbm' => str_replace(".","",$request->ppnbm),
                ]);
        }

        $request->session()->flash('alert-success', 'Dokumen Lainnya Berhasil Disimpan');
        return redirect()->back();
    }

    public function editOther(Request $request, $type, $id){
        if($type=='keluaran'){
            $invoice = OtherOutput::findOrFail($id);
        }elseif($type=='masukan'){
            $invoice = OtherInput::findOrFail($id);
        }

        return response()->json($invoice);

    }

    public function destroyOther(Request $request, $type, $id){
        if($type=='keluaran'){
            OtherOutput::findOrFail($id)->delete();
        }elseif($type=='masukan'){
            OtherInput::findOrFail($id)->delete();
        }

        $request->session()->flash('alert-success', 'Dokumen Lainnya Berhasil Dihapus');
        return redirect()->back();
    }

    public function statusOther(Request $request, $type, $id, $status){
        if($type=='keluaran'){
            if($status=='approval'){
                $retur = OtherOutput::findOrFail($id);
                $retur->approval = 'Approved';
                $retur->approval_date = date('Y-m-d');
                $retur->save();
                $request->session()->flash('alert-success', 'Approval Sukses');
                return redirect()->back();
            }elseif($status=='cancel'){
                $this->validate($request,[
                    'captcha' => 'required|captcha',
                ]);

                $data = OtherOutput::findOrFail($id);
                $data->status = 'Batal';
                $data->save();
                $request->session()->flash('alert-success', 'Faktur Berhasil Dibatalkan');
                return redirect()->back();
            }
        }else{
            if($status=='approval'){
                $retur = OtherInput::findOrFail($id);
                $retur->approval = 'Approved';
                $retur->approval_date = date('Y-m-d');
                $retur->save();
                $request->session()->flash('alert-success', 'Approval Sukses');
                return redirect()->back();
            }elseif($status=='cancel'){
                $this->validate($request,[
                    'captcha' => 'required|captcha',
                ]);

                $data = OtherInput::findOrFail($id);
                $data->status = 'Batal';
                $data->save();
                $request->session()->flash('alert-success', 'Faktur Berhasil Dibatalkan');
                return redirect()->back();
            }
        }
    }

    public function viewProduk(Request $request, $invoice_id){
        $data = InvoiceOutputItem::where([['invoice_id', $invoice_id]])->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('total', function($row){
                    return $row->price*$row->amount;
                })
                ->addColumn('action', function($row){
                    $btn = '<button type="button" class="btn btn-icon btn-active-light-primary w-25px h-25px editItem" data-id="'.$row->id.'" title="Edit"><i class="fa fa-pencil"></i></button>';
                    $btn .= ' <button type="button" class="btn btn-icon btn-active-light-primary w-25px h-25px deleteItem" data-id="'.$row->id.'" title="Hapus"><i class="fa fa-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function storeProduk(Request $request, $invoice_id){
        if(empty($request->id)){
            InvoiceOutputItem::create([
                'type' => $request->type,
                'name' => $request->name,
                'unit' => $request->unit,
                'invoice_id' => $invoice_id,
                'price' => str_replace(".","",$request->price),
                'amount' => str_replace(".","",$request->amount),
                'discount' => str_replace(".","",$request->discount),
                'dpp' => str_replace(".","",$request->dpp),
                'ppn' => str_replace(".","",$request->ppn),
                'tarif_ppnbm' => str_replace(".","",$request->tarif_ppnbm),
                'ppnbm' => str_replace(".","",$request->ppnbm),
            ]);
        }else{
            $item = InvoiceOutputItem::findOrFail($request->id);
            $item->update([
                'type' => $request->type,
                'name' => $request->name,
                'unit' => $request->unit,
                'price' => str_replace(".","",$request->price),
                'amount' => str_replace(".","",$request->amount),
                'discount' => str_replace(".","",$request->discount),
                'dpp' => str_replace(".","",$request->dpp),
                'ppn' => str_replace(".","",$request->ppn),
                'tarif_ppnbm' => str_replace(".","",$request->tarif_ppnbm),
                'ppnbm' => str_replace(".","",$request->ppnbm),
            ]);
        }
        $items = InvoiceOutputItem::select(DB::raw("SUM(dpp) as total_dpp"), DB::raw("SUM(ppn) as total_ppn"), DB::raw("SUM(ppnbm) as total_ppnbm"))
            ->where('invoice_id', $invoice_id)->groupBy("invoice_id")->first();
        $invoice = InvoiceOutput::findOrFail($invoice_id);
        $invoice->update([
            'dpp' => $items->total_dpp,
            'ppn' => $items->total_ppn,
            'ppnbm' => $items->total_ppnbm,
        ]);

        return response()->json(['success'=>'Data saved successfully.', 'data'=>$invoice]);
    }

    public function editProduk($id){
        $data = InvoiceOutputItem::findOrFail($id);

        return response()->json($data);
    }

    public function destroyProduk($id){
        $item = InvoiceOutputItem::findOrFail($id);
        $invoice_id = $item->invoice_id;
        $item->delete();

        $items = InvoiceOutputItem::select(DB::raw("SUM(dpp) as total_dpp"), DB::raw("SUM(ppn) as total_ppn"), DB::raw("SUM(ppnbm) as total_ppnbm"))
            ->where('invoice_id', $invoice_id)->groupBy("invoice_id")->first();
        $invoice = InvoiceOutput::findOrFail($invoice_id);
        $invoice->update([
            'dpp' => ($items) ? $items->total_dpp : 0,
            'ppn' => ($items) ? $items->total_ppn : 0,
            'ppnbm' => ($items) ? $items->total_ppnbm : 0,
        ]);

        return response()->json(['success'=>'Data deleted successfully.', 'data'=>$invoice]);
    }

    public function referensi(Request $request, $type){
        if($type=='lawan_transaksi'){
            $data = ReferenceTransaction::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        }elseif($type=='barang_jasa'){
            $data = ReferenceItem::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        }else{
            $request->session()->flash('alert-error', 'Referensi Tidak Ditemukan');
            return redirect()->back();
        }

        return view('user.faktur.referensi_'.$type , [
            'data' => $data,
        ]);
    }

    public function storeReferensi(Request $request, $type){
        if($type=='lawan_transaksi'){
            $this->validate($request,[
                'name' => 'required',
                'address' => 'required',
            ]);

            $user = new ReferenceTransaction;
            $user->user_id = auth()->user()->id;
            $user->name = $request->name;
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->npwp = $request->npwp;
            $user->nik = $request->nik;
            $user->save();

            $request->session()->flash('alert-success', 'Referensi Lawan Transaksi Berhasil Ditambahkan');
            return redirect()->back();

        }elseif($type=='barang_jasa'){
            $this->validate($request,[
                'name' => 'required',
                'price' => 'required|numeric',
            ]);

            $item = new ReferenceItem;
            $item->user_id = auth()->user()->id;
            $item->code = $request->code;
            $item->name = $request->name;
            $item->price = $request->price;
            $item->save();

            $request->session()->flash('alert-success', 'Referensi Lawan Transaksi Berhasil Ditambahkan');
            return redirect()->back();
        }
    }

    public function editReferensi($type, $id){
        if($type=='lawan_transaksi'){
            $data = ReferenceTransaction::findOrFail($id);
        }elseif($type=='barang_jasa'){
            $data = ReferenceItem::findOrFail($id);
        }else{
            return response()->json([
                'data' => null,
            ]);
        }

        return response()->json($data);
    }

    public function updateReferensi(Request $request, $type, $id){
        if($type=='lawan_transaksi'){
            $this->validate($request,[
                'name' => 'required',
                'address' => 'required',
            ]);

            $user = ReferenceTransaction::findOrFail($id);
            $user->name = $request->name;
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->npwp = $request->npwp;
            $user->nik = $request->nik;
            $user->save();

            $request->session()->flash('alert-success', 'Referensi Lawan Transaksi Berhasil Diubah');
            return redirect()->back();

        }elseif($type=='barang_jasa'){
            $this->validate($request,[
                'name' => 'required',
                'price' => 'required|numeric',
            ]);

            $item = ReferenceItem::findOrFail($id);
            $item->code = $request->code;
            $item->name = $request->name;
            $item->price = $request->price;
            $item->save();

            $request->session()->flash('alert-success', 'Referensi Lawan Transaksi Berhasil Diubah');
            return redirect()->back();
        }
    }

    public function destroyReferensi(Request $request, $type, $id)
    {
        if($type=='lawan_transaksi'){
            ReferenceTransaction::findOrFail($id)->delete();
            $request->session()->flash('alert-success', 'Lawan Transaksi Berhasil Dihapus');
            return redirect()->back();
        }elseif($type=='barang_jasa'){
            ReferenceItem::findOrFail($id)->delete();
            $request->session()->flash('alert-success', 'Baran / Jasa Berhasil Dihapus');
            return redirect()->back();
        }
    }

    public function spt(Request $request){
        $class_student = ClassStudent::with('kelas')->where('student_id', auth()->user()->id)->first();
        $year = (!empty($request->year)) ? $request->year : date('Y');
        $spt = Spt::where([['user_id', auth()->user()->id], ['form_code', 'PPN1111'], ['year', $year]])->get();
        return view('user.faktur.spt',[
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

        $spt = Spt::where([['user_id', auth()->user()->id], ['send_flag', '<>', 2], ['form_code', 'PPN1111'],
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
            $spt->form_code = 'PPN1111';
            $spt->year = $request->year;
            $spt->date = date('Y-m-d H:i:s');
            $spt->start_period = $request->period;
            $spt->end_period = $request->period;
            $spt->status = 0;
            $spt->tax_value = 0;
            $spt->payment_value = 0;
            $spt->send_flag = 0;
            $spt->save();

            $lampiran = array("ab");
            $ekspor = OtherOutput::where([['user_id', auth()->user()->id], ['other_period', $request->period],
                ['other_year', $request->year], ['approval', 'Approved']])->get();
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
                ['other_year', $request->year], ['approval', 'Approved']])->get();
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
                ->where([['type', 'A2'], ['spt_id', $spt->id]])->whereIN('transaction_code', array('010', '040', '050', '060', '090','011', '041', '051', '061', '091'))->groupBy("type")->first();
            $jml_a22 = PpnFaktur::select(DB::raw("SUM(dpp) as dpp"), DB::raw("SUM(ppn) as ppn"), DB::raw("SUM(ppnbm) as ppnbm"))
                ->where([['type', 'A2'], ['spt_id', $spt->id]])->whereIN('transaction_code', array('020', '030', '021', '031'))->groupBy("type")->first();
            $jml_a23 = PpnFaktur::select(DB::raw("SUM(dpp) as dpp"), DB::raw("SUM(ppn) as ppn"), DB::raw("SUM(ppnbm) as ppnbm"))
                ->where([['type', 'A2'], ['spt_id', $spt->id]])->whereIN('transaction_code', array('070', '071'))->groupBy("type")->first();
            $jml_a24 = PpnFaktur::select(DB::raw("SUM(dpp) as dpp"), DB::raw("SUM(ppn) as ppn"), DB::raw("SUM(ppnbm) as ppnbm"))
                ->where([['type', 'A2'], ['spt_id', $spt->id]])->whereIN('transaction_code', array('080', '081'))->groupBy("type")->first();
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

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }

        $request->session()->flash('alert-success', 'SPT Masa '.$request->period.' '.$request->year.' Pembetulan Ke '.$request->correction_to.' Berhasil Diposting');
        return redirect()->back();
    }

    public function detailSpt(Request $request, $id){
        $spt = Spt::findOrFail($id);
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
    }

    public function updateSpt(Request $request, $id){
        $induk = PpnInduk::where([['spt_id', $id]])->first();
        $spt = Spt::findOrFail($id);
        if($induk && $request->category == 'lampiran_ab'){
            $induk->dpp_a2_covered = str_replace(".","",$request->dpp_a2_covered);
            $induk->ppn_a2_covered = str_replace(".","",$request->ppn_a2_covered);
            $induk->ppnbm_a2_covered = str_replace(".","",$request->ppnbm_a2_covered);
            $induk->ppn_correction = str_replace(".","",$request->ppn_correction);
            $induk->ppn_input = str_replace(".","",$request->ppn_input);
            $induk->ppn_calculated = $induk->ppn_b1+$induk->ppn_b2+str_replace(".","",$request->ppn_correction)+str_replace(".","",$request->ppn_input);
            $induk->submit_ab = 'ya';
            $induk->save();

            $tax_value = ($induk->ppn_a21+$induk->ppn_a2_covered)-($induk->ppn_calculated);
            $spt->tax_value = $tax_value;
            $spt->status = ($tax_value > 0) ? 1 : (($tax_value < 0) ? 2 : 0);

            if($tax_value >= 0){
                $induk->lebih_bayar = null;
                $induk->kompensasi = null;
                $induk->save();
            }
        }elseif($induk && $request->category == 'induk'){
            $induk->lampiran = json_encode($request->lampiran);
            $induk->ttd_place = $request->ttd_place;
            $induk->ttd_date = $request->ttd_date;
            $induk->ttd_name = $request->ttd_name;
            $induk->ttd_position = $request->ttd_position;
            $induk->ppnbm_deposit = str_replace(".","",$request->ppnbm_deposit);
            $induk->date_ppnbm = $request->date_ppnbm;
            $induk->ntpn_ppnbm = $request->ntpn_ppnbm;
            $induk->nominal_ppnbm = str_replace(".","",$request->nominal_ppnbm);
            $induk->ppn_fail = str_replace(".","",$request->ppn_fail);
            $induk->date_fail = $request->date_fail;
            $induk->ntpn_fail = $request->ntpn_fail;
            $induk->nominal_fail = str_replace(".","",$request->nominal_fail);
            $induk->dpp_own = str_replace(".","",$request->dpp_own);
            $induk->ppn_own = str_replace(".","",$request->ppn_own);
            $induk->date_own = $request->date_own;
            $induk->ntpn_own = $request->ntpn_own;
            $induk->nominal_own = str_replace(".","",$request->nominal_own);
            $induk->date_ppn = $request->date_ppn;
            $induk->ntpn_ppn = $request->ntpn_ppn;
            $induk->nominal_ppn = str_replace(".","",$request->nominal_ppn);
            $induk->dpp_not = str_replace(".","",$request->dpp_not);
            $induk->submit_induk = 'ya';
            if(($induk->ppn_a21+$induk->ppn_a2_covered)-($induk->ppn_calculated) < 0){
                $induk->lebih_bayar = json_encode($request->lebih_bayar);
                $induk->kompensasi = ($request->lebih_bayar=='masa') ? $request->kompensasi : null;
            }
            $induk->save();

            $spt->payment_value = $induk->nominal_ppn+$induk->nominal_ppnbm+$induk->nominal_own;
        }
        $spt->save();

        return response()->json([
            'success'=>'Data saved successfully.',
            'induk'=>$induk->submit_induk,
            'ab'=>$induk->submit_ab
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
            $status = ($spt->status == 1) ? 'Kurang Bayar' : (($spt->status == 2) ? 'Lebih Bayar' : 'Nihil');

            $user = User::findOrFail(auth()->user()->id);
            $body = "Berikut ini adalah Bukti Penerimaan Elektronik Anda.";
            $body .="<br>---------------------------------------------------";
            $body .="<br>Nama : ".$user->profile->corporate_name;
            $body .="<br>NPWP : ".$user->npwp;
            $body .="<br>Tahun Pajak : ".$spt->year;
            $body .="<br>Masa Pajak : ".$spt->start_period;
            $body .="<br>Jenis SPT : ".$spt->form_code;
            $body .="<br>Pembetulan ke :".$spt->correction_to;
            $body .="<br>Status SPT : ".$status;
            $body .="<br>Nominal : ".$spt->tax_value;
            $body .="<br>Tanggal Penyampaian : ".$spt->date;
            $body .="<br>Nomor Tanda Terima Elektronik : ".$spt->ntte;

            $messages = [
                'subject' => '[e-Faktur] Bukti Penerimaan Elektronik',
                'greeting' => 'Hi '.$user->profile->corporate_name.',',
                'body' => $body,
                'thanks' => 'Terima kasih telah menyampaikan Laporan SPT Anda.',
            ];

            $user->notify(new EmailNotification($messages));

            $request->session()->flash('alert-success', 'SPT Masa '.$spt->start_period.' '.$spt->year.' Pembetulan Ke '.$spt->correction_to.' Berhasil Diupload');
            return redirect()->back();
        }elseif($status=='destroy'){
            $spt = Spt::findOrFail($id);
            if($spt->send_flag==2){
                $request->session()->flash('alert-error', 'SPT Masa '.$spt->start_period.' '.$spt->year.' Pembetulan Ke '.$spt->correction_to.' Tidak Dapat Dihapus');
                return redirect()->back();
            }
            PpnInduk::where('spt_id', $id)->delete();
            PpnDok::where('spt_id', $id)->delete();
            PpnFaktur::where('spt_id', $id)->delete();
            $spt->delete();

            $request->session()->flash('alert-success', 'SPT Berhasil Dihapus');
            return redirect()->back();
        }
    }

    public function cetakSpt(Request $request, $id)
    {
        $induk = PpnInduk::where('spt_id', $id)->first();
        if(!$induk){
            $request->session()->flash('alert-error', 'SPT Tidak Ditemukan');
            return redirect()->back();
        }

        $m = new Merger();
        $pdf = PDF::loadView('print.faktur_induk', [
            'induk' => $induk,
        ])->setPaper('a4', 'potrait');

        $m->addRaw($pdf->output());

        $pdf2 = PDF::loadView('print.faktur_ab', [
            'induk' => $induk,
        ])->setPaper('a4', 'landscape');

        $nama_file = 'spt_ppn.pdf';
        $m->addRaw($pdf2->output());
        return response($m->merge())
            ->withHeaders([
                'Content-Type' => 'application/pdf',
                'Cache-Control' => 'no-store, no-cache',
                'Content-Disposition' => 'attachment; filename="'.$nama_file,
            ]);
//         return view('print.faktur_induk', [
//             'induk' => $induk,
//         ]);
    }

    public function cetakInduk(Request $request, $id)
    {
        $induk = PpnInduk::where('spt_id', $id)->first();
        if(!$induk){
            $request->session()->flash('alert-error', 'SPT Tidak Ditemukan');
            return redirect()->back();
        }
        $pdf = Pdf::loadview('print.ppn_induk', [
            'induk' => $induk,
        ]);
        return $pdf->download('spt-induk.pdf');
    }


}
