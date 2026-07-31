@extends('admin.app')

@section('content')
    <form action="{{ route('admin.setting.hubspot.store') }}" method="POST">
    @csrf
    <input type="hidden" value="{{ old('id', $item->id ?? '') }}" name="id" id="id">

    <x-actions-save-cancel :isStatus="false" :item="$item ?? false" />    

    <div class="row">
        <div class="col-md-12">
            <div class="row mb-5">
                <!-- Configurações Gerais do Site --> 
                <div class="col-md-6">                
                    <div class="bg-gray-800 rounded-top p-1">
                        <span class="title ps-2 text-white text-lg font-medium">
                            <i class="fa fa-list"></i> 
                            Formulário da HubSpot
                        </span>
                    </div>               
                    
                    <div class="p-4 sm:p-8 bg-white shadow">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label">Nome do Formulário</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $item->name ?? '') }}">
                                @error('name') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="form_name" class="form-label">Nome de Identificação(Hubspot) </label>
                                <input type="text" name="form_name" class="form-control @error('form_name') is-invalid @enderror" value="{{ old('form_name', $item->form_name ?? '') }}">
                                @error('form_name') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                        
                            <div class="col-md-12 mb-3">
                                <label for="form_id" class="form-label">Id do Formulário</label>
                                <input type="text" name="form_id" class="form-control @error('form_id') is-invalid @enderror" value="{{ old('form_id', $item->form_id ?? '') }}">
                                @error('form_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="form_title_button" class="form-label">Título do Botão</label>
                                <input type="text" name="form_title_button" class="form-control @error('form_title_button') is-invalid @enderror" value="{{ old('form_title_button', $item->form_title_button ?? '') }}">
                                @error('form_title_button') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="form_sent" class="form-label">Depois de Enviado</label>
                                <select name="form_sent" id="form_sent" class="form-control @error('form_sent') is-invalid @enderror">
                                    <option value=""></option>
                                    <option value="tela_obrigado" {{ old('form_sent', $item->form_sent ?? '') == 'tela_obrigado' ? 'selected' : '' }}>Mostrar Tela de Obrigado</option>
                                    <option value="tela_obrigado_whatsapp" {{ old('form_sent', $item->form_sent ?? '') == 'tela_obrigado_whatsapp' ? 'selected' : '' }}>Mostrar Tela de Obrigado + Conversa WhatsApp</option>
                                    <option value="whatsapp" {{ old('form_sent', $item->form_sent ?? '') == 'whatsapp' ? 'selected' : '' }}>Conversa WhatsApp</option>
                                    <option value="url" {{ old('form_sent', $item->form_sent ?? '') == 'url' ? 'selected' : '' }}>URL</option>
                                    <option value="aba2" {{ old('form_sent', $item->form_sent ?? '') == 'aba2' ? 'selected' : '' }}>Mostrar Aba2(Popup)</option>
                                    <option value="step-success" {{ old('form_sent', $item->form_sent ?? '') == 'step-success' ? 'selected' : '' }}>Mostrar Step-Success</option>
                                </select>
                                @error('form_sent') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                            <div class="col-md-12 mb-3" id="formsenturl" style = "display: @if((old('form_sent', $item->form_sent ?? '') == 'url') || old('form_sent', $item->form_sent ?? '') == 'tela_obrigado_whatsapp') || old('form_sent', $item->form_sent ?? '') == 'whatsapp')) ? 'block' : 'none' @endif>
                                <label for="form_sent_url" class="form-label">URl</label>
                                <input type="text" name="form_sent_url" class="form-control @error('form_sent_url') is-invalid @enderror" value="{{ old('form_sent_url', $item->form_sent_url ?? '') }}">
                                @error('form_sent_url') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                                

                            <div class="col-md-12 mb-3">
                                <label for="form_table" class="form-label">Tabela</label>
                                <select name="form_table" class="form-control @error('form_sent') is-invalid @enderror">
                                    <option value=""></option>
                                    <option value="App\Models\LeadContato" {{ old('form_table', $item->form_table ?? '') == 'App\Models\LeadContato' ? 'selected' : '' }}>Leads - Contato</option>
                                    <option value="App\Models\LeadCustomContato" {{ old('form_table', $item->form_table ?? '') == 'App\Models\LeadCustomContato' ? 'selected' : '' }}>Leads - Customizado</option>
                                    <option value="App\Models\LeadWhatsApp" {{ old('form_table', $item->form_table ?? '') == 'App\Models\LeadWhatsApp' ? 'selected' : '' }}>Leads - WhatsApp</option>
                                </select>
                                @error('form_table') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                        
                            <div class="col-md-12 mb-3">
                                <label for="form_embedded" class="form-label">Formulário Incorporado</label>
                                <textarea name="form_embedded" class="form-control @error('form_embedded') is-invalid @enderror">{{ old('form_embedded', $item->form_embedded ?? '') }}</textarea>
                                @error('form_embedded') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Configurações Gerais do Site --> 
                <div class="col-md-6 ">                
                    <div class="bg-gray-800 rounded-top p-1">
                        <span class="title ps-2 text-white text-lg font-medium">
                            <i class="fa fa-list"></i> 
                            Campos do Formulário - HubSpot
                        </span>
                    </div>               
                    
                    <div class="p-4 sm:p-8 bg-white shadow">    
                        <fieldset class="form-hubspot border p-4 mb-4">
                            <div class="alert alert-info">
                                <input type="checkbox" name="reset_form" id="reset_form" value="1" style="top: -8px;position: relative;">
                                Marque esta opção para limpar os campos do formulário e obter os campos mais recentes da HubSpot. 
                                Use esta opção se você tiver atualizado o formulário na HubSpot e deseja refletir essas alterações aqui.
                            </div>
                            @if(!empty($item))
                                <div class="resetForm">                            
                                    <div class="mt-4 border p-4 rounded" style="display:grid; grid-template-columns:repeat(1,1fr); gap:1rem;background-color: #004fbb;color: #fff;">
                                        {!! !empty($item) ? $item->form_hub_spot : '' !!}
                                        <a href="javascript:;" class="btn btn-light btn-sm" style="width: 100%; margin-top: 1rem;">{{$item->form_title_button}}</a>
                                    </div>                            
                                </div>
                            @endif
                        </fieldset>
                        
                        
                    </div>
                </div>
                <!-- Configurações Gerais do Site --> 
                <div class="mt-6 flex items-center gap-2">
                    <a href="{{ route('admin.setting.hubspot.index') }}" class="btn btn-secondary">Voltar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const resetCheckbox = document.getElementById('reset_form');        
        const resetFormContainer = document.querySelector('.resetForm');

        resetCheckbox.addEventListener('change', function() {
            if (this.checked) {
                // Limpa os campos do formulário
                resetFormContainer.innerHTML = '';
            } else {
                // Recarrega os campos do formulário (opcional, dependendo de como você deseja lidar com isso)
                // Você pode optar por recarregar a página ou fazer uma chamada AJAX para obter os campos atualizados
                location.reload();
            }
        });

        const selectFormSent = document.getElementById('form_sent');
        const divFormSent = document.getElementById('formsenturl');
        selectFormSent.addEventListener('change', function() {
            divFormSent.style.display = 'none';
            if (this.value == 'url' || this.value == 'tela_obrigado_whatsapp' || this.value == 'whatsapp') {
                divFormSent.style.display = 'block';
            }
        });
    });
</script>

@endsection


