# curso-laravel_5.6

# Estrutura de pastas do Laravel
  Arquivo artisan.php = Arquivo para executar comandos no terminal.

  Arquivo "composer.json" = Arquivo da ferramenta composer, que contém todos os pacotes.

  Arquivo "package,json" = Pacotes que podem ser atualizados através do npm.

  Pasta "app" (aplicação) = Pasta mais importante, juntamente com a "routes". É onde cria os controladores, os modelos, toda parte do "core" (núcleo).

  Pasta "bootstrap" = Não é o framework bootstrap, mas sim a parte inicial do sistema, a parte de inicialização do sistema.

  Pasta "public" = Onde contém o arquivo de inicialização do sistema, o index. Também pode adicionar arquivos de css e js pessoais, nas pastas "js" e "css".

  Pasta "config" = Local dos arquivos de configuração, podendo modificar de acordo com a necessidade.

  Pasta "database" = Pasta importante, por causa das pastas, "migrations" e "seeds". Na pasta "migrations" é onde fica armazenado as tabelas do banco de dados, podendo modificar ou apagar campos, automaticamente, sem necessitar usar o SQL. Na pasta "seeds" carrega os dados, no caso, um conjunto de dados no banco de dados automaticamente.

  Pasta "resources" = Parte do javascript e sass, que são os arquivos de entrada, que tem a possibilidade de gerar os arquivos da pasta "public" e a pasta "views" que é aonde você coloca a parte visual que o usuário vai ter acesso, podendo interagir com o core do sistema, onde coloca os templates HTML.

  Pasta "routes" = Onde há os arquivos de configurações de rotas do sistema, que são os caracteres após a "/" da URI. Onde configura toda a hierarquia de rotas do sistema.

  Pasta "storage" = Onde tem a compilação dos templates.blade, onde armazena as sessões ou caches baseadas em arquivos e as logs do sistema.

  Pasta "tests" = Onde fica os testes automatizados da aplicação.

  Pasta "vendor" = Não é aconselhável mexer nessa pasta, porque ela é constantemente atualizada pela ferramenta composer. Pois é toda a parte do core do laravel.


# Rotas (pasta routes)

  Arquivo web.php = Rotas do seu projeto, caminhos para suas views

  Arquivo api.php = Rotas para se comunicar com APIs, no caso, web services.

  Comando -> php artisan route:list, mostra todas as rotas que seu projeto possui.

## Parâmetros em rotas
  São valores que podem ser passados, na hora de digitar a rota.
  No exemplo abaixo, ao entrar na rota nome, você deverá passar, os parâmetros necessários que está rota espera, no caso {nome} e {sobrenome} (usa-se {} para definir parâmetros em uma rota). E lembre-se de também passar estes parâmetros para a função anônima da rota em questão.

  Exemplo de rota com parâmetros:

```php
Route::get('/nome/{nome}/{sobrenome}', function ($nome, $sobrenome){
    return "<h1>Ola, $nome $sobrenome!</h1>";
});
```

  Exemplo de rota com parâmetros de tipo diferente, no caso, ele recebe um número inteiro e uma string, porém, caso você passar um valor diferente de inteiro no parâmetro {n} irá ocorrer um erro, pois ele esperava um número inteiro.

```php
Route::get('/repetir/{nome}/{n}', function ($nome, $n){
    for($i = 0; $i < $n; $i++){
        echo "<h1>Ola, $nome!</h1>";
    }
});
``` 

## Parâmetros opcionais e restritos

  Restringir os tipos de valores passados nos parâmetros pelas rotas

  Exemplo de parâmetros restritos a um tipo de valor:

  Utiliza a função `where()` para restringir parâmetros, no caso a variável 'n', se limitará aos números de 0 a 9, podendo ter mais de uma casa (+).

  No caso do parâmetro 'nome', ele deverá ser uma string, podendo ter apenas letras de "A" a "Z" maiúsculas e minúsculas, podendo também ter mais de um caractere na string.

```php
Route::get('/seunomecomregra/{nome}/{n}', function ($nome, $n){
    for($i = 0; $i < $n; $i++){
        echo "<h1>Ola, $nome!</h1>";
    }
})->where('n', '[0-9]+')->where('nome', '[A-Za-z]+');
```

No caso abaixo, o parâmetro não será necessariamente obrigatório, porém quando não passado, será atribuido um valor 'null' para ele (porém, você pode colocar qualquer tipo de dado ou valor para ser atribuido caso o parâmetro não seja passado).

```php
Route::get('/seunomesemregra/{nome?}', function ($nome=null){
    if (isset($nome)) {
        echo "<h1>Ola, $nome!</h1>";
    } else {
        echo "Você não passou nenhum nome";
    }
});
```

## Agrupamento de rotas
  Agrupar outras rotas (filhas), em uma rota principal (pai). Criando uma hierarquia de rotas, colocando uma rota comum a todos, como a rota principal.

  Usa a função `prefix()` para criar a rota principal, e depois a função `group()`, passando uma função anônima, e dentro dessa função anônima, estará localizado as outras rotas (filhas).

