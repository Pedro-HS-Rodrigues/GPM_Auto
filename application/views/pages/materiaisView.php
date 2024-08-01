<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPM Auto</title>

    <link rel="icon" href="assets/img/logo.svg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body id="materiais-body">
    <div class="container" id="materiais-table">
        <div class="table-container">
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
                    <!-- A tabela será preenchida pelo DataTables via AJAX -->
                </tbody>
            </table>
        </div>
        <button onclick="abrirModalCadastrar()" class="btn btn-primary" id="add-material"><i class="bi bi-plus-circle-fill me-2"></i>Adicionar novo material</button>
    </div>

    <script>
        $(document).ready(function() {
            if ($.fn.DataTable.isDataTable('#materiais')) {
                $('#materiais').DataTable().clear().destroy();
            }
            $('#materiais').DataTable({
                "ajax": {
                    "url": "<?php echo site_url('materiais/getMateriaisData'); ?>",
                    "type": "GET",
                    "dataSrc": ""
                },
                "columns": [
                    {"data": "nome_prod"},
                    {"data": "tipo"},
                    {"data": "qntd"},
                    {
                        "data": null,
                        "defaultContent": "<button class='btn btn-success' onclick='abrirModalEntrada(this)'>Entrada</button> <button class='btn btn-danger' onclick='abrirModalSaida(this)'>Saída</button>"
                    }
                ],
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
                }
            });
        });

        function abrirModalEntrada(button) {
            const row = $(button).closest('tr');
            const data = $('#materiais').DataTable().row(row).data();
            document.getElementById('entrada-id').value = data.id;
            new bootstrap.Modal(document.getElementById('modalEntrada')).show();
        }

        function abrirModalSaida(button) {
            const row = $(button).closest('tr');
            const data = $('#materiais').DataTable().row(row).data();
            document.getElementById('saida-id').value = data.id;
            new bootstrap.Modal(document.getElementById('modalSaida')).show();
        }

        function abrirModalCadastrar() {
            new bootstrap.Modal(document.getElementById('modalCadastrar')).show();
        }

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
