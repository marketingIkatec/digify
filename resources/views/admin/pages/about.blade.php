
@extends('admin.app')
@section('content')
<style>
  *{box-sizing:border-box;margin:0;padding:0}
  html,body{height:100%}
  body{
    color:#000; 
    background:#fff;
  }

  header{
    font-family: "Red Hat Display", sans-serif;
    border-bottom:1px solid #083b5c;
    background-color:#002135;
    top:0;
    left:0;
    width: 100%;
    z-index:1000;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    padding:15px 32px;
  }

  footer {
    background: #003a63;
    border-top:1px solid #083b5c;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); 
    padding: 15px;
    text-align: center;
    font-size: 0.9rem;
    color: #d6e8f5;
    font-family: "Red Hat Display", sans-serif; 
      
  }
  /* logo */
  .logo-container{
    display:flex;
    align-items:center;
    gap:12px;
  }

  .logo-wrap{
    display:flex;
    align-items:center;
    gap:10px;
  }

  .logo-container .logo-wrap .logo-desktop{
    width:197px;
    height:auto;
  }

  .conteudo{
    width: 685px;
    margin: 0 auto;
    margin-top: 50px;
    margin-bottom: 50px;
  }

  p{
    margin-bottom: 0px;
    color:#000;
    font-family: "Red Hat Display", sans-serif;
    text-align: justify;
    line-height: 22px;
    font-size: 16px;
    margin-bottom: 10px;
  }
  h1{
   text-align: left;
    color:#031e30;
    font-family: "Red Hat Display", sans-serif; 
    margin-top: 50px;
    margin-bottom: 30px;
    font-size: 2.5rem;
    font-weight: 500;
    text-transform: uppercase;
  }
  h2{
    text-align: left;
    color:#031e30;
    font-family: "Red Hat Display", sans-serif; 
    margin-top: 50px;
    margin-bottom: 30px;
    font-size: 1.9rem;
    font-weight: 500;
    border-bottom: 5px solid #083b5c;
    text-transform: uppercase;
  }
  ul {
    list-style: none;   /* remove as bolinhas */
    padding-left: 0;    /* remove o recuo padrão */
    margin-left: 0;
    margin-top: 25px;
    margin-bottom: 20px;
    font-family: "Red Hat Display", sans-serif;
  }

  li {
    margin-bottom: 6px; /* espaçamento entre os itens */
  }

  .screenshot{
    width: 100%;
    text-align: center;
    margin: 0 auto;
    margin-top: 40px;
    margin-bottom: 20px;
    border: 1px solid #cdcdcd;
    border-radius: 10px;
  }
  .screenshot img{
    width: 100%;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    margin-bottom: 5px;
  }
  .screenshot span,
  .screenshot span a{
    text-align: center;
    font-size: 13px;
    font-family: Arial, Helvetica, sans-serif; 
    color:#25465A;
    display:block;
    text-decoration: none;
    padding: 12px;
    background-color: #ebebeb;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
  }

  @media (max-width: 768px) {
    .conteudo {
        width: 100%;
        padding: 20px;
    }
    h1{
      font-size: 1.9rem;
    }
    h2{
      font-size: 1.4rem;
    }
  }

    /* ====== ESTILOS DE IMPRESSÃO ====== */
  @media print {

    body {
        margin: 2cm 2cm 2cm 2cm; /* espaço para header e footer */
    }

    .quebra-pagina {
      page-break-before: always; /* padrão antigo */
      break-before: page;        /* padrão moderno */
      padding-bottom:60px;
    }

    header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 1.5cm;
        text-align: center;
        font-size: 12px;
        font-weight: bold;
        padding-top: 0px;
        background: #002135;
        border-bottom: #083b5c 1px solid;
        box-shadow: 0 2px 8px #0000000d;
    }

    header img{
      margin-top: 12px;
    }

    footer {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        height: 1cm;
        text-align: center;
        font-size: 10px;
        padding-top: 10px;
        background: #003a63;
        border-top: #083b5c 1px solid;
        box-shadow: 0 2px 8px #0000000d;
    }

    .conteudo {
        margin-top: 2.8cm;
        margin-bottom: 2.8cm;
        width:650px;
        text-align: left;
    }
    
    p{
      line-height: 22px;
    }

    .screenshot{
      width: 650px;
    }
  }
</style>

{{--<header>
  <div class="header-container">
    <div class="logo-container">
      <div class="logo-wrap">
        <img class="logo-desktop" src="{{ !empty($config['logo_header']) ? asset('storage/'.$config['logo_header']) : '' }}" alt="{{ $config['site_name'] ?? '' }}" >
      </div>
    </div>
  </div>
</header>--}}

<div class="conteudo">
    
</div>

{{--<footer>
    © Copyright <?=date('Y');?> | {{ $config['note_footer'] ?? '' }}
</footer>--}}

@endsection



