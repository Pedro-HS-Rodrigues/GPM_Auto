<div class="modal fade" id="modalCadastrar" tabindex="-1" aria-labelledby="modalCadastrar" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCadastrarTitle"><strong>Cadastrar novo material</strong></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../connection/connectMateriaisInsert.php" method="post" id="formCadastrarMaterial">
          <div class="mb-3">
            <label for="material-name" class="col-form-label">Nome:</label>
            <input type="text" class="form-control" id="material-name" name="nome" required>
          </div>
          <div class="mb-3">
            <label for="material-tipo" class="col-form-label">Tipo:</label>
            <input type="text" class="form-control" id="material-tipo" name="tipo" required>
          </div>
          <div class="mb-3">
            <label for="material-quantidade" class="col-form-label">Quantidade:</label>
            <input type="number" class="form-control" id="material-quantidade" name="quantidade" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" onclick="document.getElementById('formCadastrarMaterial').submit()">Cadastrar</button>
      </div>
    </div>
  </div>
</div>
