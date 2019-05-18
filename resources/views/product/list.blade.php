@extends('layouts.app')

@section('title')
  Lista de produtos
@endsection

@section('header')
  @component('components.header')
    Lista de produtos
    @slot('nav')
      @component('components.button')
        Cadastrar produto
        @slot('url')
          products/create
        @endslot
      @endcomponent
    @endslot
  @endcomponent
@endsection

@section('content')
  @component('product.parts.table', ['products' => $products]) @endcomponent
@endsection