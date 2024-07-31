<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SmsService
{
    protected $api_key;
    protected $email;

    public function __construct()
    {
        $this->api_key = config('services.sms_aero.api_key');
        $this->email = config('services.sms_aero.email');
    }

    /**
     * Отправка SMS
     *
     * @param string $phoneNumber Номер телефона
     * @param string $message Текст сообщения
     * @return array|mixed Ответ API
     */

    public function sendSms(string $phoneNumber, string $message)
    {

        $authHeader = 'Basic ' . base64_encode($this->email . ':' . $this->api_key);

        $response = Http::withHeaders([
            'Authorization' => $authHeader,
        ])->post('https://gate.smsaero.ru/v2/sms/send', [
            'number' => $phoneNumber,
            'sign' => 'SMS Aero',
            'text' => $message,
        ]);

        return $response->json();

    }
}
