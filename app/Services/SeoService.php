<?php

namespace App\Services;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Models\Blog;
use App\Models\BlogAutor;
use App\Models\BlogCategoria;

class SeoService
{
    public function getGlobalSchemas(){
        $schema = [
            "@context" => "https://schema.org",
            "@graph" => [

                // ORGANIZATION
                [
                    "@type" => "Organization",
                    "name"  => getSettings('site_name'),
                    "url"   => getSettings('site_url'),
                    "logo"  => asset('storage/' . getSettings('logo_header')),

                    "contactPoint" => [
                        "@type"       => "ContactPoint",
                        "telephone"   => getSettings('site_telefone'),
                        "email"       => getSettings('site_email'),
                        "contactType" => "customer support",
                    ],

                    "sameAs" => array_filter([
                        getSettings('facebook'),
                        getSettings('tiktok'),
                        getSettings('instagram'),
                        getSettings('youtube'),
                        getSettings('linkedin'),
                    ]),
                ],

                // WEBSITE
                [
                    "@type"        => "WebSite",
                    "url"          => getSettings('site_url'),
                    "name"         => getSettings('site_name'),
                    "description" => getSettings('site_description'),

                    "publisher" => [
                        "@type" => "Organization",
                        "name"  => getSettings('site_name'),
                    ],
                ],

                // LOCAL BUSINESS
                [
                    "@type"     => "LocalBusiness",
                    "name"      => getSettings('site_name'),
                    "image"     => asset('storage/' . getSettings('logo_header')),
                    "telephone" => getSettings('site_telefone'),
                    "url"       => getSettings('site_url'),

                    // Campo obrigatório para LocalBusiness
                    "address" => [
                        "@type"           => "PostalAddress",
                        "streetAddress"   => getSettings('site_endereco'),       // Ex.: Rua Exemplo, 123
                        "addressLocality" => getSettings('site_cidade'),         // Ex.: Campinas
                        "addressRegion"   => getSettings('site_estado'),         // Ex.: SP
                        "postalCode"      => getSettings('site_cep'),            // Ex.: 13000-000
                        "addressCountry"  => "BR",
                    ],
                ],
            ],
        ];

        return json_encode(
            $schema,
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
        );
    }

