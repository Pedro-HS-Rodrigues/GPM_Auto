<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPM Auto</title>

    <link rel="icon" href="../assets/img/logo.svg" type="image/x-icon">

    <!-- Adicionando o BootStrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Adicionando a fonte do projeto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Adicionando a folha de estilo do projeto -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Adicionando os ícones do projeto -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMc6gYen6f3u3GpXQqIzRfl1w1vQJtVj7w2bM2X" crossorigin="anonymous">

    <!-- DataTables -->
    <!-- Inclua jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Inclua o CSS do DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">

    <!-- Inclua o JavaScript do DataTables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>

    <!-- Inclua o arquivo de tradução para português -->
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"></script>

    <!-- Inclua o Bootstrap Bundle para modal e outros componentes -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

</head>

<body>
    <?php $currentPage = basename($_SERVER['PHP_SELF'], ".php") ?>
    <?php include_once '../includes/navbar.php'; ?>
    <?php include_once '../includes/modalRelatorio.php'; ?>
    <?php include_once '../includes/modalRelatorioCompleto.php'; ?>
    <?php include_once '../includes/modalCadastrarServico.php'; ?>
    <?php include_once '../includes/modalCadastrarVenda.php'; ?>
    
    <div class="container" id="materiais-table">
        <div class=" ">
            <div class="table-container">
                <table id="materiais" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Vendedor</th>
                            <th>Data</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Exemplo de dados simulados do banco de dados
                        $dadosDoBanco = array(
                            array("Cliente" => "João Silva", "Vendedor" => "Carlos Souza", "Data" => "2023-07-18", "Produto" => "Óleo 10W40", "Quantidade" => "1"),
                            array("Cliente" => "Maria Santos", "Vendedor" => "Ana Oliveira", "Data" => "2023-07-20", "Produto" => "Pastilhas de freio", "Quantidade" => "2"),
                            array("Cliente" => "Pedro Ferreira", "Vendedor" => "Rafael Costa", "Data" => "2023-07-22", "Produto" => "Pneu Aro 15", "Quantidade" => "4"),
                            // Adicionar mais linhas conforme necessário
                        );

                        foreach ($dadosDoBanco as $row) {
                            echo "<tr>";
                            echo "<td>" . $row['Cliente'] . "</td>";
                            echo "<td>" . $row['Vendedor'] . "</td>";
                            echo "<td>" . $row['Data'] . "</td>";
                            echo "<td>" . $row['Produto'] . "</td>";
                            echo "<td>" . $row['Quantidade'] . "</td>";
                            echo "<td>";
                            // Botão para abrir a modal de edição
                            echo "<input type='checkbox' class='form-check-input' />";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <button onclick="abrirModalCadastrarServico()" class="btn btn-primary" id="novo-servico"><i class="bi bi-plus-circle-fill me-2"></i>Nova venda</button>
        <button onclick="abrirVendaCompleta()" class="btn btn-primary" id="relatorio-completo"><i class="bi bi-file-earmark-arrow-down-fill me-2"></i>Gerar relatório completo</button>
        <button onclick="abrirModalSelecionado()" class="btn btn-primary" id="relatorio-selecionado" disabled><i class="bi bi-file-earmark-arrow-down-fill me-2"></i>Gerar relatório selecionado</button>
    </div>

    <script src="../assets/js/datatables.js"></script>
    <script src="../assets/js/checkbox.js"></script>
    <script>
        $(document).ready(function () {
            // Função para abrir a modal com os dados selecionados
            function abrirModalSelecionado() {
                var modalBody = $('#modalSelecionado .modal-body');
                modalBody.empty(); // Limpa o conteúdo anterior da modal

                // Itera sobre as linhas da tabela
                $('#materiais tbody tr').each(function () {
                    // Verifica se o checkbox da linha está marcado
                    if ($(this).find('input[type="checkbox"]').prop('checked')) {
                        // Obtém os dados da linha
                        var cliente = $(this).find('td:eq(0)').text();
                        var vendedor = $(this).find('td:eq(1)').text();
                        var data = $(this).find('td:eq(2)').text();
                        var produto = $(this).find('td:eq(3)').text();
                        var quantidade = $(this).find('td:eq(4)').text();

                        // Adiciona os dados na modal
                        modalBody.append(
                            '<p><strong>Cliente:</strong> ' + cliente + '</p>' +
                            '<p><strong>Vendedor:</strong> ' + vendedor + '</p>' +
                            '<p><strong>Data:</strong> ' + data + '</p>' +
                            '<p><strong>Produto:</strong> ' + produto + '</p>' +
                            '<p><strong>Quantidade:</strong> ' + quantidade + '</p>' +
                            '<hr>'
                        );
                    }
                });

                // Mostra a modal
                new bootstrap.Modal(document.getElementById('modalSelecionado')).show();
            }

            $('#relatorio-selecionado').on('click', function () {
                abrirModalSelecionado();
            });
        });

        function abrirModalCadastrarServico() {
            new bootstrap.Modal(document.getElementById('modalCadastrarVenda')).show();
        }

        
    </script>
</body>

</html>
