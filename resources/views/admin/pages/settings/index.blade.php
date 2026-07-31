@extends('admin.app')

@section('content')

@include('admin.layouts.tabmenu')

<div class="">
        @if (session('success'))
            <x-alert type="success" message="{{session('success')}}" />
        @endif

        <div class="row mb-5">
            <div class="col-md-8 space-y-6">
                <!-- Configurações Gerais do Site --> 
                <div class="bg-white shadow-sm sm:rounded-lg h-100">
                    <div class="bg-gray-800 rounded-top p-1">                        
                        <span class="title ps-2 text-white text-lg font-medium ">
                            <i class="fa fa-cogs"></i> 
                            Configurações Gerais do Site
                        </span>                        
                    </div>
                    <div class="p-4 sm:p-8">
                        <form method="post" action="{{ route('admin.setting.site.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            <div class="title-box">
                                <strong>Site em Português</strong>       
                                <div class="row mt-3 mb-3">                    
                                    <div class="col-md-8">
                                        <label for="site_name">Nome do Site</label>
                                        <input id="site_name" name="site_name" 
                                                type="text" class="form-control" 
                                                value="{{old('site_name', $configuracao['site_name'])}}">
                                        <x-input-error class="mt-2" :messages="$errors->get('site_name')" />
                                    </div>
                                    <div class="col-md-4">                        
                                        <label for="site_url">Url</label>
                                        <input id="site_url" name="site_url" 
                                                type="text" class="form-control" 
                                                value="{{old('site_url', $configuracao['site_url'])}}">
                                        <x-input-error class="mt-2" :messages="$errors->get('site_url')" />
                                    </div>
                                </div> 
                                 <div class="col-md-12">
                                    <label for="site_description">Descrição do Site <small>(Português)</small></label>
                                    <textarea id="site_description" rows="4" name="site_description" class="form-control">{{old('site_description', $configuracao['site_description'])}}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('site_description')" />
                                </div>   
                            </div>
                           
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary" name="SaveButton" value="settings">Salvar</button>
                            </div>
                        </form>                    
                    </div>
                </div>
                <!-- Configurações Gerais do Site --> 
            </div>
            <div class="col-md-4 space-y-6">
                <div class="image-upload upload-card sm:rounded-lg">
                    <form method="post" action="{{ route('admin.setting.site.update') }}" enctype="multipart/form-data" class="image-upload-form">
                        @csrf
                        @method('patch')
                        <div class="upload-header bg-gray-800 rounded-top p-1">
                            <span class="title ps-2 text-white text-lg font-medium">
                                <i class="fa fa-image"></i> 
                                Logo do Site - Header
                            </span>
                        </div>
                        <input type="file" name="logo_header" id="logo_header" class="upload-input hidden" accept="image/*">
                    
                        <div class="upload-body">
                            <div class="preview-area btn-upload image-upload-wrapper position-relative" id="preview-area">
                                @if($logoHeader = $configuracao['logo_header'])
                                    <img src="{{ asset('storage/'.$logoHeader) }}" alt="Logo Header" class="img-fluid">
                                @else
                                    <i class="fa fa-image preview-icon"></i>
                                @endif
                                <!-- Overlay no hover -->
                                <div class="overlay-text d-flex justify-content-center align-items-center">
                                    <span>Selecione uma imagem</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="image-upload upload-card sm:rounded-lg">
                    <form method="post" action="{{ route('admin.setting.site.update') }}" enctype="multipart/form-data" class="image-upload-form">
                        @csrf
                        @method('patch')
                        <div class="upload-header bg-gray-800 rounded-top p-1">
                            <span class="title ps-2 text-white text-lg font-medium">
                                <i class="fa fa-image"></i> 
                                Logo do Site - Footer
                            </span>
                        </div>
                        <input type="file" name="logo_footer" id="logo_footer" class="upload-input hidden" accept="image/*">
                    
                        <div class="upload-body btn-upload">
                            <div class="preview-area btn-upload image-upload-wrapper position-relative" id="preview-area">
                                @if($logoFooter = $configuracao['logo_footer'])
                                    <img src="{{ asset('storage/'.$logoFooter) }}" alt="Logo Footer" class="img-fluid">
                                @else
                                    <i class="fa fa-image preview-icon"></i>
                                @endif
                                <!-- Overlay no hover -->
                                <div class="overlay-text d-flex justify-content-center align-items-center">
                                    <span>Selecione uma imagem</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12 space-y-6">
                <!-- HubSpot -->
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="bg-gray-800 rounded-top p-1">
                        <div class="upload-header">
                            <span class="title text-white text-lg font-medium ps-2">
                                <i class="fa fa-cogs"></i> 
                                HubSpot Api
                                <br>
                                <small class="text-sm text-gray-300 ps-2">Configurações de integração com a Api HubSpot - Form por Whatsapp</small> 
                            </span>
                        </div>
                    </div>
                    <div class="p-4 sm:p-8">
                        <form method="post" action="{{ route('admin.setting.site.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            <div class="title-box">
                                <strong>Configuração Api HubSpot</strong>       
                                <div class="row mt-6">                    
                                    <div class="col-md-6">
                                        <label for="hubspot_portal_id">Portal ID</label>
                                        <input id="hubspot_portal_id" name="hubspot_portal_id" 
                                                type="text" class="form-control" 
                                                value="{{old('hubspot_portal_id', $configuracao['hubspot_portal_id'])}}">
                                        <x-input-error class="mt-2" :messages="$errors->get('hubspot_portal_id')" />
                                    </div>
                                
                                    <div class="col-md-6">
                                        <label for="hubspot_token">Token</label>
                                        <input id="hubspot_token" name="hubspot_token" 
                                                type="password" class="form-control" 
                                                value="{{old('hubspot_token', $configuracao['hubspot_token'])}}">
                                        <x-input-error class="mt-2" :messages="$errors->get('hubspot_token')" />
                                    </div>
                                </div>
                                <div class="row mt-6">   
                                    <div class="col-md-4">
                                        <label for="hubspot_form">Formulário de Demonstração</label>
                                        <div class="flex items-center gap-2">
                                            <input id="hubspot_form" name="hubspot_form" 
                                                type="text" class="form-control" 
                                                value="{{old('hubspot_form', $configuracao['hubspot_form'])}}"/>
                                            <a href="{{ route('admin.list-formulario-json', $configuracao['hubspot_form']) }}" target="_blank" title="visualizar campos do formulário"><x-heroicon-o-wrench-screwdriver class="w-5 h-5" /></a>
                                        </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('hubspot_form')" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="hubspot_form_whatsapp">Formulário WhatsApp</label>
                                        <div class="flex items-center gap-2">
                                            <input id="hubspot_form_whatsapp" name="hubspot_form_whatsapp" 
                                                type="text" class="form-control" 
                                                value="{{old('hubspot_form_whatsapp', $configuracao['hubspot_form_whatsapp'])}}"/>
                                            <a href="{{ route('admin.list-formulario-json', $configuracao['hubspot_form_whatsapp']) }}" target="_blank" title="visualizar campos do formulário"><x-heroicon-o-wrench-screwdriver class="w-5 h-5" /></a>
                                        </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('hubspot_form_whatsapp')" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="form_whatsapp">WhatsApp Comercial</label>
                                        <div class="flex items-center gap-2">
                                            <input id="form_whatsapp" name="form_whatsapp" 
                                                    type="text" class="form-control" 
                                                    value="{{old('form_whatsapp', $configuracao['form_whatsapp'])}}"
                                                    >
                                            <a href="{{ route('whatsapp.enviar', ['telefone' => $configuracao['form_whatsapp']]) }}" target="_blank" title="visualizar campos do formulário">
                                                <svg style="width: 18px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                                            </a>
                                            <x-input-error class="mt-2" :messages="$errors->get('form_whatsapp')" />
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                        
                    
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary" name="SaveButton" value="hubspot">Salvar</button>
                            </div>
                        </form>
                    </div>            
                </div>
                <!-- HubSpot -->

                <!-- Site -->
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="bg-gray-800 rounded-top p-1">
                        <div class="upload-header">
                            <span class="title text-white text-lg font-medium ps-2">
                                <i class="fa fa-cogs"></i> 
                                    Outras Configurações do Site 
                                <br>
                                <small class="text-sm text-gray-300 ps-2">
                                    Configurações diversas do site como redes sociais, e-mail e telefone    
                                </small> 
                            </span>
                        </div>
                    </div>
                    <div class="p-4 sm:p-8">
                        <form method="post" action="{{ route('admin.setting.site.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="site_email">E-mail Site</label>
                                    <input id="site_email" name="site_email" 
                                            type="text" class="form-control" 
                                            value="{{old('site_email', $configuracao['site_email'])}}">
                                    <x-input-error class="mt-2" :messages="$errors->get('site_email')" />
                                </div>
                                <div class="col-md-4">
                                    <label for="site_telefone">Telefone</label>
                                    <input id="site_telefone" name="site_telefone" 
                                            type="text" class="form-control" 
                                            value="{{old('site_telefone', $configuracao['site_telefone'])}}">
                                    <x-input-error class="mt-2" :messages="$errors->get('site_telefone')" />
                                </div>
                                <div class="col-md-4">
                                    <label for="site_endereco">Endereço</label>
                                    <input id="site_endereco" name="site_endereco" 
                                            type="text" class="form-control" 
                                            value="{{old('site_endereco', $configuracao['site_endereco'])}}">
                                    <x-input-error class="mt-2" :messages="$errors->get('site_endereco')" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="site_bairro">Bairro</label>
                                    <input id="site_bairro" name="site_bairro" 
                                            type="text" class="form-control" 
                                            value="{{old('site_bairro', $configuracao['site_bairro'])}}">
                                    <x-input-error class="mt-2" :messages="$errors->get('site_bairro')" />
                                </div>
                                <div class="col-md-4">
                                    <label for="site_cidade">Cidade</label>
                                    <input id="site_cidade" name="site_cidade" 
                                            type="text" class="form-control" 
                                            value="{{old('site_cidade', $configuracao['site_cidade'])}}">
                                    <x-input-error class="mt-2" :messages="$errors->get('site_cidade')" />
                                </div>
                                <div class="col-md-2">
                                    <label for="site_estado">Estado</label>
                                    <input id="site_estado" name="site_estado" 
                                            type="text" class="form-control" 
                                            value="{{old('site_estado', $configuracao['site_estado'])}}">
                                    <x-input-error class="mt-2" :messages="$errors->get('site_estado')" />
                                </div>

                                <div class="col-md-2">
                                    <label for="site_cep">Cep</label>
                                    <input id="site_cep" name="site_cep" 
                                            type="text" class="form-control" 
                                            value="{{old('site_cep', $configuracao['site_cep'])}}">
                                    <x-input-error class="mt-2" :messages="$errors->get('site_cep')" />
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <label for="linkedin">Linkedin</label>
                                    <input id="linkedin" name="linkedin" 
                                            type="text" class="form-control" 
                                            value="{{old('linkedin', $configuracao['linkedin'])}}">
                                    <x-input-error class="mt-2" :messages="$errors->get('linkedin')" />
                                </div>

                                <div class="col-md-4">
                                    <label for="telegram">Telegram</label>
                                    <input id="telegram" name="telegram" 
                                            type="text" class="form-control" 
                                            value="{{old('telegram', $configuracao['telegram'])}}">
                                    <x-input-error class="mt-2" :messages="$errors->get('telegram')" />
                                </div>

                                <div class="col-md-4">
                                    <label for="tiktok">Tiktok</label>
                                    <input id="tiktok" name="tiktok" 
                                            type="text" class="form-control" 
                                            value="{{old('tiktok', $configuracao['tiktok'])}}">
                                    <x-input-error class="mt-2" :messages="$errors->get('tiktok')" />
                                </div>

                                
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="youtube">Youtube</label>
                                    <input id="youtube" name="youtube" 
                                            type="text" class="form-control" 
                                            value="{{old('youtube', $configuracao['youtube'])}}">
                                    <x-input-error class="mt-2" :messages="$errors->get('youtube')" />
                                </div>
                                <div class="col-md-4">
                                    <label for="facebook">Facebook</label>
                                    <input id="facebook" name="facebook" 
                                            type="text" class="form-control" 
                                            value="{{old('facebook', $configuracao['facebook'])}}">
                                    <x-input-error class="mt-2" :messages="$errors->get('facebook')" />
                                </div>

                                 <div class="col-md-4">
                                    <label for="instagram">Instagram</label>
                                    <input id="instagram" name="instagram" 
                                            type="text" class="form-control" 
                                            value="{{old('instagram', $configuracao['instagram'])}}">
                                    <x-input-error class="mt-2" :messages="$errors->get('instagram')" />
                                </div>

                               

                            </div>
                            <div class="row">
                                 <div class="col-md-12">
                                    <label for="note_footer">Descrição no Footer</label>
                                    <input id="note_footer" name="note_footer" 
                                            type="text" class="form-control" 
                                            value="{{old('note_footer', $configuracao['note_footer'])}}">
                                    <x-input-error class="mt-2" :messages="$errors->get('note_footer')" />
                                </div>

                            </div>
                    
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary" name="SaveButton" value="site">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Site -->
            </div>
        </div>


    </div>
    
@endsection
