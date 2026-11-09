<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DokuService
{
    private $clientId;
    private $secretKey;
    private $sandbox;

    public function __construct()
    {
        $this->clientId = config('services.doku.client_id');
        $this->secretKey = config('services.doku.secret_key');
        $this->sandbox = config('services.doku.sandbox', true);
    }

    private function sanitizeForDoku(string $value): string
    {
        // Normalize whitespace
        $value = preg_replace('/\s+/', ' ', $value);

        // Replace common disallowed tokens
        $replacements = [
            '&' => 'dan',
            '“' => '"',
            '”' => '"',
            '‘' => "'",
            '’' => "'",
        ];
        $value = strtr($value, $replacements);

        // Strip any character not in the allowed set
        // Allowed: letters, digits, space, . - / + , = _ : ' @ %
        $value = preg_replace("/[^a-zA-Z0-9 \.\-\/\+\,\=\_\:\'@%]/", '', $value);

        // Trim to safe length if needed (DOKU may limit length; keep it reasonable)
        return trim(substr($value, 0, 255));
    }

    public function createCheckout($orderId, $amount, $method, $customerData = [])
    {
        try {
            $url = $this->sandbox
                ? "https://api-sandbox.doku.com/checkout/v1/payment"
                : "https://api.doku.com/checkout/v1/payment";

            $path = "/checkout/v1/payment";
            $requestId = uniqid();
            $requestTimestamp = gmdate("Y-m-d\TH:i:s\Z");

            $customerId = $customerData['customer_id'] ?? 'CUST-' . time();
            $customerName = $customerData['customer_name'] ?? 'Customer';
            $customerEmail = $customerData['customer_email'] ?? 'customer@example.com';
            $customerPhone = $customerData['customer_phone'] ?? null;
            $itemName = $this->sanitizeForDoku($customerData['item_name'] ?? 'Product');
            $itemDescription = $this->sanitizeForDoku($customerData['item_description'] ?? 'Product Purchase');

            $body = [
                "order" => [
                    "invoice_number" => $orderId,
                    "amount" => $amount,
                    "currency" => "IDR",
                    "callback_url" => route('doku.callback.web', ['invoice_number' => $orderId], true),
                    "callback_url_cancel" => route('doku.callback.web', ['invoice_number' => $orderId], true),
                ],
                "payment" => [
                    "payment_due_date" => 60,
                    "payment_method_types" => [
                        $method
                    ]
                ],
                "customer" => [
                    "id" => $customerId,
                    "name" => $customerName,
                    "email" => $customerEmail
                ]
            ];

            if ($customerPhone) {
                $body['customer']['phone'] = $customerPhone;
            }

            if ($itemName || $itemDescription) {
                $body['order']['line_items'] = [
                    [
                        "name" => $itemName,
                        "description" => $itemDescription,
                        "quantity" => 1,
                        "price" => $amount
                    ]
                ];
            }

            $digest = base64_encode(hash('sha256', json_encode($body), true));

            $componentSignature = "Client-Id:" . $this->clientId . "\n" .
                "Request-Id:" . $requestId . "\n" .
                "Request-Timestamp:" . $requestTimestamp . "\n" .
                "Request-Target:" . $path . "\n" .
                "Digest:" . $digest;

            $signature = base64_encode(hash_hmac('sha256', $componentSignature, $this->secretKey, true));

            $response = Http::withHeaders([
                "Client-Id" => $this->clientId,
                "Request-Id" => $requestId,
                "Request-Timestamp" => $requestTimestamp,
                "Signature" => "HMACSHA256=" . $signature,
                "Content-Type" => "application/json"
            ])->post($url, $body);

            $responseData = $response->json();

            if (!$response->successful()) {
                throw new \Exception('DOKU API error: ' . $response->status() . ' - ' . json_encode($responseData));
            }

            return $responseData;
        } catch (\Exception $e) {
            Log::error('DOKU Service Error', [
                'message' => $e->getMessage(),
                'order_id' => $orderId
            ]);
            throw $e;
        }
    }

    /**
     * Whether a payment notification really comes from DOKU.
     *
     * DOKU signs notifications the same way we sign requests to it: HMAC-SHA256 over
     * Client-Id, Request-Id, Request-Timestamp, Request-Target (our notification path)
     * and a SHA-256 digest of the raw body, keyed with our secret key.
     */
    public function verifyCallback(Request $request): bool
    {
        $clientId = (string) $request->header('Client-Id');
        $requestId = (string) $request->header('Request-Id');
        $timestamp = (string) $request->header('Request-Timestamp');
        $signature = (string) $request->header('Signature');

        if ($clientId === '' || $requestId === '' || $timestamp === '' || $signature === ''
            || empty($this->clientId) || empty($this->secretKey)) {
            return false;
        }

        if (! hash_equals((string) $this->clientId, $clientId)) {
            return false;
        }

        $digest = base64_encode(hash('sha256', $request->getContent(), true));
        $target = parse_url($request->getRequestUri(), PHP_URL_PATH);

        $componentSignature = "Client-Id:".$clientId."\n".
            "Request-Id:".$requestId."\n".
            "Request-Timestamp:".$timestamp."\n".
            "Request-Target:".$target."\n".
            "Digest:".$digest;

        $expected = 'HMACSHA256='.base64_encode(hash_hmac('sha256', $componentSignature, $this->secretKey, true));

        return hash_equals($expected, $signature);
    }

    /**
     * Cancel invoice (if DOKU supports it)
     */
    public function cancelInvoice($invoiceCode)
    {
        // Implementation depends on DOKU's cancel invoice API
        // This is a placeholder for cancel invoice logic
        return true;
    }
}
