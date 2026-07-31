<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageBlockRequest extends FormRequest
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
            'page_id'                    => 'required|exists:page,id',
            'tipo_bloco'                 => 'required|string|max:255',   
            'titulo'                     => 'nullable|string|max:255|required_without_all:conteudo,subtitulo2',
            'conteudo'                   => 'nullable|string|required_without_all:titulo,subtitulo2',
            'subtitulo2'                 => 'nullable|string|max:255|required_without_all:titulo,conteudo',
            'configuracao.cards.*.image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            'page_id.required'                 => 'Pagina não encontrada!',
            'tipo_bloco.required'              => 'Por favor, selecione o tipo da dobra.',
            'titulo.required_without_all'      => 'Informe o título, subtitulo2 ou o conteúdo.',
            'conteudo.required_without_all'    => 'Informe o título, subtitulo2 ou o conteúdo.',
            'subtitulo2.required_without_all'  => 'Informe o título, subtitulo2 ou o conteúdo.',
            'configuracao.cards.*.image.image' => 'O arquivo selecionado para o carddeve ser uma imagem.',
            'configuracao.cards.*.image.mimes' => 'A imagem do card deve ser um arquivo do tipo: jpg, jpeg, png, svg, webp.',
            'configuracao.cards.*.image.max'   => 'A imagem do card não deve ser maior que 2MB.',
        ];
    }
}
