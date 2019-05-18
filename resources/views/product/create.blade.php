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
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  @component('product.parts.form') @endcomponent
@endsection
