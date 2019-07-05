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

  @if(isset($produtos))
    @if(count($produtos) == 0)
      <h1>Nenhum produto</h1>
    @elseif (count($produtos) === 1)
      <h1>Um produto</h1>
    @else
      <h1>Temos vários produtos</h1>
    @endif

    @foreach ($produtos as $produto)
      <p>Nome: {{$produto}}</p>
    @endforeach

  @else
    <h2>Variável produtos não foi passada como parâmetro</h2>
  @endif
  
  @empty($produtos)
    <h2> Nada em produtos </h2>
  @endempty
  <script src="{{ URL::to('js/app.js') }}" type="text/javascript"></script>
</body>
</html>