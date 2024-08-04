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
                        <input type="number" class="form-control" id="saida-quantidade" name="quantidade" required  min="0" step="1">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar alterações</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </form>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('formSaida').addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        var form = this;
        var formData = new FormData(form);

        fetch('<?= base_url('materiais/processarSaida') ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                // Atualize a interface ou redirecione conforme necessário
                window.location.reload(); // Atualiza a página
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Ocorreu um erro ao processar a saída.');
        });
    });
});
</script>