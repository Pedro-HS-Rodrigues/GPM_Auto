<div class="modal fade" id="modalCadastrarVenda" tabindex="-1" aria-labelledby="modalCadastrarVenda" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCadastrarVendaTitle"><strong>Cadastrar nova venda</strong></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
            <!--Selects estao com valores provisorios-->
          <div class="mb-3">
            <label for="material-name" class="col-form-label">Cliente:</label>
            <input type="text" class="form-control" id="material-name">
          </div>
          <div class="mb-3">
            <label for="material-tipo" class="col-form-label">Vendedor:</label>
            <select class="form-select" aria-label="Default select example">
                    <option selected>Escolha o vendedor</option>
                    <option value="1">Admin</option>
                    <option value="2">Almoxarife</option>
                    <option value="3">Vendedor/Mecânico</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="material-quantidade" class="col-form-label">Produto:</label>
            <select class="form-select" aria-label="Default select example">
                    <option selected>Escolha o produto</option>
                    <option value="1">Admin</option>
                    <option value="2">Almoxarife</option>
                    <option value="3">Vendedor/Mecânico</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="material-quantidade" class="col-form-label">Quantidade:</label>
            <input type="number" class="form-control" id="material-quantidade">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Cadastrar</button>
      </div>
    </div>
  </div>
</div>

<script>

</script>