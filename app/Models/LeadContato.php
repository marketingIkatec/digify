<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Visitas;

class LeadContato extends Model
{
    protected $table = 'leadsContato';

    protected $fillable = [
        'nome',
        'email',
        'whatsapp',
        'url',
        'voce_e_cliente',
        'extra_data',
        'form_type',
        'locale',
        'mensagem',
        'visita_id',
        'estado'
    ];

    // Campos que **não** devem aparecer no JSON
    protected $hidden = [
        'status',
        'created_at',
        'updated_at',
    ];

     protected $casts = [
        'extra_data' => 'array', // JSON automático
     ];

    protected $appends = ['status_label', 'created_at_br'];

    public function visita(){
        return $this->belongsTo(Visitas::class, 'visita_id');
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            0 => '<span class="text-red-600">Não enviado para o HubSpot</span>',
            1 => '<span class="text-green-600">Enviado para o HubSpot</span>',
            2 => '<span class="text-red-600">Excluído</span>',
        };
    }

    public function getExtraDataLabelAttribute()
    {
         $labels = [];
         $labels['nome'] = $this->nome;
         $labels['email'] = $this->email;
         $labels['whatsapp'] = $this->whatsapp;
         $labels['form_type'] = $this->form_type;
         $labels['url'] = $this->url;
         if($this->mensagem){
            $labels['necessidade'] = $this->mensagem;
         }
         
        
         if(!empty($this->extra_data)){
            $extra_data = json_decode($this->extra_data, true);
            foreach($extra_data as $key => $value) {
                if($value != '')
                    $labels[$key] = $value;        
            }
         }
         
         $labels['locale'] = $this->getLocaleLabelAttribute();
         $labels['data'] = $this->getCreatedAtBrAttribute();
         $labels['status'] = $this->getStatusLabelAttribute();
        return $labels;
    }

    public function getLocaleLabelAttribute()
    {
        return match($this->locale) {
            'pt' => 'Português',
            'es' => 'Espanhol',
            'en' => 'Inglês',
        };
    }

    public function getVoceEClienteLabelAttribute()
    {
        return match($this->voce_e_cliente) {
            'N/A' => '',
            '1' => 'Sim, sou cliente',
            '2' => 'Não, não sou cliente ainda',
            '0' => 'Já fui cliente',
        };
    }
    
    public function getCreatedAtBrAttribute()
    {
        return $this->created_at ? $this->created_at->format('d/m/Y H:i') : null;
    }
}
