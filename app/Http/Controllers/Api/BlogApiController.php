<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
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
use Illuminate\Validation\Rules;

class BlogApiController extends Controller
{
   
    public function testConnection(Request $request){
        $data = $request->all();  
        return response()->json([$data], 200);   
    }

    public function publishBlog(Request $request)
    {       
        if($request->slug_blog){
            $blog = Blog::where('slug', $request->slug_blog)->firstOrFail();
            $blog->status = 1;
            $blog->Save();
            return response()->json(['status' => 200, 'mensagem' => 'Blog publicado com Sucesso!'], 200);
        }
        return response()->json(['status' => 'error', 'mensagem' => 'Blog Não publicado'], 422);    
    }

    public function store(Request $request)
    {       
        $data = $request->all();
        if(!empty($data['autor']) && !empty($data['titulo'])){
            // processa as categorias
            if(!empty($request['categorias'])){
                $categorias = explode(', ', $request['categorias']);
                $categoriaIds = collect($categorias)->map(function ($categoria) {
                    // se for número, já existe
                    if (is_numeric($categoria)) {
                        return (int) $categoria;
                    }

                    // senão, cria e retorna o id
                    $categorias = ['categoria' => trim($categoria), 'slug' => \Str::slug($categoria), 'status' => 1];
                    return BlogCategoria::firstOrCreate($categorias)->id;
                });
            }

            $data = $request->all();
            if(!empty($data['autor'])){
                $dataAutor['slug']   = \Str::slug($request->autor);
                $dataAutor['autor']  = $request->autor;
                $dataAutor['status'] = 1;
                        
                $blogAutor = BlogAutor::updateOrCreate(
                    ['autor' => $dataAutor['autor']],
                    $dataAutor
                );
                $data['autor_id'] = $blogAutor->id;
            }
        
            $data['slug'] = $request->slug ?? \Str::slug($request->titulo);

            if (!empty($request->imagem)) {
                $url = $request->imagem;
                $path = parse_url($url, PHP_URL_PATH);
                $prefixo = '/storage/blogs/';

                $host = parse_url($url, PHP_URL_HOST);
                $arquivo = basename($path ?? '');

                if ($host === 'digisac.com.br' && str_starts_with($path ?? '', $prefixo) && Storage::disk('public')->exists('blogs/' . $arquivo)){
                    $data['imagem'] = 'blogs/' . $arquivo;
                }
            }
            
            $data['data_blog'] = $request->data_blog;
            
            $data['meta_title']       = $request->titulo; 
            $data['meta_description'] = $request->resumo; 
            $data['meta_keywords']    = $request->categorias ?? null; 

            $blog = Blog::updateOrCreate(
                ['slug' => $data['slug'] ?? null],
                $data
            );

            if(!empty($categoriaIds)){
                $blog->categorias()->sync($categoriaIds);
            }        

            return response()->json(['status' => 200, 'mensagem' => 'Blog incluído com Sucesso!'], 200);
        
        }
        return response()->json(['status' => 'error', 'mensagem' => 'Titulo ou Autor em branco!'], 422);
    }

    public function uploadImage(Request $request){
        $validator = \Validator::make($request->all(), [
            'openaiFileIdRefs' => 'required|array|size:1',
            'openaiFileIdRefs.0.download_link' => 'required|url',
        ]);

        if ($validator->fails()) {

            \Log::warning('DIGISAC UPLOAD - ERRO VALIDACAO', [
                'errors' => $validator->errors()->toArray(),
            ]);

            return response()->json([
                'status' => 'error',
                'mensagem' => 'Dados de upload inválidos.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();


        $url = $validated['openaiFileIdRefs'][0]['download_link'];

        // Aceita somente o domínio de arquivos do ChatGPT.
        // Outros hosts devem ser adicionados somente após validação.
        $host = strtolower(parse_url($url, PHP_URL_HOST) ?? '');
        $scheme = strtolower(parse_url($url, PHP_URL_SCHEME) ?? '');

        $hostsPermitidos = ['files.oaiusercontent.com', 'sdmntprbrazilsouth.oaiusercontent.com'];

        if ($scheme !== 'https' || !in_array($host, $hostsPermitidos, true)) {
            Log::warning('Host de imagem não permitido', [
                'host' => $host,
                'scheme' => $scheme,
            ]);
            return response()->json([
                'status' => 'error',
                'mensagem' => 'Origem da imagem não autorizada.',
            ], 422);
        }

        try {
            $response = Http::timeout(20)
                ->withOptions([
                    'allow_redirects' => false,
                    'decode_content' => false,
                ])
                ->get($url);

            if (!$response->successful()) {
                \Log::warning('DIGISAC UPLOAD - FALHA DOWNLOAD', [
                    'http_status' => $response->status(),
                    'content_type' => $response->header('Content-Type'),
                    'host' => $host,
                ]);

                return response()->json([
                    'status' => 'error',
                    'mensagem' => 'Não foi possível baixar a imagem.',
                    'download_status' => $response->status(),
                ], 422);
            }

            Log::info('Resposta do download de imagem', [
                'status_http' => $response->status(),
                'content_type' => $response->header('Content-Type'),
            ]);

            $imagem = $response->body();

            // Limite de 10 MB
            if (strlen($imagem) > 10 * 1024 * 1024) {
                return response()->json([
                    'status' => 'error',
                    'mensagem' => 'Imagem maior que 10 MB.'
                ], 422);
            }

            // Verifica o conteúdo real, não apenas a extensão.
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->buffer($imagem);

            $formatos = [
                'image/jpeg' => 'jpg',
                'image/png'  => 'png',
                'image/webp' => 'webp',
            ];

            if (!isset($formatos[$mime]) ||
                @getimagesizefromstring($imagem) === false) {
                return response()->json([
                    'status' => 'error',
                    'mensagem' => 'Formato de imagem inválido.'
                ], 422);
            }

            $extensao = $formatos[$mime];

            // Nome único para evitar sobrescrita.
            $nomeArquivo = 'chatgpt-' . Str::uuid() . '.' . $extensao;

            $caminho = 'blogs/' . $nomeArquivo;

            $salvo = Storage::disk('public')->put(
                $caminho,
                $imagem
            );

            if (!$salvo) {
                throw new \RuntimeException('Falha ao salvar imagem.');
            }

            return response()->json([
                'status' => 200,
                'mensagem' => 'Imagem enviada com sucesso!',
                'imagem' => $caminho,
                'url' => asset('storage/' . $caminho),
            ], 200);

        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'status' => 'error',
                'mensagem' => 'Erro ao processar a imagem.'
            ], 500);
        }
    }

}
