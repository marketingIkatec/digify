<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCategoriaRequest extends FormRequest
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
            'categoria' => 'required|string|unique:blogsCategoria,categoria,' . $this->id,
            'slug'       => 'unique:blogsCategoria,slug,' . $this->id,
            'imagem'    => 'nullable|image|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            'categoria.required' => 'Por favor, digite o nome da categoria.',
            'categoria.unique'   => 'O nome da categoria já está em uso. Por favor, escolha outro nome.',
            'slug.unique'         => 'A slug já está em uso. Por favor, escolha outro slug.',
            'imagem.image'       => 'O arquivo enviado não é uma imagem válida.',
            'imagem.max'         => 'A imagem não deve ser maior que 2MB.',
        ];
    }
}
