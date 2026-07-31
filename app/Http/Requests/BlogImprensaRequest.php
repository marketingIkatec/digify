<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogImprensaRequest extends FormRequest
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
            'imprensa'  => 'required|string|unique:blogImprensa,imprensa,' . $this->id,
            'url'    => 'unique:blogImprensa,url,' . $this->id,
            'imagem' => 'nullable|image|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            'imprensa.required' => 'Por favor, digite o nome da imprensa.',
            'imprensa.unique'   => 'O nome da imprensa já está em uso. Por favor, escolha outro nome.',
            'url.unique'     => 'A url já está em uso. Por favor, escolha outra url.',
            'imagem.image'       => 'O arquivo enviado não é uma imagem válida.',
            'imagem.max'         => 'A imagem não deve ser maior que 2MB.',
        ];
    }
}
