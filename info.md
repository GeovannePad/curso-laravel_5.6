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
Neste caso irá armazenar o link da rota, na variável `$url`.
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

# Controladores

Antes de tudo, é bom entender como o Laravel funciona através da arquitetura MVC.
MVC é nada mais que um padrão de arquitetura de software, separando sua aplicação em 3 camadas. A camada de interação do usuário(view), a camada de manipulação dos dados(model) e a camada de controle(controller).

Model = Sempre que você pensar em manipulação de dados, pense em model. Ele é responsável pela leitura e escrita de dados, e também de suas validações.

View = Simples: a camada de interação do usuáriop. Ela apenas faz a exibição dos dados, sendo ela por meio de HTML ou XML.

Controller = O responsável por receber todas as requisições do usuário. Seus métodos chamados actions são responsáveis por uma página, controlando qual model usar e qual view será mostrado ao usuário.

Diálogo das camadas

View: Fala Controller ! O usuário acabou de pedir para acessar o Facebook ! Pega os dados de login dele ai. Controller: Blz. Já te mando a resposta. Ai model, meu parceiro, toma esses dados de login e verifica se ele loga. Model: Os dados são válidos. Mandando a resposta de login. Controller: Blz. View, o usuário informou os dados corretos. Vou mandar pra vc os dados dele e você carrega a página de perfil. View: Vlw. Mostrando ao usuário…

Request(HTTP) -> Controller -> Model -> Controller(com dados) -> View -> Response(HTML, XML)

Método para criar um controlador(controller) pela linha de comando com o Artisan:

`php artisan make:controller (nome)`

Para chamar um método de um controller, linkando uma rota com um controlador, você precisa fazer da maneira abaixo:

```php
Route::get('/nome', 'MeuControlador@getNome');
```

Como segundo parâmetro na hora de criar a rota você usa o "nome_do_controller@nome_do_método".

## Passando parâmetros a controladores

Para passar parâmetros a um controlador por uma rota GET é simples, você apenas deve usar a maneira a seguir:

```php
Route::get('/multiplicar/{n1}/{n2}', 'MeuControlador@multiplicar');
```

Quando você linka, um método de um controlador a uma rota, o próprio Laravel vai entender que ele deve mandar os parâmetros passados a essa rota para o controlador, porém você deve declarar no controlador que você está recebendo os parâmetros:

Neste caso, ao passar o n1 e n2 na rota e chamar o método multiplicar, declarando no método quantos parâmetros ele vai receber, o Laravel vai realizar todo o processo já, passando os valores e executando o código do método escolhido. (Lembre-se de passar os parâmetros, pois esses não são parâmetros opcionais, mas sim obrigatórios)

```php
public function multiplicar($n1, $n2) {
        return $n1 * $n2;
    }
```

## Requisições HTTP em controladores

Utilizando o comando: `php artisan make:controller ClienteController --resource`, irá criar um controller um pouco mais completo, contendo métodos específicos para cada ação/requisição.

O método index, é como se fosse o '/clientes', por exemplo, exibirá uma lista com todos os clientes registrados. É um tipo de "landing page" para a área de manejo dos clientes.

O método create, irá ser chamado quando precisar criar algo novo, por exemplo, um cliente, no caso irá chamar um formulário para se colocar os dados de um novo cliente.

O método store, é o método que vai receber novos dados para criar um novo resource, no caso, os dados de um novo cliente, salvando em um banco de dados.

O método show, ele vai ser chamado quando será preciso exibir um determinado resource(cliente), por exemplo, exibir(show) o cliente de ID=50.

O método edit, vai receber um chamado para exibir um formulário ao usuário para editar(edit) os dados de um determinado cliente.

O método update, vai receber os novos dados, junto com o identificador desse cliente para então fazer as alterações(update) num banco de dados, por exemplo.

O método destroy, é chamado quando há uma solitação para excluir um resource, junto dele, seus dados.

Tip: Para utilizar o método update, o laravel utiliza a requisição PUT ou PATCH, porém um formulário não identifica isso, então é necessário criar um input de nome '_method', com o valor de PUT ou PATCH para poder funcionar. Mandando os dados do formulário pelo POST e recebendo por PUT e PATCH pelo laravel.

