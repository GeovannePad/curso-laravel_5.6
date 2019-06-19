@extends('layouts.app')

@section('titulo', 'Minha página filho')

@section('barralateral')
    <p>Essa parte é do filho</p>
    @parent
@endsection

@section('conteudo')
    <p>Este é o conteúdo do filho</p>
@endsection