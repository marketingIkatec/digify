<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogImprensa extends Model
{
    use HasFactory;

    protected $table = 'blogImprensa';

    protected $fillable = [
        'id',
        'imprensa',
        'imagem',
        'url',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function naMidias()
    {
        return $this->hasMany(NaMidia::class, 'id_imprensa', 'id');
    }

    public function getDisplayNameAttribute()
    {
        return $this->imprensa;
    }
}
