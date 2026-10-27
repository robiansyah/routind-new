<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Purchase;
use App\Models\AcademyPurchase;
use App\Models\User;

use App\Mail\ButtonEmail;
use App\Mail\AcademyEmail;
use Illuminate\Support\Facades\Mail;

class TripayCallbackController extends Controller
{
    // Isi dengan private key anda
    protected $privateKey = 'zgXix-bPhM8-fG0T1-2BZCH-cjTQC';

    public function handle(Request $request)
    {
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $json = $request->getContent();
        $signature = hash_hmac('sha256', $json, $this->privateKey);

        if ($signature !== (string) $callbackSignature) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid signature',
            ]);
        }

        if ('payment_status' !== (string) $request->server('HTTP_X_CALLBACK_EVENT')) {
            return Response::json([
                'success' => false,
                'message' => 'Unrecognized callback event, no action was taken',
            ]);
        }

        $data = json_decode($json);

        if (JSON_ERROR_NONE !== json_last_error()) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid data sent by tripay',
            ]);
        }

        $invoice_code = $data->merchant_ref;
        $tripayReference = $data->reference;
        $status = strtoupper((string) $data->status);

        if ($data->is_closed_payment === 1) {
            if(substr($invoice_code,0,3)=='INV') {
                $purchase = Purchase::where('invoice_code', $invoice_code)
                    ->where('transaction_code', $tripayReference)
                    ->where('status', '=', 'UNPAID')
                    ->first();

                if (! $purchase) {
                    return Response::json([
                        'success' => false,
                        'message' => 'No invoice found or already paid: ' . $invoice_code,
                    ]);
                }

                switch ($status) {
                    case 'PAID':
                        $purchase->update(['status' => 'PAID']);
                        $days = ($purchase->paket=="premium") ? "+30 days" : "+180 days";
                        $user = User::findOrFail($purchase->user_id);
                        $user->update([
                            'paket' => $purchase->paket,
                            'end_date' => date("Y-m-d", strtotime($days)),
                        ]);
                        $body = "Selamat pembelian anda berhasil.";
                        $body .="<br>Silahkan masuk ke akun anda untuk menikmati fitur-fitur yang tersedia dalam paket tersebut.";

                        $messages = [
                            'subject' => 'Pembelian Anda Berhasil',
                            'greeting' => 'Hi '.$user->name.',',
                            'body' => $body,
                            'thanks' => 'Terima kasih telah menyelesaikan pembayaran Anda.',
                        ];

                        $user->notify(new EmailNotification($messages));
                        break;

                    case 'EXPIRED':
                    case 'FAILED':
                        $purchase->update(['status' => 'FAILED']);
                        break;

                    default:
                        return Response::json([
                            'success' => false,
                            'message' => 'Unrecognized payment status',
                        ]);
                }
            }else{
                $purchase = AcademyPurchase::where('invoice_code', $invoice_code)
                    ->where('transaction_code', $tripayReference)
                    ->where('status', '=', 'UNPAID')
                    ->first();

                if (! $purchase) {
                    return Response::json([
                        'success' => false,
                        'message' => 'No invoice found or already paid: ' . $invoice_code,
                    ]);
                }

                switch ($status) {
                    case 'PAID':
                        $purchase->update(['status' => 'PAID']);

                        $subject = 'Pembelian Anda Berhasil';
                        $message = 'Pembelian anda pada course '.$purchase->batch->event->name.' telah berhasil, silakan klik tombol dibawah ini untuk gabung ke grup pelatihan.';
                        $link = $purchase->batch->link_group;
                        $btn = 'Join Grup';
                        Mail::to($purchase->email)->send(new ButtonEmail($subject, $message, $purchase->name, $link, $btn));
                        break;

                    case 'EXPIRED':
                    case 'FAILED':
                        $purchase->update(['status' => 'FAILED']);
                        break;

                    default:
                        return Response::json([
                            'success' => false,
                            'message' => 'Unrecognized payment status',
                        ]);
                }
            }

            return Response::json(['success' => true]);
        }
    }
}
