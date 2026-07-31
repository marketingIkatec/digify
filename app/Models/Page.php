<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table = 'page';
    public $timestamps = false;
    protected $fillable = [
        'page_id',
        'titulo',
        'slug',
        'descricao',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'ordem', 
        'locale',        
        'css_app', 
        'header_footer',       
        'svg',        
        'imagem',        
        'status',        
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /* Página pai */
    public function parent()
    {
        return $this->belongsTo(self::class, 'page_id');
    }

    /* Páginas filhas */
    public function children()
    {
        return $this->hasMany(self::class, 'page_id')
            ->orderBy('ordem');
    }

    /* Filhos recursivos (árvore completa) */
    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    /**
     * Uma Page possui vários blocos
     */
    public function blocks()
    {
        return $this->hasMany(PageBlock::class)->orderBy('ordem');
    }

    public function getDisplayNameAttribute()
    {
        return $this->titulo;
    }

    public function getSettings(){
        return $this->hasMany(PageSettings::class, 'table_id', 'id')
            ->where('table', 'page')
            ->where('status', 1);
    } 
}
