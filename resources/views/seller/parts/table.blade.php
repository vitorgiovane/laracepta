<div class="row">
  <div class="col">
    <div class="card shadow">

      <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">Vendedor</th>
              <th scope="col">E-mail</th>
              <th scope="col">Última atualização</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
            @if(!empty($sellers))
            @foreach($sellers as $seller)
            <tr>
              <th scope="row">
                <a href="{{ route('sellers.show', ['seller' => $seller]) }}"
                  class="sellers__seller-box media align-items-center">
                  <div class="avatar mr-3">
                    <img alt="Image placeholder" src="{{ $seller->picture }}">
                  </div>
                  <div class="media-body">
                    <div href="{{ route('sellers.show', ['seller' => $seller]) }}"
                      class="mb-0 text-sm">
                      {{ $seller->name }}
                    </div>
                  </div>
                </a>
              </th>
              <td>
                {{ $seller->email }}
              </td>
              <td>
                {{ $seller->updated_at }}
              </td>
              <td>
                <div class="actions__buttons">
                <a href="{{ route('sellers.edit', ['seller' => $seller->id]) }}"
                  class="actions__update icon icon-shape bg-info text-white rounded-circle shadow">
                      <i class="ni ni-settings-gear-65"></i>
                    </a>
                    <form method="POST"
                      action="{{ route('sellers.destroy', ['seller' => $seller->id]) }}"
                      onsubmit="return confirm('Deseja excluir o vendedor {{ $seller->name }}?')">
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
              @if(!empty($sellers))
                {{ $sellers->links() }}
              @endif
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>