    public function blogSchema($item)
    {
        if(!$item) return [];
        $fieldsItem = $this->getNomeDoItem($item);
        SEOTools::setTitle((!empty($fieldsItem['meta_title']) ? $fieldsItem['meta_title'] : ''));
        SEOTools::setDescription($item->meta_description ?? '');
        SEOTools::metatags()->setKeywords($item->meta_keywords ?? '');
        if(isset($item) and !empty($item->imagem)){
            SEOTools::opengraph()->addImage(asset('storage/'.$item->imagem));
        }else{
            SEOTools::opengraph()->addImage(asset('storage/'.getSettings('logo_header')));
        }

        return json_encode([
            "@context" => "https://schema.org",
            "@type"    => (!empty($fieldsItem['type']) ? $fieldsItem['type'] : ''),
            "headline" => (!empty($fieldsItem['nome']) ? $fieldsItem['nome'] : ''),
            "image"    => [($item->imagem != '') ? asset('storage/'.$item->imagem) : asset('storage/'.getSettings('logo_header'))],
            "url"      => url()->current(),
            "datePublished" => $item->created_at?->toDateString(),
            "dateModified"  => $item->updated_at?->toDateString(),
            "author" => [
                "@type" => "Person",
                "name"  => (!empty($fieldsItem['autor']) ? $fieldsItem['autor'] : "Equipe ".getSettings('site_name_short')) 
            ],
            "publisher" => [
                "@type" => "Organization",
                "name"  => getSettings('site_name'),
                "logo"  => [
                    "@type" => "ImageObject",
                    "url"   => asset('storage/'.getSettings('logo_header'))
                ]
            ],
            "description" => strip_tags($item->resumo)
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public function imageObject($item){
        if(!$item) return [];
        $imagemPath = ($item->imagem != '') ? public_path('storage/'.$item->imagem) : public_path('storage/'.getSettings('logo_header'));

        if (file_exists($imagemPath)) {
            [$width, $height] = getimagesize($imagemPath);
        } else {
            $width = 1200;
            $height = 630;
        }

        $imageSchema = [
            "@type"      => "ImageObject",
            "inLanguage" => "pt-BR",
            "@id"        => url()->current(),
            "url"        => ($item->imagem != '') 
                ? asset('storage/'.$item->imagem) 
                : asset('storage/'.getSettings('logo_header')),
            "contentUrl" => ($item->imagem != '') 
                ? asset('storage/'.$item->imagem) 
                : asset('storage/'.getSettings('logo_header')),
            "width"      => $width,
            "height"     => $height,
            "caption"    => $item->meta_title,
        ];

        return json_encode($imageSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function blogBreadcrumb($blog){
        if(!$blog) return [];
        $items[] = ['name' => 'Home', 'url' =>  getSettings('site_url')];
        $items[] = ['name' => 'Blog', 'url' => route('blog.site.index')];
        $items[] = ['name' => $blog->titulo, 'url' => route('blog.site.show', $blog->slug)];

        return $this->breadcrumb($items);

    }

    public function blogAutorBreadcrumb($autor){
        if(!$autor) return [];
        $items[] = ['name' => 'Home', 'url' =>  getSettings('site_url')];
        $items[] = ['name' => $autor->autor, 'url' => route('blog.site.show', $autor->slug)];

        return $this->breadcrumb($items);

    }

    public function blogCategoriaBreadcrumb($categoria){
        
        $items[] = ['name' => 'Home', 'url' =>  getSettings('site_url')];
        $items[] = ['name' => $categoria->categoria, 'url' => route('blog.site.show', $categoria->slug)];
        
        return $this->breadcrumb($items);

    }

    public function breadcrumb($items = [])
    {
        $position = 1;
        $list = [];

        foreach ($items as $item) {
            $list[] = [
                "@type" => "ListItem",
                "position" => $position++,
                "name" => $item['name'],
                "item" => $item['url']
            ];
        }

        return json_encode([
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => $list
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public function faq($faqs = [])
    {
        $questions = [];

        foreach ($faqs as $faq) {
            $questions[] = [
                "@type" => "Question",
                "name" => $faq['question'],
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => $faq['answer']
                ]
            ];
        }

        return json_encode([
            "@context" => "https://schema.org",
            "@type" => "FAQPage",
            "mainEntity" => $questions
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public function service($data)
    {
        return json_encode([
            "@context" => "https://schema.org",
            "@type" => "Service",
            "name" => $data['name'],
            "description" => $data['description'],
            "provider" => [
                "@type" => "Organization",
                "name"  => getSettings('site_name'),
                "url"   => getSettings('site_url'),
                "logo"  => asset('storage/'.getSettings('logo_header')),
            ],
            "areaServed"  => $data['area'] ?? "Brasil",
            "serviceType" => $data['type'] ?? null,
            "url" => $data['url'] ?? url()->current(),
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    function getNomeDoItem($item){
        if ($item instanceof Blog) return ['nome' => $item->titulo, 'type' => 'BlogPosting', 'autor' => $item->autor->autor, 'meta_title' => $item->meta_title, 'meta_description' => $item->meta_description, 'meta_keywords' => $item->meta_keywords];
        if ($item instanceof BlogCategoria) return ['nome' => $item->categoria, 'type' => 'BlogPosting', 'meta_title' => $item->meta_title, 'meta_description' => $item->meta_description, 'meta_keywords' => $item->meta_keywords];
        if ($item instanceof BlogAutor) return ['nome' => $item->autor, 'type' => 'ProfilePage', 'autor' => $item->autor, 'meta_title' => $item->meta_title, 'meta_description' => $item->meta_description, 'meta_keywords' => $item->meta_keywords ];

        return [];
    }
}
