<div class="model__form col-xl-8 order-xl-1">
  <div class="card bg-secondary shadow">
    <div class="card-body">
      <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
        @if( Route::currentRouteName() === 'sales.edit' || Route::currentRouteName() === 'sales.show' )
          @method('PUT')
        @endif
        @csrf
        <div class="row">
          <div class="col-lg-8">
            <div class="sellers-form-group form-group">
              <label class="form-control-label" for="input-sellers">Vendedor</label>
              <select required name="seller_id" id="input-sellers">
                <option value="">-- Escolha um vendedor --</option>
                @foreach ($sellers as $seller)
                  <option @if($seller->id === $sale->seller_id) selected @endif
                    value="{{ $seller->id }}">{{ $seller->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label" for="input-quantity">Quantidade</label>
                <input name="quantity" value="{{ !empty($sale->quantity) ? $sale->quantity : null }}"
                  min="0" max="99999999999" type="number" required id="input-quantity"
                  class="form-control form-control-alternative" placeholder="Quantidade">

              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
              <div class="sellers-form-group form-group">
                <label class="form-control-label" for="input-price">
                  Produtos (você pode escolher mais de um)
                </label>
                <select name="chosen_products[]" multiple="multiple" size="6" required>
                  @foreach ($products as $product)
                    <option @if(in_array($product->id, $basket)) selected @endif
                      value="{{ $product->id }}">{{ $product->name }}</option>
                  @endforeach
                </select>
              </div>
              </div>
          </div>
        <hr class="my-4" />
        <button type="submit" class="btn btn-primary">{{ $slot }}</button>
      </form>
    </div>
  </div>
</div>
