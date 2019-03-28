<?php

use Illuminate\Support\Facades\Route;

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







