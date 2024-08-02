<?php 
$user_nivel = $this->session->userdata('user_nivel');
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPM Auto</title>
    <link rel="icon" href="assets/img/logo.svg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body id="vendas-body">
    <div class="container" id="vendas-table">
        <div class="table-container">
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
        <button onclick="abrirModalCadastrarVenda()" class="btn btn-primary" id="nova-venda"><i class="bi bi-plus-circle-fill me-2"></i>Nova venda</button>
        <?php if ($user_nivel == 1) : ?>
        <button onclick="abrirModalCompleto()" class="btn btn-primary" id="relatorio-completo"><i class="bi bi-file-earmark-arrow-down-fill me-2"></i>Gerar relatório completo</button>
        <button onclick="abrirModalSelecionado()" class="btn btn-primary" id="relatorio-selecionado" disabled><i class="bi bi-file-earmark-arrow-down-fill me-2"></i>Gerar relatório selecionado</button>
        <?php endif; ?>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#vendas').DataTable({
                "ajax": {
                    "url": "<?= base_url()?>vendas/getVendasData",
                    "type": "GET",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "Vendedor"
                    },
                    {
                        "data": "Data"
                    },
                    {
                        "data": "Produto"
                    },
                    {
                        "data": "Quantidade"
                    },
                    {
                        "data": null,
                        "defaultContent": "<input type='checkbox' class='form-check-input' />"
                    }
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

</body>

</html>
