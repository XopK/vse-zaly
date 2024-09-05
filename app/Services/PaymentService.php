<?php

namespace App\Services;

use http\Client;
use Illuminate\Support\Facades\Http;

class PaymentService
{
    protected $terminalKey;
    protected $secretKey;

    public function __construct()
    {
        $this->terminalKey = config('services.tinkoff.terminal_key');
        $this->secretKey = config('services.tinkoff.secret_key');
    }

    public function generateToken($data)
    {
        if (isset($data['Token'])) {
            unset($data['Token']);
        }

        $data['Password'] = $this->secretKey;

        ksort($data);

        $dataString = implode('', array_values($data));

        return hash('sha256', $dataString);
    }

    public function makePayment($amount, $orderId, $description)
    {

        $data = [
            'TerminalKey' => $this->terminalKey,
            'Amount' => $amount * 100,
            'OrderId' => $orderId,
            'Description' => $description,
            'SuccessURL' => route('payment.successful'),
            'FailURL' => route('payment.failed'),
        ];
        $data['Token'] = $this->generateToken($data);
        try {
            $response = Http::post('https://securepay.tinkoff.ru/v2/Init', $data);

            if ($response->successful()) {
                $body = $response->json();
                if ($body['Success']) {
                    return $body['PaymentURL'];
                } else {
                    return null;
                }
            } else {
                return null;
            }
        } catch (\Exception $e) {
            return null;
        }
    }


}
