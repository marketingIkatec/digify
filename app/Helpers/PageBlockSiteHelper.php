<?php

    use App\Models\PageBlockConfig;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;
    use App\Http\Requests\PageBlockRequest;

    function processBackground(array &$config, string $prefix, string $hash)
    {
        $type = $config["{$prefix}_bg_type"] ?? null;

        if ($type === 'salvo' && !empty($config[$prefix])) {

            unset(
                $config["{$prefix}_solid_color"],
                $config["{$prefix}_gradient_color1"],
                $config["{$prefix}_gradient_color2"],
                $config["{$prefix}_gradient_direction"],
                $config["{$prefix}_new"]
            );

            $key = str_replace('_', '-', $prefix).'-color-'.$hash;
            $config['class-'.str_replace('_', '-', $prefix)] = $key;
            $config[$key] = $config[$prefix];
            return;
        }

        if ($type === 'solid' && !empty($config["{$prefix}_solid_color"])) {

            unset(
                $config[$prefix],
                $config["{$prefix}_gradient_color1"],
                $config["{$prefix}_gradient_color2"],
                $config["{$prefix}_gradient_direction"],
                $config["{$prefix}_new"]
            );

            $key = str_replace('_', '-', $prefix).'-color-'.$hash;
            $config['class-'.str_replace('_', '-', $prefix)] = $key;
            $config[$key] = 'background: '.$config["{$prefix}_solid_color"].';';
            return;
        }

        if (
            $type === 'gradient'
            && !empty($config["{$prefix}_gradient_color1"])
            && !empty($config["{$prefix}_gradient_color2"])
        ) {

            unset(
                $config[$prefix],
                $config["{$prefix}_solid_color"],
                $config["{$prefix}_new"]
            );

            $dir = $config["{$prefix}_gradient_direction"] ?? 'to right';

            $key = str_replace('_', '-', $prefix).'-color-'.$hash;
            $config['class-'.str_replace('_', '-', $prefix)] = $key;
            $config[$key] = 
                "background: linear-gradient({$dir}, "
                ."{$config["{$prefix}_gradient_color1"]}, "
                ."{$config["{$prefix}_gradient_color2"]});";
        }
    }

    function processConfiguration(array &$data){
        $data['cards_color_text'] = !empty($data['is_cards_color_text']) ? $data['cards_color_text'] : null;
        if(!empty($data['button-primary']['text']) && !empty($data['button-primary']['link'])){
            unset($data['button-primary']);
        }

        if(!empty($data['button-secondary']['text']) && !empty($data['button-secondary']['link'])){
            unset($data['button-secondary']);
        }
    }
    function saveBackgroundConfig(array $data, string $prefix)
    {
        if (empty($data['configuracao']["{$prefix}_new"])) {
            return;
        }

        $cfg = [];
        $type = $data['configuracao']["{$prefix}_bg_type"] ?? null;

        if ($type === 'solid') {
            $cfg['configuracao'] =
                'background: '.$data['configuracao']["{$prefix}_solid_color"].';';
        }

        if ($type === 'gradient') {
            $cfg['configuracao'] =
                'background: linear-gradient('
                .$data['configuracao']["{$prefix}_gradient_direction"].', '
                .$data['configuracao']["{$prefix}_gradient_color1"].', '
                .$data['configuracao']["{$prefix}_gradient_color2"].');';
        }

        if (!empty($cfg)) {
            PageBlockConfig::updateOrCreate(
                ['nome' => $data['configuracao']["{$prefix}_new"]],
                [
                    'configuracao' => $cfg['configuracao'],
                    'tipo'         => 'background_css',
                ]
            );
        }
    }

    function gerarCssBackgrounds(array $config, $id = ''){
        $css = !empty($config['css_editor']) ? $config['css_editor'] : '';

        if(!empty($config)){
            foreach ($config as $key => $value) {
                if (str_starts_with($key, 'background-color-') || str_starts_with($key, 'cards-background-color')) {
                    $css .= ".{$key} { {$value} }\n";
                }
            }
        }    
         
        return str_replace('-*', '-'.$id, $css);
    }
    
    function removerParagrafo($html){
        $html = trim($html);

        if (preg_match('/^<p>(.*?)<\/p>$/is', $html, $matches)) {
            return $matches[1];
        }

        return $html;
    }

    function renderBadge($block, $key)
    {
        $info = data_get($block, $key);
        if(empty($info) || $info == ''){
            return '';
        }

        $html = '<div class="badge">';
        if(strpos($block[$key], '<svg')  !== true){
            $html .= '<span></span>';
        }
        $html .= $block[$key];
        $html .= '</div>';

        $html = '';

        $html = '<div class="badge-ping">';
        $html .= '    <span class="ping"></span>';
        $html .= '    <span class="dot"></span>';
        $html .= '    <span class="text">';
        $html .= '        '.$block[$key];
        $html .= '    </span>';
        $html .= '</div>';

        return $html;

    }

    function renderBlock($block, $key)
    {
        $info = data_get($block, $key);
        if(empty($info) || $info == ''){
            return '';
        }

        if(strpos($info, '<h2>') !== false and strpos($info, '<p>') !== false){
            return $info;
        }

        switch($key){
            case 'titulo'     : return '<h1 class="animate fade-left">' . $info. '</h1>'; break;
            case 'subtitulo2' : return '<h2 class="animate fade-right">' . $info. '</h2>'; break;
            case 'subtitulo3' : return '<h3 class="animate fade-right">' . $info. '</h3>'; break;
            case 'conteudo'   : return str_replace('<p>', '<p class="animate fade-right">', $info); break;
            default           : return '';
        }
    }

    function renderCard($block, $key, $class="hero-cards")
    {
        
        $info = data_get($block['configuracao'], $key);
        if(empty($info) || $info == ''){
            return '';
        } 

        $active = '';
        if(strpos($block->configuracao['cards'][0]['title'], '1. ') !== false){
          $active = "active";
        }
        $html = '<div class="'.$class.'">';
        foreach($block->configuracao['cards'] ?? [] as $card){
            $html .= ' <div class="'.substr($class, 0,-1).' '.($block->configuracao['class-cards-background'] ?? '').' '.$active.'">';
            
            if(!empty($card['icone']) || !empty($card['image'])){
                $html .= '<div class="icon">';
                if(!empty($card['icone'])){
                    $html .= $card['icone'];
                }
                if(!empty($card['image'])){
                    $html .= '<img src="'. asset('storage/' . $card['image']).'" alt="'.$card['title'].'" title="'.$card['title'].'">';
                }
                $html .='</div>';
            }
            if($card['subtitulo2']){
                $html .= '<h4>'.$card['subtitulo2'].'</h4>';
            }
            if($card['subtitulo3']){
                $html .= '<strong>'.$card['subtitulo3'].'</strong>';
            }
            if($card['title']){
                $html .= '<h3 class="counter" data-value="'.$card['title'].'">'.$card['title'].'</h3>';
            }

            if($class == 'steps-cards'){
                $html .= '<div class="divider"></div>';
            }

            if($card['descricao']){
                if (preg_match('/;\s*\n/', $card['descricao'])) {
                    $html .= '<p>'.renderTextList(str_replace(';', '', $card['descricao']), $class.'-list').'</p>';
                }else{
                    $html .= '<p>'.$card['descricao'].'</p>';
                }    
            }
            $html .= '</div>';
            $active = '';
        }
         $html .= '</div>';
         return $html;
    }

    function renderButton($block, string $key, $isButton = false)
    {
        $configuracao = "configuracao.$key";

        if($key == 'button'){
            $configuracao = $key;
        }


        $button = data_get($block, $configuracao);

        if (empty($button) || empty($button['text'])){
            return '';
        }
        $style[] = "color: ".$button['color'];
        $style[] = "background: ".$button['background'];
        $class  = $button['class']  ?? 'btn '.str_replace('button-', 'btn-', $key);
        $target = $button['target'] ?? '_self';
        $dataHref = substr($button['link'], 0, 1) == '#' ? str_replace('#', '', $button['link']) : '';
        $class .= (substr($button['link'], 0, 1) == '#' ? ' is-anchor' : '');
        //$button['link'] = substr($button['link'], 0, 1) == '#' ? 'javascript:void(0)' : $button['link'];
        //style="%s
        if(!$isButton){
            return sprintf(
                '<a href="%s" target="%s" class="%s" data-href="%s" style="%s">%s
                </a>',
                e($button['link']),
                e($target),
                e(str_replace('btn-primary', 'btn-thirdy', str_replace('btn-secondary', 'btn-thirdy', $class))),
                e($dataHref),
                e(implode(';', $style)),
                e($button['text'])
            );
            //e(implode(';', $style)),
        }
        $style = $button['btn_css'];
        return sprintf(
            '<button class="btn btn-thirdy submit" style="%s" data-sending = "%s" data-original-text="%s">%s
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="arrow-right" aria-hidden="true" class="lucide lucide-arrow-right w-5 h-5 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
            <div class="shine"></div>
            </button>',
            e($style),
            __('forms.sending'),
            e($button['text']),
            e($button['text'])
        );

    }

    function renderImage($block, string $key = 'image')
    {
        $image = data_get($block, "configuracao.$key");

        if ((empty($image) || (empty($image['file']) && empty($image['url'])))) {
            return '';
        }       

        

        $src   = !empty($image['file']) ? asset('storage/' . ltrim($image['file'], '/')) : $image['url'];
       
        $alt   = $image['alt']   ?? '';
        $title = $image['title'] ?? '';
        $class = $image['class'] ?? '';
        $style = $image['style'] ?? '';

        return sprintf(
            '<img src="%s" alt="%s"%s%s%s>',
            e($src),
            e($alt),
            $title ? ' title="' . e($title) . '"' : '',
            $class ? ' class="' . e($class) . '"' : '',
            $style ? ' style="' . e($style) . '"' : ''
        );
    }

    function renderTextList($texto, $class= 'plan-features'){

        // remove NBSP
        $texto = str_replace("\u{A0}", ' ', $texto);

        // normaliza quebras de linha (\r\n, \r → \n)
        $texto = preg_replace("/\r\n|\r/", "\n", $texto);

        // separa blocos por linha em branco
        $blocos = preg_split("/\n\s*\n/", trim($texto));

        $saida = '';

        foreach ($blocos as $bloco) {

            // quebra linhas do bloco
            $linhas = array_filter(
                array_map('trim', explode("\n", $bloco)),
                fn($l) => $l !== ''
            );

            // se tiver várias linhas → lista
            if (count($linhas) > 1) {
                $saida .= "<ul class='{$class}'>";
                foreach ($linhas as $linha) {
                    $saida .= "<li>" . htmlspecialchars($linha) . "</li>";
                }
                $saida .= "</ul>";
            } 
            // se for uma linha só → parágrafo
            else {
                $saida .= "<p>" . htmlspecialchars($linhas[0]) . "</p>";
            }
        }

        return $saida;
    }

    function saveCardImagem(array &$data, Request $request){
        if (empty($data['configuracao']['cards']) || !is_array($data['configuracao']['cards'])) {
            return;
        }

        foreach ($data['configuracao']['cards'] as $index => &$card) {
            // se existir imagem
            if ($request->hasFile("configuracao.cards.$index.image")) {

                $file = $request->file("configuracao.cards.$index.image");

                // nome original sem extensão
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

                // slug do nome
                $slugName = Str::slug($originalName);

                // extensão original (normalizada)
                $extension = strtolower($file->getClientOriginalExtension());

                // nome final
                $fileName = $slugName . '.' . $extension;

                // evita sobrescrever arquivo com mesmo nome
                $path = 'site/' . $data['page_slug'].'/'. $fileName;


                // salva
                Storage::disk('public')->putFileAs(
                    'site/' . $data['page_slug'],
                    $file,
                    basename($path)
                );

                // salva o path no json
                $card['image'] = $path;

            } else {
                $card['image'] = $card['imageSaved'] ?? null;
                unset($card['imageSaved']);
            }
        }
    }   
?>