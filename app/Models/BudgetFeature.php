<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetFeature extends Model
{
    protected $fillable = ['name', 'sort_order', 'active'];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function plans()
    {
        return $this->belongsToMany(BudgetPlan::class, 'budget_feature_plan');
    }
}
