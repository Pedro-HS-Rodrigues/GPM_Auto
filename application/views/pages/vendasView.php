<?php
// Inicia a sessão
session_start();

// Inclui o arquivo de conexão com o banco de dados
include_once '../connection/connectVendas.php';

// Verifica se o usuário tem o nível de acesso necessário (1 ou 4)
if (!isset($_SESSION['user_level']) || ($_SESSION['user_level'] != 1 && $_SESSION['user_level'] != 4)) {
    // Se o usuário não tiver acesso autorizado, exibe uma mensagem de alerta e redireciona para o dashboard
    echo "<script>alert('Acesso não autorizado!'); window.location.href = '../pages/dashboard.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPM Auto</title>
    <link rel="icon" href="../assets/img/logo.svg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMc6gYen6f3u3GpQqIzRfl1w1vQJtVj7w2bM2X" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    


</head>
<body id="vendas-body">
    <!-- Define a página atual -->
    <?php $currentPage = basename($_SERVER['PHP_SELF'], ".php") ?>

    <!-- Inclui a barra de navegação -->
    <?php include_once '../includes/navbar.php'; ?>

    <!-- Inclui modais -->
    <?php include_once '../includes/modalRelatorio.php'; ?>
    <?php include_once '../includes/modalRelatorioCompleto.php'; ?>
    <?php include_once '../includes/modalCadastrarVenda.php'; ?>
    
    <div class="container" id="vendas-table">
        <div class="table-container">
            <table id="vendas" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Vendedor</th>
                        <th>Data</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <?php if ($_SESSION['user_level'] == 1): ?>
                        <th>Ação</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <!-- Exibe os dados do banco de dados na tabela -->
                    <?php foreach ($dadosDoBanco as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['Vendedor']); ?></td>
                            <td><?php echo htmlspecialchars($row['Data']); ?></td>
                            <td><?php echo htmlspecialchars($row['Produto']); ?></td>
                            <td><?php echo htmlspecialchars($row['Quantidade']); ?></td>
                            <?php if ($_SESSION['user_level'] == 1): ?>
                            <td>
                                <input type='checkbox' class='form-check-input' />
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- Botões para adicionar nova venda e gerar relatórios -->
        <button onclick="abrirModalCadastrarVenda()" class="btn btn-primary" id="nova-venda"><i class="bi bi-plus-circle-fill me-2"></i>Nova venda</button>
        <?php if ($_SESSION['user_level'] == 1): ?>
            <button onclick="abrirModalCompleto()" class="btn btn-primary" id="relatorio-completo"><i class="bi bi-file-earmark-arrow-down-fill me-2"></i>Gerar relatório completo</button>
            <button onclick="abrirModalSelecionado()" class="btn btn-primary" id="relatorio-selecionado" disabled><i class="bi bi-file-earmark-arrow-down-fill me-2"></i>Gerar relatório selecionado</button>
        <?php endif; ?>
    </div>

    <script src="../assets/js/datatables.js"></script>
    <script src="../assets/js/checkbox.js"></script>
    <script>
        $(document).ready(function () {
            // Inicializa a tabela com DataTables
            $('#vendas').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
                }
            });

            // Função para abrir o modal com os dados selecionados
            function abrirModalSelecionado() {
                var modalBody = $('#modalSelecionado .modal-body');
                modalBody.empty();

                // Adiciona os dados selecionados ao modal
                $('#vendas tbody tr').each(function () {
                    if ($(this).find('input[type="checkbox"]').prop('checked')) {
                        var vendedor = $(this).find('td:eq(0)').text();
                        var data = $(this).find('td:eq(1)').text();
                        var produto = $(this).find('td:eq(2)').text();
                        var quantidade = $(this).find('td:eq(3)').text();

                        modalBody.append(
                            '<p><strong>Vendedor:</strong> ' + vendedor + '</p>' +
                            '<p><strong>Data:</strong> ' + data + '</p>' +
                            '<p><strong>Produto:</strong> ' + produto + '</p>' +
                            '<p><strong>Quantidade:</strong> ' + quantidade + '</p>' +
                            '<hr>'
                        );
                    }
                });
                // Mostra o modal
                new bootstrap.Modal(document.getElementById('modalSelecionado')).show();
            }

            // Evento de clique para o botão de relatório selecionado
            $('#relatorio-selecionado').on('click', function () {
                abrirModalSelecionado();
            });
        });

        // Função para abrir o modal de cadastrar venda
        function abrirModalCadastrarVenda() {
            new bootstrap.Modal(document.getElementById('modalCadastrarVenda')).show();
        }
    </script>
</body>
</html>
