<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormHubSpot extends Model
{
    use HasFactory;

    protected $table = 'formHubSpot';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'form_name',
        'form_id',
        'form_embedded',
        'form_fields',
        'form_sent',
        'form_sent_url',        
        'form_table',
        'form_title_button',
        'form_captcha',
        'form_corporate_email',
    ];

    protected $casts = [
        'form_fields' => 'array', // JSON automático
        'form_captcha' => 'boolean',
        'form_corporate_email' => 'boolean',
    ];

    public function getDisplayNameAttribute()
    {
        return $this->name;
    }

    public function getFormHubSpotAttribute()
    {
       $apiHubspot = new \App\Services\HubspotCampaignService();
       $fields = $apiHubspot->listForm($this->id);

       return $fields['saidaHtml'] ?? [];
    }
}
