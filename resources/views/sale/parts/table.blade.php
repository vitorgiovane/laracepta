<div class="row">
  <div class="col">
    <div class="card shadow">

      <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">Produto</th>
              <th scope="col">Vendedor</th>
              <th scope="col">Qtd vendida</th>
              <th scope="col">Total</th>
              <th scope="col">Última atualização</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
            @if(!empty($sales))
            @foreach($sales as $sale)
            <tr>
              <th scope="row">
                @foreach($sale->products as $product)
                <a href="{{ route('products.show', ['product' => $product->id]) }}"
                  class="sales__product models__model-box media align-items-center">
                  <div class="avatar mr-3">
                    <img alt="Image placeholder" src="{{ $product->picture }}">
                  </div>
                  {{ $product->name }}
                </a>
                @endforeach
              </th>
              <td>
                <a href="{{ route('sellers.show', ['seller' => $sale->seller['id']]) }}"
                  class="mb-0 text-sm">
                  <div class="avatar mr-3">
                    <img alt="Image placeholder" src="{{ $sale->seller['picture'] }}">
                  </div>
                  <div class="media-body">
                    {{ $sale->seller['name'] }}
                  </div>
                </a>
              </td>
              <td>
                {{ $sale->quantity }}
              </td>
              <td>
                @php
                  $partialValue = 0;
                  foreach($sale->products as $product) {
                    $partialValue += (float) $product->price;
                  }
                  $total = $partialValue * (int) $sale->quantity
                @endphp
                  R$ {{ $total }}
                </td>
              <td>
                {{ $sale->updated_at }}
              </td>
              <td>
                <div class="actions__buttons">
                  <a href="{{ route('sales.show', ['sale' => $sale->id]) }}"
                  class="actions__update icon icon-shape bg-primary text-white rounded-circle shadow">
                    <i class="ni ni-zoom-split-in"></i>
                  </a>
                  <a href="{{ route('sales.edit', ['sale' => $sale->id]) }}"
                  class="actions__update icon icon-shape bg-info text-white rounded-circle shadow">
                    <i class="ni ni-settings-gear-65"></i>
                  </a>
                    <form method="POST"
                      action="{{ route('sales.destroy', ['sale' => $sale->id]) }}"
                      onsubmit="return confirm('Deseja excluir a venda {{ $sale->name }}?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                        class="button__delete icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="ni ni-fat-remove"></i>
                      </button>
                    </form>
                </div>
              </td>
            </tr>
            @endforeach
            @endif
          </tbody>
        </table>
      </div>
      <div class="card-footer py-4">
        <nav aria-label="...">
          <ul class="pagination justify-content-end mb-0">
              @if(!empty($sales))
                {{ $sales->links() }}
              @endif
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>
