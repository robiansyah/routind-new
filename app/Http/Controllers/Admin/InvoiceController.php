<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DigiInvoice;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = DigiInvoice::orderBy('id', 'desc')->lazy();

        return view('admin.invoice.index',[
            'data' => $invoices,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('admin.invoice.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'address' => 'required',
            'code' => 'required',
            'no' => 'required',
            'date' => 'required',
            'item' => 'required',
            'price' => 'required',
            'qty' => 'required'
        ]);

        $invoice = 'INV-DG-'.substr($request->date,5, 2).substr($request->date,2, 2).'/';
        DigiInvoice::create([
            'name' => $request->name,
            'address' => $request->address,
            'code' => $request->code,
            'no' => $invoice.$request->no,
            'date' => $request->date,
            'item' => $request->item,
            'price' => $request->price,
            'discount' => $request->discount,
            'qty' => $request->qty,
            'type' => $request->type,
            'payment' => $request->payment,
            'qrcode' => time().$this->quickRandom(),
        ]);

        $request->session()->flash('alert-success', 'Invoice berhasil dibuat');
        return redirect()->route('admin.invoice.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $invoice = DigiInvoice::findOrFail($id);

        return view('admin.invoice.edit',[
            'invoice' => $invoice,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'address' => 'required',
            'code' => 'required',
            'no' => 'required',
            'date' => 'required',
            'item' => 'required',
            'price' => 'required',
            'qty' => 'required'
        ]);

        $invoice = DigiInvoice::findOrFail($id);

        $invoice->update([
            'name' => $request->name,
            'address' => $request->address,
            'code' => $request->code,
            'no' => $request->no,
            'date' => $request->date,
            'item' => $request->item,
            'price' => $request->price,
            'discount' => $request->discount,
            'qty' => $request->qty,
            'type' => $request->type,
            'payment' => $request->payment,
        ]);

        $request->session()->flash('alert-success', 'invoice berhasil dibuat');
        return redirect()->route('admin.invoice.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        DigiInvoice::findOrFail($id)->delete();
        $request->session()->flash('alert-success', 'invoice berhasil dihapus');
        return redirect()->back();
    }

    public function print(Request $request, $id)
    {
        $invoice = DigiInvoice::findOrFail($id);

        $pdf = Pdf::loadview('admin.invoice.print', [
            'invoice' => $invoice,
        ])->setPaper('a4', 'potrait');
        return $pdf->download('Invoice_'.$invoice->no.'.pdf');
    }

    public function status(Request $request, $id)
    {
        $invoice = DigiInvoice::findOrFail($id);
        if($invoice->status=='UNPAID'){
            $invoice->update(['status' => 'PAID',]);
        }else{
            $invoice->update(['status' => 'UNPAID',]);
        }
        $request->session()->flash('alert-success', 'status invoice berhasil diubah');
        return redirect()->back();
    }

    public static function quickRandom($length = 6)
    {
        $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
}
