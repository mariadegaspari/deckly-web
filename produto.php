<?php
require_once __DIR__ . "/conexao/conecta.php";
require_once __DIR__ . "/conexao/funcoes.php";

$codigo = filter_input(INPUT_GET, 'codigo_produto', FILTER_VALIDATE_INT);

if ($codigo) {
    $sql = "SELECT
            produto.codigo_produto,
            produto.codigo_categoria,
            produto.nome_produto,
            produto.descricao_produto,
            produto.raridade_produto,
            produto.quantidade_estoque,
            produto.foto_produto1,
            produto.preco_venda,
            produto.status_promocao,
            produto.desconto_promocao,
            produto.preco_promocao,
            categoria.nome_categoria,
            marca.nome_marca
            FROM produto
            JOIN categoria ON produto.codigo_categoria = categoria.codigo_categoria
            JOIN marca ON produto.codigo_marca = marca.codigo_marca
            WHERE produto.codigo_produto = $codigo
            AND produto.status_produto = 1
            LIMIT 1";
} else {
    $sql = "SELECT
            produto.codigo_produto,
            produto.codigo_categoria,
            produto.nome_produto,
            produto.descricao_produto,
            produto.raridade_produto,
            produto.quantidade_estoque,
            produto.foto_produto1,
            produto.preco_venda,
            produto.status_promocao,
            produto.desconto_promocao,
            produto.preco_promocao,
            categoria.nome_categoria,
            marca.nome_marca
            FROM produto
            JOIN categoria ON produto.codigo_categoria = categoria.codigo_categoria
            JOIN marca ON produto.codigo_marca = marca.codigo_marca
            WHERE produto.status_produto = 1
            ORDER BY produto.data_cadastro DESC
            LIMIT 1";
}

$query = mysqli_query($conexao, $sql);
$produto = $query ? mysqli_fetch_assoc($query) : null;

if (!$produto) {
    header("Location: produtos.php");
    exit;
}

$em_promocao = $produto['status_promocao'] == 1 && (float)$produto['preco_promocao'] > 0;
$preco = $em_promocao ? (float)$produto['preco_promocao'] : (float)$produto['preco_venda'];
$preco_original = (float)$produto['preco_venda'];
$estoque = (int)$produto['quantidade_estoque'];

$desconto = $em_promocao ? produto_desconto_percentual($produto) : 0;
$economia = $em_promocao ? $preco_original - $preco : 0;

$relacionados = [];
$sql_rel = "SELECT produto.codigo_produto, produto.nome_produto, produto.foto_produto1, produto.preco_venda,
            produto.status_promocao, produto.preco_promocao, produto.quantidade_estoque, produto.raridade_produto,
            marca.nome_marca
            FROM produto
            JOIN marca ON produto.codigo_marca = marca.codigo_marca
            WHERE produto.status_produto = 1
            AND produto.quantidade_estoque > 0
            AND produto.codigo_categoria = " . (int)$produto['codigo_categoria'] . "
            AND produto.codigo_produto <> " . (int)$produto['codigo_produto'] . "
            ORDER BY RAND()
            LIMIT 4";
