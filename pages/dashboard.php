<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPM Auto</title>
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

<body id="dashboard-body">
    <div>
        <?php $currentPage = basename($_SERVER['PHP_SELF'], ".php")?>
        <?php include_once '../includes/navbar.php'; ?>
        <img src="../assets/img/dashboard.jpg" alt="" class="img-cover" id="dashboard-image">
        <?php include_once '../includes/footer.php'; ?>
    </div>
</body>

</html>