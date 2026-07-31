@extends('errors.layout')

@section('title', 'Erro interno no servidor')

@section('content')  
<section class="section section-bg-white">
    <div class="container error">        
        <h1>500</h1>
        <h2>Ops! Erro interno no servidor.</h2>
        <p>Ocorreu um erro inesperado. Por favor, tente novamente mais tarde.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">
            Voltar para o início
        </a>      
    </div>        
</section>     
@endsection