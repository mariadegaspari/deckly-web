<?php

# CONEXÃO COM BANCO DE DADOS #
require_once __DIR__ . "/../../conexao/conecta.php";

//    # INICIANDO UMA SESSÃO #
//  if (!isset($_SESSION))
//   {
//     session_start();
//   }

# VERIFICANDO SE EXISTE USUÁRIO LOGADO PARA PERMITIR ACESSO #
include_once __DIR__ . "/../Usuario_Comum.php";

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
  <link rel="stylesheet" href="../../assets/css/dashboard.min.css">
  <link rel="stylesheet" href="../../assets/css/styles.min.css">

  <!-- FAVICON -->
  <link rel="shortcut icon" href="../../assets/img/favicon.ico" type="image/x-icon">


  <link rel="stylesheet" href="../../assets/css/deckly.css">
</head>

<body>

  <?php
  #Início TOPO
  include('../Topo.php');
  #Final TOPO
  ?>

  <div class="container-fluid">
    <div class="row">
      <?php
      #Início MENU
      include('../Navegacao.php');
      #Final MENU
      ?>

      <main class="ms-auto col-lg-10 px-md-4">
        <?php
        //BOAS-VINDAS MOSTRANDO USUÁRIO LOGADO
        include('../Log.php');

        //MENSAGEM DE ERRO OU SUCESSO
        include('../Mensagem.php');
        ?>

        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4 class="m-0">Cargos</h4>

            <a href="Inserir.php" class="btn btn-primary btn-sm">
              <i class="bi bi-plus"></i>
              Adicionar</a>
          </div>
          <div class="linha"></div>
          

          <?php

          $sql_cargo = "SELECT codigo_cargo FROM cargo";

          $query_cargo = mysqli_query($conexao, $sql_cargo);

          if (mysqli_num_rows($query_cargo) > 0) {

          ?>
           

            <div class="card-body">
              <div class="row">
                <!-- FILTRO DE STATUS -->
                <div class="col-2">
                  <form action="" method="get">
                    <select name="status" id="status" class="form-control" onchange="submit()">
                      <option value="">Status</option>
                      <option value="1" <?php if (isset($_GET['status']) && $_GET['status'] == '1') echo 'selected' ?>>Ativo</option>
                      <option value="0" <?php if (isset($_GET['status']) && $_GET['status'] == '0') echo 'selected' ?>>Inativo</option>
                    </select>
                  </form>
                </div>

                <!-- CAMPO DE BUSCA POR NOME DO CARGO -->
                <div class="col-4">
                  <form action="">
                    <input type="search" name="pesquisa" id="pesquisa" class="form-control" placeholder="Pesquise por cargo..." onchange="submit()">
                  </form>


                </div>

              </div>
            </div>
            <div class="linha"></div>
            <?php
            if (isset($_GET['pesquisa']) && $_GET['pesquisa'] != '') {
              $pesquisa = mysqli_real_escape_string($conexao, $_GET['pesquisa']);

              $sql = "SELECT * FROM cargo WHERE nome LIKE '%$pesquisa%';";
            } else if (isset($_GET['status']) && $_GET['status'] != '') {
              $status = mysqli_real_escape_string($conexao, $_GET['status']);

              $sql = "SELECT * FROM cargo WHERE status = $status;";
            } else {
              $sql = "SELECT * FROM cargo;";
            }

            $query = mysqli_query($conexao, $sql);

            if (mysqli_num_rows($query) > 0) {
            ?>
              <div class="card-body p-0">
                <!-- TABELA -->
                <table class="table">
                  <!-- CABEÇALHO DA TABELA -->
                  <thead class="table-dark">
                    <!-- TABLE ROW: LINHA DA TABELA -->
                    <tr>
                      <!-- TABLE HEAD: TÍTULO DA COLUNA -->
                      <th>Codigo Cargo</th>
                      <th>Nome</th>
                      <th>Observação</th>
                      <th>Status</th>
                      <th>Data Cadastro</th>
                      <th>Ações</th>
                    </tr>
                  </thead>

                  <!-- CORPO DA TABELA -->
                  <tbody>

                    <?php foreach ($query as $cargo) { ?>
                      <!-- LINHA DA TABELA -->
                      <tr>
                        <!-- TABLE DATA: DADOS DA TABELA -->
                        <td><?php echo $cargo['codigo_cargo'] ?></td>

                        <td><?php echo $cargo['nome'] ?></td>

                        <td><?php echo $cargo['observacao'] ?></td>

                        <td>
                          <?php
                          if ($cargo['status'] == 1) {
                            echo '<span class="badge text-bg-success">Ativo</span>';
                          } else {
                            echo '<span class="badge text-bg-danger">Inativo</span>';
                          }
                          ?>
                        </td>

                        <td><?php echo date('d/m/Y', strtotime($cargo['data_cadastro'])) ?></td>
                        <td>
                          <a href="Editar.php?codigo_cargo=<?php echo $cargo['codigo_cargo'] ?>" class="btn btn-outline-success btn-sm" title="editar">
                            <i class="bi bi-pencil"></i>
                          </a>

                          <form action="acoes.php" method="post" class="d-inline">
                            <button type="submit" class="btn btn-outline-danger btn-sm" title="Excluir" name="deletar_cargo" value="<?php echo $cargo['codigo_cargo'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">
                              <i class="bi bi-trash"></i>
                            </button>
                          </form>

                        </td>
                      </tr>

                    <?php } ?>

                  </tbody>
                </table>
              </div>
            <?php
            } else {
              echo '<div class="alert alert-danger" role="alert">Nenhum registro encontrado!</div>';
            }

            ?>

          <?php
          } else {
            echo '<div class="alert alert-danger" role="alert">Nenhum registro encontrado!</div>';
          }
          ?>

        </div>
      </main>
    </div>
  </div>

  <!-- FECHANDO A CONEXÃO COM O BANCO DE DADOS -->
  <?php mysqli_close($conexao) ?>

  <!-- JQUERY CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>