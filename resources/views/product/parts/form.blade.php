<div class="product__form col-xl-8 order-xl-1">
  <div class="card bg-secondary shadow">
    <div class="card-body">
      <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
        @if( Route::currentRouteName() === 'products.edit' || Route::currentRouteName() === 'products.show' )
          @method('PUT')
        @endif
        @csrf
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label" for="input-username">Nome do produto</label>
            <input name="name" value="{{ !empty($product->name) ? $product->name : null }}" minlength="4" maxlength="80" type="text" id="input-username"
                class="form-control form-control-alternative" placeholder="Nome" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label" for="input-price">Preço</label>
                  <input name="price" value="{{ !empty($product->price) ? $product->price : null }}"
                    min="0" max="99999999999" type="number" required id="input-price"
                    class="form-control form-control-alternative" placeholder="Preço">
                </div>
                </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label class="form-control-label" for="input-quantity">Quantidade em estoque</label>
                    <input name="quantity" value="{{ !empty($product->quantity) ? $product->quantity : null }}"
                      min="0" max="99999999999" type="number" required id="input-quantity"
                      class="form-control form-control-alternative" placeholder="Quantidade">
                    </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="product__form-image form-group">
              <img id="product__form-picture" class="product__form-picture"
                src="{{ !empty($product->picture) ? $product->picture : '/img/picture.png' }}"
                alt="" onclick="document.getElementById('input-picture').click();">
              @if(empty($product->picture))
                <input name="picture" class="product__form-image-input" type="file"
                  required accept="image/*" id="input-picture" placeholder="Imagem"
                  onchange="readURL(this)">
              @else
              <input name="picture" class="product__form-image-input" type="file"
                accept="image/*" id="input-picture" placeholder="Imagem"
                onchange="readURL(this)">
              @endif
              <input class="btn product__input-picture-btn" type="button" value="Escolher imagem"
                onclick="document.getElementById('input-picture').click();" />
            </div>
          </div>
        </div>
        <!-- Description -->
        @php
        $productDescription = !empty($product->description) ? $product->description : null;
        @endphp
        <div class="form-group">
          <label class="form-control-label" for="input-picture">Descrição do produto</label>
          <textarea name="description"
            minlength="10" maxlength=200 rows="4" required
            class="form-control form-control-alternative"
            placeholder="Algumas características do produto...">{{ $productDescription }}</textarea>
        </div>
        <hr class="my-4" />
        <button type="submit" class="btn btn-primary">{{ $slot }}</button>
      </form>
    </div>
  </div>
</div>
