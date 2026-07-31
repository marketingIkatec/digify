<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'titulo'     => 'required|string',
            'slug'       => 'unique:page,slug,' . $this->id,
        ];
    }
    public function messages(): array
    {
        return [
            'titulo.required' => 'Por favor, digite o título da página.',
            'slug.unique'     => 'O slug já está em uso. Por favor, escolha outro slug.',
        ];
    }
}
