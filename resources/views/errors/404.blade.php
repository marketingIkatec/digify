@extends('errors.layout')

@section('title', 'Página não encontrada')

@section('content')  
<section class="section section-bg-white">
    <div class="container error">        
        <h1>404</h1>
        <h2>Ops! Essa página não foi encontrada.</h2>
        <p>O endereço pode estar errado ou a página foi removida.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">
            Voltar para o início
        </a>      
    </div>        
</section>  
@endsection