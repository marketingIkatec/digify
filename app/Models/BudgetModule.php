<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetModule extends Model
{
    protected $fillable = ['key', 'name', 'price', 'sort_order', 'active'];

    protected $casts = [
        'price' => 'decimal:2',
        'active' => 'boolean',
    ];

    public function plans()
    {
        return $this->belongsToMany(BudgetPlan::class, 'budget_module_plan');
    }
}
