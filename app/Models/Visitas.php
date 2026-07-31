<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Blog;
use App\Models\BlogCategoria;
use App\Models\BlogAutor;

class Visitas extends Model
{
    protected $fillable = [
        'ip', 
        'pais', 
        'regiao', 
        'latitude', 
        'longitude', 
        'cidade', 
        'pagina', 
        'pagina_id', 
        'data'
    ];
    protected $casts = [
        'data' => 'datetime',
    ];
    protected $table = 'visitas';
    public $timestamps = false;

    protected $appends = ['data_br'];
    public function getDataBrAttribute()
    {
        return $this->data ? $this->data->format('d/m/Y H:i') : null;
    }

    public function getModelPaginaAttribute()
    {
        return match ($this->pagina) {
            'blog' => Blog::find($this->pagina_id),
            'blog/categoria' => BlogCategoria::find($this->pagina_id),
            'blog/autor' => BlogAutor::find($this->pagina_id),
            default => null,
        };
    }

    public function getPaginaNomeAttribute()
    {
        $model = $this->model_pagina; // usa o accessor que você já criou

        if (!$model) {
            return $this->pagina;
        }

        return match ($this->pagina) {
            'blog' => $model->titulo ?? null,
            'blog/categoria' => $model->categoria ?? null,
            'blog/autor' => $model->autor ?? null,
            default => null,
        };
    }
    
}
