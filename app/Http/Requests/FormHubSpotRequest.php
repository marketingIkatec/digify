<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormHubSpotRequest extends FormRequest
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
            'form_name'  => 'required|string|unique:formHubSpot,form_name,' . $this->id,
            'name'  => 'required|string|unique:formHubSpot,name,' . $this->id,
        ];
    }
    public function messages(): array
    {
        return [
            'form_name.required' => 'Por favor, digite o nome do formulário.',
            'form_name.unique'   => 'O nome do formulário já está em uso. Por favor, escolha outro nome.',
            'name.required' => 'Por favor, digite o nome de identificação do formulário.',
            'name.unique'   => 'O nome de identificação do formulário já está em uso. Por favor, escolha outro nome.',
        ];
    }
}
