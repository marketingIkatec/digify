<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadContatoAppRequest extends FormRequest
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
            'empresa'        => 'required|string|max:255',
            'colaboradores'  => 'required|string|max:255',
            'termos'         => 'accepted',
        ];
    }

    /**
     * Mensagens personalizadas de erro.
     */
    public function messages(): array
    {
        return [
            'nome.required'             => 'Por favor, informe seu nome.',
            'nome.string'               => 'O nome deve ser uma sequência de caracteres válida.',
            'nome.min'                  => 'O nome deve ter no mínimo 2 caracteres.',
            'nome.max'                  => 'O nome deve ter no máximo 255 caracteres.',
            'email.required'            => 'Por favor, informe seu e-mail',
            'email.email'               => 'Informe um e-mail válido.',
            'whatsapp.required'         => 'Por favor, informe seu número de WhatsApp.',
            'colaboradores.required'    => 'Selecione uma opção',
            'termos.accepted'           => 'Por favor, aceite os Termos e Condições de Uso.',
            'empresa.required'          => 'Por favor, informe o nome da empresa.',
        ];
    }
}
