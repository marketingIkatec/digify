<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class accountLoggedInRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'event' => ['required', 'string', 'in:account_logged_in'],
            'email' => ['sometimes', 'email'],
            'digify_account_id' => ['required', 'string', Rule::exists('accountDigifyHubspot', 'digify_account_id')],
        ];
    }

    public function messages(): array
    {
        return [
            'event.required' => 'O campo event é obrigatório.',
            'event.in'       => 'O evento informado não é válido.',

            'email.required' => 'O campo email é obrigatório.',
            'email.email'    => 'O campo email deve conter um endereço de e-mail válido.',

            'digify_account_id.exists' => 'digify_account_id não encontrado!',
            'digify_account_id.required' => 'O campo digify_account_id é obrigatório.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Erro ao enviar informações para api',
                'errors'  => $validator->errors(),
            ], 422)
        );
    }
}