<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog;
use App\Models\BlogCategoria;
use App\Models\BlogAutor;
use App\Models\Page;
use App\Services\UploadService;
use App\Http\Requests\BlogAutorRequest;
use App\Http\Requests\BlogCategoriaRequest;
use App\Http\Requests\BlogRequest;
use Carbon\Carbon;
use App\Services\SeoService;

class BlogController extends Controller
{
    public function blogSiteIndex(Request $request, SeoService $seo){
        $query = Blog::with(['autor', 'categorias']);

        $blogSchema = [];

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('titulo', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%")
                ->orWhereHas('autor', function ($q2) use ($search) {
                    $q2->where('autor', 'like', "%{$search}%");
                })
                ->orWhereHas('categorias', function ($q3) use ($search) {
                    $q3->where('categoria', 'like', "%{$search}%");
                });
            });
        }

        if ($request->autor) { 
            $query->whereHas('autor', function ($q) use ($request) {
                $q->where('slug', $request->autor);
            });

            $objSearch = BlogAutor::where('slug', $request->autor)
                ->whereHas('blogs', function ($q) {
                    $q->where('status', 1);
                })->firstOrFail();

    
            $blogSchema['blogAutorSchema'] = $seo->blogSchema($objSearch);
            $blogSchema['blogImageObject'] = $seo->imageObject($objSearch); 
            $blogSchema['breadcrumb']      = $seo->blogAutorBreadcrumb($objSearch);
        }

        if ($request->categoria) {
            $query->whereHas('categorias', function ($q) use ($request) {
                $q->where('slug', $request->categoria);
            });

            $objSearch = BlogCategoria::where('slug', $request->categoria)
            ->whereHas('blogs', function ($q) {
                    $q->where('status', 1);
                })->firstOrFail();       
            
            $blogSchema['blogCategoriaSchema'] = $seo->blogSchema($objSearch);
            $blogSchema['breadcrumb']      = $seo->blogCategoriaBreadcrumb($objSearch);
            $blogSchema['blogImageObject'] = $seo->imageObject($objSearch);    
        }

        $query->where('status', 1);
        $query->where('data_blog', '<=', now());
        
        $sortField = $request->get('sort', 'data_blog');
        $sortDirection = $request->get('direction', 'desc');

        if (!in_array($sortField, ['data_blog', 'titulo', 'created_at'], true)) {
            $sortField = 'data_blog';
        }

        if (!in_array(strtolower($sortDirection), ['asc', 'desc'], true)) {
            $sortDirection = 'desc';
        }

        $blogs = $query->orderBy($sortField, $sortDirection)
                       ->paginate(9)
                       ->appends($request->all());
        
        $blogCategorias = BlogCategoria::ativasComBlogs()->get();            
        $blogAutores    = BlogAutor::ativasComBlogs()->get(); 
        
        $item = Page::where(['slug' => $request->path(), 
                             'status' => true])->first();

        return view('blog.index')
                ->with('item', $item ?? null)
                ->with('blogs', $blogs)
                ->with('sortField', $sortField)
                ->with('blogCategorias', $blogCategorias ?? '')
                ->with('blogAutores', $blogAutores ?? '')
                ->with('objSearch', $objSearch ?? '')
                ->with('sortDirection', $sortDirection)
                ->with('blogSchema', $blogSchema);
    }

    public function blogSiteShow(Request $request, SeoService $seo){
        
        if ($request->slug_blog) {
            $blog = Blog::with(['autor', 'categorias'])
                        ->where('slug', $request->slug_blog)
                        ->where('data_blog', '<=', now())
                        ->where('status', true)
                        ->firstOrFail();
                       
            if(!empty($blog)){
                if($blog->categorias){

                    $categorias = $blog->categorias()->pluck('id');

                    $blogsRelacionados = Blog::with(['autor', 'categorias'])
                        ->where('status', 1)
                        ->where('id', '!=', $blog->id)
                        ->whereDate('data_blog', '<=', now())
                        ->whereHas('categorias', function ($q) use ($categorias) {
                            $q->whereIn('blogsCategoria.id', $categorias);
                        })
                        ->inRandomOrder()
                        ->limit(4)
                        ->get();
                }
                $blogSchema['blogSchema']      = $seo->blogSchema($blog);
                $blogSchema['blogImageObject'] = $seo->imageObject($blog);
                $blogSchema['breadcrumb']      = $seo->blogBreadcrumb($blog);
            }
        }

        return view('blog.show')
                ->with('blog', $blog ?? '')
                ->with('blogsRelacionados', $blogsRelacionados ?? '')
                ->with('blogSchema', $blogSchema);

    }

    public function index(Request $request)
    {

        $query = Blog::query()
            ->withCount([
                'visitas as total_visitas'
            ]);

        // Filtro por nome
        if ($request->filled('titulo')) {
            $query->where(function ($q) use ($request) {
                $q->where('titulo', 'like', '%' . $request->titulo . '%')
                ->orWhere('resumo', 'like', '%' . $request->titulo . '%')
                ->orWhere('conteudo', 'like', '%' . $request->titulo . '%');
            });
        }

        if ($request->filled('autor_id')) {
            $query->where('autor_id', $request->autor_id);
        }

        if ($request->filled('categorias')) {
            $query->where('categorias', $request->categorias);
        }

        if ($request->filled('categoria_id')) {
            $query->whereHas('categorias', function ($q) use ($request) {
                $q->where('id_categoria', $request->categoria_id);
            });
        }

        // Filtro por status
        if ($request->filled('status') && $request->status !== 'todos') {
            $query->where('status', $request->status);
        }

        // Paginação com 10 por página
        // Ordenação
        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'desc');

        $items = $query->orderBy($sortField, $sortDirection)
                    ->paginate(10)
                    ->appends($request->all());


        return view('admin.pages.blog.index-blog')
                ->with('items', $items)
                ->with('sortField', $sortField)
                ->with('sortDirection', $sortDirection);
    }

    public function create()
    {
        return view('admin.pages.blog.cadastrar-blog');
    }

    public function store(BlogRequest $request, UploadService $uploadService)
    {
        
        // processa as categorias
        $categoriaIds = collect($request['categorias'])->map(function ($categoria) {
            // se for número, já existe
            if (is_numeric($categoria)) {
                return (int) $categoria;
            }

            // senão, cria e retorna o id
            $categorias = ['categoria' => trim($categoria), 'slug' => \Str::slug($categoria)];
            return BlogCategoria::firstOrCreate($categorias)->id;
        });

        $data = $request->all();
        $uploadService->uploadImagem($request->file('imagem'), Blog::class, $data);

        $data['slug']       = $request->slug ?? \Str::slug($request->titulo);
        $data['data_blog'] = $request->data_blog; 

        $blog = Blog::updateOrCreate(
                    ['id' => $data['id'] ?? null],
                    $data
                );

        $blog->categorias()->sync($categoriaIds);

        $msg = $data['id'] ? "Blog atualizado com sucesso!" : "Blog criado com sucesso!";
        
        return redirect()
        ->route('blogs.index', ['titulo' => $blog->titulo])
        ->with('success', $msg);
    }

    public function edit($item)
    {
        $item = Blog::findOrFail($item);
        return view('admin.pages.blog.cadastrar-blog')
                ->with('item', $item);
    }

    public function destroy(Blog $blog)
    {

        if (!$blog) {
            return redirect()->route('blogs.index')->with('error', 'Blog não encontrado!');
        }

        if($blog->imagem){
            $uploadService = new UploadService();
            $uploadService->deletarImage($blog->imagem);
        }
        
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog removido com sucesso!');
    }


    /*
        * Categoria Methods
    */
    
    public function indexCategoria(Request $request)
    {
        $query = BlogCategoria::query();

        // Filtro por nome
        if ($request->filled('categoria')) {
            $query->where('categoria', 'like', '%' . $request->categoria . '%');
            $query->where('slug', 'like', '%' . $request->categoria . '%');
        }

        // Filtro por status
        if ($request->filled('status') && $request->status !== 'todos') {
            $query->where('status', $request->status);
        }

        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'desc');

        $items = $query->orderBy($sortField, $sortDirection)
                    ->paginate(10)
                    ->appends($request->all());

        return view('admin.pages.blog.index-categoria')
                ->with('items', $items)
                ->with('sortField', $sortField)
                ->with('sortDirection', $sortDirection);

    }

    public function createCategoria()
    {
        return view('admin.pages.blog.cadastrar-categoria');
    }

    public function editCategoria($item)
    {
        $item = BlogCategoria::findOrFail($item);
        return view('admin.pages.blog.cadastrar-categoria')
                ->with('item', $item);
    }

    public function storeCategoria(BlogCategoriaRequest $request, UploadService $uploadService)
    {
        $data = $request->all();
        $uploadService->uploadImagem($request->file('imagem'), BlogCategoria::class, $data);
        
        $data['slug'] = $request->slug ?? \Str::slug($request->categoria);
        
        $blogCategoria = BlogCategoria::updateOrCreate(
                    ['id' => $data['id'] ?? null],
                    $data
                );

        $msg = $data['id'] ? "Categoria atualizado com sucesso!" : "Categoria criado com sucesso!";
        
        return redirect()->route('admin.blog.categoria.index')->with('success', $msg);
    }

    public function destroyCategoria($item)
    {

        $item = BlogCategoria::findOrFail($item);
        if (!$item) {
            return redirect()->route('admin.blog.categoria.index')->with('error', 'Categoria não encontrado!');
        }

        // Verifica se existe algum blog usando esta categoria
        if ($item->blogs()->count() > 0) {
            return redirect()->route('admin.blog.categoria.index')->with('error', 'Esta categoria: <strong>'.$item->categoria.'</strong> não pode ser excluída porque ainda possui blogs vinculados.<br><br>Se desejar, você pode apenas desativá-la para que não seja exibido no site.');
        }

        if($item->imagem){
            $uploadService = new UploadService();
            $uploadService->deletarImage($item->imagem);
        }
        
        $item->delete();
        return redirect()->route('admin.blog.categoria.index')->with('success', 'Categoria removida com sucesso!');
    }

    /*
        * Categoria Methods
    */


    /*
        * Autor Methods
    */

    public function indexAutor(Request $request)
    {
        $query = BlogAutor::query();

        // Filtro por nome
        if ($request->filled('autor')) {
            $query->orWhere('autor', 'like', '%' . $request->autor . '%');
            $query->orWhere('slug', 'like', '%' . $request->autor . '%');
        }

        // Filtro por status
        if ($request->filled('status') && $request->status !== 'todos') {
            $query->where('status', $request->status);
        }

        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'desc');

        $items = $query->orderBy($sortField, $sortDirection)
                    ->paginate(10)
                    ->appends($request->all());

        return view('admin.pages.blog.index-autor')
                ->with('items', $items)
                ->with('sortField', $sortField)
                ->with('sortDirection', $sortDirection);

    }

    public function createAutor()
    {
        return view('admin.pages.blog.cadastrar-autor');
    }

    public function editAutor($item)
    {
        $item = BlogAutor::findOrFail($item);
        return view('admin.pages.blog.cadastrar-autor')
                ->with('item', $item);
    }

    public function storeAutor(BlogAutorRequest $request, UploadService $uploadService)
    {
        $data = $request->all();
        
        $uploadService->uploadImagem($request->file('imagem'), BlogAutor::class, $data);
        
        $data['slug'] = $request->slug ?? \Str::slug($request->autor);
        
        $blogCategoria = BlogAutor::updateOrCreate(
                    ['id' => $data['id'] ?? null],
                    $data
                );

        $msg = $data['id'] ? "Autor atualizado com sucesso!" : "Autor criado com sucesso!";
        
        return redirect()->route('admin.blog.autor.index')->with('success', $msg);
    }

    public function destroyAutor($item)
    {

        $item = BlogAutor::findOrFail($item);
        if (!$item) {
            return redirect()->route('admin.blog.autor.index')->with('error', 'Autor não encontrado!');
        }


        // Verifica se existe algum blog usando este autor
        if ($item->blogs()->count() > 0) {
            return redirect()->route('admin.blog.autor.index')->with('error', 'Este Autor(a): <strong>'.$item->autor.'</strong> não pode ser excluída porque ainda possui blogs vinculados.<br><br>Se desejar, você pode apenas desativá-lo para que não seja exibido no site.');
        }

        if($item->imagem){
            $uploadService = new UploadService();
            $uploadService->deletarImage($item->imagem);
        }
        
        $item->delete();
        return redirect()->route('admin.blog.autor.index')->with('success', 'Autor removido com sucesso!');
    }
}
