<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadWhatsApp extends Model
{
    /**
     * Define a tabela usada pelo model.
     */
    protected $table = 'leadsWhatsapp';
    
    /**
     * Define os campos que podem ser preenchidos em massa.
     */
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
    ];

    // Campos que **não** devem aparecer no JSON
    protected $hidden = [
        'voce_e_cliente',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'extra_data' => 'array', // JSON automático
    ];

    protected $appends = ['voce_e_cliente_label', 'status_label', 'created_at_br'];

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            0 => '<span class="text-red-600">Não enviado para o HubSpot</span>',
            1 => '<span class="text-green-600">Enviado para o HubSpot</span>',
            2 => '<span class="text-red-600">Excluído</span>',
        };
    }

    public function getVoceEClienteLabelAttribute()
    {
        return match($this->voce_e_cliente) {
            'N/A' => '',
            '1' => 'Sim, sou cliente',
            '2' => 'Não, não sou cliente ainda',
            '0' => 'Já fui cliente',
            default => null,
        };
    }

    public function getLocaleLabelAttribute()
    {
        return match($this->locale) {
            'pt' => 'Português',
            'es' => 'Espanhol',
            'en' => 'Inglês',
        };
    }

    public function getExtraDataLabelAttribute()
    {
         $labels = [];
         $labels['nome'] = $this->nome;
         $labels['email'] = "<a href='".route('admin.view-contato-hubspot', ['email' => $this->email])."' target='_blank' style='color: #0a50ff;text-decoration: underline;font-weight: bold;'>".$this->email."</a>";
         $labels['whatsapp'] = $this->whatsapp;
         $labels['form_type'] = $this->form_type;
         $labels['url'] = $this->url;
         if($this->mensagem){
            $labels['necessidade'] = $this->mensagem;
         }
         $labels['locale'] = $this->getLocaleLabelAttribute();
        
         if(!empty($this->extra_data)){
            $extra_data = json_decode($this->extra_data, true);
            foreach($extra_data as $key => $value) {
                if($value != '')
                    $labels[$key] = $value;        
            }
         }
         
         $labels['data'] = $this->getCreatedAtBrAttribute();
         $labels['status'] = $this->getStatusLabelAttribute();
        return $labels;
    }

    public function getCreatedAtBrAttribute()
    {
        return $this->created_at ? $this->created_at->format('d/m/Y H:i') : null;
    }
}
