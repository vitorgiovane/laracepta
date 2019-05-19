<div class="model__form col-xl-8 order-xl-1">
  <div class="card bg-secondary shadow">
    <div class="card-body">
      <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
        @if( Route::currentRouteName() === 'sellers.edit' || Route::currentRouteName() === 'sellers.show' )
          @method('PUT')
        @endif
        @csrf
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label class="form-control-label" for="input-username">Nome do vendedor</label>
            <input name="name" value="{{ !empty($seller->name) ? $seller->name : null }}" minlength="4" maxlength="45" type="text" id="input-username"
                class="form-control form-control-alternative" placeholder="Nome" required>
            </div>
          </div>
          <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-email">E-mail do vendedor</label>
              <input name="email" value="{{ !empty($seller->email) ? $seller->email : null }}" minlength="4" maxlength="45" type="text" id="input-email"
                  class="form-control form-control-alternative" placeholder="E-mail" required>
              </div>
            </div>
        </div>
        <div class="row">
          <div class="col-lg-8">
            <div class="model__form-image form-group">
              <img id="model__form-picture" class="model__form-picture"
                src="{{ !empty($seller->picture) ? $seller->picture : '/img/picture.png' }}"
                alt="" onclick="document.getElementById('input-picture').click();">
              @if(empty($seller->picture))
                <input name="picture" class="model__form-image-input" type="file"
                  required accept="image/*" id="input-picture" placeholder="Imagem"
                  onchange="readURL(this)">
              @else
              <input name="picture" class="model__form-image-input" type="file"
                accept="image/*" id="input-picture" placeholder="Imagem"
                onchange="readURL(this)">
              @endif
              <input class="btn model__input-picture-btn" type="button" value="Escolher imagem"
                onclick="document.getElementById('input-picture').click();" />
            </div>
          </div>
        </div>
        <hr class="my-4" />
        <button type="submit" class="btn btn-primary">{{ $slot }}</button>
      </form>
    </div>
  </div>
</div>
