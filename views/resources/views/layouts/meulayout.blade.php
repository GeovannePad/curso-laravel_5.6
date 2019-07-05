<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

  @hasSection ('minha_secao_produtos')
    <div class="card" style="width: 18rem">
      <div class="card-body">
        <h5 class="card-title">Produtos</h5>
        <p class="card-text">
          @yield('minha_secao_produtos')
        </p>
  
        <a href="#" class="card-link">Informações</a>
        <a href="#" class="card-link">Ajuda</a>
      </div>
    </div>
  @else
    <h1>Não existe essa seção</h1> 
  @endif



  <script src="{{ URL::to('js/app.js') }}" type="text/javascript"></script>
</body>
</html>