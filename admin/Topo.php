<?php

$url_parcial = $_SERVER['REQUEST_URI'];

$caminho = explode("/", $url_parcial);

$url = "http://" . $_SERVER['HTTP_HOST'] . "/" . $caminho[1] . "/" . $caminho[2] . "/" . $caminho[3];

?>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">

    <a class="navbar-brand col-md-3 col-lg-2 px-3" href="<?= $url ?>/Admin.php">
        <img src="<?= $url ?>/../assets/img/LOGO.png" alt="Deckly">
        <span>DECKLY</span>
    </a>

    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="<?= $url ?>/LogOff.php">Sair</a>
        </div>
    </div>

</header>   