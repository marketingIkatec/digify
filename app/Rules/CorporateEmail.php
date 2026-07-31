<?php
namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\FormHubSpot;

class CorporateEmail implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Só valida se for whatsapp-commercial
        if (request('form_type')) {
            $formHubSpot = FormHubSpot::where(['form_name' => request('form_type')])->first();
            if(!empty($formHubSpot) and !$formHubSpot['form_corporate_email']){
                return;
            }                
        }

        $blockedDomains = [
            'gmail.com',
            'hotmail.com',
            'outlook.com',
            'yahoo.com',
            'live.com',
            'icloud.com',
        ];

        $domain = substr(strrchr($value, "@"), 1);

        if (in_array(strtolower($domain), $blockedDomains)) {
            $fail(__('forms.validation_corporate_email_required'));
        }
    }
}