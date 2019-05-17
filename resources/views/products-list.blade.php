@extends('layouts.app')

@section('title')
  Lista de produtos
@endsection

@section('sidebar')
  @component('sidebar')
@endsection

@section('header')
  @component('components.header')
    Lista de produtos
    @slot('nav')
      @component('components.button')
        Cadastrar produto
      @endcomponent
    @endslot
  @endcomponent
@endsection

@section('content')
  @component('components.products-table', ['models' => $products]) @endcomponent
@endsection
