@extends('layouts.app')

@section('title')
  Cadastrar vendedor
@endsection

@section('header')
  @component('components.header')
    Cadastrar vendedor
  @endcomponent
@endsection

@section('content')
  @component('seller.parts.form')
    Cadastrar vendedor
    @slot('method') POST @endslot
    @slot('action') {{ route('sellers.store') }} @endslot
  @endcomponent
@endsection
