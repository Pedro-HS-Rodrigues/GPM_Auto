<div class="modal fade" id="modalCadastrarServico" tabindex="-1" aria-labelledby="modalCadastrarServicoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCadastrarServicoLabel">Cadastrar Novo Serviço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formCadastrarServico" method="post" action="<?= base_url()?>servico/cadastrar">
                    <div class="mb-3">
                        <label for="selectMecanico" class="form-label">Mecânico</label>
                        <select id="selectMecanico" class="form-select" name="mecanico" required>
                            <option selected>Escolha o mecânico</option>
                            <?php foreach ($mecanicos as $mecanico): ?>
                                <option value="<?php echo htmlspecialchars($mecanico['id']); ?>">
                                    <?php echo htmlspecialchars($mecanico['nome']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="dataVenda" class="form-label">Data</label>
                        <input type="date" class="form-control" id="dataVenda" name="data" required>
                    </div>
                    <div class="mb-3">
                        <label for="selectServico" class="form-label">Serviço</label>
                        <select id="selectServico" class="form-select" name="servico" required>
                            <option selected>Escolha o serviço</option>
                            <option value="1">Troca de Óleo</option>
                            <option value="2">Alinhamento e Balanceamento</option>
                            <option value="3">Troca de Pastilhas de Freio</option>
                            <option value="4">Troca de Filtro de Ar</option>
                            <option value="5">Substituição de Velas</option>
                            <option value="6">Inspeção de Suspensão</option>
                            <option value="7">Troca de Bateria</option>
                            <option value="8">Verificação de Sistema de Ar-Condicionado</option>
                            <option value="9">Reparo de Vazamentos</option>
                            <option value="10">Troca de Correia Dentada</option>
                        </select>
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
document.getElementById('formCadastrarServico').addEventListener('submit', function(event) {
    var selectProduto = document.getElementById('selectProduto');
    var quantidadeProduto = document.getElementById('quantidadeProduto');
    var quantidade = parseInt(quantidadeProduto.value, 10);

    // Obter a quantidade disponível do produto selecionado
    var estoque = selectProduto.options[selectProduto.selectedIndex].dataset.estoque;

    if (quantidade > estoque) {
        event.preventDefault(); // Impede o envio do formulário
        alert('Quantidade em estoque insuficiente.');
    }
});
</script>
