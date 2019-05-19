@extends('layouts.app')

@section('title')
  Cadastrar produto
@endsection

@section('header')
  @component('components.header')
    Cadastrar produto
  @endcomponent
@endsection

@section('content')
  @component('product.parts.form')
    Cadastrar produto
    @slot('method') POST @endslot
    @slot('action') {{ route('products.store') }} @endslot
  @endcomponent
@endsection
