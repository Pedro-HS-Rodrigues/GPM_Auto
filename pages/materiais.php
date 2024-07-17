<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPM Auto</title>

    <link rel="icon" href="../assets/img/logo.svg" type="image/x-icon">

    <!-- Adicionando o BootStrap 5 -->
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
    <?php $currentPage = basename($_SERVER['PHP_SELF'], ".php") ?>
    <?php include_once '../includes/navbar.php'; ?>
    <?php include_once '../includes/modalEditar.php'; ?>
    <?php include_once '../includes/modalSaida.php'; ?>
    <?php include_once '../includes/modalCadastrar.php'; ?>

    <div class="container" id="materiais-table">
        <div class=" ">
            <div class="table-container">
                <table id="materiais" class="table table-striped">
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
                        // Exemplo de dados simulados do banco de dados
                        $dadosDoBanco = array(
                            array("Nome" => "Tiger Nixon", "Tipo" => "System Architect", "Quantidade" => "Edinburgh"),
                            // Adicionar mais linhas conforme necessário
                        );

                        foreach ($dadosDoBanco as $row) {
                            echo "<tr>";
                            echo "<td>" . $row['Nome'] . "</td>";
                            echo "<td>" . $row['Tipo'] . "</td>";
                            echo "<td>" . $row['Quantidade'] . "</td>";
                            echo "<td>";
                            // Botão para abrir a modal de edição
                            echo "<button type='button' class='btn btn-primary' onclick='abrirModalEditar()'>Editar</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th>Quantidade</th>
                            <th>Ação</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <button onclick="abrirModalCadastrar()" class="btn btn-primary" id="add-material">Adicionar novo material</button>
    </div>



    <script src="../assets/js/datatables.js"></script>
    <script>
    
    function abrirModalEditar(){
    new bootstrap.Modal(document.getElementById('modalEditar')).show();
    }

    function abrirModalSaida(){
    new bootstrap.Modal(document.getElementById('modalSaida')).show();
    }

    function abrirModalEntrada(){
    new bootstrap.Modal(document.getElementById('modalEntrada')).show();
    }

    function abrirModalCadastrar(){
    new bootstrap.Modal(document.getElementById('modalCadastrar')).show();
    }

    document.getElementById('modalSaida').addEventListener('hidden.bs.modal', function () {
        document.getElementById('saida-quantidade').value = '';
    });

    </script>
</body>

</html>