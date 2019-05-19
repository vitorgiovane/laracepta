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
          {{ route('products.create') }}
        @endslot
      @endcomponent
      @component('components.counter')
        {{ $totalOfProducts }}
        @slot('legend')
          produtos
        @endslot
      @endcomponent
    @endslot
  @endcomponent
@endsection

@section('content')
  @component('product.parts.table', ['products' => $products]) @endcomponent
@endsection
