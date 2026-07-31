<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSettings extends Model
{
    use HasFactory;

    protected $table = 'pageSettings';
    public $timestamps = false;

    protected $fillable = [
        'table',
        'table_id',
        'setting',
        'setting_id',
        'status',
    ];
}
