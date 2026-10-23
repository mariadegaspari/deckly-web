<?php
require_once __DIR__ . "/conexao/conecta.php";
require_once __DIR__ . "/conexao/funcoes.php";

function valorProduto($produto)
{
    if ($produto['status_promocao'] == 1 && (float)$produto['preco_promocao'] > 0) {
        return (float)$produto['preco_promocao'];
    }

    return (float)$produto['preco_venda'];
}

$sql_destaques = "SELECT produto.codigo_produto, produto.nome_produto, produto.foto_produto1, produto.preco_venda, produto.status_promocao, produto.preco_promocao
                  FROM produto
                  JOIN categoria ON produto.codigo_categoria = categoria.codigo_categoria
                  JOIN marca ON produto.codigo_marca = marca.codigo_marca
                  WHERE produto.status_produto = 1
                  AND produto.quantidade_estoque > 0
                  ORDER BY produto.data_cadastro DESC
                  LIMIT 6";

$query_destaques = mysqli_query($conexao, $sql_destaques);

// 1ª sessão de cards: mais vendidos (soma da quantidade vendida na tabela de itens da venda).
// Produtos ainda sem vendas aparecem depois dos que já venderam.
// Descobre o nome da tabela de itens procurando a coluna codigo_itensvenda.
$tabela_itens = 'itensvenda';
try {
    $res_tabela = mysqli_query($conexao, "SELECT TABLE_NAME FROM information_schema.COLUMNS
                                          WHERE TABLE_SCHEMA = DATABASE() AND COLUMN_NAME = 'codigo_itensvenda' LIMIT 1");
    if ($res_tabela && $linha_tabela = mysqli_fetch_assoc($res_tabela)) {
        $tabela_itens = $linha_tabela['TABLE_NAME'];
    }
} catch (Exception $e) {
}

$sql_mais_vendidos = "SELECT produto.codigo_produto, produto.nome_produto, produto.foto_produto1, produto.preco_venda, produto.status_promocao, produto.preco_promocao,
                  IFNULL(vendas.total_vendido, 0) AS total_vendido
                  FROM produto
                  JOIN categoria ON produto.codigo_categoria = categoria.codigo_categoria
                  JOIN marca ON produto.codigo_marca = marca.codigo_marca
                  LEFT JOIN (SELECT codigo_produto, SUM(IFNULL(quantidade_itens, 1)) AS total_vendido
                             FROM `$tabela_itens`
                             GROUP BY codigo_produto) AS vendas ON vendas.codigo_produto = produto.codigo_produto
                  WHERE produto.status_produto = 1
                  AND produto.quantidade_estoque > 0
                  ORDER BY total_vendido DESC, produto.data_cadastro DESC
                  LIMIT 6";

$mais_vendidos = [];
try {
    $query_mais_vendidos = mysqli_query($conexao, $sql_mais_vendidos);
    if ($query_mais_vendidos) {
        $mais_vendidos = mysqli_fetch_all($query_mais_vendidos, MYSQLI_ASSOC);
    }
} catch (Exception $e) {
}

// 2ª sessão de cards: produtos gerais (vendidos ou não)
$sql_gerais = "SELECT produto.codigo_produto, produto.nome_produto, produto.foto_produto1, produto.preco_venda, produto.status_promocao, produto.preco_promocao
                  FROM produto
                  JOIN categoria ON produto.codigo_categoria = categoria.codigo_categoria
                  JOIN marca ON produto.codigo_marca = marca.codigo_marca
                  WHERE produto.status_produto = 1
                  AND produto.quantidade_estoque > 0
                  ORDER BY produto.data_cadastro DESC
                  LIMIT 6";

$query_gerais = mysqli_query($conexao, $sql_gerais);

// 3ª sessão de cards: somente cartas Mangá e Super rara
$sql_raras = "SELECT produto.codigo_produto, produto.nome_produto, produto.foto_produto1, produto.preco_venda, produto.status_promocao, produto.preco_promocao, produto.raridade_produto
                  FROM produto
                  JOIN categoria ON produto.codigo_categoria = categoria.codigo_categoria
                  JOIN marca ON produto.codigo_marca = marca.codigo_marca
                  WHERE produto.status_produto = 1
                  AND produto.quantidade_estoque > 0
                  AND produto.raridade_produto IN ('Mangá', 'Super rara', 'Super-rara')
                  ORDER BY produto.data_cadastro DESC
                  LIMIT 6";

$query_raras = mysqli_query($conexao, $sql_raras);

$destaques = $query_destaques ? mysqli_fetch_all($query_destaques, MYSQLI_ASSOC) : [];
// se não houver como ordenar por vendas, mantém os produtos mais recentes
if (count($mais_vendidos) === 0) {
    $mais_vendidos = $destaques;
}
$gerais = $query_gerais ? mysqli_fetch_all($query_gerais, MYSQLI_ASSOC) : [];
$raras = $query_raras ? mysqli_fetch_all($query_raras, MYSQLI_ASSOC) : [];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DECKLY</title>
  <meta name="author" content="Maria Fernanda De Gaspari dos Santos">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="custom/css/style.css">
</head>

<body>

  <?php include('Topo.php'); ?>

  <section class="vitrine" id="vitrine">

    <div id="vitrineCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

      <div class="carousel-indicators">
        <?php if (count($destaques) > 0): ?>
          <?php foreach ($destaques as $i => $produto): ?>
            <button type="button" data-bs-target="#vitrineCarousel" data-bs-slide-to="<?= $i ?>" class="<?= $i === 0 ? 'active' : '' ?>"></button>
          <?php endforeach; ?>
        <?php else: ?>
          <button type="button" data-bs-target="#vitrineCarousel" data-bs-slide-to="0" class="active"></button>
        <?php endif; ?>
      </div>

      <div class="carousel-inner">

        <?php if (count($destaques) > 0): ?>

          <?php foreach ($destaques as $i => $produto): ?>
            <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
              <div class="vitrine-slide <?= $i > 0 ? 'vitrine-dark' : '' ?>">
                <?php if ($i > 0): ?><div class="vitrine-pattern pattern-<?= (($i - 1) % 5) + 1 ?>"></div><?php endif; ?>

                <div class="container vitrine-content">
                  <div class="vitrine-copy">
                    <span class="vitrine-tag">DECKLY • DESTAQUE</span>
                    <h<?= $i === 0 ? '1' : '2' ?>><?= htmlspecialchars($produto['nome_produto']) ?></h<?= $i === 0 ? '1' : '2' ?>>
                    <p>Confira esta carta disponível na vitrine da Deckly.</p>
                    <a href="produto.php?codigo_produto=<?= $produto['codigo_produto'] ?>" class="btn-vitrine">Ver produto</a>
                  </div>

                  <img class="vitrine-product" src="<?= foto_produto_url($produto['foto_produto1']) ?>" alt="<?= htmlspecialchars($produto['nome_produto']) ?>" onerror="<?= FOTO_ONERROR ?>">
                </div>
              </div>
            </div>
          <?php endforeach; ?>

        <?php else: ?>

          <div class="carousel-item active">
            <div class="vitrine-slide">
              <div class="container vitrine-content">
                <div class="vitrine-copy">
                  <span class="vitrine-tag">DECKLY</span>
                  <h1>Nenhum produto disponível</h1>
                  <p>Cadastre produtos ativos no painel administrativo para eles aparecerem aqui.</p>
                  <a href="produtos.php" class="btn-vitrine">Ver produtos</a>
                </div>
              </div>
            </div>
          </div>

        <?php endif; ?>

      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#vitrineCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>

      <button class="carousel-control-next" type="button" data-bs-target="#vitrineCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>

    </div>

  </section>

  <section class="cards-section" id="destaques">

    <div class="container">

      <div class="section-title">
        <div>
          <span>DECKLY</span>
          <h3>Mais vendidos</h3>
        </div>

        <a href="produtos.php">Ver todos</a>
      </div>

      <div class="cards-carousel">

        <button class="cards-arrow cards-prev" type="button" aria-label="Anterior">
          <i class="bi bi-chevron-left"></i>
        </button>

        <div class="cards-row">

          <?php foreach ($mais_vendidos as $produto): ?>
            <?php $preco = valorProduto($produto); ?>

            <article class="product-card">

              <a href="produto.php?codigo_produto=<?= $produto['codigo_produto'] ?>" class="product-image">
                <img src="<?= foto_produto_url($produto['foto_produto1']) ?>" alt="<?= htmlspecialchars($produto['nome_produto']) ?>" onerror="<?= FOTO_ONERROR ?>">

                <span class="product-badge">Mais vendidos</span>
              </a>

              <div class="product-info">

                <h4><?= htmlspecialchars($produto['nome_produto']) ?></h4>

                <div class="product-bottom">
                  <div class="product-price">
                    <?php if (produto_em_promocao($produto)): ?>
                      <s class="preco-antigo">R$ <?= number_format((float)$produto['preco_venda'], 2, ',', '.') ?></s>
                    <?php endif; ?>
                    <strong class="preco-atual">R$ <?= number_format($preco, 2, ',', '.') ?></strong>
                  </div>
                </div>

              </div>

            </article>

          <?php endforeach; ?>

        </div>

        <button class="cards-arrow cards-next" type="button" aria-label="Próximo">
          <i class="bi bi-chevron-right"></i>
        </button>

      </div>

    </div>

  </section>

  <section class="cards-section" id="promocoes">

    <div class="container">

      <div class="section-title">
        <div>
          <span>DECKLY</span>
          <h3>Produtos</h3>
        </div>

        <a href="produtos.php">Ver todos</a>
      </div>

      <div class="cards-carousel">

        <button class="cards-arrow cards-prev" type="button" aria-label="Anterior">
          <i class="bi bi-chevron-left"></i>
        </button>

        <div class="cards-row">

          <?php foreach ($gerais as $produto): ?>
            <?php $preco = valorProduto($produto); ?>

            <article class="product-card">

              <a href="produto.php?codigo_produto=<?= $produto['codigo_produto'] ?>" class="product-image">
                <img src="<?= foto_produto_url($produto['foto_produto1']) ?>" alt="<?= htmlspecialchars($produto['nome_produto']) ?>" onerror="<?= FOTO_ONERROR ?>">

                <?php if (produto_em_promocao($produto)): ?>
                  <span class="product-badge promo">Promoção</span>
                <?php endif; ?>
              </a>

              <div class="product-info">

                <h4><?= htmlspecialchars($produto['nome_produto']) ?></h4>

                <div class="product-bottom">

                  <div class="product-price">
                    <?php if (produto_em_promocao($produto)): ?>
                      <s class="preco-antigo">R$ <?= number_format((float)$produto['preco_venda'], 2, ',', '.') ?></s>
                    <?php endif; ?>
                    <strong class="preco-atual">R$ <?= number_format($preco, 2, ',', '.') ?></strong>
                  </div>

                </div>

              </div>

            </article>

          <?php endforeach; ?>

          <?php if (count($gerais) === 0): ?>
            <p class="sem-produtos">Nenhum produto disponível no momento.</p>
          <?php endif; ?>

        </div>

        <button class="cards-arrow cards-next" type="button" aria-label="Próximo">
          <i class="bi bi-chevron-right"></i>
        </button>

      </div>

    </div>

  </section>

  <section class="cards-section section-promocoes" id="raras">

    <div class="container">

      <div class="section-title">
        <div>
          <span>COLEÇÃO</span>
          <h3>Mangá e Super rara</h3>
        </div>

        <a href="produtos.php">Ver todos</a>
      </div>

      <div class="cards-carousel">

        <button class="cards-arrow cards-prev" type="button" aria-label="Anterior">
          <i class="bi bi-chevron-left"></i>
        </button>

        <div class="cards-row">

          <?php foreach ($raras as $produto): ?>
            <?php $preco = valorProduto($produto); ?>

            <article class="product-card">

              <a href="produto.php?codigo_produto=<?= $produto['codigo_produto'] ?>" class="product-image">
                <img src="<?= foto_produto_url($produto['foto_produto1']) ?>" alt="<?= htmlspecialchars($produto['nome_produto']) ?>" onerror="<?= FOTO_ONERROR ?>">

                <span class="product-badge"><?= htmlspecialchars($produto['raridade_produto']) ?></span>
              </a>

              <div class="product-info">

                <h4><?= htmlspecialchars($produto['nome_produto']) ?></h4>

                <div class="product-bottom">

                  <div class="product-price">
                    <?php if (produto_em_promocao($produto)): ?>
                      <s class="preco-antigo">R$ <?= number_format((float)$produto['preco_venda'], 2, ',', '.') ?></s>
                    <?php endif; ?>
                    <strong class="preco-atual">R$ <?= number_format($preco, 2, ',', '.') ?></strong>
                  </div>

                </div>

              </div>

            </article>

          <?php endforeach; ?>

          <?php if (count($raras) === 0): ?>
            <p class="sem-produtos">Nenhuma carta Mangá ou Super rara disponível no momento.</p>
          <?php endif; ?>

        </div>

        <button class="cards-arrow cards-next" type="button" aria-label="Próximo">
          <i class="bi bi-chevron-right"></i>
        </button>

      </div>

    </div>

  </section>

  <?php include("Rodape.php");?>

  <?php mysqli_close($conexao); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.querySelectorAll('.cards-carousel').forEach(carousel => {

      const cards = carousel.querySelector('.cards-row');
      const prev = carousel.querySelector('.cards-prev');
      const next = carousel.querySelector('.cards-next');

      next.addEventListener('click', () => {
        cards.scrollBy({
          left: cards.clientWidth + 12,
          behavior: 'smooth'
        });
      });

      prev.addEventListener('click', () => {
        cards.scrollBy({
          left: -(cards.clientWidth + 12),
          behavior: 'smooth'
        });
      });

    });
  </script>

</body>

</html>
