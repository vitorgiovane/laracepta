@extends('layouts.app')

@section('title')
  Lista de vendedores
@endsection

@section('header')
  @component('components.header')
    Lista de vendedores
    @slot('nav')
      @component('components.button')
        Cadastrar vendedor
        @slot('url')
          {{ route('sellers.create') }}
        @endslot
      @endcomponent
      @component('components.counter')
        0
        @slot('legend')
          vendedores
        @endslot
      @endcomponent
    @endslot
  @endcomponent
@endsection

@section('content')
@component('seller.parts.table')@endcomponent
@endsection
