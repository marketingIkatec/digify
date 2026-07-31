<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageBlockType extends Model
{
    use HasFactory;

    protected $table = 'pageBlockType';
    public $timestamps = false;

    protected $fillable = [
        'type',
    ];
}