$query_rel = mysqli_query($conexao, $sql_rel);
if ($query_rel) {
    $relacionados = mysqli_fetch_all($query_rel, MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($produto['nome_produto']) ?> | DECKLY</title>
  <meta name="author" content="Maria Fernanda">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Judson:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="custom/css/style.css">
</head>

<body>

  <?php include('Topo.php'); ?>

  <section class="detalhe">
    <div class="container">

      <nav class="breadcrumb-deckly" aria-label="Navegação">
        <a href="index.php">Início</a>
        <i class="bi bi-chevron-right"></i>
        <a href="produtos.php">Produtos</a>
        <i class="bi bi-chevron-right"></i>
        <a href="produtos.php?categoria=<?= (int)$produto['codigo_categoria'] ?>"><?= htmlspecialchars($produto['nome_categoria']) ?></a>
        <i class="bi bi-chevron-right"></i>
        <span><?= htmlspecialchars($produto['nome_produto']) ?></span>
      </nav>

      <div class="detalhe-grid">

        <div class="detalhe-foto">
          <?php if ($em_promocao): ?>
            <span class="product-badge promo">-<?= $desconto ?>%</span>
          <?php endif; ?>
          <img src="<?= foto_produto_url($produto['foto_produto1']) ?>" alt="<?= htmlspecialchars($produto['nome_produto']) ?>" onerror="<?= FOTO_ONERROR ?>">
        </div>

        <div class="detalhe-info">

          <div class="detalhe-tags">
            <span class="tag tag-destaque"><?= htmlspecialchars($produto['nome_categoria']) ?></span>
            <span class="tag"><?= htmlspecialchars($produto['raridade_produto']) ?></span>
            <?php if ($em_promocao): ?><span class="tag tag-promo">Promoção</span><?php endif; ?>
          </div>

          <h1><?= htmlspecialchars($produto['nome_produto']) ?></h1>
          <p class="detalhe-marca">Marca: <strong><?= htmlspecialchars($produto['nome_marca']) ?></strong></p>

          <div class="detalhe-preco">
            <?php if ($em_promocao): ?>
              <span class="preco-antigo"><?= preco_br($preco_original) ?></span>
            <?php endif; ?>
            <p class="preco-produto"><?= preco_br($preco) ?></p>
            <?php if ($em_promocao): ?>
              <span class="economia">Você economiza <?= preco_br($economia) ?></span>
            <?php endif; ?>
            <span class="parcelas">em até 12x sem juros</span>
          </div>

          <div class="pagamentos">
            <i class="bi bi-credit-card-2-front" title="Cartão de crédito"></i>
            <i class="bi bi-cash" title="Dinheiro"></i>
            <i class="bi bi-upc" title="Pix"></i>
          </div>

          <ul class="detalhe-specs">
            <li><span>Raridade</span><strong><?= htmlspecialchars($produto['raridade_produto']) ?></strong></li>
            <li><span>Marca</span><strong><?= htmlspecialchars($produto['nome_marca']) ?></strong></li>
            <li><span>Categoria</span><strong><?= htmlspecialchars($produto['nome_categoria']) ?></strong></li>
            <li>
              <span>Disponibilidade</span>
              <?php if ($estoque > 3): ?>
                <strong class="estoque-ok"><i class="bi bi-check-circle-fill"></i> Em estoque (<?= $estoque ?>)</strong>
              <?php elseif ($estoque > 0): ?>
                <strong class="estoque-baixo"><i class="bi bi-exclamation-circle-fill"></i> Últimas <?= $estoque ?> unidade(s)</strong>
              <?php else: ?>
                <strong class="estoque-zero"><i class="bi bi-x-circle-fill"></i> Esgotado</strong>
              <?php endif; ?>
            </li>
          </ul>

          <div class="acoes-produto">
            <?php if ($estoque > 0): ?>

              <div class="controle">
                <button type="button" aria-label="Diminuir quantidade">-</button>
                <span class="quantidade">1</span>
                <button type="button" aria-label="Aumentar quantidade">+</button>
              </div>

              <a href="#" class="btn-comprar">Comprar agora</a>

              <a href="#" class="car" aria-label="Adicionar ao carrinho">
                <i class="bi bi-cart4"></i>
              </a>

            <?php else: ?>

              <span class="produto-esgotado">Produto esgotado</span>

            <?php endif; ?>
          </div>

        </div>
      </div>

      <div class="produto-descricao-wrap">
        <h3>Descrição</h3>
        <?php if (trim($produto['descricao_produto']) !== ''): ?>
          <p class="descricao"><?= nl2br(htmlspecialchars($produto['descricao_produto'])) ?></p>
        <?php else: ?>
          <p class="descricao">Este produto ainda não possui descrição.</p>
        <?php endif; ?>
      </div>

      <?php if (count($relacionados) > 0): ?>
        <div class="relacionados">
          <div class="grupo-titulo">
            <h3>Você também pode gostar</h3>
          </div>
          <div class="row g-3 g-lg-4">
            <?php foreach ($relacionados as $rel): ?>
              <div class="col-12 col-md-3">
                <?= card_produto($rel) ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>

    </div>
  </section>

  <?php include("Rodape.php");?>

  <?php mysqli_close($conexao); ?>

  <script>
    const controle = document.querySelector('.acoes-produto .controle');

    if (controle) {
      const botoes = controle.querySelectorAll('button');
      const quantidade = controle.querySelector('.quantidade');
      const estoque = <?= $estoque ?>;

      botoes[0].addEventListener('click', () => {
        let valor = parseInt(quantidade.textContent);
        if (valor > 1) {
          quantidade.textContent = valor - 1;
        }
      });

      botoes[1].addEventListener('click', () => {
        let valor = parseInt(quantidade.textContent);
        if (valor < estoque) {
          quantidade.textContent = valor + 1;
        }
      });
    }
  </script>

</body>

</html>
