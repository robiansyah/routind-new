<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

//import model Donation
use App\Models\AcademyPurchase;
use App\Models\Purchase;
use App\Models\User;

//import Xendit
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;

//import Http Request
use Illuminate\Http\Request;

//Wablas
use Fonnte;
use Illuminate\Support\Facades\Log;

class CallbackController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    function __construct()
    {
        Configuration::setXenditKey(config('xendit.API_KEY'));
    }

    public function index(Request $request)
    {
        //init invoice api from xendit
        $apiInstance = new InvoiceApi();

        //get invoice by id
        $getInvoice  = $apiInstance->getInvoiceById($request->id);

        // Get data donation by external id
        $purchase = AcademyPurchase::where([['transaction_code', $request->external_id]])->first();
        if(!$purchase){
            $purchase = Purchase::where([['transaction_code', $request->external_id]])->first();
        }

        // Update status payment on database
        switch ($getInvoice['status']) {
            case 'PAID':
            case 'SETTLED':

                $purchase->update(['status' => 'PAID']);
                if(substr($purchase->invoice_code,0,3)=='INV') {
                    $days = ($purchase->paket == "premium") ? "+30 days" : "+180 days";
                    $user = User::findOrFail($purchase->user_id);
                    $user->update([
                        'paket' => $purchase->paket,
                        'end_date' => date("Y-m-d", strtotime($days)),
                    ]);

                    $sub = substr($user->mobile_phone, 0, 2);
                    $phone = ($sub=='+6' || $sub=='62' || $sub=='08') ? $user->mobile_phone : '62'.$user->mobile_phone;
                    $messages = "[pesan otomatis]
Pembelian Anda Berhasil

Hai Kak ".$user->name."

Selamat! Kami senang untuk memberitahu Anda bahwa pembelian Anda telah berhasil diverifikasi.

Silahkan masuk ke akun anda untuk menikmati fitur-fitur yang tersedia dalam paket tersebut.";
                    Fonnte::sendMessage($phone, $messages);

                }else{
                    //wa
                    $sub = substr($purchase->mobile_phone, 0, 2);
                    $phone = ($sub=='+6' || $sub=='62' || $sub=='08') ? $purchase->mobile_phone : '62'.$purchase->mobile_phone;
                    $messages = "[pesan otomatis]
Pembelian Anda Berhasil

Hai Kak ".$purchase->name."

Selamat! Kami senang untuk memberitahu Anda bahwa pembelian Anda pada course ".$purchase->batch->event->title." telah berhasil diverifikasi.

Silakan save no ini terlebih dahulu agar link dapat diakses, kemudian klik link berikut ini untuk bergabung dengan grup WA

".$purchase->batch->link_group;
                    Fonnte::sendMessage($phone, $messages);
                }

                break;

            case 'EXPIRED':
            case 'FAILED':
                $purchase->update(['status' => 'FAILED']);
                break;

            default:
                return response()->json([
                    'success' => false,
                    'message' => 'Unrecognized payment status',
                ]);
        }

        //return json
        return response()->json(['data' => 'Success']);
    }

    public function callbackDoku(Request $request)
    {
        try{
            $invoiceCode =
                $request->input('TRANSIDMERCHANT')
                ?? $request->input('invoice_number')
                ?? data_get($request->all(), 'order.invoice_number')
                ?? data_get($request->all(), 'response.order.invoice_number');

            $statusRaw =
                $request->input('RESULTMSG')
                ?? $request->input('status')
                ?? data_get($request->all(), 'transaction.status');
            $status = strtoupper($statusRaw ?? '');

            $amount =
                $request->input('AMOUNT')
                ?? data_get($request->all(), 'order.amount')
                ?? data_get($request->all(), 'transaction.amount');

            $channel =
                $request->input('PAYMENTCHANNEL')
                ?? data_get($request->all(), 'payment.channel')
                ?? data_get($request->all(), 'transaction.payment_method.code')
                ?? data_get($request->all(), 'channel.id')
                ?? 'DOKU';

            $purchase = AcademyPurchase::where([['invoice_code', $invoiceCode]])->first();
            if(!$purchase){
                $purchase = Purchase::where([['invoice_code', $invoiceCode]])->first();
            }
            switch ($status) {
                case 'PAID':
                case 'SUCCESS';
                case 'COMPLETED';
                $purchase->update(['status' => 'PAID']);
                if(substr($purchase->invoice_code,0,3)=='INV') {
                    $days = ($purchase->paket == "premium") ? "+30 days" : "+180 days";
                    $user = User::findOrFail($purchase->user_id);
                    $user->update([
                        'paket' => $purchase->paket,
                        'end_date' => date("Y-m-d", strtotime($days)),
                    ]);

                    $sub = substr($user->mobile_phone, 0, 2);
                    $phone = ($sub=='+6' || $sub=='62' || $sub=='08') ? $user->mobile_phone : '62'.$user->mobile_phone;
                    $messages = "[pesan otomatis]
Pembelian Anda Berhasil

Hai Kak ".$user->name."

Selamat! Kami senang untuk memberitahu Anda bahwa pembelian Anda telah berhasil diverifikasi.

Silahkan masuk ke akun anda untuk menikmati fitur-fitur yang tersedia dalam paket tersebut.";
                    Fonnte::sendMessage($phone, $messages);

                }else{
                    //wa
                    $sub = substr($purchase->mobile_phone, 0, 2);
                    $phone = ($sub=='+6' || $sub=='62' || $sub=='08') ? $purchase->mobile_phone : '62'.$purchase->mobile_phone;
                    $messages = "[pesan otomatis]
Pembelian Anda Berhasil

Hai Kak ".$purchase->name."

Selamat! Kami senang untuk memberitahu Anda bahwa pembelian Anda pada course ".$purchase->batch->event->title." telah berhasil diverifikasi.

Silakan save no ini terlebih dahulu agar link dapat diakses, kemudian klik link berikut ini untuk bergabung dengan grup WA

".$purchase->batch->link_group;
                    Fonnte::sendMessage($phone, $messages);
                }

                break;

                case 'EXPIRED':
                case 'FAILED':
                    $purchase->update(['status' => 'FAILED']);
                    break;

                default:
                    Log::info("Unrecognized payment status");
                    return Response::json([
                        'success' => false,
                        'message' => 'Unrecognized payment status',
                    ]);
            }

            Log::info("Payment updated for Invoice: $invoiceCode");
            //return json
            return response()->json(['data' => 'Success']);

        }catch (\Exception $e){
            Log::error('DOKU Callback Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response('ERROR', 500);
        }
    }
}