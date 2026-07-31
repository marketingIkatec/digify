<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogAutor extends Model
{
    use HasFactory;

    protected $table = 'blogsAutor';

    protected $fillable = [
        'id',
        'autor',
        'imagem',
        'slug',
        'resumo',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
    ];

    public function blogs(){
        return $this->hasMany(Blog::class, 'autor_id', 'id');
    }

    public function naMidias()
    {
        return $this->hasMany(NaMidia::class, 'autor_id', 'id');
    }

    public function scopeAtivasComBlogs($query){
        return $query->where('status', 1)
                     ->whereHas('blogs', function ($q) {
                     $q->where('status', 1);
                 });
    }

    public function getDisplayNameAttribute()
    {
        return $this->autor;
    }
}
