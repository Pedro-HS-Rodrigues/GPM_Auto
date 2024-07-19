<div class="modal fade" id="modalEntrada" tabindex="-1" aria-labelledby="modalEntrada" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEntradaTitle"><strong>Adicionar baixa de entrada</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEntrada" action="../connection/connectEntrada.php" method="post">
                    <input type="hidden" id="entrada-id" name="id">
                    <div class="mb-3">
                        <label for="entrada-quantidade" class="col-form-label">Quantas unidades foram adicionadas?</label>
                        <input type="number" class="form-control" id="entrada-quantidade" name="quantidade" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('formEntrada').submit()">Salvar alterações</button>
            </div>
        </div>
    </div>
</div>