Caso queira adicionar uma outra rota, com uma requisição da sua escolha, basta apenas, criar a rota desta maneira `Route::post('/cliente/requisitar', 'ClienteController@requisitar');` e então linkar com o método que você tenha criado dentro do controlador ClienteController.

# Views

É onde o usuário irá interagir, é o V da arquitetura MVC.
As views ficam localizas na pasta resource/views.
Ao criar uma view, você deve manter um padrão: nomedaview.blade.php
Nela pode conter código PHP junto de código HTML, porém o PHP será processado pelo servidor antes de aparecer para o usuário final.

Para chamar uma view, você deve usar a função `view('nomedaview')`.
Obs: Para chamar alguma determinada view não há necessidade de colocar a sua extensão, mas sim, apenas seu nome.

## Passando parâmetros a views

É possível passar parâmetros/variáveis contendo valores a suas views, para então exibir esses dados para o usuário, há 4 métodos que podem ser utilizados para realizar esse processo.

1º: Com a função `with()`, sendo;
    O 1º param, o nome da variável.
    O 2º param, o valor da variável.

```php
Route::get('/ola', function () {
    return view("minhaview")
        ->with('nome', 'João')
        ->with('sobrenome', 'Silva');
    
});
```

2º: Passando os valores pela rota, no caso, a rota '/ola'. Seguindo as regras já faladas na sessão de rotas.

```php
Route::get('/ola/{nome}/{sobrenome}', function ($nome, $sobrenome) {
    return view("minhaview")
        ->with('nome', $nome)
        ->with('sobrenome', $sobrenome);
});
```

3º: Passando os dados como um array associativo, através do 2º parâmetro da função `view()`.

```php
Route::get('/ola/{nome}/{sobrenome}', function ($nome, $sobrenome) {
    $parametros = ['nome'=>$nome,'sobrenome'=>$sobrenome];
    return view('minhaview', $parametros);
});
```

4º: Utilizando a função `compact()` do php, criando um array associativo.
    Neste caso, é necessário colocar os mesmos nomes que estão vindo pela função anônima, caso contrário a função não conseguirá criar o array.

    Não há necessidade de colocar o $ nos nomes na função `compact()`.
    
```php
Route::get('/ola/{nome}/{sobrenome}', function ($nome, $sobrenome) {
    return view('minhaview', compact('nome', 'sobrenome'));
});
```

Acima, no exemplo, a função `compact()` irá criar um array associativo, parecido com este:

```php
$data=[
'nome'=>'João',
'sobrenome'=>'Silva'
];
```

Obs: Dados fictícios, os dados reais serão os valores passados através da rota.

## Verificando se uma view existe

O Laravel fornece uma função estática nativa que permite verificar se determinada view existe ou não.

No exemplo, utilizando a função estática `View::exists()`, será verificado se a view email existe ou não, e caso existir, executará o primeiro bloco condicional, retornando a view email, com o array associativo contendo o email passado pela rota.
Ou executará o segundo bloco de código, que retornará uma view erro, dizendo que determinada view não existe.

Função `compact()` cria um array, baseado na quantidade de parâmetros passados na função.

Caso exista a view, a função retorna true, caso contrário, false.

```php
Route::get('/email/{email}', function ($email) {
    if (View::exists('email')) {
        return view('email', compact('email'));
    } else {
        return view('erro');
    }
});
```

## Templates

Há a possibilidade de criar uma espécie de página "pai", onde irá ter o conteúdo padrão, aquele que não muda, para então ser reaproveitado não precisando escrever de novo aquelas mesmas linhas de código.

Função `extends()` serve para extender uma página blade para outra, é como se o arquivo que usarmos essa função virasse um tipo de arquivo "filho" do arquivo "pai", herdando todo o código do blade principal para o blade "filho" como uma espécie de cópia da página. No caso, o arquivo layout "pai" está localizado na pasta layouts dentro da pasta de views. 

Tip: Caso o arquivo estiver dentro de uma pasta, deve ser usado o "." em vez da "/" para poder acessar esse arquivo.

```php
@extends('layouts.app')
```

