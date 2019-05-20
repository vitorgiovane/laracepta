@extends('layouts.app')

@section('title')
  Cadastrar venda
@endsection

@section('header')
  @component('components.header')
    Cadastrar venda
  @endcomponent
@endsection

@php
  $sellers = !empty($sellers) ? $sellers : [];
  $products = !empty($products) ? $products : [];
@endphp

@section('content')
  @component('sale.parts.form', ['sellers' => $sellers, 'products' => $products])
    Cadastrar venda
    @slot('method') POST @endslot
    @slot('action') {{ route('sales.store') }} @endslot
  @endcomponent
@endsection
