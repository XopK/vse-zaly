<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class UniquePhonePartnerRequest implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $existsInUsers = DB::table('users')->where('phone', $value)->exists();

        $existsInPartnerRequests = DB::table('partner_requests')->where('phone', $value)->exists();

        if ($existsInUsers || $existsInPartnerRequests) {
            $fail('Пользователь с таким номером телефона уже зарегистрирован');
        }
    }
}
