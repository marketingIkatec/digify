@extends('errors.layout')

@section('title', 'Acesso negado')

@section('content')  
<section class="section section-bg-white">
    <div class="container error">        
        <h1>403</h1>
        <h2>Ops! Acesso negado.</h2>
        <a href="{{ url()->previous() }}" class="btn btn-primary">
            Voltar para o início
        </a>      
    </div>        
</section>     
@endsection