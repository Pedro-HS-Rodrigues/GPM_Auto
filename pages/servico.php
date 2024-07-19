<?php
session_start();
include_once '../connection/connectServico.php';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMc6gYen6f3u3GpXQqIzRfl1w1vQJtVj7w2bM2X" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
    <?php $currentPage = basename($_SERVER['PHP_SELF'], ".php") ?>
    <?php include_once '../includes/navbar.php'; ?>
    <?php include_once '../includes/modalRelatorio.php'; ?>
    <?php include_once '../includes/modalRelatorioCompleto.php'; ?>
    <?php include_once '../includes/modalCadastrarServico.php'; ?>
    
    <div class="container" id="materiais-table">
        <div class="table-container">
            <table id="materiais" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Mecânico</th>
                        <th>Data</th>
                        <th>Serviço</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dadosDoBanco as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['Mecânico']); ?></td>
                            <td><?php echo htmlspecialchars($row['Data']); ?></td>
                            <td><?php echo htmlspecialchars($row['Serviço']); ?></td>
                            <td><?php echo htmlspecialchars($row['Produto']); ?></td>
                            <td><?php echo htmlspecialchars($row['Quantidade']); ?></td>
                            <td>
                                <input type='checkbox' class='form-check-input' />
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <button onclick="abrirModalCadastrarServico()" class="btn btn-primary" id="novo-servico"><i class="bi bi-plus-circle-fill me-2"></i>Novo serviço</button>
        <button onclick="abrirModalCompleto()" class="btn btn-primary" id="relatorio-completo"><i class="bi bi-file-earmark-arrow-down-fill me-2"></i>Gerar relatório completo</button>
        <button onclick="abrirModalSelecionado()" class="btn btn-primary" id="relatorio-selecionado" disabled><i class="bi bi-file-earmark-arrow-down-fill me-2"></i>Gerar relatório selecionado</button>
    </div>

    <script src="../assets/js/datatables.js"></script>
    <script src="../assets/js/checkbox.js"></script>
    <script>
        $(document).ready(function () {
            function abrirModalSelecionado() {
                var modalBody = $('#modalSelecionado .modal-body');
                modalBody.empty();

                $('#materiais tbody tr').each(function () {
                    if ($(this).find('input[type="checkbox"]').prop('checked')) {
                        var mecanico = $(this).find('td:eq(1)').text();
                        var data = $(this).find('td:eq(2)').text();
                        var servico = $(this).find('td:eq(3)').text();
                        var produto = $(this).find('td:eq(4)').text();
                        var quantidade = $(this).find('td:eq(5)').text();

                        modalBody.append(
                            '<p><strong>Mecânico:</strong> ' + mecanico + '</p>' +
                            '<p><strong>Data:</strong> ' + data + '</p>' +
                            '<p><strong>Serviço:</strong> ' + servico + '</p>' +
                            '<p><strong>Produto:</strong> ' + produto + '</p>' +
                            '<p><strong>Quantidade:</strong> ' + quantidade + '</p>' +
                            '<hr>'
                        );
                    }
                });
                new bootstrap.Modal(document.getElementById('modalSelecionado')).show();
            }

            $('#relatorio-selecionado').on('click', function () {
                abrirModalSelecionado();
            });
        });

        function abrirModalCadastrarServico() {
            new bootstrap.Modal(document.getElementById('modalCadastrarServico')).show();
        }
    </script>
</body>
</html>
