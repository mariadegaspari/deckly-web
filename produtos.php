<?php
require_once __DIR__ . "/conexao/conecta.php";
require_once __DIR__ . "/conexao/funcoes.php";

$pesquisa_raw = $_GET['pesquisa'] ?? '';
$categoria_raw = $_GET['categoria'] ?? '';
$pesquisa = mysqli_real_escape_string($conexao, $_GET['pesquisa'] ?? '');
$categoria_filtro = mysqli_real_escape_string($conexao, $_GET['categoria'] ?? '');
$promocao = isset($_GET['promocao']) && $_GET['promocao'] == '1';



# CONFIGURAÇÃO DA PAGINAÇÃO

// Quantidade de produtos sendo mostrados por página
$paginaQtd = 5;

// Verificando se existe algum valor para "página" sendo passado para URL
$paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1 ;

// Verificação para evitar página 0 ou com número negativo
if ($paginaAtual < 1)
{
    $paginaAtual = 1;
}

$sql_count = "SELECT COUNT(codigo_produto) as 'total' FROM produto WHERE status_produto = 1";

$query_count = mysqli_query($conexao, $sql_count);
$resultado_count = mysqli_fetch_assoc($query_count);

// Armazenando o total de produtos
$quantidade = $resultado_count['total'];

// Quantidade de páginas
$paginaFinal = ceil($quantidade / $paginaQtd);

// Evitando acessar uma página maior que a última
if ($paginaAtual > $paginaFinal && $paginaFinal > 0)
{
    $paginaAtual = $paginaFinal;
}

// Cláusula LIMIT
$valorInicial = ($paginaAtual - 1) * $paginaQtd;




$sql = "SELECT
        produto.codigo_produto,
        produto.nome_produto,
        produto.descricao_produto,
        produto.raridade_produto,
        produto.quantidade_estoque,
        produto.foto_produto1,
        produto.preco_venda,
        produto.status_promocao,
        produto.desconto_promocao,
        produto.preco_promocao,
        categoria.codigo_categoria,
        categoria.nome_categoria,
        marca.nome_marca
        FROM produto
        JOIN categoria ON produto.codigo_categoria = categoria.codigo_categoria
        JOIN marca ON produto.codigo_marca = marca.codigo_marca
        WHERE produto.status_produto = 1
        AND produto.quantidade_estoque > 0";

if ($pesquisa !== '') {
  $sql .= " AND produto.nome_produto LIKE '%$pesquisa%'";
}

if ($categoria_filtro !== '') {
  $sql .= " AND produto.codigo_categoria = '$categoria_filtro'";
}

if ($promocao) {
  $sql .= " AND produto.status_promocao = 1 AND produto.preco_promocao > 0";
}

$sql .= " ORDER BY categoria.nome_categoria, produto.nome_produto LIMIT $valorInicial, $paginaQtd";


$query = mysqli_query($conexao, $sql);
$produtos =  mysqli_fetch_all($query, MYSQLI_ASSOC);

$categorias = [];
foreach ($produtos as $produto) {
  $categorias[$produto['codigo_categoria']]['nome'] = $produto['nome_categoria'];
  $categorias[$produto['codigo_categoria']]['produtos'][] = $produto;
}

$sql_categorias = "SELECT codigo_categoria, nome_categoria FROM categoria WHERE status_categoria = 1 ORDER BY nome_categoria";
$query_categorias = mysqli_query($conexao, $sql_categorias);
$lista_categorias = $query_categorias ? mysqli_fetch_all($query_categorias, MYSQLI_ASSOC) : [];

