@extends('layouts.app')

@section('title')
  Atualizar vendedor
@endsection

@section('header')
  @component('components.header')
    Atualizar vendedor
  @endcomponent
@endsection

@section('content')
  @component('seller.parts.form', ['seller' => $seller])
    Atualizar vendedor
    @slot('method') PUT @endslot
    @slot('action') {{ route('sellers.update', ['seller' => $seller->id] ) }} @endslot
  @endcomponent
@endsection
