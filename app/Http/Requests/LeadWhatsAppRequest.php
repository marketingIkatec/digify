<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadWhatsAppRequest extends FormRequest
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
            'nome'           => 'required|string|min:2|max:255',
            'email'          => 'required|email|max:255',
            'whatsapp'       => 'required|string|max:20',
            'url'            => 'nullable|string|max:255',
            'nao_tem_site'   => 'nullable|boolean',
            //'voce_e_cliente' => 'sometimes|required|string|max:255',
            'mensagem'       => 'sometimes|required',
            'necessidade'    => 'sometimes|required',
            'qual_segmento_representa_melhor_seu_negocio' => 'sometimes|required|string',
            'termos'         => 'accepted',
            
        ];
    }

    /**
     * Mensagens personalizadas de erro.
     */
    public function messages(): array
    {
        return [
            'nome.required'             => __('forms.validation_name_required'),
            'nome.string'               => __('forms.validation_name_string'),
            'nome.min'                  => __('forms.validation_name_min'),
            'nome.max'                  => __('forms.validation_name_max'),
            'email.required'            => __('forms.validation_email_required'),
            'email.email'               => __('forms.validation_email_invalid'),
            'whatsapp.required'         => __('forms.validation_whatsapp_required'),
            'url.required'              => __('forms.validation_url_invalid'),    
            'mensagem.required'         => __('forms.validation_required'),
            //'voce_e_cliente.required'   => __('forms.validation_required'),
            'necessidade.required'      => __('forms.validation_necessidade_required'),
            'termos.accepted'           => __('forms.validation_terms_required'),
            'qual_segmento_representa_melhor_seu_negocio.required' => __('forms.validation_segment_required'),
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if($this->input('form_type') === 'whatsapp-commercial' && $this->input('nao_tem_site') == false && !$this->filled('url')) {
                $validator->errors()->add('url', __('forms.validation_website_required'));
            }else if (($this->input('form_type') === 'whatsapp-support' || $this->input('form_type') === 'email-support') && !str_contains($this->input('url'), 'digify.')) {
                $validator->errors()->add('url', __('forms.validation_digify_url_invalid'));
            }
        });
    }
}