Função `@section('nome_do_yield')` é como se uma fosse uma sessão de códigos do arquivo "filho" que vai ser inserida no arquivo "pai". Necessita fechar aquela determinada sessão de código com `@endsection`.
Caso for apenas uma string a ser inserida em vez de um bloco de código, você pode utilizar da seguinte maneira: `@section('nome_do_yield', 'string_a_inserir')` sem a necessidade de fechar a sessão com o `@endsection`.

Função `@yield('nome_yield')` serve para linkar uma sessão de códigos de um tal arquivo "filho" com o arquivo "pai". 

Sem essas funções os conteúdos inseridos na sessão no arquivo "filho" não serão exibidos, pois só usará os códigos presentes no arquivo "pai", porque não vai estar falando que tem códigos no arquivo "filho" que deve ser exibidos juntamente com os códigos do arquivo pai.
Onde a função `@yield()` for usada, é aonde o código vai ser inserido.

Outra possibilidade de utilização é:

Uma arquivo pai contém o seguinte código:

```php
@section('mesclagem')
    <p>Essa parte é do pai</p>
@show
```


Outra página, a filho, contém o seguinte código:

```php
@extends('pai')

@section('mesclagem')
    <p>Essa parte é do filho</p>
    @parent
@endsection
```

Nesse caso, a sessão de códigos do arquivo pai vai ser exibida junto do arquivo filho, porém ao criar outra sessão com o mesmo nome no arquivo filho, todo o conteúdo que estava na sessão criada no pai vai ser deletado/substituído, para isso não ocorrer deve-se utilizar outra função do blade, a função `@parent`, que basicamente irá inserir todo o conteúdo definido na sessão criada no arquivo pai dentro da sessão do arquivo filho, juntamente com os códigos declarados nela, mesclando ambos os códigos.

Tip: O conteúdo vai ser inserido exatamente aonde a função `@parent` for colocada.

Tip-2: Caso a sessão antes criada não for criada novamente, o conteúdo dela se permanecerá inalterado, exibindo-a do mesmo jeito.

Tip-3: Sem a função `@show` no final do bloco de códigos da sessão, o bloco não será exibido no arquivo filho.

## Usando NPM para instalar o bootstrap localmente no projeto

NPM é o nome reduzido de Node Package Manager (Gerenciador de Pacotes do Node).
A NPM é duas coisas: Primeiro, e mais importante, é um repositório online para publicação de projetos de código aberto para o Node.js; segundo, ele é um utilitário de linha de comando que interage com este repositório online, que ajuda na instalação de pacotes, gerenciamento de versão e gerenciamento de dependências..

Outro importante uso da NPM é o gerenciamento de dependências. Quando você tem um projeto Node com um arquivo package.json, você pode rodar o comando `npm install` na pasta raiz do seu projeto e a NPM vai isntalar todas as dependências listadas no package.json.

No laravel, ao executar o comando `npm install`, ele irá instalar todas as dependências necessárias para rodar o bootstrap por exemplo. Depois disso, ao executar o comando `npm run development` irá compilar os arquivos do bootstrap tudo em um único arquivo, gerando um arquivo css e outro javacript na pasta public contendo todo o código necessário para utilizar o bootstrap.

Para linkar esses arquivos com uma página HTML você pode utilizar duas maneiras:

1ª: `<link rel="stylesheet" href="{{ asset('css/app.css') }}">`
Utilizando a função `asset()` com o caminho do arquivo localizado dentro da pasta public.

2ª `<script src="{{ URL::to('js/app.js') }}" type="text/javascript"></script>`
Utilizando o método estático `to()` da classe URL com o caminho do arquivo dentro da pasta public.

## Componentes e includes

Componentes é uma forma do Laravel de separar os códigos, dando uma organização maior, por exemplo, separar o código da navbar do resto do código da landing page com o intuito de serem reutilizados. 

No caso dos componentes, para criar um você pode simplesmente criar uma pasta chamada "components" dentro da pasta views do seu projeto, e lá dentro você criará seus componentes. O arquivo do componente segue a mesma extensão das views, "nome_do_componente.blade.php".

Método para chamar um componente para uma view.
Sempre use "." em vez de "/" para especificar o caminho de algum arquivo no blade.

```php
@component('caminho_do_componente')

@endcomponent
```

