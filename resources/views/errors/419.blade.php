@extends('errors.layout')

@section('title', 'Sessão expirada')

@section('content')  
<section class="section section-bg-white">
    <div class="container error">        
        <h1>419</h1>
        <h2>Ops! Sua sessão expirou.</h2>
        <a href="{{ route('home') }}" class="btn btn-primary">
            Voltar para o início
        </a>      
    </div>        
</section>     
@endsection