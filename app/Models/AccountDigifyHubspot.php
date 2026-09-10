<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountDigifyHubspot extends Model
{
    use HasFactory;

    protected $table = 'accountDigifyHubspot';

    protected $fillable = [
        'id',
        'email',
        'digify_account_id',
        'hubspot_account_id',
        'hubspot_deal_id',
        'first_login'
    ];

    protected $casts = [
        'first_login' => 'datetime',
        'properties'  => 'array',
    ];

    public function updateProperties(array $properties): void
    {
        $this->properties = array_merge(
            $this->properties ?? [],
            $properties
        );

        $this->save();
    }
}