Os componentes também possuem os chamados slots, que é uma forma de passar parâmetros para os componentes através da view em que eles estão sendo inseridos.

Sintaxe de um componente utilizando slots.
Código inserido na view em que o componente está sendo utilizado.

```php
  @component('caminho_do_componente') 

    @slot('slot1')
      <strong>Conteúdo do slot 1</strong>
    @endslot

    @slot('slot2')
      <strong>Conteúdo do slot 2</strong>
    @endslot

  @endcomponent
```

```php
<div class="alert alert-danger" role="alert">
  {{$slot1}}
</div>

<div class="alert alert-success" role="alert">
  {{$slot2}}
</div>
```

Para acessar essas informações diretamente no arquivo do componente, cada slot deve ser tratado como uma variável, por exemplo, no exemplo acima, para acessar os dados que estão contidos dentro do slot1 deve ser utilizado a variável `$slot1` no arquivo do componente. Assim também vale para o slot2, que usará a variável `$slot2`, ou seja, o nome atribuído ao slot na hora de especificar o componente deve ser o nome da variável para acessar os dados desse mesmo slot.

Tudo passado fora da função `@slot` dentro de um componente será atribuído a variável padrão `$slot`, para então ser acessado.

Também há a possibilidade de passar informações pelo segundo parâmetro da função `@component` utilizando um array associativo.


Os includes são utilizados para você adicionar subviews, peças maiores de código que você resolveu separar da view principal por algum motivo. Vamos supor que sua view principal estava ficando muito grande, então você resolveu quebrar essa view em outras partes, mas que não tem o intuito de serem reusáveis, ou seja, essas partes você vai utilizar em um único lugar.

Todas as variáveis disponíveis na view principal, também seram disponíveis na sub-view incluída.

Também podem ser passados parâmetros nos includes, utilizando um array associativo. 

```php
@include('view.name', ['some' => 'data'])
```

Quando determinada view usada no include não existir, o Laravel irá retornar um erro.

