<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageBlock extends Model
{
    use HasFactory;

    protected $table = 'pageBlock';
    public $timestamps = true;

    protected $fillable = [
        'page_id',
        'nome_dobra',
        'tipo_bloco',
        'titulo',
        'subtitulo2',
        'subtitulo3',
        'conteudo',
        'configuracao',
        'ordem',
        'status',
    ];

    protected $casts = [
        'configuracao' => 'array', // JSON automático
        'status'   => 'boolean',
    ];

    /**
     * Bloco pertence a uma página
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function getDisplayNameAttribute()
    {
        return $this->nome_dobra;
    }

    public function getSettings(){
        return $this->hasMany(PageSettings::class, 'table_id', 'id')
            ->where('table', 'pageBlock');
    } 
}
