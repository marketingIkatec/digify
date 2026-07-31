<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageBlockConfig extends Model
{
    use HasFactory;

    protected $table = 'pageBlockConfig';
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'configuracao',
        'tipo',
    ];
}
