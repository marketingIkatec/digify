<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog;
use App\Models\BlogCategoria;
use App\Models\BlogAutor;
use App\Models\NaMidia;
use App\Models\Page;

class UploadService
{
    public function uploadImagem(?UploadedFile $file, $model, &$data)
    {
        if(!$file){
            return;
        }
        $pasta = 'blogs';
        switch($model){
            case Blog::class:
                $imagem_name = \Str::slug($data['titulo']);        
                $objExistente = Blog::find($data['id'] ?? null);
                break;
            case BlogCategoria::class:
                $imagem_name = \Str::slug($data['categoria']);
                $objExistente = BlogCategoria::find($data['id'] ?? null);
                break;
            case BlogAutor::class:
                $imagem_name = \Str::slug($data['autor']);
                $objExistente = BlogAutor::find($data['id'] ?? null);
                break;  
            case Page::class:
                $imagem_name = \Str::slug($data['titulo']);
                $objExistente = Page::find($data['id'] ?? null);
                $pasta = 'site/'.$imagem_name;
                break;
            case NaMidia::class:
                $imagem_name = \Str::slug($data['title']);
                $objExistente = NaMidia::find($data['id'] ?? null);
                $pasta = 'na-midia/'.$imagem_name;
                break;
            default:
                $imagem_name = 'imagem';
                $objExistente = null;
        }

       if ($objExistente && $objExistente->imagem && Storage::disk('public')->exists($objExistente->imagem)) {
            Storage::disk('public')->delete($objExistente->imagem);
        }
            
        $extensao = $file->getClientOriginalExtension();
        $nomeArquivo = $imagem_name . '.' . $extensao;

        $data['imagem'] = $file->storeAs($pasta, $nomeArquivo, 'public');
    }

    public function deletarImage(string $filePath): void
    {
        Storage::disk('public')->delete($filePath);
    }
}
