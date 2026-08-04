<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetPlan extends Model
{
    protected $fillable = ['key', 'name', 'price', 'details', 'sort_order', 'active'];

    protected $casts = [
        'price' => 'decimal:2',
        'details' => 'array',
        'active' => 'boolean',
    ];

    public function extraPrices()
    {
        return $this->hasMany(BudgetPlanExtraPrice::class);
    }

    public function modules()
    {
        return $this->belongsToMany(BudgetModule::class, 'budget_module_plan');
    }

    public function features()
    {
        return $this->belongsToMany(BudgetFeature::class, 'budget_feature_plan');
    }
}
