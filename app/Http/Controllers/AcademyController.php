<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\AcademyCategory;
use App\Models\AcademyEvent;
use App\Models\AcademyBatch;
use App\Models\Discount;
use App\Models\AcademyPurchase;
use App\Models\AcademyMessage;
use App\Models\Certificate;
use Barryvdh\DomPDF\Facade\Pdf;
use Haruncpi\LaravelIdGenerator\IdGenerator;

use App\Mail\ButtonEmail;
use App\Mail\AcademyEmail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
//import Xendit
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Illuminate\Support\Str;
//Wablas
use App\Traits\WablasTrait;
use Illuminate\Support\Facades\Http;
//Doku
use App\Services\DokuService;
use DB;

class AcademyController extends Controller
{
    var $apiInstance = null;
    protected $dokuService;
    public function __construct(DokuService $dokuService)
    {
        Configuration::setXenditKey(config('xendit.API_KEY'));
        $this->dokuService = $dokuService;
    }

    public function index() {
        $last = AcademyEvent::with('batch', 'batch2')->where('status', 'show')->orderByDesc(AcademyBatch::select('start_date')
            ->whereColumn('event_id', 'academy_events.id')
            ->latest('end_date')
            ->limit(1))->limit(8)->get();
        $faq = Faq::all();
        return view('academy.index',[
            'last' => $last,
            'faq' => $faq,
        ]);
    }

    public function event(Request $request, $category='all') {
        if($category!='all'){
            $slug = AcademyCategory::where('slug', $category)->first();
            if($slug){
                $events = AcademyEvent::with('batch', 'batch2')->where([['category_id', $slug->id], ['status', 'show']])->orderBy('created_at', 'desc')->get();
            }else{
                $events = AcademyEvent::with('batch', 'batch2')->where('status', 'show')->orderBy('updated_at', 'desc')->get();
            }
        }else{
            $events = AcademyEvent::with('batch', 'batch2')->where('status', 'show')->orderByDesc(AcademyBatch::select('start_date')
                ->whereColumn('event_id', 'academy_events.id')
                ->latest('end_date')
                ->limit(1))->get();
        }
        return view('academy.event',[
            'events' => $events,
        ]);
    }

    public function eventNew($slug) {
        $event = AcademyEvent::where('slug', $slug)->first();
        if($event){
            $last = AcademyBatch::where([['event_id', $event->id], ['registration', '>=', date('Y-m-d')]])->orderBy('start_date')->get();
            return view('academy.event_new',[
                'event' => $event,
                'last' => $last,
            ]);
        }else{
            return redirect()->route('academy');
        }

    }

    public function eventDetail($slug)
    {
        $event = AcademyEvent::where('slug', $slug)->first();
        if($event){
        $last = AcademyEvent::orderBy('id', 'desc')->limit(3)->get();
            return view('academy.event_detail',[
                'event' => $event,
                'last' => $last,
            ]);
        }else{
            return route('academy');
        }
    }

    public function order()
    {
        return view('academy.order', [
            'data' => 'form',
        ]);
    }

    public function orderCheck(Request $request)
    {
        $this->validate($request,[
            'code' => 'required',
        ]);
        $order = AcademyPurchase::where('invoice_code', $request->code)->first();
        return view('academy.order',[
            'data' => 'check',
            'order' => $order,
        ]);
    }

    public function orderDetail($code)
    {
        $order = AcademyPurchase::where('id', $code)->first();
        if($order->amount > 0){
            return view('academy.order_detail',[
                'order' => $order,
            ]);
        }else{
            return view('academy.order',[
                'data' => 'check',
                'order' => $order,
            ]);
        }
    }

    public function eventCheckout($slug)
    {
        $event = AcademyEvent::where('slug', $slug)->first();

        return view('academy.checkout',[
            'event' => $event,
//            'channels' => $this->tripayService->getPaymentChannels(),
        ]);
    }