Para mais informações sobre as funções do include, use o link abaixo.
[Include Sub-views](https://laravel.com/docs/5.8/blade#including-sub-views)

## Criando uma chamada costumizada para um componente (aliases)

Em vez de usar `@component` para chamar um componente, podemos fazer com que o Laravel registre um componente com uma aliase, para posteriormente ser chamado.

Para isso, devemos ir na pasta App -> Providers e abrir o arquivo AppServiceProvider.php, nesse arquivo existe uma função chamada boot. Nela, colocaremos o código abaixo

E para registrar um aliase a um componente usamos a classe "Blade" com o seguinte código: `Blade::component('caminho_do_componente', 'aliase');`.

Tip: Um aliase é a mesma coisa que um apelido.

Dessa forma, em vez de usarmos:

```php
    @component('caminho_do_componente', ['foo'=>'data', ...])

    @endcomponent
```

Usaremos o aliase atribuído na função boot, no lugar do "component":
Nesse caso não é preciso passar o caminho do componente, pois já fora especificado, mas ainda é possível passar os parâmetros em forma de array associativo.

```php
    @aliase(['foo'=>'data', ...])

    @endaliase
```

## Comparações em views

Utilizando o blade também temos como fazer comparações em views, como if, else if.
Eles possuem a mesma estrutura do if comum do php, porém deve começar sempre por "@".

Utilizamos:
Caso a comparação nos parênteses for verdadeira(true) vai retornar o bloco antes do "@else", caso contrário, o bloco depois do "@else".

Tip: Também pode utilizar funções do php dentro do parênteses de comparação.
Tip: Não podemos colocar código puro php dentro dos ifs do blade, devemos colocar apenas código HTML para ser exibido, caso queira colocar código php dentro dos if utilize o "@php - @endphp" ou utilize "{{}}".


```php
    @if()
        <h1> Mensagem a exibir </h1>
    @else
        <h1> Mensagem a exibir </h1>
    @endif
```

Também há a função "@empty", que basicamente, como o nome diz, verifica se determinada variável, sendo um array ou não, contém algum valor ou não.

Nesse caso, ele vai verificar se a variável $foo possui algum valor ou não. Retornando todo o código HTML ou PHP(usando o necessário para exibir) dentro de seu bloco.

```php
    @empty($foo)
        <h1>Mensagem a exibir se não possuir nada dentro de $foo</h1>
    @endempty
```

## Método HasSection

Método hasSection serve para verificar se determinada section no blade está definida ou não, por exemplo, ao extender um view layout para uma sub-view, precisamos usar o "@yield" e "@section" para mesclar os conteúdos das duas views e exibi-lo, porém se determinado "@yield" não ter nenhuma "@section" atribuido a ele, mesmo assim irá imprimir todo o código da página, as vezes não sendo necessário.

Por exemplo:

Nesse exemplo, o método hasSection irá verificar se a section 'minha_secao_produtos' existe, caso existir ele irá imprimir tudo antes do "@else" juntamente do "@yield" para receber os dados, caso não, ele vai imprimir tudo localizado depois do "@else", não imprimindo nada relacionado acima do "@else". Funciona basicamente como um if de seções, por isso também se usa o "@endif" para fechar o bloco.

```php
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

```

## Switch Case

Assim como no php comum, o Laravel também possui a estrutura switch, e segue basicamente a mesma sintaxe do php, começando em "@switch" e sempre terminando em "@endswitch".

Seguindo o mesmo padrão do php, o switch vai verificar determinada `$var` e depois verificar dentro de todos os seus cases, se algum deles bater com o valor dentro da variável, ele vai executar o bloco de código desse determinado case, parando sempre no "@brake".

Tip: Se no final de cada case não possuir o "@brake" ele vai executar todos os outros cases abaixo desse case que não possuir o "@brake".

Tip-2: Se o valor da `$var` não for nenhum dos cases, por padrão, ele sempre vai parar no bloco de código depois do "@default".

```php
    @switch($var)
        @case(1)

          code...

            @break
        @case(2)

          code...

            @break
        @case(3)

          code...
          
            @break
        @default

          code...

    @endswitch
```

## Laços de repetições (loops)

O Blade do Laravel também possui os laços for, foreach e while.

Seguindo a mesma sintaxe do php, porém sempre usando o "@" antes dos nomes dos loops cases:

```php
@for ($i = 0; $i < 10; $i++)
    The current value is {{ $i }}
@endfor

@foreach ($users as $user)
    <p>This is user {{ $user->id }}</p>
@endforeach

@forelse ($users as $user)
    <li>{{ $user->name }}</li>
@empty
    <p>No users</p>
@endforelse

@while (true)
    <p>I'm looping forever.</p>
@endwhile
```

No caso do foreach para array associativo, deve ser utilizado os "[]" com o nome/número do index depois da variável do array para acessar o valor de tal index. Porém na maioria dos casos, vai ser utilizado array de objetos, então você deve utilizar a "->" seguida do nome do index do array.

O forelse é uma estrutura que basicamente, se possuir dados dentro do array, ele vai exibi-los(executando o primeiro bloco de código) ou caso não existir, ele vai executar o segundo bloco de código, mostrando uma mensagem ou algo parecido(no caso, o bloco depois do "@empty"). No forelse também pode-se utilizar array associativo/objetos.

### Atributos dos loops

Nos loops do Blade existe um array de objetos `$loop` que nos fornece diversas informações em relação ao loop, como por exemplo.

`$loop->first`: Utiliza para pegar a primeira interação do loop.

Por exemplo, se for a primeira interação, ele imprimirá o texto "(primeiro)".
```php
  @if ($loop->first)
    (primeiro)
  @endif
```

`$loop->last`: Diferente do first, este pega a última interação do loop.

Se for a última interação do loop, ele imprimirá o texto "(ultimo)".
```php
  @if ($loop->last)
    (ultimo)
  @endif
```

`$loop->index`: Imprime o index da atual interação do loop.

`$loop->count`: Conta a quantidade de interações que podemos ter em determinado loop.

`$loop->remaining`: Mostra a quantidade, em relação a cada interação, do quanto falta para finalizar todas as interações do loop.

`$loop->iteration`: Imprime o index da atual interação do loop.

Para mais funções da variável loop -> [Variável Loop](https://laravel.com/docs/5.8/blade#the-loop-variable)