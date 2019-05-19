<div class="row">
  <div class="col">
    <div class="card shadow">

      <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">Produtos</th>
              <th scope="col">Descrição</th>
              <th scope="col">Preço</th>
              <th scope="col">Qtd em estoque</th>
              <th scope="col">Última atualização</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $product)
            <tr>
              <th scope="row">
                <a href="{{ route('products.show', ['product' => $product]) }}"
                  class="products__product-box media align-items-center">
                  <div class="avatar mr-3">
                    <img alt="Image placeholder" src="{{ $product->picture }}">
                  </div>
                  <div class="media-body">
                    <div href="{{ route('products.show', ['product' => $product]) }}"
                      class="mb-0 text-sm">
                      {{ $product->name }}
                    </div>
                  </div>
                </a>
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
              <td>
                <div class="actions__buttons">
                <a href="{{ route('products.edit', ['product' => $product->id]) }}"
                  class="actions__update icon icon-shape bg-info text-white rounded-circle shadow">
                      <i class="ni ni-settings-gear-65"></i>
                    </a>
                    <form method="POST"
                      action="{{ route('products.destroy', ['product' => $product->id]) }}"
                      onsubmit="return confirm('Deseja excluir o produto {{ $product->name }}?')">
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
          </tbody>
        </table>
      </div>
      <div class="card-footer py-4">
        <nav aria-label="...">
          <ul class="pagination justify-content-end mb-0">
              {{ $products->links() }}
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>