    public function eventCheckoutId($id)
    {
        $batch = AcademyBatch::findOrFail($id);

        return view('academy.checkout_new',[
            'batch' => $batch,
//            'channels' => $this->tripayService->getPaymentChannels(),
        ]);
    }

    public function eventCheckoutNew(Request $request)
    {
        $this->validate($request,[
            'batch' => 'required',
        ]);

        $batch = AcademyBatch::findOrFail($request->batch);

        return response()->json([
            "status"=>"success",
            "url"=> route('event.payment.id', $batch->id),
        ]);
    }

    public function cost(Request $request)
    {
        $cost = $this->tripayService->getCost($request->code, $request->amount);
        return response()->json([
            'message'=>"success",
            "code"=> ($cost) ? 1 : 0 ,
            "data"=> $cost,
        ]);
    }

    public function discount(Request $request)
    {
        $code = $request->code;
        $discount = Discount::where([['code', $code], ['start_date', '<=', date('Y-m-d')], ['end_date', '>=', date('Y-m-d')]])->first();
        return response()->json([
            "status"=>"success",
            "code"=> ($discount) ? 1 : 0,
            "data"=> ($discount)? : array(),
        ]);
    }

    public function checkout(Request $request)
    {
        $batch = AcademyBatch::findOrFail($request->batch_id);
        if($batch->event->category->slug=='competition'){
            $this->validate($request,[
                'name' => 'required',
                'mobile' => 'required',
                'email' => 'required|email',
                'institution' => 'required',
                'code' => 'required',
                'file' => 'required|file|mimes:pdf|max:2048',
            ]);
        }else{
            $this->validate($request,[
                'name' => 'required',
                'mobile' => 'required',
                'email' => 'required|email',
                'institution' => 'required',
                'code' => 'required'
            ]);
        }
        $cek = AcademyPurchase::where([['email', $request->email], ['batch_id', $batch->id], ['status', 'PAID']])->first();
        if($cek){
            return response()->json(['success' => true, 'purchase_id' => $cek->id, 'button' => 'Cek Detail']);
        }
        $inv = IdGenerator::generate(['table' => 'academy_purchases','field'=>'invoice_code', 'length' => 13, 'reset_on_prefix_change'  => true, 'prefix' => 'EVENT-'.date('y')]);
        $new = new AcademyPurchase;
        $new->email = $request->email;
        $new->name = $request->name;
        $new->mobile_phone = $request->mobile;
        $new->institution = $request->institution;
        $new->batch_id = $batch->id;
        if($batch->event->category->slug=='competition'){
            $file = $request->file('file');
            $filePath = $file->store('competitions', 'public');
            $new->file = $filePath;
        }
        $new->save();
        $diskon = 0;
        $kode_diskon = '-';
        if($batch->price > 0){
            if(!empty($request->diskon_id)){
                $discount = Discount::where([['id', $request->diskon_id], ['start_date', '<=', date('Y-m-d')], ['end_date', '>=', date('Y-m-d')]])->first();
                if($discount){
                    $kode_diskon = $discount->code;
                    $diskon = ($discount->type=='rupiah') ? $discount->amount : $batch->price * $discount->amount / 100;
                }else{
                    $request->session()->flash('alert-error', 'Kode Diskon Tidak Berlaku');
                    return redirect()->back();
                }
            }

            $total = $batch->price-$diskon;
            $admin = ($request->code=='QRIS') ? ($total*0.7/100)+750 : 5000;
            if($diskon > 0){
                $fees = array(['type'=>'Diskon', 'value'=>-$diskon],['type'=>'Biaya Transaksi', 'value'=>$admin]);
            }else{
                $fees = array(['type'=>'Biaya Transaksi', 'value'=>$admin]);
            }

            $apiInstance = new InvoiceApi();
            //request create invoice
            $create_invoice = new \Xendit\Invoice\CreateInvoiceRequest([
                'external_id' => (string) Str::uuid(),
                'customer' => [
                    'given_names' => $request->name,
                    'email' => $request->email,
                    'mobile_number' => $request->mobile,
                ],
                'customer_notification_preference' => [
                    'invoice_created' => ['email', 'whatsapp'],
                    'invoice_reminder' => ['email', 'whatsapp'],
                    'invoice_paid' => ['email', 'whatsapp'],
                ],
                'description' => 'Invoice pembayaran transaksi produk '.$batch->event->title.' - '.$batch->name.' untuk user '.$request->name,
                'amount' => $total+$admin,
                'items' => array([
                    'name' => $batch->event->title,
                    'price' => $batch->price,
                    'quantity' => 1,
                    'url' => route('event.new', $batch->event->slug),
                ]),
                'fees' => $fees,
                'failure_redirect_url' => route('order.show', $new->id),
                'success_redirect_url' => route('order.show', $new->id),
                'payment_methods' => [$request->code]
            ]);

            try {

                //create invoice
                $invoice = $apiInstance->createInvoice($create_invoice);

                $new->nett = $total;
                $new->discount_code = $kode_diskon;
                $new->discount_amount = $diskon;
                $new->status = 'UNPAID';
                $new->invoice_code = $inv;
                $new->transaction_code = $invoice['external_id'];
                $new->amount = $invoice['amount'];
                $new->invoice_url = $invoice['invoice_url'];
                $new->save();

                $url = $invoice['invoice_url'];
            } catch (\Xendit\XenditSdkException $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
        }else{
            $new->discount_code = $kode_diskon;
            $new->discount_amount = $diskon;
            $new->status = 'PAID';
            $new->invoice_code = $inv;
            $new->amount = 0;
            $new->nett = 0;
            $new->save();

//            $subject = 'Pendaftaran Anda Berhasil';
//            $message = 'Pendaftaran anda pada course '.$batch->event->title.' telah berhasil, silakan klik tombol dibawah ini untuk gabung ke grup pelatihan.';
//            $link = $batch->link_group;
//            $btn = 'Join Grup';
//            Mail::to($new->email)->send(new ButtonEmail($subject, $message, $new->name, $link, $btn));

            //kirim wa
            $message = "[pesan otomatis]<br>Pendaftaran Anda Berhasil
		    <br>Hai Kak ".$request->name."
		    <br>Selamat! Kami senang untuk memberitahu Anda bahwa pendaftaran Anda pada course ".$batch->event->title." telah berhasil diverifikasi.
            <br>Silakan save no ini terlebih dahulu agar link dapat diakses, kemudian klik link berikut ini untuk bergabung dengan grup WA
            <br>".$batch->link_group;
            $kumpulan_data = [];
            $data['phone'] = $request->mobile;
            $data['message'] = $message;
            $data['secret'] = false;
            $data['retry'] = false;
            $data['isGroup'] = false;
            array_push($kumpulan_data, $data);
            WablasTrait::sendText($kumpulan_data);

            $url = route('order.show', $new->id);

        }

        $button = ($batch->price > 0) ? 'Lakukan Pembayaran!' : 'Cek Pendaftaran!';

        return response()->json(['success' => true, 'url' => $url, 'button' => $button]);


    }

    public function eventCheckoutDoku($id)
    {
        $batch = AcademyBatch::findOrFail($id);

        return view('academy.checkout_doku',[
            'batch' => $batch,
//            'channels' => $this->tripayService->getPaymentChannels(),
        ]);
    }

    public function checkoutDoku(Request $request)
    {
        DB::beginTransaction();
        try {
            $batch = AcademyBatch::findOrFail($request->batch_id);
            if($batch->event->category->slug=='competition'){
                $this->validate($request,[
                    'name' => 'required',
                    'mobile' => 'required',
                    'email' => 'required|email',
                    'institution' => 'required',
                    'code' => 'required',
                    'file' => 'required|file|mimes:pdf|max:2048',
                ]);
            }else{
                $this->validate($request,[
                    'name' => 'required',
                    'mobile' => 'required',
                    'email' => 'required|email',
                    'institution' => 'required',
                    'code' => 'required'
                ]);
            }
            $cek = AcademyPurchase::where([['email', $request->email], ['batch_id', $batch->id], ['status', 'PAID']])->first();
            if($cek){
                return response()->json(['success' => true, 'purchase_id' => $cek->id, 'button' => 'Cek Detail']);
            }
            if($batch->code == ''){
                $inv = IdGenerator::generate(['table' => 'academy_purchases','field'=>'invoice_code', 'length' => 13, 'reset_on_prefix_change'  => true, 'prefix' => 'D-'.date('ym')]);
            }else{
                $inv = IdGenerator::generate(['table' => 'academy_purchases','field'=>'invoice_code', 'length' => 13, 'reset_on_prefix_change'  => true, 'prefix' => $batch->code]);
            }
            $new = new AcademyPurchase;
            $new->email = $request->email;
            $new->name = $request->name;
            $new->mobile_phone = $request->mobile;
            $new->institution = $request->institution;
            $new->batch_id = $batch->id;
            if($batch->event->category->slug=='competition'){
                $file = $request->file('file');
                $filePath = $file->store('competitions', 'public');
                $new->file = $filePath;
            }
            $new->save();
            $diskon = 0;
            $kode_diskon = '-';
            if($batch->price > 0){
                if(!empty($request->diskon_id)){
                    $discount = Discount::where([['id', $request->diskon_id], ['start_date', '<=', date('Y-m-d')], ['end_date', '>=', date('Y-m-d')]])->first();
                    if($discount){
                        $kode_diskon = $discount->code;
                        $diskon = ($discount->type=='rupiah') ? $discount->amount : $batch->price * $discount->amount / 100;
                    }else{
                        $request->session()->flash('alert-error', 'Kode Diskon Tidak Berlaku');
                        return redirect()->back();
                    }
                }

                $total = $batch->price-$diskon;
                $admin = ($request->code=='QRIS') ? ($total*0.7/100)+750 : 5000;

                try {
                    $customerData = [
                        'customer_name' => $request->name,
                        'customer_email' => $request->email,
                        'customer_phone' => $request->mobile,
                        'item_name' => $batch->event->title.' - '.$batch->name,
                        'item_description' => 'Invoice pembayaran transaksi produk '.$batch->event->title.' - '.$batch->name.' untuk user '.$request->name,
                    ];

                    $dokuResponse = $this->dokuService->createCheckout(
                        $inv,
                        (int) $total+$admin,
                        $request->code,
                        $customerData
                    );

                    // Parse payment URL from DOKU response
                    $paymentUrl = null;
                    if (isset($dokuResponse['response']['payment']['url'])) {
                        $paymentUrl = $dokuResponse['response']['payment']['url'];
                    } elseif (isset($dokuResponse['payment']['url'])) {
                        $paymentUrl = $dokuResponse['payment']['url'];
                    } elseif (isset($dokuResponse['url'])) {
                        $paymentUrl = $dokuResponse['url'];
                    }

                    if (!$paymentUrl) {
                        throw new \Exception('Payment URL not found in DOKU response: ' . json_encode($dokuResponse));
                    }

                    $new->nett = $total;
                    $new->discount_code = $kode_diskon;
                    $new->discount_amount = $diskon;
                    $new->status = 'UNPAID';
                    $new->invoice_code = $inv;
                    $new->transaction_code = (string) Str::uuid();
                    $new->amount = $total+$admin;
                    $new->invoice_url = $paymentUrl;
                    $new->save();

                    DB::commit();

                    $url = $paymentUrl;

                } catch (\Exception $e) {
                    // Rollback transaction jika DOKU gagal
                    DB::rollBack();

                    return response()->json(['success' => false, 'message' => $e->getMessage()]);
                }
            }else{
                $new->discount_code = $kode_diskon;
                $new->discount_amount = $diskon;
                $new->status = 'PAID';
                $new->invoice_code = $inv;
                $new->amount = 0;
                $new->nett = 0;
                $new->save();

//            $subject = 'Pendaftaran Anda Berhasil';
//            $message = 'Pendaftaran anda pada course '.$batch->event->title.' telah berhasil, silakan klik tombol dibawah ini untuk gabung ke grup pelatihan.';
//            $link = $batch->link_group;
//            $btn = 'Join Grup';
//            Mail::to($new->email)->send(new ButtonEmail($subject, $message, $new->name, $link, $btn));

                //kirim wa
                $message = "[pesan otomatis]<br>Pendaftaran Anda Berhasil
		    <br>Hai Kak ".$request->name."
		    <br>Selamat! Kami senang untuk memberitahu Anda bahwa pendaftaran Anda pada course ".$batch->event->title." telah berhasil diverifikasi.
            <br>Silakan save no ini terlebih dahulu agar link dapat diakses, kemudian klik link berikut ini untuk bergabung dengan grup WA
            <br>".$batch->link_group;
                $kumpulan_data = [];
                $data['phone'] = $request->mobile;
                $data['message'] = $message;
                $data['secret'] = false;
                $data['retry'] = false;
                $data['isGroup'] = false;
                array_push($kumpulan_data, $data);
                WablasTrait::sendText($kumpulan_data);

                $url = route('order.show', $new->id);

            }

            $button = ($batch->price > 0) ? 'Lakukan Pembayaran!' : 'Cek Pendaftaran!';

            return response()->json(['success' => true, 'url' => $url, 'button' => $button]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function dokuReturn(Request $request)
    {
        $invoiceCode = $request->query('invoice_number')
            ?? $request->query('order_id')
            ?? $request->query('TRANSIDMERCHANT')
            ?? $request->query('invoice_code');

        if (!$invoiceCode) {
            return redirect('/')->with('warning', 'Invoice tidak ditemukan.');
        }

        $invoice = AcademyPurchase::where('invoice_code', $invoiceCode)->first();
        if (!$invoice) {
            return redirect('/')->with('warning', 'Invoice tidak ditemukan.');
        }

        return redirect()->route('order.show', ['order' => $invoice->id]);
    }

    public function partnership() {
        return view('academy.partnership');
    }

    public function partnershipStore(Request $request) {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'subject' => 'required',
            'message' => 'required',
            'captcha' => 'required|captcha',
        ]);

        AcademyMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => nl2br($request->message),
        ]);

        $request->session()->flash('alert-success', 'Pesan berhasil disubmit');
        return redirect()->back();
    }

