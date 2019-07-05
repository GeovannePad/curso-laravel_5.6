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

  @alerta() 

    @slot('slot1')
      <strong>Conteúdo do slot 1</strong>
    @endslot

    @slot('slot2')
      <strong>Conteúdo do slot 2</strong>
    @endslot

  @endalerta
  
  <script src="{{ URL::to('js/app.js') }}" type="text/javascript"></script>
</body>
</html>