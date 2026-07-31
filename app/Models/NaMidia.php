<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class NaMidia extends Model
{
    use HasFactory;

    protected $table = 'naMidia';

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'imagem',
        'published_at',
        'source_url',
        'autor_id',
        'id_imprensa',
        'categoria_id',
        'brand',
        'status',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'status' => 'boolean',
    ];

    public function autor()
    {
        return $this->belongsTo(BlogAutor::class, 'autor_id', 'id');
    }

    public function imprensa()
    {
        return $this->belongsTo(BlogImprensa::class, 'id_imprensa', 'id');
    }

    public function categoria()
    {
        return $this->belongsTo(BlogCategoria::class, 'categoria_id', 'id');
    }

    public function getDisplayNameAttribute()
    {
        return $this->title;
    }

    public function getImagemUrlAttribute()
    {
        if (!$this->imagem) {
            return null;
        }

        if (str_starts_with($this->imagem, 'http://') || str_starts_with($this->imagem, 'https://')) {
            return $this->imagem;
        }

        if (str_starts_with($this->imagem, '/storage/')) {
            return $this->imagem;
        }

        return asset('storage/' . $this->imagem);
    }

    /**
     * Scope para filtrar por marca.
     */
    public function scopeBrand(Builder $query, ?string $brand): Builder
    {
        if (!$brand || strtolower($brand) === 'todos') {
            return $query;
        }

        return $query->where('brand', 'like', $brand);
    }

    /**
     * Scope para filtrar por categoria.
     */
    public function scopeCategoria(Builder $query, ?string $categoriaId): Builder
    {
        if (!$categoriaId || strtolower($categoriaId) === 'todos') {
            return $query;
        }

        return $query->where('categoria_id', $categoriaId);
    }

    /**
     * Scope para buscar por termo no título, resumo, conteúdo, autor ou veículo.
     */
    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if (!$search) {
            return $query;
        }

        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
               ->orWhere('excerpt', 'like', "%{$search}%")
               ->orWhere('content', 'like', "%{$search}%")
              ->orWhereHas('autor', function ($authorQuery) use ($search) {
                  $authorQuery->where('autor', 'like', "%{$search}%");
              })
              ->orWhereHas('categoria', function ($categoryQuery) use ($search) {
                  $categoryQuery->where('categoria', 'like', "%{$search}%");
              })
              ->orWhereHas('imprensa', function ($publisherQuery) use ($search) {
                  $publisherQuery->where('imprensa', 'like', "%{$search}%");
              });
        });
    }
}
