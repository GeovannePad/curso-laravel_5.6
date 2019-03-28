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

# Parâmetros em rotas
  São valores que podem ser passados, na hora de digitar a rota.
  No exemplo abaixo, ao entrar na rota nome, você deverá passar, os parâmetros necessários que está rota espera, no caso {nome} e {sobrenome} (usa-se {} para definir parâmetros). E lembre-se de também passar estes parâmetros para a função anônima da rota em questão.

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

# Parâmetros opcionais e restritos

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

# Agrupamento de rotas
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