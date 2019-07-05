<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function listar()
    {
        $produtos = [
            "Notebook Asus i7 16GB",
            "Mouse e teclado Microsoft",
            "Monitor 21 - Samsung",
            "Impressora HP",
            "Disco SSD 512GB"
        ];

        return view('produtos', compact('produtos'));
    }

    public function secaoprodutos($palavra)
    {
        return view('secao_produtos', compact('palavra'));
    }

    public function mostraropcoes()
    {
        return view('mostrar_opcoes');
    }

    public function opcoes($opcao)
    {
        return view('opcoes', compact('opcao'));
    }

    public function loopFor($n)
    {
        return view('loop_for', compact('n'));
    }

    public function loopForeach()
    {
        $produtos = [
            [
                'id'=>1, 
                'nome'=>'Computador'
            ],
            [
                'id'=>2, 
                'nome'=>'Mouse'
            ],
            [
                'id'=>3, 
                'nome'=>'Impressora'
            ],
            [
                'id'=>4, 
                'nome'=>'Monitor'
            ],
            [
                'id'=>5, 
                'nome'=>'Teclado'
            ],
        ];

        return view('foreach', compact('produtos'));
    }
}
