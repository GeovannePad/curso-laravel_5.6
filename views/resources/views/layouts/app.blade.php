<html>
  <head>
    <title>Meu título - @yield('titulo')</title>
  </head>
  <body>
    @section('barralateral')
      <p>Esse parte é do pai</p>
    @show
    <div>
      @yield('conteudo')
    </div>
  </body>
</html>