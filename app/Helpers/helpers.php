<?php

    use App\Models\Setting;
    use App\Models\Page;
    use App\Models\Blog;
    use App\Models\BlogCategoria;
    use App\Models\BlogAutor;
    use App\Models\PageBlock;
    use App\Models\FormHubSpot;
    use App\Helpers\RouteHelper;
    
    function getSettings($name = '')
    {
        $settings = Setting::where('key', $name)->first();
        return trim($settings?->value ?? '');
    }

    function getPageById($id = '')
    {
        $page = [];
        if($id){
            $page = Page::where(['id' => $id, 'status' => 1])->first();
        }        
        return $page;
    }

    function getFormHubSpotById($id = '')
    {
        $formHubSpot = FormHubSpot::find($id);
        return $formHubSpot;
    }

    function getPageBySlug($slug = ''){
        $models = [
            Page::class,
            Blog::class,
            BlogAutor::class,
            BlogCategoria::class,
        ];

        foreach ($models as $model) {
            if ($page = $model::where('slug', $slug)->first()) {
                return $page;
            }
        }

        return null;
    }

    if(! function_exists('getAdminSidebarMenu')){
        function getAdminSidebarMenu() {
            $helper = new RouteHelper();
            return $helper->getAdminSidebarMenu();
        }
    }

    if(! function_exists('getCurrentMenuChildren')){
        function getCurrentMenuChildren() {
            $helper = new RouteHelper();
            return $helper->getCurrentMenuChildren();
        }
    }

    function sortLink($field, $label) {
        $params = array_merge(request()->all(), ['sort' => $field, 'direction' => 'asc']);
        $urlAsc = request()->url() . '?' . http_build_query($params);

        $params = array_merge(request()->all(), ['sort' => $field, 'direction' => 'desc']);
        $urlDesc = request()->url() . '?' . http_build_query($params);
        
        $html = ' <div style="display: inline-flex; align-items: center; gap: 4px;">';
        $html .= '   <a href="'.$urlAsc.'"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-caret-up-fill asc" viewBox="0 0 16 16"><path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/></svg></a>';
        $html .= '   <span>'.$label.'</span>';
        $html .= '   <a href="'.$urlDesc.'"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-caret-down-fill desc" viewBox="0 0 16 16"><path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/></svg></a>';
        $html .= ' </div>';
        return $html;
    }

    function getYoutubeId($url){
        preg_match(
            '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
            $url,
            $match
        );
        return $match[1] ?? null;
    }

    function getRouteUrl($item)
    {
        $map = [
            PageBlock::class     => fn ($i) => route('admin.site.page.block.show', $i->id),
            Page::class          => fn ($i) => route('site.show', $i->slug),
            Blog::class          => fn ($i) => route('blog.site.show', $i->slug),
            BlogAutor::class     => fn ($i) => route('blog.autor.site.show', $i->slug),
            BlogCategoria::class => fn ($i) => route('blog.categoria.site.show', $i->slug),
            NaMidia::class  => fn ($i) => route('na-midia.show', $i->slug),
        ];

        foreach ($map as $class => $resolver) {
            if ($item instanceof $class) {
                return [
                    'slug'  => $resolver($item),
                    'title' => $item->display_name,
                ];
            }
        }

        return [
            'slug' => '',
            'title' => '',
        ];
    }


    function getNaMidias(){
        $naMidias = NaMidia::where('status', 1)
        ->where('published_at', '<=', now())
        ->orderBy('created_at', 'desc')
        ->Limit(6)
        ->get();
        return $naMidias;
    }

    function getLatestBlogs($limit = 3)
    {
        return Blog::with(['autor', 'categorias'])
            ->where('status', 1)
            ->where('data_blog', '<=', now())
            ->orderBy('data_blog', 'desc')
            ->limit($limit)
            ->get();
    }


    function normalizeMenuUrl(?string $url): string
    {
        if (!$url || substr($url, 0, 4) == 'http') {
            return '';
        }

        $url = trim($url);

        $invalidUrls = [
            '#',
            'javascript:void(0)',
            'javascript:void(0);',
            'javascript:;',
            'javascript:void'
        ];

        return in_array(strtolower($url), $invalidUrls, true)
            ? ''
            : $url;
    }
    function getPageSettings($item, $type){
        
        if(!empty($item) && !empty($item->getSettings)){
            switch ($type) {
                case 'popup':
                    $settingName = 'pagePopups';
                    $model = PagePopup::class;
                    break;
                case 'formHubSpot':
                    $settingName = 'formHubSpot';
                    $model = FormHubSpot::class;
                    break;
                default:                    
                    $settingName = '';
                    $model = null;
                    break;    
            }

            foreach($item->getSettings as $setting){
                if($setting->status && $setting->setting == $settingName && $obj = $model::find($setting->setting_id)){
                    return $obj;
                }
            }  
        }
        return '';     
    }
    
    function getEstadoPorTelefone(?string $telefone): ?string 
    {
        if (!$telefone) {
            return null;
        }

        $telefone = preg_replace('/\D/', '', $telefone);

        // Remove código do Brasil
        if (str_starts_with($telefone, '55')) {
            $telefone = substr($telefone, 2);
        }

        $ddd = substr($telefone, 0, 2);

        $ddds = [
            '11' => 'SP', '12' => 'SP', '13' => 'SP',
            '14' => 'SP', '15' => 'SP', '16' => 'SP',
            '17' => 'SP', '18' => 'SP', '19' => 'SP',

            '21' => 'RJ', '22' => 'RJ', '24' => 'RJ',

            '27' => 'ES', '28' => 'ES',

            '31' => 'MG', '32' => 'MG', '33' => 'MG',
            '34' => 'MG', '35' => 'MG', '37' => 'MG',
            '38' => 'MG',

            '41' => 'PR', '42' => 'PR', '43' => 'PR',
            '44' => 'PR', '45' => 'PR', '46' => 'PR',

            '47' => 'SC', '48' => 'SC', '49' => 'SC',

            '51' => 'RS', '53' => 'RS', '54' => 'RS', '55' => 'RS',

            '61' => 'DF',

            '62' => 'GO', '64' => 'GO',

            '65' => 'MT', '66' => 'MT',

            '67' => 'MS',

            '68' => 'AC',
            '69' => 'RO',

            '71' => 'BA', '73' => 'BA', '74' => 'BA',
            '75' => 'BA', '77' => 'BA',

            '79' => 'SE',

            '81' => 'PE', '87' => 'PE',
            '82' => 'AL',
            '83' => 'PB',
            '84' => 'RN',

            '85' => 'CE', '88' => 'CE',

            '86' => 'PI', '89' => 'PI',

            '98' => 'MA', '99' => 'MA',

            '91' => 'PA', '93' => 'PA', '94' => 'PA',

            '92' => 'AM', '97' => 'AM',

            '95' => 'RR',
            '96' => 'AP',
            '63' => 'TO',
        ];

        return $ddds[$ddd] ?? null;
    }
?>
