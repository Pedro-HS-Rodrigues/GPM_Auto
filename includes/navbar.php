<div class="container" id="nav-container">
    <nav class="navbar navbar-expand-lg fixed-top w-100">
        <a href="../pages/dashboard.php" class="navbar-brand">
            <img id="logo" src="../assets/img/logo.svg" alt="GPM Auto"><span class="brand-text">GPM AUTO</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-links" aria-controls="#navbar-links" aria-expanded="false" aria-label="Toggle-navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php if ($currentPage != 'login'):?>
        <div class="collapse navbar-collapse justify-content-end" id="navbar-links">
            <div class="navbar-nav">
                <a class="navi-tem nav-link" id="inicio-menu" href="../pages/dashboard.php">Início</a>
                <a class="navi-tem nav-link" id="add-menu" href="../pages/cadastro.php">Adicionar usuário</a>
                <a class="navi-tem nav-link" id="materials-menu" href="../pages/materiais.php">Gerenciar materiais</a>
                <a class="navi-tem nav-link" id="sell-menu" href="../pages/vendas.php">Adicionar Venda</a>
                <a class="navi-tem nav-link" id="service-menu" href="../pages/servico.php">Adicionar serviço</a>
                <button type="button" class="btn btn-primary" id="sair">
                    <img src="../assets/img/icon.svg" alt="out">Sair 
                </button>
            </div>
        </div>
        <?php endif; ?>
    </nav>
</div>