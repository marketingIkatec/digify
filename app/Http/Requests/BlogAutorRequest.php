<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogAutorRequest extends FormRequest
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
            'autor'  => 'required|string|unique:blogsAutor,autor,' . $this->id,
            'slug'    => 'unique:blogsAutor,slug,' . $this->id,
            'imagem' => 'nullable|image|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            'autor.required' => 'Por favor, digite o nome do autor.',
            'autor.unique'   => 'O nome do autor já está em uso. Por favor, escolha outro nome.',
            'slug.unique'     => 'A slug já está em uso. Por favor, escolha outro slug.',
            'imagem.image'       => 'O arquivo enviado não é uma imagem válida.',
            'imagem.max'         => 'A imagem não deve ser maior que 2MB.',
        ];
    }
}
