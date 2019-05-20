@extends('layouts.app')

@section('title')
  Lista de vendas
@endsection

@section('header')
  @component('components.header')
    Lista de vendas
    @slot('nav')
      @component('components.button')
        Cadastrar venda
        @slot('url')
          {{ route('sales.create') }}
        @endslot
      @endcomponent
      @component('components.counter')
        0
        @slot('legend')
          vendas
        @endslot
      @endcomponent
    @endslot
  @endcomponent
@endsection

@section('content')
@component('sale.parts.table')@endcomponent
@endsection
