@extends('admin.app')

@section('content')

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
                        <form method="post" action="{{ route('admin.update.settings') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            <div class="title-box">
                                <strong>Site</strong>       
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
                    <form method="post" action="{{ route('admin.update.settings') }}" enctype="multipart/form-data" class="image-upload-form">
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
                    <form method="post" action="{{ route('admin.update.settings') }}" enctype="multipart/form-data" class="image-upload-form">
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
                        <form method="post" action="{{ route('admin.update.settings') }}" class="mt-6 space-y-6">
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
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="whatsapp">Whatsapp - Lead</label>
                                    <input id="whatsapp" name="whatsapp" 
                                            type="text" class="form-control" 
                                            value="{{old('whatsapp', $configuracao['whatsapp'])}}">
                                    <x-input-error class="mt-2" :messages="$errors->get('whatsapp')" />
                                </div>

                                <div class="col-md-4">
                                    <label for="linkedin">Linkedin</label>
                                    <input id="linkedin" name="linkedin" 
                                            type="text" class="form-control" 
                                            value="{{old('linkedin', $configuracao['linkedin'])}}">
                                    <x-input-error class="mt-2" :messages="$errors->get('linkedin')" />
                                </div>
                            </div>

                            <div class="row">

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

                                <div class="col-md-4">
                                    <label for="youtube">Youtube</label>
                                    <input id="youtube" name="youtube" 
                                            type="text" class="form-control" 
                                            value="{{old('youtube', $configuracao['youtube'])}}">
                                    <x-input-error class="mt-2" :messages="$errors->get('youtube')" />
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-4">
                                    <label for="facebook">Facebook <strong>(Português)</strong></label>
                                    <input id="facebook" name="facebook" 
                                            type="text" class="form-control" 
                                            value="{{old('facebook', $configuracao['facebook'])}}">
                                    <x-input-error class="mt-2" :messages="$errors->get('facebook')" />
                                </div>

                            </div>
                            <div class="row">    

                                <div class="col-md-4">
                                    <label for="instagram">Instagram <strong>(Português)</strong></label>
                                    <input id="instagram" name="instagram" 
                                            type="text" class="form-control" 
                                            value="{{old('instagram', $configuracao['instagram'])}}">
                                    <x-input-error class="mt-2" :messages="$errors->get('instagram')" />
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="note_footer">Descrição no Footer <strong>(Português)</strong></label>
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
