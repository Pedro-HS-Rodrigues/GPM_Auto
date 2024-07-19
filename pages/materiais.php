<?php
// Inicia a sessão para acessar variáveis de sessão
session_start();

// Inclui o arquivo de conexão ao banco de dados para materiais
include_once '../connection/connectMateriais.php';

// Verifica se o usuário tem nível de acesso adequado
if (!isset($_SESSION['user_level']) || $_SESSION['user_level'] > 2) {
    // Exibe mensagem de acesso não autorizado e redireciona para o dashboard
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

    <!-- Adicionando o Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <!-- Define a página atual para uso na barra de navegação -->
    <?php $currentPage = basename($_SERVER['PHP_SELF'], ".php") ?>
    <!-- Inclui a barra de navegação -->
    <?php include_once '../includes/navbar.php'; ?>
    <!-- Inclui modais -->
    <?php include_once '../includes/modalSaida.php'; ?>
    <?php include_once '../includes/modalEntrada.php'; ?>
    <?php include_once '../includes/modalCadastrar.php'; ?>

    <div class="container" id="materiais-table">
        <div class=" ">
            <div class="table-container">
                <!-- Tabela de materiais -->
                <table id="materiais" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th>Quantidade</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Itera sobre os dados do banco e exibe na tabela
                        foreach ($dadosDoBanco as $row) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['nome_prod']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['tipo']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['qntd']) . "</td>";
                            echo "<td>";
                            // Botões para entrada e saída de materiais
                            echo "<button type='button' class='btn btn-primary btn btn-success' data-id='" . htmlspecialchars($row['id']) . "' onclick='abrirModalEntrada(this)'>Entrada</button> ";
                            echo "<button type='button' class='btn btn-primary btn btn-danger' data-id='" . htmlspecialchars($row['id']) . "' onclick='abrirModalSaida(this)'>Saída</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Botão para adicionar novo material -->
        <button onclick="abrirModalCadastrar()" class="btn btn-primary" id="add-material">Adicionar novo material</button>
        <?php
        // Exibe mensagem de sucesso ou erro, se houver
        if (isset($_SESSION['message'])) {
            $messageType = $_SESSION['message_type'] ?? 'info';
            echo "<div class='alert alert-$messageType rounded mt-3' role='alert'>";
            echo $_SESSION['message'];
            echo "</div>";
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        }
        ?>
    </div>

    <!-- Scripts adicionais -->
    <script src="../assets/js/datatables.js"></script>
    <script>
        // Função para abrir modal de saída
        function abrirModalSaida(button) {
            const id = button.getAttribute('data-id');
            document.getElementById('saida-id').value = id;
            new bootstrap.Modal(document.getElementById('modalSaida')).show();
        }

        // Função para salvar saída de material
        function salvarSaida() {
            const id = document.getElementById('saida-id').value;
            const quantidade = document.getElementById('saida-quantidade').value;

            $.post('processarSaida.php', {
                id,
                quantidade
            }, function(response) {
                if (response.success) {
                    alert('Saída salva com sucesso!');
                    location.reload();
                } else {
                    alert('Erro ao salvar saída!');
                }
            }, 'json');
        }

        // Função para abrir modal de entrada
        function abrirModalEntrada(button) {
            const id = button.getAttribute('data-id');
            document.getElementById('entrada-id').value = id;
            new bootstrap.Modal(document.getElementById('modalEntrada')).show();
        }

        // Função para salvar entrada de material
        function salvarEntrada() {
            const id = document.getElementById('entrada-id').value;
            const quantidade = document.getElementById('entrada-quantidade').value;

            $.post('processarEntrada.php', {
                id,
                quantidade
            }, function(response) {
                if (response.success) {
                    alert('Entrada salva com sucesso!');
                    location.reload();
                } else {
                    alert('Erro ao salvar entrada!');
                }
            }, 'json');
        }

        // Função para abrir modal de cadastro de material
        function abrirModalCadastrar() {
            new bootstrap.Modal(document.getElementById('modalCadastrar')).show();
        }

        // Reseta o formulário de entrada quando o modal é fechado
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById('modalEntrada');
            modal.addEventListener('hidden.bs.modal', function(event) {
                var form = document.getElementById('formEntrada');
                form.reset();
            });
        });
    </script>
</body>

</html>
