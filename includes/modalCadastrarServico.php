<!-- Modal para Cadastrar Serviço -->
<?php
include_once '../connection/connectServico.php';
?>
<!-- Modal para Cadastrar Serviço -->
<div class="modal fade" id="modalCadastrarServico" tabindex="-1" aria-labelledby="modalCadastrarServicoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCadastrarServicoLabel">Cadastrar Novo Serviço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formCadastrarServico" method="post" action="../connection/connectServico.php">
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
                        <label for="selectServico" class="form-label">Serviço</label>
                        <input type="text" class="form-control" id="selectServico" name="servico" required>
                    </div>
                    <div class="mb-3">
                        <label for="selectProduto" class="form-label">Produto</label>
                        <select id="selectProduto" class="form-select" name="produto" required>
                          <option selected>Escolha o produto</option>
                            <?php foreach ($produtos as $produto): ?>
                               
                                <option value="<?php echo htmlspecialchars($produto['id']); ?>">
                                    <?php echo htmlspecialchars($produto['nome_prod']); ?>
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
