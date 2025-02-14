<?php error_reporting(0) ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPM Auto</title>
    <link rel="shortcut icon" href="<?= base_url()?>assets/img/favicon.ico" type="image/x-icon">

    <!-- Adicionando o Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Adicionando os ícones do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Adicionando a fonte do projeto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Adicionando a folha de estilo do projeto -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Adicionando os ícones do projeto -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMc6gYen6f3u3GpXQqIzRfl1w1vQJtVj7w2bM2X" crossorigin="anonymous">

    <!-- Adicionando jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Ajuste para centralizar o conteúdo */
        .container {
            max-width: 600px;
            margin-top: 100px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div id="message" class="alert" style="display:none;"></div>
                <form id="cadastro" class="bg-light p-4 rounded">
                    <p id="cadastro-title"><strong>Cadastro</strong></p>
                    <p id="cadastro-description">Insira os dados do novo Usuário</p>
                    <div class="mb-3">
                        <label for="form-nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="form-nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="form-cargo" class="form-label">Cargo</label>
                        <input type="text" class="form-control" id="form-cargo" name="cargo" required>
                    </div>
                    <div class="mb-3">
                        <label for="form-nivel" class="form-label">Nível</label>
                        <select class="form-select" aria-label="Escolha o nível de usuário" id="form-nivel" name="nivel" required>
                            <option value="" selected>Escolha o nível de usuário</option>
                            <option value="1">Admin</option>
                            <option value="2">Almoxarife</option>
                            <option value="3">Mecânico</option>
                            <option value="4">Vendedor</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="form-user" class="form-label">User</label>
                        <input type="text" class="form-control" id="form-username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="form-password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="form-senha" name="senha" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="login-submit"><strong>CADASTRAR</strong></button>
                </form>
            </div>
        </div>
    </div>

    <!-- Script para envio AJAX e exibição de mensagens -->
    <script>
        $(document).ready(function(){
            $('#cadastro').on('submit', function(e){
                e.preventDefault(); // Impede o comportamento padrão de envio do formulário

                $.ajax({
                    type: 'POST',   
                    url: '<?= base_url() ?>cadastro/store',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        $('#message').show().removeClass('alert-success alert-danger').addClass(response.status == 'success' ? 'alert-success' : 'alert-danger').text(response.message);
                        if(response.status == 'success'){
                            $('#cadastro')[0].reset(); // Limpa o formulário após sucesso
                        }
                    },
                    error: function() {
                        $('#message').show().removeClass('alert-success').addClass('alert-danger').text('Ocorreu um erro ao processar a requisição.');
                    }
                });
            });
        });
    </script>
</body>

</html>
