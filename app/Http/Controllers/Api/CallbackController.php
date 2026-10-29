<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AcademyPurchase;
use App\Services\DokuService;
use Fonnte;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class CallbackController extends Controller
{
    /**
     * DOKU Checkout payment notification.
     *
     * Only requests signed with our DOKU secret key are trusted, and an invoice is
     * marked paid only once, only while it is still UNPAID, and only when the paid
     * amount matches what we billed.
     */
    public function callbackDoku(Request $request, DokuService $doku): JsonResponse
    {
        if (! $doku->verifyCallback($request)) {
            Log::warning('DOKU callback rejected: invalid signature', ['ip' => $request->ip()]);

            return response()->json(['message' => 'Invalid signature'], 401);
        }

        $invoiceCode = (string) data_get($request->all(), 'order.invoice_number');
        $amount = data_get($request->all(), 'order.amount');
        $status = strtoupper((string) data_get($request->all(), 'transaction.status'));

        $purchase = AcademyPurchase::where('invoice_code', $invoiceCode)->first();

        if (! $purchase) {
            Log::warning('DOKU callback for unknown invoice', ['invoice' => $invoiceCode]);

            return response()->json(['message' => 'Invoice not found'], 404);
        }

        if ($purchase->status !== 'UNPAID') {
            return response()->json(['message' => 'Already processed']);
        }

        switch ($status) {
            case 'SUCCESS':
            case 'PAID':
            case 'COMPLETED':
                if ((int) round((float) $amount) !== (int) round((float) $purchase->amount)) {
                    Log::warning('DOKU callback amount mismatch', [
                        'invoice' => $invoiceCode,
                        'billed' => $purchase->amount,
                        'paid' => $amount,
                    ]);

                    return response()->json(['message' => 'Amount mismatch'], 422);
                }

                // Atomic, so a notification DOKU sends twice cannot pay (and notify) twice.
                if ($this->moveFromUnpaid($purchase, 'PAID')) {
                    $this->notifyPaid($purchase);
                }
                break;

            case 'FAILED':
            case 'EXPIRED':
                $this->moveFromUnpaid($purchase, 'FAILED');
                break;

            default:
                Log::info('DOKU callback with unhandled status', ['invoice' => $invoiceCode, 'status' => $status]);

                return response()->json(['message' => 'Unrecognized payment status']);
        }

        Log::info("DOKU payment updated for invoice: {$invoiceCode}", ['status' => $status]);

        return response()->json(['data' => 'Success']);
    }

    /**
     * Change the status only if the purchase is still UNPAID. Returns whether it changed.
     */
    private function moveFromUnpaid(AcademyPurchase $purchase, string $status): bool
    {
        return AcademyPurchase::whereKey($purchase->getKey())
            ->where('status', 'UNPAID')
            ->update(['status' => $status]) === 1;
    }

    /**
     * WhatsApp the buyer the course group link. A failed message must not fail the payment.
     */
    private function notifyPaid(AcademyPurchase $purchase): void
    {
        try {
            $sub = substr($purchase->mobile_phone, 0, 2);
            $phone = ($sub == '+6' || $sub == '62' || $sub == '08') ? $purchase->mobile_phone : '62'.$purchase->mobile_phone;
            $messages = "[pesan otomatis]
Pembelian Anda Berhasil

Hai Kak ".$purchase->name."

Selamat! Kami senang untuk memberitahu Anda bahwa pembelian Anda pada course ".$purchase->batch->event->title." telah berhasil diverifikasi.

Silakan save no ini terlebih dahulu agar link dapat diakses, kemudian klik link berikut ini untuk bergabung dengan grup WA

".$purchase->batch->link_group;
            Fonnte::sendMessage($phone, $messages);
        } catch (Throwable $e) {
            report($e);
        }
    }
}
