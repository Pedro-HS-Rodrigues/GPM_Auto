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
                        <label for="placa" class="form-label">Placa do Veículo</label>
                        <input type="text" class="form-control" id="placaInput" placeholder="Digite a placa e pressione Enter">
                        <ul id="placasList" class="list-group mt-2"></ul>
                        <input type="hidden" id="placas" name="placas">
                    </div>
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
                            <option value="Troca de Óleo">Troca de Óleo</option>
                            <option value="Alinhamento e Balanceamento">Alinhamento e Balanceamento</option>
                            <option value="Troca de Pastilhas de Freio">Troca de Pastilhas de Freio</option>
                            <option value="Troca de Filtro de Ar">Troca de Filtro de Ar</option>
                            <option value="Substituição de Velas">Substituição de Velas</option>
                            <option value="Inspeção de Suspensão">Inspeção de Suspensão</option>
                            <option value="Troca de Bateria">Troca de Bateria</option>
                            <option value="Verificação de Sistema de Ar-Condicionado">Verificação de Sistema de Ar-Condicionado</option>
                            <option value="Reparo de Vazamentos">Reparo de Vazamentos</option>
                            <option value="Troca de Correia Dentada">Troca de Correia Dentada</option>
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
document.getElementById('placaInput').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        const placa = event.target.value.trim();

        if (placa) {  // Aceita qualquer formato de placa
            const placasList = document.getElementById('placasList');
            const placasInput = document.getElementById('placas');

            // Verifica se a placa já foi inserida
            const existingPlacas = placasInput.value ? placasInput.value.split(',') : [];
            if (!existingPlacas.includes(placa)) {
                const listItem = document.createElement('li');
                listItem.textContent = placa;
                listItem.className = 'list-group-item';
                placasList.appendChild(listItem);

                // Adiciona placa ao campo oculto
                existingPlacas.push(placa);
                placasInput.value = existingPlacas.join(',');
            }

            event.target.value = '';
        }
    }
});

</script>