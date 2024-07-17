<?php

namespace App\Traits;

trait PhoneNormalizerTrait
{
    protected function normalizePhoneNumber($phone)
    {
        $digits = preg_replace('/\D/', '', $phone);

        if (substr($digits, 0, 1) == '8') {
            $digits = '7' . substr($digits, 1);
        } elseif (substr($digits, 0, 1) == '7') {
            // Ничего не делаем, номер уже начинается с '7'
        } else {
            return null;
        }
        return '+7' . substr($digits, 1);
    }
}
