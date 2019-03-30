<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view("welcome");
});

Route::get('/ola', function (){
    return "Olá";
});

Route::get('/ola/sejabemvindo', function (){
    return "Olá seja bem vindo, visitante";
});

// Parâmetros
Route::get('/nome/{nome}/{sobrenome}', function ($nome, $sobrenome){
    return "<h1>Ola, $nome $sobrenome!</h1>";
});

Route::get('/repetir/{nome}/{n}', function ($nome, $n){
    if (is_integer($n)) {
        for($i = 0; $i < $n; $i++){
            echo "<h1>Ola, $nome!</h1>";
        }
    } else {
        echo "Você não digitou um inteiro";
    }
});

// Parâmetros opcionais e restritos
Route::get('/seunomecomregra/{nome}/{n}', function ($nome, $n){
    for($i = 0; $i < $n; $i++){
        echo "<h1>Ola, $nome!</h1>";
    }
})->where('n', '[0-9]+')->where('nome', '[A-Za-z]+');

Route::get('/seunomesemregra/{nome?}', function ($nome=null){
    if (isset($nome)) {
        echo "<h1>Ola, $nome!</h1>";
    } else {
        echo "Você não passou nenhum nome";
    }
});

// Agrupamento de rotas
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

// Redirecionando rotas
Route::redirect('/aqui', '/ola', 301);

Route::view('/hello', 'hello');

Route::view('/viewnome', 'hellonome', ['nome'=>'João', 'sobrenome'=>'Silva']);

Route::get('/hellonome/{nome}/{sobrenome}', function ($nome, $sobrenome){
    return view('hellonome', ['nome'=>$nome, 'sobrenome'=>$sobrenome]);
});

// Métodos HTTP
Route::get('/rest/hello', function () {
    return "Hello (GET)";
});

Route::post('/rest/hello', function () {
    return "Hello (POST)";
});

Route::delete('/rest/hello', function () {
    return "Hello (DELETE)";
});

Route::put('/rest/hello', function () {
    return "Hello (PUT)";
});

Route::patch('/rest/hello', function () {
    return "Hello (PATCH)";
});

Route::options('/rest/hello', function () {
    return "Hello (OPTIONS)";
});

Route::post('/rest/imprimir', function (Request $req) {
    $nome = $req->input('nome');
    $idade = $req->input('idade');
    return "Hello $nome ($idade) !! (POST)";
});

Route::match(['get', 'post'], '/rest/hello2', function () {
    return "Hello World 2";
});

Route::any('/rest/hello3', function () {
    return "Hello World 3";
});

// Nomeando rotas
Route::get('/produtos', function(){
    echo "<h1>Produtos</h1>";
    echo "<ol>";
    echo "<li> Notebook </li>";
    echo "<li> Impressora </li>";
    echo "<li> Mouse </li>";
    echo "</ol>";
})->name("meusprodutos");

Route::get('/linkprodutos', function(){
    $url = route('meusprodutos');
    echo "<a href=\"$url\"> Meus Produtos </a>";
});

Route::get('/redirecionarprodutos', function () {
    return redirect()->route('meusprodutos');
});