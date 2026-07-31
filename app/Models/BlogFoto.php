<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogFoto extends Model
{
    protected $table = 'blogsFotos';

    protected $fillable = [
        'imagem',
        'alt',
        'description',
        'blog_id',
        'status',
    ];
    public $timestamps = true;

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'blog_id', 'id');
    }
}
