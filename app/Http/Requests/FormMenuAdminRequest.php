<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormMenuAdminRequest extends FormRequest
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
            'menu'  => 'required|string',
            'route' => 'required|string',
        ];
    }
    public function messages(): array
    {
        return [
            'menu.required' => 'Por favor, digite o nome do Menu.',
            'route.required' => 'Por favor, digite a rota do Menu.',
        ];
    }
}
