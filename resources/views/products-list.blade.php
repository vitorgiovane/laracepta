@extends('layouts.app')

@section('title')
Lista de produtos
@endsection

@section('sidebar')
@component('sidebar')
@endsection

@component('includes.header')
  @slot('buttons')
  Hello, man
  @endslot
@endcomponent

@section('content')
<!-- Table -->
<div class="row">
  <div class="col">
    <div class="card shadow">
      <div class="card-header border-0">
        <h3 class="mb-0">Produtos</h3>
      </div>
      <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">Nome do produto</th>
              <th scope="col">Descrição</th>
              <th scope="col">Preço</th>
              <th scope="col">Em estoque</th>
              <th scope="col">Última atualização</th>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $product)
            <tr>
              <th scope="row">
                <div class="media align-items-center">
                  <a href="#" class="avatar rounded-circle mr-3">
                    <img alt="Image placeholder" src="{{ $product->picture }}">
                  </a>
                  <div class="media-body">
                    <span class="mb-0 text-sm">{{ $product->name }}</span>
                  </div>
                </div>
              </th>
              <td>
                {{ $product->description }}
              </td>
              <td>
                  R$ {{ $product->price }}
              </td>
              <td>
                {{ $product->quantity }}
              </td>
              <td>
                {{ $product->updated_at }}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer py-4">
        <nav aria-label="...">
          <ul class="pagination justify-content-end mb-0">
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1">
                <i class="fas fa-angle-left"></i>
                <span class="sr-only">Previous</span>
              </a>
            </li>
            <li class="page-item active">
              <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
            </li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">
                <i class="fas fa-angle-right"></i>
                <span class="sr-only">Next</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>
@endsection
