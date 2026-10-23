<?php
# CONEXÃO COM BANCO DE DADOS #
require_once __DIR__ . "/../conexao/conecta.php";

#INICIANDO UMA SESSÃO#
if (!isset($_SESSION)) {
  session_start();
}

#VERIFICANDO SE EXISTE USUÁRIO LOGADO PARA PERMITIR ACESSO#
if (!$_SESSION['USER']) {
  $_SESSION['naoAutorizado'] = "Apenas usuários cadastrados podem acessar esta área!";
  header('Location: Index.php');
  exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>PAINEL ADMINISTRATIVO</title>

  <!-- BOOTSTRAP CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

  <!-- BOOTSTRAP ICONS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <!-- CUSTOMIZAÇÃO DO TEMPLATE -->
  <link rel="stylesheet" href="../assets/css/dashboard.min.css">
  <link rel="stylesheet" href="../assets/css/styles.min.css">

  <!-- FAVICON -->
  <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">


  <link rel="stylesheet" href="../assets/css/deckly.css">
</head>

<body>

  <?php
  #Início TOPO
  include('Topo.php');
  #Final TOPO
  ?>

  <div class="container-fluid">
    <div class="row">
      <?php
      #Início MENU
      include('Navegacao.php');
      #Final MENU
      ?>

      <main class="ms-auto col-lg-10 px-md-4">
        <?php
        include('Log.php');
        ?>

        <?php
        function totalRegistros($conexao, $tabela)
        {
          $permitidas = ['produto', 'cliente', 'categoria', 'marca', 'cargo', 'funcionario'];
          if (!in_array($tabela, $permitidas, true)) return 0;
          $resultado = mysqli_query($conexao, "SELECT COUNT(*) AS total FROM `$tabela`");
          if (!$resultado) return 0;
          $dados = mysqli_fetch_assoc($resultado);
          return (int) $dados['total'];
        }

        $totalProdutos = totalRegistros($conexao, 'produto');
        $totalClientes = totalRegistros($conexao, 'cliente');
        $totalCategorias = totalRegistros($conexao, 'categoria');
        $totalMarcas = totalRegistros($conexao, 'marca');

        // ---- DADOS DE VENDAS ----
        // tabela: venda | colunas: codigo_venda, data_pedido, forma_pagamento, valor_total
        $totalVendas = 0;
        $faturamento = 0;
        $vendasMes = 0;
        $faturamentoMes = 0;

        // total geral
        $res = mysqli_query($conexao, "SELECT COUNT(*) AS qtd, IFNULL(SUM(valor_total), 0) AS soma FROM venda");
        if ($res) {
          $d = mysqli_fetch_assoc($res);
          $totalVendas = (int) $d['qtd'];
          $faturamento = (float) $d['soma'];
        }

        // mês atual
        $res = mysqli_query($conexao, "SELECT COUNT(*) AS qtd, IFNULL(SUM(valor_total), 0) AS soma FROM venda WHERE MONTH(data_pedido) = MONTH(CURDATE()) AND YEAR(data_pedido) = YEAR(CURDATE())");
        if ($res) {
          $d = mysqli_fetch_assoc($res);
          $vendasMes = (int) $d['qtd'];
          $faturamentoMes = (float) $d['soma'];
        }

        // faturamento dos últimos 6 meses (gráfico)
        $meses = [];
        $valoresMeses = [];
        $res = mysqli_query($conexao, "SELECT DATE_FORMAT(data_pedido, '%m/%Y') AS mes, SUM(valor_total) AS soma FROM venda WHERE data_pedido >= DATE_SUB(CURDATE(), INTERVAL 5 MONTH) GROUP BY YEAR(data_pedido), MONTH(data_pedido), mes ORDER BY YEAR(data_pedido), MONTH(data_pedido)");
        if ($res) {
          while ($linha = mysqli_fetch_assoc($res)) {
            $meses[] = $linha['mes'];
            $valoresMeses[] = (float) $linha['soma'];
          }
        }

        // últimas 5 vendas
        $ultimasVendas = mysqli_query($conexao, "SELECT codigo_venda, data_pedido, forma_pagamento, valor_total FROM venda ORDER BY data_pedido DESC LIMIT 5");
        ?>

        <section class="admin-dashboard">
          <div class="dashboard-intro">
            <div>
              <span class="dashboard-kicker">VISÃO GERAL</span>
              <h2>Bem-vindo ao Sistema Deckly</h2>
              <p>Acompanhe os principais dados da loja em um só lugar.</p>
            </div>
            <span class="dashboard-date"><i class="bi bi-calendar3"></i> <?= date('d/m/Y') ?></span>
          </div>

          <div class="dashboard-stats">
            <a class="dashboard-stat" href="produto/">
              <span class="stat-icon"><i class="bi bi-archive"></i></span>
              <span class="stat-label">Produtos cadastrados</span>
              <strong><?= $totalProdutos ?></strong>
              <span class="stat-link">Gerenciar produtos <i class="bi bi-arrow-up-right"></i></span>
            </a>
            <a class="dashboard-stat" href="cliente/">
              <span class="stat-icon"><i class="bi bi-people"></i></span>
              <span class="stat-label">Clientes cadastrados</span>
              <strong><?= $totalClientes ?></strong>
              <span class="stat-link">Ver clientes <i class="bi bi-arrow-up-right"></i></span>
            </a>
            <a class="dashboard-stat" href="categoria/">
              <span class="stat-icon"><i class="bi bi-grid"></i></span>
              <span class="stat-label">Categorias</span>
              <strong><?= $totalCategorias ?></strong>
              <span class="stat-link">Gerenciar categorias <i class="bi bi-arrow-up-right"></i></span>
            </a>
            <a class="dashboard-stat" href="marca/">
              <span class="stat-icon"><i class="bi bi-tags"></i></span>
              <span class="stat-label">Marcas</span>
              <strong><?= $totalMarcas ?></strong>
              <span class="stat-link">Gerenciar marcas <i class="bi bi-arrow-up-right"></i></span>
            </a>
            <a class="dashboard-stat" href="venda/">
              <span class="stat-icon"><i class="bi bi-cart-check"></i></span>
              <span class="stat-label">Vendas realizadas</span>
              <strong><?= $totalVendas ?></strong>
              <span class="stat-link">Neste mês: <?= $vendasMes ?> <i class="bi bi-arrow-up-right"></i></span>
            </a>
            <a class="dashboard-stat" href="venda/">
              <span class="stat-icon"><i class="bi bi-cash-coin"></i></span>
              <span class="stat-label">Faturamento total</span>
              <strong>R$ <?= number_format($faturamento, 2, ',', '.') ?></strong>
              <span class="stat-link">Neste mês: R$ <?= number_format($faturamentoMes, 2, ',', '.') ?> <i class="bi bi-arrow-up-right"></i></span>
            </a>
          </div>

          <div class="dashboard-panel dashboard-chart-panel">
            <div class="dashboard-panel-title"><i class="bi bi-bar-chart-line"></i> Visão geral dos cadastros</div>
            <p class="dashboard-chart-description">Comparativo dos registros cadastrados no sistema.</p>
            <div class="dashboard-chart-wrap"><canvas id="cadastrosChart" aria-label="Gráfico de cadastros por categoria" role="img"></canvas></div>
          </div>

          

          <div class="dashboard-panel dashboard-chart-panel">
            <div class="dashboard-panel-title"><i class="bi bi-receipt"></i> Últimas vendas</div>
            <table class="table table-dark table-borderless mb-0">
              <thead>
                <tr>
                  <th>Nº</th>
                  <th>Data</th>
                  <th>Pagamento</th>
                  <th>Valor</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($ultimasVendas && mysqli_num_rows($ultimasVendas) > 0) { ?>
                  <?php while ($v = mysqli_fetch_assoc($ultimasVendas)) { ?>
                    <tr>
                      <td>#<?= $v['codigo_venda'] ?></td>
                      <td><?= date('d/m/Y', strtotime($v['data_pedido'])) ?></td>
                      <td><?= htmlspecialchars($v['forma_pagamento']) ?></td>
                      <td>R$ <?= number_format($v['valor_total'], 2, ',', '.') ?></td>
                    </tr>
                  <?php } ?>
                <?php } else { ?>
                  <tr>
                    <td colspan="4">Nenhuma venda registrada ainda.</td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>

          <div class="dashboard-bottom">
            <div class="dashboard-panel">
              <div class="dashboard-panel-title"><i class="bi bi-lightning-charge"></i> Acesso rápido</div>
              <div class="dashboard-shortcuts">
                <a href="produto/"><i class="bi bi-plus-circle"></i><span><strong>Produtos</strong><small>Cadastrar e atualizar itens</small></span><i class="bi bi-chevron-right"></i></a>
                <a href="categoria/"><i class="bi bi-collection"></i><span><strong>Categorias</strong><small>Organizar o catálogo</small></span><i class="bi bi-chevron-right"></i></a>
                <a href="marca/"><i class="bi bi-bookmark-star"></i><span><strong>Marcas</strong><small>Administrar marcas cadastradas</small></span><i class="bi bi-chevron-right"></i></a>
                <a href="cliente/"><i class="bi bi-person-lines-fill"></i><span><strong>Clientes</strong><small>Consultar cadastros</small></span><i class="bi bi-chevron-right"></i></a>
                <a href="venda/"><i class="bi bi-cart-check"></i><span><strong>Vendas</strong><small>Acompanhar vendas realizadas</small></span><i class="bi bi-chevron-right"></i></a>
              </div>
            </div>
            <div class="dashboard-panel dashboard-highlight">
              <span class="highlight-symbol"><i class="bi bi-bar-chart-line"></i></span>
              <h3>Sua loja, sob controle.</h3>
              <p>Use os atalhos para manter produtos, categorias, marcas e clientes sempre atualizados.</p>
              <a href="produto/">Ir para produtos <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        </section>

        <div>
          <?php

          if (isset($_SESSION['naoAdm'])) {

            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';

            echo $_SESSION['naoAdm'];

            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';

            unset($_SESSION['naoAdm']);
          }

          ?>
        </div>

      </main>
    </div>
  </div>

  <!-- JQUERY CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const grafico = document.getElementById('cadastrosChart');
    if (grafico) {
      new Chart(grafico, {
        type: 'bar',
        data: {
          labels: ['Produtos', 'Clientes', 'Categorias', 'Marcas'],
          datasets: [{
            label: 'Cadastros',
            data: [<?= $totalProdutos ?>, <?= $totalClientes ?>, <?= $totalCategorias ?>, <?= $totalMarcas ?>],
            backgroundColor: ['#21D3FF', '#21D3FF', '#21D3FF', '#21D3FF'],
            borderColor: '#21D3FF',
            borderWidth: 1,
            borderRadius: 6,
            maxBarThickness: 58
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false
            },
            tooltip: {
              backgroundColor: '#0D0E12',
              titleColor: '#F1F4F7',
              bodyColor: '#21D3FF',
              borderColor: '#33363E',
              borderWidth: 1
            }
          },
          scales: {
            x: {
              ticks: {
                color: '#B6BDC7'
              },
              grid: {
                display: false,
                drawBorder: false
              }
            },
            y: {
              beginAtZero: true,
              ticks: {
                color: '#A8AFBA',
                precision: 0
              },
              grid: {
                color: 'rgba(168,175,186,.12)',
                drawBorder: false
              }
            }
          }
        }
      });
    }

    // GRÁFICO DE VENDAS (faturamento por mês)
    const graficoVendas = document.getElementById('vendasChart');
    if (graficoVendas) {
      new Chart(graficoVendas, {
        type: 'line',
        data: {
          labels: <?= json_encode($meses) ?>,
          datasets: [{
            label: 'Faturamento (R$)',
            data: <?= json_encode($valoresMeses) ?>,
            borderColor: '#21D3FF',
            backgroundColor: 'rgba(33,211,255,.15)',
            borderWidth: 2,
            fill: true,
            tension: 0.3,
            pointBackgroundColor: '#21D3FF'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false
            },
            tooltip: {
              backgroundColor: '#0D0E12',
              titleColor: '#F1F4F7',
              bodyColor: '#21D3FF',
              borderColor: '#33363E',
              borderWidth: 1
            }
          },
          scales: {
            x: {
              ticks: {
                color: '#B6BDC7'
              },
              grid: {
                display: false
              }
            },
            y: {
              beginAtZero: true,
              ticks: {
                color: '#A8AFBA'
              },
              grid: {
                color: 'rgba(168,175,186,.12)'
              }
            }
          }
        }
      });
    }
  </script>
</body>

</html>
