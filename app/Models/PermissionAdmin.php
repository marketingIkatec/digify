<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionAdmin extends Model
{
    use HasFactory;

    protected $table = 'permissionAdmin';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'menu_id',
        'can_view',
        'can_create',
        'can_edit',
        'can_delete',
        'can_report',
    ];

    protected $casts = [
        'can_view'   => 'boolean',
        'can_create' => 'boolean',
        'can_edit'   => 'boolean',
        'can_delete' => 'boolean',
        'can_report' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menu()
    {
        return $this->belongsTo(MenuAdmin::class, 'menu_id');
    }
    
}
