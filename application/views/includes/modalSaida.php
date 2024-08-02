<div class="modal fade" id="modalSaida" tabindex="-1" aria-labelledby="modalSaidaTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSaidaTitle"><strong>Adicionar baixa de saída</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formSaida" action="<?= base_url('materiais/processarSaida') ?>" method="post">
                    <input type="hidden" id="saida-id" name="id">
                    <div class="mb-3">
                        <label for="saida-quantidade" class="col-form-label">Quantas unidades foram retiradas?</label>
                        <input type="number" class="form-control" id="saida-quantidade" name="quantidade" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('formSaida').submit()">Salvar alterações</button>
            </div>
        </div>
    </div>
</div>