    public function certificate(Request $request, $code)
    {
        $certificate = Certificate::with('user', 'category')->where('code', $code)->first();
        if($certificate){
            $name = ($certificate->user_id != '') ? $certificate->user->name : $certificate->username;
            $pdf = Pdf::loadview('print.certificate', [
                'data' => $certificate,
            ])->setPaper('a4', 'landscape');
            return $pdf->download('sertifikat-'.$name.'-'.$certificate->code.'.pdf');
        }else{
            $request->session()->flash('alert-danger', 'Sertifikat Tidak Ditemukan');
            return redirect()->back();
        }
    }

    public function certificates(Request $request, $code)
    {
        $certificate = Certificate::with('user', 'category')->where('code', $code)->first();
        return view('academy.certificate',[
            'data' => $certificate,
        ]);
    }

    public function certificateForm(Request $request)
    {
        return view('academy.certificate_check', ['data'=>'form']);
    }

    public function certificateCheck(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email',
            'captcha' => 'required|captcha'
        ]);

        $email = $request->email;
        $certificate = Certificate::whereHas('user', function ($q) use ($email) {
                $q->where('email', $email);
            })->orwhere('email', $email)->orderBy('created_at', 'desc')->get();

        return view('academy.certificate_check',[
            'data' => 'check',
            'certificates' => $certificate,
        ]);
    }

    public function alumni(Request $request)
    {
        $data = Certificate::with('user')->whereNotNull('participant_no')->orderBy('id')->lazy();

        return view('academy.alumni',[
            'data' => $data,
        ]);
    }

    public function terms()
    {
        return view('academy.terms');
    }
}