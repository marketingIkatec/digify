@extends('admin.app')

@section('content')
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(auth()->user()?->temporary_password)
                <div class="d-flex align-items-start gap-3 p-4 rounded shadow-sm" style="background:#fffbeb; border:1px solid #f59e0b; color:#92400e;">
                    <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0" style="width:38px; height:38px; background:#fef3c7; color:#d97706; font-size:20px;">
                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                    </div>
                    <div>
                        <strong style="display:block; font-size:16px; color:#78350f;">Senha temporária em uso</strong>
                        <span>Altere sua senha agora para continuar usando o painel com segurança.</span>
                    </div>
                </div>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('admin.pages.profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('admin.pages.profile.partials.update-password-form')
                </div>
            </div>

            <!--<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('admin.pages.profile.partials.delete-user-form')
                </div>
            </div>-->
        </div>
    </div>
@endsection
