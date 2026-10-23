<section class="topo"> 

  <div class="marquee">

    <div class="marquee-track">

      <div class="marquee-group">

        <span>FRETE GRÁTIS ACIMA DE R$200,00</span>

        <span>•</span>

        <span>CUPOM PRIMEIRA COMPRA</span>

        <span>•</span>

        <span>CUPOM #DECKLY PARA 10% DE DESCONTO</span>

        <span>•</span>

        <span>PARCELE EM ATÉ 12X SEM JUROS</span>

        <span>•</span>

      </div>

      <div class="marquee-group">

        <span>FRETE GRÁTIS ACIMA DE R$200,00</span>

        <span>•</span>

        <span>CUPOM PRIMEIRA COMPRA</span>

        <span>•</span>

        <span>CUPOM #DECKLY PARA 10% DE DESCONTO</span>

        <span>•</span>

        <span>PARCELE EM ATÉ 12X SEM JUROS</span>

        <span>•</span>

      </div>

      <div class="marquee-group">

        <span>FRETE GRÁTIS ACIMA DE R$200,00</span>

        <span>•</span>

        <span>CUPOM PRIMEIRA COMPRA</span>

        <span>•</span>

        <span>CUPOM #DECKLY PARA 10% DE DESCONTO</span>

        <span>•</span>

        <span>PARCELE EM ATÉ 12X SEM JUROS</span>

        <span>•</span>

      </div>

      <div class="marquee-group">

        <span>FRETE GRÁTIS ACIMA DE R$200,00</span>

        <span>•</span>

        <span>CUPOM PRIMEIRA COMPRA</span>

        <span>•</span>

        <span>CUPOM #DECKLY PARA 10% DE DESCONTO</span>

        <span>•</span>

        <span>PARCELE EM ATÉ 12X SEM JUROS</span>

        <span>•</span>

      </div>

    </div>

  </div>

</section>

<header>

  <section id="topo">

    <div class="navegacao">

      <nav class="navbar navbar-expand-lg navbar-light">

        <!-- MENU HAMBURGER -->

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNav"

          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">

          <span class="navbar-toggler-icon"></span>

        </button>

      </nav>

      <!-- NAVEGAÇÃO MOBILE -->

      <div class="menu-hamburger">

        <div class="offcanvas offcanvas-start p-3" aria-labelledby="offcanvasNavbarLabel" id="navbarNav">

          <div class="offcanvasheader d-flex justify-content-between">

            <h5 class="offcanvas-title" id="offcanvasNavBarLabel">Menu</h5>

            <button class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>

          </div>

          <div class="offcanvas-body">

            <ul class="navbar-nav">

              <li class="nav-item">

                <a href="#" class="nav-link text-uppercase">Sobre NÓS</a>

              </li>

              <li class="nav-item">

                <a href="produtos.php" class="nav-link text-uppercase">Produtos</a>

              </li>

              <li class="nav-item">

                <a href="produtos.php?promocao=1" class="nav-link text-uppercase">Promoções</a>

              </li>

              <li class="nav-item">

                <a href="index.php#destaques" class="nav-link text-uppercase">Destaques</a>

              </li>

              <li class="nav-item">

                <a href="#rodape" class="nav-link text-uppercase">Contato</a>

              </li>

            </ul>

            <div class="login2">

              <a href="#"><i class="bi bi-person-fill"></i></a>

            </div>

          </div>

        </div>

      </div>

      <!-- LOGO -->

      <div class="logo">

        <a href="index.php"><img src="assets/img/LOGO.png" alt="Deckly" class="img-fluid text-center"></a>

      </div>

      <!-- ÍCONES -->

      <div class="acoes d-flex align-items-center justify-content-end gap-3">

        <!-- Ícone de Pesquisa -->

        <div class="pesquisa-icone">

          <a href="produtos.php?foco=1" title="Pesquisar produtos">

            <i class="bi bi-search"></i>

          </a>

        </div>

        <!-- Login -->

        <div class="login">

          <a href="#"><i class="bi bi-person-fill"></i></a>

        </div>

        <!-- Carrinho -->

        <div class="carrinho">

          <a href="#"><i class="bi bi-cart4"></i></a>

        </div>

      </div>

    </div>

    <!-- MENU DESKTOP -->

    <div class="menu-desktop">

      <ul>

        <li><a href="#">Sobre</a></li>

        <li><a href="produtos.php">Produtos</a></li>

        <li><a href="produtos.php?promocao=1">Promoções</a></li>

        <li><a href="index.php#destaques">Destaques</a></li>

        <li><a href="#rodape">Contato</a></li>

      </ul>

    </div>

  </section>

</header>

<script>
  // No menu mobile: fecha o menu e depois rola até o rodapé
  document.addEventListener('DOMContentLoaded', function () {
    var menu = document.getElementById('navbarNav');
    var link = menu.querySelector('a[href="#rodape"]');

    link.addEventListener('click', function (e) {
      e.preventDefault();
      menu.addEventListener('hidden.bs.offcanvas', function () {
        document.getElementById('rodape').scrollIntoView({ behavior: 'smooth' });
      }, { once: true });
      bootstrap.Offcanvas.getOrCreateInstance(menu).hide();
    });
  });
</script>
