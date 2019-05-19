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
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  @component('product.parts.form', ['product' => $product])
    Atualizar produto
    @slot('method') PUT @endslot
    @slot('action') {{ route('products.update', ['product' => $product->id] ) }} @endslot
  @endcomponent
@endsection
