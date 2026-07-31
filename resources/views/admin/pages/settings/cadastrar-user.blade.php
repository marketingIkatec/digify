@extends('admin.app')

@php
    $userPermissions = $item ? $item->permissions->keyBy('menu_id') : collect();
@endphp

@section('content')
    <form method="POST" action="{{ route('admin.setting.user.store') }}">
    @csrf

    <input type="hidden" value="{{ old('id', $item->id ?? '') }}" name="id" id="id">

    <x-actions-save-cancel :isStatus="false" :item="$item ?? false" />   

    <div class="row mb-5">
        <div class="col-md-12 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg h-100">                
                <div class="bg-gray-800 rounded-top p-1">
                    <span class="title ps-2 text-white text-lg font-medium">
                        <i class="fa fa-user-o"></i> 
                        Informações do Usuário
                    </span>
                </div>               
                
                <div class="p-4 sm:p-8">
                    <div class="row">                    
                        <div class="col-md-3 mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $item->name ?? '') }}">
                            @error('name') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $item->email ?? '') }}">
                            @error('email') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>
                    
                        <div class="col-md-3 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Password</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                            @error('password_confirmation') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>  
                    </div>
                    <div class="row">
                        <div class="form-check" style="padding-left: 2.5em;">
                            <input class="form-check-input" type="checkbox" value="1" id="is_master_admin" name="is_master_admin" {{ old('is_master_admin', $item->is_master_admin ?? '') == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_master_admin">
                                Administrador Master
                            </label>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-12 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg h-100">                
                <div class="bg-gray-800 rounded-top p-1">
                    <span class="title ps-2 text-white text-lg font-medium">
                        <i class="fa fa-list"></i> 
                        Permissões
                    </span>
                </div>               
                
                <div class="p-4 sm:p-8">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col"></th>
                            <th scope="col" class="text-center">
                                <input type="checkbox" id="selectAllView">
                                Ver
                            </th>
                            <th scope="col" class="text-center">
                                <input type="checkbox" id="selectAllCreate">
                                Cadastrar
                            </th>
                            <th scope="col" class="text-center">
                                <input type="checkbox" id="selectAllEdit">
                                Editar
                            </th>
                            <th scope="col" class="text-center">
                                <input type="checkbox" id="selectAllDelete">
                                Deletar
                            </th>
                            <th scope="col" class="text-center">
                                <input type="checkbox" id="selectAllReport">
                                Relatório
                            </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($menus as $menu)
                                <tr>
                                    <th scope="row">{{ $menu->menu }}</th>
                                    <td class="text-center"><input type="checkbox" class="selectAllView" name="permissions[{{ $menu->id }}][view]" {{ isset($userPermissions[$menu->id]) && $userPermissions[$menu->id]->can_view ? 'checked' : '' }}></td>
                                    <td class="text-center"><input type="checkbox" class="selectAllCreate" name="permissions[{{ $menu->id }}][create]" {{ isset($userPermissions[$menu->id]) && $userPermissions[$menu->id]->can_create ? 'checked' : '' }}></td>
                                    <td class="text-center"><input type="checkbox" class="selectAllEdit" name="permissions[{{ $menu->id }}][edit]" {{ isset($userPermissions[$menu->id]) && $userPermissions[$menu->id]->can_edit ? 'checked' : '' }}></td>
                                    <td class="text-center"><input type="checkbox" class="selectAllDelete" name="permissions[{{ $menu->id }}][delete]" {{ isset($userPermissions[$menu->id]) && $userPermissions[$menu->id]->can_delete ? 'checked' : '' }}></td>
                                    <td class="text-center"><input type="checkbox" class="selectAllReport" name="permissions[{{ $menu->id }}][report]" {{ isset($userPermissions[$menu->id]) && $userPermissions[$menu->id]->can_report ? 'checked' : '' }}></td>
                                </tr>
                                @if($menu->children->count() > 0)
                                    @foreach($menu->children as $child)
                                        <tr>
                                            <td class="ps-4"><small>-></small> {{ $child->menu }}</td>
                                            <td class="text-center"><input type="checkbox" class="selectAllView" name="permissions[{{ $child->id }}][view]" {{ isset($userPermissions[$child->id]) && $userPermissions[$child->id]->can_view ? 'checked' : '' }}></td>
                                            <td class="text-center"><input type="checkbox" class="selectAllCreate" name="permissions[{{ $child->id }}][create]" {{ isset($userPermissions[$child->id]) && $userPermissions[$child->id]->can_create ? 'checked' : '' }}></td>
                                            <td class="text-center"><input type="checkbox" class="selectAllEdit" name="permissions[{{ $child->id }}][edit]" {{ isset($userPermissions[$child->id]) && $userPermissions[$child->id]->can_edit ? 'checked' : '' }}></td>
                                            <td class="text-center"><input type="checkbox" class="selectAllDelete" name="permissions[{{ $child->id }}][delete]" {{ isset($userPermissions[$child->id]) && $userPermissions[$child->id]->can_delete ? 'checked' : '' }}></td>
                                            <td class="text-center"><input type="checkbox" class="selectAllReport" name="permissions[{{ $child->id }}][report]" {{ isset($userPermissions[$child->id]) && $userPermissions[$child->id]->can_report ? 'checked' : '' }}></td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 flex items-center gap-2">
        <a href="{{ route('admin.setting.user.index') }}" class="btn btn-secondary">Voltar</a>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</form>



<script>
    document.getElementById('selectAllView').addEventListener('change', function() {
        document.querySelectorAll('.selectAllView').forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    document.getElementById('selectAllCreate').addEventListener('change', function() {
        document.querySelectorAll('.selectAllCreate').forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    document.getElementById('selectAllEdit').addEventListener('change', function() {
        document.querySelectorAll('.selectAllEdit').forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    document.getElementById('selectAllDelete').addEventListener('change', function() {
        document.querySelectorAll('.selectAllDelete').forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    document.getElementById('selectAllReport').addEventListener('change', function() {
        document.querySelectorAll('.selectAllReport').forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
</script>
@endsection
