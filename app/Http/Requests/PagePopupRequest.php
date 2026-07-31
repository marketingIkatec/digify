<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagePopupRequest extends FormRequest
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
            'nome'   => 'required|string|unique:pagePopups,nome,' . $this->id,
            'popup'  => 'required|string|unique:pagePopups,popup,' . $this->id,
            'tipo'   => 'required|string|max:255', 
        ];
    }
    public function messages(): array
    {
        return [
            'nome.required' => 'Por favor, digite o nome do popup.',
            'nome.unique'   => 'O nome do popup já está em uso. Por favor, escolha outro nome.',
            'popup.required' => 'Por favor, digite o id do popup.',
            'popup.unique'   => 'O id do popup já está em uso. Por favor, escolha outro id.',
            'tipo.required'  => 'Por favor, selecione o tipo do popup.',            
        ];
    }
}
