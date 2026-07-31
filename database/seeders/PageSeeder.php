<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'id' => 1,
                'page_id' => 0,
                'titulo' => 'Weuny — One Corporate Center',
                'descricao' => 'A infraestrutura interna que sua operação precisa para escalar com clareza e controle.',
                'slug' => 'index',
                'meta_title' => 'Weuny — One Corporate Center',
                'meta_description' => 'A infraestrutura interna que sua operação precisa para escalar com clareza e controle.',
                'meta_keywords' => null,
                'locale' => 'pt',
                'css_app' => 1,
                'header_footer' => 1,
                'svg' => null,
                'imagem' => null,
                'ordem' => 0,
                'status' => 1,
            ],
            [
                'id' => 2,
                'page_id' => 1,
                'titulo' => 'Política de Privacidade',
                'descricao' => 'A infraestrutura interna que sua operação precisa para escalar com clareza e controle.',
                'slug' => 'politica-de-privacidade',
                'meta_title' => 'Weuny - Política de Privacidade',
                'meta_description' => 'A infraestrutura interna que sua operação precisa para escalar com clareza e controle.',
                'meta_keywords' => null,
                'locale' => 'pt',
                'css_app' => 1,
                'header_footer' => 1,
                'svg' => null,
                'imagem' => null,
                'ordem' => 0,
                'status' => 1,
            ],
            [
                'id' => 3,
                'page_id' => 1,
                'titulo' => 'Termos de Uso',
                'descricao' => 'A infraestrutura interna que sua operação precisa para escalar com clareza e controle.',
                'slug' => 'termos-uso',
                'meta_title' => 'Weuny - Termos de Uso',
                'meta_description' => 'A infraestrutura interna que sua operação precisa para escalar com clareza e controle.',
                'meta_keywords' => null,
                'locale' => 'pt',
                'css_app' => 1,
                'header_footer' => 1,
                'svg' => null,
                'imagem' => null,
                'ordem' => 0,
                'status' => 1,
            ],
            [
                'id' => 4,
                'page_id' => 1,
                'titulo' => 'Política de Cookies',
                'descricao' => 'A infraestrutura interna que sua operação precisa para escalar com clareza e controle.',
                'slug' => 'politica-cookies',
                'meta_title' => 'Weuny - Política de Cookies',
                'meta_description' => 'A infraestrutura interna que sua operação precisa para escalar com clareza e controle.',
                'meta_keywords' => null,
                'locale' => 'pt',
                'css_app' => 1,
                'header_footer' => 1,
                'svg' => null,
                'imagem' => null,
                'ordem' => 0,
                'status' => 1,
            ],
            [
                'id' => 5,
                'page_id' => 1,
                'titulo' => 'Aviso LGPD',
                'descricao' => 'A infraestrutura interna que sua operação precisa para escalar com clareza e controle.',
                'slug' => 'aviso-lgpd',
                'meta_title' => 'Weuny - Aviso LGPD',
                'meta_description' => 'A infraestrutura interna que sua operação precisa para escalar com clareza e controle.',
                'meta_keywords' => null,
                'locale' => 'pt',
                'css_app' => 1,
                'header_footer' => 1,
                'svg' => null,
                'imagem' => null,
                'ordem' => 0,
                'status' => 1,
            ],
        ];


        foreach ($pages as $page) {
            Page::updateOrCreate($page);
        }
    }
}
