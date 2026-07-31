<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Setting;
use App\Models\LeadContato;
use App\Models\LeadWhatsApp;
use App\Models\LeadCustomContato;
use App\Models\FormHubSpot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class LeadsService
{
    

    public function saveLead($data, $model)
    {
        if(!empty($data['0-1/email'])){
            $data['email'] = $data['0-1/email'];
        }

        if(!empty($data['0-1/firstname'])){
            $data['nome'] = $data['0-1/firstname'];
        }

        if(!empty($data['0-1/mobilephone'])){
            $data['whatsapp'] = $data['0-1/mobilephone'];
        }

        if(!empty($data['0-1/website'])){
            $data['url'] = $data['0-1/website'];
        }  

        if(!empty($data['0-2/website'])){
            $data['url'] = $data['0-2/website'];
        }  

        return $model::firstOrCreate([
            'email'     => $data['email'] ?? null,
            'form_type' => $data['form_type'],
        ], $data)->id;
    }

    public function createWhatsAppMessage($lead, $form){
        $whatsapp = (!empty($form) and $form->form_sent_url) ? $form->form_sent_url : getSettings('form_whatsapp_commercial_'.$lead->locale);
        $extraData = $lead->extra_data_label; 
        $segmento = !empty($extraData['0-2/qual_segmento_representa_melhor_seu_negocio']) ? $extraData['0-2/qual_segmento_representa_melhor_seu_negocio'] : '';
        $numemployees = !empty($extraData['0-1/numemployees']) ? $extraData['0-1/numemployees'] : '';
        $principal_necessidade = !empty($extraData['0-1/principal_necessidade']) ? $extraData['0-1/principal_necessidade'] : '';
        
        $mensagem = __('whatsapp.lead_message', [
            'site_name' => getSettings('site_name_short'),
            'nome'      => $lead->nome,
            'email'     => $lead->email,
            'whatsapp'  => $lead->whatsapp,
            'site'      => $lead->url ?? __('forms.no_website'),
            'segmento'  => $segmento ? "*" . __('forms.segment') . ":* " . $segmento : '',
            'numemployees' => $numemployees ? "*" . __('forms.numemployees') . ":* " . $numemployees : '',
            'principal_necessidade' => $principal_necessidade ? "*" . __('forms.principal_necessidade') . ":* " . $principal_necessidade : '',
        ]);
        return "https://wa.me/".preg_replace('/\D/', '', $whatsapp)."?text=" . urlencode($mensagem);
    }   
}
