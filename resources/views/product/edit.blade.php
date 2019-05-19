@extends('layouts.app')

@section('title')
  Atualizar produto
@endsection

@section('header')
  @component('components.header')
    Atualizar produto
  @endcomponent
@endsection

@section('content')
  @component('product.parts.form', ['product' => $product])
    Atualizar produto
    @slot('method') PUT @endslot
    @slot('action') {{ route('products.update', ['product' => $product->id] ) }} @endslot
  @endcomponent
@endsection
