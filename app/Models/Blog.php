<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'imagem',
        'titulo',
        'autor_id',
        'slug',
        'resumo',
        'conteudo',
        'data_blog',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
    ];

    protected $dates = ['data_blog'];
    protected $casts = [
        'data_blog' => 'date',
    ];

    public function categorias()
    {
        return $this->belongsToMany(
            BlogCategoria::class,       // model relacionado
            'blogs_categorias',     // tabela pivô
            'id_blog',              // chave estrangeira local
            'id_categoria'          // chave estrangeira relacionada
        )->where('blogsCategoria.status', 1);
    }

    public function autor()
    {
        return $this->belongsTo(BlogAutor::class, 'autor_id', 'id')->where('status', 1);
    }

    public function fotos()
    {
        return $this->hasMany(BlogFoto::class, 'blog_id', 'id')->where('status', 1);
    }

    public function getDataBlogBrAttribute(){
        return $this->data_blog ? $this->data_blog->format('d/m/Y') : null;
    }

    public function getDisplayNameAttribute()
    {
        return $this->titulo;
    }


    public function visitas(){
        return $this->hasMany(\App\Models\Visitas::class, 'pagina_id')
            ->where('pagina', 'blog');
    }

    public function getSettings(){
        return $this->hasMany(\App\Models\PageSettings::class, 'table_id', 'id')
            ->where('table', 'blog');
    } 

}
