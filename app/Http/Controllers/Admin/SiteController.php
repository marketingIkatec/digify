<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Page;
use App\Models\Blog;
use App\Models\PageBlock;
use App\Models\PageBlockConfig;
use App\Models\PageBlockType;
use App\Models\IntegracoesCategoria;
use App\Models\FormHubSpot;
use App\Models\PageSettings;
use App\Models\BudgetPlan;
use App\Models\BudgetModule;
use App\Models\BudgetFeature;
use App\Http\Requests\PageRequest;
use App\Http\Requests\PageBlockRequest;
use App\Services\UploadService;

class SiteController extends Controller
{
    public function showSite(Request $request){
        
        $slug = trim($request->path(), '/');

        $item = Blog::where(['slug' => $slug, 
                             'status' => true])->first();
        if(!empty($item)){
            return redirect()->route('blog.site.show', ['slug_blog' => $item->slug]);
        }                     

        $item = Page::where(['slug' => $slug, 
                             'status' => true])->first();

        if (!$item) {
            abort(404);
        }

        if($item->slug == 'tour-digify'){ 
            return view('layouts.blocks.tour-digify')->with('item', $item);
        }

        return view('pages.site-home')->with('item', $item);
    }

    public function indexPage(Request $request){

        $query = Page::query()->with('childrenRecursive');

        if(!$request->filled('page_id') && !$request->filled('titulo') && !$request->filled('status')){
            $query->where('page_id', 0);
        }

        // Filtro por pagina pai
        if ($request->filled('page_id') and $request->page_id != '0') {
            $query->where('page_id', $request->page_id);
        }

        // Filtro por nome
        if ($request->filled('titulo')) {
            $query->where('titulo', 'like', '%' . $request->titulo . '%');
        }

        // Filtro por status
        if ($request->filled('status') && $request->status !== 'todos') {
            $query->where('status', $request->status);
        }

        // Paginação com 10 por página
        // Ordenação
        $sortField = $request->get('sort', 'ordem');
        $sortDirection = $request->get('direction', 'asc');

        $items = $query->orderBy($sortField, $sortDirection)
                    ->paginate(7)
                    ->appends($request->all());

        $paginasPai = Page::where(function ($query) {
            $query->where('page_id', 0)
                    ->orWhere('id', env('PAGE_ID_INTEGRACOES'));
            })
            ->where('id', '<>', $item->id ?? 0)
            ->orderBy('ordem')
            ->get();

        return view('admin.pages.site.index-page')
                ->with('items', $items)
                ->with('sortField', $sortField)
                ->with('sortDirection', $sortDirection)
                ->with('paginasPai', $paginasPai);
    }

    public function createPage()
    {
        // Controller
        $paginas = Page::where('page_id', 0)
            ->orWhere('id', env('PAGE_ID_INTEGRACOES'))
            ->orderBy('ordem')
            ->get();
   
        return view('admin.pages.site.cadastrar-page')
        ->with('paginasPai', $paginas);
    }

    public function editPage($item)
    {
        $item = Page::findOrFail($item);
        
        $paginasPai = Page::where(function ($query) {
            $query->where('page_id', 0)
                    ->orWhere('id', env('PAGE_ID_INTEGRACOES'));
            })
            ->where('id', '<>', $item->id ?? 0)
            ->orderBy('ordem')
            ->get();    
        
        return view('admin.pages.site.cadastrar-page')
                ->with('item', $item)
                ->with('paginasPai', $paginasPai);
    }

    public function storePage(PageRequest $request, UploadService $uploadService)
    {

        if(!empty($request['integracoes_categorias'])){
            // processa as categorias
            $categoriaIds = collect($request['integracoes_categorias'])->map(function ($categoria) {
                // se for número, já existe
                if (is_numeric($categoria)) {
                    return (int) $categoria;
                }

                // senão, cria e retorna o id
                $categorias = ['categoria' => trim($categoria), 'slug' => \Str::slug($categoria), 'status' => 1];
                return IntegracoesCategoria::firstOrCreate($categorias)->id;
            });
        }

        $data = $request->all();
        $uploadService->uploadImagem($request->file('imagem'), Page::class, $data);


        $data['slug'] = $request->slug ?? \Str::slug($request->nome);
        
        $item = Page::updateOrCreate(
                    ['id' => $data['id'] ?? null],
                    $data
                );
        if(!empty($categoriaIds)){
            $item->categorias()->sync($categoriaIds);
        }
            
        $msg = $data['id'] ? "Página atualizada com sucesso!" : "Página criada com sucesso!";
        
        return redirect()->route('admin.site.page.edit', $item)->with('success', $msg);
    }

