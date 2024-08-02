<?php 
$user_nivel = $this->session->userdata('user_nivel');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPM Auto</title>
    <link rel="shortcut icon" href="<?= base_url()?>assets/img/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        /* Ajuste para centralizar o conteúdo */
        
        .container {
            max-width: 1200px;
            margin-top: 100px;
        }
    </style>
</head>

<body id="vendas-body">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="vendas" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Vendedor</th>
                                <th>Data</th>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dados preenchidos pelo DataTables -->
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <button onclick="abrirModalCadastrarVenda()" class="btn btn-primary me-2" id="nova-venda"><i class="bi bi-plus-circle-fill me-2"></i>Nova venda</button>
                    <?php if ($user_nivel == 1) : ?>
                        <button onclick="abrirModalCompleto()" class="btn btn-primary me-2" id="relatorio-completo"><i class="bi bi-file-earmark-arrow-down-fill me-2"></i>Gerar relatório completo</button>
                        <button onclick="abrirModalSelecionado()" class="btn btn-primary" id="relatorio-selecionado" disabled><i class="bi bi-file-earmark-arrow-down-fill me-2"></i>Gerar relatório selecionado</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#vendas').DataTable({
                "ajax": {
                    "url": "<?= base_url()?>vendas/getVendasData",
                    "type": "GET",
                    "dataSrc": ""
                },
                "columns": [
                    { "data": "Vendedor" },
                    { "data": "Data" },
                    { "data": "Produto" },
                    { "data": "Quantidade" },
                    { "data": null, "defaultContent": "<input type='checkbox' class='form-check-input' />" }
                ],
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
                }
            });

            $('#vendas tbody').on('change', 'input[type="checkbox"]', function() {
                var anyChecked = $('#vendas input[type="checkbox"]:checked').length > 0;
                $('#relatorio-selecionado').prop('disabled', !anyChecked);
            });

            $('#relatorio-completo').on('click', function() {
                abrirModalCompleto();
            });

            $('#relatorio-selecionado').on('click', function() {
                abrirModalSelecionado();
            });

            $('.modal').on('hidden.bs.modal', function() {
                if ($('.modal.show').length) {
                    $('body').addClass('modal-open');
                } else {
                    $('body').removeClass('modal-open');
                }
            });

            $('.modal').on('hidden.bs.modal', function() {
                $('.modal-backdrop').remove();
            });

            $('#formCadastrarVenda').on('submit', function(e) {
                e.preventDefault(); // Impede o envio padrão do formulário

                $.ajax({
                    type: 'POST',
                    url: '<?= base_url() ?>vendas/add_venda',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        $('#modalCadastrarVenda').modal('hide'); // Fecha a modal
                        alert(response.message); // Exibe a mensagem de sucesso ou erro
                        if (response.status === 'success') {
                            location.reload(); // Recarrega a página ao clicar em "OK" no alerta
                        }
                    },
                    error: function() {
                        alert('Ocorreu um erro ao registrar a venda.');
                    }
                });
            });
        });

        function abrirModalCadastrarVenda() {
            new bootstrap.Modal(document.getElementById('modalCadastrarVenda')).show();
        }

        function abrirModalCompleto() {
            $.ajax({
                url: '<?= base_url()?>vendas/getRelatorioCompleto',
                method: 'GET',
                success: function(data) {
                    var stats = JSON.parse(data);

                    var conteudo = '<h5>Relatório Completo</h5>';
                    conteudo += '<h6>Vendas por Vendedor:</h6>';
                    conteudo += '<ul>';
                    for (var vendedor in stats.vendasPorVendedor) {
                        conteudo += '<li>' + vendedor + ': ' + stats.vendasPorVendedor[vendedor] + ' vendas</li>';
                    }
                    conteudo += '</ul>';

                    conteudo += '<h6>Dia com Mais Vendas:</h6>';
                    conteudo += '<p>' + stats.diaMaisVendas + '</p>';

                    conteudo += '<h6>Produto Mais Vendido:</h6>';
                    conteudo += '<p>' + stats.produtoMaisVendido + '</p>';

                    $('#modalCompleto .modal-body').html(conteudo);
                    new bootstrap.Modal(document.getElementById('modalCompleto')).show();
                }
            });
        }

        function abrirModalSelecionado() {
            var selectedData = [];
            $('#vendas input[type="checkbox"]:checked').each(function() {
                var row = $(this).closest('tr');
                var data = $('#vendas').DataTable().row(row).data();
                selectedData.push(data);
            });

            var conteudo = gerarTabela(selectedData);
            $('#modalSelecionado .modal-body').html(conteudo);
            new bootstrap.Modal(document.getElementById('modalSelecionado')).show();
        }

        function gerarTabela(data) {
            var tabela = '<table class="table">';
            tabela += '<thead><tr><th>Vendedor</th><th>Data</th><th>Produto</th><th>Quantidade</th></tr></thead><tbody>';
            data.forEach(function(row) {
                tabela += '<tr><td>' + row.Vendedor + '</td><td>' + row.Data + '</td><td>' + row.Produto + '</td><td>' + row.Quantidade + '</td></tr>';
            });
            tabela += '</tbody></table>';
            return tabela;
        }
    </script>

    <!-- Modais -->
    <!-- modalRelatorio -->
    <div class="modal fade" id="modalSelecionado" tabindex="-1" aria-labelledby="modalSelecionadoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSelecionadoLabel">Relatório Selecionado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Conteúdo será preenchido via JavaScript -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modalRelatorioCompleto -->
    <div class="modal fade" id="modalCompleto" tabindex="-1" aria-labelledby="modalCompleto" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Tamanho Grande -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCompleto-title">Relatório completo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Conteúdo do relatório completo aqui -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cadastrar Venda -->
    <div class="modal fade" id="modalCadastrarVenda" tabindex="-1" aria-labelledby="modalCadastrarVendaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCadastrarVendaLabel">Cadastrar Venda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formCadastrarVenda">
                        <div class="mb-3">
                            <label for="vendedor" class="form-label">Vendedor</label>
                            <select class="form-select" id="vendedor" name="vendedor" required>
                                <option value="">Selecione um vendedor</option>
                                <?php foreach ($vendedores as $vendedor) : ?>
                                    <option value="<?= $vendedor['id'] ?>"><?= $vendedor['nome'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="data" class="form-label">Data</label>
                            <input type="date" class="form-control" id="data" name="data" required>
                        </div>
                        <div class="mb-3">
                            <label for="produto" class="form-label">Produto</label>
                            <select class="form-select" id="produto" name="produto" required>
                                <option value="">Selecione um produto</option>
                                <?php foreach ($produtos as $produto) : ?>
                                    <option value="<?= $produto['id'] ?>"><?= $produto['nome_prod'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="quantidade" class="form-label">Quantidade</label>
                            <input type="number" class="form-control" id="quantidade" name="quantidade" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
