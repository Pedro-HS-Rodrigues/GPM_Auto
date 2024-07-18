$(document).ready(function () {
    function verificarCheckboxes() {
        if ($('.form-check-input:checked').length > 0) {
            $('#relatorio-selecionado').prop('disabled', false);
        } else {
            $('#relatorio-selecionado').prop('disabled', true);
        }
    }

    // Verifique os checkboxes quando a página carregar
    verificarCheckboxes();

    // Adicione um event listener para todos os checkboxes
    $('.form-check-input').on('change', function () {
        verificarCheckboxes();
    });
});

// Função para abrir a modal com todos os dados
function abrirModalCompleto() {
    var modalBody = $('#modalCompleto .modal-body');
    modalBody.empty(); // Limpa o conteúdo anterior da modal

    // Itera sobre todas as linhas da tabela
    $('#materiais tbody tr').each(function () {
        var cliente = $(this).find('td:eq(0)').text();
        var mecanico = $(this).find('td:eq(1)').text();
        var data = $(this).find('td:eq(2)').text();
        var servico = $(this).find('td:eq(3)').text();
        var produto = $(this).find('td:eq(4)').text();
        var quantidade = $(this).find('td:eq(5)').text();

        // Adiciona os dados na modal
        modalBody.append(
            '<p><strong>Cliente:</strong> ' + cliente + '</p>' +
            '<p><strong>Mecânico:</strong> ' + mecanico + '</p>' +
            '<p><strong>Data:</strong> ' + data + '</p>' +
            '<p><strong>Serviço:</strong> ' + servico + '</p>' +
            '<p><strong>Produto:</strong> ' + produto + '</p>' +
            '<p><strong>Quantidade:</strong> ' + quantidade + '</p>' +
            '<hr>'
        );
    });

    // Mostra a modal de relatório completo
    new bootstrap.Modal(document.getElementById('modalCompleto')).show();
}

function abrirVendaCompleta() {
    var modalBody = $('#modalCompleto .modal-body');
    modalBody.empty(); // Limpa o conteúdo anterior da modal

    // Itera sobre todas as linhas da tabela
    $('#materiais tbody tr').each(function () {
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
    });

    // Mostra a modal de relatório completo
    new bootstrap.Modal(document.getElementById('modalCompleto')).show();
}
