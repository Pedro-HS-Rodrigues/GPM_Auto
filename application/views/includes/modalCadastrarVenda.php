<div class="modal fade" id="modalCadastrarVenda" tabindex="-1" aria-labelledby="modalCadastrarVendaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCadastrarVendaLabel">Cadastrar Nova Venda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formCadastrarVenda" method="post" action="<?= base_url('vendas/add_venda') ?>">
                    <div class="mb-3">
                        <label for="selectVendedor" class="form-label">Vendedor</label>
                        <select id="selectVendedor" class="form-select" name="vendedor" required>
                            <option selected>Escolha o vendedor</option>
                            <?php foreach ($vendedores as $vendedor): ?>
                                <option value="<?php echo htmlspecialchars($vendedor['id']); ?>">
                                    <?php echo htmlspecialchars($vendedor['nome']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="dataVenda" class="form-label">Data</label>
                        <input type="date" class="form-control" id="dataVenda" name="data" required>
                    </div>
                    <div class="mb-3">
                        <label for="selectProduto" class="form-label">Produto</label>
                        <select id="selectProduto" class="form-select" name="produto" required>
                            <option selected>Escolha o produto</option>
                            <?php foreach ($produtos as $produto): ?>
                                <option value="<?php echo htmlspecialchars($produto['id']); ?>" 
                                        data-estoque="<?php echo htmlspecialchars($produto['qntd']); ?>">
                                    <?php echo htmlspecialchars($produto['nome_prod']); ?> 
                                    (<?php echo htmlspecialchars($produto['qntd']); ?> em estoque)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantidadeProduto" class="form-label">Quantidade</label>
                        <input type="number" class="form-control" id="quantidadeProduto" name="quantidade" min="1" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('formCadastrarVenda').addEventListener('submit', function(event) {
    var selectProduto = document.getElementById('selectProduto');
    var quantidadeProduto = document.getElementById('quantidadeProduto');
    var produtoId = selectProduto.value;
    var quantidade = parseInt(quantidadeProduto.value, 10);

    // Obter a quantidade disponível do produto selecionado
    var estoque = selectProduto.options[selectProduto.selectedIndex].dataset.estoque;

});
</script>
