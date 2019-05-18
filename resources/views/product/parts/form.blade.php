<div class="product__form col-xl-8 order-xl-1">
    <div class="card bg-secondary shadow">
      <div class="card-body">
        <form method="POST" action="/products" enctype="multipart/form-data">
          @csrf
          <div class="">
            <div class="row">
              <div class="col-lg-8">
                <div class="form-group">
                  <label class="form-control-label" for="input-username">Nome do produto</label>
                  <input name="name" minlength="4" maxlength="80" type="text" required id="input-username" class="form-control form-control-alternative" placeholder="Nome">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label" for="input-quantity">Quantidade em estoque</label>
                  <input name="quantity" max="99999999999" type="number" required id="input-quantity" class="form-control form-control-alternative" placeholder="Quantidade">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label" for="input-price">Preço</label>
                  <input name="price" max="99999999999" type="number" required id="input-price" class="form-control form-control-alternative" placeholder="Preço">
                </div>
              </div>
              <div class="col-lg-8">
                <div class="form-group">
                  <label class="form-control-label" for="input-picture">Imagem</label>
                  <input name="picture" class="btn" type="file" required accept="image/*" id="input-picture" class="form-control form-control-alternative" placeholder="Imagem">
                </div>
              </div>
            </div>
          </div>
          <!-- Description -->
          <div class="form-group">
            <label class="form-control-label" for="input-picture">Descrição do produto</label>
            <textarea name="description" minlength="10" maxlength=200 rows="4" required class="form-control form-control-alternative" placeholder="Algumas características do produto..."></textarea>
          </div>
          <hr class="my-4" />
          <button type="submit" class="btn btn-primary">Cadastrar produto</button>
        </form>
      </div>
    </div>
</div>
