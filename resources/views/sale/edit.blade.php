@extends('layouts.app')

@section('title')
  Atualizar venda
@endsection

@section('header')
  @component('components.header')
    Atualizar venda
  @endcomponent
@endsection

@section('content')
  @component('sale.parts.form', [
    'sale' => $sale,
    'sellers' => $sellers,
    'products' => $products,
    'basket' => $basket
    ])
    Atualizar venda
    @slot('method') PUT @endslot
    @slot('action') {{ route('sales.update', ['sale' => $sale->id] ) }} @endslot
  @endcomponent
@endsection
