<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'titulo'    => 'required|string|unique:blogs,titulo,' . $this->id,
            'slug'       => 'unique:blogs,slug,' . $this->id,
            'autor_id'  => 'required|exists:blogsAutor,id',
            'data_blog' => 'required|date',
            'imagem'    => 'nullable|image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required'    => 'Por favor, digite o título do blog.',
            'titulo.unique'      => 'O título do blog já está em uso.',
            'autor_id.required'  => 'Por favor, selecione o autor do blog.',
            'autor_id.exists'    => 'O autor selecionado não existe.',
            'slug.unique'         => 'O slug já está em uso.',
            'data_blog.required' => 'A data de pulicação é obrigatório.',
            'data_blog.date'     => 'A data de publicação não é válida.',
            'imagem.image'       => 'O arquivo enviado não é uma imagem válida.',
            'imagem.max'         => 'A imagem não deve ser maior que 2MB.',
        ];
    }
}