    public function editPageBlock($page, $pageBlock = '')
    {
        $page = Page::findOrFail($page);
        if($pageBlock){
            $item = PageBlock::findOrFail($pageBlock);  
            
            if(!empty($item->getSettings())){
                foreach($item->getSettings as $setting){
                    $formHubSpot_id = $setting['setting_id'];
                }
            }
        }        
        
        $pageBlockConfig       = PageBlockConfig::where('tipo', 'background_css')->orderBy('nome')->get();
        $pageBlockConfigButton = PageBlockConfig::where('tipo', 'button_css')->orderBy('nome')->get();
        $pageBlockType         = PageBlockType::orderBy('type')->orderBy('type')->get();

        $formsHubspot = FormHubSpot::orderBy('name')->get();

        return view('admin.pages.site.cadastrar-page-block')
                ->with('page', $page)
                ->with('item', $item ?? [])
                ->with('pageBlockConfig', $pageBlockConfig)
                ->with('pageBlockType', $pageBlockType)
                ->with('formsHubspot', $formsHubspot ?? [])
                ->with('formHubSpot_id', $formHubSpot_id ?? '')
                ->with('pageBlockConfigButton', $pageBlockConfigButton);
    }

    public function storePageBlock(PageBlockRequest $request)
    {

        $data = $request->all();
        
        $data['titulo']     = removerParagrafo($request->titulo);
        $data['subtitulo2'] = removerParagrafo($request->subtitulo2);
        $data['subtitulo3'] = removerParagrafo($request->subtitulo3);

        $item = Page::findOrFail($data['page_id']);

        if ($request->image_path && $tempPath = $request->image_path) {
            $data['configuracao']['image']['file'] = $tempPath;
            if(!empty($request->page_slug)){
                $finalPath = str_replace('temp/', 'site/'.$request->page_slug.'/', $tempPath);

                if (Storage::disk('public')->exists($tempPath)) {
                    Storage::disk('public')->move($tempPath, $finalPath);
                    Storage::disk('public')->delete($request->page_slug);
                    $data['configuracao']['image']['file'] = $finalPath;
                }
            }            
        }


        $id_hash = $data['id'] ?? time();

        // salvar configs novas
        saveCardImagem($data, $request);
        saveBackgroundConfig($data, 'background');
        //saveBackgroundConfig($data, 'button_background');

        // processar valores finais
        processBackground($data['configuracao'], 'background', $id_hash);        
        processBackground($data['configuracao'], 'cards_background', $id_hash);       
        //processBackground($data['configuracao'], 'button_background', $id_hash);
        //processConfiguration($data['configuracao']); 
        
        
        $pageBlock = PageBlock::updateOrCreate(
            ['id' => $data['id'] ?? null],
            $data
        );
        
        if($data['tipo_bloco'] == 'form-custom-hubspot' || $data['tipo_bloco'] == 'form-custom-chat-hubspot' || $data['tipo_bloco'] == 'btn-whatsapp-custom-hubspot' || $data['tipo_bloco'] == 'btn-whatsapp-custom-chat-hubspot'){
            $dataSetting['table']      = 'pageBlock';
            $dataSetting['table_id']   = $pageBlock['id'];
            $dataSetting['setting']    = 'formHubSpot';
            $dataSetting['setting_id'] = $data['form_hubspot_id'];

            if($data['form_hubspot_id']){
                $pageSetting = PageSettings::updateOrCreate(
                        [
                            'table'    => $dataSetting['table'], 
                            'table_id' => $dataSetting['table_id'],
                            'setting'  => $dataSetting['setting']
                        ],
                        $dataSetting
                    );
            }else{
               PageSettings::where([
                    'table'    => $dataSetting['table'],
                    'table_id' => $dataSetting['table_id'],
                    'setting'  => $dataSetting['setting']
                ])->delete(); 
            }
            
        }

        $msg = $request->id ? "Bloco atualizado com sucesso!" : "Bloco criado com sucesso!";

        return redirect()->route('admin.site.page.edit', $item)->with('success', $msg)->with('close_modal', true);    
    }

    public function destroyPage($item)
    {

        $item = Page::findOrFail($item);
        if (!$item) {
            return redirect()->route('admin.pages.site.index-pagina-site')->with('error', 'Página não encontrada!');
        }
        
        //$item->delete();
        //return redirect()->route('admin.pages.site.index-pagina-site')->with('success', 'Página removida com sucesso!');
    }

    public function showPageBlock($id){
        $block = PageBlock::findOrFail($id);
        return view('pages.site-block-show')->with('block', $block);
    }
}
