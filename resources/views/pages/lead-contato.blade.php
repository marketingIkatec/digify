@extends('app')

@section('content')
  <section class="section-hero-form">

    <div class="container hero-container">

    <!-- LEFT -->
    <div class="hero-content">
      <h1>
        Atenda seus clientes
        com <span>mais eficiência e agilidade</span>
      </h1>

      <p>
        A Digify ajuda empresas de diversos setores a otimizar processos,
        reduzir custos e melhorar a experiência do cliente.
      </p>

      <div class="hero-cards">
        <div class="hero-card">
          <div class="icon">🏆</div>
          <strong>InvestSmart</strong>
          <h3>Top 1 da XP</h3>
          <p>InvestSmart se destaca em atendimento.</p>
        </div>

        <div class="hero-card">
          <div class="icon">📈</div>
          <strong>Unimed</strong>
          <h3>55% a mais</h3>
          <p>nos chamados diários da Unimed Palmas.</p>
        </div>
      </div>
    </div>


    <div class="formulario-de-contato">
      @include('forms.form-contato',['nameForm' => 'teste-gratis'])
    </div>
  </section>
@endsection  