```php
Route::prefix('app')->group(function (){
  Route::get('/', function (){
      return "Página principal do app";
  });

  Route::get('profile', function (){
      return "Página profile do app";
  });

  Route::get('about', function (){
      return "Meu about";
  });
});
```

## Redirecionamentos em rotas 

Função `redirect()` que redireciona uma rota para outra rota existente no projeto.

Redireciona '/aqui', para o '/ola'. Com o código 301, que informa ao proxy e ao navegador que a pessoa está usando, que o '/aqui' foi permanentemente movido pro '/ola', falando para ele buscar o conteúdo do '/aqui' no '/ola'.

```php
Route::redirect('/aqui', '/ola', 301);
```

Função `view()`, que redireciona de uma rota para uma view de uma maneira mais simples.

```php
Route::view('/hello', 'hello');
```

Mesma função, porém passando parâmetros(variáveis), por meio de um array (terceiro parâmetro) com dados, que serão exibidos na view 'hellonome'.

```php
Route::view('/viewnome', 'hellonome', ['nome'=>'João', 'sobrenome'=>'Silva']);
```

## Métodos HTTP

O protocolo HTTP permite que nós utilizamos, na requisição HTTP, vários métodos, que são 9 no total. No link abaixo, há informações de cada método existente.

Exemplo de uma rota POST:

```php
Route::post('/rest/hello', function () {
    return "Hello (POST)";
});
```

Obs: Para usar outros métodos, é só alterar a função `post()` para as outras funcões dos métodos, como exemplo, `delete()`, `put()`, `patch()` etc. Existe uma função para cada método (GET, POST, PUT, DELETE, PATCH, OPTIONS).

[Métodos HTTP](https://developer.mozilla.org/pt-BR/docs/Web/HTTP/Methods)

## Código de status de respostas HTTP

Os códigos de status indicam se uma requisição HTTP foi corretamente concluída. As respostas são agrupas em 5 classes: respostas de informação, respostas de sucesso, redirecionamentos, erros do cliente e erros do servidor.

[Códigos de status](https://developer.mozilla.org/pt-BR/docs/Web/HTTP/Status)

Middleware VerifyCsrfToken.php = Faz uma verificação de segurança do token csrf, utilizado quando você usa outras requisições sem ser a GET. Bloqueando a requisição, caso não possuir o token.

Maneira para coletar os dados de uma formulário POST:

```php
Route::post('/rest/imprimir', function (Request $req) {
    $nome = $req->input('nome');
    $idade = $req->input('idade');
    return "Hello $nome ($idade) !! (POST)";
});
```

Lembre-se de adicionar a namespace: `use Illuminate\Http\Request;` para poder utilizar essa maneira anterior.

Para atender duas ou mais tipos de requisição em uma única rota, você deve utilizar a função `match()`:

Neste caso a rota '/rest/hello2', estará atendendo o método GET e POST. Além do método HEAD (padrão em todas as rotas).
```php
Route::match(['get', 'post'], '/rest/hello2', function () {
    return "Hello World 2";
});
```

Para atender qualquer tipo de requisição em uma rota específica, você deve utilizar a função `any()`, estrutura parecida com a padrão:

```php
Route::any('/rest/hello3', function () {
    return "Hello World 3";
});
```

## Nomeando rotas

Ao mudar o nome de uma ou mais rotas, você tem que se preocupar em alterar em todos os outros lugares que ela existir, se tornando um processo cansativo, por isso a gente pode nomear uma rota utilizando a função `name()`, determinando um nome padrão para aquela rota e mesmo se posteriormente alguém mudar o nome da rota, não irá ocorrer problema algum. 
Ele basicamente consegue acessar a rota independendo se o nome dela alterou ou não.

Exemplo:

Foi atribuido para a rota '/produtos' o nome de 'meusprodutos'.
```php
Route::get('/produtos', function(){
    echo "<h1>Produtos</h1>";
    echo "<ol>";
    echo "<li> Notebook </li>";
    echo "<li> Impressora </li>";
    echo "<li> Mouse </li>";
    echo "</ol>";
})->name("meusprodutos");
```

Para acessar a rota pelo nome em outro lugar do código, você precisa utilizar a função `route()` do laravel.
Neste caso irá armzenar o link da rota, na variável `$url`.
```php
Route::get('/linkprodutos', function(){
    $url = route('meusprodutos');
    echo "<a href=\"$url\"> Meus Produtos </a>";
});
```

Redirecionando uma rota para outra rota utilizando a função `redirect()`, no caso a rota de nome 'meusprodutos' (/produtos).
```php
Route::get('/redirecionarprodutos', function () {
    return redirect()->route('meusprodutos');
});
```

Obs: Mesmo se alterar o nome da rota '/produtos', para '/produtos1' ou qualquer nome, nenhuma dessas outras rotas '/linkprodutos' ou '/redirecionarprodutos' seram afetadas, por conta delas estarem utilizando o nome da rota '/produtos', que é 'meusprodutos'.