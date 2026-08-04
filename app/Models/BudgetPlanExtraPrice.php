<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetPlanExtraPrice extends Model
{
    protected $fillable = ['budget_plan_id', 'key', 'name', 'price', 'sort_order'];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function plan()
    {
        return $this->belongsTo(BudgetPlan::class, 'budget_plan_id');
    }
}
