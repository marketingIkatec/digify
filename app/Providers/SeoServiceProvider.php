<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\SeoService;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Route;

class SeoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(SeoService::class, function () {
            return new SeoService();
        });
    }

    public function boot(SeoService $seo)
    {
        // SEO Global (Organization, Website, LocalBusiness)
        View::composer('*', function ($view) use ($seo) {
            if(SEOTools::getTitle() == ''){
                
                $title = getSettings('site_name'); 
                $description = getSettings('site_description');
                
                $page = getPageBySlug(request()->path());
                $keywords = [];
                $logo_header = getSettings('logo_header');
                if(!empty($page)){
                    $title       = $page['meta_title'];
                    $description = $page['meta_description'] ?? $description;
                    $keywords    = $page['meta_keywords'] ?? [];
                    $logo_header = $page['imagem'] ?? $logo_header;
                }
                
                SEOTools::setTitle($title);
                SEOTools::setDescription($description);
                SEOTools::metatags()->setKeywords($keywords);

                
                if($logo_header){
                   $logo_header = asset('storage/'.$logo_header);
                   SEOTools::opengraph()->addImage($logo_header);
                }                
            }
            
            SEOTools::opengraph()->setUrl(url()->current());
            SEOTools::opengraph()->addProperty('type', 'website');
            SEOTools::twitter()->setSite(getSettings('twitter'));
            SEOTools::setCanonical(url()->current());

            $view->with('schemaJsonLd', $seo->getGlobalSchemas());
        });
    }
}
