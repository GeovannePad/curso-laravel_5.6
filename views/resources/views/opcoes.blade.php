@extends('layouts.meulayout')

@section('minha_secao_produtos')
    
  Você escolheu a opção:

  @if (isset($opcao))
    @switch($opcao)
        @case(1)
          <span class="badge badge-primary">Azul</span>
            @break
        @case(2)
          <span class="badge badge-danger">Vermelho</span>
            @break
        @case(3)
          <span class="badge badge-success">Verde</span>
            @break
        @default

    @endswitch
  @endif

@endsection