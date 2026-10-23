<?php
/**
 * Funções compartilhadas pela vitrine (fotos, promoção e card de produto).
 */

const FOTO_PLACEHOLDER = 'assets/img/placeholder-produto.png';
const FOTO_ONERROR = "this.onerror=null;this.src='" . FOTO_PLACEHOLDER . "'";

/**
 * Caminho (relativo à raiz do site) da foto de um produto.
 * As fotos ficam na pasta images/. Se o produto não tiver foto, usa o placeholder
 * (e o onerror da <img> também troca pelo placeholder se o arquivo não existir).
 */
function foto_produto_url($arquivo)
{
    $arquivo = basename(trim((string)$arquivo));

    if ($arquivo === '') {
        return FOTO_PLACEHOLDER;
    }

    return 'images/' . rawurlencode($arquivo);
}

/** Produto está em promoção válida? */
function produto_em_promocao($produto)
{
    return ($produto['status_promocao'] ?? 0) == 1 && (float)($produto['preco_promocao'] ?? 0) > 0;
}

/** Percentual de desconto calculado entre preço de venda e preço promocional. */
function produto_desconto_percentual($produto)
{
    $venda = (float)$produto['preco_venda'];
    $promo = (float)$produto['preco_promocao'];

    return $venda > 0 ? (int)round((1 - $promo / $venda) * 100) : 0;
}

function preco_br($valor)
{
    return 'R$ ' . number_format((float)$valor, 2, ',', '.');
}

/** HTML do card de produto (usado em produtos.php e nos relacionados). */
function card_produto($produto)
{
    $em_promocao = produto_em_promocao($produto);
    $preco = $em_promocao ? (float)$produto['preco_promocao'] : (float)$produto['preco_venda'];
    $nome = htmlspecialchars($produto['nome_produto']);
    $estoque = (int)$produto['quantidade_estoque'];
    $link = 'produto.php?codigo_produto=' . (int)$produto['codigo_produto'];
    $foto = foto_produto_url($produto['foto_produto1']);

    ob_start();
    ?>
    <article class="product-card card-catalogo">
      <a href="<?= $link ?>" class="product-image">
        <img src="<?= $foto ?>" alt="<?= $nome ?>" loading="lazy" onerror="<?= FOTO_ONERROR ?>">
        <?php if ($em_promocao): ?>
          <span class="product-badge promo">-<?= produto_desconto_percentual($produto) ?>%</span>
        <?php endif; ?>
        <?php if ($estoque > 0 && $estoque <= 3): ?>
          <span class="badge-estoque">Últimas unidades</span>
        <?php endif; ?>
      </a>

      <div class="product-info">
        <span class="card-meta"><?= htmlspecialchars($produto['raridade_produto']) ?> • <?= htmlspecialchars($produto['nome_marca']) ?></span>
        <h4 title="<?= $nome ?>"><?= $nome ?></h4>

        <div class="product-bottom">
          <div class="product-price">
            <?php if ($em_promocao): ?>
              <s class="preco-antigo"><?= preco_br($produto['preco_venda']) ?></s>
            <?php endif; ?>
            <strong class="preco-atual"><?= preco_br($preco) ?></strong>
          </div>
        </div>

        <a href="<?= $link ?>" class="btn-detalhes">Ver detalhes <i class="bi bi-arrow-right"></i></a>
      </div>
    </article>
    <?php
    return ob_get_clean();
}