$url_filtro = function (array $troca) use ($pesquisa_raw, $categoria_raw, $promocao) {
  $params = array_merge(['pesquisa' => $pesquisa_raw, 'categoria' => $categoria_raw, 'promocao' => $promocao ? '1' : ''], $troca);
  $params = array_filter($params, fn($v) => $v !== '');
  return 'produtos.php' . ($params ? '?' . http_build_query($params) : '');
};
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produtos | DECKLY</title>
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

  <section class="page-hero">
    <div class="container">
      <span class="eyebrow">DECKLY</span>
      <h1><?= $promocao ? 'Promoções' : 'Produtos' ?></h1>
      <p><?= $promocao ? 'Cartas com preço especial. Aproveite enquanto durar o estoque.' : 'Cartas para montar o seu deck.' ?></p>
    </div>
  </section>

  <section class="catalogo">
    <div class="container">

      <form method="get" class="filtro-bar" role="search">
        <div class="filtro-busca">
          <i class="bi bi-search"></i>
          <input type="search" name="pesquisa" placeholder="Pesquisar produto..." value="<?= htmlspecialchars($pesquisa_raw) ?>">
        </div>
        <?php if ($categoria_raw !== ''): ?>
          <input type="hidden" name="categoria" value="<?= htmlspecialchars($categoria_raw) ?>">
        <?php endif; ?>
        <?php if ($promocao): ?>
          <input type="hidden" name="promocao" value="1">
        <?php endif; ?>
        <button type="submit" class="btn-filtrar">Pesquisar</button>
      </form>

      <div class="chips">
        <a class="chip <?= $categoria_raw === '' ? 'ativo' : '' ?>" href="<?= htmlspecialchars($url_filtro(['categoria' => ''])) ?>">Todas</a>
        <?php foreach ($lista_categorias as $cat): ?>
          <a class="chip <?= (string)$categoria_raw === (string)$cat['codigo_categoria'] ? 'ativo' : '' ?>"
            href="<?= htmlspecialchars($url_filtro(['categoria' => (string)$cat['codigo_categoria']])) ?>">
            <?= htmlspecialchars($cat['nome_categoria']) ?>
          </a>
        <?php endforeach; ?>
      </div>

      <p class="resultados"><strong><?= count($produtos) ?></strong> <?= count($produtos) === 1 ? 'produto encontrado' : 'produtos encontrados' ?></p>

      <?php if (count($produtos) > 0): ?>

        <?php foreach ($categorias as $categoria): ?>
          <div class="grupo-categoria">
            <div class="grupo-titulo">
              <h3><?= htmlspecialchars($categoria['nome']) ?></h3>
              <span><?= count($categoria['produtos']) ?></span>
            </div>

            <div class="row g-3 g-lg-4">
              <?php foreach ($categoria['produtos'] as $produto): ?>
                <div class="col-12 col-md-4 col-xl-3">
                  <?= card_produto($produto) ?>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endforeach; ?>

      <?php else: ?>

        <div class="vazio">
          <i class="bi bi-search"></i>
          <h4>Nenhum produto encontrado</h4>
          <p>Tente outro termo de busca ou escolha outra categoria.</p>
          <a href="produtos.php" class="btn-filtrar">Ver todos os produtos</a>
        </div>

      <?php endif; ?>

    </div>
  </section>

  <!-- PAGINAÇÃO -->
<div class="col-12 mt-5">
    <nav>
        <?php 
            if ($paginaFinal > 1)
            {
        ?>
        <ul class="pagination justify-content-center">
            <?php 
                if ($paginaAtual > 1)
                {

                
            ?>
            <li class="page-item">
                <a href="?pagina=<?php echo $paginaAtual - 1 ?>" class="page-link">
                    <i class="bi bi-chevron-left"></i>
                </a>
            </li>
            <?php
                }
                
                for ($i = 1; $i <= $paginaFinal; $i++)
                {
                
            ?>
            <li class="page-item">
                <a href="?pagina=<?php echo $i?>" class="page-link">
                    <?php echo $i?>
                </a>
            </li>
            <?php
                } 
            ?>
            <li class="page-item">
                <a href="?pagina=<?php echo $paginaAtual + 1 ?>" class="page-link">
                    <i class="bi bi-chevron-right"></i>
                </a>
            </li>
            <?php 
            ?>
        </ul>
        <?php 
            }
        ?>
    </nav>
</div>

<?php include("Rodape.php");?>



  <?php mysqli_close($conexao); ?>

</body>

</html>