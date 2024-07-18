<?php
session_start();
include_once '../connection/connectLogin.php';
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPM Auto</title>
    <style>
    </style>
    <link rel="icon" href="../assets/img/logo.svg" type="image/x-icon">

    <!--Adicionando o BootStrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <!--Adicionando a fonte do projeto-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">


    <!--Adicionando a folha de estilo do projeto-->
    <link rel="stylesheet" href="../assets/css/style.css">


    <!--Adicionando os icones do projeto-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMc6gYen6f3u3GpXQqIzRfl1w1vQJtVj7w2bM2X" crossorigin="anonymous">



</head>

<body>
    <?php $currentPage = basename($_SERVER['PHP_SELF'], ".php") ?>
    <?php include_once '../includes/navbar.php'; ?>

    <div id="login-form">
        <div id="logo-form">
            <img src="../assets/img/logo.svg" alt="logo" id="form-icon">
            <p id="login-title"><strong>Login</strong></p>
            <p id="login-description">Insira seus dados para ter acesso à plataforma</p>
        </div>
        <form action="../connection/connectLogin.php" method="post">
            <div class="mb-3">
                <label for="form-user" class="form-label">Usuário</label>
                <input type="text" class="form-control" id="form-user" name="username" required>
            </div>
            <div class="mb-3">
                <label for="form-password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="form-password" name="password" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="showPassword">
                <label class="form-check-label" for="showPassword">Mostrar senha</label>
            </div>
            <button type="submit" class="btn btn-primary" id="login-submit">LOGIN</button>
            <?php if (isset($_SESSION['login_error'])) : ?>
                <div class="alert alert-danger rounded mt-3" role="alert">
                    <?php echo $_SESSION['login_error']; ?>
                </div>
                <?php unset($_SESSION['login_error']); ?>
            <?php endif; ?>
        </form>


    </div>
    <script src="../assets/js/password.js"></script>
</body>

</html>