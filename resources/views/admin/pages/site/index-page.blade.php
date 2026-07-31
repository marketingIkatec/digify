@extends('admin.app')

@section('content')

<?php
/*
function extractMenusById(string $url, string $menuId): array
{
    $html = file_get_contents($url);

    if (!$html) {
        return [];
    }

    libxml_use_internal_errors(true);

    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

    $xpath = new DOMXPath($dom);

    $menus = [];

    // UL principal pelo ID
    $menuItems = $xpath->query(
        "//ul[@id='{$menuId}']/li[contains(@class,'menu-item')]"
    );

    foreach ($menuItems as $item) {

        $link = $xpath->query("./a", $item)->item(0);

        if (!$link) {
            continue;
        }

        $menu = [
            'title'    => trim($link->textContent),
            'url'      => $link->getAttribute('href'),
            'children' => []
        ];

        // Submenus dentro do menu atual
        $subMenus = $xpath->query(
            ".//ul[contains(@class,'elementor-nav-menu--dropdown')]//li[contains(@class,'menu-item-type-custom')]",
            $item
        );

        foreach ($subMenus as $subItem) {
            $subLink = $xpath->query("./a", $subItem)->item(0);

            if ($subLink) {
                $menu['children'][] = [
                    'title' => trim($subLink->textContent),
                    'url'   => $subLink->getAttribute('href'),
                ];
            }
        }

        $menus[] = $menu;
    }

    return $menus;
}


$menus = extractMenusById(
    'https://digisac.com.br/',
    'menu-1-31c430e'
);

echo '<pre>';
foreach($menus as $menu) {
    $ordemMenu = 1;
    $url = $request->url ?? \Str::slug($menu['title']);

    $page = \App\Models\Page::Create(
        [
            'nome'      => $menu['title'],
            'url'       => 'javascript:void(0);',
            'page_id' => 0,
            'status'    => 1,
            'ordem'     => $ordemMenu++,
        ]
    );
    $ordemChild = 1;
    //echo 'Menu: ' . $menu['title'] . ' - URL: ' . $menu['url'] . PHP_EOL;
    foreach ($menu['children'] as $child) {        
        $child['url'] = str_replace("https://digisac.com.br/", $url.'/', trim($child['url'], '/'));
        
        $pageChild = \App\Models\Page::Create(
            [
                'nome'      => $child['title'],
                'url'       => $child['url'],
                'page_id' => $page->id,
                'status'    => 1,
                'ordem'     => $ordemChild++,
            ]
        );


        echo '  Submenu: ' . $child['title'] . ' - URL: ' . $child['url'] . PHP_EOL;
    }
}
echo '</pre>';

die; */
?>


@include('admin.layouts.tabmenu')

@include('admin.search.page')

<div class="bg-white shadow rounded p-4">
    <table class="table table-striped table-hover">
        <thead class="border-b">
            <tr class="text-sm text-gray-600 uppercase">
                <th class="py-3"><?=sortLink('titulo', 'Título da Página');?></th>
                <th class="py-3"><?=sortLink('slug', 'Slug');?></th>
                <th class="py-3"></th>
                <th class="py-3"></th>
                <th class="py-3"></th>
            </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr class="mostraDetalhes border-b hover:bg-gray-50" id="row-{{ $item->id }}">
                <td class="py-3 cursor-pointer">
                    <i class="fa fa-folder"></i>
                    {{ $item->titulo }}
                </td>
                <td class="py-3"><a href="{{ normalizeMenuUrl($item->slug) ? route('site.show', $item->slug) : ''}}" target="_blank">{{ normalizeMenuUrl($item->slug)}}</a></td>                
                <x-actions-td-buttom :item="$item"/>
            </tr>
            <tr id="detalhes-row-{{ $item->id }}">
                <td colspan="5" class="p-0">
                    <div class="detalhes hidden" id="detalhe-{{ $item->id }}">
                        <div class="p-4 bg-gray-50">
                            @if ($item->childrenRecursive->count() > 0)                        
                                <table>
                                    <tr>
                                        <th class="text-left p-2 bg-gray-100">Pagina</th>
                                        <th class="text-left bg-gray-100">Url</th>
                                        <th class="text-left bg-gray-100"></th>
                                        <th class="text-left bg-gray-100"></th>
                                        <th class="text-left bg-gray-100"></th>
                                    </tr>
                                    @foreach($item->childrenRecursive as $child)
                                        <tr>
                                            <td class="p-4">
                                                <i class="fa fa-folder"></i>
                                                {{ $child->titulo }}
                                            </td>
                                            <td><a href="{{route('site.show', $child->slug)}}" target="_blank">{{ $child->slug }}</a></td>
                                            <x-actions-td-buttom :item="$child"/>
                                        </tr>
                                        @if($child->id == env('PAGE_ID_INTEGRACOES'))
                                            @foreach(\App\Models\page::where('page_id', env('PAGE_ID_INTEGRACOES'))->get() as $integracoesPage)
                                                <tr>
                                                    <td class="p-4">
                                                        <i class="fa fa-folder"></i>
                                                        {{ $integracoesPage->titulo }}
                                                    </td>
                                                    <td><a href="{{route('site.show', $integracoesPage->slug)}}" target="_blank">{{ $integracoesPage->slug }}</a></td>
                                                    <x-actions-td-buttom :item="$integracoesPage"/>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </table>
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @include('admin.layouts.pagination-items')
</div>
@endsection
