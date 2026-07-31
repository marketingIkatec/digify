<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAdmin extends Model
{
    use HasFactory;

    protected $table = 'menuAdmin';
    public $timestamps = false;
    protected $fillable = [
        'menu',
        'titulo_do_menu',
        'menu_id',
        'icone',
        'route',
        'ordem',
        'is_search'
    ];

    // Menu pai
    public function parent(){
        return $this->belongsTo(MenuAdmin::class, 'menu_id');
    }

    // Menus filhos
    public function children(){
        return $this->hasMany(MenuAdmin::class, 'menu_id');
    }

    public function permissions(){
        return $this->hasMany(PermissionAdmin::class, 'menu_id');
    }

    public function childrenAllowed(){
        if (auth()->user()->is_master_admin) {
            return $this->children(); // exibe tudo
        }
        
        $userId = auth()->id();

        return $this->hasMany(MenuAdmin::class, 'menu_id')
                    ->whereHas('permissions', function ($q) use ($userId) {
                        $q->where('user_id', $userId)
                        ->where('can_view', 1);
                    })
                    ->orderBy('id');
    }

    public function getDisplayNameAttribute()
    {
        return $this->menu;
    }

}
