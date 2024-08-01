<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> <!-- Define a codificação de caracteres -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura a visualização para dispositivos móveis -->
    <title>GPM Auto</title>
    <link rel="icon" href="assets/img/logo.svg" type="image/x-icon"> <!-- Ícone da página -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- CSS do Bootstrap -->
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- Pré-conexão com o Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- Pré-conexão com o Google Fonts com política de compartilhamento de recursos -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"> <!-- Fonte Montserrat -->
    <link rel="stylesheet" href="assets/css/style.css"> <!-- CSS personalizado -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMc6gYen6f3u3GpXQqIzRfl1w1vQJtVj7w2bM2X" crossorigin="anonymous"> <!-- Ícones do Font Awesome -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css"> <!-- CSS do DataTables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script> <!-- JS do DataTables -->
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"></script> <!-- Tradução para português do DataTables -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> <!-- JS do Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"> <!-- Ícones do Bootstrap -->
</head>
<body>
    <div class="container" id="materiais-table">
        <div class="table-container">
            <table id="materiais" class="table table-striped table-bordered"> <!-- Tabela com classes do Bootstrap e DataTables -->
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
                    
                        <!--<?php foreach ($dadosDoBanco as $row): ?>  
                        <tr>
                            <td><?php echo htmlspecialchars($row['Mecânico']); ?></td>
                            <td><?php echo htmlspecialchars($row['Data']); ?></td>
                            <td><?php echo htmlspecialchars($row['Serviço']); ?></td>
                            <td><?php echo htmlspecialchars($row['Produto']); ?></td>
                            <td><?php echo htmlspecialchars($row['Quantidade']); ?></td>
                            <?php if ($_SESSION['user_level'] == 1): ?>
                            <td>
                                <input type='checkbox' class='form-check-input' />
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>-->
                            
                </tbody>
            </table>
        </div>
        <button onclick="abrirModalCadastrarServico()" class="btn btn-primary" id="novo-servico"><i class="bi bi-plus-circle-fill me-2"></i>Novo serviço</button> <!-- Botão para abrir modal de cadastro de serviço --> <!-- Verifica se o usuário é administrador -->
            <button onclick="abrirModalCompleto()" class="btn btn-primary" id="relatorio-completo"><i class="bi bi-file-earmark-arrow-down-fill me-2"></i>Gerar relatório completo</button> <!-- Botão para gerar relatório completo -->
            <button onclick="abrirModalSelecionado()" class="btn btn-primary" id="relatorio-selecionado" disabled><i class="bi bi-file-earmark-arrow-down-fill me-2"></i>Gerar relatório selecionado</button> <!-- Botão para gerar relatório selecionado -->
    </div>

    <script src="assets/js/datatables.js"></script> <!-- JS personalizado para DataTables -->
    <script src="assets/js/checkbox.js"></script> <!-- JS personalizado para manipulação de checkboxes -->
    <script>
        $(document).ready(function () {
            // Função para abrir o modal com os itens selecionados
            function abrirModalSelecionado() {
                var modalBody = $('#modalSelecionado .modal-body'); // Seleciona o corpo do modal
                modalBody.empty(); // Limpa o conteúdo do modal

                // Itera sobre as linhas da tabela
                $('#materiais tbody tr').each(function () {
                    if ($(this).find('input[type="checkbox"]').prop('checked')) { // Verifica se o checkbox está marcado
                        var mecanico = $(this).find('td:eq(0)').text(); // Obtém o nome do mecânico
                        var data = $(this).find('td:eq(1)').text(); // Obtém a data
                        var servico = $(this).find('td:eq(2)').text(); // Obtém o serviço
                        var produto = $(this).find('td:eq(3)').text(); // Obtém o produto
                        var quantidade = $(this).find('td:eq(4)').text(); // Obtém a quantidade

                        // Adiciona as informações ao modal
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
                new bootstrap.Modal(document.getElementById('modalSelecionado')).show(); // Mostra o modal
            }

            // Evento de clique para o botão de relatório selecionado
            $('#relatorio-selecionado').on('click', function () {
                abrirModalSelecionado(); // Chama a função para abrir o modal com os itens selecionados
            });
        });

        // Função para abrir o modal de cadastro de serviço
        function abrirModalCadastrarServico() {
            new bootstrap.Modal(document.getElementById('modalCadastrarServico')).show(); // Mostra o modal de cadastro de serviço
        }
    </script>
</body>
</html>
