<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprnP2hE62vv2dF8VqD9l2E7d0HBw9F4QJcO/A1HBQwJ2A3a3h9/ojJ7OQ1AeJ9e" crossorigin="anonymous"></script>

<div class="container" id="nav-container">
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
        <a href="<?= base_url() ?>dashboard" class="navbar-brand">
            <img id="logo" src="assets/img/logo.svg" alt="GPM Auto"><span class="brand-text">GPM AUTO</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-links" aria-controls="navbar-links" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php if ($currentPage != 'loginView') : ?>
            <?php
            // Obtém o nível do usuário da sessão
            $user_nivel = $this->session->userdata('user_nivel');
            ?>
            <div class="collapse navbar-collapse justify-content-end" id="navbar-links">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" id="inicio-menu" href="<?= base_url() ?>dashboard">Início</a>
                    
                    <?php if ($user_nivel == 1) : ?>
                        <a class="nav-item nav-link" id="add-menu" href="<?= base_url() ?>cadastro">Adicionar usuário</a>
                        <a class="nav-item nav-link" id="materials-menu" href="<?= base_url() ?>materiais">Gerenciar materiais</a>
                        <a class="nav-item nav-link" id="sell-menu" href="<?= base_url() ?>vendas">Adicionar Venda</a>
                        <a class="nav-item nav-link" id="service-menu" href="<?= base_url() ?>servico">Adicionar serviço</a>
                    <?php elseif ($user_nivel == 2) : ?>
                        <a class="nav-item nav-link" id="materials-menu" href="<?= base_url() ?>materiais">Gerenciar materiais</a>
                    <?php elseif ($user_nivel == 3) : ?>
                        <a class="nav-item nav-link" id="service-menu" href="<?= base_url() ?>servico">Adicionar serviço</a>
                    <?php elseif ($user_nivel == 4) : ?>
                        <a class="nav-item nav-link" id="sell-menu" href="<?= base_url() ?>vendas">Adicionar Venda</a>
                    <?php endif; ?>
                    
                    <a class="nav-item nav-link" id="sair" href="<?= base_url('logout') ?>">
                        <img src="assets/img/icon.svg" alt="out">   Sair
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </nav>
</div>
