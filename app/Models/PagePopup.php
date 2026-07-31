<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagePopup extends Model
{
    use HasFactory;

    protected $table = 'pagePopups';
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'popup',
        'tipo',
    ];

    public function getDisplayNameAttribute()
    {
        return $this->nome;
    }

    public function getSettings(){
        return $this->hasMany(PageSettings::class, 'table_id', 'id')
            ->where('table', 'pagePopups')
            ->where('status', 1);
    } 
}
