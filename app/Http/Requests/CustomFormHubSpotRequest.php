<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CorporateEmail;

class CustomFormHubSpotRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            '0-1/firstname'   => 'sometimes|required|string|min:2|max:255',
            '0-1/lastname'    => 'sometimes|required|string|min:2|max:255',
            //'0-1/email'       => 'sometimes|required|email|max:255',
            '0-1/email'          => ['sometimes', 'required', 'email', 'max:255', new CorporateEmail],
            '0-1/mobilephone' => 'sometimes|required|string|max:20',
            '0-2/website'     => 'sometimes|nullable|string|max:255',
            '0-1/pais__mkt____espanhol' => 'sometimes|required|max:255',
            '0-2/name'        => 'sometimes|required|max:255',
            'nao_tem_site'    => 'sometimes|nullable|boolean',
            'termos'          => 'nullable|accepted',
            '0-2/qual_segmento_representa_melhor_seu_negocio' => 'sometimes|required|string',
            '0-1/e_cliente_digify_'    => 'sometimes|required|string',
            '0-1/principal_necessidade' => 'sometimes|required|string',
            '0-1/numemployees'     => 'sometimes|required|string',
        ];
    }
    public function messages(): array
    {
        return [
            '0-1/email.required'        => __('forms.validation_email_required'),
            '0-1/email.email'           => __('forms.validation_email_invalid'),
            '0-1/firstname.required'    => __('forms.validation_name_required'),
            '0-1/firstname.string'      => __('forms.validation_name_string'),
            '0-1/firstname.min'         => __('forms.validation_name_min'),
            '0-1/firstname.max'         => __('forms.validation_name_max'),
            '0-1/lastname.required'     => __('forms.validation_lastname_required'),
            '0-1/lastname.string'       => __('forms.validation_lastname_string'),
            '0-1/lastname.min'          => __('forms.validation_lastname_min'),
            '0-1/lastname.max'          => __('forms.validation_lastname_max'),
            '0-1/mobilephone.required'  => __('forms.validation_whatsapp_required'),
            '0-2/website.required'      => __('forms.validation_url_invalid'),  
            'termos.accepted'           => __('forms.validation_terms_required'),
            '0-2/qual_segmento_representa_melhor_seu_negocio.required' => __('forms.validation_segment_required'),
            '0-2/name.required'         => __('forms.validation_company_required'),
            '0-1/pais__mkt____espanhol.required'    => __('forms.validation_pais_required'),
            '0-1/e_cliente_digify_.required' => __('forms.select_option'),
            '0-1/principal_necessidade.required' => __('forms.select_option'),
            '0-1/numemployees.required' => __('forms.validation_required'),
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if($this->exists('0-2/website') && $this->input('nao_tem_site') == false && !$this->filled('0-2/website')) {
                $validator->errors()->add('0-2/website', __('forms.validation_website_required'));
            }
            if ($this->has('termos') && !$this->boolean('termos')) {
                $validator->errors()->add('termos', __('forms.validation_terms_required'));
            }
        });
    }
}
