<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategoria extends Model
{
    protected $table = 'blogsCategoria';

    protected $fillable = [
        'categoria',
        'imagem',
        'resumo',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'slug',
        'status',
    ];
    public $timestamps = false;

    public function blogs()
    {
        return $this->belongsToMany(
            Blog::class,
            'blogs_categorias',
            'id_categoria',
            'id_blog'
        );
    }

    public function naMidias()
    {
        return $this->hasMany(NaMidia::class, 'categoria_id', 'id');
    }

    public function scopeAtivasComBlogs($query){
        return $query->where('status', 1)
                    ->whereHas('blogs', function ($q) {
                     $q->where('status', 1);
                 });
    }

    public function getDisplayNameAttribute()
    {
        return $this->categoria;
    }

}
