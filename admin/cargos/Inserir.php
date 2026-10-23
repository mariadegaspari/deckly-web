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
        include('../Log.php');
        include('../Mensagem.php');
        ?>

        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4 class="m-0">Novo cargo</h4>
            <a href="Index.php" class="btn btn-primary btn-sm">
              <i class="bi bi-arrow-left-short"></i>
              Voltar</a>
          </div>
          <div class="linha"></div>

          
          <div class="card-body">
           <form action="Acoes.php" method="post">
            <div class="row">
              <div class="col-6">
                <label for="cargo"><strong class="text-danger">*</strong>Cargo: </label>
                <input type="text" name="cargo" id="cargo" class="form-control" maxlength="40" required>
              </div>

              <div class="col-2">
                <label for="datacadastro">Data de Cadastro:</label>
                  <input type="date" name="datacadastro" id="datacadastro" class="form-control" value="<?= date('Y-m-d') ?>" disabled>
              </div>
              <div class="col-2">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control" disabled>
                  <option value="1">Ativo</option>
                  <option value="0">Inativo</option>
                </select>
              </div>
            </div>

            
            <div class="row">
                <div class="col-12 mt-2">
                <label for="obervacao">Observação:</label>
                <textarea name="observacao" id="observacao" class="form-control" maxlength="100"></textarea>

                  <input type="hidden" name="cadastrar" value="cadastrar_cargo">

                <input type="submit" value="Cadastrar" class="btn btn-primary mt-3">
              </div>
              </div>
            </div>
           </form>
          </div>
          
          </div>
        </div>

      </main>


    </div>
  </div>

  <!-- JQUERY CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>